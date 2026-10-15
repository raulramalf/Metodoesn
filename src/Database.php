<?php
require_once __DIR__ . '/../config/config.php';

/**
 * Acceso SQLite (singleton PDO) con WAL, migraciones por PRAGMA user_version,
 * rate limiting por IP y cifrado en reposo del campo `mensaje` (datos de salud, art. 9 RGPD).
 */
class Database {
    private static ?PDO $pdo = null;
    private const SCHEMA_VERSION = 2;

    public static function get(): PDO {
        if (self::$pdo === null) {
            $dir = dirname(DB_PATH);
            if (!is_dir($dir)) mkdir($dir, 0700, true);
            $isNew = !file_exists(DB_PATH);

            $pdo = new PDO('sqlite:' . DB_PATH, null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
            $pdo->exec('PRAGMA busy_timeout = 5000');
            $pdo->exec('PRAGMA journal_mode = WAL');
            $pdo->exec('PRAGMA synchronous = NORMAL');
            $pdo->exec('PRAGMA foreign_keys = ON');
            $pdo->exec('PRAGMA secure_delete = ON');
            if ($isNew) @chmod(DB_PATH, 0600);

            self::migrate($pdo);
            self::$pdo = $pdo;
        }
        return self::$pdo;
    }

    /** Cierra el singleton (tests y scripts CLI). */
    public static function reset(): void {
        self::$pdo = null;
    }

    private static function migrate(PDO $pdo): void {
        $v = (int)$pdo->query('PRAGMA user_version')->fetchColumn();
        if ($v >= self::SCHEMA_VERSION) return;

        $pdo->exec('BEGIN IMMEDIATE');
        try {
            $v = (int)$pdo->query('PRAGMA user_version')->fetchColumn(); // relectura bajo bloqueo
            if ($v < 1) {
                $pdo->exec("CREATE TABLE IF NOT EXISTS contactos (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nombre TEXT,
                    email TEXT NOT NULL,
                    mensaje TEXT NOT NULL,
                    ip TEXT,
                    creado_en TEXT DEFAULT CURRENT_TIMESTAMP
                )");
            }
            if ($v < 2) {
                $cols = array_column($pdo->query('PRAGMA table_info(contactos)')->fetchAll(), 'name');
                foreach ([
                    'consentimiento'    => 'INTEGER NOT NULL DEFAULT 0',
                    'politica_version'  => 'TEXT',
                    'consentimiento_en' => 'TEXT',
                    'idioma'            => 'TEXT',
                    'mensaje_cifrado'   => 'INTEGER NOT NULL DEFAULT 0',
                ] as $col => $def) {
                    if (!in_array($col, $cols, true)) $pdo->exec("ALTER TABLE contactos ADD COLUMN $col $def");
                }
                $pdo->exec("CREATE TABLE IF NOT EXISTS rate_limits (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    bucket TEXT NOT NULL,
                    ts INTEGER NOT NULL
                )");
                $pdo->exec('CREATE INDEX IF NOT EXISTS idx_rate_bucket_ts ON rate_limits(bucket, ts)');
            }
            $pdo->exec('PRAGMA user_version = ' . self::SCHEMA_VERSION);
            $pdo->exec('COMMIT');
        } catch (Throwable $e) {
            $pdo->exec('ROLLBACK');
            throw $e;
        }
    }

    /** Clave de aplicación de 256 bits: variable ESN_APP_KEY (hex) o data/app.key (0600, autogenerada). */
    public static function appKey(): string {
        $env = getenv('ESN_APP_KEY');
        if ($env && strlen($env) === 64 && ctype_xdigit($env)) return hex2bin($env);
        if (!file_exists(KEY_PATH)) {
            $dir = dirname(KEY_PATH);
            if (!is_dir($dir)) mkdir($dir, 0700, true);
            file_put_contents(KEY_PATH, bin2hex(random_bytes(32)), LOCK_EX);
            @chmod(KEY_PATH, 0600);
        }
        return hex2bin(trim((string)file_get_contents(KEY_PATH)));
    }

    public static function encrypt(string $plain): string {
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        return base64_encode($nonce . sodium_crypto_secretbox($plain, $nonce, self::appKey()));
    }

    public static function decrypt(string $blob): ?string {
        $raw = base64_decode($blob, true);
        if ($raw === false || strlen($raw) < SODIUM_CRYPTO_SECRETBOX_NONCEBYTES + SODIUM_CRYPTO_SECRETBOX_MACBYTES) return null;
        $n = substr($raw, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $r = sodium_crypto_secretbox_open(substr($raw, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES), $n, self::appKey());
        return $r === false ? null : $r;
    }

    /** Identificador de cubo para rate limiting: HMAC de la IP (no almacena la IP en claro). */
    public static function bucketFor(string $ip, string $scope = 'contacto'): string {
        return hash_hmac('sha256', $scope . '|' . $ip, self::appKey());
    }

    /**
     * Intenta consumir un envío del cubo. Atómico (BEGIN IMMEDIATE): dos peticiones
     * concurrentes no pueden superar el límite. Devuelve false si se excede.
     */
    public static function rateLimitHit(string $bucket, int $max = RATE_LIMIT_MAX, int $window = RATE_LIMIT_WINDOW, ?int $now = null): bool {
        $pdo = self::get();
        $now ??= time();
        $pdo->exec('BEGIN IMMEDIATE');
        try {
            $pdo->prepare('DELETE FROM rate_limits WHERE ts < :min')->execute([':min' => $now - 86400]);
            $st = $pdo->prepare('SELECT COUNT(*) FROM rate_limits WHERE bucket = :b AND ts > :since');
            $st->execute([':b' => $bucket, ':since' => $now - $window]);
            if ((int)$st->fetchColumn() >= $max) {
                $pdo->exec('COMMIT');
                return false;
            }
            $pdo->prepare('INSERT INTO rate_limits (bucket, ts) VALUES (:b, :t)')->execute([':b' => $bucket, ':t' => $now]);
            $pdo->exec('COMMIT');
            return true;
        } catch (Throwable $e) {
            $pdo->exec('ROLLBACK');
            throw $e;
        }
    }

    /** Guarda un contacto con trazabilidad de consentimiento (RGPD art. 7.1). Devuelve el id. */
    public static function saveContact(string $nombre, string $email, string $mensaje, string $ip, string $lang): int {
        $st = self::get()->prepare(
            'INSERT INTO contactos (nombre, email, mensaje, ip, creado_en, consentimiento, politica_version, consentimiento_en, idioma, mensaje_cifrado)
             VALUES (:n, :e, :m, :ip, :ts, 1, :pv, :ts, :l, 1)'
        );
        $st->execute([
            ':n' => $nombre, ':e' => $email, ':m' => self::encrypt($mensaje), ':ip' => $ip,
            ':ts' => gmdate('c'), ':pv' => PRIVACY_POLICY_VERSION, ':l' => $lang,
        ]);
        return (int)self::get()->lastInsertId();
    }

    /** Minimización de datos: elimina contactos anteriores al periodo de retención. */
    public static function purgeContacts(int $days = CONTACT_RETENTION_DAYS): int {
        $st = self::get()->prepare('DELETE FROM contactos WHERE creado_en < :lim');
        $st->execute([':lim' => gmdate('c', time() - $days * 86400)]);
        return $st->rowCount();
    }
}

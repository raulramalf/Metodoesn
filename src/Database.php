<?php
require_once __DIR__ . '/../config/config.php';

class Database {
    private static ?PDO $pdo = null;

    public static function get(): PDO {
        if (self::$pdo === null) {
            self::$pdo = new PDO('sqlite:' . DB_PATH, null, null, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            self::$pdo->exec("CREATE TABLE IF NOT EXISTS contactos (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nombre TEXT,
                email TEXT NOT NULL,
                mensaje TEXT NOT NULL,
                ip TEXT,
                creado_en TEXT DEFAULT CURRENT_TIMESTAMP
            )");
            self::$pdo->exec("CREATE INDEX IF NOT EXISTS idx_contactos_ip_fecha ON contactos (ip, creado_en)");
            self::purgeExpired(self::$pdo);
        }
        return self::$pdo;
    }

    /**
     * Huella de la IP (HMAC con clave local). Permite limitar envíos sin guardar la IP en claro.
     */
    public static function ipFingerprint(string $ip): string {
        return substr(hash_hmac('sha256', $ip, self::secret()), 0, 32);
    }

    /**
     * Número de mensajes recibidos desde una huella de IP en la ventana indicada (segundos).
     */
    public static function recentContacts(string $fingerprint, int $windowSeconds): int {
        $stmt = self::get()->prepare(
            "SELECT COUNT(*) FROM contactos WHERE ip = :ip AND creado_en >= datetime('now', :ventana)"
        );
        $stmt->execute(['ip' => $fingerprint, 'ventana' => '-' . $windowSeconds . ' seconds']);
        return (int) $stmt->fetchColumn();
    }

    /**
     * Elimina la huella de IP pasados IP_RETENTION_DAYS días (minimización de datos, RGPD).
     */
    private static function purgeExpired(PDO $pdo): void {
        $stmt = $pdo->prepare(
            "UPDATE contactos SET ip = NULL WHERE ip IS NOT NULL AND creado_en < datetime('now', :limite)"
        );
        $stmt->execute(['limite' => '-' . IP_RETENTION_DAYS . ' days']);
    }

    private static function secret(): string {
        $file = dirname(DB_PATH) . '/.ip_secret';
        if (!is_file($file)) {
            file_put_contents($file, bin2hex(random_bytes(32)), LOCK_EX);
            @chmod($file, 0600);
        }
        return (string) file_get_contents($file);
    }
}

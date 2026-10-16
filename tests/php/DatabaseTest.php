<?php
use PHPUnit\Framework\TestCase;

final class DatabaseTest extends TestCase
{
    protected function setUp(): void
    {
        Database::reset();
        foreach (glob(DB_PATH . '*') ?: [] as $f) @unlink($f);
    }

    public function testSingletonReturnsSameInstance(): void
    {
        $this->assertSame(Database::get(), Database::get());
        Database::reset();
        $this->assertNotSame(spl_object_id(Database::get()), 0);
    }

    public function testWalAndPragmas(): void
    {
        $pdo = Database::get();
        $this->assertSame('wal', strtolower((string)$pdo->query('PRAGMA journal_mode')->fetchColumn()));
        $this->assertSame(5000, (int)$pdo->query('PRAGMA busy_timeout')->fetchColumn());
        $this->assertSame(1, (int)$pdo->query('PRAGMA foreign_keys')->fetchColumn());
        $this->assertSame(PDO::ERRMODE_EXCEPTION, $pdo->getAttribute(PDO::ATTR_ERRMODE));
    }

    public function testSchemaHasContactAndConsentColumns(): void
    {
        $cols = array_column(Database::get()->query('PRAGMA table_info(contactos)')->fetchAll(), 'name');
        foreach (['id', 'nombre', 'email', 'mensaje', 'ip', 'creado_en', 'consentimiento', 'politica_version', 'consentimiento_en', 'idioma'] as $c) {
            $this->assertContains($c, $cols);
        }
    }

    public function testMigratesLegacyDatabasePreservingRows(): void
    {
        $legacy = new PDO('sqlite:' . DB_PATH);
        $legacy->exec("CREATE TABLE contactos (id INTEGER PRIMARY KEY AUTOINCREMENT, nombre TEXT, email TEXT NOT NULL, mensaje TEXT NOT NULL, ip TEXT, creado_en TEXT DEFAULT CURRENT_TIMESTAMP)");
        $legacy->exec("INSERT INTO contactos (nombre,email,mensaje,ip) VALUES ('Vieja','v@x.es','hola','1.1.1.1')");
        unset($legacy);

        $pdo = Database::get();
        $row = $pdo->query('SELECT * FROM contactos')->fetch();
        $this->assertSame('Vieja', $row['nombre']);
        $this->assertSame(0, (int)$row['consentimiento']);          // dato histórico sin consentimiento registrado
        $this->assertSame(2, (int)$pdo->query('PRAGMA user_version')->fetchColumn());
    }

    public function testMigrationIsIdempotent(): void
    {
        Database::get(); Database::reset(); Database::get();
        $this->assertSame(2, (int)Database::get()->query('PRAGMA user_version')->fetchColumn());
    }

    public function testSaveContactStoresConsentIsoTimestampAndEncryptsMessage(): void
    {
        $id = Database::saveContact('Ana', 'ana@example.com', 'Tengo SIBO y SOP', '203.0.113.5', 'es');
        $row = Database::get()->query("SELECT * FROM contactos WHERE id=$id")->fetch();

        $this->assertSame(1, (int)$row['consentimiento']);
        $this->assertSame(PRIVACY_POLICY_VERSION, $row['politica_version']);
        $this->assertSame('es', $row['idioma']);
        $this->assertSame('203.0.113.5', $row['ip']);
        $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\+00:00$/', $row['consentimiento_en']);
        $this->assertStringNotContainsString('SIBO', $row['mensaje']);          // cifrado en reposo
        $this->assertSame('Tengo SIBO y SOP', Database::decrypt($row['mensaje']));
    }

    public function testDecryptRejectsTamperedAndGarbage(): void
    {
        $blob = Database::encrypt('secreto');
        $raw = base64_decode($blob);
        $raw[strlen($raw) - 1] = chr(ord($raw[strlen($raw) - 1]) ^ 1);
        $this->assertNull(Database::decrypt(base64_encode($raw)));
        $this->assertNull(Database::decrypt('no-base64!!'));
        $this->assertNull(Database::decrypt(''));
    }

    public function testSqlInjectionPayloadsAreStoredInertly(): void
    {
        Database::saveContact("Robert'); DROP TABLE contactos;--", 'a@b.es', "x' OR '1'='1", '1.1.1.1', 'es');
        $this->assertSame(1, (int)Database::get()->query('SELECT COUNT(*) FROM contactos')->fetchColumn());
    }

    public function testRateLimitAllowsThreePerWindowThenBlocks(): void
    {
        $b = Database::bucketFor('198.51.100.7');
        $now = 1_800_000_000;
        $this->assertTrue(Database::rateLimitHit($b, 3, 900, $now));
        $this->assertTrue(Database::rateLimitHit($b, 3, 900, $now + 10));
        $this->assertTrue(Database::rateLimitHit($b, 3, 900, $now + 20));
        $this->assertFalse(Database::rateLimitHit($b, 3, 900, $now + 30));
        $this->assertFalse(Database::rateLimitHit($b, 3, 900, $now + 899));
    }

    public function testRateLimitWindowSlidesAndBucketsAreIndependent(): void
    {
        $a = Database::bucketFor('198.51.100.1'); $b = Database::bucketFor('198.51.100.2');
        $now = 1_800_000_000;
        for ($i = 0; $i < 3; $i++) Database::rateLimitHit($a, 3, 900, $now);
        $this->assertFalse(Database::rateLimitHit($a, 3, 900, $now + 1));
        $this->assertTrue(Database::rateLimitHit($b, 3, 900, $now + 1));          // otra IP no afectada
        $this->assertTrue(Database::rateLimitHit($a, 3, 900, $now + 901));        // ventana vencida
    }

    public function testBucketDoesNotExposeRawIp(): void
    {
        $b = Database::bucketFor('198.51.100.7');
        $this->assertMatchesRegularExpression('/^[0-9a-f]{64}$/', $b);
        $this->assertStringNotContainsString('198.51.100.7', $b);
        $this->assertNotSame($b, Database::bucketFor('198.51.100.7', 'otro'));
    }

    public function testPurgeRemovesOnlyExpiredContacts(): void
    {
        $pdo = Database::get();
        $pdo->exec("INSERT INTO contactos (nombre,email,mensaje,creado_en) VALUES ('old','o@x.es','m','" . gmdate('c', time() - 900 * 86400) . "')");
        Database::saveContact('new', 'n@x.es', 'm', '1.1.1.1', 'es');
        $this->assertSame(1, Database::purgeContacts(730));
        $this->assertSame(1, (int)$pdo->query('SELECT COUNT(*) FROM contactos')->fetchColumn());
    }

    public function testKeyFileIsCreatedWithRestrictivePermissions(): void
    {
        Database::appKey();
        $this->assertFileExists(KEY_PATH);
        $this->assertSame('0600', substr(sprintf('%o', fileperms(KEY_PATH)), -4));
        $this->assertSame(32, strlen(Database::appKey()));
    }

    public function testRefundFreesOneAttempt(): void
    {
        $b = Database::bucketFor('198.51.100.50'); $now = time();
        for ($i = 0; $i < 3; $i++) Database::rateLimitHit($b, 3, 900, $now);
        $this->assertFalse(Database::rateLimitHit($b, 3, 900, $now));
        Database::rateLimitRefund($b);
        $this->assertTrue(Database::rateLimitHit($b, 3, 900, $now));
    }
}

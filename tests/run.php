<?php
// Pruebas sin dependencias: php tests/run.php
ob_start();
$tmp = sys_get_temp_dir() . '/esn_test_' . bin2hex(random_bytes(4));
mkdir($tmp);
define('DB_PATH', $tmp . '/test.sqlite');

require __DIR__ . '/../src/functions.php';
require __DIR__ . '/../src/Database.php';

$failures = 0;
function check(string $name, bool $cond): void {
    global $failures;
    if (!$cond) { $failures++; }
    fwrite(STDOUT, ($cond ? 'ok   ' : 'FAIL ') . $name . PHP_EOL);
}

// Escape de salida
check('e() escapa HTML', e('<b>"x"</b>') === '&lt;b&gt;&quot;x&quot;&lt;/b&gt;');
check('e() acepta null', e(null) === '');

// CSRF
$_SESSION = [];
$tok = csrf_token();
check('csrf válido', csrf_check($tok));
check('csrf inválido', !csrf_check('otro'));
check('csrf null', !csrf_check(null));

// Traducciones: mismas claves en todos los idiomas
$all = translations();
$base = array_keys($all['es']);
foreach (['en', 'de'] as $lang) {
    check("claves de '$lang' = claves de 'es'",
        array_diff($base, array_keys($all[$lang])) === [] && array_diff(array_keys($all[$lang]), $base) === []);
}
$_GET['lang'] = 'en';
check('t() usa el idioma pedido', t('nav_skip') === $all['en']['nav_skip']);
unset($_GET['lang']);

// Límite de envíos y retención de IP
$fp = Database::ipFingerprint('203.0.113.7');
check('huella no es la IP', $fp !== '203.0.113.7' && strlen($fp) === 32);
check('huella estable', $fp === Database::ipFingerprint('203.0.113.7'));
$pdo = Database::get();
$ins = $pdo->prepare('INSERT INTO contactos (nombre, email, mensaje, ip) VALUES ("a", "a@b.es", "hola mundo", :ip)');
for ($i = 0; $i < 3; $i++) { $ins->execute(['ip' => $fp]); }
check('recentContacts cuenta envíos', Database::recentContacts($fp, 3600) === 3);
check('recentContacts por otra IP = 0', Database::recentContacts(Database::ipFingerprint('198.51.100.1'), 3600) === 0);
$pdo->exec("UPDATE contactos SET creado_en = datetime('now', '-31 days')");
$pdo = null;
$r = new ReflectionProperty(Database::class, 'pdo');
$r->setAccessible(true);
$r->setValue(null, null);
Database::get();
$left = (int) Database::get()->query('SELECT COUNT(*) FROM contactos WHERE ip IS NOT NULL')->fetchColumn();
check('IP se elimina pasados IP_RETENTION_DAYS', $left === 0);

$r->setValue(null, null);
gc_collect_cycles();
foreach (glob($tmp . "/{*,.[!.]*}", GLOB_BRACE) as $f) { @unlink($f); }
@rmdir($tmp);
ob_end_flush();
exit($failures ? 1 : 0);

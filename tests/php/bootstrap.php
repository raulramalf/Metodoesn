<?php
// Entorno aislado: BD y clave en un directorio temporal por ejecución (nunca toca data/).
$tmp = sys_get_temp_dir() . '/esn-tests-' . getmypid();
@mkdir($tmp, 0700, true);
define('DB_PATH', $tmp . '/test.sqlite');
define('KEY_PATH', $tmp . '/app.key');
register_shutdown_function(function () use ($tmp) {
    foreach (glob($tmp . '/*') ?: [] as $f) @unlink($f);
    @rmdir($tmp);
});
$_SERVER['REQUEST_URI'] = '/';
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SESSION = [];

require __DIR__ . '/../../src/functions.php';
require __DIR__ . '/../../src/Database.php';
require __DIR__ . '/../../src/seo.php';

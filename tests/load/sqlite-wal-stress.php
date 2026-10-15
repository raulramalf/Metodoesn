<?php
// php tests/load/sqlite-wal-stress.php [procesos=16] [inserciones=200]
// Escrituras concurrentes puras sobre SQLite (sin servidor web): rateLimitHit + saveContact desde N procesos.
// Criterio de éxito: 0 errores ("database is locked"), filas == procesos*inserciones e integrity_check = ok.
define('DB_PATH', sys_get_temp_dir() . '/esn-stress.sqlite');
define('KEY_PATH', sys_get_temp_dir() . '/esn-stress.key');
require __DIR__ . '/../../src/Database.php';

if (($argv[1] ?? '') === 'child') {
    [$id, $n] = [(int)$argv[2], (int)$argv[3]];
    $errors = 0;
    for ($i = 0; $i < $n; $i++) {
        try {
            Database::rateLimitHit(Database::bucketFor("ip-$id-$i"), 3, 900);
            Database::saveContact('Stress', "s$id-$i@example.com", 'mensaje de prueba', '127.0.0.1', 'es');
        } catch (Throwable $e) { $errors++; fwrite(STDERR, $e->getMessage() . "\n"); }
    }
    exit($errors > 0 ? 1 : 0);
}

[$procs, $n] = [(int)($argv[1] ?? 16), (int)($argv[2] ?? 200)];
foreach (glob(DB_PATH . '*') ?: [] as $f) @unlink($f);
Database::get(); Database::reset();                       // migra una sola vez antes de lanzar los hijos
$t = microtime(true);
$handles = [];
for ($p = 0; $p < $procs; $p++) {
    $handles[] = proc_open([PHP_BINARY, __FILE__, 'child', (string)$p, (string)$n], [1 => ['file', '/dev/null', 'w'], 2 => STDERR], $pipes);
}
$failed = 0;
foreach ($handles as $h) { while (proc_get_status($h)['running']) usleep(10000); $failed += proc_close($h) > 0 ? 1 : 0; }

$pdo = Database::get();
$rows = (int)$pdo->query('SELECT COUNT(*) FROM contactos')->fetchColumn();
$integrity = $pdo->query('PRAGMA integrity_check')->fetchColumn();
$mode = $pdo->query('PRAGMA journal_mode')->fetchColumn();
printf("procesos=%d x %d  tiempo=%.2fs  filas=%d/%d  procesos_con_error=%d  journal=%s  integrity=%s\n",
    $procs, $n, microtime(true) - $t, $rows, $procs * $n, $failed, $mode, $integrity);
exit(($failed === 0 && $rows === $procs * $n && $integrity === 'ok') ? 0 : 1);

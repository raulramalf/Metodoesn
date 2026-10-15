#!/usr/bin/env php
<?php
// Uso: php bin/leer-contactos.php [--purge]   (solo CLI; descifra mensajes para la titular)
if (PHP_SAPI !== 'cli') { http_response_code(404); exit; }
require __DIR__ . '/../src/Database.php';
if (in_array('--purge', $argv, true)) {
    echo 'Eliminados: ' . Database::purgeContacts() . PHP_EOL;
    exit(0);
}
foreach (Database::get()->query('SELECT * FROM contactos ORDER BY id DESC LIMIT 200') as $r) {
    $msg = $r['mensaje_cifrado'] ? (Database::decrypt($r['mensaje']) ?? '[ilegible]') : $r['mensaje'];
    printf("#%d %s <%s> [%s] consent=%s v%s\n%s\n---\n", $r['id'], $r['nombre'], $r['email'], $r['creado_en'], $r['consentimiento'], $r['politica_version'], $msg);
}

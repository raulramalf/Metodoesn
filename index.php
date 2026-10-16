<?php
// Respaldo si mod_rewrite no estuviera activo: arranca la home real. Con el .htaccess de la raíz este fichero no llega a ejecutarse.
require __DIR__ . '/public/index.php';

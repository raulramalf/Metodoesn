<?php
define('SITE_NAME', 'Método ESN');
define('SITE_TAGLINE', 'Entrenamiento | Salud | Nutrición');
define('SITE_OWNER', 'Elena Sánchez Novo');
define('SITE_COLLEGIATE_NUMBER', 'MAD01639');
define('SITE_EMAIL', 'contacto@metodoesn.com');
define('SITE_PHONE', '+34 614 467 084');
define('SITE_PHONE_LINK', '+34614467084');
define('SITE_INSTAGRAM', '@metodo.esn');
define('SITE_INSTAGRAM_URL', 'https://www.instagram.com/metodo.esn/');
define('SITE_ADDRESS', 'Clínica SurgEOM - MedicoQuirúrgica y Dermatológica');
define('SITE_HOURS', 'Lunes a Viernes de 16:00 a 21:00');
define('BOOKING_URL', 'https://www.doctoralia.es/elena-sanchez-novo/dietista-nutricionista/madrid');
define('DB_PATH', __DIR__ . '/../data/metodoesn.sqlite');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

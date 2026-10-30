<?php
define('SITE_NAME', 'Método ESN');
define('SITE_TAGLINE', 'Entrenamiento | Salud | Nutrición');
define('SITE_OWNER', 'Elena Sánchez Novo');
define('SITE_COLLEGIATE_NUMBER', 'MAD01639');
define('SITE_EMAIL', 'contacto@metodoesn.com');
define('SITE_PHONE', '+34 614 467 084');
define('SITE_PHONE_LINK', '+34614467084');
define('SITE_INSTAGRAM', '@metodoESN');
define('SITE_INSTAGRAM_URL', 'https://www.instagram.com/metodo.esn/');
define('SITE_ADDRESS', 'Clínica SurgEOM · C/ de Coslada, 16, 28028 Madrid');
define('SITE_MAPS_URL', 'https://maps.google.com/?q=Cl%C3%ADnica+SurgEOM,+Calle+de+Coslada+16,+28028+Madrid');
define('SITE_MAPS_EMBED', 'https://maps.google.com/maps?q=Cl%C3%ADnica+SurgEOM,+Calle+de+Coslada,+16,+28028+Madrid&t=&z=16&ie=UTF8&iwloc=&output=embed');
define('SITE_HOURS', 'Lunes a Viernes de 16:00 a 21:00');
define('BOOKING_URL', 'https://www.doctoralia.es/elena-sanchez-novo/dietista-nutricionista/madrid');
define('SITE_CANONICAL', 'https://metodoesn.com');
if (!defined('DB_PATH')) {
    define('DB_PATH', __DIR__ . '/../data/metodoesn.sqlite');
}

// Formulario de contacto: máx. CONTACT_RATE_MAX mensajes por IP en CONTACT_RATE_WINDOW segundos
// y al menos CONTACT_COOLDOWN_SECONDS entre envíos de una misma sesión.
define('CONTACT_RATE_MAX', 3);
define('CONTACT_RATE_WINDOW', 3600);
define('CONTACT_COOLDOWN_SECONDS', 30);
// Días que se conserva la huella de IP asociada a un mensaje.
define('IP_RETENTION_DAYS', 30);

// Cabeceras de seguridad (se aplican a todas las páginas que cargan la configuración).
if (!headers_sent()) {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
    // CSP conservadora: no restringe scripts/frames para no romper los widgets de Doctoralia ni el mapa.
    header("Content-Security-Policy: object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'self'");
}

if (session_status() === PHP_SESSION_NONE) {
    $secure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => $secure,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

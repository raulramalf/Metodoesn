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
// ⚠ VERIFICAR: coordenadas aproximadas; sustituir por las exactas (Google Maps > clic derecho > copiar coordenadas).
define('SITE_GEO_LAT', 40.4390);
define('SITE_GEO_LNG', -3.6730);
define('SITE_RATING_VALUE', '5.0');
define('SITE_RATING_COUNT', 50);      // Doctoralia: "más de 50"; actualizar con el recuento real verificado
define('SITE_OG_IMAGE', '/assets/img/og-default.jpg');   // 1200x630
defined('DB_PATH') || define('DB_PATH', __DIR__ . '/../data/metodoesn.sqlite');
defined('KEY_PATH') || define('KEY_PATH', __DIR__ . '/../data/app.key');
define('PRIVACY_POLICY_VERSION', '2026-10-15');
define('RATE_LIMIT_MAX', 3);          // envíos máximos por IP...
define('RATE_LIMIT_WINDOW', 900);     // ...en esta ventana (15 min)
define('FORM_MIN_SECONDS', 3);        // un humano tarda más que esto en rellenar el formulario
define('CONTACT_RETENTION_DAYS', 730);
// IPs de proxies inversos de confianza (para leer X-Forwarded-For). Vacío = no confiar.
defined('TRUSTED_PROXIES') || define('TRUSTED_PROXIES', []);

if (session_status() === PHP_SESSION_NONE && PHP_SAPI !== 'cli') {
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

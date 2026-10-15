<?php
/**
 * Cabeceras de seguridad HTTP centralizadas (Método ESN).
 * Se envían una única vez por petición desde functions.php, antes de cualquier salida.
 */

/** Nonce CSP por petición (base64, 128 bits). */
function csp_nonce(): string {
    static $nonce = null;
    if ($nonce === null) {
        $nonce = rtrim(strtr(base64_encode(random_bytes(16)), '+/', '-_'), '=');
    }
    return $nonce;
}

/** Política CSP. Scripts: nonce + Docplanner. Estilos: se mantiene 'unsafe-inline' (hay atributos style="" en las plantillas). */
function csp_policy(): string {
    $n = csp_nonce();
    return implode('; ', [
        "default-src 'self'",
        "script-src 'self' 'nonce-$n' https://platform.docplanner.com",
        "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://platform.docplanner.com",
        "font-src 'self' https://fonts.gstatic.com data:",
        "img-src 'self' data: https://*.docplanner.com https://*.doctoralia.es https://*.googleapis.com https://*.gstatic.com https://maps.google.com",
        "connect-src 'self' https://*.docplanner.com https://*.doctoralia.es",
        "frame-src https://maps.google.com https://www.google.com https://*.docplanner.com https://*.doctoralia.es",
        "form-action 'self'",
        "frame-ancestors 'self'",
        "base-uri 'self'",
        "object-src 'none'",
        "upgrade-insecure-requests",
    ]);
}

/** ¿La petición llegó por HTTPS (directo o tras proxy de confianza)? */
function request_is_https(): bool {
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') return true;
    return ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https'
        && in_array($_SERVER['REMOTE_ADDR'] ?? '', defined('TRUSTED_PROXIES') ? TRUSTED_PROXIES : [], true);
}

/** Devuelve el mapa cabecera => valor (testeable sin enviar nada). */
function security_headers(): array {
    $h = [
        'Content-Security-Policy'      => csp_policy(),
        'X-Content-Type-Options'       => 'nosniff',
        'X-Frame-Options'              => 'SAMEORIGIN',
        'Referrer-Policy'              => 'strict-origin-when-cross-origin',
        'Permissions-Policy'           => 'accelerometer=(), camera=(), geolocation=(), gyroscope=(), magnetometer=(), microphone=(), payment=(), usb=(), interest-cohort=()',
        'Cross-Origin-Opener-Policy'   => 'same-origin',
        'Cross-Origin-Resource-Policy' => 'same-site',
        'X-Permitted-Cross-Domain-Policies' => 'none',
    ];
    if (request_is_https()) {
        $h['Strict-Transport-Security'] = 'max-age=63072000; includeSubDomains; preload';
    }
    return $h;
}

function send_security_headers(): void {
    if (PHP_SAPI === 'cli' || headers_sent()) return;
    foreach (security_headers() as $k => $v) {
        header("$k: $v");
    }
    header_remove('X-Powered-By');
}

<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/i18n.php';

function e(?string $v): string {
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}

function asset(string $path): string {
    return '/assets/' . ltrim($path, '/');
}

function img(string $name): string {
    return asset('img/' . $name);
}

function csrf_token(): string {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_check(?string $token): bool {
    return !empty($_SESSION['csrf']) && is_string($token)
        && hash_equals($_SESSION['csrf'], $token);
}

/**
 * Compone el email de aviso de un mensaje del formulario de contacto.
 * Separado del envío para poder probarlo. El nombre se limpia de saltos de línea
 * para que no pueda inyectar cabeceras; el email ya llega validado.
 */
function contact_mail(array $msg): array {
    $nombre = trim(preg_replace('/[\r\n\t]+/', ' ', $msg['nombre'] ?? '')) ?: '(sin nombre)';
    $email = filter_var($msg['email'] ?? '', FILTER_VALIDATE_EMAIL) ?: '';

    $subject = mb_encode_mimeheader('Nuevo mensaje web: ' . $nombre, 'UTF-8', 'B', "\r\n");
    $body = "Nuevo mensaje desde el formulario de contacto de " . SITE_NAME . ".\r\n\r\n"
        . "Nombre: {$nombre}\r\n"
        . "Email: {$email}\r\n"
        . "Fecha: " . date('d/m/Y H:i') . "\r\n\r\n"
        . "Mensaje:\r\n" . str_replace(["\r\n", "\n"], "\r\n", $msg['mensaje'] ?? '') . "\r\n\r\n"
        . "-- \r\nResponde a este correo para contestar directamente a {$nombre}.\r\n";

    $headers = [
        'From' => mb_encode_mimeheader(SITE_NAME, 'UTF-8', 'B') . ' <' . CONTACT_MAIL_FROM . '>',
        'MIME-Version' => '1.0',
        'Content-Type' => 'text/plain; charset=UTF-8',
        'Content-Transfer-Encoding' => '8bit',
    ];
    if ($email !== '') {
        $headers['Reply-To'] = $email;
    }

    return ['to' => CONTACT_NOTIFY_TO, 'subject' => $subject, 'body' => $body, 'headers' => $headers];
}

/** Envía el aviso; si el servidor no puede mandar correo, lo deja en el log sin romper el formulario. */
function send_contact_mail(array $msg): bool {
    $m = contact_mail($msg);
    $sent = @mail($m['to'], $m['subject'], $m['body'], $m['headers'], '-f' . CONTACT_MAIL_FROM);
    if (!$sent) {
        error_log('Método ESN: no se pudo enviar el aviso de contacto a ' . $m['to']);
    }
    return $sent;
}

function nav_class(string $file): string {
    return basename($_SERVER['SCRIPT_NAME']) === $file ? 'is-active' : '';
}

/**
 * URL absoluta de la página actual en el idioma indicado (para canonical y hreflang).
 * El español es el idioma por defecto y no lleva parámetro.
 */
function absolute_url(string $lang): string {
    $script = basename($_SERVER['SCRIPT_NAME'] ?? 'index.php');
    $path = $script === 'index.php' ? '/' : '/' . $script;
    $url = rtrim(SITE_CANONICAL, '/') . $path;
    return $lang === 'es' ? $url : $url . '?lang=' . urlencode($lang);
}

/**
 * Idioma -> código de región para og:locale.
 */
function og_locale(string $lang): string {
    return ['es' => 'es_ES', 'en' => 'en_GB', 'de' => 'de_DE'][$lang] ?? 'es_ES';
}

<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/i18n.php';
require_once __DIR__ . '/security.php';

send_security_headers();

function e(?string $v): string {
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}

function asset(string $path): string {
    return '/assets/' . ltrim($path, '/');
}

/** Devuelve la variante .webp si existe junto al original (PNG/JPG pesados); el original en otro caso. */
function img(string $name): string {
    $webp = preg_replace('/\.(png|jpe?g)$/i', '.webp', $name);
    if ($webp !== $name && is_file(__DIR__ . '/../public/assets/img/' . $webp)) {
        return asset('img/' . $webp);
    }
    return asset('img/' . $name);
}

/** Vida máxima del token CSRF (segundos). */
const CSRF_TTL = 7200;

function csrf_token(): string {
    $expired = isset($_SESSION['csrf_ts']) && (time() - (int)$_SESSION['csrf_ts']) > CSRF_TTL;
    if (empty($_SESSION['csrf']) || $expired) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
        $_SESSION['csrf_ts'] = time();
    }
    return $_SESSION['csrf'];
}

function csrf_check(?string $token): bool {
    if (empty($_SESSION['csrf']) || !is_string($token)) return false;
    if ((time() - (int)($_SESSION['csrf_ts'] ?? 0)) > CSRF_TTL) return false;
    return hash_equals($_SESSION['csrf'], $token);
}

/** Invalida el token tras un envío correcto (un solo uso). */
function csrf_rotate(): void {
    unset($_SESSION['csrf'], $_SESSION['csrf_ts']);
}

/**
 * Sanitiza texto libre de usuario:
 *  - rechaza UTF-8 inválido, elimina bytes nulos y caracteres de control (salvo \n y \t si multilínea),
 *  - normaliza a NFKC (neutraliza formas de ancho completo / compatibilidad usadas como homoglifos),
 *  - elimina caracteres invisibles y de control bidireccional (Trojan Source, U+200B..U+200F, U+202A..U+202E, U+2066..U+2069, U+FEFF).
 * Devuelve null si la entrada no es UTF-8 válido.
 */
function sanitize_text(?string $v, bool $multiline = false): ?string {
    $v = $v ?? '';
    if (!mb_check_encoding($v, 'UTF-8')) return null;
    if (class_exists('Normalizer')) {
        $n = Normalizer::normalize($v, Normalizer::FORM_KC);
        if ($n === false) return null;
        $v = $n;
    }
    $v = str_replace("\r\n", "\n", $v);
    $v = preg_replace('/[\x{200B}-\x{200F}\x{202A}-\x{202E}\x{2060}-\x{2069}\x{FEFF}\x{00AD}]/u', '', $v);
    $ctl = $multiline ? '/[\x00-\x08\x0B\x0C\x0D\x0E-\x1F\x7F\x{0080}-\x{009F}]/u' : '/[\x00-\x1F\x7F\x{0080}-\x{009F}]/u';
    $v = preg_replace($ctl, '', $v);
    if ($v === null) return null;
    $v = $multiline ? preg_replace("/\n{3,}/", "\n\n", $v) : preg_replace('/\s+/u', ' ', $v);
    return trim((string)$v);
}

/** ¿Alguna palabra mezcla alfabeto latino con cirílico/griego (patrón típico de homoglifos)? */
function has_mixed_script_word(string $v): bool {
    foreach (preg_split('/[\s\p{P}]+/u', $v, -1, PREG_SPLIT_NO_EMPTY) as $word) {
        if (preg_match('/\p{Latin}/u', $word) && preg_match('/[\p{Cyrillic}\p{Greek}]/u', $word)) {
            return true;
        }
    }
    return false;
}

/** IP del cliente. Solo se confía en X-Forwarded-For si REMOTE_ADDR es un proxy declarado en TRUSTED_PROXIES. */
function client_ip(): string {
    $remote = $_SERVER['REMOTE_ADDR'] ?? '';
    $trusted = defined('TRUSTED_PROXIES') ? TRUSTED_PROXIES : [];
    if ($remote !== '' && in_array($remote, $trusted, true) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $first = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
        if (filter_var($first, FILTER_VALIDATE_IP)) return $first;
    }
    return filter_var($remote, FILTER_VALIDATE_IP) ? $remote : '0.0.0.0';
}


function nav_class(string $file): string {
    return basename($_SERVER['SCRIPT_NAME']) === $file ? 'is-active' : '';
}

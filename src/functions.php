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

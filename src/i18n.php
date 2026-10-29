<?php
/**
 * Sistema de Internacionalización (i18n) para Método ESN
 * Soporta Español ('es'), Inglés ('en') y Alemán ('de')
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Idiomas soportados
 */
function supported_languages(): array {
    return [
        'es' => [
            'name' => 'Español',
            'label' => 'ES',
            'flag' => '🇪🇸'
        ],
        'en' => [
            'name' => 'English',
            'label' => 'EN',
            'flag' => '🇬🇧'
        ],
        'de' => [
            'name' => 'Deutsch',
            'label' => 'DE',
            'flag' => '🇩🇪'
        ]
    ];
}

/**
 * Banderas vectoriales en SVG puro (compatibles con Windows y todos los dispositivos)
 */
function flag_svg(string $lang, int $width = 18, int $height = 13): string {
    switch ($lang) {
        case 'es':
            return '<svg class="lang-flag-svg" viewBox="0 0 640 480" width="' . $width . '" height="' . $height . '" aria-hidden="true" style="border-radius:2px; box-shadow:0 1px 3px rgba(0,0,0,0.18); flex-shrink:0;"><g fill-rule="evenodd"><path fill="#aa151b" d="M0 0h640v480H0z"/><path fill="#f1bf00" d="M0 120h640v240H0z"/></g></svg>';
        case 'en':
            return '<svg class="lang-flag-svg" viewBox="0 0 640 480" width="' . $width . '" height="' . $height . '" aria-hidden="true" style="border-radius:2px; box-shadow:0 1px 3px rgba(0,0,0,0.18); flex-shrink:0;"><g fill-rule="evenodd"><path fill="#012169" d="M0 0h640v480H0z"/><path fill="#fff" d="m75 0 245 184L565 0h75v56L435 240l205 154v86h-75L320 296 75 480H0v-56l205-154L0 116V0z"/><path fill="#c8102e" d="m424 288 216 162v30h-30L384 318zM640 0v12L440 162l32 24L640 50zM0 480v-12l200-150-32-24L0 430zM0 0l216 162-32 24L0 50z"/><path fill="#fff" d="M240 0h160v480H240zM0 160h640v160H0z"/><path fill="#c8102e" d="M267 0h106v480H267zM0 187h640v106H0z"/></g></svg>';
        case 'de':
            return '<svg class="lang-flag-svg" viewBox="0 0 640 480" width="' . $width . '" height="' . $height . '" aria-hidden="true" style="border-radius:2px; box-shadow:0 1px 3px rgba(0,0,0,0.18); flex-shrink:0;"><g fill-rule="evenodd"><path fill="#000" d="M0 0h640v160H0z"/><path fill="#dd0000" d="M0 160h640v160H0z"/><path fill="#ffce00" d="M0 320h640v160H0z"/></g></svg>';
        default:
            return '';
    }
}

/**
 * Obtener idioma actual (prioridad: GET -> SESSION -> COOKIE -> 'es')
 */
function current_lang(): string {
    $supported = array_keys(supported_languages());

    if (isset($_GET['lang']) && in_array($_GET['lang'], $supported, true)) {
        $lang = $_GET['lang'];
        $_SESSION['site_lang'] = $lang;
        @setcookie('site_lang', $lang, time() + (86400 * 30), '/');
        return $lang;
    }

    if (!empty($_SESSION['site_lang']) && in_array($_SESSION['site_lang'], $supported, true)) {
        return $_SESSION['site_lang'];
    }

    if (!empty($_COOKIE['site_lang']) && in_array($_COOKIE['site_lang'], $supported, true)) {
        $_SESSION['site_lang'] = $_COOKIE['site_lang'];
        return $_COOKIE['site_lang'];
    }

    return 'es';
}

/**
 * Generar enlace para conmutar idioma en la URL actual
 */
function lang_url(string $targetLang): string {
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $parts = parse_url($uri);
    $path = $parts['path'] ?? '/';
    
    $params = [];
    if (!empty($parts['query'])) {
        parse_str($parts['query'], $params);
    }
    
    $params['lang'] = $targetLang;
    return $path . '?' . http_build_query($params);
}

/**
 * Generar URL interna preservando el idioma si es distinto de 'es'
 */
function page_url(string $path): string {
    $lang = current_lang();
    if ($lang === 'es') {
        return $path;
    }
    $separator = (strpos($path, '?') === false) ? '?' : '&';
    return $path . $separator . 'lang=' . urlencode($lang);
}

/**
 * Diccionario maestro de traducciones
 */
function translations(): array {
    static $cache = null;
    if ($cache === null) {
        $cache = [];
        foreach (array_keys(supported_languages()) as $code) {
            $cache[$code] = require __DIR__ . '/lang/' . $code . '.php';
        }
    }
    return $cache;
}

/**
 * Obtener texto traducido por clave
 */
function t(string $key, ?string $fallback = null): string {
    $lang = current_lang();
    $all = translations();
    
    if (isset($all[$lang][$key])) {
        return $all[$lang][$key];
    }
    if (isset($all['es'][$key])) {
        return $all['es'][$key];
    }
    return $fallback ?? $key;
}

<?php require_once __DIR__ . '/../src/functions.php'; ?>
<!DOCTYPE html>
<html lang="<?= e(current_lang()) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle ?? (SITE_NAME . ' · ' . SITE_OWNER)) ?> · <?= e(SITE_NAME) ?></title>
    <meta name="description" content="<?= e($pageDesc ?? t('hero_lead', 'Entrenamiento personal, nutrición clínica y salud en Madrid y Online con Elena Sánchez Novo.')) ?>">
    <link rel="icon" href="<?= e(img('logo.png')) ?>">
    <?php
        $seoLang  = current_lang();
        $seoTitle = ($pageTitle ?? (SITE_NAME . ' · ' . SITE_OWNER)) . ' · ' . SITE_NAME;
        $seoDesc  = $pageDesc ?? t('hero_lead');
        $seoImage = rtrim(SITE_CANONICAL, '/') . img('og-hero.jpg');
    ?>
    <link rel="canonical" href="<?= e(absolute_url($seoLang)) ?>">
    <?php foreach (array_keys(supported_languages()) as $altLang): ?>
    <link rel="alternate" hreflang="<?= e($altLang) ?>" href="<?= e(absolute_url($altLang)) ?>">
    <?php endforeach; ?>
    <link rel="alternate" hreflang="x-default" href="<?= e(absolute_url('es')) ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
    <meta property="og:locale" content="<?= e(og_locale($seoLang)) ?>">
    <meta property="og:title" content="<?= e($seoTitle) ?>">
    <meta property="og:description" content="<?= e($seoDesc) ?>">
    <meta property="og:url" content="<?= e(absolute_url($seoLang)) ?>">
    <meta property="og:image" content="<?= e($seoImage) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="preload" href="<?= e(asset('fonts/instrument-sans-normal-400-latin.woff2')) ?>" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="<?= e(asset('css/fonts.css')) ?>">
    <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
</head>
<body>
<a class="skip" href="#main"><?= e(t('nav_skip', 'Saltar al contenido')) ?></a>

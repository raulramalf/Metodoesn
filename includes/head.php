<?php require_once __DIR__ . '/../src/functions.php'; ?>
<!DOCTYPE html>
<html lang="<?= e(current_lang()) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle ?? (SITE_NAME . ' · ' . SITE_OWNER)) ?> · <?= e(SITE_NAME) ?></title>
    <meta name="description" content="<?= e($pageDesc ?? t('hero_lead', 'Entrenamiento personal, nutrición clínica y salud en Madrid y Online con Elena Sánchez Novo.')) ?>">
    <link rel="icon" type="image/png" sizes="48x48" href="<?= e(img('favicon-48.png')) ?>">
    <link rel="apple-touch-icon" href="<?= e(img('apple-touch-icon.png')) ?>">
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
    <meta name="twitter:title" content="<?= e($seoTitle) ?>">
    <meta name="twitter:description" content="<?= e($seoDesc) ?>">
    <meta name="twitter:image" content="<?= e($seoImage) ?>">
    <meta name="theme-color" content="#8a4f4d">
    <?php
        $base = rtrim(SITE_CANONICAL, '/');
        $ld = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebSite',
                    '@id' => $base . '/#website',
                    'url' => $base . '/',
                    'name' => SITE_NAME,
                    'inLanguage' => ['es', 'en', 'de'],
                ],
                [
                    '@type' => ['MedicalBusiness', 'LocalBusiness'],
                    '@id' => $base . '/#business',
                    'name' => SITE_NAME,
                    'url' => $base . '/',
                    'image' => $seoImage,
                    'logo' => $base . img('logo.png'),
                    'description' => t('hero_lead'),
                    'telephone' => SITE_PHONE_LINK,
                    'email' => SITE_EMAIL,
                    'address' => [
                        '@type' => 'PostalAddress',
                        'streetAddress' => 'Calle de Coslada, 16',
                        'postalCode' => '28028',
                        'addressLocality' => 'Madrid',
                        'addressCountry' => 'ES',
                    ],
                    'openingHoursSpecification' => [[
                        '@type' => 'OpeningHoursSpecification',
                        'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                        'opens' => '16:00',
                        'closes' => '21:00',
                    ]],
                    'areaServed' => 'Madrid',
                    'sameAs' => [SITE_INSTAGRAM_URL, BOOKING_URL],
                    'founder' => ['@id' => $base . '/#elena'],
                ],
                [
                    '@type' => 'Person',
                    '@id' => $base . '/#elena',
                    'name' => SITE_OWNER,
                    'jobTitle' => t('rd_dietitian'),
                    'identifier' => SITE_COLLEGIATE_NUMBER,
                    'worksFor' => ['@id' => $base . '/#business'],
                    'url' => $base . '/quienes-somos.php',
                ],
            ],
        ];
    ?>
    <script type="application/ld+json"><?= json_encode($ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
    <script>document.documentElement.classList.add('js')</script>
    <link rel="preload" href="<?= e(asset('fonts/bricolage-grotesque-latin.woff2')) ?>" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?= e(asset('fonts/instrument-sans-normal-400-latin.woff2')) ?>" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="<?= e(asset('css/fonts.css')) ?>">
    <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
</head>
<body>
<a class="skip" href="#main"><?= e(t('nav_skip', 'Saltar al contenido')) ?></a>

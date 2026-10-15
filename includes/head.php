<?php
require_once __DIR__ . '/../src/functions.php';
require_once __DIR__ . '/../src/seo.php';

$seoScript = seo_current_script();
if (count(seo_page_langs($seoScript)) === 1) force_lang(seo_page_langs($seoScript)[0]);   // landings solo en español
$seoLang   = current_lang();
$seoTitle  = trim((string)($pageTitle ?? (SITE_NAME . ' · ' . SITE_OWNER)));
if (stripos($seoTitle, SITE_NAME) === false) $seoTitle .= ' · ' . SITE_NAME;
$seoDesc   = mb_substr(trim((string)($pageDesc ?? t('hero_lead'))), 0, 300);
$seoCanon  = seo_url($seoScript, $seoLang);
$seoImage  = rtrim(SITE_CANONICAL, '/') . ($seoImage ?? SITE_OG_IMAGE);
$seoIndex  = ($seoNoindex ?? false) ? 'noindex,follow' : 'index,follow,max-image-preview:large,max-snippet:-1';
$seoFaqs = $seoReviews = [];
if ($seoScript === 'dudas.php') { [$seoFaqs] = seo_content_for_lang(); }
if ($seoScript === 'index.php') { [, $seoReviews] = seo_content_for_lang(); }
?>
<!DOCTYPE html>
<html lang="<?= e($seoLang) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($seoTitle) ?></title>
    <meta name="description" content="<?= e($seoDesc) ?>">
    <meta name="robots" content="<?= e($seoIndex) ?>">
    <meta name="theme-color" content="#744847">
    <link rel="canonical" href="<?= e($seoCanon) ?>">
    <?= seo_hreflang_links($seoScript) ?>

    <!-- Open Graph / Twitter -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
    <meta property="og:title" content="<?= e($seoTitle) ?>">
    <meta property="og:description" content="<?= e($seoDesc) ?>">
    <meta property="og:url" content="<?= e($seoCanon) ?>">
    <meta property="og:image" content="<?= e($seoImage) ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?= e(SITE_NAME . ' · ' . SITE_OWNER . ' — Nutrición clínica en Madrid') ?>">
    <meta property="og:locale" content="<?= e(seo_og_locale($seoLang)) ?>">
<?php foreach (array_keys(supported_languages()) as $l): if ($l === $seoLang) continue; ?>
    <meta property="og:locale:alternate" content="<?= e(seo_og_locale($l)) ?>">
<?php endforeach; ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($seoTitle) ?>">
    <meta name="twitter:description" content="<?= e($seoDesc) ?>">
    <meta name="twitter:image" content="<?= e($seoImage) ?>">

    <link rel="icon" href="<?= e(img('logo.png')) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,400&family=Instrument+Sans:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,400&family=Instrument+Sans:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
    <?= seo_jsonld_tag(seo_jsonld($seoScript, $seoLang, $seoFaqs, $seoReviews)) ?>
</head>
<body>
<a class="skip" href="#main"><?= e(t('nav_skip', 'Saltar al contenido')) ?></a>

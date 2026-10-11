<?php require_once __DIR__ . '/../src/functions.php'; ?>
<!DOCTYPE html>
<html lang="<?= e(current_lang()) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle ?? (SITE_NAME . ' · ' . SITE_OWNER)) ?> · <?= e(SITE_NAME) ?></title>
    <meta name="description" content="<?= e($pageDesc ?? t('hero_lead', 'Entrenamiento personal, nutrición clínica y salud en Madrid y Online con Elena Sánchez Novo.')) ?>">
    <link rel="icon" href="<?= e(img('logo.png')) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;0,9..144,700;1,9..144,400&family=Instrument+Sans:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
</head>
<body>
<a class="skip" href="#main"><?= e(t('nav_skip', 'Saltar al contenido')) ?></a>

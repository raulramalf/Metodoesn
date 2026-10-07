<?php require_once __DIR__ . '/../src/functions.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle ?? SITE_NAME) ?> · <?= e(SITE_NAME) ?></title>
    <meta name="description" content="<?= e($pageDesc ?? 'Entrenamiento personal, nutrición y salud para ayudarte a alcanzar tus objetivos de forma sostenible y adaptada a ti.') ?>">
    <link rel="icon" href="<?= e(img('logo.png')) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600&family=Instrument+Sans:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
</head>
<body>
<a class="skip" href="#main">Saltar al contenido</a>

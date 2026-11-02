<?php
require_once __DIR__ . '/../src/functions.php';
$pageTitle = t('footer_privacy', 'Política de Privacidad');
$pageDesc  = t('rd_desc_privacy');
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
?>
<main id="main">
    <?php
    $legalFile = __DIR__ . '/../includes/legal/politica-de-privacidad.' . current_lang() . '.php';
    require is_file($legalFile) ? $legalFile : __DIR__ . '/../includes/legal/politica-de-privacidad.es.php';
    ?>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

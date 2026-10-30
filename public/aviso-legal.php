<?php
require_once __DIR__ . '/../src/functions.php';
$pageTitle = t('footer_legal', 'Aviso Legal');
$pageDesc  = t('rd_desc_legal');
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
?>
<main id="main">
    <?php
    $legalFile = __DIR__ . '/../includes/legal/aviso-legal.' . current_lang() . '.php';
    require is_file($legalFile) ? $legalFile : __DIR__ . '/../includes/legal/aviso-legal.es.php';
    ?>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

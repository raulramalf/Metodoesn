<?php
require_once __DIR__ . '/../src/functions.php';
$pageTitle = t('footer_cookies', 'Política de Cookies');
$pageDesc  = t('rd_desc_cookies');
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
?>
<main id="main">
    <?php
    $legalFile = __DIR__ . '/../includes/legal/politica-de-cookies.' . current_lang() . '.php';
    require is_file($legalFile) ? $legalFile : __DIR__ . '/../includes/legal/politica-de-cookies.es.php';
    ?>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

<?php
/** Selector de idioma (patrón "disclosure": botón + lista de enlaces, mejorado con flechas/Esc en main.js). */
function render_lang_dropdown(string $variant): void {
    $id = 'lang-menu-' . $variant;
    $labels = ['es' => 'Español', 'en' => 'English', 'de' => 'Deutsch'];
    $aria = ['es' => 'Idioma', 'en' => 'Language', 'de' => 'Sprache'][current_lang()];
    ?>
    <div class="lang-dropdown" id="lang-dropdown-<?= e($variant) ?>">
        <button class="lang-dropdown-trigger" type="button" aria-expanded="false" aria-controls="<?= e($id) ?>" aria-label="<?= e(strtoupper(current_lang())) ?> — <?= e($aria) ?>: <?= e($labels[current_lang()]) ?>">
            <?= flag_svg(current_lang(), 16, 12) ?>
            <span class="lang-current-code"><?= strtoupper(current_lang()) ?></span>
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lang-chevron-icon" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
        </button>
        <ul class="lang-dropdown-menu" id="<?= e($id) ?>" aria-label="<?= e($aria) ?>">
            <?php foreach ($labels as $code => $name): ?>
            <li>
                <a href="<?= e(lang_url($code)) ?>" class="lang-menu-item <?= current_lang() === $code ? 'is-active' : '' ?>" lang="<?= e($code) ?>" hreflang="<?= e($code) ?>"<?= current_lang() === $code ? ' aria-current="true"' : '' ?>>
                    <?= flag_svg($code, 18, 13) ?>
                    <span class="lang-name"><?= e($name) ?></span>
                    <span class="lang-tag" aria-hidden="true"><?= strtoupper($code) ?></span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php
}
?>
<header class="site-header" id="site-header">
    <div class="wrap header-inner">
        <a href="<?= e(page_url('/index.php')) ?>" class="brand" aria-label="<?= e(SITE_NAME . ' ' . SITE_OWNER) ?> — <?= e(t('nav_home')) ?>">
            <img src="<?= e(img('logo.png')) ?>" alt="<?= e(SITE_NAME) ?>" width="42" height="42">
            <div class="brand-name">
                <span class="brand-title"><?= e(SITE_NAME) ?></span>
                <span class="brand-sub"><?= e(SITE_OWNER) ?></span>
            </div>
        </a>

        <div class="header-actions-mobile">
            <!-- Selector de idiomas sutil desplegable en cabecera móvil -->
            <?php render_lang_dropdown('mobile'); ?>

            <button class="nav-toggle" id="nav-toggle" aria-label="<?= e(t('nav_menu_toggle', 'Abrir menú de navegación')) ?>" aria-expanded="false" aria-controls="nav-menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <nav class="nav" id="nav-menu" aria-label="<?= e(t('nav_home')) ?>">
            <ul class="nav-links">
                <li><a href="<?= e(page_url('/index.php')) ?>" class="<?= nav_class('index.php') ?>"><?= e(t('nav_home')) ?></a></li>
                <li><a href="<?= e(page_url('/quienes-somos.php')) ?>" class="<?= nav_class('quienes-somos.php') ?>"><?= e(t('nav_about')) ?></a></li>
                <li><a href="<?= e(page_url('/servicios.php')) ?>" class="<?= nav_class('servicios.php') ?>"><?= e(t('nav_services')) ?></a></li>
                <li><a href="<?= e(page_url('/dudas.php')) ?>" class="<?= nav_class('dudas.php') ?>"><?= e(t('nav_faq')) ?></a></li>
                <li><a href="<?= e(page_url('/contacto.php')) ?>" class="<?= nav_class('contacto.php') ?>"><?= e(t('nav_contact')) ?></a></li>
            </ul>

            <div class="nav-cta-group">
                <!-- Selector de idiomas sutil desplegable en desktop -->
                <?php render_lang_dropdown('desktop'); ?>

                <a href="<?= e(page_url('/reserva-de-citas.php')) ?>" class="btn btn-sm">
                    <span><?= e(t('nav_book')) ?></span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </nav>
    </div>
</header>

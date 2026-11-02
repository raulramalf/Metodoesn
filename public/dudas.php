<?php
require_once __DIR__ . '/../src/functions.php';
$pageTitle = t('faq_page_title', 'Preguntas frecuentes · Dudas resueltas');
$pageDesc  = t('faq_lead', 'Preguntas frecuentes sobre el Método ESN: primera consulta, planes de nutrición, entrenamiento de fuerza, citas online y patologías.');
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">

    <!-- CABECERA DE FAQS CON BUSCADOR -->
    <section class="wrap section page-head page-hero">
        <div>
            <p class="kicker"><?= e(t('faq_kicker')) ?></p>
            <h1><?= e(t('faq_title')) ?></h1>
            <p class="lead">
                <?= e(t('faq_lead')) ?>
            </p>

            <div class="faq-search-box">
                <div class="search-input-wrap">
                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input type="search" id="faq-search-input" class="search-field" placeholder="<?= e(t('faq_search_placeholder')) ?>" aria-label="<?= e(t('rd_search_label')) ?>" data-found-one="<?= e(t('rd_js_found_one')) ?>" data-found-many="<?= e(t('rd_js_found_many')) ?>">
                </div>
                <p id="faq-search-count" class="faq-search-count" aria-live="polite"></p>
            </div>
        </div>
        <div class="page-hero-media">
            <img src="<?= e(img('foto-descanso.webp')) ?>" alt="<?= e(t('alt_descanso')) ?>" width="1100" height="1399" fetchpriority="high">
        </div>
    </section>

    <!-- ACORDEÓN DE PREGUNTAS FRECUENTES -->
    <section class="wrap page-body">
        <div class="faq-wrap" id="faq-full-list">
            <?php foreach ($faqs as $i => [$pregunta, $respuesta]): ?>
                <div class="faq-card <?= $i === 0 ? 'is-open' : '' ?>" data-query="<?= htmlspecialchars(mb_strtolower($pregunta . ' ' . $respuesta), ENT_QUOTES) ?>">
                    <button class="faq-trigger" type="button" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>">
                        <span><?= e($pregunta) ?></span>
                        <span class="faq-toggle-icon" aria-hidden="true">+</span>
                    </button>
                    <div class="faq-content">
                        <div class="faq-content-inner">
                            <p><?= e($respuesta) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Mensaje sin resultados -->
            <div id="faq-no-results" class="faq-no-results" hidden>
                <h2><?= e(t('dudas_029')) ?></h2>
                <p><?= e(t('dudas_030')) ?></p>
                <a href="<?= e(page_url('/contacto.php')) ?>" class="btn btn-sm"><?= e(t('btn_contact')) ?></a>
            </div>
        </div>
    </section>

    <!-- CTA FINAL DE DUDAS -->
    <section class="section cta">
        <div class="wrap cta-grid">
            <div class="cta-body">
                <h2><?= e(t('dudas_031')) ?></h2>
                <p class="cta-lead"><?= e(t('dudas_032')) ?></p>
                <div class="actions">
                    <a class="btn btn-dark btn-lg" href="<?= e(page_url('/contacto.php')) ?>"><?= e(t('btn_contact')) ?></a>
                    <a class="btn btn-outline-dark btn-lg" href="<?= e(page_url('/reserva-de-citas.php')) ?>"><?= e(t('btn_book_now')) ?></a>
                </div>
            </div>
            <div class="cta-media">
                <img src="<?= e(img('foto-bowl.webp')) ?>" alt="<?= e(t('alt_bowl')) ?>" width="1200" height="1200" loading="lazy">
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

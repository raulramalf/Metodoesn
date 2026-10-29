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
    <section class="wrap section" style="padding-bottom: 2rem;">
        <div class="wrap-narrow text-center">
            <p class="kicker"><?= e(t('faq_kicker')) ?></p>
            <h1><?= e(t('faq_title')) ?></h1>
            <p class="lead lead-centered" style="margin-bottom: 2rem;">
                <?= e(t('faq_lead')) ?>
            </p>

            <div class="faq-search-box">
                <div class="search-input-wrap">
                    <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input type="search" id="faq-search-input" class="search-field" placeholder="<?= e(t('faq_search_placeholder')) ?>" aria-label="Search FAQ">
                </div>
                <p id="faq-search-count" style="font-size:0.88rem; color:var(--ink-soft); margin-top:0.6rem;" aria-live="polite"></p>
            </div>
        </div>
    </section>

    <!-- ACORDEÓN DE PREGUNTAS FRECUENTES -->
    <section class="wrap" style="margin-bottom: 5rem;">
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
            <div id="faq-no-results" style="display:none; text-align:center; padding: 3rem 1.5rem; background:#ffffff; border:1px solid var(--line); border-radius:var(--radius);">
                <h3><?= e(t('dudas_029')) ?></h3>
                <p style="color:var(--ink-soft); margin-top:0.5rem;"><?= e(t('dudas_030')) ?></p>
                <a href="<?= e(page_url('/contacto.php')) ?>" class="btn btn-sm" style="margin-top:1rem;"><?= e(t('btn_contact')) ?></a>
            </div>
        </div>
    </section>

    <!-- CTA FINAL DE DUDAS -->
    <section class="band">
        <div class="wrap section text-center">
            <div class="wrap-narrow">
                <h2><?= e(t('dudas_031')) ?></h2>
                <p class="lead lead-centered" style="margin-bottom: 2rem;">
                    <?= e(t('dudas_032')) ?>
                </p>
                <div style="display:flex; justify-content:center; gap:1rem; flex-wrap:wrap;">
                    <a class="btn" href="<?= e(page_url('/contacto.php')) ?>"><?= e(t('btn_contact')) ?></a>
                    <a class="btn btn-ghost" href="<?= e(page_url('/reserva-de-citas.php')) ?>"><?= e(t('btn_book_now')) ?></a>
                </div>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

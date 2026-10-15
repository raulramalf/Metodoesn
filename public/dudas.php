<?php
require_once __DIR__ . '/../src/functions.php';
$pageTitle = t('seo_faq_title');
$pageDesc  = t('seo_faq_desc');
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main" tabindex="-1">

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
                    <input type="search" id="faq-search-input" class="search-field" placeholder="<?= e(t('faq_search_placeholder')) ?>" aria-label="<?= e(t('faq_search_placeholder')) ?>" aria-controls="faq-full-list" autocomplete="off" enterkeyhint="search">
                </div>
                <p id="faq-search-count" style="font-size:0.88rem; color:var(--ink-soft); margin-top:0.6rem; min-height:1.4em;" role="status" aria-live="polite" aria-atomic="true"
                   data-one="<?= e(current_lang() === 'en' ? '1 question found' : (current_lang() === 'de' ? '1 Frage gefunden' : '1 pregunta encontrada')) ?>"
                   data-many="<?= e(current_lang() === 'en' ? '{n} questions found' : (current_lang() === 'de' ? '{n} Fragen gefunden' : '{n} preguntas encontradas')) ?>"
                   data-none="<?= e(current_lang() === 'en' ? 'No questions match your search' : (current_lang() === 'de' ? 'Keine passenden Fragen gefunden' : 'Ninguna pregunta coincide con tu búsqueda')) ?>"></p>
            </div>
        </div>
    </section>

    <!-- ACORDEÓN DE PREGUNTAS FRECUENTES -->
    <section class="wrap" style="margin-bottom: 5rem;">
        <div class="faq-wrap" id="faq-full-list">
            <?php foreach ($faqs as $i => [$pregunta, $respuesta]): ?>
                <div class="faq-card <?= $i === 0 ? 'is-open' : '' ?>" data-query="<?= htmlspecialchars(mb_strtolower($pregunta . ' ' . $respuesta), ENT_QUOTES) ?>">
                    <button class="faq-trigger" type="button" id="faq-q-<?= $i ?>" aria-expanded="<?= $i === 0 ? 'true' : 'false' ?>" aria-controls="faq-a-<?= $i ?>">
                        <span><?= e($pregunta) ?></span>
                        <span class="faq-toggle-icon" aria-hidden="true">+</span>
                    </button>
                    <div class="faq-content" id="faq-a-<?= $i ?>" role="region" aria-labelledby="faq-q-<?= $i ?>">
                        <div class="faq-content-inner">
                            <p><?= e($respuesta) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Mensaje sin resultados -->
            <div id="faq-no-results" hidden style=" text-align:center; padding: 3rem 1.5rem; background:#ffffff; border:1px solid var(--line); border-radius:var(--radius);">
                <h3><?= e(current_lang() === 'en' ? 'No matching questions found' : (current_lang() === 'de' ? 'Keine passenden Fragen gefunden' : 'No hemos encontrado preguntas con esa búsqueda')) ?></h3>
                <p style="color:var(--ink-soft); margin-top:0.5rem;"><?= e(current_lang() === 'en' ? 'Would you like to ask us directly?' : (current_lang() === 'de' ? 'Möchten Sie uns direkt kontaktieren?' : '¿Prefieres consultarnos directamente por tu caso?')) ?></p>
                <a href="<?= e(page_url('/contacto.php')) ?>" class="btn btn-sm" style="margin-top:1rem;"><?= e(t('btn_contact')) ?></a>
            </div>
        </div>
    </section>

    <!-- CTA FINAL DE DUDAS -->
    <section class="band">
        <div class="wrap section text-center">
            <div class="wrap-narrow">
                <h2><?= e(current_lang() === 'en' ? 'Do you have a specific question not listed here?' : (current_lang() === 'de' ? 'Haben Sie eine spezifische Frage, die hier nicht aufgeführt ist?' : '¿Tienes una pregunta específica que no aparece aquí?')) ?></h2>
                <p class="lead lead-centered" style="margin-bottom: 2rem;">
                    <?= e(current_lang() === 'en' ? 'Contact us with zero obligation. We will review your situation and advise you honestly.' : (current_lang() === 'de' ? 'Schreiben Sie uns unverbindlich. Wir prüfen Ihre Situation und beraten Sie ehrlich.' : 'Escríbenos sin compromiso. Analizaremos tu situación y te orientaremos con total sinceridad sobre si el Método ESN es el camino idóneo para ti.')) ?>
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

<?php
require_once __DIR__ . '/../src/functions.php';
$pageTitle = t('services_page_title', 'Servicios · Nutrición y Entrenamiento');
$pageDesc  = t('services_lead', 'Entrenamiento, nutrición clínica y acompañamiento forman parte de un mismo proceso individualizado.');
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">

    <!-- CABECERA DE SERVICIOS -->
    <section class="wrap section page-hero">
        <div>
            <p class="kicker"><?= e(t('services_kicker')) ?></p>
            <h1><?= e(t('services_title')) ?></h1>
            <p class="lead"><?= e(t('services_lead')) ?></p>
            <div class="actions">
                <a class="btn" href="<?= e(page_url('/reserva-de-citas.php')) ?>"><span><?= e(t('btn_book_now')) ?></span></a>
                <a class="btn btn-ghost" href="#modalidades"><?= e(t('servicios_090')) ?></a>
            </div>
        </div>
        <div class="page-hero-media">
            <img src="<?= e(img('foto-mancuerna.webp')) ?>" alt="<?= e(t('alt_mancuerna')) ?>" width="1400" height="933" fetchpriority="high">
        </div>
    </section>

    <!-- LOS TRES PILARES DEL SERVICIO -->
    <section class="band">
        <div class="wrap section">
            <div class="section-heading text-center">
                <p class="kicker"><?= e(t('servicios_081')) ?></p>
                <h2><?= e(t('servicios_082')) ?></h2>
                <p class="lead lead-centered"><?= e(t('servicios_083')) ?></p>
            </div>

            <div class="service-pillars-grid">
                <article class="pillar-card has-img">
                    <div class="pillar-img"><img src="<?= e(img('foto-fuerza.webp')) ?>" alt="<?= e(t('alt_fuerza')) ?>" loading="lazy" width="1400" height="935"></div>
                    <div class="pillar-body">
                        <h3><?= e(t('servicios_084')) ?></h3>
                        <p><?= e(t('servicios_085')) ?></p>
                    </div>
                </article>

                <article class="pillar-card has-img">
                    <div class="pillar-img"><img src="<?= e(img('foto-salmon.webp')) ?>" alt="<?= e(t('alt_salmon')) ?>" loading="lazy" width="1400" height="933"></div>
                    <div class="pillar-body">
                        <h3><?= e(t('servicios_086')) ?></h3>
                        <p><?= e(t('servicios_087')) ?></p>
                    </div>
                </article>

                <article class="pillar-card has-img">
                    <div class="pillar-img"><img src="<?= e(img('foto-planificacion.webp')) ?>" alt="<?= e(t('alt_planificacion')) ?>" loading="lazy" width="1200" height="1600"></div>
                    <div class="pillar-body">
                        <h3><?= e(t('servicios_088')) ?></h3>
                        <p><?= e(t('servicios_089')) ?></p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- MODALIDADES: PRESENCIAL VS ONLINE -->
    <section class="wrap section pb-tight" id="modalidades">
        <div class="section-heading text-center">
            <p class="kicker"><?= e(t('servicios_090')) ?></p>
            <h2><?= e(t('servicios_091')) ?></h2>
            <p class="lead lead-centered"><?= e(t('servicios_092')) ?></p>
        </div>

        <div class="modes-grid">
            <!-- Modalidad Presencial -->
            <div class="mode-card is-featured">
                <div class="mode-header">
                    <span class="mode-badge"><?= e(t('services_badge_clinic')) ?></span>
                    <strong style="color:var(--moss);"><?= e(t('services_presential')) ?></strong>
                </div>
                <h3><?= e(t('services_presential')) ?></h3>
                <p><?= e(t('servicios_093')) ?></p>
                
                <ul class="mode-features">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><strong><?= e(t('servicios_094')) ?></strong> <?= e(t('servicios_095')) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(t('servicios_096')) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(t('servicios_097')) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(t('servicios_098')) ?></span>
                    </li>
                </ul>

                <a href="<?= e(page_url('/reserva-de-citas.php')) ?>" class="btn" style="margin-top:auto;">
                    <span><?= e(t('servicios_099')) ?></span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>

            <!-- Modalidad Online -->
            <div class="mode-card">
                <div class="mode-header">
                    <span class="mode-badge"><?= e(t('servicios_100')) ?></span>
                    <strong style="color:var(--ink-soft);"><?= e(t('services_online')) ?></strong>
                </div>
                <h3><?= e(t('services_online')) ?></h3>
                <p><?= e(t('servicios_101')) ?></p>

                <ul class="mode-features">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(t('servicios_102')) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(t('servicios_103')) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(t('servicios_104')) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(t('servicios_105')) ?></span>
                    </li>
                </ul>

                <a href="<?= e(page_url('/reserva-de-citas.php')) ?>" class="btn btn-ghost" style="margin-top:auto;">
                    <span><?= e(t('servicios_106')) ?></span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA FINAL DE SERVICIOS -->
    <section class="section cta">
        <div class="wrap cta-grid">
            <div class="cta-body">
                <h2><?= e(t('cta_title')) ?></h2>
                <p class="cta-lead"><?= e(t('cta_lead')) ?></p>
                <div class="actions">
                    <a class="btn btn-dark btn-lg" href="<?= e(page_url('/reserva-de-citas.php')) ?>"><span><?= e(t('btn_book_now')) ?></span></a>
                    <a class="btn btn-outline-dark btn-lg" href="<?= e(page_url('/contacto.php')) ?>"><?= e(t('btn_contact')) ?></a>
                </div>
            </div>
            <div class="cta-media">
                <img src="<?= e(img('foto-montana.webp')) ?>" alt="<?= e(t('alt_montana')) ?>" width="800" height="1200" loading="lazy">
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

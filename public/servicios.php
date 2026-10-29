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
    <section class="wrap section">
        <div class="wrap-narrow text-center">
            <p class="kicker"><?= e(t('services_kicker')) ?></p>
            <h1><?= e(t('services_title')) ?></h1>
            <p class="lead lead-centered">
                <?= e(t('services_lead')) ?>
            </p>
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
                <article class="pillar-card">
                    <div class="pillar-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6.5 6.5 A5.5 5.5 0 0 1 17.5 6.5"/>
                            <line x1="12" y1="2" x2="12" y2="5"/>
                            <polyline points="6 12 10 16 18 8"/>
                            <circle cx="12" cy="12" r="10"/>
                        </svg>
                    </div>
                    <h3><?= e(t('servicios_084')) ?></h3>
                    <p><?= e(t('servicios_085')) ?></p>
                </article>

                <article class="pillar-card">
                    <div class="pillar-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2z"/>
                            <path d="M12 6v6l4 2"/>
                        </svg>
                    </div>
                    <h3><?= e(t('servicios_086')) ?></h3>
                    <p><?= e(t('servicios_087')) ?></p>
                </article>

                <article class="pillar-card">
                    <div class="pillar-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h3><?= e(t('servicios_088')) ?></h3>
                    <p><?= e(t('servicios_089')) ?></p>
                </article>
            </div>
        </div>
    </section>

    <!-- MODALIDADES: PRESENCIAL VS ONLINE -->
    <section class="wrap section">
        <div class="section-heading text-center">
            <p class="kicker"><?= e(t('servicios_090')) ?></p>
            <h2><?= e(t('servicios_091')) ?></h2>
            <p class="lead lead-centered"><?= e(t('servicios_092')) ?></p>
        </div>

        <div class="modes-grid">
            <!-- Modalidad Presencial -->
            <div class="mode-card is-featured">
                <div class="mode-header">
                    <span class="mode-badge">Madrid Clinic</span>
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
    <section class="wrap section">
        <div class="cta-luxury-banner">
            <div class="cta-luxury-glow" aria-hidden="true"></div>
            <div class="cta-luxury-body">
                <h2><?= e(t('cta_title')) ?></h2>
                <p><?= e(t('cta_lead')) ?></p>
                <div class="actions">
                    <a class="btn btn-white" href="<?= e(page_url('/reserva-de-citas.php')) ?>"><?= e(t('btn_book_now')) ?></a>
                    <a class="btn btn-ghost-white" href="<?= e(page_url('/contacto.php')) ?>"><?= e(t('btn_contact')) ?></a>
                </div>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

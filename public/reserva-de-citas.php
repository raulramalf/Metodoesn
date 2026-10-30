<?php
require_once __DIR__ . '/../src/functions.php';
$pageTitle = t('booking_page_title', 'Reserva de citas · Agenda en vivo');
$pageDesc  = t('booking_lead', 'Reserva tu cita con Elena Sánchez Novo a través de nuestra agenda oficial en Doctoralia.');
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
?>
<main id="main">

    <!-- CABECERA DE RESERVA -->
    <section class="wrap section" style="padding-bottom: 2rem;">
        <div class="wrap-narrow text-center">
            <p class="kicker"><?= e(t('booking_kicker')) ?></p>
            <h1><?= e(t('booking_title')) ?></h1>
            <p class="lead lead-centered">
                <?= e(t('booking_lead')) ?>
            </p>
        </div>
    </section>

    <!-- 3 PASOS EXPLICATIVOS -->
    <section class="wrap" style="margin-bottom: 3rem;">
        <div class="booking-steps-strip">
            <div class="booking-step-item">
                <div class="booking-step-index">1</div>
                <div>
                    <strong><?= e(t('reserva_de_citas_071')) ?></strong>
                    <p><?= e(t('reserva_de_citas_072')) ?></p>
                </div>
            </div>
            <div class="booking-step-item">
                <div class="booking-step-index">2</div>
                <div>
                    <strong><?= e(t('reserva_de_citas_073')) ?></strong>
                    <p><?= e(t('reserva_de_citas_074')) ?></p>
                </div>
            </div>
            <div class="booking-step-item">
                <div class="booking-step-index">3</div>
                <div>
                    <strong><?= e(t('reserva_de_citas_075')) ?></strong>
                    <p><?= e(t('reserva_de_citas_076')) ?></p>
                </div>
            </div>
        </div>

        <!-- CONTENEDOR DEL WIDGET OFICIAL DE DOCTORALIA -->
        <div class="booking-frame-wrap">
            <div class="booking-frame-header">
                <div class="booking-live-indicator">
                    <span class="live-dot" aria-hidden="true"></span>
                    <span>Doctoralia · Elena Sánchez Novo</span>
                </div>
                <a href="<?= e(BOOKING_URL) ?>" target="_blank" rel="noopener" class="btn btn-sm btn-ghost">
                    <span><?= e(t('reserva_de_citas_077')) ?></span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>
            </div>

            <div class="booking-widget-inner" id="doctoralia-widget-area">
                <p data-consent-note hidden><?= e(t('consent_booking_note')) ?></p>
                <a id="zl-url" class="zl-url" href="https://www.doctoralia.es/elena-sanchez-novo/dietista-nutricionista/madrid" rel="nofollow" data-zlw-doctor="elena-sanchez-novo" data-zlw-type="big_with_calendar" data-zlw-opinion="false" data-zlw-hide-branding="true" data-zlw-saas-only="true" data-zlw-a11y-title="Doctoralia Calendar">Reserve una cita</a>
                <script type="text/plain" data-consent="thirdparty">!function($_x,_s,id){var js,fjs=$_x.getElementsByTagName(_s)[0];if(!$_x.getElementById(id)){js = $_x.createElement(_s);js.id = id;js.src = "//platform.docplanner.com/js/widget.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","zl-widget-s");</script>
            </div>

            <div class="booking-fallback-bar">
                <span><?= e(t('reserva_de_citas_078')) ?></span>
                <a href="<?= e(BOOKING_URL) ?>" target="_blank" rel="noopener" class="btn btn-sm"><?= e(t('btn_doctoralia_profile')) ?> →</a>
            </div>
        </div>

        <!-- TARJETA DE ASISTENCIA PREVIA -->
        <div style="margin-top: 3rem; background: var(--mist); border: 1px solid var(--line); border-radius: var(--radius); padding: 2rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <h3 style="margin-bottom: 0.3rem;"><?= e(t('reserva_de_citas_079')) ?></h3>
                <p style="color: var(--ink-soft); font-size: 0.95rem; margin: 0;"><?= e(t('reserva_de_citas_080')) ?></p>
            </div>
            <div style="display: flex; gap: 0.8rem; flex-wrap: wrap;">
                <a href="<?= e(page_url('/contacto.php')) ?>" class="btn btn-sm btn-ghost"><?= e(t('btn_contact')) ?></a>
                <a href="tel:<?= e(SITE_PHONE_LINK) ?>" class="btn btn-sm"><?= e(SITE_PHONE) ?></a>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

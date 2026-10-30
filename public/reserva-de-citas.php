<?php
require_once __DIR__ . '/../src/functions.php';
$pageTitle = t('booking_page_title', 'Reserva de citas · Agenda en vivo');
$pageDesc  = t('booking_lead', 'Reserva tu cita con Elena Sánchez Novo a través de nuestra agenda oficial en Doctoralia.');
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
?>
<main id="main">

    <!-- CABECERA DE RESERVA -->
    <section class="booking-hero">
        <div class="wrap booking-hero-grid">
            <div class="booking-hero-text">
                <p class="booking-hero-kicker"><span class="live-dot" aria-hidden="true"></span><?= e(t('booking_kicker')) ?></p>
                <h1><?= e(t('booking_title')) ?></h1>
                <p class="booking-hero-lead"><?= e(t('booking_lead')) ?></p>
                <ul class="booking-hero-chips">
                    <li><?= e(t('services_presential')) ?></li>
                    <li><?= e(t('services_online')) ?></li>
                    <li><?= e(sprintf(t('rd_col'), SITE_COLLEGIATE_NUMBER)) ?></li>
                </ul>
                <a class="btn btn-light btn-lg" href="#agenda"><span><?= e(t('reserva_de_citas_073')) ?></span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><polyline points="19 12 12 19 5 12"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- 3 PASOS EXPLICATIVOS -->
    <section class="wrap page-body booking-body">
        <ol class="booking-steps-strip">
            <li class="booking-step-item">
                <span class="booking-step-index">1</span>
                <strong><?= e(t('reserva_de_citas_071')) ?></strong>
                <p><?= e(t('reserva_de_citas_072')) ?></p>
            </li>
            <li class="booking-step-item">
                <span class="booking-step-index">2</span>
                <strong><?= e(t('reserva_de_citas_073')) ?></strong>
                <p><?= e(t('reserva_de_citas_074')) ?></p>
            </li>
            <li class="booking-step-item">
                <span class="booking-step-index">3</span>
                <strong><?= e(t('reserva_de_citas_075')) ?></strong>
                <p><?= e(t('reserva_de_citas_076')) ?></p>
            </li>
        </ol>

        <!-- CONTENEDOR DEL WIDGET OFICIAL DE DOCTORALIA -->
        <div class="booking-frame-wrap" id="agenda">
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
        <div class="assist-card">
            <img class="assist-img" src="<?= e(img('clinica.jpeg')) ?>" alt="<?= e(t('alt_despacho')) ?>" width="600" height="400" loading="lazy">
            <div class="assist-text">
                <h2><?= e(t('reserva_de_citas_079')) ?></h2>
                <p><?= e(t('reserva_de_citas_080')) ?></p>
            </div>
            <div class="assist-actions">
                <a href="<?= e(page_url('/contacto.php')) ?>" class="btn btn-sm btn-ghost"><?= e(t('btn_contact')) ?></a>
                <a href="tel:<?= e(SITE_PHONE_LINK) ?>" class="btn btn-sm"><?= e(SITE_PHONE) ?></a>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

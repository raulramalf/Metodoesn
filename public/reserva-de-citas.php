<?php
require_once __DIR__ . '/../src/functions.php';
$pageTitle = t('seo_booking_title');
$pageDesc  = t('seo_booking_desc');
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
?>
<main id="main" tabindex="-1">

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
                    <strong><?= e(current_lang() === 'en' ? 'Select consultation type' : (current_lang() === 'de' ? 'Beratungsform wählen' : 'Elige tu modalidad')) ?></strong>
                    <p><?= e(current_lang() === 'en' ? 'In-person at Clínica SurgEOM (Madrid) or 100% online video consultation.' : (current_lang() === 'de' ? 'Vor Ort in der Clínica SurgEOM (Madrid) oder 100% online per Video.' : 'Presencial en Clínica SurgEOM (Madrid) o 100% online por videollamada.')) ?></p>
                </div>
            </div>
            <div class="booking-step-item">
                <div class="booking-step-index">2</div>
                <div>
                    <strong><?= e(current_lang() === 'en' ? 'Choose date & time' : (current_lang() === 'de' ? 'Datum & Uhrzeit wählen' : 'Selecciona día y hora')) ?></strong>
                    <p><?= e(current_lang() === 'en' ? 'Live updated availability. Pick the timeslot that fits your schedule.' : (current_lang() === 'de' ? 'Live synchronisierte Verfügbarkeit. Wählen Sie Ihren Wunschtermin.' : 'Disponibilidad actualizada en directo. Elige el hueco que prefieras.')) ?></p>
                </div>
            </div>
            <div class="booking-step-item">
                <div class="booking-step-index">3</div>
                <div>
                    <strong><?= e(current_lang() === 'en' ? 'Instant confirmation' : (current_lang() === 'de' ? 'Sofortige Bestätigung' : 'Confirmación inmediata')) ?></strong>
                    <p><?= e(current_lang() === 'en' ? 'You will receive an email confirmation and calendar invite with session details.' : (current_lang() === 'de' ? 'Sie erhalten eine Bestätigungs-E-Mail und Termindetails.' : 'Recibirás un email y recordatorio con los detalles de tu sesión.')) ?></p>
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
                    <span><?= e(current_lang() === 'en' ? 'Open full calendar' : (current_lang() === 'de' ? 'Vollständigen Kalender öffnen' : 'Abrir agenda completa')) ?></span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>
            </div>

            <div class="booking-widget-inner" id="doctoralia-widget-area">
                <a id="zl-url" class="zl-url" href="https://www.doctoralia.es/elena-sanchez-novo/dietista-nutricionista/madrid" rel="nofollow" data-zlw-doctor="elena-sanchez-novo" data-zlw-type="big_with_calendar" data-zlw-opinion="false" data-zlw-hide-branding="true" data-zlw-saas-only="true" data-zlw-a11y-title="Doctoralia Calendar">Reserve una cita</a>
                <script nonce="<?= e(csp_nonce()) ?>">!function($_x,_s,id){var js,fjs=$_x.getElementsByTagName(_s)[0];if(!$_x.getElementById(id)){js = $_x.createElement(_s);js.id = id;js.src = "//platform.docplanner.com/js/widget.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","zl-widget-s");</script>
            </div>

            <div class="booking-fallback-bar">
                <span><?= e(current_lang() === 'en' ? 'Is the calendar not rendering in your browser? Open directly:' : (current_lang() === 'de' ? 'Wird der Kalender nicht geladen? Direkt auf Doctoralia öffnen:' : '¿No se carga el calendario en tu navegador? Puedes acceder directamente a la agenda oficial:')) ?></span>
                <a href="<?= e(BOOKING_URL) ?>" target="_blank" rel="noopener" class="btn btn-sm"><?= e(t('btn_doctoralia_profile')) ?> →</a>
            </div>
        </div>

        <!-- TARJETA DE ASISTENCIA PREVIA -->
        <div style="margin-top: 3rem; background: var(--mist); border: 1px solid var(--line); border-radius: var(--radius); padding: 2rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <h2 style="margin-bottom: 0.3rem; font-size: 1.35rem;"><?= e(current_lang() === 'en' ? 'Not sure which service to choose?' : (current_lang() === 'de' ? 'Unsicher, welches Format zu Ihnen passt?' : '¿Tienes dudas sobre qué servicio elegir?')) ?></h2>
                <p style="color: var(--ink-soft); font-size: 0.95rem; margin: 0;"><?= e(current_lang() === 'en' ? 'Message or call us directly and we will advise you with zero obligation.' : (current_lang() === 'de' ? 'Schreiben oder rufen Sie uns an – wir beraten Sie unverbindlich.' : 'Escríbenos directamente o llámanos y te orientaremos sin ningún compromiso.')) ?></p>
            </div>
            <div style="display: flex; gap: 0.8rem; flex-wrap: wrap;">
                <a href="<?= e(page_url('/contacto.php')) ?>" class="btn btn-sm btn-ghost"><?= e(t('btn_contact')) ?></a>
                <a href="tel:<?= e(SITE_PHONE_LINK) ?>" class="btn btn-sm"><?= e(SITE_PHONE) ?></a>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

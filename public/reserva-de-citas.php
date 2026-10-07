<?php
$pageTitle = 'Reserva de citas';
$pageDesc  = 'Reserva tu cita con Elena Sánchez Novo a través de nuestra agenda oficial en Doctoralia. Elige el día, la hora y la modalidad (presencial u online).';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
?>
<main id="main">
    <section class="wrap section">
        <!-- Encabezado de la página -->
        <div class="booking-header">
            <p class="kicker reveal">Agenda tu sesión</p>
            <h1 class="reveal" style="--delay:80ms">Reserva tu cita</h1>
            <p class="lead reveal" style="--delay:160ms">
                Selecciona la modalidad, el día y la hora que mejor se adapten a tu ritmo. La reserva se sincroniza directamente en tiempo real con nuestra agenda oficial.
            </p>
        </div>

        <!-- 3 Pasos rápidos explicativos -->
        <div class="booking-steps reveal" style="--delay:220ms">
            <div class="booking-step">
                <div class="booking-step-num">1</div>
                <div>
                    <strong>Elige tu modalidad</strong>
                    <p>Consulta presencial en clínica (Madrid) o 100% online por videollamada.</p>
                </div>
            </div>
            <div class="booking-step">
                <div class="booking-step-num">2</div>
                <div>
                    <strong>Selecciona día y hora</strong>
                    <p>Accede a la disponibilidad en vivo y elige el hueco que prefieras.</p>
                </div>
            </div>
            <div class="booking-step">
                <div class="booking-step-num">3</div>
                <div>
                    <strong>Confirmación inmediata</strong>
                    <p>Recibirás un recordatorio con todos los detalles de tu cita.</p>
                </div>
            </div>
        </div>

        <!-- Contenedor del Widget incrustado de Doctoralia -->
        <div class="booking-widget-wrapper reveal" style="--delay:280ms">
            <div class="booking-widget-bar">
                <div class="booking-widget-status">
                    <span class="status-dot" aria-hidden="true"></span>
                    <span>Agenda en vivo sincronizada con <strong>Doctoralia</strong></span>
                </div>
                <a href="<?= e(BOOKING_URL) ?>" target="_blank" rel="noopener" class="booking-direct-link" title="Abrir en pestaña nueva">
                    <span>Abrir en Doctoralia</span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                        <polyline points="15 3 21 3 21 9"/>
                        <line x1="10" y1="14" x2="21" y2="3"/>
                    </svg>
                </a>
            </div>

            <!-- Código oficial del Widget de Doctoralia incrustado -->
            <div class="booking-widget-content" id="doctoralia-widget-area">
                <a id="zl-url" class="zl-url" href="<?= e(BOOKING_URL) ?>" rel="nofollow" data-zlw-doctor="elena-sanchez-novo" data-zlw-type="big_with_calendar" data-zlw-opinion="false" data-zlw-hide-branding="true">
                    Elena Sánchez Novo - Doctoralia.es
                </a>
                <script>
                    !function($_x,_s,id){var js,fjs=$_x.getElementsByTagName(_s)[0];if(!$_x.getElementById(id)){js = $_x.createElement(_s);js.id = id;js.src = '//platform.docplanner.com/js/widget/platform.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'zl-widget-s');
                </script>
            </div>

            <!-- Respaldo / fallback directo por si bloqueadores de publicidad o scripts restringen el widget -->
            <div class="booking-widget-fallback">
                <p>¿No se visualiza correctamente el calendario en tu navegador? Puedes acceder directamente a la agenda completa de Elena en Doctoralia:</p>
                <a class="btn btn-sm" href="<?= e(BOOKING_URL) ?>" target="_blank" rel="noopener">
                    <span>Acceder a la agenda de Doctoralia</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Bloque de atención alternativa -->
        <div class="booking-help reveal" style="--delay:340ms">
            <div class="booking-help-card">
                <div class="booking-help-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>
                <div>
                    <h3>¿Tienes dudas sobre qué servicio reservar?</h3>
                    <p>Si no estás seguro de si necesitas nutrición, entrenamiento personal o ambos, puedes escribirnos previamente sin compromiso y te orientaremos.</p>
                </div>
                <div class="booking-help-actions">
                    <a class="btn btn-ghost" href="/contacto.php">Escríbenos una duda</a>
                    <a class="btn btn-ghost" href="tel:<?= e(SITE_PHONE_LINK) ?>">Llamar: <?= e(SITE_PHONE) ?></a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

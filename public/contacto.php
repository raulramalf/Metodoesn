<?php
require __DIR__ . '/../src/functions.php';
require __DIR__ . '/../src/Database.php';

$pageTitle = t('seo_contact_title');
$pageDesc  = t('seo_contact_desc');

$errors = [];
$ok = false;
$old = ['nombre' => '', 'email' => '', 'mensaje' => ''];

$L = current_lang();
$M = [
    'csrf'    => ['es' => 'La sesión ha caducado. Recarga la página e inténtalo de nuevo.', 'en' => 'Session expired. Please reload and try again.', 'de' => 'Sitzung abgelaufen. Bitte neu laden.'],
    'email'   => ['es' => 'Introduce un email válido.', 'en' => 'Please enter a valid email address.', 'de' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.'],
    'short'   => ['es' => 'Escribe un mensaje de al menos 5 caracteres.', 'en' => 'Please write a message with at least 5 characters.', 'de' => 'Ihre Nachricht sollte mindestens 5 Zeichen enthalten.'],
    'long'    => ['es' => 'El nombre o el mensaje son demasiado largos.', 'en' => 'The name or message is too long.', 'de' => 'Der Name oder die Nachricht ist zu lang.'],
    'consent' => ['es' => 'Debes aceptar la información sobre protección de datos.', 'en' => 'You must agree to the privacy policy.', 'de' => 'Bitte bestätigen Sie die Datenschutzerklärung.'],
    'chars'   => ['es' => 'El texto contiene caracteres no permitidos.', 'en' => 'The text contains disallowed characters.', 'de' => 'Der Text enthält unzulässige Zeichen.'],
    'rate'    => ['es' => 'Has alcanzado el límite de envíos. Inténtalo de nuevo en unos minutos o llámanos por teléfono.', 'en' => 'You have reached the submission limit. Please try again in a few minutes or call us.', 'de' => 'Sendelimit erreicht. Bitte versuchen Sie es in einigen Minuten erneut oder rufen Sie uns an.'],
    'fast'    => ['es' => 'Envío demasiado rápido. Inténtalo de nuevo.', 'en' => 'Submitted too quickly. Please try again.', 'de' => 'Zu schnell gesendet. Bitte erneut versuchen.'],
    'server'  => ['es' => 'No hemos podido guardar tu mensaje. Inténtalo de nuevo o llámanos.', 'en' => 'We could not save your message. Please try again or call us.', 'de' => 'Nachricht konnte nicht gespeichert werden. Bitte erneut versuchen.'],
];
$msg = fn(string $k): string => $M[$k][$L] ?? $M[$k]['es'];

/** Token de tiempo firmado (HMAC) para detectar envíos instantáneos de bots. */
function form_time_token(): string {
    $ts = (string)time();
    return $ts . '.' . hash_hmac('sha256', 'form|' . $ts, Database::appKey());
}
function form_time_age(?string $tok): ?int {
    if (!is_string($tok) || !preg_match('/^(\d{9,11})\.([0-9a-f]{64})$/', $tok, $m)) return null;
    if (!hash_equals(hash_hmac('sha256', 'form|' . $m[1], Database::appKey()), $m[2])) return null;
    return time() - (int)$m[1];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Honeypot: un humano nunca lo rellena. Respuesta mínima, sin pistas.
    if (!empty($_POST['web'])) {
        http_response_code(400);
        exit;
    }

    $raw = ['nombre' => $_POST['nombre'] ?? '', 'email' => $_POST['email'] ?? '', 'mensaje' => $_POST['mensaje'] ?? ''];
    $badChars = false;
    foreach ($raw as $k => $v) {
        if (!is_string($v)) { $badChars = true; $old[$k] = ''; continue; }   // nombre[]=x, etc.
        $clean = sanitize_text($v, $k === 'mensaje');
        if ($clean === null) { $badChars = true; $old[$k] = ''; continue; }
        $old[$k] = $clean;
    }
    if ($badChars || has_mixed_script_word($old['nombre'])) {
        $errors[] = $msg('chars');
    }
    if (!csrf_check($_POST['csrf'] ?? null)) {
        $errors[] = $msg('csrf');
    }
    $age = form_time_age($_POST['ft'] ?? null);
    if ($age === null || $age < FORM_MIN_SECONDS || $age > CSRF_TTL) {
        $errors[] = $msg('fast');
    }
    // FILTER_VALIDATE_EMAIL (sin FLAG_EMAIL_UNICODE) solo admite ASCII: bloquea homoglifos en el dominio.
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($old['email']) > 254) {
        $errors[] = $msg('email');
    }
    if (mb_strlen($old['mensaje']) < 5) {
        $errors[] = $msg('short');
    }
    if (mb_strlen($old['mensaje']) > 3000 || mb_strlen($old['nombre']) > 120) {
        $errors[] = $msg('long');
    }
    if (($_POST['privacidad'] ?? '') !== '1') {
        $errors[] = $msg('consent');
    }

    // El rate limit se consume solo si el resto de validaciones pasan (los errores del usuario no le penalizan).
    if (!$errors) {
        $ip = client_ip();
        try {
            if (!Database::rateLimitHit(Database::bucketFor($ip))) {
                http_response_code(429);
                header('Retry-After: ' . RATE_LIMIT_WINDOW);
                $errors[] = $msg('rate');
            } else {
                Database::saveContact($old['nombre'], $old['email'], $old['mensaje'], $ip, $L);
                csrf_rotate();
                $ok = true;
                $old = ['nombre' => '', 'email' => '', 'mensaje' => ''];
            }
        } catch (Throwable $ex) {
            error_log('[contacto] ' . $ex->getMessage());
            http_response_code(500);
            $errors[] = $msg('server');
        }
    }
}

require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
?>
<main id="main" tabindex="-1">

    <!-- CABECERA DE CONTACTO -->
    <section class="wrap section">
        <div class="contact-layout">
            <!-- COLUMNA IZQUIERDA: CANALES Y CLÍNICA -->
            <div>
                <p class="kicker"><?= e(t('contact_kicker')) ?></p>
                <h1><?= e(t('contact_title')) ?></h1>
                <p class="lead" style="margin-bottom: 2rem;">
                    <?= e(t('contact_lead')) ?>
                </p>

                <!-- Canales de contacto directos -->
                <div>
                    <a href="tel:<?= e(SITE_PHONE_LINK) ?>" class="contact-channel-card">
                        <div class="contact-channel-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="22" height="22">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </div>
                        <div class="contact-channel-meta">
                            <span><?= e(current_lang() === 'en' ? 'Direct phone & WhatsApp' : (current_lang() === 'de' ? 'Telefon & WhatsApp' : 'Teléfono directo y WhatsApp')) ?></span>
                            <strong><?= e(SITE_PHONE) ?></strong>
                        </div>
                    </a>

                    <a href="mailto:<?= e(SITE_EMAIL) ?>" class="contact-channel-card">
                        <div class="contact-channel-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="22" height="22">
                                <rect width="20" height="16" x="2" y="4" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                        </div>
                        <div class="contact-channel-meta">
                            <span><?= e(current_lang() === 'en' ? 'Email address' : (current_lang() === 'de' ? 'E-Mail-Adresse' : 'Correo electrónico')) ?></span>
                            <strong><?= e(SITE_EMAIL) ?></strong>
                        </div>
                    </a>

                    <a href="<?= e(SITE_INSTAGRAM_URL) ?>" target="_blank" rel="noopener" class="contact-channel-card">
                        <div class="contact-channel-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="22" height="22">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                            </svg>
                        </div>
                        <div class="contact-channel-meta">
                            <span>Instagram</span>
                            <strong><?= e(SITE_INSTAGRAM) ?></strong>
                        </div>
                    </a>
                </div>

                <!-- Tarjeta de consulta física en Clínica SurgEOM -->
                <div class="clinic-location-card">
                    <h2>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span><?= e(t('trust_clinic')) ?></span>
                    </h2>
                    <p><strong><?= e(SITE_ADDRESS) ?></strong></p>
                    <p style="font-size:0.86rem; color:var(--ink-soft); margin-top:0.4rem;">
                        <strong><?= e(current_lang() === 'en' ? 'Hours:' : (current_lang() === 'de' ? 'Öffnungszeiten:' : 'Horario de atención:')) ?></strong> <?= e(SITE_HOURS) ?>.<br>
                        <?= e(current_lang() === 'en' ? 'Convenient public transit (Metro Av. de América) and easy parking.' : (current_lang() === 'de' ? 'Metro Av. de América in 3 Min. fußläufig, Parkmöglichkeiten.' : 'Metro Avenida de América a 3 min a pie. Fácil aparcamiento.')) ?>
                    </p>
                    <a href="#mapa-ubicacion" class="clinic-map-link">
                        <span><?= e(current_lang() === 'en' ? 'View map & directions' : (current_lang() === 'de' ? 'Karte & Anfahrt ansehen' : 'Ver mapa interactivo y cómo llegar')) ?></span>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 13l5 5 5-5M12 4v14"/></svg>
                    </a>
                </div>
            </div>

            <!-- COLUMNA DERECHA: FORMULARIO ESTILIZADO -->
            <div>
                <div class="form-card">
                    <h3 style="margin-bottom: 0.6rem;"><?= e(t('contact_form_title')) ?></h3>
                    <p style="font-size:0.95rem; color:var(--ink-soft); margin-bottom:1.6rem;">
                        <?= e(current_lang() === 'en' ? 'Fill out the form and Elena will personally reach out.' : (current_lang() === 'de' ? 'Füllen Sie die Felder aus, Elena meldet sich persönlich bei Ihnen.' : 'Rellena los datos y Elena se pondrá en contacto contigo directamente.')) ?>
                    </p>

                    <?php if ($ok): ?>
                        <div class="form-alert-success" role="status">
                            <strong><?= e(current_lang() === 'en' ? 'Message sent successfully!' : (current_lang() === 'de' ? 'Nachricht erfolgreich gesendet!' : '¡Mensaje recibido con éxito!')) ?></strong><br>
                            <?= e(current_lang() === 'en' ? 'Thank you for reaching out. We will respond promptly.' : (current_lang() === 'de' ? 'Vielen Dank. Wir antworten Ihnen zeitnah.' : 'Muchas gracias por escribirnos. Te responderemos lo antes posible.')) ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($errors): ?>
                        <div class="form-alert-error" role="alert">
                            <strong><?= e(current_lang() === 'en' ? 'Please review the following fields:' : (current_lang() === 'de' ? 'Bitte prüfen Sie folgende Angaben:' : 'Por favor, revisa los siguientes campos:')) ?></strong>
                            <ul style="margin-top:0.5rem; padding-left:1.2rem;">
                                <?php foreach ($errors as $err): ?>
                                    <li><?= e($err) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?= e(page_url('/contacto.php')) ?>" id="form-contacto" novalidate>
                        <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                        <input type="hidden" name="ft" value="<?= e(form_time_token()) ?>">
                        
                        <!-- Honeypot -->
                        <div style="position: absolute; left: -9999px;" aria-hidden="true">
                            <label for="campo-web">No rellenar</label>
                            <input type="text" id="campo-web" name="web" tabindex="-1" autocomplete="off" data-lpignore="true">
                        </div>

                        <div class="form-group">
                            <label for="nombre"><?= e(t('contact_name')) ?> *</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?= e($old['nombre']) ?>" required maxlength="120" autocomplete="name" placeholder="<?= e(current_lang() === 'en' ? 'e.g. Sarah Miller' : (current_lang() === 'de' ? 'z. B. Julia Schneider' : 'Ej. Laura Gómez')) ?>">
                        </div>

                        <div class="form-group">
                            <label for="email"><?= e(t('contact_email')) ?> *</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= e($old['email']) ?>" required maxlength="254" autocomplete="email" inputmode="email" spellcheck="false" placeholder="nombre@correo.com">
                        </div>

                        <div class="form-group">
                            <label for="mensaje"><?= e(current_lang() === 'en' ? 'How can we help you? *' : (current_lang() === 'de' ? 'Wie können wir Ihnen helfen? *' : '¿En qué podemos ayudarte? *')) ?></label>
                            <textarea id="mensaje" name="mensaje" class="form-control" rows="5" required maxlength="3000" minlength="5" placeholder="<?= e(t('contact_message')) ?>"><?= e($old['mensaje']) ?></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-checkbox">
                                <input type="checkbox" name="privacidad" value="1" required aria-describedby="consent-info">
                                <span id="consent-info"><?= e(current_lang() === 'en' ? 'I have read the privacy policy and explicitly consent to the processing of my data, including any health information I include, to answer my enquiry.' : (current_lang() === 'de' ? 'Ich habe die Datenschutzerklärung gelesen und willige ausdrücklich in die Verarbeitung meiner Daten, einschließlich etwaiger Gesundheitsdaten, zur Beantwortung meiner Anfrage ein.' : 'He leído la política de privacidad y consiento expresamente el tratamiento de mis datos, incluidos los datos de salud que aporte, para atender mi consulta.')) ?> <a href="<?= e(page_url('/politica-de-privacidad.php')) ?>" target="_blank" rel="noopener">(<?= e(t('footer_privacy')) ?>)</a></span>
                            </label>
                        </div>

                        <button type="submit" class="btn" style="width: 100%;" id="btn-submit">
                            <span class="btn-text"><?= e(t('contact_send')) ?></span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN INTERACTIVA DE GOOGLE MAPS Y UBICACIÓN CLÍNICA -->
    <section class="wrap section-compact" id="mapa-ubicacion" style="margin-bottom: 5.5rem;">
        <div class="contact-map-card">
            <div class="contact-map-grid">
                <!-- Información detallada de ubicación y transporte -->
                <div class="contact-map-info">
                    <div class="map-badge-pill">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span><?= e(current_lang() === 'en' ? 'In-Person Clinical Practice' : (current_lang() === 'de' ? 'Praxis für persönliche Konsultation' : 'Consulta Presencial en Madrid')) ?></span>
                    </div>
                    <h2><?= e(current_lang() === 'en' ? 'How to Reach Clínica SurgEOM' : (current_lang() === 'de' ? 'So finden Sie die Clínica SurgEOM' : 'Cómo llegar a Clínica SurgEOM')) ?></h2>
                    <p class="map-lead">
                        <?= e(current_lang() === 'en' 
                            ? 'Our in-person consultations take place at Clínica SurgEOM, a reference medical and dermatological facility located in the heart of Madrid, right by Avenida de América.' 
                            : (current_lang() === 'de' 
                                ? 'Unsere persönlichen Sprechstunden finden in der renommierten Fachklinik SurgEOM direkt am Verkehrsknotenpunkt Avenida de América in Madrid statt.' 
                                : 'Las consultas presenciales del Método ESN se realizan en Clínica SurgEOM, centro médico-quirúrgico y dermatológico de referencia en Madrid, a escasos metros del intercambiador de Avenida de América.')) ?>
                    </p>

                    <div class="map-details-list">
                        <div class="map-detail-item">
                            <div class="map-detail-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <strong><?= e(current_lang() === 'en' ? 'Exact Address' : (current_lang() === 'de' ? 'Genaue Adresse' : 'Dirección exacta')) ?></strong>
                                <span>Calle de Coslada, 16 (esquina C/ Agustín Durán, 34)<br>28028 Madrid · Barrio de Salamanca / Guindalera</span>
                            </div>
                        </div>

                        <div class="map-detail-item">
                            <div class="map-detail-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            </div>
                            <div>
                                <strong><?= e(current_lang() === 'en' ? 'Consultation Hours' : (current_lang() === 'de' ? 'Sprechzeiten' : 'Horario de consulta')) ?></strong>
                                <span><?= e(SITE_HOURS) ?> (<?= e(current_lang() === 'en' ? 'by appointment' : (current_lang() === 'de' ? 'nach Terminvereinbarung' : 'con cita previa concertada')) ?>)</span>
                            </div>
                        </div>

                        <div class="map-detail-item">
                            <div class="map-detail-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M9 17V7h4a3 3 0 0 1 0 6H9"/></svg>
                            </div>
                            <div>
                                <strong><?= e(current_lang() === 'en' ? 'Public Transit & Parking' : (current_lang() === 'de' ? 'Öffentlicher Nahverkehr & Parken' : 'Transporte público y aparcamiento')) ?></strong>
                                <span><?= e(current_lang() === 'en' 
                                    ? 'Metro Avenida de América (Lines 4, 6, 7, 9) 3 min walk · Metro Diego de León & Cartagena · Public parking available at Cartagena St. and Intercambiador.' 
                                    : (current_lang() === 'de' 
                                        ? 'Metro Avenida de América (Linien 4, 6, 7, 9) 3 Gehminuten · Metro Diego de León & Cartagena · Öffentliche Parkhäuser vorhanden.' 
                                        : 'Metro Intercambiador de Avenida de América (Líneas 4, 6, 7 y 9) a 3 min a pie · Metro Diego de León y Cartagena · Parkings públicos en C/ Cartagena y en el propio Intercambiador.')) ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="map-actions-row">
                        <a href="<?= e(SITE_MAPS_URL) ?>" target="_blank" rel="noopener" class="btn btn-sm">
                            <span><?= e(current_lang() === 'en' ? 'Open in Google Maps' : (current_lang() === 'de' ? 'In Google Maps öffnen' : 'Abrir en Google Maps')) ?></span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        </a>
                        <a href="<?= e(BOOKING_URL) ?>" target="_blank" rel="noopener" class="btn btn-ghost btn-sm">
                            <span><?= e(current_lang() === 'en' ? 'Book in-person visit' : (current_lang() === 'de' ? 'Vor-Ort-Termin buchen' : 'Reservar cita presencial')) ?></span>
                        </a>
                    </div>
                </div>

                <!-- Tarjeta fotográfica del despacho -->
                <div class="contact-map-image-card">
                    <img src="<?= e(img('dondestamos.jpg')) ?>" alt="Despacho de consulta Elena Sánchez Novo en Clínica SurgEOM Madrid" loading="lazy" width="600" height="750">
                    <div class="map-image-badge">
                        <span><?= e(current_lang() === 'en' ? 'ESN Consultation Office' : (current_lang() === 'de' ? 'ESN Praxisraum' : 'Despacho Médico ESN')) ?></span>
                        <strong>Avenida de América · Madrid</strong>
                    </div>
                </div>
            </div>

            <!-- Marco de Google Maps Interactivo -->
            <div class="contact-map-embed-wrapper">
                <div class="map-facade" id="map-facade" data-src="<?= e(SITE_MAPS_EMBED) ?>" data-title="Mapa interactivo de Google Maps de Clínica SurgEOM en Madrid">
                    <p><?= e($L === 'en' ? 'The map loads from Google only when you ask for it (privacy and speed).' : ($L === 'de' ? 'Die Karte wird erst auf Wunsch von Google geladen (Datenschutz & Geschwindigkeit).' : 'El mapa se carga desde Google solo cuando lo pides (privacidad y velocidad).')) ?></p>
                    <button type="button" class="btn btn-sm" id="map-load"><?= e($L === 'en' ? 'Load interactive map' : ($L === 'de' ? 'Interaktive Karte laden' : 'Cargar mapa interactivo')) ?></button>
                </div>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

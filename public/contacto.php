<?php
require __DIR__ . '/../src/functions.php';
require __DIR__ . '/../src/Database.php';

$pageTitle = t('contact_page_title', 'Contacto · Consulta con Elena Sánchez Novo');
$pageDesc  = t('contact_lead', 'Ponte en contacto con el Método ESN. Te escuchamos y resolvemos tus dudas.');

$errors = [];
$ok = false;
$old = ['nombre' => '', 'email' => '', 'mensaje' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $k => $_) {
        $old[$k] = trim($_POST[$k] ?? '');
    }

    // Honeypot anti-spam
    if (!empty($_POST['web'])) {
        http_response_code(400);
        exit;
    }
    if (!csrf_check($_POST['csrf'] ?? null)) {
        $errors[] = current_lang() === 'en' ? 'Session expired. Please reload and try again.' : (current_lang() === 'de' ? 'Sitzung abgelaufen. Bitte neu laden.' : 'La sesión ha caducado. Recarga la página e inténtalo de nuevo.');
    }
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = current_lang() === 'en' ? 'Please enter a valid email address.' : (current_lang() === 'de' ? 'Bitte geben Sie eine gültige E-Mail-Adresse ein.' : 'Introduce un email válido.');
    }
    if (mb_strlen($old['mensaje']) < 5) {
        $errors[] = current_lang() === 'en' ? 'Please write a message with at least 5 characters.' : (current_lang() === 'de' ? 'Ihre Nachricht sollte mindestens 5 Zeichen enthalten.' : 'Escribe un mensaje de al menos 5 caracteres.');
    }
    if (mb_strlen($old['mensaje']) > 3000 || mb_strlen($old['nombre']) > 120) {
        $errors[] = current_lang() === 'en' ? 'The name or message is too long.' : (current_lang() === 'de' ? 'Der Name oder die Nachricht ist zu lang.' : 'El nombre o el mensaje son demasiado largos.');
    }
    if (empty($_POST['privacidad'])) {
        $errors[] = current_lang() === 'en' ? 'You must agree to the privacy policy.' : (current_lang() === 'de' ? 'Bitte bestätigen Sie die Datenschutzerklärung.' : 'Debes aceptar la información sobre protección de datos.');
    }

    if (!$errors) {
        $stmt = Database::get()->prepare(
            'INSERT INTO contactos (nombre, email, mensaje, ip) VALUES (:nombre, :email, :mensaje, :ip)'
        );
        $stmt->execute($old + ['ip' => $_SERVER['REMOTE_ADDR'] ?? '']);
        $ok = true;
        $old = ['nombre' => '', 'email' => '', 'mensaje' => ''];
    }
}

require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
?>
<main id="main">

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
                    <h4>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span><?= e(t('trust_clinic')) ?></span>
                    </h4>
                    <p><strong><?= e(SITE_ADDRESS) ?></strong></p>
                    <p style="font-size:0.86rem; color:var(--ink-soft); margin-top:0.4rem;">
                        <strong><?= e(current_lang() === 'en' ? 'Hours:' : (current_lang() === 'de' ? 'Öffnungszeiten:' : 'Horario de atención:')) ?></strong> <?= e(SITE_HOURS) ?>.<br>
                        <?= e(current_lang() === 'en' ? 'Convenient public transit and parking in Madrid central.' : (current_lang() === 'de' ? 'Gute Anbindung an den ÖPNV und Parkmöglichkeiten.' : 'Próximo a transporte público y fácil aparcamiento.')) ?>
                    </p>
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
                        <div class="form-alert-success" role="alert">
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
                        
                        <!-- Honeypot -->
                        <div style="position: absolute; left: -9999px;">
                            <label for="campo-web">No rellenar</label>
                            <input type="text" id="campo-web" name="web" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="nombre"><?= e(t('contact_name')) ?> *</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?= e($old['nombre']) ?>" required placeholder="<?= e(current_lang() === 'en' ? 'e.g. Sarah Miller' : (current_lang() === 'de' ? 'z. B. Julia Schneider' : 'Ej. Laura Gómez')) ?>">
                        </div>

                        <div class="form-group">
                            <label for="email"><?= e(t('contact_email')) ?> *</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= e($old['email']) ?>" required placeholder="nombre@correo.com">
                        </div>

                        <div class="form-group">
                            <label for="mensaje"><?= e(current_lang() === 'en' ? 'How can we help you? *' : (current_lang() === 'de' ? 'Wie können wir Ihnen helfen? *' : '¿En qué podemos ayudarte? *')) ?></label>
                            <textarea id="mensaje" name="mensaje" class="form-control" rows="5" required placeholder="<?= e(t('contact_message')) ?>"><?= e($old['mensaje']) ?></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-checkbox">
                                <input type="checkbox" name="privacidad" value="1" required>
                                <span><?= e(current_lang() === 'en' ? 'I have read and accept the privacy policy regarding the processing of my health inquiry.' : (current_lang() === 'de' ? 'Ich habe die Datenschutzerklärung zur Kenntnis genommen und stimme zu.' : 'He leído y acepto la política de privacidad sobre el tratamiento de mis datos personales.')) ?> <a href="<?= e(page_url('/politica-de-privacidad.php')) ?>" target="_blank">(<?= e(t('footer_privacy')) ?>)</a></span>
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

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

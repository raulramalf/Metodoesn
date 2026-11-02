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
        $errors[] = t('contact_err_csrf');
    }
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = t('contact_err_email');
    }
    if (mb_strlen($old['mensaje']) < 5) {
        $errors[] = t('contact_err_short');
    }
    if (mb_strlen($old['mensaje']) > 3000 || mb_strlen($old['nombre']) > 120) {
        $errors[] = t('contact_err_long');
    }
    if (empty($_POST['privacidad'])) {
        $errors[] = t('contact_err_privacy');
    }

    $fingerprint = Database::ipFingerprint($_SERVER['REMOTE_ADDR'] ?? '');
    $lastSent = $_SESSION['contact_last_sent'] ?? 0;

    if (!$errors && (time() - $lastSent < CONTACT_COOLDOWN_SECONDS
        || Database::recentContacts($fingerprint, CONTACT_RATE_WINDOW) >= CONTACT_RATE_MAX)) {
        $errors[] = t('contact_err_rate');
    }

    if (!$errors) {
        $stmt = Database::get()->prepare(
            'INSERT INTO contactos (nombre, email, mensaje, ip) VALUES (:nombre, :email, :mensaje, :ip)'
        );
        $stmt->execute($old + ['ip' => $fingerprint]);
        send_contact_mail($old);
        $_SESSION['contact_last_sent'] = time();
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
                <p class="lead">
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
                            <span><?= e(t('contacto_006')) ?></span>
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
                            <span><?= e(t('contacto_007')) ?></span>
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
                    <h2 class="clinic-title">
                        <span><?= e(t('trust_clinic')) ?></span>
                    </h2>
                    <p><strong><?= e(SITE_ADDRESS) ?></strong></p>
                    <p class="clinic-hours">
                        <strong><?= e(t('contacto_008')) ?></strong> <?= e(SITE_HOURS) ?>.<br>
                        <?= e(t('contacto_009')) ?>
                    </p>
                    <a href="#mapa-ubicacion" class="clinic-map-link">
                        <span><?= e(t('contacto_010')) ?></span>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 13l5 5 5-5M12 4v14"/></svg>
                    </a>
                </div>
            </div>

            <!-- COLUMNA DERECHA: FORMULARIO ESTILIZADO -->
            <div>
                <div class="form-card">
                    <h2><?= e(t('contact_form_title')) ?></h2>
                    <p class="form-intro">
                        <?= e(t('contacto_011')) ?>
                    </p>

                    <?php if ($ok): ?>
                        <div class="form-alert-success" role="alert">
                            <strong><?= e(t('contacto_012')) ?></strong><br>
                            <?= e(t('contacto_013')) ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($errors): ?>
                        <div class="form-alert-error" role="alert">
                            <strong><?= e(t('contacto_014')) ?></strong>
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
                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?= e($old['nombre']) ?>" required placeholder="<?= e(t('contacto_015')) ?>">
                        </div>

                        <div class="form-group">
                            <label for="email"><?= e(t('contact_email')) ?> *</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= e($old['email']) ?>" required placeholder="nombre@correo.com">
                        </div>

                        <div class="form-group">
                            <label for="mensaje"><?= e(t('contacto_016')) ?></label>
                            <textarea id="mensaje" name="mensaje" class="form-control" rows="5" required placeholder="<?= e(t('contact_message')) ?>"><?= e($old['mensaje']) ?></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-checkbox">
                                <input type="checkbox" name="privacidad" value="1" required>
                                <span><?= e(t('contacto_017')) ?> <a href="<?= e(page_url('/politica-de-privacidad.php')) ?>" target="_blank">(<?= e(t('footer_privacy')) ?>)</a></span>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-block" id="btn-submit" data-sending="<?= e(t('rd_js_sending')) ?>">
                            <span class="btn-text"><?= e(t('contact_send')) ?></span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN INTERACTIVA DE GOOGLE MAPS Y UBICACIÓN CLÍNICA -->
    <section class="wrap section-compact" id="mapa-ubicacion">
        <div class="contact-map-card">
            <div class="contact-map-grid">
                <!-- Información detallada de ubicación y transporte -->
                <div class="contact-map-info">
                    <div class="map-badge-pill">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span><?= e(t('contacto_018')) ?></span>
                    </div>
                    <h2><?= e(t('contacto_019')) ?></h2>
                    <p class="map-lead">
                        <?= e(t('contacto_020')) ?>
                    </p>

                    <div class="map-details-list">
                        <div class="map-detail-item">
                            <div class="map-detail-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <strong><?= e(t('contacto_021')) ?></strong>
                                <span>Calle de Coslada, 16 (esquina C/ Agustín Durán, 34)<br>28028 Madrid · Barrio de Salamanca / Guindalera</span>
                            </div>
                        </div>

                        <div class="map-detail-item">
                            <div class="map-detail-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                            </div>
                            <div>
                                <strong><?= e(t('contacto_022')) ?></strong>
                                <span><?= e(SITE_HOURS) ?> (<?= e(t('contacto_023')) ?>)</span>
                            </div>
                        </div>

                        <div class="map-detail-item">
                            <div class="map-detail-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M9 17V7h4a3 3 0 0 1 0 6H9"/></svg>
                            </div>
                            <div>
                                <strong><?= e(t('contacto_024')) ?></strong>
                                <span><?= e(t('contacto_025')) ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="map-actions-row">
                        <a href="<?= e(SITE_MAPS_URL) ?>" target="_blank" rel="noopener" class="btn btn-sm">
                            <span><?= e(t('contacto_026')) ?></span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        </a>
                        <a href="<?= e(BOOKING_URL) ?>" target="_blank" rel="noopener" class="btn btn-ghost btn-sm">
                            <span><?= e(t('contacto_027')) ?></span>
                        </a>
                    </div>
                </div>

                <!-- Tarjeta fotográfica del despacho -->
                <div class="contact-map-image-card">
                    <img src="<?= e(img('dondestamos.jpg')) ?>" alt="<?= e(t('alt_despacho')) ?>" loading="lazy" width="600" height="750">
                    <div class="map-image-badge">
                        <span><?= e(t('contacto_028')) ?></span>
                        <strong>Avenida de América · Madrid</strong>
                    </div>
                </div>
            </div>

            <!-- Marco de Google Maps Interactivo -->
            <div class="contact-map-embed-wrapper">
                <iframe 
                    title="Mapa interactivo de Google Maps de Clínica SurgEOM en Madrid"
                    data-consent-src="<?= e(SITE_MAPS_EMBED) ?>"
                    width="100%" 
                    height="420" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <p class="map-consent-note" data-consent-note hidden><?= e(t('consent_map_note')) ?> <a href="<?= e(SITE_MAPS_URL) ?>" target="_blank" rel="noopener"><?= e(t('consent_map_link')) ?></a></p>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

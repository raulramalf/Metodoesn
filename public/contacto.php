<?php
$pageTitle = 'Contacto';
$pageDesc  = 'Ponte en contacto con el Método ESN. Te escuchamos y resolvemos tus dudas sobre entrenamiento, nutrición y citas en línea o presenciales.';
require __DIR__ . '/../src/functions.php';
require __DIR__ . '/../src/Database.php';

$errors = [];
$ok = false;
$old = ['nombre' => '', 'email' => '', 'mensaje' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $k => $_) {
        $old[$k] = trim($_POST[$k] ?? '');
    }

    // Honeypot anti-spam: este campo debe llegar vacío.
    if (!empty($_POST['web'])) {
        http_response_code(400);
        exit;
    }
    if (!csrf_check($_POST['csrf'] ?? null)) {
        $errors[] = 'La sesión ha caducado. Recarga la página e inténtalo de nuevo.';
    }
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Introduce un email válido.';
    }
    if (mb_strlen($old['mensaje']) < 5) {
        $errors[] = 'Escribe un mensaje de al menos 5 caracteres.';
    }
    if (mb_strlen($old['mensaje']) > 3000 || mb_strlen($old['nombre']) > 120) {
        $errors[] = 'El nombre o el mensaje son demasiado largos.';
    }
    if (empty($_POST['privacidad'])) {
        $errors[] = 'Debes aceptar la información sobre protección de datos.';
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
    <section class="wrap section">
        <div class="contact-layout">
            <!-- Columna Izquierda: Información de Contacto y Canales -->
            <div class="contact-info">
                <p class="kicker reveal">Estamos aquí para ti</p>
                <h1 class="reveal" style="--delay:80ms">Hablemos</h1>
                <p class="lead reveal" style="--delay:160ms">
                    ¿Tienes dudas sobre cómo empezar o qué modalidad encaja mejor contigo? Escríbenos o utiliza cualquiera de nuestros canales directos. Te orientaremos con total cercanía.
                </p>

                <!-- Canales de contacto directos con microinteracciones -->
                <div class="contact-channels reveal" style="--delay:240ms">
                    <a href="tel:<?= e(SITE_PHONE_LINK) ?>" class="contact-card">
                        <div class="contact-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">Teléfono y WhatsApp</span>
                            <strong class="contact-val"><?= e(SITE_PHONE) ?></strong>
                        </div>
                    </a>

                    <a href="mailto:<?= e(SITE_EMAIL) ?>" class="contact-card">
                        <div class="contact-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="16" x="2" y="4" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">Correo electrónico</span>
                            <strong class="contact-val"><?= e(SITE_EMAIL) ?></strong>
                        </div>
                    </a>

                    <a href="<?= e(SITE_INSTAGRAM_URL) ?>" target="_blank" rel="noopener" class="contact-card">
                        <div class="contact-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">Instagram</span>
                            <strong class="contact-val"><?= e(SITE_INSTAGRAM) ?></strong>
                        </div>
                    </a>

                    <div class="contact-card contact-card-static">
                        <div class="contact-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">Ubicación presencial</span>
                            <strong class="contact-val"><?= e(SITE_ADDRESS) ?></strong>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta visual con foto real de la fachada exterior -->
                <div class="clinic-location-card reveal" style="--delay:280ms">
                    <div class="clinic-location-img-wrap">
                        <img src="<?= e(img('clinicaporfuera.jpg')) ?>"
                             alt="Fachada exterior de Clínica SurgEOM en Madrid"
                             loading="lazy"
                             width="600" height="800"
                             class="clinic-location-img">
                        <span class="clinic-location-badge">Clínica SurgEOM (Madrid)</span>
                    </div>
                    <div class="clinic-location-meta">
                        <strong>Acceso a pie de calle</strong>
                        <p>Fachada exterior con rótulo corporativo para que localices la entrada sin ninguna dificultad.</p>
                    </div>
                </div>

                <!-- Tarjeta destacada de atención y horario -->
                <div class="contact-box reveal" style="--delay:320ms">
                    <div class="contact-box-header">
                        <span class="contact-badge">Modalidad Dual</span>
                        <h3>Atención en línea y presencial</h3>
                    </div>
                    <p>Ofrecemos consultas online para acompañarte estés donde estés en el mundo. Y si prefieres una valoración cara a cara, te recibimos en nuestro centro de entrenamiento y nutrición.</p>
                    <div class="contact-hours">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        <span><?= e(SITE_HOURS) ?></span>
                    </div>
                    <div class="contact-box-action">
                        <a class="btn btn-ghost" href="/reserva-de-citas.php">
                            <span>Reservar cita</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha: Formulario interactivo -->
            <div class="contact-form-wrapper reveal" style="--delay:180ms">
                <div class="contact-form-header">
                    <h2>Envíanos un mensaje</h2>
                    <p>No necesitas tener todas las respuestas antes de dar el primer paso. Cuéntanos tu situación o tus objetivos y encontraremos la mejor manera de ayudarte.</p>
                </div>

                <?php if ($ok): ?>
                    <div class="alert alert-ok reveal" role="status">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        <div>
                            <strong>¡Mensaje recibido con éxito!</strong>
                            <p>Te responderemos lo antes posible, habitualmente en menos de 24 horas laborables.</p>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($errors): ?>
                    <div class="alert alert-error reveal" role="alert">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" x2="12" y1="8" y2="12"/>
                            <line x1="12" x2="12.01" y1="16" y2="16"/>
                        </svg>
                        <div>
                            <strong>Por favor, revisa los siguientes campos:</strong>
                            <ul>
                                <?php foreach ($errors as $err): ?>
                                    <li><?= e($err) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="post" class="form contact-form" id="form-contacto" novalidate>
                    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                    <div class="hp" aria-hidden="true"><label>No rellenar <input type="text" name="web" tabindex="-1" autocomplete="off"></label></div>

                    <div class="form-group">
                        <label for="campo-nombre">
                            Nombre
                            <span class="label-optional">(opcional)</span>
                        </label>
                        <input type="text" id="campo-nombre" name="nombre" value="<?= e($old['nombre']) ?>" autocomplete="name" placeholder="Tu nombre">
                    </div>

                    <div class="form-group">
                        <label for="campo-email">
                            Email <span class="label-required">*</span>
                        </label>
                        <input type="email" id="campo-email" name="email" value="<?= e($old['email']) ?>" required autocomplete="email" placeholder="tu-email@ejemplo.com">
                    </div>

                    <div class="form-group">
                        <label for="campo-mensaje">
                            Mensaje <span class="label-required">*</span>
                        </label>
                        <textarea id="campo-mensaje" name="mensaje" rows="5" required placeholder="Cuéntanos brevemente tus inquietudes, tus objetivos o en qué podemos ayudarte..."><?= e($old['mensaje']) ?></textarea>
                    </div>

                    <label class="check">
                        <input type="checkbox" name="privacidad" value="1" required>
                        <span>He leído y acepto la información sobre protección de datos. Consulta nuestra <a href="/politica-de-privacidad.php" target="_blank" rel="noopener">Política de Privacidad</a>.</span>
                    </label>

                    <div class="form-submit">
                        <button type="submit" class="btn btn-submit" id="btn-submit">
                            <span class="btn-text">Enviar mensaje</span>
                            <svg class="btn-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="22" x2="11" y1="2" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

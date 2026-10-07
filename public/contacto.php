<?php
$pageTitle = 'Contacto';
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
        $errors[] = 'Escribe un mensaje.';
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
    <section class="wrap section contact">
        <div>
            <h1>Contacto</h1>
            <ul class="plain contact-list">
                <li><a href="tel:<?= e(SITE_PHONE_LINK) ?>"><?= e(SITE_PHONE) ?></a></li>
                <li><a href="<?= e(SITE_INSTAGRAM_URL) ?>" target="_blank" rel="noopener"><?= e(SITE_INSTAGRAM) ?></a></li>
                <li><a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
                <li><?= e(SITE_ADDRESS) ?></li>
            </ul>
            <h2>Atención en línea y en persona</h2>
            <p>Ofrecemos servicios en línea para atenderte desde cualquier parte del mundo. Y si prefieres una atención en persona, estamos encantados de recibirte en nuestro espacio.</p>
            <p><strong><?= e(SITE_HOURS) ?></strong></p>
            <p><a class="btn btn-ghost" href="/reserva-de-citas.php">Reservar cita</a></p>
        </div>

        <div>
            <h2>Contáctanos</h2>
            <p>No necesitas tener todas las respuestas antes de dar el primer paso. Cuéntanos tu situación, tus objetivos o tus inquietudes y juntos encontraremos la mejor manera de ayudarte a construir un proceso adaptado a ti. Estamos aquí para escucharte, orientarte y acompañarte desde el primer contacto.</p>

            <?php if ($ok): ?>
                <div class="alert alert-ok" role="status">Mensaje enviado. Te responderemos lo antes posible.</div>
            <?php endif; ?>
            <?php if ($errors): ?>
                <div class="alert alert-error" role="alert">
                    <ul><?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?></ul>
                </div>
            <?php endif; ?>

            <form method="post" class="form" id="form-contacto" novalidate>
                <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                <div class="hp" aria-hidden="true"><label>No rellenar <input type="text" name="web" tabindex="-1" autocomplete="off"></label></div>

                <label>Nombre
                    <input type="text" name="nombre" value="<?= e($old['nombre']) ?>" autocomplete="name">
                </label>
                <label>Email *
                    <input type="email" name="email" value="<?= e($old['email']) ?>" required autocomplete="email">
                </label>
                <label>Mensaje *
                    <textarea name="mensaje" rows="5" required><?= e($old['mensaje']) ?></textarea>
                </label>
                <label class="check">
                    <input type="checkbox" name="privacidad" value="1" required>
                    <span>He leído la información sobre protección de datos. Consulta nuestra <a href="/politica-de-privacidad.php">Política de Privacidad</a>.</span>
                </label>
                <button type="submit" class="btn">Enviar mensaje</button>
            </form>
        </div>
    </section>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

<?php
$pageTitle = 'Reserva de citas';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
?>
<main id="main">
    <section class="wrap section prose-wide cta">
        <h1>Reserva de citas</h1>
        <p class="lead">La reserva se gestiona a través de Doctoralia. Elige el día y la hora que mejor te encajen.</p>
        <p><a class="btn" href="<?= e(BOOKING_URL) ?>" target="_blank" rel="noopener">Reserve una cita</a></p>
        <p>¿Prefieres hablar antes? <a href="/contacto.php">Escríbenos</a> o llama al <a href="tel:<?= e(SITE_PHONE_LINK) ?>"><?= e(SITE_PHONE) ?></a>.</p>
    </section>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

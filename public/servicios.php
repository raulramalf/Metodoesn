<?php
$pageTitle = 'Servicios';
$pageDesc = 'Entrenamiento, nutrición y acompañamiento forman parte de un mismo proceso, diseñado para mejorar tu salud de forma real, sostenible y personalizada.';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">
    <section class="wrap section prose-wide">
        <h1>¿Qué incluye el Método ESN?</h1>
        <p class="lead">En Método ESN no encontrarás programas cerrados ni servicios independientes. Entrenamiento, nutrición y acompañamiento forman parte de un mismo proceso, diseñado para ayudarte a mejorar tu salud de forma real, sostenible y completamente personalizada.</p>
        <p>Cada plan se adapta a tus objetivos, tu estilo de vida y tus necesidades, integrando todas las herramientas necesarias para que el cambio sea efectivo y duradero.</p>
    </section>

    <section class="wrap section">
        <ol class="steps">
            <?php foreach ($pasos as [$titulo, $texto]): ?>
                <li><h3><?= e($titulo) ?></h3><p><?= e($texto) ?></p></li>
            <?php endforeach; ?>
        </ol>
    </section>

    <section class="band">
        <div class="wrap section two-col">
            <img src="<?= e(img('espacio.png')) ?>" alt="Instalaciones del Método ESN" loading="lazy" width="1024" height="683">
            <div>
                <h2>Un espacio pensado para cuidar de tu salud</h2>
                <p>Queremos que desde el primer momento te sientas cómodo y acompañado. Por eso trabajamos en unas instalaciones modernas, equipadas con tecnología de valoración corporal y diseñadas para ofrecer un entorno tranquilo, profesional y cercano.</p>
                <p><a class="btn" href="/reserva-de-citas.php">Reserva tu cita</a></p>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

<?php
$pageTitle = 'Entrenamiento | Salud | Nutrición';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">

    <!-- HERO -->
    <section class="hero">
        <div class="wrap hero-grid">
            <div class="hero-text">
                <p class="kicker reveal" style="--delay:0ms">Elena Sánchez Novo</p>
                <h1 class="reveal" style="--delay:80ms">Método ESN</h1>
                <p class="hero-sub reveal" style="--delay:160ms"><?= e(SITE_TAGLINE) ?></p>
                <h2 class="hero-lead reveal" style="--delay:240ms">¡Bienvenido a ESN!</h2>
                <p class="reveal" style="--delay:320ms">Mi misión es ayudarte a lograr tus objetivos mediante un proceso que combina movimiento, alimentación y hábitos individualizados que marcan la diferencia. Quiero que descubras una forma de cuidarte que sea sencilla, duradera y diseñada para ti.</p>
                <p class="actions reveal" style="--delay:400ms">
                    <a class="btn" href="/reserva-de-citas.php">Reserva tu cita</a>
                    <a class="btn btn-ghost" href="/servicios.php">Descubre nuestros servicios</a>
                </p>
            </div>
            <div class="hero-media reveal-scale" style="--delay:200ms">
                <img class="hero-img-a" src="<?= e(img('hero-1.png')) ?>" alt="Entrenamiento y salud con el Método ESN" width="682" height="1024">
                <img class="hero-img-b" src="<?= e(img('hero-2.png')) ?>" alt="" width="600" height="400">
            </div>
        </div>
    </section>

    <!-- INTRO -->
    <section class="wrap section intro">
        <h2 class="reveal">Método ESN</h2>
        <p class="lead reveal" style="--delay:100ms">Mi método ofrece planes de entrenamiento y/o nutrición completamente individualizados y basados en evidencia científica. Mantener y mejorar la salud es la base sobre la que se crea cada plan. La clave de su eficacia reside en un acompañamiento continuo, en ser un equipo, convirtiendo cada proceso en una historia única.</p>
    </section>

    <!-- PRINCIPIOS -->
    <section class="band">
        <div class="wrap section">
            <h2 class="reveal">Principios que sustentan el método ESN</h2>
            <div class="principles">
                <?php foreach ($principios as $i => [$titulo, $texto]): ?>
                    <article class="principle reveal" style="--delay:<?= $i * 90 ?>ms">
                        <h3><?= e($titulo) ?></h3>
                        <p><?= e($texto) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="gallery">
                <img src="<?= e(img('metodo-1.png')) ?>" alt="" loading="lazy" width="683" height="1024">
                <img src="<?= e(img('metodo-2.png')) ?>" alt="" loading="lazy" width="683" height="1024">
                <img src="<?= e(img('metodo-3.png')) ?>" alt="" loading="lazy" width="600" height="400">
            </div>
        </div>
    </section>

    <!-- PASOS — TIMELINE INTERACTIVO -->
    <section class="wrap section">
        <p class="kicker reveal">Tu camino dentro del Método ESN</p>
        <h2 class="reveal" style="--delay:80ms">Cómo funcionamos</h2>
        <div class="timeline" id="esn-timeline">
            <div class="timeline-track" aria-hidden="true">
                <div class="timeline-progress"></div>
            </div>
            <ol class="steps">
                <?php foreach ($pasos as $i => [$titulo, $texto]): ?>
                    <li class="reveal" style="--delay:<?= ($i * 150) + 200 ?>ms">
                        <div class="step-node" aria-hidden="true">
                            <span><?= $i + 1 ?></span>
                        </div>
                        <h3><?= e($titulo) ?></h3>
                        <p><?= e($texto) ?></p>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>

    <!-- TESTIMONIOS -->
    <section class="band">
        <div class="wrap section">
            <h2 class="reveal">Historias reales, resultados reales</h2>
            <p class="lead reveal" style="--delay:100ms">La mejor prueba de un método eficaz son las historias de quienes ya lo han vivido. Estas son algunas de las transformaciones del equipo conseguidas con el Método ESN.</p>
            <div class="quotes">
                <?php foreach ($testimonios as $i => [$cita, $autor]): ?>
                    <figure class="quote reveal" style="--delay:<?= $i * 120 ?>ms">
                        <blockquote><p><?= e($cita) ?></p></blockquote>
                        <figcaption><strong><?= e($autor) ?></strong> · Integrante del equipo ESN</figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA FINAL -->
    <section class="wrap section">
        <div class="cta reveal">
            <h2>Descubre el método que transforma vidas</h2>
            <p>Ponte en contacto para resolver tus dudas, conocer el método y valorar juntos cuál es el mejor camino para ti.</p>
            <a class="btn" href="/contacto.php">Contactar ahora</a>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

<?php
$pageTitle = 'Servicios';
$pageDesc  = 'Entrenamiento, nutrición y acompañamiento forman parte de un mismo proceso, diseñado para mejorar tu salud de forma real, sostenible y personalizada.';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">

    <!-- CABECERA DE PÁGINA -->
    <section class="wrap section prose-wide">
        <p class="kicker reveal">Todo en un mismo proceso</p>
        <h1 class="reveal" style="--delay:80ms">¿Qué incluye el Método ESN?</h1>
        <p class="lead reveal" style="--delay:160ms">En Método ESN no encontrarás programas cerrados ni servicios independientes. Entrenamiento, nutrición y acompañamiento forman parte de un mismo proceso, diseñado para ayudarte a mejorar tu salud de forma real, sostenible y completamente personalizada.</p>
        <p class="reveal" style="--delay:240ms">Cada plan se adapta a tus objetivos, tu estilo de vida y tus necesidades, integrando todas las herramientas necesarias para que el cambio sea efectivo y duradero.</p>
    </section>

    <!-- PILARES DEL SERVICIO — Cards con icono + descripción -->
    <section class="band">
        <div class="wrap section">
            <h2 class="reveal">Los tres pilares del proceso</h2>
            <div class="service-cards">

                <article class="service-card reveal" style="--delay:80ms">
                    <div class="service-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6.5 6.5 A5.5 5.5 0 0 1 17.5 6.5"/>
                            <line x1="12" y1="2" x2="12" y2="5"/>
                            <polyline points="6 12 10 16 18 8"/>
                            <circle cx="12" cy="12" r="10"/>
                        </svg>
                    </div>
                    <h3>Entrenamiento personalizado</h3>
                    <p>Programas de fuerza, acondicionamiento físico y rendimiento adaptados a tu nivel, objetivos y disponibilidad de material. Válido para entrenar en gimnasio, en casa o al aire libre.</p>
                </article>

                <article class="service-card reveal" style="--delay:180ms">
                    <div class="service-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2z"/>
                            <path d="M12 6v6l4 2"/>
                        </svg>
                    </div>
                    <h3>Nutrición basada en evidencia</h3>
                    <p>Planes de alimentación flexibles, sin prohibiciones ni dietas estrictas. Diseñados para encajar con tu vida y enseñarte a comer de forma sostenible a largo plazo.</p>
                </article>

                <article class="service-card reveal" style="--delay:280ms">
                    <div class="service-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h3>Acompañamiento continuo</h3>
                    <p>Seguimiento real durante todo el proceso: revisiones periódicas, ajustes del plan y canal de comunicación directo para que nunca te sientas solo en el camino.</p>
                </article>

            </div>
        </div>
    </section>

    <!-- PASOS DEL PROCESO — Timeline (reutiliza el mismo componente que index) -->
    <section class="wrap section">
        <p class="kicker reveal">Paso a paso</p>
        <h2 class="reveal" style="--delay:80ms">Cómo funciona el proceso</h2>
        <div class="timeline" id="srv-timeline">
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

    <!-- ESPACIO / INSTALACIONES -->
    <section class="band">
        <div class="wrap section two-col">
            <div class="reveal-scale" style="--delay:0ms">
                <img src="<?= e(img('espacio.png')) ?>"
                     alt="Instalaciones del Método ESN"
                     loading="lazy"
                     width="1024" height="683"
                     class="espacio-img">
            </div>
            <div>
                <h2 class="reveal" style="--delay:100ms">Un espacio pensado para cuidar de tu salud</h2>
                <p class="reveal" style="--delay:180ms">Queremos que desde el primer momento te sientas cómodo y acompañado. Por eso trabajamos en unas instalaciones modernas, equipadas con tecnología de valoración corporal y diseñadas para ofrecer un entorno tranquilo, profesional y cercano.</p>
                <p class="reveal" style="--delay:260ms"><a class="btn" href="/reserva-de-citas.php">Reserva tu cita</a></p>
            </div>
        </div>
    </section>

    <!-- CTA FINAL -->
    <section class="wrap section">
        <div class="cta reveal">
            <h2>Tu proceso comienza con una valoración</h2>
            <p>La primera sesión es el punto de partida: analizamos juntos tu situación, tus objetivos y diseñamos el plan que mejor se adapta a ti.</p>
            <a class="btn" href="/reserva-de-citas.php">Reserva tu valoración inicial</a>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

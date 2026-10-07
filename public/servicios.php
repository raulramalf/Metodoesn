<?php
$pageTitle = 'Servicios';
$pageDesc  = 'Entrenamiento, nutrición clínica y acompañamiento forman parte de un mismo proceso, diseñado para mejorar tu salud de forma real, sostenible y personalizada.';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">

    <!-- CABECERA DE PÁGINA -->
    <section class="wrap section prose-wide">
        <p class="kicker reveal">Todo en un mismo proceso</p>
        <h1 class="reveal" style="--delay:80ms">¿Qué incluye el Método ESN?</h1>
        <p class="lead reveal" style="--delay:160ms">
            En Método ESN no encontrarás dietas restrictivas ni programas de entrenamiento impersonales. Entrenamiento, nutrición y acompañamiento forman parte de un mismo proceso, diseñado para ayudarte a mejorar tu salud de forma real, sostenible y completamente individualizada.
        </p>
        <p class="reveal" style="--delay:240ms">
            Cada plan se adapta a tus objetivos clínicos, estéticos o de rendimiento, integrando todas las herramientas necesarias para que el cambio sea efectivo y duradero en el tiempo.
        </p>
    </section>

    <!-- PILARES DEL SERVICIO — Cards con icono + descripción -->
    <section class="band">
        <div class="wrap section">
            <p class="kicker reveal">Bases sólidas</p>
            <h2 class="reveal" style="--delay:60ms">Los tres pilares del proceso</h2>
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
                    <p>Programas de fuerza, acondicionamiento y recomposición corporal adaptados a tu punto de partida, lesiones previas y disponibilidad. Válido tanto para gimnasio como para casa o exterior.</p>
                </article>

                <article class="service-card reveal" style="--delay:180ms">
                    <div class="service-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2z"/>
                            <path d="M12 6v6l4 2"/>
                        </svg>
                    </div>
                    <h3>Nutrición clínica y flexible</h3>
                    <p>Planes de alimentación estructurados desde la evidencia científica, sin pasar hambre ni prohibir alimentos. Abordamos digestión, salud hormonal y energía para que disfrutes del camino.</p>
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
                    <p>Seguimiento estrecho durante todo el proceso. Evaluamos avances, ajustamos variables y resolvemos dudas para que sientas seguridad y respaldo en cada etapa.</p>
                </article>

            </div>
        </div>
    </section>

    <!-- ESPECIALIDADES Y CASUÍSTICAS QUE ATENDEMOS -->
    <section class="wrap section">
        <p class="kicker reveal">Abordaje especializado</p>
        <h2 class="reveal" style="--delay:60ms">Áreas clínicas y situaciones que tratamos</h2>
        <p class="lead reveal" style="--delay:120ms">Cada cuerpo tiene una historia diferente. Adaptamos la metodología tanto si buscas optimizar tu composición corporal como si necesitas resolver un problema de salud específico.</p>

        <div class="specialties-badges reveal" style="--delay:180ms">
            <span class="spec-tag">Salud hormonal femenina (SOP, amenorrea, menopausia)</span>
            <span class="spec-tag">Patologías digestivas & microbiota (FODMAP, colon irritable)</span>
            <span class="spec-tag">Recomposición corporal y pérdida de grasa</span>
            <span class="spec-tag">Antropometría y valoración de composición corporal (ISAK)</span>
            <span class="spec-tag">Nutrición deportiva y rendimiento</span>
            <span class="spec-tag">Alergias e intolerancias alimentarias</span>
            <span class="spec-tag">Educación nutricional y cambio de relación con la comida</span>
            <span class="spec-tag">Nutrición en embarazo y postparto</span>
            <span class="spec-tag">Alimentación vegetariana y vegana bien estructurada</span>
            <span class="spec-tag">Entrenamiento de fuerza enfocado a la salud</span>
        </div>
    </section>

    <!-- PASOS DEL PROCESO — Timeline -->
    <section class="band">
        <div class="wrap section">
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
        </div>
    </section>

    <!-- ESPACIO / INSTALACIONES -->
    <section class="wrap section two-col">
        <div class="reveal-scale" style="--delay:0ms">
            <img src="<?= e(img('espacio.png')) ?>"
                 alt="Instalaciones del Método ESN"
                 loading="lazy"
                 width="1024" height="683"
                 class="espacio-img">
        </div>
        <div>
            <p class="kicker reveal">Tu entorno de salud</p>
            <h2 class="reveal" style="--delay:80ms">Un espacio pensado para cuidar de ti</h2>
            <p class="reveal" style="--delay:160ms">
                Queremos que desde el primer momento te sientas con total comodidad y confianza. Trabajamos en unas instalaciones modernas en Madrid, equipadas con tecnología de valoración de composición corporal y diseñadas para ofrecer un entorno tranquilo, profesional y cercano.
            </p>
            <p class="reveal" style="--delay:220ms">
                <strong>¿Prefieres no desplazarte?</strong> Disponemos también de consulta online completa con videollamada y seguimiento para acompañarte vivas donde vivas.
            </p>
            <p class="reveal" style="--delay:280ms">
                <a class="btn" href="/reserva-de-citas.php">
                    <span>Reserva tu cita</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </p>
        </div>
    </section>

    <!-- CTA FINAL -->
    <section class="wrap section">
        <div class="cta reveal">
            <h2>Tu proceso comienza con una valoración</h2>
            <p>La primera sesión es el punto de partida: analizamos juntos tu situación actual, tus hábitos y diseñamos el plan individualizado que mejor se adapta a ti.</p>
            <div class="cta-actions">
                <a class="btn" href="/reserva-de-citas.php">Reserva tu valoración inicial</a>
                <a class="btn btn-ghost" href="/contacto.php">Consúltanos tus dudas</a>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

<?php
$pageTitle = 'Entrenamiento | Salud | Nutrición';
$pageDesc  = 'Método ESN por Elena Sánchez Novo. Entrenamiento personal, nutrición clínica y acompañamiento basado en evidencia científica y máxima individualización.';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">

    <!-- HERO -->
    <section class="hero">
        <div class="wrap hero-grid">
            <div class="hero-text">
                <!-- Badge de reputación en Doctoralia -->
                <a href="<?= e($statsReputacion['url']) ?>" target="_blank" rel="noopener" class="hero-badge reveal" style="--delay:0ms">
                    <span class="stars-icon" aria-hidden="true">★★★★★</span>
                    <span class="badge-text"><strong><?= e($statsReputacion['puntuacion']) ?></strong> en Doctoralia · <?= e($statsReputacion['opiniones']) ?> opiniones verificadas</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>

                <p class="kicker reveal" style="--delay:60ms">Elena Sánchez Novo · Col. Nº <?= e(SITE_COLLEGIATE_NUMBER) ?> · CAFyD & Nutrición</p>
                <h1 class="reveal" style="--delay:120ms">Método ESN</h1>
                <p class="hero-sub reveal" style="--delay:180ms"><?= e(SITE_TAGLINE) ?></p>
                <h2 class="hero-lead reveal" style="--delay:240ms">Cuidar de tu salud no debería ser complicado, restrictivo ni temporal.</h2>
                <p class="reveal" style="--delay:300ms">
                    Un proceso integral que une movimiento, nutrición y hábitos adaptados a tu vida real. Sin dietas de fotocopia, sin exigencias imposibles y con el acompañamiento profesional que marca la diferencia.
                </p>
                <div class="actions reveal" style="--delay:360ms">
                    <a class="btn" href="/reserva-de-citas.php">
                        <span>Reserva tu cita</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                    <a class="btn btn-ghost" href="/servicios.php">Conoce los servicios</a>
                </div>

                <!-- Micro-garantías bajo los botones -->
                <div class="hero-guarantees reveal" style="--delay:420ms">
                    <div class="guarantee-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>Evidencia científica</span>
                    </div>
                    <div class="guarantee-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>Presencial y Online</span>
                    </div>
                    <div class="guarantee-item">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        <span>100% individualizado</span>
                    </div>
                </div>
            </div>

            <!-- Media del Hero con Floating Badges -->
            <div class="hero-media reveal-scale" style="--delay:180ms">
                <img class="hero-img-a" src="<?= e(img('hero-1.png')) ?>" alt="Elena Sánchez Novo - Método ESN" width="682" height="1024">
                <img class="hero-img-b" src="<?= e(img('hero-2.png')) ?>" alt="Entrenamiento y salud en consulta" width="600" height="400">
                
                <!-- Floating stat badge -->
                <div class="hero-floating-stat" aria-hidden="true">
                    <span class="stat-num">50+</span>
                    <span class="stat-desc">Pacientes acompañados con <strong>5.0 de valoración</strong></span>
                </div>
            </div>
        </div>
    </section>

    <!-- INTRO DESTACADA -->
    <section class="wrap section intro">
        <p class="kicker reveal">Un enfoque diferente</p>
        <h2 class="reveal" style="--delay:60ms">La salud es un todo: no existen atajos ni recetas universales</h2>
        <p class="lead reveal" style="--delay:120ms">
            Mi método ofrece planes de entrenamiento y nutrición completamente individualizados y basados en evidencia científica. Mantener y mejorar tu salud es la base sobre la que se crea cada decisión. La clave de su eficacia reside en un acompañamiento cercano y constante: convertirnos en un equipo para construir cambios que duren toda la vida.
        </p>
    </section>

    <!-- PRINCIPIOS (BENTO GRID CON MOTION) -->
    <section class="band">
        <div class="wrap section">
            <p class="kicker reveal">Nuestros fundamentos</p>
            <h2 class="reveal" style="--delay:60ms">Principios que sustentan el Método ESN</h2>
            <div class="principles">
                <?php foreach ($principios as $i => [$titulo, $texto]): ?>
                    <article class="principle reveal" style="--delay:<?= $i * 80 ?>ms">
                        <div class="principle-header">
                            <span class="principle-num">0<?= $i + 1 ?></span>
                            <h3><?= e($titulo) ?></h3>
                        </div>
                        <p><?= e($texto) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="gallery">
                <img src="<?= e(img('metodo-1.png')) ?>" alt="Metodología ESN en entrenamiento" loading="lazy" width="683" height="1024">
                <img src="<?= e(img('metodo-2.png')) ?>" alt="Planificación y composición corporal" loading="lazy" width="683" height="1024">
                <img src="<?= e(img('metodo-3.png')) ?>" alt="Instalaciones y consulta en Madrid" loading="lazy" width="600" height="400">
            </div>
        </div>
    </section>

    <!-- ESPECIALIDADES Y ÁREAS CLÍNICAS (NUEVO BLOQUE DE AUTORIDAD) -->
    <section class="wrap section">
        <p class="kicker reveal">Áreas de especialización</p>
        <h2 class="reveal" style="--delay:60ms">¿En qué podemos ayudarte?</h2>
        <p class="lead reveal" style="--delay:120ms">Abordamos tu salud desde una perspectiva rigurosa, adaptando cada plan a tus objetivos clínicos, estéticos o de rendimiento.</p>
        
        <div class="areas-grid reveal" style="--delay:180ms">
            <div class="area-card">
                <div class="area-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8h1a4 4 0 0 1 0 8h-1M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                </div>
                <h3>Salud Digestiva & Microbiota</h3>
                <p>Manejo de hinchazón, intolerancias, colon irritable, protocolos FODMAP y mejora del bienestar intestinal con base científica.</p>
            </div>

            <div class="area-card">
                <div class="area-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <h3>Salud Hormonal de la Mujer</h3>
                <p>Acompañamiento especializado en SOP, amenorrea, regularidad menstrual, fertilidad, postparto y perimenopausia.</p>
            </div>

            <div class="area-card">
                <div class="area-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 16.326A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="m8 19 4-4 4 4"/></svg>
                </div>
                <h3>Recomposición Corporal & Fuerza</h3>
                <p>Pérdida de grasa conservando masa muscular, mejora del metabolismo y valoración antropométrica avanzada (Método ISAK).</p>
            </div>

            <div class="area-card">
                <div class="area-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <h3>Nutrición Deportiva & Rendimiento</h3>
                <p>Estrategias de alimentación y suplementación adaptadas a tu disciplina, intensidad de entrenamientos y ritmo de competición.</p>
            </div>
        </div>
    </section>

    <!-- PASOS — TIMELINE INTERACTIVO -->
    <section class="band">
        <div class="wrap section">
            <p class="kicker reveal">Tu camino dentro del Método ESN</p>
            <h2 class="reveal" style="--delay:80ms">Cómo funcionamos paso a paso</h2>
            <div class="timeline" id="esn-timeline">
                <div class="timeline-track" aria-hidden="true">
                    <div class="timeline-progress"></div>
                </div>
                <ol class="steps">
                    <?php foreach ($pasos as $i => [$titulo, $texto]): ?>
                        <li class="reveal" style="--delay:<?= ($i * 140) + 160 ?>ms">
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

    <!-- TESTIMONIOS Y PRUEBA SOCIAL REAL DE DOCTORALIA -->
    <section class="wrap section">
        <div class="reviews-header">
            <div>
                <p class="kicker reveal">Opiniones reales</p>
                <h2 class="reveal" style="--delay:60ms">Historias y transformaciones reales</h2>
                <p class="lead reveal" style="--delay:120ms">La mejor prueba del método es la voz de quienes ya lo viven cada día.</p>
            </div>
            
            <!-- Tarjeta resumen de Doctoralia -->
            <div class="doctoralia-score-card reveal" style="--delay:180ms">
                <div class="score-top">
                    <span class="score-number"><?= e($statsReputacion['puntuacion']) ?></span>
                    <div class="score-stars">
                        <span class="stars-gold" aria-hidden="true">★★★★★</span>
                        <span class="score-count"><?= e($statsReputacion['opiniones']) ?> opiniones verificadas</span>
                    </div>
                </div>
                <p class="score-sub">Valoración máxima en <strong>Doctoralia España</strong></p>
                <a href="<?= e($statsReputacion['url']) ?>" target="_blank" rel="noopener" class="score-link">
                    <span>Ver perfil oficial</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>
            </div>
        </div>

        <div class="quotes-grid">
            <?php foreach ($testimonios as $i => $item): ?>
                <figure class="quote-card reveal" style="--delay:<?= $i * 90 ?>ms">
                    <div class="quote-stars" aria-hidden="true">★★★★★</div>
                    <span class="quote-topic"><?= e($item['tema']) ?></span>
                    <blockquote><p>«<?= e($item['cita']) ?>»</p></blockquote>
                    <figcaption>
                        <div class="quote-author-info">
                            <strong><?= e($item['autor']) ?></strong>
                            <span class="quote-verified">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                                <?= e($item['origen']) ?>
                            </span>
                        </div>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- CTA FINAL ELEVADO -->
    <section class="wrap section">
        <div class="cta reveal">
            <h2>Comienza hoy a construir tu salud definitiva</h2>
            <p>Ponte en contacto para resolver tus dudas, conocer el método y valorar juntos cuál es el mejor camino para ti. Sin compromisos ni falsas promesas.</p>
            <div class="cta-actions">
                <a class="btn" href="/reserva-de-citas.php">Reserva tu cita ahora</a>
                <a class="btn btn-ghost" href="/contacto.php">Habla con nosotros</a>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

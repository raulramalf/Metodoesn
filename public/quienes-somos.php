<?php
$pageTitle = 'Quiénes somos';
$pageDesc  = 'Elena Sánchez Novo (Col. Nº MAD01639): graduada en Nutrición Humana y Dietética y CAFyD. Un acompañamiento basado en la ciencia, la empatía y la máxima individualización.';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">

    <!-- BIO PRINCIPAL -->
    <section class="wrap section about">

        <!-- Fotos: entrada con scale reveal escalonado -->
        <div class="about-media">
            <img class="reveal-scale"
                 style="--delay:0ms"
                 src="<?= e(img('elena-1.jpeg')) ?>"
                 alt="<?= e(SITE_OWNER) ?> · Nutricionista y entrenadora personal"
                 width="480" height="600">
            <img class="reveal-scale"
                 style="--delay:220ms"
                 src="<?= e(img('elena-2.jpeg')) ?>"
                 alt="Elena Sánchez Novo en consulta"
                 loading="lazy"
                 width="480" height="600">
            
            <!-- Badge colegiada y titulación -->
            <div class="about-col-badge reveal" style="--delay:300ms">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                <span>Colegiada <strong>Nº <?= e(SITE_COLLEGIATE_NUMBER) ?></strong> · CODINMA</span>
            </div>
        </div>

        <!-- Texto bio: redactado por Elena en Doctoralia -->
        <div class="prose">
            <p class="kicker reveal">Sobre mí</p>
            <h1 class="reveal" style="--delay:80ms"><?= e(SITE_OWNER) ?></h1>
            <p class="hero-sub reveal" style="--delay:140ms">Dietista-Nutricionista (Col. Nº <?= e(SITE_COLLEGIATE_NUMBER) ?>) · Graduada en CAFyD</p>
            
            <p class="reveal" style="--delay:200ms">
                Cuidar la alimentación no consiste en seguir una dieta perfecta, sino en encontrar una forma de comer que se adapte a ti, a tu estilo de vida y a tus objetivos. Mi trabajo consiste en ayudarte a conseguirlo de una manera realista, personalizada y basada en la evidencia científica.
            </p>
            
            <p class="reveal" style="--delay:270ms">
                Soy graduada en <strong>Nutrición Humana y Dietética</strong> y en <strong>Ciencias de la Actividad Física y del Deporte (CAFyD)</strong>, lo que me permite abordar la salud desde una perspectiva integral. Entiendo que la alimentación y el ejercicio no funcionan por separado, sino que forman parte de un mismo proceso para mejorar tu bienestar, tu composición corporal y tu calidad de vida.
            </p>
            
            <p class="reveal" style="--delay:340ms">
                Acompaño a personas que desean perder grasa, realizar una recomposición corporal, ganar masa muscular, mejorar su rendimiento deportivo, cuidar su salud digestiva, optimizar su salud hormonal o simplemente aprender a alimentarse mejor. Cada tratamiento comienza con una valoración completa para conocer tu situación y diseñar un plan totalmente adaptado a tus necesidades, preferencias y ritmo de vida.
            </p>
            
            <p class="reveal" style="--delay:410ms">
                Mi forma de trabajar se basa en el <strong>seguimiento continuo, la educación nutricional y la adaptación constante del tratamiento</strong>. No creo en las dietas restrictivas ni en las soluciones rápidas, sino en construir hábitos que puedas mantener a largo plazo y que te permitan disfrutar de la alimentación sin renunciar a tus objetivos.
            </p>
            
            <p class="reveal" style="--delay:480ms">
                Para mí, cada paciente es diferente. Por eso escuchar, comprender tu situación y trabajar contigo de forma cercana es una parte fundamental del proceso. Mi objetivo no es únicamente ayudarte a conseguir un resultado, sino darte las herramientas necesarias para que puedas mantenerlo en el tiempo con seguridad y confianza.
            </p>

            <p class="reveal" style="--delay:540ms">
                <em>Si has decidido dar el paso para mejorar tu salud, estaré encantada de acompañarte durante ese camino.</em>
            </p>
        </div>
    </section>

    <!-- METODOLOGÍA Y ENFOQUE NUTRICIONAL (ESCRITO POR ELENA) -->
    <section class="band">
        <div class="wrap section">
            <p class="kicker reveal">Metodología clínica</p>
            <h2 class="reveal" style="--delay:60ms">Mi enfoque de trabajo: un proceso en equipo</h2>
            <div class="principles">
                <article class="principle reveal" style="--delay:100ms">
                    <div class="principle-header">
                        <span class="principle-num">01</span>
                        <h3>Comprender antes de pautar</h3>
                    </div>
                    <p>Mi forma de trabajar se basa en comprender a la persona antes de diseñar cualquier plan. No creo en dietas estándar ni en restricciones innecesarias, porque cada organismo, cada objetivo y cada estilo de vida son diferentes. La primera consulta comienza con una valoración completa de tu estado de salud, hábitos, alimentación, composición corporal, antecedentes y objetivos.</p>
                </article>

                <article class="principle reveal" style="--delay:180ms">
                    <div class="principle-header">
                        <span class="principle-num">02</span>
                        <h3>Acompañamiento en la vida real</h3>
                    </div>
                    <p>El verdadero tratamiento no empieza cuando recibes tu plan, sino cuando comienzas a ponerlo en práctica. No entiendo la nutrición como una sucesión de consultas aisladas, sino como un proceso en equipo en el que resolvemos dudas, realizamos ajustes según tu evolución y nos adaptamos a los cambios del día a día.</p>
                </article>

                <article class="principle reveal" style="--delay:260ms">
                    <div class="principle-header">
                        <span class="principle-num">03</span>
                        <h3>Cada revisión tiene un propósito</h3>
                    </div>
                    <p>Analizamos tu evolución, identificamos dificultades, reforzamos avances y adaptamos el plan siempre que sea necesario. Mi prioridad es que nunca sientas que afrontas el proceso en solitario y que comprendas el porqué de cada pauta para ganar autonomía.</p>
                </article>

                <article class="principle reveal" style="--delay:340ms">
                    <div class="principle-header">
                        <span class="principle-num">04</span>
                        <h3>Educación nutricional y autonomía</h3>
                    </div>
                    <p>No busco que dependas eternamente de un menú, sino darte el conocimiento y la confianza necesarios para que, con el tiempo, seas capaz de tomar las mejores decisiones para tu salud por ti mismo.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- FORMACIÓN Y TÍTULOS ACADÉMICOS OFICIALES -->
    <section class="wrap section two-col">
        <div>
            <p class="kicker reveal">Rigor académico y colegiación</p>
            <h2 class="reveal" style="--delay:60ms">Formación oficial</h2>
            <ul class="checks">
                <?php foreach ($formacion as $i => $f): ?>
                    <li class="reveal" style="--delay:<?= ($i * 90) + 80 ?>ms">
                        <?= e($f) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div>
            <p class="kicker reveal">Filosofía</p>
            <h2 class="reveal" style="--delay:60ms">Una idea central</h2>
            <blockquote class="pull reveal" style="--delay:160ms">
                «No entiendo la nutrición como una sucesión de consultas, sino como un proceso en el que paciente y profesional trabajan como un mismo equipo hacia un objetivo común: lograr cambios reales, sostenibles y compatibles con tu forma de vivir.»
            </blockquote>
        </div>
    </section>

    <!-- CTA FINAL -->
    <section class="wrap section">
        <div class="cta reveal">
            <h2>¿Preparada para empezar tu proceso?</h2>
            <p>Cada proceso es único. Si quieres mejorar tu salud, tu composición corporal o tu relación con la alimentación y el movimiento, estaré encantada de acompañarte.</p>
            <div class="cta-actions">
                <a class="btn" href="/reserva-de-citas.php">Reserva tu valoración inicial</a>
                <a class="btn btn-ghost" href="/contacto.php">Habla con Elena</a>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

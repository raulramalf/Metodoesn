<?php
$pageTitle = 'Quiénes somos';
$pageDesc = 'Elena Sánchez Novo: graduada en CAFyD y Nutrición Humana y Dietética. Un servicio basado en el conocimiento, la evidencia científica y la individualización.';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">
    <section class="wrap section about">
        <div class="about-media">
            <img src="<?= e(img('elena-1.jpeg')) ?>" alt="<?= e(SITE_OWNER) ?>" width="480" height="600">
            <img src="<?= e(img('elena-2.jpeg')) ?>" alt="" loading="lazy" width="480" height="600">
        </div>
        <div class="prose">
            <h1><?= e(SITE_OWNER) ?></h1>
            <p>Mi vocación siempre ha sido comprender el cuerpo humano desde una perspectiva global para poder ofrecer un servicio basado en el conocimiento, la evidencia científica y la individualización. Por ello, decidí cursar simultáneamente tres carreras relacionadas con la salud, el ejercicio y la educación, entre ellas el Grado en Ciencias de la Actividad Física y del Deporte (CAFyD) y Nutrición Humana y Dietética.</p>
            <p>Mi objetivo siempre ha sido comprender cómo interactúan el ejercicio, la alimentación, la composición corporal y los hábitos de vida para ofrecer un enfoque realmente integral de la salud. Esta visión se enriqueció durante mi formación de posgrado en el extranjero, donde tuve la oportunidad de conocer diferentes metodologías de trabajo y ampliar mi perspectiva profesional.</p>
            <p>A lo largo de mi trayectoria he trabajado como nutricionista y entrenadora personal tanto en España como fuera de ella, acompañando a personas con objetivos muy diversos relacionados con la salud, la mejora de hábitos, la composición corporal y el rendimiento físico. Esta experiencia me ha enseñado que los mejores resultados no se consiguen mediante soluciones rápidas, sino a través de estrategias personalizadas, sostenibles y adaptadas a la realidad de cada persona.</p>
            <p>Me gusta crear un entorno cercano y de confianza en el que cada paciente se sienta escuchado y comprendido. Por ello, considero fundamental realizar una valoración completa de la situación individual para diseñar planes ajustados a sus necesidades, objetivos y estilo de vida.</p>
            <p>La formación continua forma parte de mi compromiso profesional, permitiéndome trabajar siempre desde la evidencia científica más actual. Mi objetivo no es únicamente ayudarte durante las consultas, sino proporcionarte las herramientas, el conocimiento y el acompañamiento necesarios para construir hábitos duraderos que mejoren tu salud y calidad de vida a largo plazo.</p>
        </div>
    </section>

    <section class="band">
        <div class="wrap section two-col">
            <div>
                <h2>Formación y especialización</h2>
                <ul class="checks">
                    <?php foreach ($formacion as $f): ?><li><?= e($f) ?></li><?php endforeach; ?>
                </ul>
            </div>
            <div>
                <h2>Mi filosofía de trabajo</h2>
                <blockquote class="pull">«Creo que la salud no debe basarse en restricciones extremas ni en soluciones rápidas. Mi objetivo es ayudarte a construir hábitos sostenibles que encajen con tu vida, respetando tus circunstancias, preferencias y ritmo de progreso. Porque los mejores resultados son aquellos que puedes mantener en el tiempo.»</blockquote>
            </div>
        </div>
    </section>

    <section class="wrap section cta">
        <h2>¿Preparado para empezar?</h2>
        <p>«Cada proceso es único. Si quieres mejorar tu salud, tu composición corporal o tu relación con los hábitos, estaré encantada de acompañarte.»</p>
        <a class="btn" href="/reserva-de-citas.php">Reserva tu valoración inicial</a>
    </section>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

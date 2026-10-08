<?php
$pageTitle = 'Aviso Legal';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
?>
<main id="main">
    <article class="wrap section prose-wide">
        <p class="kicker">Información Legal</p>
        <h1>Aviso Legal</h1>
        <p class="lead">
            En cumplimiento del artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y Comercio Electrónico (LSSI-CE), se exponen los datos identificativos del titular de este sitio web.
        </p>

        <hr style="border:0; border-top:1px solid var(--line); margin: 2rem 0;">

        <h2>1. Datos Identificativos del Responsable</h2>
        <ul>
            <li><strong>Titular:</strong> Elena Sánchez Novo</li>
            <li><strong>Nombre comercial:</strong> <?= e(SITE_NAME) ?></li>
            <li><strong>Cualificación profesional:</strong> Graduada en Ciencias de la Actividad Física y del Deporte (CAFyD) y Graduada en Nutrición Humana y Dietética</li>
            <li><strong>Número de Colegiada:</strong> <?= e(SITE_COLLEGIATE_NUMBER) ?> (Colegio Profesional de Dietistas-Nutricionistas de la Comunidad de Madrid - CODINMA)</li>
            <li><strong>Dirección de consulta:</strong> Clínica SurgEOM, <?= e(SITE_ADDRESS) ?></li>
            <li><strong>Correo electrónico:</strong> <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
            <li><strong>Teléfono de contacto:</strong> <a href="tel:<?= e(SITE_PHONE_LINK) ?>"><?= e(SITE_PHONE) ?></a></li>
            <li><strong>Dominio web:</strong> <?= e(SITE_CANONICAL) ?></li>
        </ul>

        <h2>2. Objeto y Ámbito de Aplicación</h2>
        <p>
            El presente sitio web tiene como finalidad facilitar información sobre los servicios profesionales de nutrición clínica, asesoramiento dietético y entrenamiento para la salud ofrecidos por Elena Sánchez Novo, así como permitir la reserva de citas y el contacto directo con la profesional.
        </p>

        <h2>3. Condiciones de Uso y Exención de Responsabilidad Médica</h2>
        <p>
            El acceso y uso de este sitio web atribuye la condición de usuario, implicando la aceptación de las presentes condiciones.
        </p>
        <p>
            <strong>Aviso de salud importante:</strong> Los contenidos, artículos y recomendaciones divulgativas compartidos en este sitio web tienen carácter estrictamente informativo y pedagógico. En ningún caso sustituyen el diagnóstico, prescripción médica o tratamiento individualizado por parte de un facultativo o profesional sanitario cualificado. Cada paciente requiere una valoración pormenorizada de su historial clínico y analítico antes de iniciar cualquier plan nutricional o de entrenamiento.
        </p>

        <h2>4. Propiedad Intelectual e Industrial</h2>
        <p>
            Todos los contenidos de este sitio web (textos, fotografías, logotipos, combinaciones cromáticas, estructura, diseño y código fuente) son titularidad de Elena Sánchez Novo o se cuenta con las licencias y consentimientos pertinentes para su uso, quedando expresamente prohibida su reproducción, distribución o comunicación pública sin autorización previa por escrito.
        </p>

        <h2>5. Enlaces a Terceros</h2>
        <p>
            Este sitio web incluye enlaces a plataformas externas, tales como el perfil oficial de reservas de citas en <em>Doctoralia</em> o redes sociales (Instagram). Elena Sánchez Novo no asume responsabilidad sobre las políticas de privacidad, disponibilidad o contenidos de dichos sitios externos.
        </p>

        <h2>6. Legislación Aplicable y Jurisdicción</h2>
        <p>
            Para la resolución de cualquier controversia relativa a este sitio web o a las actividades en él desarrolladas, será de aplicación la legislación española vigente, siendo competentes los Juzgados y Tribunales de la ciudad de Madrid.
        </p>

        <p style="font-size: 0.85rem; color: var(--ink-soft); margin-top: 2rem;">
            <em>Última actualización: Octubre de <?= date('Y') ?>.</em>
        </p>
    </article>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

<?php
$pageTitle = 'Política de Privacidad';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
?>
<main id="main">
    <article class="wrap section prose-wide">
        <p class="kicker">Protección de Datos</p>
        <h1>Política de Privacidad</h1>
        <p class="lead">
            De conformidad con el Reglamento (UE) 2016/679 (RGPD) y la Ley Orgánica 3/2018 (LOPDGDD), te informamos de manera clara y transparente sobre el tratamiento de tus datos personales a través de <strong><?= e(SITE_NAME) ?></strong>.
        </p>

        <hr style="border:0; border-top:1px solid var(--line); margin: 2rem 0;">

        <h2>1. Responsable del Tratamiento</h2>
        <ul>
            <li><strong>Responsable:</strong> Elena Sánchez Novo (Col. Nº <?= e(SITE_COLLEGIATE_NUMBER) ?>)</li>
            <li><strong>Domicilio profesional:</strong> Clínica SurgEOM, <?= e(SITE_ADDRESS) ?></li>
            <li><strong>Email de contacto:</strong> <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
            <li><strong>Teléfono:</strong> <a href="tel:<?= e(SITE_PHONE_LINK) ?>"><?= e(SITE_PHONE) ?></a></li>
        </ul>

        <h2>2. Finalidades del Tratamiento y Base Jurídica</h2>
        <p>Los datos personales que nos facilites a través del sitio web serán tratados con las siguientes finalidades:</p>
        <ul>
            <li>
                <strong>Gestión de consultas y contacto:</strong> Atender las peticiones, dudas o mensajes remitidos a través del formulario de contacto o vías directas (email/teléfono).
                <br><em>Base jurídica:</em> Tu consentimiento expreso al enviar el formulario (Art. 6.1.a RGPD).
            </li>
            <li>
                <strong>Gestión y reserva de citas:</strong> Tramitar solicitudes de consulta presencial u online y coordinar la agenda médica y nutricional.
                <br><em>Base jurídica:</em> Aplicación de medidas precontractuales o ejecución de la relación asistencial (Art. 6.1.b RGPD).
            </li>
            <li>
                <strong>Cumplimiento de obligaciones legales sanitarias:</strong> Conservación y custodia de historiales clínicos y facturación sanitaria cuando se formalice una consulta.
                <br><em>Base jurídica:</em> Cumplimiento de obligaciones legales aplicables a profesionales sanitarios (Ley 41/2002 de autonomía del paciente).
            </li>
        </ul>

        <h2>3. Categorías de Datos Tratados</h2>
        <p>A través de la web se tratan datos identificativos y de contacto básicos (nombre, apellidos, correo electrónico, teléfono y motivo general de consulta). No envíes información médica o sensible detallada en el mensaje abierto del formulario general; la anamnesis clínica completa se realiza siempre en el entorno seguro de la consulta o mediante consentimiento médico específico.</p>

        <h2>4. Conservación de los Datos</h2>
        <p>
            Los datos facilitados para consultas se conservarán durante el tiempo necesario para resolver tu solicitud. En caso de iniciar una pauta nutricional o de entrenamiento, los datos clínicos se conservarán de conformidad con los plazos legales establecidos por la normativa sanitaria española (mínimo de 5 años desde la última asistencia).
        </p>

        <h2>5. Destinatarios y Cesión de Datos</h2>
        <p>
            Tus datos no serán cedidos a terceros, salvo obligación legal expresa o cuando sea indispensable para la prestación del servicio sanitario (por ejemplo, gestión de citas a través de la plataforma segura de Doctoralia o laboratorios de análisis clínicos con tu autorización previa).
        </p>

        <h2>6. Tus Derechos como Usuario</h2>
        <p>Puedes ejercer en cualquier momento tus derechos de:</p>
        <ul>
            <li><strong>Acceso:</strong> Conocer qué datos tuyos estamos tratando.</li>
            <li><strong>Rectificación:</strong> Solicitar la corrección de datos inexactos o incompletos.</li>
            <li><strong>Supresión («derecho al olvido»):</strong> Solicitar la eliminación de tus datos cuando ya no sean necesarios.</li>
            <li><strong>Limitación del tratamiento y Oposición:</strong> Restringir o negarte a ciertos usos.</li>
            <li><strong>Portabilidad:</strong> Recibir tus datos en un formato estructurado y de uso común.</li>
        </ul>
        <p>
            Para ejercer estos derechos, basta con enviar una solicitud por escrito a <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a> indicando en el asunto «Protección de Datos» y acreditando tu identidad. Asimismo, tienes derecho a presentar una reclamación ante la Agencia Española de Protección de Datos (<a href="https://www.aepd.es" target="_blank" rel="noopener">www.aepd.es</a>) si consideras vulnerados tus derechos.
        </p>

        <p style="font-size: 0.85rem; color: var(--ink-soft); margin-top: 2rem;">
            <em>Última actualización: Octubre de <?= date('Y') ?>.</em>
        </p>
    </article>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

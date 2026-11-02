    <article class="wrap section prose-wide">
        <p class="kicker">Protección de Datos</p>
        <h1>Política de Privacidad</h1>
        <p class="lead">
            De conformidad con el Reglamento (UE) 2016/679 (RGPD) y la Ley Orgánica 3/2018 (LOPDGDD), te informamos de manera clara y transparente sobre el tratamiento de tus datos personales a través de <strong><?= e(SITE_NAME) ?></strong>.
        </p>

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
        <p>A través del formulario de contacto tratamos tu nombre, tu correo electrónico y el contenido de tu mensaje. Si llamas o escribes directamente, también tu número de teléfono.</p>
        <p>Si decides incluir en el mensaje información sobre tu salud, se trata de una categoría especial de datos (art. 9 RGPD). Solo la usamos para responderte y la base jurídica es tu consentimiento explícito al enviar el formulario (art. 9.2.a RGPD). Te recomendamos no enviar detalles clínicos por esta vía: la valoración completa se realiza en consulta.</p>

        <h2>4. Conservación de los Datos</h2>
        <ul>
            <li><strong>Mensajes del formulario:</strong> se eliminan automáticamente <?= (int) (CONTACT_RETENTION_DAYS / 30) ?> meses después de recibirlos, salvo que inicies una relación asistencial.</li>
            <li><strong>Huella de la dirección IP:</strong> junto a cada mensaje se guarda una huella cifrada e irreversible de tu IP (nunca la IP en claro) para evitar envíos abusivos; se elimina a los <?= IP_RETENTION_DAYS ?> días.</li>
            <li><strong>Historia clínica:</strong> si inicias una pauta nutricional o de entrenamiento, los datos clínicos se conservan durante los plazos que fija la normativa sanitaria (mínimo de 5 años desde la última asistencia, Ley 41/2002).</li>
        </ul>

        <h2>5. Destinatarios, Encargados y Transferencias</h2>
        <p>Tus datos no se ceden a terceros salvo obligación legal o cuando sea indispensable para prestarte el servicio sanitario con tu autorización (por ejemplo, un laboratorio de análisis clínicos).</p>
        <p><strong>Encargados del tratamiento.</strong> Para que la web funcione, los siguientes proveedores tratan datos por cuenta de la responsable, con contrato de encargo conforme al art. 28 RGPD y sin poder usarlos para fines propios:</p>
        <ul>
            <li>Proveedor de alojamiento web, donde se guardan los mensajes del formulario.</li>
            <li>Proveedor de correo electrónico, por el que se recibe el aviso de cada mensaje y se te responde.</li>
        </ul>
        <p><strong>Servicios de terceros integrados.</strong> Solo si aceptas las cookies de terceros se cargan en tu navegador el calendario y el certificado de Doctoralia (Docplanner, con sede en la UE) y el mapa de Google Maps (Google). Google puede transferir datos técnicos de tu navegación a Estados Unidos; esa transferencia está amparada por el Marco de Privacidad de Datos UE-EE. UU. (decisión de adecuación de la Comisión Europea de 10 de julio de 2023). Si reservas cita a través de Doctoralia, esa plataforma trata tus datos según su propia política de privacidad.</p>

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

        <p class="legal-updated">
            <em>Última actualización: noviembre de 2026.</em>
        </p>
    </article>

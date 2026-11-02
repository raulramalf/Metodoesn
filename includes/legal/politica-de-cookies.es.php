    <article class="wrap section prose-wide">
        <p class="kicker">Información Legal y Transparencia</p>
        <h1>Política de Cookies</h1>
        <p class="lead">
            En <strong><?= e(SITE_NAME) ?></strong>, titularidad de <strong>Elena Sánchez Novo</strong> (Colegiada Nº <?= e(SITE_COLLEGIATE_NUMBER) ?>), respetamos tu privacidad y estamos comprometidos con la máxima transparencia sobre cómo tratamos tus datos y las tecnologías que empleamos.
        </p>

        <h2>1. ¿Qué son las cookies?</h2>
        <p>
            Una cookie es un pequeño archivo de texto que los sitios web almacenan en tu navegador o dispositivo al visitarlos. Las cookies permiten a una página web, entre otras cosas, funcionar adecuadamente, recordar tus preferencias de navegación, recopilar estadísticas anónimas de uso o integrar servicios y widgets de terceros (como calendarios de reserva médica o mapas).
        </p>

        <h2>2. ¿Qué tipos de cookies y almacenamiento utilizamos?</h2>
        <p>
            En este sitio web priorizamos el respeto a tu privacidad y reducimos al mínimo indispensable el uso de tecnologías de rastreo. Empleamos las siguientes categorías:
        </p>

        <div class="legal-table-wrap">
            <table class="legal-table">
                <thead>
                    <tr>
                        <th>Nombre / Clave</th>
                        <th>Proveedor</th>
                        <th>Finalidad</th>
                        <th>Duración</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>esn_cookies_pref</code></td>
                        <td>Propia (Método ESN)</td>
                        <td>Almacena tu preferencia sobre el consentimiento de cookies (aceptadas o solo necesarias).</td>
                        <td>Persistente (localStorage)</td>
                        <td><strong>Técnica (Obligatoria)</strong></td>
                    </tr>
                    <tr>
                        <td><code>PHPSESSID</code></td>
                        <td>Propia (Método ESN)</td>
                        <td>Sesión del servidor: protege el formulario de contacto frente a envíos fraudulentos (CSRF) y limita envíos repetidos.</td>
                        <td>Hasta cerrar el navegador</td>
                        <td><strong>Técnica (Obligatoria)</strong></td>
                    </tr>
                    <tr>
                        <td><code>site_lang</code></td>
                        <td>Propia (Método ESN)</td>
                        <td>Recuerda el idioma elegido (ES, EN o DE).</td>
                        <td>30 días</td>
                        <td><strong>Técnica (Obligatoria)</strong></td>
                    </tr>
                    <tr>
                        <td>Cookies de Terceros</td>
                        <td>Doctoralia / Google</td>
                        <td>Widgets de reservas, certificado y valoraciones de Doctoralia, y mapa de Google Maps. Solo se cargan si pulsas «Aceptar terceros».</td>
                        <td>Sesión / Tercero</td>
                        <td>Funcional / Terceros (con consentimiento)</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2>3. Cómo gestionar o cambiar tu consentimiento</h2>
        <p>
            Cuando accedes a nuestra web por primera vez, te mostramos un aviso informativo que te permite aceptar todas las cookies o limitar el uso a las estrictamente necesarias. Puedes modificar o revocar tu decisión en cualquier momento haciendo clic en el siguiente botón:
        </p>
        
        <div class="legal-box">
            <p><strong>Tu preferencia actual:</strong> Haz clic abajo si deseas que vuelva a aparecer el banner flotante para cambiar tu elección:</p>
            <button class="btn btn-sm btn-ghost" id="cookie-reset">Configurar preferencias de cookies</button>
        </div>

        <h2>4. Cómo deshabilitar las cookies desde tu navegador</h2>
        <p>
            Además de nuestro panel de control, puedes permitir, bloquear o eliminar las cookies instaladas en tu equipo mediante la configuración de las opciones del navegador que utilices:
        </p>
        <ul>
            <li><strong>Google Chrome:</strong> Configuración → Privacidad y seguridad → Cookies y otros datos de sitios.</li>
            <li><strong>Mozilla Firefox:</strong> Ajustes → Privacidad & Seguridad → Cookies y datos del sitio.</li>
            <li><strong>Apple Safari:</strong> Preferencias → Privacidad → Bloquear todas las cookies.</li>
            <li><strong>Microsoft Edge:</strong> Configuración → Cookies y permisos del sitio → Administrar y eliminar cookies y datos del sitio.</li>
        </ul>

        <h2>5. Responsable del tratamiento y contacto</h2>
        <p>
            Para cualquier duda relativa a nuestra Política de Cookies o al tratamiento de tus datos personales, puedes contactar directamente con <strong>Elena Sánchez Novo</strong>:
        </p>
        <ul>
            <li><strong>Email:</strong> <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
            <li><strong>Teléfono:</strong> <a href="tel:<?= e(SITE_PHONE_LINK) ?>"><?= e(SITE_PHONE) ?></a></li>
            <li><strong>Consulta Presencial:</strong> Clínica SurgEOM, <?= e(SITE_ADDRESS) ?></li>
        </ul>

        <p class="legal-updated">
            <em>Última actualización: Octubre de <?= date('Y') ?>.</em>
        </p>
    </article>

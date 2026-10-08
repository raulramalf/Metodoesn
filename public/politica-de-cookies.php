<?php
$pageTitle = 'Política de Cookies';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
?>
<main id="main">
    <article class="wrap section prose-wide">
        <p class="kicker">Información Legal y Transparencia</p>
        <h1>Política de Cookies</h1>
        <p class="lead">
            En <strong><?= e(SITE_NAME) ?></strong>, titularidad de <strong>Elena Sánchez Novo</strong> (Colegiada Nº <?= e(SITE_COLLEGIATE_NUMBER) ?>), respetamos tu privacidad y estamos comprometidos con la máxima transparencia sobre cómo tratamos tus datos y las tecnologías que empleamos.
        </p>

        <hr style="border:0; border-top:1px solid var(--line); margin: 2rem 0;">

        <h2>1. ¿Qué son las cookies?</h2>
        <p>
            Una cookie es un pequeño archivo de texto que los sitios web almacenan en tu navegador o dispositivo al visitarlos. Las cookies permiten a una página web, entre otras cosas, funcionar adecuadamente, recordar tus preferencias de navegación, recopilar estadísticas anónimas de uso o integrar servicios y widgets de terceros (como calendarios de reserva médica o mapas).
        </p>

        <h2>2. ¿Qué tipos de cookies y almacenamiento utilizamos?</h2>
        <p>
            En este sitio web priorizamos el respeto a tu privacidad y reducimos al mínimo indispensable el uso de tecnologías de rastreo. Empleamos las siguientes categorías:
        </p>

        <div style="overflow-x: auto; margin: 1.5rem 0;">
            <table style="width: 100%; border-collapse: collapse; font-size: 0.95rem; text-align: left;">
                <thead>
                    <tr style="background: var(--mist); border-bottom: 2px solid var(--line);">
                        <th style="padding: 0.75rem 1rem;">Nombre / Clave</th>
                        <th style="padding: 0.75rem 1rem;">Proveedor</th>
                        <th style="padding: 0.75rem 1rem;">Finalidad</th>
                        <th style="padding: 0.75rem 1rem;">Duración</th>
                        <th style="padding: 0.75rem 1rem;">Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid var(--line);">
                        <td style="padding: 0.75rem 1rem;"><code>esn_cookies</code></td>
                        <td style="padding: 0.75rem 1rem;">Propia (Método ESN)</td>
                        <td style="padding: 0.75rem 1rem;">Almacena tu preferencia sobre el consentimiento de cookies (aceptadas o solo necesarias).</td>
                        <td style="padding: 0.75rem 1rem;">Persistente (localStorage)</td>
                        <td style="padding: 0.75rem 1rem;"><strong>Técnica (Obligatoria)</strong></td>
                    </tr>
                    <tr style="border-bottom: 1px solid var(--line);">
                        <td style="padding: 0.75rem 1rem;">Cookies de Terceros</td>
                        <td style="padding: 0.75rem 1rem;">Doctoralia / Google</td>
                        <td style="padding: 0.75rem 1rem;">Carga de tipografías web y funcionamiento del widget de reservas o valoraciones clínicas si decides interactuar con ellos.</td>
                        <td style="padding: 0.75rem 1rem;">Sesión / Tercero</td>
                        <td style="padding: 0.75rem 1rem;">Funcional / Terceros</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2>3. Cómo gestionar o cambiar tu consentimiento</h2>
        <p>
            Cuando accedes a nuestra web por primera vez, te mostramos un aviso informativo que te permite aceptar todas las cookies o limitar el uso a las estrictamente necesarias. Puedes modificar o revocar tu decisión en cualquier momento haciendo clic en el siguiente botón:
        </p>
        
        <div style="background: var(--mist); padding: 1.5rem; border-radius: var(--radius); margin: 1.5rem 0; border: 1px solid var(--line);">
            <p style="margin: 0 0 1rem 0;"><strong>Tu preferencia actual:</strong> Haz clic abajo si deseas que vuelva a aparecer el banner flotante para cambiar tu elección:</p>
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

        <p style="font-size: 0.85rem; color: var(--ink-soft); margin-top: 2rem;">
            <em>Última actualización: Octubre de <?= date('Y') ?>.</em>
        </p>
    </article>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

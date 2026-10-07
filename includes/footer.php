<footer class="site-footer">
    <div class="wrap footer-grid">
        <div>
            <h2 class="footer-title"><?= e(SITE_NAME) ?></h2>
            <p>Entrenamiento personal, nutrición y salud para ayudarte a alcanzar tus objetivos de forma sostenible y adaptada a ti.</p>
        </div>
        <div>
            <h3>Contacto</h3>
            <ul class="plain">
                <li><a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
                <li><a href="tel:<?= e(SITE_PHONE_LINK) ?>"><?= e(SITE_PHONE) ?></a></li>
                <li><?= e(SITE_ADDRESS) ?></li>
            </ul>
        </div>
    </div>
    <div class="wrap footer-legal">
        <p>
            <a href="/aviso-legal.php">Aviso Legal</a> |
            <a href="/politica-de-privacidad.php">Política de Privacidad</a> |
            <a href="/politica-de-cookies.php">Política de Cookies</a>
        </p>
        <p>© <?= date('Y') ?> <?= e(SITE_NAME) ?>. Todos los derechos reservados.</p>
    </div>
</footer>

<div class="cookie" id="cookie" role="dialog" aria-label="Consentimiento de cookies" hidden>
    <p>Utilizamos cookies para mejorar tu experiencia en la web. Puedes aceptarlas o rechazarlas. Más información en la <a href="/politica-de-cookies.php">Política de Cookies</a>.</p>
    <div class="cookie-actions">
        <button class="btn btn-sm" data-cookie="accepted">Aceptar</button>
        <button class="btn btn-sm btn-ghost" data-cookie="denied">Denegar</button>
    </div>
</div>
<script src="<?= e(asset('js/main.js')) ?>"></script>
</body>
</html>

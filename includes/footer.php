<footer class="site-footer">
    <div class="wrap footer-grid">
        <div class="footer-brand-col">
            <h2 class="footer-title"><?= e(SITE_NAME) ?></h2>
            <p class="footer-tagline"><strong>Elena Sánchez Novo</strong> · CAFyD & Nutrición Humana y Dietética</p>
            <p>Entrenamiento personal, nutrición clínica y hábitos para ayudarte a alcanzar tus objetivos de forma sostenible, saludable y adaptada a ti.</p>
        </div>
        <div class="footer-reputation-col">
            <h3>Reputación Clínica</h3>
            <div class="footer-doctoralia-badge">
                <span class="stars-gold" aria-hidden="true">★★★★★</span>
                <strong>5.0 de 5</strong> en Doctoralia
                <p>Más de 50 opiniones verificadas de pacientes con 100% de recomendación.</p>
                <a href="<?= e(BOOKING_URL) ?>" target="_blank" rel="noopener" class="footer-doc-link">Ver perfil en Doctoralia →</a>
            </div>
        </div>
        <div class="footer-contact-col">
            <h3>Contacto & Consulta</h3>
            <ul class="plain footer-contact-list">
                <li><a href="tel:<?= e(SITE_PHONE_LINK) ?>"><?= e(SITE_PHONE) ?></a></li>
                <li><a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
                <li><a href="<?= e(SITE_INSTAGRAM_URL) ?>" target="_blank" rel="noopener"><?= e(SITE_INSTAGRAM) ?></a></li>
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
        <p>© <?= date('Y') ?> <?= e(SITE_NAME) ?> · Elena Sánchez Novo. Todos los derechos reservados.</p>
    </div>
</footer>

<div class="cookie" id="cookie" role="dialog" aria-label="Consentimiento de cookies" hidden>
    <p>Utilizamos cookies técnicas y analíticas para mejorar tu experiencia en la web. Puedes aceptarlas o rechazarlas libremente. Más información en la <a href="/politica-de-cookies.php">Política de Cookies</a>.</p>
    <div class="cookie-actions">
        <button class="btn btn-sm" data-cookie="accepted">Aceptar todas</button>
        <button class="btn btn-sm btn-ghost" data-cookie="denied">Solo necesarias</button>
    </div>
</div>
<script src="<?= e(asset('js/main.js')) ?>"></script>
</body>
</html>

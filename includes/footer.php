<footer class="site-footer">
    <div class="wrap footer-grid">
        <div class="footer-brand-col">
            <h2 class="footer-title"><?= e(SITE_NAME) ?></h2>
            <p class="footer-tagline"><strong>Elena Sánchez Novo</strong> (Col. Nº <?= e(SITE_COLLEGIATE_NUMBER) ?>) · CAFyD & Nutrición Humana y Dietética</p>
            <p>Entrenamiento personal, nutrición clínica y hábitos para ayudarte a alcanzar tus objetivos de forma sostenible, saludable y adaptada a ti.</p>
        </div>
        <div class="footer-reputation-col">
            <h3>Reputación Clínica</h3>
            <div class="footer-doctoralia-badge">
                <span class="stars-gold" aria-hidden="true">★★★★★</span>
                <strong>5.0 de 5</strong> en Doctoralia
                <p>Más de 50 opiniones verificadas de pacientes con 100% de recomendación.</p>
                <div class="footer-cert-wrap">
                    <a class="zl-url" href="https://www.doctoralia.es/elena-sanchez-novo/dietista-nutricionista/madrid" rel="nofollow" data-zlw-doctor="elena-sanchez-novo" data-zlw-type="certificate" data-zlw-opinion="false" data-zlw-hide-branding="true" data-zlw-saas-only="true" data-zlw-a11y-title="Certificado de verificación oficial en Doctoralia">Reserve una cita</a>
                    <script>!function($_x,_s,id){var js,fjs=$_x.getElementsByTagName(_s)[0];if(!$_x.getElementById(id)){js = $_x.createElement(_s);js.id = id;js.src = "//platform.docplanner.com/js/widget.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","zl-widget-s");</script>
                </div>
                <a href="<?= e(BOOKING_URL) ?>" target="_blank" rel="noopener" class="footer-doc-link">Ver perfil en Doctoralia →</a>
            </div>
        </div>
        <div class="footer-contact-col">
            <h3>Contacto & Consulta</h3>
            <ul class="plain footer-contact-list">
                <li>
                    <a href="tel:<?= e(SITE_PHONE_LINK) ?>" class="footer-contact-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="footer-item-icon" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <span><?= e(SITE_PHONE) ?></span>
                    </a>
                </li>
                <li>
                    <a href="mailto:<?= e(SITE_EMAIL) ?>" class="footer-contact-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="footer-item-icon" aria-hidden="true"><path d="m4 4 16 0c1.1 0 2 .9 2 2l0 12c0 1.1-.9 2-2 2l-16 0c-1.1 0-2-.9-2-2l0-12c0-1.1.9-2 2-2z"/><path d="m22 6-10 7L2 6"/></svg>
                        <span><?= e(SITE_EMAIL) ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?= e(SITE_INSTAGRAM_URL) ?>" target="_blank" rel="noopener" class="footer-contact-item footer-instagram-link">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="footer-item-icon" aria-hidden="true">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                        </svg>
                        <span><strong>Instagram:</strong> <?= e(SITE_INSTAGRAM) ?></span>
                    </a>
                </li>
                <li class="footer-contact-item footer-contact-address">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="footer-item-icon" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span><?= e(SITE_ADDRESS) ?></span>
                </li>
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
<!-- Librerías de Motion Design y Smooth Scroll -->
<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.20/dist/lenis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js"></script>
<script src="<?= e(asset('js/main.js')) ?>"></script>
</body>
</html>

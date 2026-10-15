<footer class="site-footer">
    <div class="wrap footer-grid">
        <div class="footer-brand">
            <h2><?= e(SITE_NAME) ?></h2>
            <p class="footer-tagline"><strong>Elena Sánchez Novo</strong> · Col. Nº <?= e(SITE_COLLEGIATE_NUMBER) ?> (CODINMA)</p>
            <p class="footer-desc">
                <?= e(t('footer_desc')) ?>
            </p>
            <div class="footer-lang-picker" style="margin-top:1.4rem;">
                <span style="font-size:0.8rem; text-transform:uppercase; letter-spacing:0.06em; color:rgba(255,255,255,0.5); display:block; margin-bottom:0.4rem;">Idioma / Language / Sprache:</span>
                <div class="lang-switch lang-switch-footer" role="group" aria-label="Cambiar idioma">
                    <a href="<?= e(lang_url('es')) ?>" class="lang-opt <?= current_lang() === 'es' ? 'is-active' : '' ?>">
                        <?= flag_svg('es', 14, 10) ?>
                        <span>Español</span>
                    </a>
                    <span class="lang-sep" aria-hidden="true">·</span>
                    <a href="<?= e(lang_url('en')) ?>" class="lang-opt <?= current_lang() === 'en' ? 'is-active' : '' ?>">
                        <?= flag_svg('en', 14, 10) ?>
                        <span>English</span>
                    </a>
                    <span class="lang-sep" aria-hidden="true">·</span>
                    <a href="<?= e(lang_url('de')) ?>" class="lang-opt <?= current_lang() === 'de' ? 'is-active' : '' ?>">
                        <?= flag_svg('de', 14, 10) ?>
                        <span>Deutsch</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-col">
            <h3><?= e(t('footer_clinical_rep')) ?></h3>
            <div class="footer-doctoralia-box">
                <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.4rem;">
                    <span class="stars-gold" aria-hidden="true">★★★★★</span>
                    <strong style="color:#ffffff;"><?= e(t('footer_rating_badge')) ?></strong>
                </div>
                <p style="margin-bottom:0.8rem; font-size:0.88rem; color:rgba(255,255,255,0.75);">
                    <?= e(t('footer_rating_sub')) ?>
                </p>
                <div class="footer-cert-wrap">
                    <a class="zl-url" href="https://www.doctoralia.es/elena-sanchez-novo/dietista-nutricionista/madrid" rel="nofollow" data-zlw-doctor="elena-sanchez-novo" data-zlw-type="certificate" data-zlw-opinion="false" data-zlw-hide-branding="true" data-zlw-saas-only="true" data-zlw-a11y-title="Certificado de verificación oficial en Doctoralia"><?= e(t('footer_view_cert')) ?></a>
                    <script nonce="<?= e(csp_nonce()) ?>">!function($_x,_s,id){var js,fjs=$_x.getElementsByTagName(_s)[0];if(!$_x.getElementById(id)){js = $_x.createElement(_s);js.id = id;js.src = "//platform.docplanner.com/js/widget.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","zl-widget-s");</script>
                </div>
            </div>
        </div>

        <div class="footer-col">
            <h3><?= e(t('footer_contact_title')) ?></h3>
            <ul class="footer-links">
                <li>
                    <a href="tel:<?= e(SITE_PHONE_LINK) ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <span><?= e(SITE_PHONE) ?></span>
                    </a>
                </li>
                <li>
                    <a href="mailto:<?= e(SITE_EMAIL) ?>">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        <span><?= e(SITE_EMAIL) ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?= e(SITE_INSTAGRAM_URL) ?>" target="_blank" rel="noopener">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                        <span>Instagram: <?= e(SITE_INSTAGRAM) ?></span>
                    </a>
                </li>
                <li>
                    <span style="display:inline-flex; align-items:flex-start; gap:0.5rem; font-size:0.92rem; color:rgba(255,255,255,0.7);">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top:4px; flex-shrink:0;" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span><?= e(SITE_ADDRESS) ?></span>
                    </span>
                </li>
            </ul>
        </div>
    </div>

    <?php if (current_lang() === 'es'): ?>
    <nav class="wrap footer-specialties" aria-label="Especialidades">
        <ul>
            <?php foreach (landings() as $slug => $l): ?>
                <li><a href="/<?= e($slug) ?>.php"><?= e($l['h1']) ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <?php endif; ?>

    <div class="wrap footer-legal-bar">
        <p>© <?= date('Y') ?> <?= e(SITE_NAME) ?> · Elena Sánchez Novo. <?= e(t('footer_rights')) ?></p>
        <div class="footer-legal-links">
            <a href="<?= e(page_url('/aviso-legal.php')) ?>"><?= e(t('footer_legal')) ?></a>
            <a href="<?= e(page_url('/politica-de-privacidad.php')) ?>"><?= e(t('footer_privacy')) ?></a>
            <a href="<?= e(page_url('/politica-de-cookies.php')) ?>"><?= e(t('footer_cookies')) ?></a>
        </div>
    </div>
</footer>

<!-- Banner de Cookies Accesible -->
<div class="cookie-banner" id="cookie" role="dialog" aria-label="Consentimiento de cookies" hidden>
    <p><?= e(t('cookie_text')) ?> <a href="<?= e(page_url('/politica-de-cookies.php')) ?>"><?= e(t('cookie_more')) ?></a>.</p>
    <div class="cookie-actions">
        <button class="btn btn-sm" data-cookie="accepted"><?= e(t('cookie_accept')) ?></button>
        <button class="btn btn-sm btn-ghost" data-cookie="denied"><?= e(t('cookie_deny')) ?></button>
    </div>
</div>

<script src="<?= e(asset('js/main.js')) ?>" defer></script>
</body>
</html>

<footer class="site-footer">
    <div class="wrap">
        <p class="footer-wordmark" aria-hidden="true"><?= e(SITE_NAME) ?></p>

        <div class="footer-grid">
            <div class="footer-brand">
                <h2><?= e(SITE_NAME) ?></h2>
                <p class="footer-tagline"><strong><?= e(SITE_OWNER) ?></strong> · <?= e(sprintf(t('rd_col'), SITE_COLLEGIATE_NUMBER)) ?> (CODINMA)</p>
                <p class="footer-desc"><?= e(t('footer_desc')) ?></p>
                <div class="lang-switch lang-switch-footer" role="group" aria-label="Idioma / Language / Sprache">
                    <?php foreach (['es' => 'Español', 'en' => 'English', 'de' => 'Deutsch'] as $code => $name): ?>
                    <a href="<?= e(lang_url($code)) ?>" class="lang-opt <?= current_lang() === $code ? 'is-active' : '' ?>" hreflang="<?= $code ?>" lang="<?= $code ?>">
                        <?= flag_svg($code, 14, 10) ?>
                        <span><?= e($name) ?></span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="footer-col">
                <h3><?= e(t('footer_clinical_rep')) ?></h3>
                <div class="footer-doctoralia-box">
                    <p class="footer-rating"><span class="stars-gold" aria-hidden="true"></span> <strong><?= e(t('footer_rating_badge')) ?></strong></p>
                    <p><?= e(t('footer_rating_sub')) ?></p>
                    <div class="footer-cert-wrap">
                        <a class="zl-url" href="https://www.doctoralia.es/elena-sanchez-novo/dietista-nutricionista/madrid" rel="nofollow" data-zlw-doctor="elena-sanchez-novo" data-zlw-type="certificate" data-zlw-opinion="false" data-zlw-hide-branding="true" data-zlw-saas-only="true" data-zlw-a11y-title="Certificado de verificación oficial en Doctoralia"><?= e(t('footer_view_cert')) ?></a>
                        <script type="text/plain" data-consent="thirdparty">!function($_x,_s,id){var js,fjs=$_x.getElementsByTagName(_s)[0];if(!$_x.getElementById(id)){js = $_x.createElement(_s);js.id = id;js.src = "//platform.docplanner.com/js/widget.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","zl-widget-s");</script>
                    </div>
                </div>
            </div>

            <div class="footer-col">
                <h3><?= e(t('footer_contact_title')) ?></h3>
                <ul class="footer-links">
                    <li><a href="tel:<?= e(SITE_PHONE_LINK) ?>"><?= e(SITE_PHONE) ?></a></li>
                    <li><a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></li>
                    <li><a href="<?= e(SITE_INSTAGRAM_URL) ?>" target="_blank" rel="noopener">Instagram: <?= e(SITE_INSTAGRAM) ?></a></li>
                    <li><span><?= e(SITE_ADDRESS) ?></span></li>
                </ul>
            </div>
        </div>

        <div class="footer-legal-bar">
            <p>© <?= date('Y') ?> <?= e(SITE_NAME) ?> · <?= e(SITE_OWNER) ?>. <?= e(t('footer_rights')) ?></p>
            <div class="footer-legal-links">
                <a href="<?= e(page_url('/aviso-legal.php')) ?>"><?= e(t('footer_legal')) ?></a>
                <a href="<?= e(page_url('/politica-de-privacidad.php')) ?>"><?= e(t('footer_privacy')) ?></a>
                <a href="<?= e(page_url('/politica-de-cookies.php')) ?>"><?= e(t('footer_cookies')) ?></a>
            </div>
        </div>
    </div>
</footer>

<a class="dock-cta btn" href="<?= e(page_url('/reserva-de-citas.php')) ?>">
    <span><?= e(t('nav_book')) ?></span>
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
</a>

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

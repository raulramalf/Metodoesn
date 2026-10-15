<?php
// Plantilla común de landings de servicio. Uso: $landingSlug = '...'; require __DIR__ . '/../src/landing_page.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/landings.php';
force_lang('es');                       // contenido solo en español (ver seo_landing_pages)
$L = landings()[$landingSlug] ?? null;
if (!$L) { http_response_code(404); exit; }
$pageTitle = $L['title'];
$pageDesc  = $L['desc'];
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
$stats = ['puntuacion' => SITE_RATING_VALUE, 'url' => BOOKING_URL];
?>
<main id="main" tabindex="-1">
    <section class="wrap section">
        <div class="wrap-narrow">
            <nav aria-label="Ruta de navegación" class="landing-crumbs">
                <a href="<?= e(page_url('/index.php')) ?>"><?= e(SITE_NAME) ?></a> › <a href="<?= e(page_url('/servicios.php')) ?>">Servicios</a> › <span aria-current="page"><?= e($L['kicker']) ?></span>
            </nav>
            <p class="kicker"><?= e($L['kicker']) ?></p>
            <h1><?= e($L['h1']) ?></h1>
            <p class="lead"><?= e($L['lead']) ?></p>
            <div class="landing-actions">
                <a class="btn" href="<?= e(page_url('/reserva-de-citas.php')) ?>">Reservar cita</a>
                <a class="btn btn-ghost" href="tel:<?= e(SITE_PHONE_LINK) ?>">Llamar al <?= e(SITE_PHONE) ?></a>
            </div>
            <ul class="landing-trust" aria-label="Garantías profesionales">
                <li><strong>Dietista-nutricionista colegiada</strong> · Nº <?= e(SITE_COLLEGIATE_NUMBER) ?> (CODINMA)</li>
                <li><a href="<?= e($stats['url']) ?>" target="_blank" rel="noopener"><strong><?= e($stats['puntuacion']) ?>/5</strong> en Doctoralia</a></li>
                <li>Consulta en <?= e(SITE_ADDRESS) ?> · y online</li>
            </ul>
        </div>
    </section>

    <section class="band">
        <div class="wrap section wrap-narrow">
            <h2><?= e($L['for_title']) ?></h2>
            <ul class="landing-list">
                <?php foreach ($L['for'] as $item): ?><li><?= e($item) ?></li><?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section class="wrap section">
        <div class="wrap-narrow">
            <h2><?= e($L['how_title']) ?></h2>
            <ol class="landing-steps">
                <?php foreach ($L['how'] as [$h, $p]): ?>
                    <li><h3><?= e($h) ?></h3><p><?= e($p) ?></p></li>
                <?php endforeach; ?>
            </ol>
            <p class="landing-note">La información de esta página es divulgativa y no sustituye el diagnóstico ni el tratamiento de tu médico. Si tienes síntomas de alarma, consulta con un profesional sanitario. Última revisión: <time datetime="<?= e($L['reviewed']) ?>"><?= e(date('d/m/Y', strtotime($L['reviewed']))) ?></time> por Elena Sánchez Novo.</p>
        </div>
    </section>

    <section class="wrap" style="margin-bottom: 4rem;">
        <div class="wrap-narrow">
            <h2>Preguntas frecuentes</h2>
            <div class="faq-wrap" id="faq-accordion">
                <?php foreach ($L['faqs'] as $i => [$q, $a]): ?>
                    <div class="faq-card">
                        <button class="faq-trigger" type="button" id="lq-<?= $i ?>" aria-expanded="false" aria-controls="la-<?= $i ?>">
                            <span><?= e($q) ?></span><span class="faq-toggle-icon" aria-hidden="true">+</span>
                        </button>
                        <div class="faq-content" id="la-<?= $i ?>" role="region" aria-labelledby="lq-<?= $i ?>">
                            <div class="faq-content-inner"><p><?= e($a) ?></p></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="band">
        <div class="wrap section text-center">
            <div class="wrap-narrow">
                <h2>¿Hablamos de tu caso?</h2>
                <p class="lead lead-centered">Reserva tu valoración presencial en Madrid (Barrio de Salamanca) o por videoconsulta.</p>
                <div class="landing-actions" style="justify-content:center;">
                    <a class="btn" href="<?= e(page_url('/reserva-de-citas.php')) ?>">Reservar cita</a>
                    <a class="btn btn-ghost" href="<?= e(page_url('/contacto.php')) ?>">Escribirme</a>
                </div>
                <p class="landing-related">Te puede interesar:
                    <?php foreach ($L['related'] as $k => $slug): ?>
                        <?= $k ? ' · ' : '' ?><a href="/<?= e($slug) ?>.php"><?= e(landings()[$slug]['h1']) ?></a>
                    <?php endforeach; ?>
                </p>
            </div>
        </div>
    </section>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

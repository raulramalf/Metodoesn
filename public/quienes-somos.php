<?php
require_once __DIR__ . '/../src/functions.php';
$pageTitle = t('about_page_title', 'Quiénes somos · Elena Sánchez Novo');
$pageDesc  = t('about_sub', 'Elena Sánchez Novo (Col. Nº MAD01639): graduada en Nutrición Humana y Dietética y CAFyD.');
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">

    <!-- HERO & BIOGRAFÍA DE ELENA SÁNCHEZ NOVO -->
    <section class="wrap section about">
        <!-- Media de Elena: fotos originales como estaban antes -->
        <div class="about-media">
            <img class="reveal-scale"
                 src="<?= e(img('elena-1.jpeg')) ?>"
                 alt="<?= e(sprintf(t('alt_elena_retrato'), SITE_OWNER)) ?>"
                 width="480" height="600" fetchpriority="high">
            <img class="reveal-scale"
                 src="<?= e(img('elena-2.jpeg')) ?>"
                 alt="<?= e(t('alt_elena_consulta')) ?>"
                 loading="lazy"
                 width="480" height="600">
            
            <!-- Badge colegiada y titulación -->
            <div class="about-col-badge">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                <div>
                    <strong><?= e(t('trust_col')) ?></strong>
                    <span class="about-col-sub">Nº <?= e(SITE_COLLEGIATE_NUMBER) ?> · Madrid</span>
                </div>
            </div>
        </div>

        <!-- Contenido Editorial -->
        <div class="about-text-col">
            <p class="kicker"><?= e(t('about_kicker')) ?></p>
            <h1><?= e(SITE_OWNER) ?></h1>
            <p class="hero-sub"><?= e(t('about_sub')) ?></p>

            <p class="lead">
                <?= e(t('about_p1')) ?>
            </p>

            <p>
                <?= e(t('about_p2')) ?>
            </p>

            <p class="chip-title"><?= e(t('about_help_title')) ?></p>
            <ul class="chip-list">
                <?php for ($i = 1; $i <= 6; $i++): ?>
                    <li><?= e(t('about_help_' . $i)) ?></li>
                <?php endfor; ?>
            </ul>

            <div class="actions">
                <a class="btn" href="<?= e(page_url('/reserva-de-citas.php')) ?>">
                    <span><?= e(t('btn_book_now')) ?></span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <a class="btn btn-ghost" href="<?= e(page_url('/servicios.php')) ?>"><?= e(t('btn_explore_services')) ?></a>
            </div>
        </div>
    </section>

    <!-- FRASE DE FILOSOFÍA SOBRE FOTO -->
    <section class="quote-band">
        <img src="<?= e(img('foto-paseo.webp')) ?>" alt="" width="1600" height="1066" loading="lazy">
        <div class="wrap">
            <blockquote><?= e(t('about_quote')) ?></blockquote>
            <cite><?= e(SITE_OWNER) ?></cite>
        </div>
    </section>

    <!-- METODOLOGÍA & VALORES CLÍNICOS -->
    <section class="band">
        <div class="wrap section">
            <div class="section-heading text-center">
                <p class="kicker"><?= e(t('quienes_somos_063')) ?></p>
                <h2><?= e(t('quienes_somos_064')) ?></h2>
                <p class="lead lead-centered"><?= e(t('quienes_somos_065')) ?></p>
            </div>

            <div class="bento-grid">
                <?php for ($i = 0; $i < min(3, count($principios)); $i++): ?>
                    <article class="bento-item">
                        <div class="bento-item-header">
                            <span class="bento-tag"><?= e(sprintf(t('label_step'), $i + 1)) ?></span>
                        </div>
                        <h3><?= e($principios[$i][0]) ?></h3>
                        <p><?= e($principios[$i][1]) ?></p>
                    </article>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- FORMACIÓN Y TRAYECTORIA ACADÉMICA -->
    <section class="wrap section">
        <div class="section-heading">
            <p class="kicker"><?= e(t('quienes_somos_066')) ?></p>
            <h2><?= e(t('about_edu_title')) ?></h2>
            <p class="lead"><?= e(t('about_edu_sub')) ?></p>
        </div>

        <div class="edu-grid">
            <?php foreach ($formacion as $item): ?>
                <div class="edu-card">
                    <p><strong><?= e($item) ?></strong></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- ESPACIO FÍSICO DE CONSULTA (CLÍNICA SURGEOM) -->
    <section class="band">
        <div class="wrap section">
            <div class="section-heading text-center">
                <p class="kicker"><?= e(t('quienes_somos_067')) ?></p>
                <h2><?= e(t('about_clinic_title')) ?></h2>
                <p class="lead lead-centered">
                    <?= e(t('about_clinic_sub')) ?>
                </p>
            </div>

            <div class="gallery-strip">
                <figure class="gallery-card">
                    <div class="gallery-img"><img src="<?= e(img('clinica3.jpg')) ?>" alt="<?= e(t('alt_valoracion')) ?>" loading="lazy" width="600" height="400"></div>
                    <figcaption><?= e(t('quienes_somos_068')) ?></figcaption>
                </figure>
                <figure class="gallery-card">
                    <div class="gallery-img"><img src="<?= e(img('clinica2.jpeg')) ?>" alt="<?= e(t('alt_recepcion')) ?>" loading="lazy" width="600" height="400"></div>
                    <figcaption><?= e(t('quienes_somos_069')) ?></figcaption>
                </figure>
                <figure class="gallery-card">
                    <div class="gallery-img"><img src="<?= e(img('clinicaporfuera.webp')) ?>" alt="<?= e(t('alt_fachada')) ?>" loading="lazy" width="600" height="400"></div>
                    <figcaption><?= e(t('quienes_somos_070')) ?></figcaption>
                </figure>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

<?php
require_once __DIR__ . '/../src/functions.php';
$pageTitle = t('hero_title', 'Entrenamiento · Salud · Nutrición Clínica');
$pageDesc  = t('hero_lead', 'El Método ESN por Elena Sánchez Novo une nutrición clínica, entrenamiento de fuerza y acompañamiento continuo basado en evidencia científica.');
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
$arrow = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>';
?>
<main id="main">

    <!-- 1. HERO -->
    <section class="hero" id="hero">
        <div class="wrap hero-grid">
            <div class="hero-text">
                <h1 class="hero-title"><?= e(SITE_NAME) ?></h1>
                <p class="hero-slogan"><span><?= e(t('rd_slogan_1')) ?></span> <span><?= e(t('rd_slogan_2')) ?></span> <span><?= e(t('rd_slogan_3')) ?></span></p>
                <h2 class="hero-lead"><?= e(t('hero_lead')) ?></h2>

                <div class="actions">
                    <a class="btn btn-light btn-lg" href="<?= e(page_url('/reserva-de-citas.php')) ?>">
                        <span><?= e(t('btn_book_initial')) ?></span><?= $arrow ?>
                    </a>
                    <a class="btn btn-outline-light btn-lg" href="#fundamentos"><?= e(t('btn_explore_services')) ?></a>
                </div>

                <p class="hero-cred">
                    <strong><?= e(SITE_OWNER) ?></strong> · <?= e(t('rd_dietitian')) ?> · <?= e(sprintf(t('rd_col'), SITE_COLLEGIATE_NUMBER)) ?>
                </p>
            </div>

            <div class="hero-media">
                <div class="hero-arch">
                    <img src="<?= e(img('foto-desayunos.webp')) ?>" alt="<?= e(t('alt_desayunos')) ?>" width="960" height="1438" fetchpriority="high">
                </div>
                <p class="hero-direct"><strong><?= e(t('rd_direct')) ?></strong> <?= e(t('rd_direct_sub')) ?></p>
            </div>
        </div>
    </section>

    <!-- 2. CONFIANZA -->
    <section class="trust" aria-label="<?= e(t('footer_clinical_rep')) ?>">
        <ul class="wrap trust-list" data-stagger>
            <li data-reveal><strong><?= e(t('trust_col')) ?></strong><span><?= e(t('trust_col_sub')) ?></span></li>
            <li data-reveal><strong><?= e(t('rd_trust_isak')) ?></strong><span><?= e(t('rd_trust_isak_sub')) ?></span></li>
            <li data-reveal><strong><?= e(t('trust_univ')) ?></strong><span><?= e(t('trust_univ_sub')) ?></span></li>
            <li data-reveal><strong><?= e(t('trust_clinic')) ?></strong><span><?= e(t('trust_clinic_sub')) ?></span></li>
        </ul>
    </section>

    <!-- 3. COMPARATIVA -->
    <section class="section compare" id="enfoque">
        <div class="wrap">
            <div class="section-heading" data-reveal>
                <p class="kicker"><?= e(t('compare_kicker')) ?></p>
                <h2><?= e(t('compare_title')) ?></h2>
                <p class="lead"><?= e(t('compare_sub')) ?></p>
            </div>

            <div class="compare-grid" data-stagger>
                <div class="compare-box compare-box-old" data-reveal>
                    <p class="compare-tag"><?= e(t('index_034')) ?></p>
                    <h3><?= e(t('compare_bad_title')) ?></h3>
                    <ul class="compare-list">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <li><?= e(t('compare_bad_' . $i)) ?></li>
                        <?php endfor; ?>
                    </ul>
                    <p class="compare-footer">«<?= e(t('index_035')) ?>»</p>
                </div>

                <div class="compare-box compare-box-esn" data-reveal>
                    <p class="compare-tag"><?= e(t('index_036')) ?></p>
                    <h3><?= e(t('compare_good_title')) ?></h3>
                    <ul class="compare-list">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <li><?= e(t('compare_good_' . $i)) ?></li>
                        <?php endfor; ?>
                    </ul>
                    <p class="compare-footer"><?= e(t('index_037')) ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. FUNDAMENTOS -->
    <section class="section band principles" id="fundamentos">
        <div class="wrap">
            <div class="principles-grid">
                <div class="section-heading principles-heading" data-reveal>
                    <p class="kicker"><?= e(t('bento_kicker')) ?></p>
                    <h2><?= e(t('bento_title')) ?></h2>
                    <p class="lead"><?= e(t('bento_lead')) ?></p>
                </div>

                <div class="principles-list" data-stagger>
                    <article class="principle principle-main" data-reveal>
                        <p class="principle-tag"><?= e(t('index_038')) ?></p>
                        <h3><?= e($principios[0][0]) ?></h3>
                        <p><?= e($principios[0][1]) ?></p>
                        <ul class="principle-tags">
                            <li><?= e(t('index_039')) ?></li>
                            <li><?= e(t('index_040')) ?></li>
                            <li><?= e(t('index_041')) ?></li>
                            <li><?= e(t('index_042')) ?></li>
                        </ul>
                    </article>

                    <?php for ($i = 1; $i < count($principios); $i++): ?>
                        <article class="principle" data-reveal>
                            <p class="principle-tag"><?= e(sprintf(t('label_principle'), $i + 1)) ?></p>
                            <h3><?= e($principios[$i][0]) ?></h3>
                            <p><?= e($principios[$i][1]) ?></p>
                        </article>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="gallery-strip" data-stagger>
                <figure class="gallery-card" data-reveal>
                    <div class="gallery-img"><img src="<?= e(img('foto-planificacion.webp')) ?>" alt="<?= e(t('alt_planificacion')) ?>" loading="lazy" width="1200" height="1600"></div>
                    <figcaption><?= e(t('index_043')) ?></figcaption>
                </figure>
                <figure class="gallery-card" data-reveal>
                    <div class="gallery-img"><img src="<?= e(img('foto-correr.webp')) ?>" alt="<?= e(t('alt_correr')) ?>" loading="lazy" width="1200" height="1800"></div>
                    <figcaption><?= e(t('index_044')) ?></figcaption>
                </figure>
                <figure class="gallery-card" data-reveal>
                    <div class="gallery-img"><img src="<?= e(img('clinica.jpeg')) ?>" alt="<?= e(t('alt_despacho')) ?>" loading="lazy" width="600" height="400"></div>
                    <figcaption><?= e(t('index_045')) ?></figcaption>
                </figure>
            </div>
        </div>
    </section>

    <!-- 5. ESPECIALIDADES -->
    <section class="section areas" id="especialidades">
        <div class="wrap">
            <div class="section-heading" data-reveal>
                <p class="kicker"><?= e(t('spec_kicker')) ?></p>
                <h2><?= e(t('spec_title')) ?></h2>
                <p class="lead"><?= e(t('spec_sub')) ?></p>
            </div>

            <div class="areas-grid" data-stagger>
                <?php
                $areas = [
                    ['index_046', 'index_047', ['SIBO', 'FODMAP', 'IBS']],
                    ['index_048', 'index_049', ['PCOS', 'Fertility', 'Hormones']],
                    ['index_050', 'index_051', ['ISAK', 'Lean Mass', 'Strength']],
                    ['index_052', 'index_053', ['Performance', 'Supplements', 'Recovery']],
                ];
                foreach ($areas as [$h, $p, $tags]): ?>
                    <div class="area-box" data-reveal>
                        <h3><?= e(t($h)) ?></h3>
                        <p><?= e(t($p)) ?></p>
                        <ul class="area-tags">
                            <?php foreach ($tags as $tag): ?><li><?= e($tag) ?></li><?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 6. PROCESO -->
    <section class="section process" id="proceso">
        <div class="wrap">
            <div class="section-heading" data-reveal>
                <p class="kicker"><?= e(t('roadmap_kicker')) ?></p>
                <h2><?= e(t('roadmap_title')) ?></h2>
                <p class="lead"><?= e(t('roadmap_sub')) ?></p>
            </div>

            <div class="roadmap-box" id="roadmap-box" data-reveal>
                <div class="roadmap-tabs" role="tablist" aria-label="Fases del Método ESN">
                    <?php foreach ($pasos as $idx => $p): ?>
                        <button class="roadmap-tab-btn <?= $idx === 0 ? 'is-active' : '' ?>" data-phase="<?= $idx + 1 ?>" id="tab-<?= $idx + 1 ?>" role="tab" aria-selected="<?= $idx === 0 ? 'true' : 'false' ?>" aria-controls="panel-<?= $idx + 1 ?>">
                            <span class="tab-label"><?= e($p[0]) ?></span>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="roadmap-panel-container">
                    <?php
                    $imgList = [['clinica3.jpg', 1086, 1448], ['foto-verduras.webp', 1000, 1500], ['foto-peso-muerto.webp', 1400, 933], ['foto-valle.webp', 1400, 930]];
                    foreach ($pasos as $idx => $p):
                    ?>
                        <div class="roadmap-panel-item <?= $idx === 0 ? 'is-active' : '' ?>" id="panel-<?= $idx + 1 ?>" role="tabpanel" aria-labelledby="tab-<?= $idx + 1 ?>" <?= $idx > 0 ? 'hidden' : '' ?>>
                            <div class="roadmap-copy">
                                <p class="roadmap-badge"><?= e(sprintf(t('label_phase'), $idx + 1)) ?></p>
                                <h3><?= e($p[0]) ?></h3>
                                <p><?= e($p[1]) ?></p>
                            </div>
                            <div class="roadmap-media">
                                <?php [$src, $w, $h] = $imgList[$idx] ?? $imgList[0]; ?>
                                <img src="<?= e(img($src)) ?>" alt="<?= e($p[0]) ?>" loading="lazy" width="<?= $w ?>" height="<?= $h ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. ELENA Y COLEGIACIÓN -->
    <section class="section band meet" id="elena">
        <div class="wrap meet-grid">
            <div class="meet-photo" data-reveal>
                <img src="<?= e(img('elena-2.jpeg')) ?>" alt="<?= e(t('alt_elena_consulta')) ?>" width="480" height="600" loading="lazy">
            </div>
            <div class="meet-text" data-reveal>
                <h2><?= e(SITE_OWNER) ?></h2>
                <p class="meet-cred"><?= e(t('rd_dietitian')) ?> · <?= e(sprintf(t('rd_col'), SITE_COLLEGIATE_NUMBER)) ?> · CODINMA</p>
                <p class="lead"><?= e(t('about_p1')) ?></p>
                <ul class="meet-list">
                    <li><?= e(t('trust_univ')) ?>: <?= e(t('trust_univ_sub')) ?></li>
                    <li><?= e(t('rd_trust_isak')) ?></li>
                    <li><?= e(t('rd_trust_clinic')) ?></li>
                </ul>
                <div class="actions">
                    <a class="btn" href="<?= e(page_url('/quienes-somos.php')) ?>"><span><?= e(t('btn_learn_more')) ?></span><?= $arrow ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. TESTIMONIOS -->
    <section class="section reviews" id="testimonios">
        <div class="wrap">
            <div class="reviews-header">
                <div class="section-heading" data-reveal>
                    <p class="kicker"><?= e(t('testi_kicker')) ?></p>
                    <h2><?= e(t('testi_title')) ?></h2>
                    <p class="lead"><?= e(t('testi_sub')) ?></p>
                </div>

                <div class="doctoralia-score-card" data-reveal>
                    <div class="score-top">
                        <span class="score-number"><?= e($statsReputacion['puntuacion']) ?></span>
                        <div>
                            <div class="stars-gold" aria-hidden="true"></div>
                            <span class="score-count"><?= e($statsReputacion['opiniones']) ?> <?= e(t('index_054')) ?></span>
                        </div>
                    </div>
                    <p class="score-sub">Doctoralia España · <strong>100%</strong></p>
                    <a href="<?= e($statsReputacion['url']) ?>" target="_blank" rel="noopener" class="score-link"><?= e(t('btn_doctoralia_profile')) ?> →</a>
                </div>
            </div>

            <div class="quotes-carousel-wrapper" id="quotes-carousel" role="region" aria-roledescription="carousel" aria-label="<?= e(t('testi_title')) ?>" data-label-goto="<?= e(t('rd_js_goto')) ?>">
                <div class="quotes-carousel-top-bar">
                    <p class="quotes-status-text"><?= e(t('index_055')) ?></p>
                    <div class="quotes-carousel-controls">
                        <button type="button" class="quotes-nav-btn prev" id="quotes-prev" aria-label="<?= e(t('index_056')) ?>">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        </button>
                        <div class="quotes-counter" id="quotes-counter" aria-live="polite">
                            <span class="quotes-current">1</span> / <span class="quotes-total"><?= count($testimonios) ?></span>
                        </div>
                        <button type="button" class="quotes-nav-btn next" id="quotes-next" aria-label="<?= e(t('index_057')) ?>">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </button>
                    </div>
                </div>

                <div class="quotes-carousel-viewport" id="quotes-viewport">
                    <div class="quotes-carousel-track" id="quotes-track">
                        <?php foreach ($testimonios as $i => $item): ?>
                            <figure class="quote-card quote-slide" data-index="<?= $i ?>">
                                <div class="quote-top">
                                    <div class="quote-stars" aria-hidden="true"></div>
                                    <span class="quote-topic"><?= e($item['tema']) ?></span>
                                </div>
                                <blockquote><p>«<?= e($item['cita']) ?>»</p></blockquote>
                                <figcaption class="quote-author">
                                    <strong><?= e($item['autor']) ?></strong>
                                    <span class="quote-verified"><?= e($item['origen']) ?></span>
                                </figcaption>
                            </figure>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="quotes-carousel-indicators" id="quotes-indicators" role="tablist" aria-label="<?= e(t('index_058')) ?>"></div>
            </div>
        </div>
    </section>

    <!-- 9. CTA FINAL -->
    <section class="section cta">
        <div class="wrap cta-grid">
        <div class="cta-body" data-reveal>
            <p class="cta-badge"><?= e(t('index_060')) ?></p>
            <h2><?= e(t('cta_title')) ?></h2>
            <p class="cta-lead"><?= e(t('cta_lead')) ?></p>
            <div class="actions">
                <a class="btn btn-dark btn-lg" href="<?= e(page_url('/reserva-de-citas.php')) ?>"><span><?= e(t('btn_book_now')) ?></span><?= $arrow ?></a>
                <a class="btn btn-outline-dark btn-lg" href="<?= e(page_url('/contacto.php')) ?>"><?= e(t('btn_contact')) ?></a>
            </div>
            <ul class="cta-badges-row">
                <li><?= e(t('index_061')) ?></li>
                <li><?= e(t('index_062')) ?></li>
            </ul>
        </div>
        <div class="cta-media" data-reveal>
            <img src="<?= e(img('foto-fuerza.webp')) ?>" alt="<?= e(t('alt_fuerza')) ?>" width="1400" height="935" loading="lazy">
        </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

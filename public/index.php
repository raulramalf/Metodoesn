<?php
require_once __DIR__ . '/../src/functions.php';
$pageTitle = t('hero_title', 'Entrenamiento · Salud · Nutrición Clínica');
$pageDesc  = t('hero_lead', 'El Método ESN por Elena Sánchez Novo une nutrición clínica, entrenamiento de fuerza y acompañamiento continuo basado en evidencia científica.');
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">

    <!-- 1. HERO SECTION BOUTIQUE -->
    <section class="hero" id="hero">
        <div class="hero-glow" aria-hidden="true"></div>
        <div class="wrap hero-grid">
            <div class="hero-text">
                <!-- Badge de reputación en Doctoralia -->
                <a href="<?= e($statsReputacion['url']) ?>" target="_blank" rel="noopener" class="hero-badge" id="hero-badge">
                    <span class="stars" aria-hidden="true">★★★★★</span>
                    <span><strong><?= e($statsReputacion['puntuacion']) ?></strong> en Doctoralia · <?= e($statsReputacion['opiniones']) ?> <?= e(current_lang() === 'en' ? 'verified reviews' : (current_lang() === 'de' ? 'Bewertungen' : 'opiniones')) ?></span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>

                <p class="kicker">Elena Sánchez Novo · Col. Nº <?= e(SITE_COLLEGIATE_NUMBER) ?> · CAFyD & Nutrición</p>
                <h1><?= e(SITE_NAME) ?></h1>
                <p class="hero-sub"><?= e(SITE_TAGLINE) ?></p>
                <h2 class="hero-lead"><?= e(t('hero_lead')) ?></h2>
                <p class="hero-desc">
                    <?= e(t('hero_desc')) ?>
                </p>

                <div class="actions">
                    <a class="btn" href="<?= e(page_url('/reserva-de-citas.php')) ?>">
                        <span><?= e(t('btn_book_initial')) ?></span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                    <a class="btn btn-ghost" href="#fundamentos"><?= e(t('btn_explore_services')) ?></a>
                </div>

                <div class="hero-guarantees">
                    <div class="guarantee-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(current_lang() === 'en' ? 'Scientific Evidence' : (current_lang() === 'de' ? 'Wissenschaftliche Evidenz' : 'Evidencia científica')) ?></span>
                    </div>
                    <div class="guarantee-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(current_lang() === 'en' ? 'In-Person (Madrid) & Online' : (current_lang() === 'de' ? 'Vor Ort (Madrid) & Online' : 'Presencial (Madrid) y Online')) ?></span>
                    </div>
                    <div class="guarantee-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(current_lang() === 'en' ? '100% Individualized' : (current_lang() === 'de' ? '100% Individualisiert' : '100% individualizado')) ?></span>
                    </div>
                </div>
            </div>

            <!-- Media del Hero con Composición Visual Clara -->
            <div class="hero-media-wrapper">
                <div class="hero-media-card">
                    <img src="<?= e(img('hero-1.png')) ?>" alt="Elena Sánchez Novo · Método ESN" width="682" height="1024" fetchpriority="high">
                </div>
                <img class="hero-sub-photo" src="<?= e(img('hero-2.png')) ?>" alt="Entrenamiento y salud en consulta clínica" width="600" height="400" loading="lazy">
                
                <div class="hero-floating-card" aria-hidden="true">
                    <div class="floating-icon-wrap">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                    <div class="floating-text-wrap">
                        <strong>5.0 Doctoralia</strong>
                        <span>50+ <?= e(current_lang() === 'en' ? 'verified ratings' : (current_lang() === 'de' ? 'Bewertungen' : 'opiniones')) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. BARRA DE CONFIANZA & AVALES CLÍNICOS -->
    <section class="trust-strip" aria-label="Acreditaciones profesionales">
        <div class="wrap trust-strip-inner">
            <div class="trust-pill">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                <span><?= e(t('trust_col')) ?></span>
            </div>
            <div class="trust-pill">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                <span>Antropometría Oficial ISAK</span>
            </div>
            <div class="trust-pill">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M7 8h10M7 12h10M7 16h6"/></svg>
                <span><?= e(t('trust_univ')) ?></span>
            </div>
            <div class="trust-pill">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                <span>Clínica SurgEOM (Madrid) & Online</span>
            </div>
        </div>
    </section>

    <!-- 3. COMPARATIVA: ENFOQUE TRADICIONAL VS MÉTODO ESN -->
    <section class="wrap section" id="enfoque">
        <div class="section-heading text-center">
            <p class="kicker"><?= e(t('compare_kicker')) ?></p>
            <h2><?= e(t('compare_title')) ?></h2>
            <p class="lead lead-centered">
                <?= e(t('compare_sub')) ?>
            </p>
        </div>

        <div class="compare-grid">
            <div class="compare-box compare-box-old">
                <div class="compare-badge compare-badge-old">
                    <span>✕ <?= e(t('compare_bad_tag')) ?></span>
                </div>
                <h3><?= e(t('compare_bad_title')) ?></h3>
                <ul class="compare-list">
                    <li>
                        <span class="compare-icon-cross" aria-hidden="true">✕</span>
                        <div><?= e(t('compare_bad_1')) ?></div>
                    </li>
                    <li>
                        <span class="compare-icon-cross" aria-hidden="true">✕</span>
                        <div><?= e(t('compare_bad_2')) ?></div>
                    </li>
                    <li>
                        <span class="compare-icon-cross" aria-hidden="true">✕</span>
                        <div><?= e(t('compare_bad_3')) ?></div>
                    </li>
                    <li>
                        <span class="compare-icon-cross" aria-hidden="true">✕</span>
                        <div><?= e(t('compare_bad_4')) ?></div>
                    </li>
                </ul>
            </div>

            <div class="compare-box compare-box-esn">
                <div class="compare-badge compare-badge-esn">
                    <span>✓ <?= e(t('compare_good_tag')) ?></span>
                </div>
                <h3><?= e(t('compare_good_title')) ?></h3>
                <ul class="compare-list">
                    <li>
                        <span class="compare-icon-check" aria-hidden="true">✓</span>
                        <div><?= e(t('compare_good_1')) ?></div>
                    </li>
                    <li>
                        <span class="compare-icon-check" aria-hidden="true">✓</span>
                        <div><?= e(t('compare_good_2')) ?></div>
                    </li>
                    <li>
                        <span class="compare-icon-check" aria-hidden="true">✓</span>
                        <div><?= e(t('compare_good_3')) ?></div>
                    </li>
                    <li>
                        <span class="compare-icon-check" aria-hidden="true">✓</span>
                        <div><?= e(t('compare_good_4')) ?></div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- 4. LOS FUNDAMENTOS: BENTO GRID 2.0 -->
    <section class="band" id="fundamentos">
        <div class="wrap section">
            <div class="section-heading">
                <p class="kicker"><?= e(t('bento_kicker')) ?></p>
                <h2><?= e(t('bento_title')) ?></h2>
                <p class="lead"><?= e(t('bento_lead')) ?></p>
            </div>

            <div class="bento-grid">
                <!-- Tarjeta 01 Hero Bento -->
                <article class="bento-item bento-item-hero">
                    <div class="bento-item-header">
                        <span class="bento-tag"><?= e(current_lang() === 'en' ? 'Core Pillar' : (current_lang() === 'de' ? 'Hauptsäule' : 'Pilar Central')) ?></span>
                        <span class="bento-num">01</span>
                    </div>
                    <h3><?= e($principios[0][0]) ?></h3>
                    <p><?= e($principios[0][1]) ?></p>
                    <div class="bento-pills">
                        <span class="bento-pill-item"><?= e(current_lang() === 'en' ? 'Clinical physiology' : (current_lang() === 'de' ? 'Klinische Physiologie' : 'Fisiología clínica')) ?></span>
                        <span class="bento-pill-item"><?= e(current_lang() === 'en' ? 'Strength training' : (current_lang() === 'de' ? 'Krafttraining' : 'Entrenamiento de fuerza')) ?></span>
                        <span class="bento-pill-item"><?= e(current_lang() === 'en' ? 'Gut health & microbiome' : (current_lang() === 'de' ? 'Darmgesundheit & Mikrobiom' : 'Salud digestiva & microbiota')) ?></span>
                        <span class="bento-pill-item"><?= e(current_lang() === 'en' ? 'Active metabolism' : (current_lang() === 'de' ? 'Aktiver Stoffwechsel' : 'Metabolismo activo')) ?></span>
                    </div>
                </article>

                <?php for ($i = 1; $i < count($principios); $i++): ?>
                    <article class="bento-item">
                        <div class="bento-item-header">
                            <span class="bento-tag"><?= e(current_lang() === 'en' ? 'Principle ' . ($i + 1) : (current_lang() === 'de' ? 'Prinzip ' . ($i + 1) : 'Pilar ' . ($i + 1))) ?></span>
                            <span class="bento-num"><?= sprintf('%02d', $i + 1) ?></span>
                        </div>
                        <h3><?= e($principios[$i][0]) ?></h3>
                        <p><?= e($principios[$i][1]) ?></p>
                    </article>
                <?php endfor; ?>
            </div>

            <!-- Galería de Evidencia Real -->
            <div class="gallery-strip">
                <figure class="gallery-card">
                    <img src="<?= e(img('plan-semanal.jpg')) ?>" alt="Planificación personalizada Método ESN" loading="lazy" width="800" height="1067">
                    <figcaption><?= e(current_lang() === 'en' ? 'Personalized strategy & flexible structure' : (current_lang() === 'de' ? 'Individuelle Strategie & flexible Struktur' : 'Pauta personalizada y estructura flexible')) ?></figcaption>
                </figure>
                <figure class="gallery-card">
                    <img src="<?= e(img('metodo-2.png')) ?>" alt="Composición corporal y salud con Método ESN" loading="lazy" width="683" height="1024">
                    <figcaption><?= e(current_lang() === 'en' ? 'Body composition & clinical evaluation' : (current_lang() === 'de' ? 'Körperzusammensetzung & Diagnostik' : 'Composición corporal y valoración clínica')) ?></figcaption>
                </figure>
                <figure class="gallery-card">
                    <img src="<?= e(img('clinica.jpeg')) ?>" alt="Despacho de consulta presencial en Clínica SurgEOM (Madrid)" loading="lazy" width="600" height="400">
                    <figcaption><?= e(current_lang() === 'en' ? 'In-person clinic at SurgEOM Madrid' : (current_lang() === 'de' ? 'Vor-Ort-Praxis SurgEOM Madrid' : 'Consulta presencial en Clínica SurgEOM (Madrid)')) ?></figcaption>
                </figure>
            </div>
        </div>
    </section>

    <!-- 5. ÁREAS DE ESPECIALIZACIÓN CLÍNICA -->
    <section class="wrap section" id="especialidades">
        <div class="section-heading text-center">
            <p class="kicker"><?= e(t('spec_kicker')) ?></p>
            <h2><?= e(t('spec_title')) ?></h2>
            <p class="lead lead-centered">
                <?= e(t('spec_sub')) ?>
            </p>
        </div>

        <div class="areas-grid">
            <div class="area-box">
                <div class="area-icon-wrap" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8h1a4 4 0 0 1 0 8h-1M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/></svg>
                </div>
                <h3><?= e(current_lang() === 'en' ? 'Digestive Health & Microbiome' : (current_lang() === 'de' ? 'Darmgesundheit & Mikrobiom' : 'Salud Digestiva & Microbiota')) ?></h3>
                <p><?= e(current_lang() === 'en' ? 'Clinical relief for bloating, food intolerances, SIBO, IBS, and structured low-FODMAP protocols.' : (current_lang() === 'de' ? 'Behandlung von Blähbauch, Unverträglichkeiten, SIBO, Reizdarm und strukturierte FODMAP-Protokolle.' : 'Manejo de hinchazón, intolerancias, SIBO, colon irritable (SII) y protocolos FODMAP estructurados paso a paso.')) ?></p>
                <div class="area-tags">
                    <span>SIBO</span>
                    <span>FODMAP</span>
                    <span>IBS</span>
                </div>
            </div>

            <div class="area-box">
                <div class="area-icon-wrap" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </div>
                <h3><?= e(current_lang() === 'en' ? "Women's Hormonal Health" : (current_lang() === 'de' ? 'Weibliche Hormongesundheit' : 'Salud Hormonal de la Mujer')) ?></h3>
                <p><?= e(current_lang() === 'en' ? 'Evidence-based guidance in PCOS, hypothalamic amenorrhea, cycle regularity, fertility, and postpartum.' : (current_lang() === 'de' ? 'Klinische Begleitung bei PCOS, Amenorrhö, Zyklusunregelmäßigkeiten, Kinderwunsch und Postpartalphase.' : 'Acompañamiento especializado en SOP, amenorrea hipotalámica, regularidad menstrual, fertilidad y postparto.')) ?></p>
                <div class="area-tags">
                    <span>PCOS</span>
                    <span>Fertility</span>
                    <span>Hormones</span>
                </div>
            </div>

            <div class="area-box">
                <div class="area-icon-wrap" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 16.326A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="m8 19 4-4 4 4"/></svg>
                </div>
                <h3><?= e(current_lang() === 'en' ? 'Body Recomposition & Strength' : (current_lang() === 'de' ? 'Körperzusammensetzung & Kraft' : 'Recomposición Corporal & Fuerza')) ?></h3>
                <p><?= e(current_lang() === 'en' ? 'Fat loss while preserving metabolic lean mass, joint health, and official ISAK anthropometric tracking.' : (current_lang() === 'de' ? 'Fettabbau bei Erhalt wertvoller Muskelmasse, Stoffwechseloptimierung und ISAK-Körpermessungen.' : 'Pérdida de grasa conservando masa muscular, mejora metabólica y valoración antropométrica avanzada bajo estándar ISAK.')) ?></p>
                <div class="area-tags">
                    <span>ISAK</span>
                    <span>Lean Mass</span>
                    <span>Strength</span>
                </div>
            </div>

            <div class="area-box">
                <div class="area-icon-wrap" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <h3><?= e(current_lang() === 'en' ? 'Sports Nutrition & Performance' : (current_lang() === 'de' ? 'Sporternährung & Leistung' : 'Nutrición Deportiva & Rendimiento')) ?></h3>
                <p><?= e(current_lang() === 'en' ? 'Nutritional periodization, science-based supplementation, and rapid post-workout recovery strategies.' : (current_lang() === 'de' ? 'Periodisierte Sporternährung, evidenzbasierte Supplementierung und beschleunigte Regeneration.' : 'Estrategias de alimentación, hidratación y suplementación basada en evidencia adaptadas a tu disciplina y entrenamientos.')) ?></p>
                <div class="area-tags">
                    <span>Performance</span>
                    <span>Supplements</span>
                    <span>Recovery</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. ROADMAP: TU CAMINO DENTRO DEL MÉTODO ESN -->
    <section class="band" id="proceso">
        <div class="wrap section">
            <div class="section-heading text-center">
                <p class="kicker"><?= e(t('roadmap_kicker')) ?></p>
                <h2><?= e(t('roadmap_title')) ?></h2>
                <p class="lead lead-centered">
                    <?= e(t('roadmap_sub')) ?>
                </p>
            </div>

            <div class="roadmap-box" id="roadmap-box">
                <div class="roadmap-tabs" role="tablist" aria-label="Fases del Método ESN">
                    <?php foreach ($pasos as $idx => $p): ?>
                        <button class="roadmap-tab-btn <?= $idx === 0 ? 'is-active' : '' ?>" data-phase="<?= $idx + 1 ?>" id="tab-<?= $idx + 1 ?>" role="tab" aria-selected="<?= $idx === 0 ? 'true' : 'false' ?>" aria-controls="panel-<?= $idx + 1 ?>">
                            <span class="tab-num"><?= sprintf('%02d', $idx + 1) ?></span>
                            <span class="tab-label"><?= e($p[0]) ?></span>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="roadmap-panel-container">
                    <?php 
                    $imgList = ['clinica3.jpg', 'plan-semanal.jpg', 'metodo-3.png', 'espacio.png'];
                    foreach ($pasos as $idx => $p): 
                    ?>
                        <div class="roadmap-panel-item <?= $idx === 0 ? 'is-active' : '' ?>" id="panel-<?= $idx + 1 ?>" role="tabpanel" aria-labelledby="tab-<?= $idx + 1 ?>" <?= $idx > 0 ? 'hidden' : '' ?>>
                            <div>
                                <div class="roadmap-badge"><?= e(current_lang() === 'en' ? 'Phase ' . ($idx + 1) : (current_lang() === 'de' ? 'Phase ' . ($idx + 1) : 'Fase ' . ($idx + 1))) ?></div>
                                <h3><?= e($p[0]) ?></h3>
                                <p><?= e($p[1]) ?></p>
                            </div>
                            <div class="roadmap-media">
                                <img src="<?= e(img($imgList[$idx] ?? 'clinica3.jpg')) ?>" alt="<?= e($p[0]) ?>" loading="lazy" width="600" height="400">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. TESTIMONIOS & PRUEBA SOCIAL REAL -->
    <section class="wrap section" id="testimonios">
        <div class="reviews-header">
            <div>
                <p class="kicker"><?= e(t('testi_kicker')) ?></p>
                <h2><?= e(t('testi_title')) ?></h2>
                <p class="lead"><?= e(t('testi_sub')) ?></p>
            </div>
            
            <div class="doctoralia-score-card">
                <div class="score-top">
                    <span class="score-number"><?= e($statsReputacion['puntuacion']) ?></span>
                    <div>
                        <div class="stars-gold" aria-hidden="true">★★★★★</div>
                        <span class="score-count"><?= e($statsReputacion['opiniones']) ?> <?= e(current_lang() === 'en' ? 'verified ratings' : (current_lang() === 'de' ? 'Bewertungen' : 'opiniones')) ?></span>
                    </div>
                </div>
                <p class="score-sub">Doctoralia España · <strong>100%</strong></p>
                <a href="<?= e($statsReputacion['url']) ?>" target="_blank" rel="noopener" class="score-link">
                    <span><?= e(t('btn_doctoralia_profile')) ?></span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>
            </div>
        </div>

        <div class="quotes-grid" id="quotes-container">
            <?php foreach ($testimonios as $i => $item): ?>
                <figure class="quote-card">
                    <div class="quote-top">
                        <div class="quote-stars" aria-hidden="true">★★★★★</div>
                        <span class="quote-topic"><?= e($item['tema']) ?></span>
                    </div>
                    <blockquote><p>«<?= e($item['cita']) ?>»</p></blockquote>
                    <figcaption class="quote-author">
                        <strong><?= e($item['autor']) ?></strong>
                        <span class="quote-verified">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                            <?= e($item['origen']) ?>
                        </span>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
        </div>

        <!-- Feed Oficial de Doctoralia -->
        <div class="doctoralia-reviews-embed">
            <div class="reviews-embed-bar">
                <div class="reviews-embed-title">
                    <span class="stars-gold" aria-hidden="true">★★★★★</span>
                    <span><?= e(current_lang() === 'en' ? 'Real-time verified patient experiences' : (current_lang() === 'de' ? 'Echte Patientenbewertungen in Echtzeit' : 'Opiniones verificadas de pacientes en tiempo real')) ?></span>
                </div>
                <a href="<?= e(BOOKING_URL) ?>" target="_blank" rel="noopener" class="reviews-embed-link">
                    <span><?= e(t('btn_doctoralia_profile')) ?></span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>
            </div>
            <div class="reviews-widget-body">
                <a class="zl-url" href="https://www.doctoralia.es/elena-sanchez-novo/dietista-nutricionista/madrid" rel="nofollow" data-zlw-doctor="elena-sanchez-novo" data-zlw-type="big" data-zlw-opinion="true" data-zlw-hide-branding="true" data-zlw-saas-only="true" data-zlw-a11y-title="Doctoralia widget">Doctoralia Reviews</a>
                <script>!function($_x,_s,id){var js,fjs=$_x.getElementsByTagName(_s)[0];if(!$_x.getElementById(id)){js = $_x.createElement(_s);js.id = id;js.src = "//platform.docplanner.com/js/widget.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","zl-widget-s");</script>
            </div>
        </div>
    </section>

    <!-- 8. CTA FINAL PANORÁMICO -->
    <section class="wrap section">
        <div class="cta-luxury-banner">
            <div class="cta-luxury-glow" aria-hidden="true"></div>
            <div class="cta-luxury-body">
                <span class="cta-badge-pill"><?= e(current_lang() === 'en' ? 'Start your journey' : (current_lang() === 'de' ? 'Der beste Zeitpunkt ist jetzt' : 'Tu momento es ahora')) ?></span>
                <h2><?= e(t('cta_title')) ?></h2>
                <p><?= e(t('cta_lead')) ?></p>
                <div class="actions">
                    <a class="btn btn-white" href="<?= e(page_url('/reserva-de-citas.php')) ?>">
                        <span><?= e(t('btn_book_now')) ?></span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                    <a class="btn btn-ghost-white" href="<?= e(page_url('/contacto.php')) ?>"><?= e(t('btn_contact')) ?></a>
                </div>
                <div class="cta-badges-row">
                    <span>✓ <?= e(current_lang() === 'en' ? 'Direct consultation with Elena' : (current_lang() === 'de' ? 'Direkte Beratung mit Elena' : 'Atención directa con Elena')) ?></span>
                    <span>✓ <?= e(current_lang() === 'en' ? 'In-Person or Online' : (current_lang() === 'de' ? 'Vor Ort oder Online' : 'Presencial u Online')) ?></span>
                </div>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

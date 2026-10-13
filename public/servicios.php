<?php
require_once __DIR__ . '/../src/functions.php';
$pageTitle = t('services_page_title', 'Servicios · Nutrición y Entrenamiento');
$pageDesc  = t('services_lead', 'Entrenamiento, nutrición clínica y acompañamiento forman parte de un mismo proceso individualizado.');
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">

    <!-- CABECERA DE SERVICIOS -->
    <section class="wrap section">
        <div class="wrap-narrow text-center">
            <p class="kicker"><?= e(t('services_kicker')) ?></p>
            <h1><?= e(t('services_title')) ?></h1>
            <p class="lead lead-centered">
                <?= e(t('services_lead')) ?>
            </p>
        </div>
    </section>

    <!-- LOS TRES PILARES DEL SERVICIO -->
    <section class="band">
        <div class="wrap section">
            <div class="section-heading text-center">
                <p class="kicker"><?= e(current_lang() === 'en' ? 'Core Architecture' : (current_lang() === 'de' ? 'Das Fundament' : 'Bases sólidas')) ?></p>
                <h2><?= e(current_lang() === 'en' ? 'The three pillars of our clinical method' : (current_lang() === 'de' ? 'Die drei Säulen unserer Methode' : 'Los tres pilares de nuestro proceso')) ?></h2>
                <p class="lead lead-centered"><?= e(current_lang() === 'en' ? 'Coordinated areas ensuring visible, sustainable outcomes.' : (current_lang() === 'de' ? 'Koordiniertes Zusammenspiel für sichtbare und dauerhafte Erfolge.' : 'Trabajamos las tres áreas de forma coordinada para que el avance sea visible y duradero.')) ?></p>
            </div>

            <div class="service-pillars-grid">
                <article class="pillar-card">
                    <div class="pillar-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6.5 6.5 A5.5 5.5 0 0 1 17.5 6.5"/>
                            <line x1="12" y1="2" x2="12" y2="5"/>
                            <polyline points="6 12 10 16 18 8"/>
                            <circle cx="12" cy="12" r="10"/>
                        </svg>
                    </div>
                    <h3><?= e(current_lang() === 'en' ? 'Adapted Strength Training' : (current_lang() === 'de' ? 'Personalisiertes Krafttraining' : 'Entrenamiento de Fuerza Adaptado')) ?></h3>
                    <p><?= e(current_lang() === 'en' ? 'Custom strength and body recomposition plans tailored to your metabolism, injury history, and real schedule. Scaled for gym, home, or outdoor setups.' : (current_lang() === 'de' ? 'Individuelle Kraft- und Muskelaufbaupläne abgestimmt auf Stoffwechsel, Vorerkrankungen und Ihren Zeitplan. Im Studio, zu Hause oder im Freien.' : 'Programas personalizados de fuerza y masa muscular adaptados a tu salud metabólica, lesiones previas y horarios reales. En gimnasio, casa o exterior.')) ?></p>
                </article>

                <article class="pillar-card">
                    <div class="pillar-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2z"/>
                            <path d="M12 6v6l4 2"/>
                        </svg>
                    </div>
                    <h3><?= e(current_lang() === 'en' ? 'Flexible Clinical Nutrition' : (current_lang() === 'de' ? 'Flexible Klinische Ernährung' : 'Nutrición Clínica y Flexible')) ?></h3>
                    <p><?= e(current_lang() === 'en' ? 'Evidence-based nutrition without forbidden foods or hunger. We optimize your gut health, hormonal balance, and daily vitality.' : (current_lang() === 'de' ? 'Evidenzbasierte Ernährung ohne Verbote und ohne Hungern. Zur Optimierung von Darmgesundheit, Hormonbalance und Energielevel.' : 'Pautas respaldadas por evidencia científica, sin alimentos prohibidos ni pasar hambre. Maximizamos tu salud digestiva, balance hormonal y vitalidad diaria.')) ?></p>
                </article>

                <article class="pillar-card">
                    <div class="pillar-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>
                    <h3><?= e(current_lang() === 'en' ? 'Continuous Direct Follow-Up' : (current_lang() === 'de' ? 'Engmaschige Begleitung' : 'Acompañamiento Continuo')) ?></h3>
                    <p><?= e(current_lang() === 'en' ? 'Direct communication and regular reviews to evaluate progress, fine-tune variables, and resolve questions at any time. Empathetic guidance.' : (current_lang() === 'de' ? 'Direkter Kontakt und regelmäßige Analysen, um Fortschritte zu messen und Anpassungen vorzunehmen. Zuverlässige und nahbare Begleitung.' : 'Contacto directo y revisiones periódicas para evaluar progresos, afinar variables y resolver dudas en cualquier momento. Acompañamiento real y cercano.')) ?></p>
                </article>
            </div>
        </div>
    </section>

    <!-- MODALIDADES: PRESENCIAL VS ONLINE -->
    <section class="wrap section">
        <div class="section-heading text-center">
            <p class="kicker"><?= e(current_lang() === 'en' ? 'Consultation Modes' : (current_lang() === 'de' ? 'Verfügbare Formate' : 'Modalidades disponibles')) ?></p>
            <h2><?= e(current_lang() === 'en' ? 'Choose how you prefer to work together' : (current_lang() === 'de' ? 'Wählen Sie Ihre bevorzugte Beratungsform' : 'Elige cómo prefieres trabajar con nosotros')) ?></h2>
            <p class="lead lead-centered"><?= e(current_lang() === 'en' ? 'Both in-person visits in Madrid and online video consultations deliver identical clinical rigor and individualization.' : (current_lang() === 'de' ? 'Sowohl vor Ort in Madrid als auch per Videosprechstunde erhalten Sie dieselbe wissenschaftliche Präzision.' : 'Tanto en la consulta presencial en Madrid como en videoconsulta online, recibirás la misma rigurosidad y atención individualizada.')) ?></p>
        </div>

        <div class="modes-grid">
            <!-- Modalidad Presencial -->
            <div class="mode-card is-featured">
                <div class="mode-header">
                    <span class="mode-badge">Madrid Clinic</span>
                    <strong style="color:var(--moss);"><?= e(t('services_presential')) ?></strong>
                </div>
                <h3><?= e(t('services_presential')) ?></h3>
                <p><?= e(current_lang() === 'en' ? 'Private consultation at Clínica SurgEOM (Madrid). Ideal for patients who value instrumental anthropometry and in-person care with Elena.' : (current_lang() === 'de' ? 'Persönliche Sprechstunde in der Clínica SurgEOM (Madrid). Ideal für apparative Körpervermessung und direkten Kontakt mit Elena.' : 'Consulta privada en Clínica SurgEOM (Madrid). Ideal para quienes buscan valoración física instrumental y contacto presencial con Elena.')) ?></p>
                
                <ul class="mode-features">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><strong><?= e(current_lang() === 'en' ? 'Official ISAK Anthropometry:' : (current_lang() === 'de' ? 'Offizielle ISAK-Anthropometrie:' : 'Medición Antropométrica Oficial ISAK:')) ?></strong> <?= e(current_lang() === 'en' ? 'Precise quantification of fat and muscle tissue.' : (current_lang() === 'de' ? 'Präzise Erfassung von Fett- und Muskelgewebe.' : 'Cuantificación exacta de masa muscular y grasa corporal.')) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(current_lang() === 'en' ? 'Full 60-minute in-depth clinical interview.' : (current_lang() === 'de' ? '60-minütige ausführliche Erstanamnese.' : 'Entrevista clínica y valoración integral de 60 minutos.')) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(current_lang() === 'en' ? 'Personalized plan delivered on private digital platform.' : (current_lang() === 'de' ? 'Bereitstellung des Plans über die private Plattform.' : 'Plan de nutrición y pauta de fuerza en plataforma digital privada.')) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(current_lang() === 'en' ? 'Continuous direct channel between check-ins.' : (current_lang() === 'de' ? 'Direkter Kontaktkanal für Zwischenfragen.' : 'Canal directo de comunicación entre consultas para dudas y revisiones.')) ?></span>
                    </li>
                </ul>

                <a href="<?= e(page_url('/reserva-de-citas.php')) ?>" class="btn" style="margin-top:auto;">
                    <span><?= e(current_lang() === 'en' ? 'Book In-Person Visit' : (current_lang() === 'de' ? 'Vor-Ort-Termin buchen' : 'Reservar consulta presencial')) ?></span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>

            <!-- Modalidad Online -->
            <div class="mode-card">
                <div class="mode-header">
                    <span class="mode-badge"><?= e(current_lang() === 'en' ? 'Anywhere' : (current_lang() === 'de' ? 'Ortsunabhängig' : 'Desde cualquier lugar')) ?></span>
                    <strong style="color:var(--ink-soft);"><?= e(t('services_online')) ?></strong>
                </div>
                <h3><?= e(t('services_online')) ?></h3>
                <p><?= e(current_lang() === 'en' ? 'The exact same clinical rigor, empathy, and continuous guidance for patients worldwide without travel.' : (current_lang() === 'de' ? 'Gleiche wissenschaftliche Präzision, Empathie und engmaschige Betreuung weltweit bequem von zu Hause aus.' : 'El mismo rigor clínico, empatía y seguimiento estrecho para pacientes de cualquier lugar del mundo sin desplazamientos.')) ?></p>

                <ul class="mode-features">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(current_lang() === 'en' ? '60-minute HD video call consultation with Elena.' : (current_lang() === 'de' ? '60-minütige HD-Videosprechstunde mit Elena.' : 'Videoconsulta individualizada HD de 60 minutos con Elena.')) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(current_lang() === 'en' ? 'Analysis of blood tests, daily habits, and health history.' : (current_lang() === 'de' ? 'Auswertung von Blutwerten, Ernährungsprotokollen und Symptomen.' : 'Análisis exhaustivo de analíticas médicas, historial y estilo de vida.')) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(current_lang() === 'en' ? 'Custom flexible menus & training routine with exercise videos.' : (current_lang() === 'de' ? 'Ernährungsplan & Trainingsplan mit Technik-Lehrvideos.' : 'Menús flexibles y plan de fuerza con vídeos guiados de técnica.')) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        <span><?= e(current_lang() === 'en' ? 'Continuous direct messaging and check-ins.' : (current_lang() === 'de' ? 'Laufende Begleitung und schnelle Klärung aller Fragen.' : 'Canal continuo de resolución ágil de dudas y revisiones regulares.')) ?></span>
                    </li>
                </ul>

                <a href="<?= e(page_url('/reserva-de-citas.php')) ?>" class="btn btn-ghost" style="margin-top:auto;">
                    <span><?= e(current_lang() === 'en' ? 'Book Online Session' : (current_lang() === 'de' ? 'Online-Termin buchen' : 'Reservar videoconsulta online')) ?></span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA FINAL DE SERVICIOS -->
    <section class="wrap section">
        <div class="cta-luxury-banner">
            <div class="cta-luxury-glow" aria-hidden="true"></div>
            <div class="cta-luxury-body">
                <h2><?= e(t('cta_title')) ?></h2>
                <p><?= e(t('cta_lead')) ?></p>
                <div class="actions">
                    <a class="btn btn-white" href="<?= e(page_url('/reserva-de-citas.php')) ?>"><?= e(t('btn_book_now')) ?></a>
                    <a class="btn btn-ghost-white" href="<?= e(page_url('/contacto.php')) ?>"><?= e(t('btn_contact')) ?></a>
                </div>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

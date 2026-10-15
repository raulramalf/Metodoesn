<?php
/**
 * Sistema de Internacionalización (i18n) para Método ESN
 * Soporta Español ('es'), Inglés ('en') y Alemán ('de')
 */

if (session_status() === PHP_SESSION_NONE && PHP_SAPI !== 'cli') {
    session_start();
}

/**
 * Idiomas soportados
 */
function supported_languages(): array {
    return [
        'es' => [
            'name' => 'Español',
            'label' => 'ES',
            'flag' => '🇪🇸'
        ],
        'en' => [
            'name' => 'English',
            'label' => 'EN',
            'flag' => '🇬🇧'
        ],
        'de' => [
            'name' => 'Deutsch',
            'label' => 'DE',
            'flag' => '🇩🇪'
        ]
    ];
}

/**
 * Banderas vectoriales en SVG puro (compatibles con Windows y todos los dispositivos)
 */
function flag_svg(string $lang, int $width = 18, int $height = 13): string {
    switch ($lang) {
        case 'es':
            return '<svg class="lang-flag-svg" viewBox="0 0 640 480" width="' . $width . '" height="' . $height . '" aria-hidden="true" style="border-radius:2px; box-shadow:0 1px 3px rgba(0,0,0,0.18); flex-shrink:0;"><g fill-rule="evenodd"><path fill="#aa151b" d="M0 0h640v480H0z"/><path fill="#f1bf00" d="M0 120h640v240H0z"/></g></svg>';
        case 'en':
            return '<svg class="lang-flag-svg" viewBox="0 0 640 480" width="' . $width . '" height="' . $height . '" aria-hidden="true" style="border-radius:2px; box-shadow:0 1px 3px rgba(0,0,0,0.18); flex-shrink:0;"><g fill-rule="evenodd"><path fill="#012169" d="M0 0h640v480H0z"/><path fill="#fff" d="m75 0 245 184L565 0h75v56L435 240l205 154v86h-75L320 296 75 480H0v-56l205-154L0 116V0z"/><path fill="#c8102e" d="m424 288 216 162v30h-30L384 318zM640 0v12L440 162l32 24L640 50zM0 480v-12l200-150-32-24L0 430zM0 0l216 162-32 24L0 50z"/><path fill="#fff" d="M240 0h160v480H240zM0 160h640v160H0z"/><path fill="#c8102e" d="M267 0h106v480H267zM0 187h640v106H0z"/></g></svg>';
        case 'de':
            return '<svg class="lang-flag-svg" viewBox="0 0 640 480" width="' . $width . '" height="' . $height . '" aria-hidden="true" style="border-radius:2px; box-shadow:0 1px 3px rgba(0,0,0,0.18); flex-shrink:0;"><g fill-rule="evenodd"><path fill="#000" d="M0 0h640v160H0z"/><path fill="#dd0000" d="M0 160h640v160H0z"/><path fill="#ffce00" d="M0 320h640v160H0z"/></g></svg>';
        default:
            return '';
    }
}

/**
 * Obtener idioma actual (prioridad: GET -> SESSION -> COOKIE -> 'es')
 */
/** Fija el idioma de la petición sin tocar sesión/cookie (páginas disponibles solo en un idioma). */
function force_lang(?string $lang = null): ?string {
    static $forced = null;
    if ($lang !== null) $forced = ($lang === '') ? null : $lang;   // '' = limpiar (tests)
    return $forced;
}

function current_lang(): string {
    $supported = array_keys(supported_languages());
    if (force_lang() !== null) return force_lang();

    if (isset($_GET['lang']) && in_array($_GET['lang'], $supported, true)) {
        $lang = $_GET['lang'];
        $_SESSION['site_lang'] = $lang;
        if (PHP_SAPI !== 'cli' && !headers_sent()) {
            setcookie('site_lang', $lang, ['expires' => time() + 86400 * 30, 'path' => '/', 'secure' => !empty($_SERVER['HTTPS']), 'httponly' => true, 'samesite' => 'Lax']);
        }
        return $lang;
    }

    if (!empty($_SESSION['site_lang']) && in_array($_SESSION['site_lang'], $supported, true)) {
        return $_SESSION['site_lang'];
    }

    if (!empty($_COOKIE['site_lang']) && in_array($_COOKIE['site_lang'], $supported, true)) {
        $_SESSION['site_lang'] = $_COOKIE['site_lang'];
        return $_COOKIE['site_lang'];
    }

    return 'es';
}

/**
 * Generar enlace para conmutar idioma en la URL actual
 */
function lang_url(string $targetLang): string {
    if (force_lang() !== null) {   // página monolingüe: el selector lleva a la home del idioma elegido
        return $targetLang === 'es' ? '/?lang=es' : '/?lang=' . $targetLang;
    }
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    $parts = parse_url($uri);
    $path = $parts['path'] ?? '/';
    
    $params = [];
    if (!empty($parts['query'])) {
        parse_str($parts['query'], $params);
    }
    
    $params['lang'] = $targetLang;
    return $path . '?' . http_build_query($params);
}

/**
 * Generar URL interna preservando el idioma si es distinto de 'es'
 */
function page_url(string $path): string {
    $lang = current_lang();
    if ($lang === 'es') {
        return $path;
    }
    $separator = (strpos($path, '?') === false) ? '?' : '&';
    return $path . $separator . 'lang=' . urlencode($lang);
}

/**
 * Diccionario maestro de traducciones
 */
function translations(): array {
    return [
        'es' => [
            // Navegación
            'nav_skip' => 'Saltar al contenido',
            'nav_home' => 'Método ESN',
            'nav_about' => 'Quiénes somos',
            'nav_services' => 'Servicios',
            'nav_faq' => 'Dudas',
            'nav_contact' => 'Contacto',
            'nav_book' => 'Reserva tu cita',
            'nav_menu_toggle' => 'Abrir menú de navegación',

            // Footer
            'footer_tagline' => 'Elena Sánchez Novo · Col. Nº MAD01639 (CODINMA)',
            'footer_desc' => 'Entrenamiento personal, nutrición clínica y acompañamiento continuado. Un método riguroso basado en evidencia científica para construir hábitos reales que perduren toda la vida.',
            'footer_clinical_rep' => 'Reputación Clínica',
            'footer_rating_badge' => '5.0 de 5',
            'footer_rating_sub' => 'Más de 50 opiniones verificadas de pacientes en Doctoralia España con 100% de recomendación.',
            'footer_view_cert' => 'Ver certificado oficial',
            'footer_contact_title' => 'Contacto & Consulta',
            'footer_rights' => 'Todos los derechos reservados.',
            'footer_legal' => 'Aviso Legal',
            'footer_privacy' => 'Privacidad',
            'footer_cookies' => 'Cookies',

            // Cookies
            'cookie_text' => 'Utilizamos cookies esenciales y analíticas para brindarte la mejor experiencia en nuestra web. Puedes aceptarlas o rechazarlas libremente.',
            'cookie_more' => 'Política de Cookies',
            'cookie_accept' => 'Aceptar todas',
            'cookie_deny' => 'Solo necesarias',

            // Botones comunes
            'btn_book_initial' => 'Reserva tu consulta',
            'btn_book_now' => 'Reserva tu cita con Elena',
            'btn_learn_more' => 'Conoce a Elena Sánchez Novo',
            'btn_explore_services' => 'Explorar servicios',
            'btn_contact' => 'Contactar ahora',
            'btn_whatsapp' => 'Contactar por WhatsApp',
            'btn_doctoralia_profile' => 'Ver perfil en Doctoralia',

            // Hero Index
            'hero_kicker' => 'Salud · Nutrición · Rendimiento',
            'seo_home_title' => 'Nutricionista clínica en Madrid y online | Método ESN',
            'seo_home_desc' => 'Dietista-nutricionista colegiada en Madrid y online: SIBO, colon irritable, SOP y nutrición deportiva con entrenamiento de fuerza. Pide tu cita.',
            'seo_services_title' => 'Nutrición digestiva, hormonal y deportiva en Madrid | Método ESN',
            'seo_services_desc' => 'Consulta presencial en Clínica SurgEOM (Salamanca) u online: SIBO, disbiosis, SOP, resistencia a la insulina, composición corporal y rendimiento.',
            'seo_about_title' => 'Elena Sánchez Novo, dietista-nutricionista MAD01639 | Método ESN',
            'seo_about_desc' => 'Dietista-nutricionista (Col. MAD01639) y graduada en CAFyD, antropometrista ISAK. Nutrición clínica y entrenamiento de fuerza basados en evidencia.',
            'seo_faq_title' => 'Preguntas frecuentes sobre nutrición clínica | Método ESN',
            'seo_faq_desc' => 'Primera consulta, SIBO, pérdida de grasa, suplementos y consulta online: respuestas claras de una dietista-nutricionista colegiada en Madrid.',
            'seo_contact_title' => 'Contacto y cómo llegar a Clínica SurgEOM, Madrid | Método ESN',
            'seo_contact_desc' => 'Escribe o llama a Elena Sánchez Novo. Consulta en C/ Coslada 16 (28028 Madrid), de lunes a viernes de 16:00 a 21:00, o videoconsulta.',
            'seo_booking_title' => 'Reserva tu cita de nutrición en Madrid u online | Método ESN',
            'seo_booking_desc' => 'Agenda oficial en Doctoralia: elige día y hora para tu consulta presencial en Madrid o por videollamada con Elena Sánchez Novo.',
            'hero_title' => 'Cuidar tu salud no es vivir a dieta, es aprender a comer y entrenar para toda la vida.',
            'hero_sub' => 'Un método integrador en Madrid y Online guiado por Elena Sánchez Novo (Col. Nº MAD01639).',
            'hero_lead' => 'Diseñamos tu estrategia de nutrición clínica y entrenamiento con respaldo científico, cercanía humana y máxima individualización.',
            'hero_desc' => 'Sin dietas restrictivas ni soluciones milagro. Aprende a entender tu cuerpo, alcanzar tus metas físicas y mantener tus resultados sin renunciar a tu vida.',
            'hero_badge_rating' => '5.0 en Doctoralia',
            'hero_badge_rating_sub' => '+50 opiniones verificadas',
            'hero_trust_colegiada' => 'Colegiada Oficial CODINMA Nº MAD01639',
            'hero_trust_degree' => 'Doble Graduada en Nutrición y CAFyD',
            'hero_trust_doctoralia' => '100% Opiniones 5 Estrellas en Doctoralia',
            'hero_trust_clinic' => 'Consulta Presencial en Clínica SurgEOM Madrid',

            // Trust Strip
            'trust_col' => 'Colegiada Oficial CODINMA',
            'trust_col_sub' => 'Nº MAD01639 · Dietista-Nutricionista',
            'trust_univ' => 'Formación Universitaria Doble',
            'trust_univ_sub' => 'Graduada en Nutrición + CAFyD',
            'trust_clinic' => 'Clínica SurgEOM Madrid',
            'trust_clinic_sub' => 'Instalaciones médico-quirúrgicas',
            'trust_opinions' => 'Doctoralia España',
            'trust_opinions_sub' => '5.0 ★ (+50 valoraciones reales)',

            // Comparativa
            'compare_kicker' => 'El cambio de enfoque',
            'compare_title' => '¿Por qué la mayoría de dietas fracasan frente al Método ESN?',
            'compare_sub' => 'La diferencia entre una pauta temporal restrictiva y una educación que transforma tu salud para siempre.',
            'compare_bad_title' => 'Dietas convencionales y rutinas genéricas',
            'compare_bad_tag' => 'Solución temporal',
            'compare_bad_1' => 'Menús cerrados e inflexibles que no se adaptan a tu entorno social ni a tu ritmo laboral.',
            'compare_bad_2' => 'Restricciones extremas que disparan la ansiedad, los antojos y el inevitable efecto rebote.',
            'compare_bad_3' => 'Entrenamientos genéricos desconectados de tu estado de salud, postura o nivel inicial.',
            'compare_bad_4' => 'Consultas aisladas una vez al mes sin soporte diario ni resolución de imprevistos.',
            'compare_good_title' => 'El Método ESN con Elena Sánchez Novo',
            'compare_good_tag' => 'Sostenible y Clínico',
            'compare_good_1' => 'Plan 100% personalizado según tus gustos, analíticas, digestión y vida cotidiana.',
            'compare_good_2' => 'Alimentación flexible y rica: aprendes a comer sin prohibiciones ni culpa.',
            'compare_good_3' => 'Sinergia real entre nutrición y ejercicio físico guiado por una profesional graduada en CAFyD.',
            'compare_good_4' => 'Acompañamiento cercano y continuo para resolver dudas y adaptar pautas en tiempo real.',

            // Bento Fundamentos
            'bento_kicker' => 'Nuestra base clínica',
            'bento_title' => 'Los 5 pilares que construyen tu transformación',
            'bento_lead' => 'No dejamos nada al azar. Cada decisión tiene justificación científica y clínica.',

            // Especialidades
            'spec_kicker' => 'Áreas de intervención clínica',
            'spec_title' => 'En qué situaciones puedo ayudarte',
            'spec_sub' => 'Un enfoque riguroso adaptado a tu fisiología, patología o rendimiento deportivo.',

            // Roadmap
            'roadmap_kicker' => 'Paso a paso',
            'roadmap_title' => 'Cómo es el proceso desde el primer día',
            'roadmap_sub' => 'Un recorrido claro, estructurado y sin incertidumbre diseñado para tu éxito.',

            // Testimonios
            'testi_kicker' => 'Opiniones verificadas',
            'testi_title' => 'Experiencias de pacientes en Doctoralia',
            'testi_sub' => 'Historias reales de personas que han transformado su relación con la alimentación y su salud.',

            // CTA Final
            'cta_title' => '¿Preparada para transformar tu salud de manera definitiva?',
            'cta_lead' => 'Agenda tu consulta inicial presencial en Madrid o mediante videoconsulta online con Elena Sánchez Novo.',

            // Páginas Interiores: Quiénes somos
            'about_page_title' => 'Quiénes somos · Elena Sánchez Novo',
            'about_kicker' => 'Sobre mí',
            'about_sub' => 'Dietista-Nutricionista (Col. Nº MAD01639) · Graduada en CAFyD',
            'about_p1' => 'Cuidar la alimentación no consiste en seguir una dieta perfecta, sino en encontrar una forma de comer que se adapte a ti, a tu estilo de vida y a tus objetivos, basada en la evidencia científica.',
            'about_p2' => 'Soy graduada en Nutrición Humana y Dietética (Universidad de Alcalá) y en Ciencias de la Actividad Física y del Deporte - CAFyD (Universidad Rey Juan Carlos), lo que me permite abordar tu salud desde una perspectiva verdaderamente integradora.',
            'about_p3' => 'Acompaño a personas que desean perder grasa, recomponer su composición corporal, ganar masa muscular, mejorar su rendimiento deportivo, cuidar su salud digestiva (hinchazón, SIBO, intolerancias), optimizar su salud hormonal (SOP, tiroides, amenorrea) o simplemente aprender a alimentarse mejor sin pasar hambre ni vivir con culpa.',
            'about_p4' => 'Mi filosofía de trabajo se basa en el seguimiento continuado, la educación nutricional y la adaptación constante de cada pauta. No creo en los regímenes restrictivos ni en las soluciones milagro, sino en forjar hábitos que puedas mantener toda la vida mientras disfrutas de tus comidas y de tu entorno social.',
            'about_edu_title' => 'Titulación y formación académica oficial',
            'about_edu_sub' => 'Una sólida base universitaria y actualización científica constante.',
            'about_clinic_title' => 'Nuestro espacio de consulta en Madrid',
            'about_clinic_sub' => 'Atención presencial en Clínica SurgEOM (Clínica Médico-Quirúrgica y Dermatológica de referencia en Madrid). Un entorno cuidado, confidencial y dotado de equipamiento clínico avanzado.',

            // Servicios
            'services_page_title' => 'Servicios de Nutrición y Entrenamiento',
            'services_kicker' => 'Planes Clínicos Integrales',
            'services_title' => 'Nutrición clínica y entrenamiento a tu medida',
            'services_lead' => 'Elige la modalidad que mejor encaje con tu ritmo de vida: atención presencial en Clínica SurgEOM (Madrid) o videoconsulta 100% online.',
            'services_presential' => 'Consulta Presencial en Madrid',
            'services_online' => 'Consulta y Seguimiento Online',

            // Dudas
            'faq_page_title' => 'Preguntas Frecuentes y Dudas',
            'faq_kicker' => 'Respuestas Claras',
            'faq_title' => 'Preguntas frecuentes sobre el Método ESN',
            'faq_lead' => 'Todo lo que necesitas saber sobre las consultas, el seguimiento, la metodología y cómo comenzamos.',
            'faq_search_placeholder' => 'Buscar una duda (ej. primera consulta, patologías, online, hambre...)',

            // Contacto
            'contact_page_title' => 'Contacto y Citas · Método ESN',
            'contact_kicker' => 'Canales directos',
            'contact_title' => 'Ponte en contacto con Elena Sánchez Novo',
            'contact_lead' => 'Resuelve cualquier consulta antes de tu cita o visítanos en Clínica SurgEOM en Madrid.',
            'contact_form_title' => 'Envíanos un mensaje',
            'contact_name' => 'Tu nombre completo',
            'contact_email' => 'Correo electrónico',
            'contact_phone' => 'Teléfono o WhatsApp',
            'contact_interest' => '¿En qué estás interesada/o?',
            'contact_message' => 'Cuéntanos brevemente tu caso',
            'contact_send' => 'Enviar mensaje directo',
            'contact_privacy_note' => 'Tus datos son confidenciales y solo se emplean para responder tu consulta.',

            // Reserva
            'booking_page_title' => 'Reserva de Citas Oficial',
            'booking_kicker' => 'Agenda Oficial en Doctoralia',
            'booking_title' => 'Selecciona fecha y hora para tu consulta',
            'booking_lead' => 'Reserva directamente tu sesión presencial en Clínica SurgEOM (Madrid) o por videoconsulta online mediante el sistema oficial de Doctoralia.'
        ],

        'en' => [
            // Navigation
            'nav_skip' => 'Skip to content',
            'nav_home' => 'ESN Method',
            'nav_about' => 'About Elena',
            'nav_services' => 'Services',
            'nav_faq' => 'FAQ',
            'nav_contact' => 'Contact',
            'nav_book' => 'Book appointment',
            'nav_menu_toggle' => 'Open navigation menu',

            // Footer
            'footer_tagline' => 'Elena Sánchez Novo · Lic. No. MAD01639 (CODINMA)',
            'footer_desc' => 'Personal training, clinical nutrition, and continuous guidance. An evidence-based clinical approach designed to build sustainable habits that last a lifetime.',
            'footer_clinical_rep' => 'Clinical Reputation',
            'footer_rating_badge' => '5.0 out of 5',
            'footer_rating_sub' => 'Over 50 verified patient reviews on Doctoralia Spain with a 100% recommendation score.',
            'footer_view_cert' => 'View official certificate',
            'footer_contact_title' => 'Contact & Clinic',
            'footer_rights' => 'All rights reserved.',
            'footer_legal' => 'Legal Notice',
            'footer_privacy' => 'Privacy Policy',
            'footer_cookies' => 'Cookie Policy',

            // Cookies
            'cookie_text' => 'We use essential and analytics cookies to ensure the best browsing experience. You can accept or decline them at any time.',
            'cookie_more' => 'Cookie Policy',
            'cookie_accept' => 'Accept all',
            'cookie_deny' => 'Necessary only',

            // Common Buttons
            'btn_book_initial' => 'Book your consultation',
            'btn_book_now' => 'Book appointment with Elena',
            'btn_learn_more' => 'Meet Elena Sánchez Novo',
            'btn_explore_services' => 'Explore services',
            'btn_contact' => 'Get in touch',
            'btn_whatsapp' => 'Contact via WhatsApp',
            'btn_doctoralia_profile' => 'View Doctoralia profile',

            // Hero Index
            'hero_kicker' => 'Health · Nutrition · Performance',
            'seo_home_title' => 'Clinical Dietitian in Madrid & Online | Método ESN',
            'seo_home_desc' => 'Registered dietitian-nutritionist in Madrid and online: SIBO, IBS, PCOS and sports nutrition combined with strength training. Book your appointment.',
            'seo_services_title' => 'Digestive, Hormonal & Sports Nutrition in Madrid | Método ESN',
            'seo_services_desc' => 'In-person at Clínica SurgEOM (Salamanca district) or online: SIBO, dysbiosis, PCOS, insulin resistance, body composition and performance.',
            'seo_about_title' => 'Elena Sánchez Novo, Registered Dietitian MAD01639 | Método ESN',
            'seo_about_desc' => 'Registered dietitian-nutritionist (Lic. MAD01639), sports science graduate and ISAK anthropometrist. Evidence-based nutrition and strength training.',
            'seo_faq_title' => 'Clinical Nutrition FAQ | Método ESN',
            'seo_faq_desc' => 'First visit, SIBO, fat loss, supplements and online consultations: clear answers from a registered dietitian-nutritionist in Madrid.',
            'seo_contact_title' => 'Contact & Directions to Clínica SurgEOM, Madrid | Método ESN',
            'seo_contact_desc' => 'Write or call Elena Sánchez Novo. Consultations at C/ Coslada 16 (28028 Madrid), Monday to Friday 16:00-21:00, or by video call.',
            'seo_booking_title' => 'Book a Nutrition Appointment in Madrid or Online | Método ESN',
            'seo_booking_desc' => 'Official Doctoralia calendar: pick a date and time for your in-person visit in Madrid or video consultation with Elena Sánchez Novo.',
            'hero_title' => 'Caring for your health is not living on a diet—it is learning to eat and train for life.',
            'hero_sub' => 'An integrative methodology in Madrid and Online guided by Elena Sánchez Novo (Lic. No. MAD01639).',
            'hero_lead' => 'We design your clinical nutrition and personal training plan with scientific backing, empathetic care, and complete individualization.',
            'hero_desc' => 'No restrictive meal plans or quick-fix miracles. Learn to understand your body, achieve your physical goals, and sustain your progress without sacrificing your daily lifestyle.',
            'hero_badge_rating' => '5.0 on Doctoralia',
            'hero_badge_rating_sub' => '+50 verified reviews',
            'hero_trust_colegiada' => 'Registered Dietitian CODINMA No. MAD01639',
            'hero_trust_degree' => 'Dual Degree in Nutrition & Sports Science',
            'hero_trust_doctoralia' => '100% 5-Star Reviews on Doctoralia',
            'hero_trust_clinic' => 'In-person clinic at SurgEOM Madrid',

            // Trust Strip
            'trust_col' => 'Official CODINMA Registered',
            'trust_col_sub' => 'Lic. MAD01639 · Dietitian-Nutritionist',
            'trust_univ' => 'Dual University Degree',
            'trust_univ_sub' => 'Human Nutrition + Sports Science',
            'trust_clinic' => 'Clínica SurgEOM Madrid',
            'trust_clinic_sub' => 'Medical & surgical facilities',
            'trust_opinions' => 'Doctoralia Spain',
            'trust_opinions_sub' => '5.0 ★ (+50 verified patient ratings)',

            // Comparison
            'compare_kicker' => 'A New Perspective',
            'compare_title' => 'Why conventional diets fail compared to the ESN Method',
            'compare_sub' => 'The difference between a temporary restrictive plan and a science-based education that transforms your health permanently.',
            'compare_bad_title' => 'Conventional diets & cookie-cutter routines',
            'compare_bad_tag' => 'Temporary quick fix',
            'compare_bad_1' => 'Inflexible rigid menus that clash with your social life and work schedule.',
            'compare_bad_2' => 'Extreme food restrictions causing cravings, hunger, and rebound weight gain.',
            'compare_bad_3' => 'Generic workouts disconnected from your posture, joint health, and fitness level.',
            'compare_bad_4' => 'Isolated monthly consultations with zero support between sessions.',
            'compare_good_title' => 'The ESN Method with Elena Sánchez Novo',
            'compare_good_tag' => 'Sustainable & Clinical',
            'compare_good_1' => '100% personalized strategy matched to your biomarkers, digestion, and daily routine.',
            'compare_good_2' => 'Flexible and delicious nutrition: learn to eat without fear or guilt.',
            'compare_good_3' => 'True synergy between nutrition and exercise guided by a Sports Science graduate.',
            'compare_good_4' => 'Continuous empathetic guidance to answer questions and adjust details in real time.',

            // Bento Fundamentos
            'bento_kicker' => 'Clinical Foundation',
            'bento_title' => 'The 5 pillars behind your lasting transformation',
            'bento_lead' => 'Nothing is left to chance. Every clinical decision is evidence-based and tailored to your physiology.',

            // Especialidades
            'spec_kicker' => 'Areas of Clinical Expertise',
            'spec_title' => 'How we can help you',
            'spec_sub' => 'A personalized approach tailored to your metabolism, hormones, digestive health, or athletic performance.',

            // Roadmap
            'roadmap_kicker' => 'Step by step',
            'roadmap_title' => 'How the journey unfolds from day one',
            'roadmap_sub' => 'A clear, structured, and predictable process built for lasting success.',

            // Testimonios
            'testi_kicker' => 'Verified Reviews',
            'testi_title' => 'Patient experiences on Doctoralia',
            'testi_sub' => 'Real stories from patients who redefined their relationship with food and fitness.',

            // CTA Final
            'cta_title' => 'Ready to transform your health permanently?',
            'cta_lead' => 'Schedule your initial consultation in Madrid or via online video call with Elena Sánchez Novo.',

            // About Page
            'about_page_title' => 'About me · Elena Sánchez Novo',
            'about_kicker' => 'About Elena',
            'about_sub' => 'Registered Dietitian-Nutritionist (Lic. No. MAD01639) · Sports Science Graduate',
            'about_p1' => 'Taking care of nutrition is not about following a rigid diet—it is about finding a way of eating that fits you, your lifestyle, and your goals, grounded in scientific evidence.',
            'about_p2' => 'I hold degrees in Human Nutrition & Dietetics (University of Alcalá) and Physical Activity & Sports Sciences (Rey Juan Carlos University), providing an integrative clinical perspective.',
            'about_p3' => 'I support individuals who want to lose fat, build muscle, improve sports performance, heal their digestive health (SIBO, bloating, food sensitivities), balance hormones (PCOS, thyroid), or simply eat better without guilt or starvation.',
            'about_p4' => 'My methodology centers on continuous follow-up, nutrition education, and continuous plan calibration. I reject crash diets and miracle fixes, focusing on lifelong habits that let you enjoy meals and your social life.',
            'about_edu_title' => 'Official Academic Credentials',
            'about_edu_sub' => 'Solid university degrees and ongoing clinical research updates.',
            'about_clinic_title' => 'Our Clinical Practice in Madrid',
            'about_clinic_sub' => 'In-person consultations at Clínica SurgEOM (a leading surgical and dermatological medical clinic in Madrid). Confidential, state-of-the-art facilities.',

            // Services
            'services_page_title' => 'Clinical Nutrition & Training Services',
            'services_kicker' => 'Comprehensive Clinical Plans',
            'services_title' => 'Tailored clinical nutrition & personal training',
            'services_lead' => 'Choose the consultation mode that matches your routine: in-person at Clínica SurgEOM (Madrid) or 100% online video consultations.',
            'services_presential' => 'In-Person Consultation in Madrid',
            'services_online' => 'Online Consultation & Tracking',

            // Dudas
            'faq_page_title' => 'Frequently Asked Questions & Answers',
            'faq_kicker' => 'Clear Answers',
            'faq_title' => 'Frequently Asked Questions about ESN Method',
            'faq_lead' => 'Everything you need to know about our consultations, follow-up, methodology, and how we start.',
            'faq_search_placeholder' => 'Search any question (e.g., initial visit, hormones, online, hunger...)',

            // Contact
            'contact_page_title' => 'Contact & Appointments · ESN Method',
            'contact_kicker' => 'Direct Channels',
            'contact_title' => 'Get in touch with Elena Sánchez Novo',
            'contact_lead' => 'Clarify any questions before your appointment or visit us at Clínica SurgEOM in Madrid.',
            'contact_form_title' => 'Send a direct message',
            'contact_name' => 'Full Name',
            'contact_email' => 'Email address',
            'contact_phone' => 'Phone or WhatsApp',
            'contact_interest' => 'What are you interested in?',
            'contact_message' => 'Tell us briefly about your goals or case',
            'contact_send' => 'Send message',
            'contact_privacy_note' => 'Your health data is completely confidential and strictly used to answer your inquiry.',

            // Booking
            'booking_page_title' => 'Official Appointment Booking',
            'booking_kicker' => 'Official Doctoralia Calendar',
            'booking_title' => 'Select a date and time for your consultation',
            'booking_lead' => 'Book directly for in-person visits at Clínica SurgEOM Madrid or online video sessions via the official Doctoralia system.'
        ],

        'de' => [
            // Navigation
            'nav_skip' => 'Zum Inhalt springen',
            'nav_home' => 'ESN-Methode',
            'nav_about' => 'Über mich',
            'nav_services' => 'Leistungen',
            'nav_faq' => 'FAQ',
            'nav_contact' => 'Kontakt',
            'nav_book' => 'Termin buchen',
            'nav_menu_toggle' => 'Navigationsmenü öffnen',

            // Footer
            'footer_tagline' => 'Elena Sánchez Novo · Reg.-Nr. MAD01639 (CODINMA)',
            'footer_desc' => 'Personal Training, klinische Ernährung und kontinuierliche Begleitung. Eine wissenschaftlich fundierte Methode zur nachhaltigen Entwicklung gesunder Gewohnheiten fürs ganze Leben.',
            'footer_clinical_rep' => 'Klinische Reputation',
            'footer_rating_badge' => '5.0 von 5',
            'footer_rating_sub' => 'Über 50 verifizierte Patientenbewertungen auf Doctoralia Spanien mit 100% Weiterempfehlung.',
            'footer_view_cert' => 'Offizielles Zertifikat ansehen',
            'footer_contact_title' => 'Kontakt & Praxis',
            'footer_rights' => 'Alle Rechte vorbehalten.',
            'footer_legal' => 'Impressum',
            'footer_privacy' => 'Datenschutz',
            'footer_cookies' => 'Cookie-Richtlinie',

            // Cookies
            'cookie_text' => 'Wir verwenden notwendige und analytische Cookies, um Ihnen die bestmögliche Erfahrung zu bieten. Sie können diese jederzeit anpassen.',
            'cookie_more' => 'Cookie-Richtlinie',
            'cookie_accept' => 'Alle akzeptieren',
            'cookie_deny' => 'Nur notwendige',

            // Common Buttons
            'btn_book_initial' => 'Erstgespräch buchen',
            'btn_book_now' => 'Termin mit Elena buchen',
            'btn_learn_more' => 'Über Elena Sánchez Novo',
            'btn_explore_services' => 'Leistungen ansehen',
            'btn_contact' => 'Jetzt kontaktieren',
            'btn_whatsapp' => 'Über WhatsApp schreiben',
            'btn_doctoralia_profile' => 'Profil auf Doctoralia',

            // Hero Index
            'hero_kicker' => 'Gesundheit · Ernährung · Leistung',
            'seo_home_title' => 'Klinische Ernährungsberatung Madrid & Online | Método ESN',
            'seo_home_desc' => 'Registrierte Ernährungsberaterin in Madrid und online: SIBO, Reizdarm, PCOS und Sporternährung mit Krafttraining. Jetzt Termin buchen.',
            'seo_services_title' => 'Darm-, Hormon- & Sporternährung in Madrid | Método ESN',
            'seo_services_desc' => 'Vor Ort in der Clínica SurgEOM (Salamanca) oder online: SIBO, Dysbiose, PCOS, Insulinresistenz, Körperzusammensetzung und Leistung.',
            'seo_about_title' => 'Elena Sánchez Novo, Ernährungsberaterin MAD01639 | Método ESN',
            'seo_about_desc' => 'Diätassistentin-Ernährungswissenschaftlerin (Reg.-Nr. MAD01639), Sportwissenschaftlerin, ISAK-Anthropometristin. Evidenzbasiert.',
            'seo_faq_title' => 'FAQ zur klinischen Ernährungsberatung | Método ESN',
            'seo_faq_desc' => 'Ersttermin, SIBO, Fettabbau, Supplemente und Online-Beratung: klare Antworten einer registrierten Ernährungsberaterin in Madrid.',
            'seo_contact_title' => 'Kontakt & Anfahrt zur Clínica SurgEOM, Madrid | Método ESN',
            'seo_contact_desc' => 'Schreiben oder rufen Sie Elena Sánchez Novo an. Sprechstunde in der C/ Coslada 16 (28028 Madrid), Mo-Fr 16-21 Uhr, oder per Video.',
            'seo_booking_title' => 'Termin für Ernährungsberatung in Madrid oder Online | Método ESN',
            'seo_booking_desc' => 'Offizieller Doctoralia-Kalender: Wählen Sie Datum und Uhrzeit für Ihre Vor-Ort-Beratung in Madrid oder per Videosprechstunde.',
            'hero_title' => 'Gesundheit bedeutet nicht Diät zu halten, sondern zu lernen, ein Leben lang richtig zu essen und zu trainieren.',
            'hero_sub' => 'Eine ganzheitliche Methode in Madrid und Online, geleitet von Elena Sánchez Novo (Reg.-Nr. MAD01639).',
            'hero_lead' => 'Wir entwickeln Ihre klinische Ernährungs- und Trainingsstrategie mit wissenschaftlicher Evidenz, menschlicher Nähe und maximaler Individualisierung.',
            'hero_desc' => 'Ohne restriktive Verbote oder unrealistische Versprechen. Verstehen Sie Ihren Körper, erreichen Sie Ihre Ziele und sichern Sie Ihren Erfolg dauerhaft, ohne auf Lebensqualität zu verzichten.',
            'hero_badge_rating' => '5.0 auf Doctoralia',
            'hero_badge_rating_sub' => '+50 verifizierte Bewertungen',
            'hero_trust_colegiada' => 'Zertifizierte Diätassistentin CODINMA MAD01639',
            'hero_trust_degree' => 'Doppelabschluss in Ernährung und Sportwissenschaften',
            'hero_trust_doctoralia' => '100% 5-Sterne-Bewertungen auf Doctoralia',
            'hero_trust_clinic' => 'Vor-Ort-Praxis in der SurgEOM Klinik Madrid',

            // Trust Strip
            'trust_col' => 'Offiziell registriert CODINMA',
            'trust_col_sub' => 'Nr. MAD01639 · Diätassistentin-Ernährungswissenschaftlerin',
            'trust_univ' => 'Doppelter Universitätsabschluss',
            'trust_univ_sub' => 'Humanernährung + Sportwissenschaft (CAFyD)',
            'trust_clinic' => 'Clínica SurgEOM Madrid',
            'trust_clinic_sub' => 'Medizinisch-chirurgische Praxiseinrichtung',
            'trust_opinions' => 'Doctoralia Spanien',
            'trust_opinions_sub' => '5.0 ★ (+50 reale Patientenbewertungen)',

            // Comparison
            'compare_kicker' => 'Ein neuer Ansatz',
            'compare_title' => 'Warum herkömmliche Diäten scheitern – und die ESN-Methode funktioniert',
            'compare_sub' => 'Der Unterschied zwischen temporären Verzichtsplänen und einer fundierten Ernährungsbildung für Ihr ganzes Leben.',
            'compare_bad_title' => 'Klassische Diäten & Standardpläne',
            'compare_bad_tag' => 'Temporäre Notlösung',
            'compare_bad_1' => 'Starre Speisepläne, die sich nicht an Berufsalltag und soziales Umfeld anpassen.',
            'compare_bad_2' => 'Extreme Einschränkungen, die zu Heißhunger, Frust und dem gefürchteten Jo-Jo-Effekt führen.',
            'compare_bad_3' => 'Pauschale Trainingspläne ohne Rücksicht auf Gelenke, Haltung und aktuellen Trainingsstand.',
            'compare_bad_4' => 'Einmalige Monatskontrollen ohne kontinuierlichen Ansprechpartner bei Alltagsproblemen.',
            'compare_good_title' => 'Die ESN-Methode mit Elena Sánchez Novo',
            'compare_good_tag' => 'Nachhaltig & Klinisch',
            'compare_good_1' => '100% individuell abgestimmt auf Laborwerte, Verdauung, Vorlieben und Alltag.',
            'compare_good_2' => 'Flexible, schmackhafte Ernährung: essen lernen ohne Verbote oder Schuldgefühle.',
            'compare_good_3' => 'Echte Synergie aus Ernährung und gezieltem Training durch eine diplomierte Sportwissenschaftlerin.',
            'compare_good_4' => 'Engmaschige Begleitung für offene Fragen und Anpassungen in Echtzeit.',

            // Bento Fundamentos
            'bento_kicker' => 'Klinisches Fundament',
            'bento_title' => 'Die 5 Säulen Ihrer nachhaltigen Transformation',
            'bento_lead' => 'Wir überlassen nichts dem Zufall. Jede Entscheidung stützt sich auf klinische und wissenschaftliche Erkenntnisse.',

            // Especialidades
            'spec_kicker' => 'Fachbereiche',
            'spec_title' => 'In welchen Situationen ich Sie unterstützen kann',
            'spec_sub' => 'Ein präziser Ansatz, abgestimmt auf Ihre Physiologie, Hormone oder sportliche Leistung.',

            // Roadmap
            'roadmap_kicker' => 'Schritt für Schritt',
            'roadmap_title' => 'Der Ablauf von Beginn an',
            'roadmap_sub' => 'Ein transparenter, strukturierter Weg ohne Ungewissheit.',

            // Testimonios
            'testi_kicker' => 'Verifizierte Erfahrungen',
            'testi_title' => 'Patientenstimmen auf Doctoralia',
            'testi_sub' => 'Echte Erfahrungsberichte von Patienten, die ihre Gesundheit und ihr Wohlbefinden transformiert haben.',

            // CTA Final
            'cta_title' => 'Bereit für eine nachhaltige Veränderung Ihrer Gesundheit?',
            'cta_lead' => 'Vereinbaren Sie Ihr Erstgespräch vor Ort in Madrid oder bequem per Online-Videosprechstunde mit Elena Sánchez Novo.',

            // About Page
            'about_page_title' => 'Über mich · Elena Sánchez Novo',
            'about_kicker' => 'Über mich',
            'about_sub' => 'Diätassistentin-Ernährungswissenschaftlerin (Reg.-Nr. MAD01639) · Sportwissenschaftlerin',
            'about_p1' => 'Gesunde Ernährung bedeutet nicht, einer perfekten Diät zu folgen, sondern eine Ernährungsweise zu finden, die zu Ihnen, Ihrem Leben und Ihren Zielen passt – fundiert auf wissenschaftlicher Evidenz.',
            'about_p2' => 'Ich habe Abschlüsse in Humanernährung & Diätetik (Universität Alcalá) sowie Sportwissenschaften (Universidad Rey Juan Carlos). Dadurch betrachte ich Ihre Gesundheit ganzheitlich.',
            'about_p3' => 'Ich begleite Menschen bei Fettabbau, Muskelaufbau, sportlicher Leistungssteigerung, Darmgesundheit (Blähbauch, SIBO, Unverträglichkeiten), hormoneller Balance (PCOS, Schilddrüse) oder beim gesunden Essen ohne Heißhunger und Schuldgefühle.',
            'about_p4' => 'Meine Philosophie basiert auf kontinuierlicher Begleitung, Aufklärung und stetiger Anpassung. Ich glaube weder an radikale Diäten noch an Wunderkuren, sondern an Gewohnheiten fürs Leben bei voller Freude am Essen.',
            'about_edu_title' => 'Offizielle akademische Qualifikationen',
            'about_edu_sub' => 'Fundierte Universitätsausbildung und kontinuierliche wissenschaftliche Weiterbildung.',
            'about_clinic_title' => 'Unsere Praxisräume in Madrid',
            'about_clinic_sub' => 'Präsenzberatung in der Clínica SurgEOM (renommierte Fachklinik für Chirurgie und Dermatologie in Madrid). Diskrete Umgebung mit moderner medizinischer Diagnostik.',

            // Services
            'services_page_title' => 'Ernährungsberatung & Trainingsleistungen',
            'services_kicker' => 'Ganzheitliche klinische Pläne',
            'services_title' => 'Maßgeschneiderte klinische Ernährung und Personal Training',
            'services_lead' => 'Wählen Sie das Format, das am besten zu Ihrem Lebensstil passt: Vor-Ort-Sprechstunde in Madrid oder 100% Online-Betreuung.',
            'services_presential' => 'Vor-Ort-Sprechstunde in Madrid',
            'services_online' => 'Online-Sprechstunde & Betreuung',

            // Dudas
            'faq_page_title' => 'Häufig gestellte Fragen (FAQ)',
            'faq_kicker' => 'Klare Antworten',
            'faq_title' => 'Häufige Fragen zur ESN-Methode',
            'faq_lead' => 'Alles Wissenswerte über Ersttermine, Betreuung, Methodik und den Einstieg.',
            'faq_search_placeholder' => 'Frage suchen (z. B. Erstberatung, Hormone, Online, Hunger...)',

            // Contact
            'contact_page_title' => 'Kontakt & Termine · ESN-Methode',
            'contact_kicker' => 'Direkte Kanäle',
            'contact_title' => 'Kontaktieren Sie Elena Sánchez Novo',
            'contact_lead' => 'Klären Sie offene Fragen vor Ihrem Termin oder besuchen Sie uns in der Clínica SurgEOM in Madrid.',
            'contact_form_title' => 'Nachricht senden',
            'contact_name' => 'Vollständiger Name',
            'contact_email' => 'E-Mail-Adresse',
            'contact_phone' => 'Telefon oder WhatsApp',
            'contact_interest' => 'Woran sind Sie interessiert?',
            'contact_message' => 'Beschreiben Sie kurz Ihre Situation oder Ziele',
            'contact_send' => 'Nachricht absenden',
            'contact_privacy_note' => 'Ihre Daten sind streng vertraulich und werden ausschließlich zur Beantwortung Ihrer Anfrage genutzt.',

            // Booking
            'booking_page_title' => 'Offizielle Terminbuchung',
            'booking_kicker' => 'Offizieller Kalender bei Doctoralia',
            'booking_title' => 'Wählen Sie Datum und Uhrzeit für Ihren Termin',
            'booking_lead' => 'Buchen Sie direkt Ihren Vor-Ort-Termin in Madrid oder eine Videosprechstunde über das offizielle Doctoralia-System.'
        ]
    ];
}

/**
 * Obtener texto traducido por clave
 */
function t(string $key, ?string $fallback = null): string {
    $lang = current_lang();
    $all = translations();
    
    if (isset($all[$lang][$key])) {
        return $all[$lang][$key];
    }
    if (isset($all['es'][$key])) {
        return $all['es'][$key];
    }
    return $fallback ?? $key;
}

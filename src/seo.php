<?php
/**
 * SEO técnico: URLs canónicas, hreflang, Open Graph y JSON-LD (schema.org).
 */

function seo_pages(): array {
    // script => [prioridad, changefreq, indexable]
    return [
        'index.php'                 => [1.0, 'weekly',  true],
        'servicios.php'             => [0.9, 'monthly', true],
        'quienes-somos.php'         => [0.8, 'monthly', true],
        'dudas.php'                 => [0.8, 'monthly', true],
        'reserva-de-citas.php'      => [0.7, 'monthly', true],
        'contacto.php'              => [0.7, 'yearly',  true],
        'aviso-legal.php'           => [0.2, 'yearly',  true],
        'politica-de-privacidad.php'=> [0.2, 'yearly',  true],
        'politica-de-cookies.php'   => [0.2, 'yearly',  true],
    ];
}

/** URL absoluta de una página en un idioma. Español = sin parámetro; la home es la raíz. */
function seo_url(string $script, string $lang = 'es'): string {
    $path = $script === 'index.php' ? '/' : '/' . $script;
    return rtrim(SITE_CANONICAL, '/') . $path . ($lang === 'es' ? '' : '?lang=' . $lang);
}

function seo_og_locale(string $lang): string {
    return ['es' => 'es_ES', 'en' => 'en_GB', 'de' => 'de_DE'][$lang] ?? 'es_ES';
}

/** Script actual validado contra la lista blanca (evita inyección por SCRIPT_NAME). */
function seo_current_script(): string {
    $s = basename($_SERVER['SCRIPT_NAME'] ?? 'index.php');
    return isset(seo_pages()[$s]) ? $s : 'index.php';
}

function seo_hreflang_links(string $script): string {
    $out = '';
    foreach (array_keys(supported_languages()) as $l) {
        $out .= '<link rel="alternate" hreflang="' . $l . '" href="' . e(seo_url($script, $l)) . '">' . "\n    ";
    }
    $out .= '<link rel="alternate" hreflang="x-default" href="' . e(seo_url($script, 'es')) . '">';
    return $out;
}

/** Grafo JSON-LD. $faqs = lista de [pregunta, respuesta] (solo en dudas.php). */
function seo_jsonld(string $script, string $lang, array $faqs = [], array $reviews = []): array {
    $base = rtrim(SITE_CANONICAL, '/');
    $sameAs = [SITE_INSTAGRAM_URL, BOOKING_URL];

    $person = [
        '@type' => 'Person',
        '@id' => "$base/#elena",
        'name' => SITE_OWNER,
        'url' => seo_url('quienes-somos.php', $lang),
        'image' => $base . '/assets/img/elena-2.jpeg',
        'jobTitle' => ['es' => 'Dietista-Nutricionista', 'en' => 'Registered Dietitian-Nutritionist', 'de' => 'Diätassistentin & Ernährungsberaterin'][$lang] ?? 'Dietista-Nutricionista',
        'identifier' => ['@type' => 'PropertyValue', 'name' => 'Nº de colegiada CODINMA', 'propertyID' => 'CODINMA', 'value' => SITE_COLLEGIATE_NUMBER],
        'alumniOf' => [
            ['@type' => 'CollegeOrUniversity', 'name' => 'Universidad de Alcalá'],
            ['@type' => 'CollegeOrUniversity', 'name' => 'Universidad Rey Juan Carlos'],
        ],
        'hasCredential' => [
            ['@type' => 'EducationalOccupationalCredential', 'name' => 'Grado en Nutrición Humana y Dietética', 'credentialCategory' => 'degree'],
            ['@type' => 'EducationalOccupationalCredential', 'name' => 'Grado en Ciencias de la Actividad Física y del Deporte (CAFyD)', 'credentialCategory' => 'degree'],
            ['@type' => 'EducationalOccupationalCredential', 'name' => 'Colegiada CODINMA nº ' . SITE_COLLEGIATE_NUMBER, 'credentialCategory' => 'license', 'recognizedBy' => ['@type' => 'Organization', 'name' => 'Colegio Profesional de Dietistas-Nutricionistas de Madrid (CODINMA)']],
            ['@type' => 'EducationalOccupationalCredential', 'name' => 'Antropometrista ISAK', 'credentialCategory' => 'certification', 'recognizedBy' => ['@type' => 'Organization', 'name' => 'International Society for the Advancement of Kinanthropometry (ISAK)']],
        ],
        'knowsAbout' => ['SIBO', 'Disbiosis intestinal', 'Síndrome del intestino irritable', 'Síndrome de ovario poliquístico', 'Resistencia a la insulina', 'Amenorrea hipotalámica', 'Composición corporal', 'Nutrición deportiva', 'Entrenamiento de fuerza'],
        'worksFor' => ['@id' => "$base/#clinica"],
        'sameAs' => $sameAs,
    ];

    $business = [
        // schema.org no define "Dietitian": MedicalBusiness + medicalSpecialty DietNutrition es la combinación válida.
        '@type' => ['MedicalBusiness', 'LocalBusiness'],
        '@id' => "$base/#clinica",
        'name' => SITE_NAME . ' · ' . SITE_OWNER,
        'alternateName' => 'Método ESN Nutrición',
        'description' => 'Consulta de nutrición clínica y deportiva en Madrid (Barrio de Salamanca) y online: salud digestiva, SIBO, salud hormonal femenina y entrenamiento de fuerza individualizado.',
        'url' => $base . '/',
        'logo' => $base . '/assets/img/logo.png',
        'image' => [$base . SITE_OG_IMAGE, $base . '/assets/img/clinica.jpeg'],
        'telephone' => SITE_PHONE_LINK,
        'email' => SITE_EMAIL,
        'priceRange' => '€€',
        'medicalSpecialty' => 'https://schema.org/DietNutrition',
        'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'Calle de Coslada, 16', 'addressLocality' => 'Madrid', 'addressRegion' => 'Comunidad de Madrid', 'postalCode' => '28028', 'addressCountry' => 'ES'],
        'geo' => ['@type' => 'GeoCoordinates', 'latitude' => SITE_GEO_LAT, 'longitude' => SITE_GEO_LNG],
        'hasMap' => SITE_MAPS_URL,
        'areaServed' => [['@type' => 'City', 'name' => 'Madrid'], ['@type' => 'Country', 'name' => 'España']],
        'availableLanguage' => ['es', 'en', 'de'],
        'openingHoursSpecification' => [[
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'opens' => '16:00', 'closes' => '21:00',
        ]],
        'location' => [
            '@type' => ['MedicalClinic', 'Place'],
            'name' => 'Clínica SurgEOM',
            'description' => 'Clínica médico-quirúrgica y dermatológica',
            'address' => ['@type' => 'PostalAddress', 'streetAddress' => 'Calle de Coslada, 16', 'addressLocality' => 'Madrid', 'postalCode' => '28028', 'addressCountry' => 'ES'],
            'geo' => ['@type' => 'GeoCoordinates', 'latitude' => SITE_GEO_LAT, 'longitude' => SITE_GEO_LNG],
        ],
        'founder' => ['@id' => "$base/#elena"],
        'employee' => ['@id' => "$base/#elena"],
        'potentialAction' => ['@type' => 'ReserveAction', 'target' => ['@type' => 'EntryPoint', 'urlTemplate' => BOOKING_URL, 'actionPlatform' => ['http://schema.org/DesktopWebPlatform', 'http://schema.org/MobileWebPlatform']], 'result' => ['@type' => 'Reservation', 'name' => 'Cita de nutrición']],
        'makesOffer' => [
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'MedicalTherapy', 'name' => 'Nutrición clínica digestiva (SIBO, disbiosis, colon irritable)']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'MedicalTherapy', 'name' => 'Nutrición para la salud hormonal femenina (SOP, resistencia a la insulina, amenorrea)']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Nutrición deportiva y recomposición corporal']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Entrenamiento de fuerza individualizado']],
            ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Consulta de nutrición online (videoconsulta)']],
        ],
        'sameAs' => $sameAs,
    ];
    // AggregateRating/Review: solo con datos reales y verificables (Doctoralia). Google no muestra estrellas
    // para reseñas "autoservidas" en LocalBusiness; se mantienen por semántica y otros consumidores.
    if (SITE_RATING_COUNT > 0) {
        $business['aggregateRating'] = ['@type' => 'AggregateRating', 'ratingValue' => SITE_RATING_VALUE, 'bestRating' => '5', 'worstRating' => '1', 'ratingCount' => SITE_RATING_COUNT];
    }
    if ($reviews) {
        $business['review'] = array_map(fn($r) => [
            '@type' => 'Review',
            'author' => ['@type' => 'Person', 'name' => $r['autor']],
            'reviewRating' => ['@type' => 'Rating', 'ratingValue' => (string)($r['estrellas'] ?? 5), 'bestRating' => '5'],
            'reviewBody' => $r['cita'],
            'publisher' => ['@type' => 'Organization', 'name' => 'Doctoralia'],
        ], $reviews);
    }

    $graph = [
        ['@type' => 'WebSite', '@id' => "$base/#website", 'url' => $base . '/', 'name' => SITE_NAME, 'inLanguage' => $lang, 'publisher' => ['@id' => "$base/#clinica"]],
        $business,
        $person,
    ];

    if ($script !== 'index.php') {
        $graph[] = ['@type' => 'BreadcrumbList', 'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => SITE_NAME, 'item' => seo_url('index.php', $lang)],
            ['@type' => 'ListItem', 'position' => 2, 'name' => $GLOBALS['pageTitle'] ?? $script, 'item' => seo_url($script, $lang)],
        ]];
    }
    if ($script === 'dudas.php' && $faqs) {
        $graph[] = [
            '@type' => 'FAQPage',
            '@id' => seo_url('dudas.php', $lang) . '#faq',
            'inLanguage' => $lang,
            'mainEntity' => array_map(fn($f) => [
                '@type' => 'Question', 'name' => $f[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]],
            ], $faqs),
        ];
    }
    return ['@context' => 'https://schema.org', '@graph' => $graph];
}

/** Serializa JSON-LD de forma segura dentro de <script> (escapa </script> y U+2028). */
function seo_jsonld_tag(array $data): string {
    $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_PRETTY_PRINT);
    return '<script type="application/ld+json" nonce="' . e(csp_nonce()) . '">' . $json . '</script>';
}

/** Carga FAQs y reseñas del idioma activo sin contaminar el ámbito global. */
function seo_content_for_lang(): array {
    return (function () {
        $currentLang = current_lang();
        require __DIR__ . '/content.php';
        $all = $testimonios_all[$currentLang] ?? $testimonios_all['es'];
        // Solo reseñas procedentes de Doctoralia (el publisher declarado en el JSON-LD)
        $doctoralia = array_values(array_filter($all, fn($t) => stripos($t['origen'] ?? '', 'Doctoralia') !== false));
        return [$faqs, array_slice($doctoralia, 0, 3)];
    })();
}

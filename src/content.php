<?php
// Contenido de la web (Método ESN — Elena Sánchez Novo) con soporte multilingüe (ES, EN, DE)

$currentLang = current_lang();

// 1. PRINCIPIOS DEL MÉTODO
$principios_all = [
    'es' => [
        ["Un método integral basado en ciencia",
         "Cada plan se construye sobre principios respaldados por la evidencia científica y una visión global de la salud. Entrenamiento, nutrición, descanso y hábitos trabajan de forma conjunta para crear cambios sostenibles, adaptados a tus necesidades y orientados a resultados duraderos."],
        ["Planes totalmente personalizados",
         "No existen dos personas iguales, por eso cada plan se diseña de forma individualizada. A partir de una evaluación completa, se adapta el entrenamiento, la alimentación y los hábitos a tus necesidades, objetivos y estilo de vida, creando un proceso realista, sostenible y pensado para funcionar a largo plazo."],
        ["Acompañamiento continuo y real",
         "No caminarás solo durante el proceso. El Método ESN se basa en un acompañamiento cercano y continuo que te ofrece apoyo, claridad y confianza en cada etapa. El plan evoluciona contigo, adaptándose a tus necesidades, circunstancias y progresos para que cada paso resulte realista, sostenible y alineado con tus objetivos."],
        ["Un proceso que enseña y transforma",
         "Más allá de alcanzar un objetivo concreto, el Método ESN busca que aprendas a entender tu cuerpo, tus hábitos y tus necesidades. Cada paso tiene un propósito y se acompaña de la información necesaria para que ganes confianza, autonomía y seguridad en tus decisiones. Porque la verdadera transformación no consiste solo en cambiar durante unas semanas, sino en desarrollar herramientas que te acompañen toda la vida."],
        ["Resultados sostenibles, no temporales",
         "El Método ESN apuesta por cambios que puedan mantenerse en el tiempo. En lugar de recurrir a restricciones, exigencias poco realistas o resultados rápidos, el proceso se centra en construir hábitos que se adapten a tu vida y te permitan avanzar de forma constante. Porque el verdadero éxito no está en lo que consigues durante unas semanas, sino en aquello que eres capaz de mantener y disfrutar a largo plazo."]
    ],
    'en' => [
        ["Science-backed integrative method",
         "Every plan is grounded in scientific evidence and a 360° perspective of human health. Exercise, clinical nutrition, restorative sleep, and lifestyle habits synchronize to produce lasting, measurable transformation tailored to your physiology."],
        ["100% individualized strategies",
         "No two metabolic profiles or daily lives are identical. Following an in-depth clinical evaluation, we craft your training, nutrition, and daily routines around your individual preferences, work schedule, and long-term health goals."],
        ["Continuous, real-time guidance",
         "You will never feel alone on your journey. The ESN Method emphasizes empathetic, continuous clinical support that offers prompt clarity and confidence at every step. Your plan continuously evolves alongside your progress and challenges."],
        ["Empowerment through education",
         "Beyond reaching a specific number on the scale, the goal is for you to truly understand your body, metabolism, and nutritional needs. Every recommendation has clear reasoning so you gain lifelong autonomy, food freedom, and confidence."],
        ["Sustainable, lifelong outcomes",
         "We firmly avoid extreme restriction, unrealistic crash diets, and temporary fixes. We build consistent habits that integrate into your real life so your results become a permanent lifestyle you genuinely enjoy."]
    ],
    'de' => [
        ["Wissenschaftlich fundierte ganzheitliche Methode",
         "Jeder Plan basiert auf wissenschaftlicher Evidenz und einem ganzheitlichen Gesundheitsverständnis. Training, klinische Ernährung, Regeneration und Lebensgewohnheiten greifen ineinander, um nachhaltige, messbare Resultate zu erzielen."],
        ["Vollständig individualisierte Pläne",
         "Keine zwei Menschen sind identisch. Nach einer ausführlichen Erstanamnese werden Ernährung, Training und Tagesroutine exakt auf Ihre biologischen Bedürfnisse, Ihren Berufsalltag und Ihre langfristigen Ziele abgestimmt."],
        ["Kontinuierliche & persönliche Begleitung",
         "Sie sind auf Ihrem Weg nie allein. Die ESN-Methode setzt auf engmaschige, einfühlsame Betreuung, die Ihnen in jeder Phase Sicherheit und Klarheit gibt. Ihr Plan passt sich flexibel an unvorhergesehene Alltagssituationen an."],
        ["Wissen vermitteln & Autonomie stärken",
         "Über das reine Ziel hinaus lernen Sie, Ihren Körper, Ihren Stoffwechsel und Ihre Signale zu verstehen. Jede Empfehlung wird verständlich begründet, damit Sie nachhaltige Selbstsicherheit und langfristige Entscheidungsfreiheit gewinnen."],
        ["Dauerhafte Resultate statt Jo-Jo-Effekt",
         "Wir verzichten konsequent auf extreme Verbote, unrealistische Vorgaben und temporäre Blitzdiäten. Im Fokus steht der Aufbau gesunder Gewohnheiten, die Sie dauerhaft und mit Freude im Alltag leben können."]
    ]
];
$principios = $principios_all[$currentLang] ?? $principios_all['es'];

// 2. PASOS DEL ROADMAP
$pasos_all = [
    'es' => [
        ["Valoración inicial", "Analizamos tu situación actual, hábitos, necesidades y objetivos mediante tecnología especializada, para comprender exactamente qué necesitas."],
        ["Diseño del plan", "Creamos una estrategia personalizada adaptada a tu estilo de vida, disponibilidad y punto de partida."],
        ["Seguimiento continuo", "Realizamos ajustes, resolvemos dudas y te acompañamos durante todo el proceso."],
        ["Consolidación de hábitos", "Construimos cambios sostenibles que puedas mantener a largo plazo."]
    ],
    'en' => [
        ["Initial Clinical Assessment", "We analyze your health biomarkers, nutritional history, lifestyle, and fitness level to uncover your precise metabolic baseline."],
        ["Personalized Strategy", "We design your bespoke nutrition and training protocol tailored to your schedule, preferences, and personal goals."],
        ["Ongoing Guidance", "Continuous bi-weekly reviews, flexible adjustments, and instant feedback to navigate real-life situations effortlessly."],
        ["Habit Consolidation", "Anchoring your results into sustainable, effortless daily habits that you can maintain effortlessly for life."]
    ],
    'de' => [
        ["Initiale klinische Anamnese", "Detaillierte Analyse Ihres aktuellen Gesundheitszustands, Ihrer Ernährungsgewohnheiten, Körperzusammensetzung und individuellen Ziele."],
        ["Individuelle Planerstellung", "Entwicklung einer maßgeschneiderten Ernährungs- und Trainingsstrategie, abgestimmt auf Ihren Alltag und Ihr Zeitbudget."],
        ["Kontinuierliche Feinjustierung", "Regelmäßige Überprüfung, Klärung aller Fragen und proaktive Anpassungen bei neuen Alltagsanforderungen."],
        ["Festigung neuer Gewohnheiten", "Verankerung der Routinen für dauerhafte Ergebnisse, die Sie eigenständig und lebenslang beibehalten."]
    ]
];
$pasos = $pasos_all[$currentLang] ?? $pasos_all['es'];

// 3. TESTIMONIOS VERIFICADOS
$testimonios_all = [
    'es' => [
        [
            "cita"      => "Estoy muy contenta con Elena. Para mí era muy frustrante gestionar mi relación con la comida, he pasado por varios embarazos y este último posparto está siendo muy diferente al resto gracias a ella. Es un amor y tiene muchísima paciencia, además de que no deja que te vayas con dudas y explica cosas que antes no me habían contado. La recomiendo al 100%.",
            "autor"     => "C.S.M.",
            "origen"    => "Paciente verificada en Doctoralia",
            "tema"      => "Nutrición en posparto y salud",
            "estrellas" => 5
        ],
        [
            "cita"      => "Llegué llena de miedos y dudas, y salí llena de seguridad, tranquilidad y bienestar. Su profesionalidad es espectacular y tiene una gran capacidad de adaptación a las necesidades de cada paciente. No fue una consulta normal, fue con una persona que no te juzga y ayuda a encontrar la mejor solución. Su seguridad al hablar engancha.",
            "autor"     => "Laura MG",
            "origen"    => "Paciente verificada en Doctoralia",
            "tema"      => "Seguridad y bienestar",
            "estrellas" => 5
        ],
        [
            "cita"      => "Muchas gracias por todo Elena, eres tú con tu dedicación incondicional la que va mejorándolo todo. Es increíble cómo he mejorado: gracias a ti me han quitado la CPAP. No existen palabras suficientes para expresar todo lo que tengo que agradecerte, eres lo mejor que me ha pasado.",
            "autor"     => "María S.",
            "origen"    => "Paciente del Método ESN",
            "tema"      => "Salud respiratoria y cambio vital",
            "estrellas" => 5
        ],
        [
            "cita"      => "Es una gran profesional. Mi caso es un poco particular por alergias e intolerancias y aun así todo ha sido muy bien estructurado, variado y adaptado. Explicaciones claras y una implicación de 10 en cada revisión.",
            "autor"     => "Andrés",
            "origen"    => "Paciente verificado en Doctoralia",
            "tema"      => "Alergias e intolerancias digestivas",
            "estrellas" => 5
        ],
        [
            "cita"      => "Siento que mi cuerpo vuelve a funcionar bien y estar sano después de 11 años. Gracias a ti he conseguido la motivación suficiente para comer más y mejor, machacarme menos y disfrutar del deporte… Y sobre todo, reconectar con mis hormonas y mi salud.",
            "autor"     => "Macarena L.",
            "origen"    => "Paciente del Método ESN",
            "tema"      => "Salud hormonal y reconexión",
            "estrellas" => 5
        ],
        [
            "cita"      => "Elena es una gran profesional. Dedica el tiempo necesario para que el paciente comprenda la importancia de adoptar hábitos saludables y te anima de verdad a conseguirlo. Sin duda, la mejor decisión fue ponerme en sus manos.",
            "autor"     => "Asunción D.",
            "origen"    => "Paciente verificada en Doctoralia",
            "tema"      => "Hábitos duraderos y salud",
            "estrellas" => 5
        ]
    ],
    'en' => [
        [
            "cita"      => "I am thrilled with Elena. Managing my relationship with food used to be overwhelming. Having gone through multiple pregnancies, this postpartum has been wonderfully different thanks to her. She is incredibly patient, ensures zero lingering doubts, and explains everything with utmost clarity. Highly recommended!",
            "autor"     => "C.S.M.",
            "origen"    => "Verified patient on Doctoralia",
            "tema"      => "Postpartum nutrition & health",
            "estrellas" => 5
        ],
        [
            "cita"      => "I arrived full of fear and came out with confidence, serenity, and renewed energy. Her professionalism is outstanding, and she adapts flawlessly to every patient's constraints. She never judges and always guides you toward solutions that fit real life.",
            "autor"     => "Laura MG",
            "origen"    => "Verified patient on Doctoralia",
            "tema"      => "Confidence & vitality",
            "estrellas" => 5
        ],
        [
            "cita"      => "Thank you for everything, Elena. Your dedication made all the difference. My overall clinical markers improved so much that my CPAP machine was discontinued. Words cannot express how thankful I am.",
            "autor"     => "María S.",
            "origen"    => "ESN Method Patient",
            "tema"      => "Respiratory health & life change",
            "estrellas" => 5
        ],
        [
            "cita"      => "An exceptional practitioner. Given my complex food allergies and intolerances, everything was structured, varied, and perfectly adapted. Crystal-clear guidance and 10/10 commitment in every check-in.",
            "autor"     => "Andrés",
            "origen"    => "Verified patient on Doctoralia",
            "tema"      => "Digestive health & food sensitivities",
            "estrellas" => 5
        ],
        [
            "cita"      => "My body feels healthy and functional again for the first time in 11 years. Elena gave me the tools to eat better, exercise smarter, and rebalance my hormones without exhaustion.",
            "autor"     => "Macarena L.",
            "origen"    => "ESN Method Patient",
            "tema"      => "Hormonal balance & wellness",
            "estrellas" => 5
        ],
        [
            "cita"      => "Elena takes the time to help you truly grasp healthy habits and empowers you throughout the entire process. Without hesitation, booking with her was the best health decision I have made.",
            "autor"     => "Asunción D.",
            "origen"    => "Verified patient on Doctoralia",
            "tema"      => "Long-lasting habits & nutrition",
            "estrellas" => 5
        ]
    ],
    'de' => [
        [
            "cita"      => "Ich bin überglücklich mit Elena. Früher war mein Verhältnis zum Essen sehr belastend. Nach mehreren Schwangerschaften verläuft diese Phase dank ihr vollkommen positiv. Sie ist unglaublich geduldig, nimmt sich Zeit und erklärt alles verständlich. 100% empfehlenswert!",
            "autor"     => "C.S.M.",
            "origen"    => "Verifizierte Patientin auf Doctoralia",
            "tema"      => "Postnatale Ernährung & Gesundheit",
            "estrellas" => 5
        ],
        [
            "cita"      => "Ich kam voller Zweifel und ging mit großer Sicherheit, innerer Ruhe und Motivation. Ihre fachliche Kompetenz ist beeindruckend. Sie verurteilt niemals, sondern sucht lösungsorientiert nach Wegen, die im Alltag funktionieren.",
            "autor"     => "Laura MG",
            "origen"    => "Verifizierte Patientin auf Doctoralia",
            "tema"      => "Selbstvertrauen & Wohlbefinden",
            "estrellas" => 5
        ],
        [
            "cita"      => "Vielen Dank für Ihren Einsatz, Elena. Meine Gesundheit hat sich so stark verbessert, dass ich mein CPAP-Atemgerät absetzen konnte. Worte reichen kaum aus, um meine Dankbarkeit auszudrücken.",
            "autor"     => "María S.",
            "origen"    => "ESN-Patientin",
            "tema"      => "Atemgesundheit & Lebensqualität",
            "estrellas" => 5
        ],
        [
            "cita"      => "Eine herausragende Therapeutin. Trotz meiner komplexen Nahrungsmittelallergien war der Ernährungsplan abwechslungsreich und perfekt abgestimmt. Klare Erklärungen und volle Hingabe bei jeder Kontrolle.",
            "autor"     => "Andrés",
            "origen"    => "Verifizierter Patient auf Doctoralia",
            "tema"      => "Allergien & Magen-Darm-Gesundheit",
            "estrellas" => 5
        ],
        [
            "cita"      => "Nach 11 Jahren fühlt sich mein Körper endlich wieder gesund und leistungsfähig an. Elena hat mir geholfen, meine Hormone und meine Ernährung ohne quälenden Verzicht in Einklang zu bringen.",
            "autor"     => "Macarena L.",
            "origen"    => "ESN-Patientin",
            "tema"      => "Hormonelle Balance & Vitalität",
            "estrellas" => 5
        ],
        [
            "cita"      => "Elena nimmt sich Zeit, damit man die Zusammenhänge versteht, und motiviert auf Augenhöhe. Sich in ihre Hände zu begeben, war zweifellos die beste Entscheidung für meine Gesundheit.",
            "autor"     => "Asunción D.",
            "origen"    => "Verifizierte Patientin auf Doctoralia",
            "tema"      => "Nachhaltige Gewohnheiten",
            "estrellas" => 5
        ]
    ]
];
$testimonios = $testimonios_all[$currentLang] ?? $testimonios_all['es'];

// Estadísticas de reputación clínica
$statsReputacion = [
    "puntuacion"  => "5.0",
    "opiniones"   => "50+",
    "fuente"      => "Doctoralia",
    "url"         => "https://www.doctoralia.es/elena-sanchez-novo/dietista-nutricionista/madrid",
    "satisfaccion"=> "100%"
];

// 4. FORMACIÓN ACADÉMICA
$formacion_all = [
    'es' => [
        "Grado en Nutrición Humana y Dietética (Universidad de Alcalá, 2024). Colegiada Nº MAD01639 (CODINMA).",
        "Grado en Ciencias de la Actividad Física y del Deporte - CAFyD (Universidad Rey Juan Carlos, 2024).",
        "Grado en Educación Primaria con mención en EF y PT (Universidad Rey Juan Carlos, 2024).",
        "Máster en Educación Física (Universidad Internacional de Valencia, 2025).",
        "Trayectoria y experiencia profesional clínica y deportiva: Método ESN (Dublín & Madrid).",
        "Especialización en recomposición corporal, salud hormonal de la mujer, patología digestiva y nutrición deportiva."
    ],
    'en' => [
        "BSc in Human Nutrition and Dietetics (University of Alcalá, 2024). Registered Dietitian Lic. No. MAD01639 (CODINMA).",
        "BSc in Physical Activity and Sport Sciences - CAFyD (Rey Juan Carlos University, 2024).",
        "BSc in Primary Education specializing in Physical Education (Rey Juan Carlos University, 2024).",
        "Master's Degree in Physical Education (International University of Valencia, 2025).",
        "Clinical & sports counseling practice: ESN Method (Dublin & Madrid).",
        "Clinical expertise: Body recomposition, female hormonal health, gastrointestinal care, and sports nutrition."
    ],
    'de' => [
        "Bachelor in Humanernährung und Diätetik (Universität Alcalá, 2024). Registrierte Diätassistentin Reg.-Nr. MAD01639 (CODINMA).",
        "Bachelor in Sport- und Bewegungswissenschaften - CAFyD (Universität Rey Juan Carlos, 2024).",
        "Bachelor in Primarstufenpädagogik mit Schwerpunkt Sportpädagogik (Universität Rey Juan Carlos, 2024).",
        "Master in Sportpädagogik & Bewegungswissenschaften (Internationale Universität Valencia, 2025).",
        "Klinische und sportwissenschaftliche Praxis: ESN-Methode (Dublin & Madrid).",
        "Spezialisierung: Körperzusammensetzung, weibliche Hormongesundheit, Magen-Darm-Erkrankungen und Sporternährung."
    ]
];
$formacion = $formacion_all[$currentLang] ?? $formacion_all['es'];

// 5. FAQS OFICIALES
$faqs_all = [
    'es' => [
        ["¿Cómo es la primera consulta?", "La primera sesión comienza con una valoración completa de tu estado de salud, hábitos, alimentación, composición corporal (antropometría), antecedentes y objetivos. A partir de esa información elaboro un plan de nutrición y/o entrenamiento totalmente personalizado y adaptado a ti."],
        ["¿Tengo que seguir una dieta estricta o pasar hambre?", "No. En Método ESN no creemos en dietas restrictivas ni en prohibiciones absurdas. Cuidar la alimentación no consiste en seguir una dieta perfecta, sino en encontrar una forma de comer que se adapte a ti, a tu estilo de vida y a tus objetivos, basada en evidencia científica."],
        ["Engordo con facilidad o me cuesta bajar peso aunque coma bajo en calorías, ¿por qué?", "No se trata simplemente de comer menos o eliminar alimentos como harinas, sino de analizar tu nutrición en conjunto, tus hábitos, gasto calórico, masa muscular, descanso, perfil hormonal y estrés. Diseñamos un plan individualizado y realista para restablecer tu metabolismo."],
        ["¿Existen suplementos o productos milagro para perder peso?", "Ningún suplemento por sí solo produce una pérdida de grasa real. Es fundamental no centrar el proceso en un producto milagroso: valoramos tu alimentación completa, el entrenamiento de fuerza y tus analíticas para resultados sostenibles a largo plazo."],
        ["¿Necesito apuntarme obligatoriamente a un gimnasio?", "No necesariamente. Adaptamos tu plan de entrenamiento al material y entorno del que dispongas: gimnasio completo, entrenamiento en casa o al aire libre."],
        ["¿Puedo hacer solo nutrición o solo entrenamiento?", "El Método ESN está diseñado como un proceso integrador porque la salud óptima requiere ambos pilares. No obstante, adaptaremos el enfoque a tus necesidades específicas y tu momento vital."],
        ["¿Cuánto tardaré en notar resultados?", "Desde las primeras semanas notarás mejoras claras en tus digestiones, energía y descanso. Los cambios corporales y analíticos se consolidan de manera progresiva y duradera, sin efecto rebote."],
        ["¿Podré resolver dudas entre revisiones?", "Por supuesto. El acompañamiento continuo es la base del método. Resuelvo tus dudas y ajustamos las pautas según los imprevistos de tu día a día."],
        ["¿Las consultas pueden ser online o deben ser presenciales?", "Ambas modalidades están disponibles. Ofrecemos consulta presencial en clínica (Madrid) y videoconsulta 100% online con el mismo nivel de personalización y seguimiento."],
        ["¿Qué ocurre si tengo una patología digestiva, hormonal o lesión?", "Cada proceso arranca con valoración individualizada. Si tienes SOP, resistencia a la insulina, colon irritable, inflamación digestiva, intolerancias o lesiones previas, el plan se adapta específicamente bajo criterio clínico."],
        ["¿Necesito tener experiencia previa entrenando?", "No. Trabajamos desde personas que empiezan de cero hasta deportistas que buscan optimizar su rendimiento y composición corporal."],
        ["¿Y si nunca antes he sido capaz de mantener un cambio?", "Precisamente por eso trabajamos como un equipo. No buscamos que dependas de un menú durante unas semanas, sino darte las herramientas y el conocimiento necesarios para que tomes decisiones con confianza toda la vida."]
    ],
    'en' => [
        ["What does the initial consultation involve?", "We start with a comprehensive assessment of your medical history, eating habits, body composition (anthropometrics), lifestyle, and health goals to build a bespoke clinical nutrition and training protocol."],
        ["Will I have to follow a restrictive diet or be hungry?", "No. At ESN Method, we do not believe in starvation diets or irrational food bans. Sustainable health is about finding a way of eating that fits your life and metabolism, backed by scientific evidence."],
        ["I struggle to lose weight even on low calories. Why?", "Weight regulation is far more complex than just eating less. We assess your endocrine health, muscle mass, sleep quality, stress levels, and gut microbiome to create a realistic protocol that repairs metabolic balance."],
        ["Are there miracle supplements for weight loss?", "No single supplement produces fat loss on its own. We focus on evidence-based whole nutrition, progressive strength training, and biological recovery rather than gimmicks."],
        ["Do I need a gym membership?", "Not necessarily. We adapt your training routine to your preferred setting: full fitness club, home gym equipment, or outdoor bodyweight routines."],
        ["Can I book only nutrition or only training?", "While an integrated synergy produces the most effective results, we can adapt your program to focus on nutrition or training according to your personal circumstances."],
        ["How soon will I notice visible progress?", "Within the initial weeks, you will notice significant improvements in digestive comfort, daily energy, and sleep. Body composition changes follow steadily without rebound weight gain."],
        ["Can I ask questions between follow-up visits?", "Absolutely. Continuous follow-up is central to the ESN Method. You have direct communication to navigate dinners, trips, or unforeseen schedules."],
        ["Are sessions available online or in-person?", "Both. We provide in-person clinical consultations in Madrid (Clínica SurgEOM) and 100% online video consultations internationally."],
        ["What if I have digestive disorders, PCOS, or past injuries?", "Every protocol is personalized under strict clinical criteria for gastrointestinal issues (IBS, SIBO, food intolerances), hormonal conditions (PCOS, thyroid), or musculoskeletal rehabilitation."],
        ["Do I need prior gym or fitness experience?", "No. We guide complete beginners starting from scratch as well as athletes looking to optimize peak performance."],
        ["What if I have failed with diets in the past?", "That is precisely why we work together as a dedicated team. Our goal is to educate and empower you with lifelong nutritional independence."]
    ],
    'de' => [
        ["Wie läuft das Erstgespräch ab?", "Das Erstgespräch beinhaltet eine umfassende Anamnese Ihres Gesundheitszustands, Ihrer Ernährungsgewohnheiten, Körperzusammensetzung (Anthropometrie) und Ziele, um einen maßgeschneiderten Plan zu erstellen."],
        ["Muss ich eine strikte Diät halten oder hungern?", "Nein. Bei der ESN-Methode glauben wir nicht an quälenden Verzicht oder Verhungern. Ziel ist eine Ernährungsweise, die wissenschaftlich fundiert ist und zu Ihrem Lebensstil passt."],
        ["Warum nehme ich trotz niedriger Kalorien kaum ab?", "Körpergewicht hängt nicht nur von Kalorien ab. Wir analysieren Muskelmasse, Schilddrüsenwerte, Schlaf, Stresspegel und Darmgesundheit, um Ihren Stoffwechsel nachhaltig zu regenerieren."],
        ["Gibt es Wundermittel oder Fettverbrennungs-Präparate?", "Kein Nahrungsergänzungsmittel führt isoliert zu Fettabbau. Wir setzen auf echte Nährstoffdichte, Krafttraining und Regeneration statt auf kurzlebige Wundermittel."],
        ["Ist eine Mitgliedschaft im Fitnessstudio zwingend?", "Nein. Wir stimmen Ihr Training exakt auf Ihr Equipment ab – egal ob Fitnessstudio, Home-Workouts oder Training im Freien."],
        ["Kann ich nur Ernährung oder nur Training buchen?", "Die Kombination beider Säulen erzielt optimale Ergebnisse, wir können den Schwerpunkt jedoch ganz nach Ihren Bedürfnissen anpassen."],
        ["Wann sind erste Veränderungen spürbar?", "Bereits in den ersten Wochen verbessern sich Verdauung, Energielevel und Schlafqualität spürbar. Körperliche Veränderungen folgen kontinuierlich ohne Jo-Jo-Effekt."],
        ["Kann ich zwischen den Kontrollterminen Fragen stellen?", "Selbstverständlich. Eine engmaschige Begleitung ist der Kern unserer Methode. Wir passen Ihren Plan flexibel an Alltag und Reisen an."],
        ["Finden die Termine vor Ort oder online statt?", "Beides ist möglich: Persönliche Beratung in unserer Partnerklinik SurgEOM in Madrid oder flexible Online-Sprechstunden per Videoanruf."],
        ["Was passiert bei Magen-Darm-Problemen, PCOS oder Verletzungen?", "Jeder Plan wird unter Berücksichtigung medizinischer Befunde wie Reizdarm, SIBO, PCOS, Schilddrüsenunterfunktion oder Gelenkbeschwerden individuell erstellt."],
        ["Brauche ich Vorerfahrung im Krafttraining?", "Nein. Wir begleiten sowohl absolute Einsteiger als auch erfahrene Sportler, die ihre Leistung maximieren möchten."],
        ["Was ist, wenn bisherige Diäten immer gescheitert sind?", "Genau deshalb arbeiten wir gemeinsam als Team. Sie erhalten das nötige Wissen und Selbstvertrauen, um langfristig eigenständig gesunde Entscheidungen zu treffen."]
    ]
];
$faqs = $faqs_all[$currentLang] ?? $faqs_all['es'];

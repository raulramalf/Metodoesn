<?php
/**
 * Landings de servicio clínico (solo español). Contenido orientativo y NO sustituye el diagnóstico médico.
 * ⚠ Revisión obligatoria por la titular (YMYL) antes de publicar; actualizar 'reviewed' tras cada revisión.
 */
function landings(): array {
    static $d = null;
    if ($d !== null) return $d;
    $d = [
    'nutricionista-sibo-madrid' => [
        'condition' => 'Sobrecrecimiento bacteriano del intestino delgado (SIBO)',
        'title' => 'Nutricionista especialista en SIBO en Madrid | Método ESN',
        'desc' => 'Dietista-nutricionista colegiada en Madrid y online: abordaje nutricional del SIBO y la disbiosis, coordinado con tu médico. Reserva tu valoración.',
        'kicker' => 'Salud digestiva · SIBO',
        'h1' => 'Nutricionista especialista en SIBO en Madrid',
        'lead' => 'Distensión, gases, digestiones pesadas o cambios en el tránsito que no mejoran: te ayudo a ordenar la alimentación en torno a tu diagnóstico, sin dietas restrictivas eternas.',
        'for_title' => '¿Te reconoces en alguna de estas situaciones?',
        'for' => ['Hinchazón y gases frecuentes, sobre todo tras las comidas.', 'Diagnóstico de SIBO (o sospecha) tras un test de aliento y dudas sobre qué comer.', 'Has probado dietas de eliminación (FODMAP u otras) y no sabes cómo reintroducir alimentos.', 'Recaídas tras el tratamiento médico y miedo a comer casi todo.'],
        'how_title' => 'Cómo trabajamos el SIBO',
        'how' => [['Valoración', 'Historia clínica, síntomas, analíticas y pruebas que ya tengas. Trabajo en coordinación con tu médico o digestivo: no diagnostico ni sustituyo el tratamiento médico.'], ['Plan por fases', 'Pauta nutricional ajustada a tu momento (más estricta solo el tiempo necesario) y reintroducción ordenada de alimentos.'], ['Seguimiento', 'Revisiones para ajustar según tolerancia y evolución, con foco en no empobrecer la dieta ni perder masa muscular.']],
        'faqs' => [['¿Puede la alimentación curar el SIBO?', 'El SIBO requiere diagnóstico y, a menudo, tratamiento médico. La nutrición no lo sustituye: ayuda a manejar síntomas, evitar restricciones innecesarias y prevenir déficits mientras se trata la causa.'], ['¿Tengo que seguir una dieta muy restrictiva?', 'No de forma indefinida. Las fases restrictivas, si se usan, son temporales y se acompañan de un plan de reintroducción para mantener una dieta variada.'], ['¿Necesito un test de aliento antes de la consulta?', 'No es imprescindible para pedir cita, pero si ya lo tienes, tráelo. Si no, te orientaré sobre cuándo conviene consultarlo con tu médico.'], ['¿Puedo hacerlo online?', 'Sí. La videoconsulta funciona igual de bien para el seguimiento; la primera visita puede ser presencial u online.']],
        'related' => ['nutricionista-colon-irritable-madrid', 'consulta-nutricion-online'],
        'reviewed' => '2026-10-15',
    ],
    'nutricionista-colon-irritable-madrid' => [
        'condition' => 'Síndrome del intestino irritable',
        'title' => 'Nutricionista para colon irritable en Madrid | Método ESN',
        'desc' => 'Dietista-nutricionista en Madrid y online para síndrome del intestino irritable: pauta individual, FODMAP bien pautado y seguimiento. Pide cita.',
        'kicker' => 'Salud digestiva · Intestino irritable',
        'h1' => 'Nutricionista para colon irritable (SII) en Madrid',
        'lead' => 'Dolor abdominal, diarrea, estreñimiento o ambos: un plan nutricional individual, con base en guías clínicas y centrado en que vuelvas a comer con tranquilidad.',
        'for_title' => '¿Cuándo puede ayudarte una dietista-nutricionista?',
        'for' => ['Tienes diagnóstico de síndrome del intestino irritable y no sabes qué alimentos te sientan mal.', 'Has hecho una dieta baja en FODMAP por tu cuenta y no sabes si seguir o reintroducir.', 'Evitas planes sociales o viajes por miedo a los síntomas.', 'Tu dieta se ha vuelto muy limitada y te preocupa no cubrir tus necesidades.'],
        'how_title' => 'Cómo lo abordamos',
        'how' => [['Descartar lo importante', 'Si hay señales de alarma (sangre en heces, pérdida de peso no explicada, anemia) te derivo a tu médico antes de seguir.'], ['Estrategia nutricional', 'Hábitos, tipo de fibra, distribución de comidas y, cuando procede, una fase FODMAP acotada con reintroducción guiada.'], ['Seguimiento y autonomía', 'Aprendes a identificar tus desencadenantes para comer con la mayor variedad posible.']],
        'faqs' => [['¿La dieta baja en FODMAP es para siempre?', 'No. Es una herramienta temporal en fases (eliminación, reintroducción y personalización) y es preferible hacerla con supervisión profesional.'], ['¿Debo eliminar el gluten o la lactosa?', 'Solo si hay indicación clínica (celiaquía, intolerancia confirmada). Eliminarlos sin criterio puede enmascarar un diagnóstico y empobrecer la dieta.'], ['¿Qué pasa con el estrés?', 'Influye en los síntomas. Lo abordo en la medida de mi competencia (rutinas, comidas, sueño) y te derivo a otros profesionales si hace falta.'], ['¿Cuántas consultas necesitaré?', 'Depende de cada caso; en la primera valoración te propongo un calendario realista de seguimiento.']],
        'related' => ['nutricionista-sibo-madrid', 'consulta-nutricion-online'],
        'reviewed' => '2026-10-15',
    ],
    'nutricionista-sop-madrid' => [
        'condition' => 'Síndrome de ovario poliquístico y resistencia a la insulina',
        'title' => 'Nutricionista para SOP y resistencia a la insulina | Método ESN',
        'desc' => 'Nutrición y entrenamiento de fuerza para SOP, resistencia a la insulina y salud hormonal femenina en Madrid y online. Dietista colegiada MAD01639.',
        'kicker' => 'Salud hormonal de la mujer',
        'h1' => 'Nutricionista para SOP y resistencia a la insulina en Madrid',
        'lead' => 'Sin dietas extremas: una pauta realista de alimentación y entrenamiento de fuerza, adaptada a tu ciclo, tus analíticas y tu día a día.',
        'for_title' => '¿Es para ti?',
        'for' => ['Tienes SOP diagnosticado o sospecha, ciclos irregulares o acné/vello que te preocupa.', 'Tu médico menciona resistencia a la insulina o glucosa alterada.', 'Te cuesta perder grasa aunque “comas bien” y te sientes cansada tras las comidas.', 'Quieres entrenar fuerza y no sabes cómo combinarlo con tu situación hormonal.'],
        'how_title' => 'Nuestro enfoque',
        'how' => [['Contexto clínico', 'Revisamos tu diagnóstico, analíticas y medicación (siempre bajo el control de tu médico o ginecólogo/a).'], ['Alimentación sostenible', 'Calidad y distribución de hidratos, proteína suficiente y hábitos viables, sin prohibiciones absurdas.'], ['Fuerza y composición corporal', 'Entrenamiento de fuerza individual y seguimiento antropométrico (ISAK) para medir lo que importa más allá de la báscula.']],
        'faqs' => [['¿El SOP se cura con dieta?', 'No se “cura”, pero la alimentación, el ejercicio de fuerza y el descanso mejoran de forma significativa los marcadores metabólicos y los síntomas en muchas mujeres. El tratamiento médico es independiente y necesario cuando está indicado.'], ['¿Tengo que dejar los hidratos de carbono?', 'No. Se ajusta su cantidad, calidad y momento según tu caso; eliminarlos suele ser innecesario y difícil de sostener.'], ['¿Y si no estoy en mi peso pero tengo SOP?', 'El SOP aparece también con peso normal. El plan se centra en composición corporal, analíticas y hábitos, no solo en el peso.'], ['¿Trabajas con amenorrea?', 'Sí, incluida la amenorrea hipotalámica ligada a déficit energético, siempre coordinada con tu médico.']],
        'related' => ['nutricionista-deportivo-madrid', 'consulta-nutricion-online'],
        'reviewed' => '2026-10-15',
    ],
    'nutricionista-deportivo-madrid' => [
        'condition' => 'Nutrición deportiva y rendimiento',
        'title' => 'Nutricionista deportivo presencial en Madrid | Método ESN',
        'desc' => 'Nutrición deportiva de precisión en Madrid: periodización, hidratación, suplementación con evidencia y recomposición corporal. Dietista y CAFyD.',
        'kicker' => 'Nutrición deportiva',
        'h1' => 'Nutricionista deportivo en Madrid (presencial y online)',
        'lead' => 'Doble formación en nutrición y ciencias del deporte: planifico tu alimentación en torno a tus entrenamientos y competiciones, con antropometría ISAK y sin atajos.',
        'for_title' => 'Quién suele consultar',
        'for' => ['Corredores, triatletas, ciclistas o deportistas de fuerza que quieren rendir mejor.', 'Quien busca recomposición corporal: perder grasa sin perder músculo.', 'Deportistas con molestias digestivas durante el entrenamiento o la carrera.', 'Personas que quieren saber si una suplementación les aporta algo real.'],
        'how_title' => 'Cómo trabajamos',
        'how' => [['Valoración y antropometría', 'Composición corporal con técnicas ISAK, historial deportivo, calendario y analíticas.'], ['Periodización nutricional', 'Pauta por fases (carga, competición, recuperación), estrategia intra-entrenamiento y pruebas en entreno antes de competir.'], ['Ajuste continuo', 'Revisión de resultados y sensaciones; suplementos solo si la evidencia y tu caso lo justifican.']],
        'faqs' => [['¿Cuánta proteína necesito si entreno fuerza?', 'Depende de tu objetivo, peso y fase; se individualiza en consulta con rangos respaldados por la evidencia.'], ['¿Son necesarios los suplementos?', 'Rara vez todos. Valoramos cuáles tienen evidencia para tu caso y cuáles son prescindibles.'], ['¿Se puede perder grasa y ganar músculo a la vez?', 'En ciertos perfiles es posible (recomposición); depende de tu punto de partida, entrenamiento y adherencia.'], ['¿Atiendes a deportistas fuera de Madrid?', 'Sí, por videoconsulta con seguimiento de datos de entrenamiento.']],
        'related' => ['nutricionista-sop-madrid', 'consulta-nutricion-online'],
        'reviewed' => '2026-10-15',
    ],
    'consulta-nutricion-online' => [
        'condition' => 'Consulta de nutrición clínica online',
        'title' => 'Consulta de nutrición online con dietista colegiada | Método ESN',
        'desc' => 'Videoconsulta de nutrición clínica y deportiva con dietista-nutricionista colegiada (MAD01639): plan individual y seguimiento desde cualquier lugar.',
        'kicker' => 'Consulta online',
        'h1' => 'Consulta de nutrición online con dietista-nutricionista colegiada',
        'lead' => 'La misma atención clínica que en consulta, por videollamada: ideal si vives fuera de Madrid, viajas o prefieres ahorrar desplazamientos.',
        'for_title' => 'Cuándo encaja la modalidad online',
        'for' => ['Vives fuera de Madrid o en otro país (atiendo en español, inglés y alemán).', 'Tienes una agenda con viajes o turnos cambiantes.', 'Quieres seguimiento frecuente de un plan ya iniciado.', 'Prefieres la comodidad de casa, con mediciones que puedes aportar tú.'],
        'how_title' => 'Cómo funciona',
        'how' => [['Reserva', 'Eliges día y hora en la agenda oficial de Doctoralia y recibes el enlace de la videollamada.'], ['Primera consulta', 'Historia, hábitos, analíticas y objetivos; te pido fotos o medidas sencillas cuando haga falta.'], ['Seguimiento', 'Revisiones periódicas y mensajería para dudas entre sesiones, con ajustes según tu evolución.']],
        'faqs' => [['¿Es tan eficaz como la consulta presencial?', 'Para la mayoría de objetivos nutricionales, sí. Cuando se necesita antropometría ISAK completa, puede combinarse con una visita presencial.'], ['¿Qué necesito para la videoconsulta?', 'Un dispositivo con cámara y conexión estable, y tus analíticas recientes si las tienes.'], ['¿Cómo se paga?', 'La reserva se hace por Doctoralia; las condiciones de pago se detallan al reservar.'], ['¿Atiendes en inglés o alemán?', 'Sí, el sitio y la consulta están disponibles en español, inglés y alemán.']],
        'related' => ['nutricionista-sibo-madrid', 'nutricionista-deportivo-madrid'],
        'reviewed' => '2026-10-15',
    ],
    ];
    return $d;
}

function landing_by_script(string $script): ?array {
    $slug = basename($script, '.php');
    return landings()[$slug] ?? null;
}

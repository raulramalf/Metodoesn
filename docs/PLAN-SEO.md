# Plan SEO técnico y de crecimiento orgánico — Método ESN

> **Transparencia sobre los datos.** Este plan se redactó sin acceso a Search Console, Semrush/Ahrefs ni al SERP en vivo. Los volúmenes son **órdenes de magnitud estimados** (S ≈ <100, M ≈ 100–500, L ≈ 500–2 000 búsquedas/mes en España) y la dificultad es cualitativa: hay que **validarlos** con Keyword Planner/Search Console antes de priorizar contenido. El benchmark describe patrones habituales y públicamente conocidos de esos sitios, no una medición propia. Ninguna promesa de «top 1» es honesta en YMYL: el objetivo es ganar relevancia local, confianza (E-E-A-T) y conversión.

## Ya implementado en el repo (Módulos 2 y 5 parcial)
| Elemento | Archivo |
|---|---|
| Canónica absoluta por idioma (home = `/`) | `includes/head.php`, `src/seo.php` |
| `hreflang` es/en/de/x-default, `og:locale(:alternate)`, Open Graph 1200×630, Twitter Card | `includes/head.php`, `public/assets/img/og-default.jpg` |
| Títulos y descripciones por página e idioma (≤66 / ≤160 car.) | `src/i18n.php` (`seo_*`) |
| JSON-LD: `WebSite`, `MedicalBusiness+LocalBusiness` (+`MedicalClinic` SurgEOM, geo, horario, `ReserveAction`→Doctoralia, `makesOffer`), `Person` (MAD01639, `hasCredential` CODINMA/ISAK, `alumniOf`), `AggregateRating`/`Review`, `BreadcrumbList`, `FAQPage` (solo `dudas.php`) | `src/seo.php` |
| `robots.txt` y `sitemap.xml` multilingüe con `xhtml:link` | `public/robots.txt`, `public/sitemap.php` (+ rewrite en `.htaccess`/nginx) |
| `/index.php` → `/` 301; HTTPS y sin-www 301 | `public/.htaccess` |

**Puntos a verificar antes de publicar**
1. `SITE_GEO_LAT/LNG` en `config/config.php` son **aproximadas** → sustituir por las de Google Maps.
2. `SITE_RATING_COUNT = 50` (la web dice «50+»): usar el recuento real de Doctoralia. Google **no** muestra estrellas para reseñas de negocio propio («self-serving») en `LocalBusiness`; se mantienen por semántica, sin expectativa de rich result. Las `Review` solo incluyen testimonios con origen «Doctoralia».
3. Schema.org **no** tiene tipo `Dietitian` y `Physician` sería engañoso (no es médica): se usa `Person` + `MedicalBusiness` con `medicalSpecialty: DietNutrition`.
4. `FAQPage`: desde 2023 Google solo muestra el desplegable a sitios gubernamentales/sanitarios **de autoridad**; es probable que no aparezca. Es válido y útil para comprensión semántica y asistentes de IA.
5. Idioma por URL: hoy el idioma depende de `?lang=` + cookie. Un rastreador sin cookies ve ES en la URL sin parámetro (correcto), pero una URL «ES» puede servir EN a un usuario con cookie EN. **Medio plazo:** rutas `/en/…` y `/de/…` (o subdirectorios) con idioma determinado solo por la URL.
6. Registrar el sitio en Search Console (propiedad de dominio), enviar `sitemap.xml`, validar JSON-LD con Rich Results Test y comprobar `hreflang` con el informe de segmentación internacional.

---
## MÓDULO 1 — Benchmarking y keywords

### 1.1 Referentes (patrones a imitar)
| Referente | Arquitectura que domina SERP | Página de servicio → cita | Señales E-E-A-T above the fold |
|---|---|---|---|
| **Cleveland Clinic** (Nutrition / Digestive Health) | Hub por condición → subpáginas «Symptoms · Causes · Diagnosis · Treatment»; cada artículo con revisión médica fechada | CTA fijo «Schedule an appointment» + teléfono; ubicación y especialidad | Nombre del revisor, fecha de revisión, marca institucional, fuentes |
| **ZOE** | Contenido de ciencia + producto; autores con doctorado; «Evidence» en cada claim | Embudo único (test → plan) | Equipo científico, publicaciones, citas |
| **Mayo Clinic** (Diseases & Conditions) | Plantilla rígida y escaneable por afección; enlaces internos a especialistas | «Request appointment» por sede | Revisión por médico, política editorial |
| **Clínica Universidad de Navarra** (Nutrición) | Árbol tratamiento → enfermedad → unidad; fichas de profesionales | Pedir cita + ficha del especialista | Aval hospitalario, CV del equipo |
| **Clínicas de dietistas de autor en Madrid/Barcelona (p. ej. redes tipo Alimmenta)** | Página por patología + por ciudad/barrio + blog | Reserva online y precios visibles | Colegiación, fotos reales, reseñas Doctoralia/Google |

**Qué trasladar a Método ESN (sin inventar credenciales):**
1. **Página por problema clínico** (hoy solo hay tarjetas en la home): `/nutricionista-sibo-madrid`, `/nutricionista-sop-madrid`, `/nutricionista-colon-irritable-madrid`, `/nutricionista-deportivo-madrid`, `/consulta-nutricion-online`.
2. Cada página: H1 con problema + ciudad, «a quién ayudo», «cómo trabajo» (primera visita paso a paso), precios o rango, FAQ, reseñas reales filtradas por el tema, CTA a Doctoralia + teléfono/WhatsApp, mapa.
3. **Above the fold:** foto de Elena, «Dietista-nutricionista colegiada MAD01639 (CODINMA)», 5.0 en Doctoralia con enlace, clínica y barrio, botón «Reservar».
4. Autor y **fecha de revisión** en cada contenido; política editorial; bibliografía (DOI/PubMed).

### 1.2 Keyword gap (Madrid) — *estimaciones a validar*
| Keyword | Intención | Vol. est. | Dificultad | Página objetivo |
|---|---|---|---|---|
| nutricionista madrid | Transaccional local (genérica) | L | Muy alta | Home (no priorizar al inicio) |
| nutricionista barrio de salamanca | Transaccional local | S–M | Media | Home + `/nutricionista-salamanca-madrid` |
| nutricionista guindalera / avenida de américa | Local hiperespecífica | S | Baja | Contacto + landing barrio |
| nutricionista digestivo madrid | Transaccional | M | Media-alta | `/nutricionista-digestivo-madrid` |
| dietista especialista en sibo madrid | Transaccional | S–M | Media | `/nutricionista-sibo-madrid` |
| dieta sibo / qué comer con sibo | Informacional | M–L | Alta | Artículo hub SIBO |
| nutricionista colon irritable madrid | Transaccional | S–M | Media | Landing colon irritable |
| nutricionista sop madrid / dieta para el sop | Trans./Inform. | M | Media | Landing SOP + artículo |
| resistencia a la insulina dieta | Informacional | L | Alta | Artículo |
| amenorrea hipotalámica alimentación | Informacional clínica | S | Baja-media | Artículo (alto valor, poca competencia) |
| nutricionista deportivo presencial madrid | Transaccional | M | Media | `/nutricionista-deportivo-madrid` |
| nutrición y entrenamiento de fuerza mujer | Informacional→trans. | M | Media | Servicios + artículo |
| consulta nutrición online | Transaccional | M–L | Alta | `/consulta-nutricion-online` |
| elena sánchez novo nutricionista | Navegacional (marca) | S | Muy baja | Quiénes somos (ya cubierto) |
| clinical dietitian madrid / english speaking nutritionist madrid | Transaccional EN | S | Baja | `?lang=en` (nicho expats) |
| Ernährungsberaterin Madrid deutsch | Transaccional DE | S | Muy baja | `?lang=de` (nicho casi sin competencia) |

**Prioridad:** nichos de baja competencia y alta intención (SIBO, SOP, amenorrea, EN/DE, barrio) antes de «nutricionista madrid».

---
## MÓDULO 3 — E-E-A-T y contenido (YMYL)
*La reescritura de textos clínicos debe validarla Elena: no se han modificado los textos de las páginas, solo títulos/descripciones.*

### 3.1 Estructura de encabezados propuesta
**Home (`index.php`)** — H1: «Nutricionista clínica en Madrid y online» (hoy H1 = «Método ESN»; mantener la marca en logo/`WebSite`). H2: Especialidades · H3 por área: *Salud digestiva (SIBO, disbiosis, colon irritable)*, *Salud hormonal de la mujer (SOP, resistencia a la insulina, amenorrea)*, *Composición corporal y pérdida de grasa*, *Nutrición deportiva*. H2 Cómo trabajamos (roadmap) · H2 Opiniones verificadas · H2 Dónde estamos · H2 Dudas frecuentes.

**Servicios (`servicios.php`)** — H1: «Servicios de nutrición clínica y entrenamiento de fuerza en Madrid». H2 por servicio con H3 «Para quién es», «Qué incluye», «Cómo es la primera consulta»: *Nutrición digestiva*, *Nutrición hormonal femenina*, *Nutrición deportiva*, *Entrenamiento de fuerza*; H2 Presencial (Clínica SurgEOM) vs Online.

**Quiénes somos** — H1: «Elena Sánchez Novo, dietista-nutricionista colegiada (MAD01639)». H2 Formación y colegiación (CODINMA, ISK) · H2 Cómo trabajo · H2 Dónde atiendo. Añadir foto con `alt` descriptivo, enlace al colegio y fecha de última revisión.

### 3.2 Hub de salud — arquitectura
`/salud/` (índice por temas) → `/salud/sibo/`, `/salud/sop/`, `/salud/digestivo/`, `/salud/rendimiento/`. Cada artículo: autor (Person `@id` de Elena), fecha publicación + revisión, `Article`/`MedicalWebPage` JSON-LD, resumen «En 30 segundos», bibliografía numerada con DOI/PubMed, aviso «no sustituye la consulta», CTA contextual, 3–5 enlaces internos (servicio, landing de ciudad, otro artículo del clúster).

### 3.3 Diez artículos (long tail)
| # | Título | Foco | KW primaria / secundarias | Enlaces internos |
|---|---|---|---|---|
| 1 | SIBO: síntomas, test de aliento y enfoque nutricional | Diagnóstico + dieta por fases; evitar restricción crónica | sibo síntomas / test de aliento sibo, dieta sibo | → landing SIBO, contacto |
| 2 | Dieta baja en FODMAP: cómo y cuándo (y por qué no es para siempre) | Fases de eliminación/reintroducción | dieta fodmap / fodmap colon irritable | → colon irritable |
| 3 | Síndrome del intestino irritable: guía nutricional basada en guías clínicas | NICE/ACG, papel de la fibra | colon irritable alimentación / síntomas | → servicios digestivo |
| 4 | SOP y alimentación: resistencia a la insulina sin dietas extremas | Composición, fuerza, índice glucémico | sop dieta / resistencia a la insulina | → landing SOP |
| 5 | Resistencia a la insulina: qué es, cómo se mide (HOMA-IR) y qué hacer | Analíticas, entrenamiento de fuerza | resistencia insulina síntomas / homa-ir | → SOP, deportivo |
| 6 | Amenorrea hipotalámica y déficit energético relativo (RED-S) | Deportistas, recuperación | amenorrea hipotalámica / red-s | → deportivo, contacto |
| 7 | Proteína en la mujer deportista: cuánta, cuándo y de dónde | Revisión de posiciones ISSN/ACSM | proteína mujer deportista / g/kg | → deportivo |
| 8 | Recomposición corporal: perder grasa y ganar músculo a la vez | Evidencia y límites | recomposición corporal / perder grasa fuerza | → servicios |
| 9 | Suplementos «milagro» para adelgazar: qué dice la evidencia | Desmontar mitos (ya en FAQ) | suplementos adelgazar / quemagrasas | → FAQ, consulta |
| 10 | Nutrición online vs presencial: cuándo elegir cada una | Antropometría ISAK, seguimiento | consulta nutrición online / nutricionista presencial | → reserva |

Regla YMYL: citar guías (ESPEN, NICE, ACG, ISSN) y revisiones con DOI; no prometer curas; declarar conflictos de interés; actualizar anualmente.

---
## MÓDULO 4 — SEO local (Madrid)
**Google Business Profile** (ficha de la consulta en Clínica SurgEOM; verificar que el negocio puede tener ficha propia al ser una consulta dentro de una clínica y que no duplica la de SurgEOM):
* **Categoría principal:** «Dietista» (o «Nutricionista» según disponibilidad); **secundarias:** «Especialista en nutrición», «Servicio de salud y bienestar», «Entrenador personal» (solo si se ofrece como servicio independiente).
* **Servicios** (con descripción y precio/«desde»): Consulta nutrición digestiva, SIBO/disbiosis, salud hormonal femenina/SOP, nutrición deportiva, entrenamiento de fuerza, consulta online.
* **Atributos:** cita previa, videoconsulta, accesible, idiomas (ES/EN/DE).
* **NAP idéntico** en todo: `Método ESN · Clínica SurgEOM, Calle de Coslada 16, 28028 Madrid · +34 614 467 084` (mismo formato que `config.php`).
* **Fotos reales** con EXIF de ubicación (consultorio, fachada, equipo) ≥ 10; publicaciones mensuales; responder **todas** las reseñas sin datos de salud del paciente (RGPD); URL de cita → Doctoralia o `/reserva-de-citas.php?utm_source=gbp`.
* **Descripción (≤750):** «Dietista-nutricionista colegiada (MAD01639) en el barrio de Salamanca (Madrid) y online. Nutrición clínica digestiva (SIBO, colon irritable), salud hormonal femenina (SOP) y nutrición deportiva con entrenamiento de fuerza. Consulta en Clínica SurgEOM, C/ Coslada 16.» + horario L–V 16:00–21:00.
* Pedir reseñas en Google con enlace directo tras cada alta (sin incentivos); objetivo 20+ en 6 meses.

**Citas/NAP y enlaces sanitarios:** CODINMA (listado de colegiados), Doctoralia (ya), TopDoctors, Masquemedicos, Páginas Amarillas Salud, Cylex, Yelp, Bing Places, Apple Business Connect, directorio de SurgEOM (enlace desde su web a la ficha de Elena), asociaciones de pacientes (SOP, SIBO, enfermedad inflamatoria) cuando exista colaboración real.
**Digital PR sanitario:** colaboraciones con prensa de salud (consultas de experta en Cuídate Plus, Infosalus, Mujer Hoy, Women's Health ES), notas del CODINMA/Día del Dietista-Nutricionista, ponencias en eventos de salud digestiva y deporte femenino, podcasts. Principio: enlaces solo editoriales; **nunca** comprar enlaces (política de spam de Google).

---
## MÓDULO 5 — Core Web Vitals
Estado actual (código): CSS único 3 600 líneas, fuentes de Google (render-blocking), imágenes PNG/JPEG de hasta 1,5 k px sin `srcset`, widget Doctoralia en footer, iframe de Maps con `loading=lazy`, JS sin `defer`.

| Métrica | Riesgo | Acción (código) |
|---|---|---|
| **LCP** | Hero en PNG grande; fuentes bloqueantes | `<link rel="preload" as="image" fetchpriority="high">` de la imagen del hero; convertir PNG→**WebP/AVIF** (-60–80 %) con `<picture>` y `srcset`; `fetchpriority="high"` + sin `loading=lazy` en la imagen LCP; auto-alojar Fraunces/Instrument Sans (WOFF2, subset latin) con `font-display: swap` y `preload` del peso principal |
| **CLS** | Imágenes sin `width/height` (algunas sí), fuentes que cambian métricas, carrusel que calcula ancho en JS | `width/height` o `aspect-ratio` en todas las `<img>`; `size-adjust` en fallback de fuente; reservar altura del carrusel con `min-height` |
| **INP** | `scroll` listener sin throttle (ya `passive`), handlers ligeros | Mantener; `defer` en `main.js`; cargar el widget Doctoralia **al aparecer en viewport** (IntersectionObserver) o al interactuar, no en carga |
| Iframe Maps | Pesado (≈500 KB) | Cargarlo bajo demanda (facade: imagen estática + botón «Cargar mapa»); ya tiene `loading=lazy` |
| Caché | Estáticos sin versionado | `Cache-Control: immutable` ya añadido en `.htaccess`/nginx → añadir `?v=hash` a CSS/JS; Brotli/gzip; HTTP/2 |
| CSS | 3 600 líneas, reglas duplicadas (varios bloques `.faq-content`, `.form-control:focus`…) | Eliminar duplicados; extraer CSS crítico above-the-fold; `media` split |

Medir con PageSpeed Insights (campo, móvil) y CrUX en Search Console; objetivo: LCP < 2,5 s, CLS < 0,1, INP < 200 ms.

## Cronograma priorizado
**Semana 1 — Quick wins (ya hechos o de horas)**: títulos/descr., canónicas, hreflang, JSON-LD, sitemap/robots *(hecho)* · verificar geo/recuento · alta en Search Console + envío de sitemap · completar ficha de Google Business Profile y reseñas · NAP homogéneo en directorios · `defer` en JS · convertir imágenes a WebP.
**Mes 1–2:** 5 landings (SIBO, colon irritable, SOP, deportivo, online) con FAQ y reseñas por tema · auto-alojar fuentes · facade de Maps/Doctoralia · rutas `/en/` `/de/` · CSP en modo *report-only* → estricta.
**Mes 3–6:** Hub `/salud/` con 1 artículo/semana (los 10 propuestos) revisados y fechados · PR/enlaces (CODINMA, prensa de salud, SurgEOM) · 20+ reseñas Google · revisión trimestral de keywords en Search Console.
**KPIs:** impresiones y posición media por landing, clics a Doctoralia/teléfono (eventos), reservas atribuidas, reseñas nuevas, CWV en campo.

---
## Estado de implementación (actualización)
**Hecho en código:** 5 landings de servicio (`nutricionista-sibo-madrid`, `-colon-irritable-madrid`, `-sop-madrid`, `-deportivo-madrid`, `consulta-nutricion-online`) con H1 de intención local, FAQ, aviso médico, fecha de revisión, JSON-LD `MedicalWebPage`+`FAQPage`+`BreadcrumbList`, enlaces internos (home, footer, relacionadas) y entrada en `sitemap.xml`. Contenido en `src/landings.php`; plantilla en `src/landing_page.php`. `main.js` con `defer`.
**Decisiones:** las landings son **solo en español** (canónica propia, sin hreflang falso; el selector de idioma lleva a la home del idioma). El hub `/salud/` y los 10 artículos **no se han creado**: exigen bibliografía PubMed/DOI real y revisión clínica de Elena; publicar texto sin fuentes verificadas en YMYL perjudicaría el E-E-A-T. ⚠ Los textos de las landings son un borrador prudente que **debe revisar Elena** antes de publicar.
**Pendiente (requiere acciones fuera del código):** Search Console, ficha de Google Business Profile, directorios/NAP, reseñas, conversión a WebP/auto-alojar fuentes, facade del mapa.

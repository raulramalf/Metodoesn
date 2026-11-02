# Inventario SEO original (rama mejoras-seguridad-seo-i18n, antes del rediseño)

## includes/head.php (global)
- `<title>`: "{pageTitle} · Método ESN" (por página y por idioma)
- `<meta name="description">`: {pageDesc} o t('hero_lead')
- `<link rel="icon">`: /assets/img/logo.png
- canonical: absolute_url(idioma actual)
- hreflang: es, en, de + x-default (=es), vía absolute_url()
- Open Graph: type=website, site_name, locale (og_locale), title, description, url, image (/assets/img/og-hero.jpg)
- Twitter: solo `twitter:card=summary_large_image`
- JSON-LD / schema.org: NO existe
- Preload fuente: instrument-sans-normal-400-latin.woff2; fonts.css (font-display a verificar) + style.css
- `<html lang>` dinámico; skip link a #main

## robots.txt
User-agent: * / Allow: / / Sitemap: https://metodoesn.com/sitemap.xml

## sitemap.xml
9 URLs x 3 idiomas (?lang=en|de), con xhtml:link hreflang es/en/de/x-default.

## Páginas: title (es) | h1 | secuencia de encabezados (es)
- index.php | "Cuidar tu salud no es vivir a dieta…" | h1 "Método ESN" | h1 h2 h2 h3 h3 h2 h3x4 h3 h2 h3x4 h2 h3x4 h2 h2 h2 h3 h3
- quienes-somos.php | "Quiénes somos" | h1 "Elena Sánchez Novo" | h1 h2 h3 h3 h3 h2 h2 h2 h3 h3
- servicios.php | "Servicios de Nutrición y Entrenamiento" | h1 "Nutrición clínica y entrenamiento a tu medida" | h1 h2 h3x3 h2 h3 h3 h2 h2 h3 h3
- reserva-de-citas.php | "Reserva de Citas Oficial" | h1 "Selecciona fecha y hora para tu consulta" | h1 h3 h2 h3 h3  (salto h1→h3)
- dudas.php | "Preguntas Frecuentes y Dudas" | h1 "Preguntas frecuentes sobre el Método ESN" | h1 h3 h2 h2 h3 h3 (salto h1→h3)
- contacto.php | "Contacto y Citas" (title duplica "Método ESN") | h1 "Ponte en contacto con Elena Sánchez Novo" | h1 h3 h2 h2 h3 h3 (salto h1→h3)
- aviso-legal / politica-de-privacidad / politica-de-cookies | h1 propio | h1 h2… ; meta description = fallback genérico (t('hero_lead')) en las 3

## Hallazgos a tener en cuenta (NO se cambian salvo OK del usuario)
- contacto.php ES: título "Contacto y Citas · Método ESN · Método ESN" (duplicado)
- Legales sin description propia
- Saltos h1→h3 en reserva, dudas, contacto
- Sin JSON-LD, twitter:title/description/image ausentes

---
# Después del rediseño (rama rediseno)
Sin cambios: URLs y nombres de archivo, canonical, hreflang (es/en/de/x-default), Open Graph, h1 de cada página, textos alt, enlaces internos, robots.txt, sitemap.xml, favicon, width/height en imágenes, font-display: swap.
Cambios (autorizados): 
- Contacto: título sin "Método ESN" duplicado (es/en/de).
- Legales: meta description propia (es/en/de).
- reserva, dudas, contacto: eliminado el salto h1→h3 (ahora h1→h2).
- Añadidos: JSON-LD (WebSite + MedicalBusiness/LocalBusiness + Person con colegiada MAD01639), twitter:title/description/image, theme-color.
- Portada: nueva sección h2 "Elena Sánchez Novo" (confianza/colegiación); pasa de 13 a 14 encabezados.

## Segunda ronda
- Hero de la portada: el h1 sigue siendo "Método ESN" (ahora como firma); el eslogan grande "Come. Entrena. Vive." (EN "Eat. Train. Live.", DE "Iss. Trainiere. Lebe.") va en un <p>, no en un encabezado. Se quitó del hero la línea "Entrenamiento | Salud | Nutrición" y el párrafo hero_desc (no se ocultan: se eliminan del marcado).
- Páginas legales traducidas a EN y DE (plantillas en includes/legal/); el h1 de esas páginas ahora cambia con el idioma.

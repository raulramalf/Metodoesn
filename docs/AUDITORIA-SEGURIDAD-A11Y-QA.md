# Auditoría Método ESN — Seguridad · Accesibilidad · QA

Todo lo descrito está **implementado en el repositorio** y verificado (PHPUnit 64 tests, Playwright 20 E2E, axe-core 0 violaciones en 7 páginas × 3 idiomas; stress de SQLite 2 400 escrituras concurrentes sin bloqueos). Lo que **no** se pudo ejecutar aquí se indica expresamente.

## Cómo ejecutar
```bash
composer install && vendor/bin/phpunit                    # 64 tests unitarios/integración
npm install && npx playwright test                        # E2E + axe (levanta php -S solo)
php tests/load/sqlite-wal-stress.php 16 150               # concurrencia pura sobre SQLite
tests/load/ab-contacto.sh https://staging.metodoesn.com   # Apache Benchmark (requiere apache2-utils)
k6 run -e BASE=https://staging.metodoesn.com tests/load/k6-contacto.js
```
> `ab` y `k6` no estaban instalados en el entorno de auditoría: los scripts están escritos pero **no ejecutados**. El stress PHP sí.

---
## BLOQUE 1 — Seguridad

### Hallazgos (antes → después)
| # | Hallazgo | Severidad | Corrección |
|---|---|---|---|
| S1 | Sin cabeceras de seguridad (CSP, HSTS, XFO…) | Alta | `src/security.php` (enviadas desde `functions.php`) + `.htaccess` + `docs/deploy/nginx.conf` |
| S2 | Formulario sin rate limiting | Alta | `Database::rateLimitHit()` — 3 envíos / 15 min / IP, atómico (`BEGIN IMMEDIATE`), HTTP 429 + `Retry-After` |
| S3 | Mensaje (posible dato de salud, art. 9 RGPD) en claro en SQLite | Alta | Cifrado `sodium_crypto_secretbox` del campo `mensaje`; clave en `data/app.key` (0600) o `ESN_APP_KEY` |
| S4 | Sin registro de consentimiento | Alta (RGPD art. 7.1) | Columnas `consentimiento`, `politica_version`, `consentimiento_en` (ISO-8601 UTC), `idioma`; texto de consentimiento explícito incluye datos de salud |
| S5 | CSRF sin caducidad ni rotación | Media | TTL 2 h, rotación tras envío válido, `hash_equals` |
| S6 | Honeypot visible para lectores de pantalla y sin segunda barrera | Media | `aria-hidden`, `tabindex=-1`, + token de tiempo firmado HMAC (mín. 3 s) |
| S7 | Entrada sin saneamiento (bytes nulos, UTF-8 inválido, bidi, homoglifos) | Media | `sanitize_text()` (NFKC, elimina controles/bidi/zero-width) + `has_mixed_script_word()` + email solo ASCII |
| S8 | `$_POST['x']` array (`nombre[]=`) provocaba TypeError | Media | Se rechaza si no es `string` |
| S9 | `REMOTE_ADDR` sin validar; sin soporte proxy | Baja | `client_ip()`; `X-Forwarded-For` solo desde `TRUSTED_PROXIES` |
| S10 | Cookies de sesión/idioma sin `HttpOnly`/`SameSite`/`Secure` | Media | `config.php` y `i18n.php` |
| S11 | Sin migraciones; sin WAL/busy_timeout | Media | `PRAGMA user_version`, WAL, `busy_timeout=5000`, `secure_delete` |
| S12 | Sin política de retención | Media (RGPD minimización) | `Database::purgeContacts()` (730 días) + `php bin/leer-contactos.php --purge` |

### CSP aplicada
`script-src 'self' 'nonce-…' https://platform.docplanner.com` — **sin `unsafe-inline` en scripts** (los 4 snippets de Doctoralia llevan nonce; JSON-LD también).
**Deuda reconocida:** `style-src` conserva `'unsafe-inline'` porque las plantillas usan decenas de atributos `style=""`. Plan: mover esos estilos a clases y pasar a `style-src 'self'` (+ hash/nonce para el CSS que inyecte el widget). Validar la CSP en producción con `Content-Security-Policy-Report-Only` durante 1–2 semanas antes de retirar excepciones: los widgets de Doctoralia cargan recursos de dominios que pueden variar.

### Blindaje de `data/metodoesn.sqlite` (defensa en profundidad)
1. `DocumentRoot = public/` (la BD queda fuera). 2. `/.htaccess` (deniega todo si el DocumentRoot fuera la raíz). 3. `data/.htaccess` + `data/index.html`. 4. `public/.htaccess` deniega `*.sqlite|db|key|env|log|sql|bak…` y dotfiles. 5. Nginx: `location ^~ /data/` y extensiones → 404. 6. Permisos de ficheros 0600 / directorio 0700 creados por código. 7. `.gitignore` cubre `-wal/-shm`, `app.key`. 8. Cifrado del mensaje: aunque se filtrara el fichero, los textos no son legibles sin la clave.
**Operativa recomendada:** copias de seguridad cifradas; guardar `ESN_APP_KEY` en el gestor de secretos del hosting (no solo en `data/`); extremo cuidado: **perder la clave = perder los mensajes**.

### Riesgos residuales / pendientes (honestidad)
* El envío **solo guarda en BD**: no hay aviso por email a la titular → revisar `bin/leer-contactos.php` o añadir SMTP (decisión de producto).
* Rate limit por IP: usuarios tras CGNAT comparten cuota; es el compromiso pedido (3/15 min).
* El honeypot responde 400 (determinista y testeable); un bot sofisticado lo detecta. Alternativa: simular éxito (se pierde la testabilidad E2E).
* Revisar con asesoría jurídica el texto de la política de privacidad (base legal art. 9.2.a, encargados, plazo 730 días) y actualizar `PRIVACY_POLICY_VERSION` en cada cambio.
* No hay ningún panel admin: no se ha introducido superficie nueva.

---
## BLOQUE 2 — Accesibilidad (WCAG 2.2 AA)

### Auditoría automática real (axe-core 4.10, tags wcag2a/2aa/21a/21aa/22aa + best-practice)
Inicial: violaciones de `label-content-name-mismatch` (marca y selector de idioma), `color-contrast` (4 elementos), `target-size` (indicadores del carrusel), `link-in-text-block`, `aria-allowed-role` (carrusel) y `heading-order` (contacto, reserva). Final: **0 violaciones (ninguna severidad)** en las 7 páginas × 3 idiomas. Los iframes de terceros (Doctoralia/Maps) se excluyen del alcance.
> La auditoría automática detecta ~30–40 % de los problemas WCAG: **falta prueba manual con NVDA+Firefox, JAWS+Chrome y VoiceOver+Safari** (no disponible en este entorno).

### Componentes dinámicos
| Componente | Problemas encontrados | Corrección |
|---|---|---|
| **Carrusel** | `aria-live` fijo en contador (anuncio cada 5,5 s); sin botón de pausa (2.2.2); autoplay reanudaba tras `focusout` aunque se pausara; dots como `tablist` sin `tabpanel`; slides fuera de vista leíbles; ignoraba `prefers-reduced-motion`; `role=group` en `<figure>` inválido | `region` + `aria-roledescription` localizado; slides `role=group` `aria-roledescription=diapositiva` `aria-label="n / N"`; botón Pausa (`aria-pressed`); `aria-live` del track **off** con autoplay y **polite** sin él; `role=status` para anunciar «Opinión n de N» solo en acciones del usuario; slides no visibles `aria-hidden`+`inert`; dots `aria-current`, objetivo 24 px; flechas/Home/End; sin autoplay con reduced-motion; pausa por hover/foco/pestaña oculta |
| **Buscador FAQ** | `aria-live` en `<p>` vacío, anuncio por pulsación, sin mensaje de «sin resultados» en el live region, búsqueda sensible a tildes | `role=status aria-live=polite aria-atomic`, debounce 300 ms, textos 1/n/0 localizados, búsqueda insensible a tildes (`digestion`→`digestión`), `aria-controls`, tarjetas con `hidden` |
| **Acordeón FAQ** | Sin `aria-controls`/región; sin navegación entre cabeceras | `aria-controls`, `role=region aria-labelledby`, ↑↓ Inicio Fin |
| **Selector de idioma** | `aria-haspopup="true"`+`role=menu/menuitem` sobre **enlaces** (patrón incorrecto, promete flechas que no existían), apertura por `:hover` que desincronizaba `aria-expanded`, sin `aria-controls`, nombre accesible no contenía el texto visible «ES» (2.5.3), foco imposible justo al abrir (visibility transition) | Patrón *disclosure* (botón + `<ul>` de enlaces), `aria-expanded/aria-controls`, `aria-current`, `lang/hreflang` por opción, ↓/↑ abren y navegan, Inicio/Fin, Esc cierra y devuelve foco, Tab cierra, sin hover-open |
| **Menú móvil** | Sin trampa de foco; fondo navegable con drawer abierto | Foco al abrir, ciclo Tab/Shift+Tab, `inert` en `main/footer/cookies/skip`, Esc → foco al botón, cierre al pasar a escritorio |
| **Formulario** | Errores sin asociación; sin resumen; foco no iba al error; honeypot leíble | `aria-invalid`, `aria-describedby`→`.field-error`, resumen `role=alert`, foco al primer error, validación al salir del campo, `autocomplete`, `role=status` en éxito |
| Skip-link | `left:-9999px` (sin transición) y `<main>` no enfocable | `tabindex=-1` en `main`, skip-link visible al foco |

### Contraste (cálculo WCAG, fórmula de luminancia relativa)
Nota: el CSS real usa `--logo-color #a38988`, `--moss #744847`, `--paper #faf8f8`; se calculan **ambas paletas** (la del encargo y la del repo).

| Par (texto/fondo) | Ratio | Veredicto | Acción |
|---|---|---|---|
| `#8A4F4D` / `#FAF5F4` (encargo) | 5.88 | AA texto ✔ | — |
| `#744847` / `#FAF8F8` (repo `--moss`) | 7.19 | AA ✔ AAA ✔ | — |
| `#544140` / `#FAF5F4` | 8.80 | AAA ✔ | — |
| `#4A3E3E` / `#FAF8F8` (`--ink-soft`) | 9.68 | AAA ✔ | — |
| `#796867` / `#FAF8F8` (`--ink-muted`) | 4.98 | AA ✔ (justo) | no usar sobre `--mist` |
| **`#C79C95` / `#FFF`** (encargo) | **2.44** | ✘ texto y ✘ 3:1 componentes | solo decorativo; para texto/iconos usar `#8A4F4D` (6.35) |
| **`#A38988` / `#FFF`** (`--logo-color` repo) | **3.24** | ✘ texto normal · ✔ solo ≥24 px/ 3:1 UI | `.hero-sub` pasó a `--moss` |
| **`#C98829` / `#FFF`** (`--gold`) | **2.98** | ✘ texto y ✘ anillo de foco (3:1) | nuevo `--gold-text #8F5A0C` = **5.78**; `.score-number`, `.bento-num`, `.tab-num` |
| `#8B7D7D` / `#F8F6F6` (`.compare-tag-old`) | 3.66 | ✘ | `#6F5B5A` → 5.98 |
| `#9C9090` / `#F8F6F6` (`.compare-footer-old`) | 2.86 | ✘ | `#6F5B5A` → 5.98 |
| `#744847` / `#241E1E` (enlace certificado en footer) | 2.15 | ✘ | `#F3DEDC` → ≈11.9 |
| Blanco / `#744847` (botón) | 7.61 | ✔ AAA | — |
| Anillo de foco antes: `--gold` | 2.98 | ✘ 2.4.11/1.4.11 | nuevo `--focus-ring #533231` (11.2) + halo blanco 6 px; en fondos oscuros invierte (blanco + halo oscuro) |

Estrellas ★ doradas: decorativas (`aria-hidden`) y acompañadas de «5.0»; si se consideran contenido no textual se recomienda `#B5731A` (≥3:1).
Estética: la paleta rosa se mantiene; solo cambian los tonos de **texto** y el anillo de foco.

### Foco y teclado
`:focus-visible` con doble anillo (visible en claro/oscuro/forced-colors), `scroll-margin-top` para que la cabecera fija no tape el foco (2.4.11), objetivos ≥24 px (2.5.8) y ≥44 px en controles principales, `prefers-reduced-motion` global.

### Pendiente
* Prueba manual con lectores de pantalla; revisar el `alt` de imágenes (`dondestamos.jpg` tiene alt solo en ES).
* AAA completo (1.4.6 contraste 7:1) no se persigue en texto secundario; los textos principales ya lo cumplen.

---
## BLOQUE 3 — QA
* `tests/php/` — PHPUnit 10: escape/XSS (payloads), `sanitize_text` (null byte, UTF-8 inválido, bidi, NFKC, homoglifos), CSRF (TTL, rotación, tokens inválidos), `Database` (singleton, WAL, migración desde BD legada, consentimiento ISO-8601, cifrado/ manipulación, SQLi inerte, rate limit con ventana deslizante e IP independientes, retención, permisos 0600), i18n (idiomas soportados, fallback, `?lang=` malicioso, cookie manipulada, cobertura de claves EN/DE, `lang_url`/`page_url`), cabeceras CSP/HSTS, hreflang y JSON-LD.
* `tests/e2e/site.spec.ts` (desktop + móvil) — home/skip-link/cabeceras, menú móvil con trampa de foco, idioma EN/DE por teclado, carrusel, buscador FAQ, validación en vivo, honeypot, CSRF/envío instantáneo, éxito y 429 al 4.º envío.
* `tests/e2e/a11y.spec.ts` — `@axe-core/playwright` en 7 páginas × 3 idiomas; adjunta JSON de violaciones; falla con *critical/serious*.
* `tests/load/` — `sqlite-wal-stress.php` (ejecutado: 16 procesos × 150 = 2 400/2 400 filas, `journal=wal`, `integrity=ok`), `ab-contacto.sh` y `k6-contacto.js` (no ejecutados).

### Checklist de rendimiento/carga (antes de producción)
- [ ] `PRAGMA journal_mode` = `wal` en el fichero real (el script lo imprime).
- [ ] 0 respuestas 5xx / «database is locked» con 25–150 concurrentes (`ab`/`k6`).
- [ ] p95 lectura home < 500 ms con OPcache activado (`opcache.enable=1`, `validate_timestamps=0` en prod).
- [ ] El directorio `data/` está en disco local (WAL **no** funciona bien sobre NFS).
- [ ] Rate limit: 4.º envío = 429 (E2E) y bucket por IP real tras el proxy (`TRUSTED_PROXIES`).
- [ ] `PRAGMA integrity_check` = ok tras la prueba; backup `sqlite3 .backup` probado.
- [ ] Cron semanal: `php bin/leer-contactos.php --purge`.

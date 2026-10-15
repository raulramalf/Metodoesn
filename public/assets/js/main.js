/**
 * MÉTODO ESN — SCRIPT MAESTRO DE INTERACCIÓN (v3.1)
 * Microinteracciones · Accesibilidad WCAG 2.2 · Rendimiento
 */

const LANG = (document.documentElement.lang || 'es').slice(0, 2);
const I18N = {
    es: { slide: 'Opinión', of: 'de', go: 'Ir a la opinión', sending: 'Enviando mensaje...', required: 'Este campo es obligatorio.', email: 'Introduce un email válido.', consent: 'Debes aceptar la política de privacidad.', errors: 'Revisa los campos marcados.' },
    en: { slide: 'Review', of: 'of', go: 'Go to review', sending: 'Sending message...', required: 'This field is required.', email: 'Please enter a valid email address.', consent: 'You must accept the privacy policy.', errors: 'Please review the highlighted fields.' },
    de: { slide: 'Bewertung', of: 'von', go: 'Zur Bewertung', sending: 'Nachricht wird gesendet...', required: 'Dieses Feld ist erforderlich.', email: 'Bitte geben Sie eine gültige E-Mail-Adresse ein.', consent: 'Bitte akzeptieren Sie die Datenschutzerklärung.', errors: 'Bitte prüfen Sie die markierten Felder.' },
};
const tr = (k) => (I18N[LANG] || I18N.es)[k];
const FOCUSABLE = 'a[href], button:not([disabled]), input:not([disabled]):not([type="hidden"]), select, textarea, [tabindex]:not([tabindex="-1"])';
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

document.addEventListener('DOMContentLoaded', () => {
    // ─── 1. NAVBAR & MENÚ MÓVIL (con atrapamiento de foco) ───────────────────
    const navToggle = document.getElementById('nav-toggle');
    const navMenu   = document.getElementById('nav-menu');
    const header    = document.getElementById('site-header');
    const mobileMQ  = window.matchMedia('(max-width: 860px)');

    if (navToggle && navMenu) {
        const isOpen = () => navMenu.classList.contains('is-open');
        const setOpen = (open, returnFocus = false) => {
            navMenu.classList.toggle('is-open', open);
            navToggle.setAttribute('aria-expanded', String(open));
            document.body.classList.toggle('nav-menu-open', open);
            // Fondo inerte mientras el drawer está abierto (el header contiene el propio drawer)
            document.querySelectorAll('main, footer, .cookie-banner, .skip').forEach((el) => {
                if (open && mobileMQ.matches) el.setAttribute('inert', ''); else el.removeAttribute('inert');
            });
            if (open && mobileMQ.matches) {
                const first = navMenu.querySelector(FOCUSABLE);
                if (first) first.focus();
            } else if (returnFocus) {
                navToggle.focus();
            }
        };

        navToggle.addEventListener('click', () => setOpen(!isOpen()));
        navMenu.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setOpen(false)));

        document.addEventListener('keydown', (e) => {
            if (!isOpen() || !mobileMQ.matches) return;
            if (e.key === 'Escape') {
                setOpen(false, true);
                return;
            }
            if (e.key !== 'Tab') return;
            // Ciclo de foco: botón de menú + elementos del drawer
            const items = [navToggle, ...navMenu.querySelectorAll(FOCUSABLE)].filter((el) => el.offsetParent !== null);
            const first = items[0];
            const last  = items[items.length - 1];
            if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
            else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
        });

        mobileMQ.addEventListener('change', (ev) => { if (!ev.matches && isOpen()) setOpen(false); });
    }

    if (header) {
        const handleScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 20);
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    }

    // ─── 1b. SELECTOR DE IDIOMA (disclosure + navegación con flechas) ────────
    const langDropdowns = Array.from(document.querySelectorAll('.lang-dropdown'));
    const closeLang = (d, focusTrigger = false) => {
        const trg = d.querySelector('.lang-dropdown-trigger');
        d.classList.remove('is-open');
        if (trg) { trg.setAttribute('aria-expanded', 'false'); if (focusTrigger) trg.focus(); }
    };
    langDropdowns.forEach((dropdown) => {
        const trigger = dropdown.querySelector('.lang-dropdown-trigger');
        const items = () => Array.from(dropdown.querySelectorAll('.lang-menu-item'));
        if (!trigger) return;

        const open = (focusIndex = null) => {
            langDropdowns.forEach((d) => d !== dropdown && closeLang(d));
            dropdown.classList.add('is-open');
            trigger.setAttribute('aria-expanded', 'true');
            if (focusIndex !== null) {
                const list = items();
                (focusIndex === 'last' ? list[list.length - 1] : list[focusIndex])?.focus();
            }
        };

        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdown.classList.contains('is-open') ? closeLang(dropdown) : open();
        });
        trigger.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowDown') { e.preventDefault(); open(0); }
            else if (e.key === 'ArrowUp') { e.preventDefault(); open('last'); }
        });
        dropdown.addEventListener('keydown', (e) => {
            if (e.target === trigger || !dropdown.classList.contains('is-open')) return;   // las flechas del botón las gestiona su propio listener
            const list = items();
            const i = list.indexOf(document.activeElement);
            if (e.key === 'Escape') { e.stopPropagation(); closeLang(dropdown, true); }
            else if (e.key === 'ArrowDown') { e.preventDefault(); list[(i + 1) % list.length].focus(); }
            else if (e.key === 'ArrowUp') { e.preventDefault(); list[(i - 1 + list.length) % list.length].focus(); }
            else if (e.key === 'Home') { e.preventDefault(); list[0].focus(); }
            else if (e.key === 'End') { e.preventDefault(); list[list.length - 1].focus(); }
            else if (e.key === 'Tab') { closeLang(dropdown); }
        });
        dropdown.addEventListener('focusout', (e) => {
            if (e.relatedTarget && !dropdown.contains(e.relatedTarget)) closeLang(dropdown);
        });
    });
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.lang-dropdown')) langDropdowns.forEach((d) => closeLang(d));
    });

    // ─── 2. COOKIES BANNER ───────────────────────────────────────────────────
    const COOKIE_KEY = 'esn_cookies_pref';
    const cookieBanner = document.getElementById('cookie');

    if (cookieBanner) {
        let savedPref = null;
        try { savedPref = localStorage.getItem(COOKIE_KEY); } catch (e) {}

        if (savedPref === null) {
            cookieBanner.hidden = false;
        }

        cookieBanner.querySelectorAll('[data-cookie]').forEach((btn) => {
            btn.addEventListener('click', () => {
                const choice = btn.dataset.cookie;
                try { localStorage.setItem(COOKIE_KEY, choice); } catch (e) {}
                cookieBanner.hidden = true;
            });
        });

        const resetBtn = document.getElementById('cookie-reset');
        if (resetBtn) {
            resetBtn.addEventListener('click', () => {
                try { localStorage.removeItem(COOKIE_KEY); } catch (e) {}
                cookieBanner.hidden = false;
            });
        }
    }

    // ─── 3. ROADMAP INTERACTIVO (HOME) ───────────────────────────────────────
    const roadmapBox = document.getElementById('roadmap-box');
    if (roadmapBox) {
        const tabs   = roadmapBox.querySelectorAll('.roadmap-tab-btn');
        const panels = roadmapBox.querySelectorAll('.roadmap-panel-item');
        tabs.forEach((tab) => {
            tab.addEventListener('click', () => {
                const phase = tab.dataset.phase;
                if (!phase) return;
                tabs.forEach((t) => {
                    const isActive = t === tab;
                    t.classList.toggle('is-active', isActive);
                    t.setAttribute('aria-selected', String(isActive));
                });
                panels.forEach((panel) => {
                    const isTarget = panel.id === `panel-${phase}`;
                    panel.classList.toggle('is-active', isTarget);
                    panel.hidden = !isTarget;
                });
            });
        });
    }

    // ─── 4. CARRUSEL DE OPINIONES (WAI-ARIA Carousel Pattern) ────────────────
    const quotesCarousel = document.getElementById('quotes-carousel');
    if (quotesCarousel) {
        const track      = document.getElementById('quotes-track');
        const slides     = track ? Array.from(track.querySelectorAll('.quote-slide')) : [];
        const prevBtn    = document.getElementById('quotes-prev');
        const nextBtn    = document.getElementById('quotes-next');
        const pauseBtn   = document.getElementById('quotes-pause');
        const status     = document.getElementById('quotes-status');
        const counterCur = quotesCarousel.querySelector('.quotes-current');
        const indicators = document.getElementById('quotes-indicators');
        const viewport   = document.getElementById('quotes-viewport');

        if (track && slides.length > 0) {
            let currentIndex = 0;
            let autoTimer = null;
            let userPaused = prefersReducedMotion.matches;   // 2.2.2: sin autoplay si el usuario reduce movimiento
            const AUTO_DELAY = 7000;

            const getVisibleCount = () => (window.innerWidth <= 640 ? 1 : window.innerWidth <= 960 ? 2 : 3);
            const getMaxIndex = () => Math.max(0, slides.length - getVisibleCount());

            const renderIndicators = () => {
                if (!indicators) return;
                indicators.innerHTML = '';
                for (let i = 0; i <= getMaxIndex(); i++) {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.className = 'quotes-indicator-dot';
                    dot.setAttribute('aria-label', `${tr('go')} ${i + 1}`);
                    dot.addEventListener('click', () => { goToIndex(i, true); });
                    indicators.appendChild(dot);
                }
            };

            const goToIndex = (target, announce = false) => {
                const max = getMaxIndex();
                currentIndex = target < 0 ? max : target > max ? 0 : target;

                const gap = parseFloat(getComputedStyle(track).gap) || 24;
                const offset = currentIndex * (slides[0].getBoundingClientRect().width + gap);
                track.style.transform = `translateX(-${offset}px)`;

                const vis = getVisibleCount();
                slides.forEach((sl, idx) => {
                    const visible = idx >= currentIndex && idx < currentIndex + vis;
                    sl.setAttribute('aria-hidden', String(!visible));
                    sl.toggleAttribute('inert', !visible);
                });
                if (counterCur) counterCur.textContent = String(currentIndex + 1);
                indicators?.querySelectorAll('.quotes-indicator-dot').forEach((dot, idx) => {
                    dot.classList.toggle('is-active', idx === currentIndex);
                    if (idx === currentIndex) dot.setAttribute('aria-current', 'true'); else dot.removeAttribute('aria-current');
                });
                // Anuncio explícito solo en cambios iniciados por el usuario (nunca en autoplay)
                if (announce && status) {
                    status.textContent = `${tr('slide')} ${currentIndex + 1} ${tr('of')} ${slides.length}`;
                }
            };

            // aria-live="polite" solo cuando NO hay rotación automática (evita interrupciones constantes)
            const syncLive = () => track.setAttribute('aria-live', autoTimer ? 'off' : 'polite');
            const stopAutoplay = () => { clearInterval(autoTimer); autoTimer = null; syncLive(); };
            const startAutoplay = () => {
                stopAutoplay();
                if (userPaused || prefersReducedMotion.matches || document.hidden) return;
                autoTimer = setInterval(() => goToIndex(currentIndex + 1), AUTO_DELAY);
                syncLive();
            };

            const setPaused = (paused) => {
                userPaused = paused;
                if (pauseBtn) {
                    pauseBtn.setAttribute('aria-pressed', String(paused));
                    pauseBtn.setAttribute('aria-label', paused ? pauseBtn.dataset.labelPlay : pauseBtn.dataset.labelPause);
                    pauseBtn.querySelector('.icon-pause')?.toggleAttribute('hidden', paused);
                    pauseBtn.querySelector('.icon-play')?.toggleAttribute('hidden', !paused);
                }
                paused ? stopAutoplay() : startAutoplay();
            };

            nextBtn?.addEventListener('click', () => { goToIndex(currentIndex + 1, true); });
            prevBtn?.addEventListener('click', () => { goToIndex(currentIndex - 1, true); });
            pauseBtn?.addEventListener('click', () => setPaused(!userPaused));

            // Pausa por hover/foco; solo reanuda si el usuario no pausó explícitamente
            quotesCarousel.addEventListener('mouseenter', stopAutoplay);
            quotesCarousel.addEventListener('mouseleave', startAutoplay);
            quotesCarousel.addEventListener('focusin', stopAutoplay);
            quotesCarousel.addEventListener('focusout', (e) => {
                if (!quotesCarousel.contains(e.relatedTarget)) startAutoplay();
            });
            document.addEventListener('visibilitychange', () => (document.hidden ? stopAutoplay() : startAutoplay()));
            prefersReducedMotion.addEventListener?.('change', (e) => setPaused(e.matches));

            // Gestos táctiles
            let touchStartX = 0;
            viewport?.addEventListener('touchstart', (e) => { stopAutoplay(); touchStartX = e.changedTouches[0].screenX; }, { passive: true });
            viewport?.addEventListener('touchend', (e) => {
                const diff = touchStartX - e.changedTouches[0].screenX;
                if (Math.abs(diff) > 40) goToIndex(currentIndex + (diff > 0 ? 1 : -1), true);
                startAutoplay();
            }, { passive: true });

            // Teclado: flechas, Home/End (solo con el foco dentro del carrusel y fuera de campos de texto)
            quotesCarousel.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight') { e.preventDefault(); goToIndex(currentIndex + 1, true); }
                else if (e.key === 'ArrowLeft') { e.preventDefault(); goToIndex(currentIndex - 1, true); }
                else if (e.key === 'Home') { e.preventDefault(); goToIndex(0, true); }
                else if (e.key === 'End') { e.preventDefault(); goToIndex(getMaxIndex(), true); }
            });

            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => { renderIndicators(); goToIndex(Math.min(currentIndex, getMaxIndex())); }, 150);
            });

            renderIndicators();
            setPaused(userPaused);
            goToIndex(0);
        }
    }

    // ─── 6. ACORDEÓN ACCESIBLE (HOME & DUDAS) ────────────────────────────────
    const bindAccordions = (containerId) => {
        const container = document.getElementById(containerId);
        if (!container) return;
        const cards = container.querySelectorAll('.faq-card');
        cards.forEach((card) => {
            const trigger = card.querySelector('.faq-trigger');
            if (!trigger) return;
            trigger.addEventListener('click', () => {
                const wasOpen = card.classList.contains('is-open');
                cards.forEach((other) => {
                    if (other !== card) {
                        other.classList.remove('is-open');
                        other.querySelector('.faq-trigger')?.setAttribute('aria-expanded', 'false');
                    }
                });
                card.classList.toggle('is-open', !wasOpen);
                trigger.setAttribute('aria-expanded', String(!wasOpen));
            });
            // Navegación opcional entre cabeceras (patrón Accordion APG)
            trigger.addEventListener('keydown', (e) => {
                const all = Array.from(cards).filter((c) => !c.hidden).map((c) => c.querySelector('.faq-trigger'));
                const i = all.indexOf(trigger);
                const go = (n) => { e.preventDefault(); all[(n + all.length) % all.length]?.focus(); };
                if (e.key === 'ArrowDown') go(i + 1);
                else if (e.key === 'ArrowUp') go(i - 1);
                else if (e.key === 'Home') go(0);
                else if (e.key === 'End') go(all.length - 1);
            });
        });
    };
    bindAccordions('faq-accordion');
    bindAccordions('faq-full-list');

    // ─── 7. BUSCADOR EN VIVO DE DUDAS (anuncio con role="status") ────────────
    const faqSearchInput = document.getElementById('faq-search-input');
    const faqFullList    = document.getElementById('faq-full-list');
    const faqCountEl     = document.getElementById('faq-search-count');
    const faqNoResults   = document.getElementById('faq-no-results');

    if (faqSearchInput && faqFullList) {
        const faqCards = Array.from(faqFullList.querySelectorAll('.faq-card'));
        // Búsqueda insensible a mayúsculas y tildes ("digestion" encuentra "digestión")
        const norm = (str) => str.normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
        const index = faqCards.map((c) => norm(c.dataset.query || c.textContent));
        let debounce;

        const run = () => {
            const query = norm(faqSearchInput.value.trim());
            let matches = 0;
            faqCards.forEach((card, i) => {
                const fits = !query || index[i].includes(query);
                card.hidden = !fits;
                if (fits) matches++;
            });
            if (faqNoResults) faqNoResults.hidden = matches !== 0;
            if (faqCountEl) {
                if (!query) faqCountEl.textContent = '';
                else if (matches === 0) faqCountEl.textContent = faqCountEl.dataset.none || '';
                else if (matches === 1) faqCountEl.textContent = faqCountEl.dataset.one || '';
                else faqCountEl.textContent = (faqCountEl.dataset.many || '{n}').replace('{n}', String(matches));
            }
        };
        // Debounce: el lector de pantalla anuncia el resultado final, no cada pulsación
        faqSearchInput.addEventListener('input', () => { clearTimeout(debounce); debounce = setTimeout(run, 300); });
        faqSearchInput.addEventListener('search', run);
    }

    // ─── 8. VALIDACIÓN ACCESIBLE DEL FORMULARIO DE CONTACTO ──────────────────
    const contactForm = document.getElementById('form-contacto');
    if (contactForm) {
        const submitBtn = document.getElementById('btn-submit');
        const summary = document.createElement('div');
        summary.className = 'form-alert-error';
        summary.setAttribute('role', 'alert');
        summary.tabIndex = -1;
        summary.hidden = true;
        contactForm.prepend(summary);

        const errorFor = (el) => {
            if (el.type === 'checkbox') return el.checked ? '' : tr('consent');
            const v = el.value.trim();
            if (!v) return tr('required');
            if (el.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v)) return tr('email');
            return '';
        };
        const setError = (el, message) => {
            const group = el.closest('.form-group') || el.parentElement;
            let err = group.querySelector('.field-error');
            if (message) {
                if (!err) {
                    err = document.createElement('p');
                    err.className = 'field-error';
                    err.id = `${el.id}-error`;
                    group.appendChild(err);
                }
                err.textContent = message;
                el.setAttribute('aria-invalid', 'true');
                el.setAttribute('aria-describedby', [...new Set([...(el.getAttribute('aria-describedby') || '').split(' ').filter(Boolean), err.id])].join(' '));
                el.classList.add('invalid');
            } else {
                err?.remove();
                el.removeAttribute('aria-invalid');
                el.setAttribute('aria-describedby', (el.getAttribute('aria-describedby') || '').split(' ').filter((x) => x && x !== `${el.id}-error`).join(' '));
                if (!el.getAttribute('aria-describedby')) el.removeAttribute('aria-describedby');
                el.classList.remove('invalid');
            }
        };

        const fields = Array.from(contactForm.querySelectorAll('[required]'));
        fields.forEach((el) => {
            el.addEventListener('blur', () => { if (el.value || el.type === 'checkbox') setError(el, errorFor(el)); });   // validación en vivo
            el.addEventListener('input', () => { if (el.getAttribute('aria-invalid') === 'true') setError(el, errorFor(el)); });
            el.addEventListener('change', () => { if (el.type === 'checkbox') setError(el, errorFor(el)); });
        });

        contactForm.addEventListener('submit', (e) => {
            let firstInvalid = null;
            const messages = [];
            fields.forEach((el) => {
                const msg = errorFor(el);
                setError(el, msg);
                if (msg) { messages.push(msg); firstInvalid ??= el; }
            });
            if (firstInvalid) {
                e.preventDefault();
                summary.hidden = false;
                summary.textContent = tr('errors');
                firstInvalid.focus();
            } else if (submitBtn) {
                summary.hidden = true;
                submitBtn.setAttribute('aria-disabled', 'true');
                // Evita doble envío sin sacar el botón del orden de tabulación
                submitBtn.addEventListener('click', (ev) => ev.preventDefault(), { once: false });
                const textSpan = submitBtn.querySelector('.btn-text');
                if (textSpan) textSpan.textContent = tr('sending');
            }
        });
    }
});

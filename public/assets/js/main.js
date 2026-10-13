/**
 * MÉTODO ESN — SCRIPT MAESTRO DE INTERACCIÓN (v3.0)
 * Microinteracciones · Accesibilidad · Rendimiento
 */

document.addEventListener('DOMContentLoaded', () => {
    // ─── 1. NAVBAR & MENÚ MÓVIL ──────────────────────────────────────────────
    const navToggle = document.getElementById('nav-toggle');
    const navMenu   = document.getElementById('nav-menu');
    const header    = document.getElementById('site-header');

    if (navToggle && navMenu) {
        const closeNav = () => {
            navMenu.classList.remove('is-open');
            navToggle.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('nav-menu-open');
        };

        navToggle.addEventListener('click', () => {
            const isOpen = navMenu.classList.toggle('is-open');
            navToggle.setAttribute('aria-expanded', String(isOpen));
            document.body.classList.toggle('nav-menu-open', isOpen);
        });

        // Cerrar menú al hacer clic en un enlace
        navMenu.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', closeNav);
        });

        // Cerrar al pulsar Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && navMenu.classList.contains('is-open')) {
                closeNav();
                navToggle.focus();
            }
        });

        // Cerrar al redimensionar a versión de escritorio
        window.addEventListener('resize', () => {
            if (window.innerWidth > 860 && navMenu.classList.contains('is-open')) {
                closeNav();
            }
        });
    }

    // Header sombra al hacer scroll
    if (header) {
        const handleScroll = () => {
            if (window.scrollY > 20) {
                header.classList.add('is-scrolled');
            } else {
                header.classList.remove('is-scrolled');
            }
        };
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    }

    // ─── 1b. SELECTOR DE IDIOMAS DESPLEGABLE ─────────────────────────────────
    const langDropdowns = document.querySelectorAll('.lang-dropdown');
    if (langDropdowns.length > 0) {
        langDropdowns.forEach((dropdown) => {
            const trigger = dropdown.querySelector('.lang-dropdown-trigger');
            if (!trigger) return;

            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                const willOpen = !dropdown.classList.contains('is-open');

                // Cerrar los demás
                langDropdowns.forEach((d) => {
                    d.classList.remove('is-open');
                    const t = d.querySelector('.lang-dropdown-trigger');
                    if (t) t.setAttribute('aria-expanded', 'false');
                });

                if (willOpen) {
                    dropdown.classList.add('is-open');
                    trigger.setAttribute('aria-expanded', 'true');
                }
            });
        });

        // Cerrar al hacer clic en cualquier parte fuera
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.lang-dropdown')) {
                langDropdowns.forEach((d) => {
                    d.classList.remove('is-open');
                    const t = d.querySelector('.lang-dropdown-trigger');
                    if (t) t.setAttribute('aria-expanded', 'false');
                });
            }
        });

        // Cerrar con Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                langDropdowns.forEach((d) => {
                    if (d.classList.contains('is-open')) {
                        d.classList.remove('is-open');
                        const t = d.querySelector('.lang-dropdown-trigger');
                        if (t) {
                            t.setAttribute('aria-expanded', 'false');
                            t.focus();
                        }
                    }
                });
            }
        });
    }

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

    // ─── 4. CARRUSEL INTERACTIVO AUTOMÁTICO DE TESTIMONIOS (HOME) ───────────
    const quotesCarousel = document.getElementById('quotes-carousel');
    if (quotesCarousel) {
        const track       = document.getElementById('quotes-track');
        const slides      = track ? Array.from(track.querySelectorAll('.quote-slide')) : [];
        const prevBtn     = document.getElementById('quotes-prev');
        const nextBtn     = document.getElementById('quotes-next');
        const counterCurr = quotesCarousel.querySelector('.quotes-current');
        const counterTot  = quotesCarousel.querySelector('.quotes-total');
        const indicators  = document.getElementById('quotes-indicators');
        const viewport    = document.getElementById('quotes-viewport');

        if (track && slides.length > 0) {
            let currentIndex = 0;
            let autoTimer = null;
            const AUTO_DELAY = 5500; // 5.5s para lectura cómoda de cada reseña

            // Calcular cuántas tarjetas son visibles a la vez según el ancho
            const getVisibleCount = () => {
                if (window.innerWidth <= 640) return 1;
                if (window.innerWidth <= 960) return 2;
                return 3;
            };

            const getMaxIndex = () => {
                return Math.max(0, slides.length - getVisibleCount());
            };

            // Crear dots / indicadores
            const renderIndicators = () => {
                if (!indicators) return;
                indicators.innerHTML = '';
                const max = getMaxIndex();
                for (let i = 0; i <= max; i++) {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.className = `quotes-indicator-dot${i === currentIndex ? ' is-active' : ''}`;
                    dot.setAttribute('role', 'tab');
                    dot.setAttribute('aria-label', `Ir a opinión ${i + 1}`);
                    dot.setAttribute('aria-selected', String(i === currentIndex));
                    dot.addEventListener('click', () => {
                        goToIndex(i);
                        startAutoplay();
                    });
                    indicators.appendChild(dot);
                }
            };

            // Mover el carrusel al índice dado
            const goToIndex = (target) => {
                const max = getMaxIndex();
                if (target < 0) {
                    currentIndex = max; // Ciclo hacia el final
                } else if (target > max) {
                    currentIndex = 0;   // Ciclo al inicio
                } else {
                    currentIndex = target;
                }

                // Cálculo de desplazamiento
                const firstSlide = slides[0];
                const trackStyles = window.getComputedStyle(track);
                const gap = parseFloat(trackStyles.gap) || 24;
                const slideWidth = firstSlide.getBoundingClientRect().width;
                const offset = currentIndex * (slideWidth + gap);

                track.style.transform = `translateX(-${offset}px)`;

                // Actualizar contador y accesibilidad
                if (counterCurr) {
                    counterCurr.textContent = String(currentIndex + 1);
                }
                if (counterTot) {
                    counterTot.textContent = String(slides.length);
                }

                // Actualizar dots
                if (indicators) {
                    const dots = indicators.querySelectorAll('.quotes-indicator-dot');
                    dots.forEach((dot, idx) => {
                        const isActive = idx === currentIndex;
                        dot.classList.toggle('is-active', isActive);
                        dot.setAttribute('aria-selected', String(isActive));
                    });
                }
            };

            // Siguiente y Anterior
            const nextSlide = () => goToIndex(currentIndex + 1);
            const prevSlide = () => goToIndex(currentIndex - 1);

            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    nextSlide();
                    startAutoplay();
                });
            }
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    prevSlide();
                    startAutoplay();
                });
            }

            // Autoplay cíclico
            const startAutoplay = () => {
                stopAutoplay();
                autoTimer = setInterval(nextSlide, AUTO_DELAY);
            };

            const stopAutoplay = () => {
                if (autoTimer) {
                    clearInterval(autoTimer);
                    autoTimer = null;
                }
            };

            // Pausa inteligente al interactuar (hover, foco, toque)
            quotesCarousel.addEventListener('mouseenter', stopAutoplay);
            quotesCarousel.addEventListener('mouseleave', startAutoplay);
            quotesCarousel.addEventListener('focusin', stopAutoplay);
            quotesCarousel.addEventListener('focusout', startAutoplay);

            // Soporte para gestos táctiles (Swipe en móvil)
            let touchStartX = 0;
            let touchEndX = 0;

            if (viewport) {
                viewport.addEventListener('touchstart', (e) => {
                    stopAutoplay();
                    touchStartX = e.changedTouches[0].screenX;
                }, { passive: true });

                viewport.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    const diff = touchStartX - touchEndX;
                    if (Math.abs(diff) > 40) {
                        if (diff > 0) {
                            nextSlide(); // Deslizar hacia la izquierda = avanzar
                        } else {
                            prevSlide(); // Deslizar hacia la derecha = retroceder
                        }
                    }
                    startAutoplay();
                }, { passive: true });
            }

            // Teclado (accesibilidad)
            quotesCarousel.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowRight') {
                    nextSlide();
                    startAutoplay();
                } else if (e.key === 'ArrowLeft') {
                    prevSlide();
                    startAutoplay();
                }
            });

            // Reajustar en redimensionamiento
            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    renderIndicators();
                    goToIndex(Math.min(currentIndex, getMaxIndex()));
                }, 150);
            });

            // Inicialización
            renderIndicators();
            goToIndex(0);
            startAutoplay();
        }
    }

    // ─── 6. ACORDEÓN ACCESIBLE UNIVERSAL (HOME & DUDAS) ──────────────────────
    const bindAccordions = (containerId) => {
        const container = document.getElementById(containerId);
        if (!container) return;

        const cards = container.querySelectorAll('.faq-card');
        cards.forEach((card) => {
            const trigger = card.querySelector('.faq-trigger');
            if (!trigger) return;

            trigger.addEventListener('click', () => {
                const isOpen = card.classList.contains('is-open');

                // Si queremos que se cierre el resto en ese contenedor:
                cards.forEach((other) => {
                    if (other !== card) {
                        other.classList.remove('is-open');
                        const otherBtn = other.querySelector('.faq-trigger');
                        if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
                    }
                });

                card.classList.toggle('is-open', !isOpen);
                trigger.setAttribute('aria-expanded', String(!isOpen));
            });
        });
    };

    bindAccordions('faq-accordion');
    bindAccordions('faq-full-list');

    // ─── 7. BUSCADOR EN VIVO DE DUDAS (DUDAS.PHP) ─────────────────────────────
    const faqSearchInput = document.getElementById('faq-search-input');
    const faqFullList    = document.getElementById('faq-full-list');
    const faqCountEl     = document.getElementById('faq-search-count');
    const faqNoResults   = document.getElementById('faq-no-results');

    if (faqSearchInput && faqFullList) {
        const faqCards = faqFullList.querySelectorAll('.faq-card');

        faqSearchInput.addEventListener('input', (e) => {
            const query = e.target.value.trim().toLowerCase();
            let matches = 0;

            faqCards.forEach((card) => {
                const content = card.dataset.query || card.textContent.toLowerCase();
                const fits = !query || content.includes(query);
                card.style.display = fits ? '' : 'none';
                if (fits) matches++;
            });

            if (faqNoResults) {
                faqNoResults.style.display = matches === 0 ? 'block' : 'none';
            }

            if (faqCountEl) {
                faqCountEl.textContent = query
                    ? `${matches} pregunta${matches !== 1 ? 's' : ''} encontrada${matches !== 1 ? 's' : ''}`
                    : '';
            }
        });
    }

    // ─── 8. VALIDACIÓN DEL FORMULARIO DE CONTACTO ─────────────────────────────
    const contactForm = document.getElementById('form-contacto');
    if (contactForm) {
        const submitBtn = document.getElementById('btn-submit');

        contactForm.addEventListener('submit', (e) => {
            let valid = true;
            let firstInvalid = null;

            contactForm.querySelectorAll('[required]').forEach((el) => {
                let bad = false;
                if (el.type === 'checkbox') {
                    bad = !el.checked;
                } else if (el.type === 'email') {
                    bad = !el.value.trim() || !el.value.includes('@') || !el.value.includes('.');
                } else {
                    bad = !el.value.trim();
                }

                el.classList.toggle('invalid', bad);
                if (bad) {
                    valid = false;
                    if (!firstInvalid) firstInvalid = el;
                }
            });

            if (!valid) {
                e.preventDefault();
                if (firstInvalid) firstInvalid.focus();
            } else if (submitBtn) {
                submitBtn.disabled = true;
                const textSpan = submitBtn.querySelector('.btn-text');
                if (textSpan) textSpan.textContent = 'Enviando mensaje...';
            }
        });

        // Limpiar error al escribir
        contactForm.querySelectorAll('input, textarea').forEach((el) => {
            el.addEventListener('input', () => {
                if (el.classList.contains('invalid')) {
                    el.classList.remove('invalid');
                }
            });
        });
    }
});

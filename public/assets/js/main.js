document.addEventListener('DOMContentLoaded', () => {
    // ─── Menú móvil ───────────────────────────────────────────────────────────
    const toggle = document.querySelector('.nav-toggle');
    const nav = document.getElementById('nav');
    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            const open = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', String(open));
        });
    }

    // ─── Banner de cookies ────────────────────────────────────────────────────
    const KEY = 'esn_cookies';
    const banner = document.getElementById('cookie');
    const store = {
        get: () => { try { return localStorage.getItem(KEY); } catch { return null; } },
        set: (v) => { try { localStorage.setItem(KEY, v); } catch {} },
        del: () => { try { localStorage.removeItem(KEY); } catch {} },
    };
    if (banner) {
        banner.hidden = store.get() !== null;
        banner.querySelectorAll('[data-cookie]').forEach((btn) => {
            btn.addEventListener('click', () => {
                store.set(btn.dataset.cookie);
                banner.hidden = true;
            });
        });
    }
    const reset = document.getElementById('cookie-reset');
    if (reset && banner) {
        reset.addEventListener('click', () => { store.del(); banner.hidden = false; });
    }

    // ─── Validación y feedback del formulario de contacto ─────────────────────
    const form = document.getElementById('form-contacto');
    if (form) {
        const submitBtn = form.querySelector('#btn-submit');

        // Limpiar estado inválido mientras el usuario escribe
        form.querySelectorAll('input, textarea').forEach(el => {
            el.addEventListener('input', () => {
                if (el.classList.contains('invalid')) {
                    const bad = el.type === 'checkbox' ? !el.checked : !el.value.trim();
                    if (!bad) el.classList.remove('invalid');
                }
            });
            if (el.type === 'checkbox') {
                el.addEventListener('change', () => {
                    if (el.checked) el.classList.remove('invalid');
                });
            }
        });

        form.addEventListener('submit', (e) => {
            let valid = true;
            let firstInvalid = null;

            form.querySelectorAll('[required]').forEach((el) => {
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
                // Feedback visual de envío y protección contra doble click
                submitBtn.disabled = true;
                const btnText = submitBtn.querySelector('.btn-text');
                if (btnText) btnText.textContent = 'Enviando mensaje...';
                // Si la validación nativa del form pasa, submit se procesa normalmente
                form.submit();
            }
        });
    }

    // ─── Preferencias de accesibilidad y detección de entorno ───────────────
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const isDesktop = window.matchMedia('(hover: hover) and (min-width: 861px)').matches;

    // ─── 1. Lenis Smooth Scroll sincronizado con GSAP ────────────────────────
    let lenis = null;
    if (typeof Lenis !== 'undefined' && !prefersReduced) {
        lenis = new Lenis({
            duration: 1.15,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            orientation: 'vertical',
            gestureOrientation: 'vertical',
            smoothWheel: true,
            wheelMultiplier: 0.95,
            touchMultiplier: 1.4,
            infinite: false
        });

        // Sincronización con GSAP ScrollTrigger
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
            lenis.on('scroll', ScrollTrigger.update);
            gsap.ticker.add((time) => {
                lenis.raf(time * 1000);
            });
            gsap.ticker.lagSmoothing(0);
        } else {
            const raf = (time) => {
                lenis.raf(time);
                requestAnimationFrame(raf);
            };
            requestAnimationFrame(raf);
        }

        // Desplazamiento cinemático en enlaces ancla
        document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach((anchor) => {
            anchor.addEventListener('click', (e) => {
                const targetId = anchor.getAttribute('href');
                if (targetId && targetId !== '#') {
                    const targetEl = document.querySelector(targetId);
                    if (targetEl) {
                        e.preventDefault();
                        lenis.scrollTo(targetEl, { offset: -80, duration: 1.2 });
                    }
                }
            });
        });
    }

    // ─── 2. GSAP Motion Design & ScrollTrigger ──────────────────────────────
    if (typeof gsap !== 'undefined') {
        if (typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
        }

        if (!prefersReduced) {
            // Parallax vertical sutil en el Hero al scrollear
            const heroSection = document.querySelector('.hero');
            const heroMedia   = document.querySelector('.hero-media');
            if (heroSection && heroMedia) {
                const imgB = heroMedia.querySelector('.hero-img-b');
                const statBadge = heroMedia.querySelector('.hero-floating-stat');

                if (imgB) {
                    gsap.to(imgB, {
                        y: 45,
                        ease: 'none',
                        scrollTrigger: {
                            trigger: heroSection,
                            start: 'top top',
                            end: 'bottom top',
                            scrub: 1.2
                        }
                    });
                }
                if (statBadge) {
                    gsap.to(statBadge, {
                        y: -30,
                        ease: 'none',
                        scrollTrigger: {
                            trigger: heroSection,
                            start: 'top top',
                            end: 'bottom top',
                            scrub: 1.5
                        }
                    });
                }
            }

            // Timeline interactivo con Scrub (Home y Servicios)
            const timelines = document.querySelectorAll('.timeline');
            timelines.forEach((tl) => {
                const progress = tl.querySelector('.timeline-progress');
                const stepItems = tl.querySelectorAll('.steps li');

                if (progress && stepItems.length) {
                    if (window.matchMedia('(min-width: 721px)').matches) {
                        ScrollTrigger.create({
                            trigger: tl,
                            start: 'top 75%',
                            end: 'bottom 55%',
                            scrub: 0.8,
                            onUpdate: (self) => {
                                const p = self.progress;
                                progress.style.width = `${Math.min(100, Math.max(0, p * 100))}%`;
                                
                                // Iluminar cada nodo secuencialmente
                                stepItems.forEach((item, idx) => {
                                    const threshold = idx / (stepItems.length - 1 || 1);
                                    if (p >= threshold * 0.9) {
                                        item.classList.add('is-active');
                                    } else {
                                        item.classList.remove('is-active');
                                    }
                                });
                            }
                        });
                    } else {
                        // En móvil o pantallas angostas
                        ScrollTrigger.create({
                            trigger: tl,
                            start: 'top 85%',
                            once: true,
                            onEnter: () => {
                                tl.classList.add('line-drawn');
                                stepItems.forEach((item, i) => {
                                    setTimeout(() => item.classList.add('is-active'), i * 160);
                                });
                            }
                        });
                    }
                }
            });

            // Animación Count-Up para contadores y reputación clínica
            const statNums = document.querySelectorAll('.stat-num');
            statNums.forEach((el) => {
                if (el.textContent.includes('50')) {
                    const counter = { val: 0 };
                    gsap.to(counter, {
                        val: 50,
                        duration: 1.8,
                        ease: 'power2.out',
                        scrollTrigger: {
                            trigger: el,
                            start: 'top 92%',
                            once: true
                        },
                        onUpdate: () => {
                            el.textContent = Math.floor(counter.val) + '+';
                        }
                    });
                }
            });

            const scoreNums = document.querySelectorAll('.score-number');
            scoreNums.forEach((el) => {
                const target = parseFloat(el.textContent) || 5.0;
                const counter = { val: 0.0 };
                gsap.to(counter, {
                    val: target,
                    duration: 2.0,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 92%',
                        once: true
                    },
                    onUpdate: () => {
                        el.textContent = counter.val.toFixed(1);
                    }
                });
            });

            // Animación Stagger suave para tarjetas principales
            const staggerConfigs = [
                { items: '.bento-areas .area-card', trigger: '.bento-areas' },
                { items: '.services-grid .service-card', trigger: '.services-grid' },
                { items: '.quotes .quote-card', trigger: '.quotes' },
                { items: '.principles .principle', trigger: '.principles' },
                { items: '.booking-steps .booking-step', trigger: '.booking-steps' }
            ];

            staggerConfigs.forEach(({ items, trigger }) => {
                const elements = document.querySelectorAll(items);
                const triggerEl = document.querySelector(trigger);
                if (elements.length && triggerEl) {
                    gsap.from(elements, {
                        y: 30,
                        opacity: 0,
                        duration: 0.85,
                        stagger: 0.12,
                        ease: 'power2.out',
                        scrollTrigger: {
                            trigger: triggerEl,
                            start: 'top 85%',
                            once: true
                        },
                        onComplete: () => {
                            // Asegura estado de visibilidad al terminar
                            elements.forEach(el => el.classList.add('is-visible'));
                        }
                    });
                }
            });
        }
    }

    // ─── 3. Scroll Reveal nativo / fallback con IntersectionObserver ──────────
    const revealEls = document.querySelectorAll('.reveal, .reveal-scale');
    if (revealEls.length && 'IntersectionObserver' in window) {
        const revealObs = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        revealEls.forEach(el => revealObs.observe(el));
    } else {
        revealEls.forEach(el => el.classList.add('is-visible'));
    }

    // Fallback de timeline si GSAP no estuviera disponible
    if (typeof gsap === 'undefined') {
        const timelines = document.querySelectorAll('.timeline');
        if (timelines.length && 'IntersectionObserver' in window) {
            const lineObs = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setTimeout(() => entry.target.classList.add('line-drawn'), 200);
                        lineObs.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.25 });
            timelines.forEach(tl => lineObs.observe(tl));
        }
    }

    // ─── 4. VanillaTilt — Inclinación 3D háptica con reflejo de cristal ──────
    if (typeof VanillaTilt !== 'undefined' && !prefersReduced && isDesktop) {
        const tiltTargets = document.querySelectorAll(
            '.area-card, .service-card, .quote-card, .doctoralia-score-card, .booking-step, .clinic-card-main, .contact-card'
        );
        if (tiltTargets.length) {
            VanillaTilt.init(tiltTargets, {
                max: 6,
                speed: 800,
                glare: true,
                'max-glare': 0.12,
                scale: 1.015,
                perspective: 1200,
                gyroscope: false
            });
        }
    }

    // ─── 5. Buscador FAQ en tiempo real ───────────────────────────────────────
    const faqInput  = document.getElementById('faq-input');
    const faqClear  = document.getElementById('faq-clear');
    const faqCount  = document.getElementById('faq-count');
    const faqEmpty  = document.getElementById('faq-empty');
    const faqItems  = document.querySelectorAll('.faq-item');

    if (faqInput && faqItems.length) {
        faqItems.forEach(item => {
            const span = item.querySelector('summary span:first-child');
            if (span) item.dataset.originalText = span.textContent;
        });

        function filterFAQ(query) {
            const q = query.trim().toLowerCase();
            let visible = 0;

            faqItems.forEach(item => {
                const haystack = item.dataset.question || '';
                const match    = !q || haystack.includes(q);
                item.hidden = !match;
                if (match) {
                    visible++;
                    const span = item.querySelector('summary span:first-child');
                    if (span) {
                        if (q) {
                            const original = item.dataset.originalText;
                            const re = new RegExp(`(${q.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
                            span.innerHTML = original.replace(re, '<mark class="faq-mark">$1</mark>');
                        } else {
                            span.textContent = item.dataset.originalText;
                        }
                    }
                }
            });

            if (faqCount) {
                faqCount.textContent = q
                    ? `${visible} pregunta${visible !== 1 ? 's' : ''} encontrada${visible !== 1 ? 's' : ''}`
                    : '';
            }
            if (faqEmpty) faqEmpty.hidden = visible > 0;
            if (faqClear) faqClear.hidden = !q;
        }

        faqInput.addEventListener('input', () => filterFAQ(faqInput.value));

        if (faqClear) {
            faqClear.addEventListener('click', () => {
                faqInput.value = '';
                faqInput.focus();
                filterFAQ('');
            });
        }
    }

    // ─── 6. Hero: Micro-parallax suave con ratón (escritorio) ────────────────
    const heroSection = document.querySelector('.hero');
    const heroMedia   = document.querySelector('.hero-media');

    if (heroSection && heroMedia && !prefersReduced && isDesktop) {
        const imgA = heroMedia.querySelector('.hero-img-a');
        const imgB = heroMedia.querySelector('.hero-img-b');

        heroSection.addEventListener('mousemove', (e) => {
            const rect = heroMedia.getBoundingClientRect();
            const cx = rect.left + rect.width  / 2;
            const cy = rect.top  + rect.height / 2;
            const dx = (e.clientX - cx) / (rect.width  / 2);
            const dy = (e.clientY - cy) / (rect.height / 2);

            if (imgA) imgA.style.transform = `translate(${dx * -4}px, ${dy * -3}px)`;
            if (imgB) imgB.style.transform = `translate(${dx *  6}px, ${dy *  4}px)`;
        });

        heroSection.addEventListener('mouseleave', () => {
            if (imgA) imgA.style.transform = '';
            if (imgB) imgB.style.transform = '';
        });
    }
});

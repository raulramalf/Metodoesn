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

    // ─── Scroll reveal (IntersectionObserver) ────────────────────────────────
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
        // Fallback: mostrar todo sin animación
        revealEls.forEach(el => el.classList.add('is-visible'));
    }

    // ─── Timeline: dibuja la línea al entrar en viewport (todas las páginas) ──
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

    // ─── Buscador FAQ en tiempo real ──────────────────────────────────────────
    const faqInput  = document.getElementById('faq-input');
    const faqClear  = document.getElementById('faq-clear');
    const faqCount  = document.getElementById('faq-count');
    const faqEmpty  = document.getElementById('faq-empty');
    const faqItems  = document.querySelectorAll('.faq-item');

    if (faqInput && faqItems.length) {

        // Guarda el texto original de cada summary para restaurarlo
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
                    // Highlight en la pregunta
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

            // Contador y mensaje vacío
            if (faqCount) {
                faqCount.textContent = q
                    ? `${visible} pregunta${visible !== 1 ? 's' : ''} encontrada${visible !== 1 ? 's' : ''}`
                    : '';
            }
            if (faqEmpty) faqEmpty.hidden = visible > 0;

            // Botón clear
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

    // ─── Hero: parallax suave al mover el ratón (solo escritorio) ────────────
    const heroSection = document.querySelector('.hero');
    const heroMedia   = document.querySelector('.hero-media');
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (heroSection && heroMedia && !prefersReduced &&
        window.matchMedia('(hover: hover) and (min-width: 861px)').matches) {

        const imgA = heroMedia.querySelector('.hero-img-a');
        const imgB = heroMedia.querySelector('.hero-img-b');

        heroSection.addEventListener('mousemove', (e) => {
            const rect = heroMedia.getBoundingClientRect();
            const cx = rect.left + rect.width  / 2;
            const cy = rect.top  + rect.height / 2;
            const dx = (e.clientX - cx) / (rect.width  / 2);   // -1 … 1
            const dy = (e.clientY - cy) / (rect.height / 2);   // -1 … 1

            if (imgA) imgA.style.transform = `translate(${dx * -5}px, ${dy * -3}px)`;
            if (imgB) imgB.style.transform = `translate(${dx *  8}px, ${dy *  5}px)`;
        });

        heroSection.addEventListener('mouseleave', () => {
            if (imgA) imgA.style.transform = '';
            if (imgB) imgB.style.transform = '';
        });
    }
});

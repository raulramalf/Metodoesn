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

    // ─── Validación básica del formulario de contacto ─────────────────────────
    const form = document.getElementById('form-contacto');
    if (form) {
        form.addEventListener('submit', (e) => {
            let valid = true;
            form.querySelectorAll('[required]').forEach((el) => {
                const bad = el.type === 'checkbox' ? !el.checked : !el.value.trim();
                el.classList.toggle('invalid', bad);
                if (bad) valid = false;
            });
            if (!valid) e.preventDefault();
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

document.addEventListener('DOMContentLoaded', () => {
    // Menú móvil
    const toggle = document.querySelector('.nav-toggle');
    const nav = document.getElementById('nav');
    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            const open = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', String(open));
        });
    }

    // Banner de cookies
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

    // Validación básica del formulario de contacto
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
});

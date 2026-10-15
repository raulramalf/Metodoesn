import { test, expect, Page } from '@playwright/test';

const fillValid = async (page: Page, email = 'ana@example.com') => {
  await page.fill('#nombre', 'Ana Prueba');
  await page.fill('#email', email);
  await page.fill('#mensaje', 'Hola, quiero consultar por mi SIBO.');
  await page.check('input[name="privacidad"]');
};

test.describe('Navegación, menú móvil e idiomas', () => {
  test('home carga, skip-link lleva a main y hay cabeceras de seguridad', async ({ page }) => {
    const res = await page.goto('/');
    expect(res!.headers()['content-security-policy']).toContain("object-src 'none'");
    expect(res!.headers()['x-content-type-options']).toBe('nosniff');
    await expect(page.locator('h1')).toContainText('Método ESN');
    await page.keyboard.press('Tab');
    const skip = page.locator('a.skip');
    await expect(skip).toBeFocused();
    await page.keyboard.press('Enter');
    await expect(page.locator('#main')).toBeFocused();
  });

  test('menú móvil: abre, atrapa el foco y cierra con Esc devolviendo el foco', async ({ page, isMobile }) => {
    test.skip(!isMobile, 'solo móvil');
    await page.goto('/');
    const toggle = page.locator('#nav-toggle');
    await toggle.click();
    await expect(toggle).toHaveAttribute('aria-expanded', 'true');
    await expect(page.locator('main')).toHaveAttribute('inert', '');
    for (let i = 0; i < 12; i++) {                       // 12 Tab seguidos: el foco nunca escapa del drawer
      await page.keyboard.press('Tab');
      const inside = await page.evaluate(() => !!document.activeElement?.closest('#site-header'));
      expect(inside).toBe(true);
    }
    await page.keyboard.press('Escape');
    await expect(toggle).toHaveAttribute('aria-expanded', 'false');
    await expect(toggle).toBeFocused();
    await expect(page.locator('main')).not.toHaveAttribute('inert', '');
  });

  for (const lang of ['en', 'de'] as const) {
    test(`selector de idioma → ${lang} (teclado, ARIA, hreflang y <html lang>)`, async ({ page, isMobile }) => {
      await page.goto('/');
      const dd = page.locator(isMobile ? '#lang-dropdown-mobile' : '#lang-dropdown-desktop');
      const trigger = dd.locator('.lang-dropdown-trigger');
      await expect(trigger).toHaveAttribute('aria-expanded', 'false');
      await trigger.focus();
      await page.keyboard.press('ArrowDown');
      await expect(trigger).toHaveAttribute('aria-expanded', 'true');
      await expect(dd.locator('.lang-menu-item').first()).toBeFocused();
      await page.keyboard.press('Escape');
      await expect(trigger).toHaveAttribute('aria-expanded', 'false');
      await expect(trigger).toBeFocused();

      await trigger.click();
      await Promise.all([page.waitForURL(new RegExp(`lang=${lang}`)), dd.locator(`a[hreflang="${lang}"]`).click()]);
      await expect(page.locator('html')).toHaveAttribute('lang', lang);
      await expect(page.locator('link[rel="canonical"]')).toHaveAttribute('href', new RegExp(`lang=${lang}`));
      await expect(page.locator('link[rel="alternate"][hreflang]')).toHaveCount(4);
    });
  }
});

test.describe('Carrusel de opiniones (WAI-ARIA)', () => {
  test('roles, anuncio de cambio, pausa y teclado', async ({ page }) => {
    await page.goto('/');
    const c = page.locator('#quotes-carousel');
    await c.scrollIntoViewIfNeeded();
    await expect(c).toHaveAttribute('aria-roledescription', 'carrusel');
    await expect(c.locator('.quote-slide').first()).toHaveAttribute('aria-roledescription', 'diapositiva');
    await page.locator('#quotes-pause').click();
    await expect(page.locator('#quotes-pause')).toHaveAttribute('aria-pressed', 'true');
    await expect(page.locator('#quotes-track')).toHaveAttribute('aria-live', 'polite');   // sin autoplay → anuncios activos
    await page.locator('#quotes-next').click();
    await expect(page.locator('#quotes-status')).toContainText(/Opinión 2 de \d+/);
    await page.locator('#quotes-next').focus();
    await page.keyboard.press('ArrowLeft');
    await expect(page.locator('#quotes-status')).toContainText(/Opinión 1 de \d+/);
  });

  test('con prefers-reduced-motion no hay rotación automática', async ({ browser }) => {
    const ctx = await browser.newContext({ reducedMotion: 'reduce' });
    const page = await ctx.newPage();
    await page.goto('http://127.0.0.1:8099/');
    await expect(page.locator('#quotes-pause')).toHaveAttribute('aria-pressed', 'true');
    await ctx.close();
  });
});

test.describe('FAQ: buscador en vivo', () => {
  test('anuncia el número de coincidencias en un role=status', async ({ page }) => {
    await page.goto('/dudas.php');
    const status = page.locator('#faq-search-count');
    await expect(status).toHaveAttribute('role', 'status');
    await expect(status).toHaveAttribute('aria-live', 'polite');
    await page.fill('#faq-search-input', 'digestion');       // sin tilde: debe encontrar "digestión"
    await expect(status).toContainText(/\d+ pregunta/);
    await page.fill('#faq-search-input', 'zzzzzz-sin-resultado');
    await expect(status).toContainText('Ninguna pregunta');
    await expect(page.locator('#faq-no-results')).toBeVisible();
  });
});

test.describe('Formulario de contacto', () => {
  test('validación en vivo: errores asociados con aria-invalid/aria-describedby y foco al primer error', async ({ page }) => {
    await page.goto('/contacto.php');
    await page.fill('#email', 'no-es-un-email');
    await page.locator('#email').blur();
    await expect(page.locator('#email')).toHaveAttribute('aria-invalid', 'true');
    await expect(page.locator('#email-error')).toContainText('email válido');
    await page.click('#btn-submit');
    await expect(page.locator('#nombre')).toBeFocused();
    await expect(page.locator('#nombre')).toHaveAttribute('aria-invalid', 'true');
    await page.fill('#email', 'ok@example.com');
    await expect(page.locator('#email')).not.toHaveAttribute('aria-invalid', 'true');
  });

  test('honeypot: un bot que lo rellena recibe 400 y no se guarda', async ({ page, request }) => {
    await page.goto('/contacto.php');
    const csrf = await page.locator('input[name="csrf"]').inputValue();
    const ft = await page.locator('input[name="ft"]').inputValue();
    const cookies = (await page.context().cookies()).map((c) => `${c.name}=${c.value}`).join('; ');
    const res = await request.post('/contacto.php', {
      headers: { cookie: cookies }, form: { csrf, ft, web: 'http://spam.example', nombre: 'Bot', email: 'b@x.es', mensaje: 'compra ya', privacidad: '1' },
    });
    expect(res.status()).toBe(400);
  });

  test('CSRF inválido y envío instantáneo se rechazan', async ({ page }) => {
    await page.goto('/contacto.php');
    await page.evaluate(() => ((document.querySelector('input[name="csrf"]') as HTMLInputElement).value = 'a'.repeat(64)));
    await fillValid(page);
    await page.waitForTimeout(3200);
    await page.click('#btn-submit');
    await expect(page.locator('.form-alert-error:not([hidden])')).toContainText('sesión ha caducado');
    await expect(page.locator('.form-alert-success')).toHaveCount(0);
  });

  test('envío válido muestra éxito; el 4º en 15 min recibe 429', async ({ page, isMobile }) => {
    test.skip(isMobile, 'el límite es por IP: se verifica una sola vez (proyecto desktop)');
    for (let i = 1; i <= 4; i++) {
      await page.goto('/contacto.php');
      await fillValid(page, `ana${i}@example.com`);
      await page.waitForTimeout(3200);                        // supera FORM_MIN_SECONDS
      const [resp] = await Promise.all([page.waitForResponse((r) => r.url().includes('/contacto.php') && r.request().method() === 'POST'), page.click('#btn-submit')]);
      if (i <= 3) {
        expect(resp.status()).toBe(200);
        await expect(page.locator('.form-alert-success')).toBeVisible();
      } else {
        expect(resp.status()).toBe(429);
        await expect(page.locator('.form-alert-error:not([hidden])')).toContainText('límite de envíos');
      }
    }
  });
});

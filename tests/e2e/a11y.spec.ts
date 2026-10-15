import { test, expect } from '@playwright/test';
import AxeBuilder from '@axe-core/playwright';

const pages = ['/', '/servicios.php', '/quienes-somos.php', '/dudas.php', '/contacto.php', '/reserva-de-citas.php', '/politica-de-privacidad.php'];
const langs = ['', '?lang=en', '?lang=de'];

for (const p of pages) {
  for (const l of langs) {
    test(`axe WCAG 2.2 AA · ${p}${l}`, async ({ page }, info) => {
      await page.goto(p + l);
      await page.waitForLoadState('networkidle').catch(() => {});
      const results = await new AxeBuilder({ page })
        .withTags(['wcag2a', 'wcag2aa', 'wcag21a', 'wcag21aa', 'wcag22aa', 'best-practice'])
        .exclude('iframe')                                    // widgets de terceros (Doctoralia/Maps) quedan fuera de nuestro control
        .analyze();

      const report = results.violations.map((v) => ({
        id: v.id, impact: v.impact, help: v.help, nodes: v.nodes.slice(0, 3).map((n) => n.target.join(' ')), url: v.helpUrl,
      }));
      await info.attach('axe-violations.json', { body: JSON.stringify(report, null, 2), contentType: 'application/json' });
      if (report.length) console.log(`\n[axe] ${p}${l}\n` + JSON.stringify(report, null, 2));
      expect(results.violations.filter((v) => ['critical', 'serious'].includes(v.impact ?? '')), 'violaciones critical/serious').toEqual([]);
    });
  }
}

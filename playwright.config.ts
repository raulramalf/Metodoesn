import { defineConfig, devices } from '@playwright/test';

const PORT = 8099;
export default defineConfig({
  testDir: 'tests/e2e',
  timeout: 30_000,
  fullyParallel: false,       // el rate limit (3/15 min por IP) es estado compartido
  workers: 1,
  retries: process.env.CI ? 1 : 0,
  reporter: [['list'], ['html', { open: 'never' }]],
  use: { baseURL: `http://127.0.0.1:${PORT}`, trace: 'on-first-retry' },
  webServer: {
    // BD y clave efímeras para no tocar data/ ni acumular límites entre ejecuciones
    command: `ESN_APP_KEY=$(php -r 'echo bin2hex(random_bytes(32));') php -S 127.0.0.1:${PORT} -t public`,
    url: `http://127.0.0.1:${PORT}/`,
    reuseExistingServer: !process.env.CI,
    timeout: 20_000,
    stdout: 'ignore',
    stderr: 'ignore',
  },
  projects: [
    { name: 'desktop', use: { ...devices['Desktop Chrome'], launchOptions: { executablePath: process.env.CHROMIUM_PATH || undefined } } },
    { name: 'mobile', use: { ...devices['Pixel 7'], launchOptions: { executablePath: process.env.CHROMIUM_PATH || undefined } } },
  ],
});

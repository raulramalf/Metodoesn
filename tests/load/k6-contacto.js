// k6 run -e BASE=http://127.0.0.1:8099 tests/load/k6-contacto.js
// Objetivo: verificar que SQLite en modo WAL + busy_timeout soporta escrituras concurrentes sin "database is locked" (HTTP 500).
// Cada VU simula una IP distinta mediante X-Forwarded-For: requiere TRUSTED_PROXIES con la IP del origen del test
// (en config.php: define('TRUSTED_PROXIES', ['127.0.0.1']) SOLO en el entorno de pruebas de carga).
import http from 'k6/http';
import { check, sleep } from 'k6';
import { Counter } from 'k6/metrics';

const BASE = __ENV.BASE || 'http://127.0.0.1:8099';
const locked = new Counter('db_locked_5xx');

export const options = {
  scenarios: {
    lectura: { executor: 'constant-arrival-rate', rate: 80, timeUnit: '1s', duration: '60s', preAllocatedVUs: 50, exec: 'leer' },
    escritura: { executor: 'ramping-arrival-rate', startRate: 1, timeUnit: '1s', preAllocatedVUs: 50, maxVUs: 150, exec: 'escribir',
      stages: [{ target: 20, duration: '20s' }, { target: 40, duration: '30s' }, { target: 0, duration: '10s' }] },
  },
  thresholds: {
    'http_req_duration{scenario:lectura}': ['p(95)<500'],
    'http_req_failed{scenario:lectura}': ['rate<0.01'],
    db_locked_5xx: ['count==0'],                       // NINGÚN 5xx por bloqueo de escritura
    'checks{check:sin 5xx}': ['rate==1'],
  },
};

export function leer() {
  const r = http.get(`${BASE}/`);
  check(r, { 'home 200': (x) => x.status === 200 });
}

export function escribir() {
  const ip = `10.${__VU % 250}.${Math.floor(__ITER / 250) % 250}.${(__ITER % 250) + 1}`;
  const jar = http.cookieJar();
  const page = http.get(`${BASE}/contacto.php`, { headers: { 'X-Forwarded-For': ip } });
  const csrf = page.html().find('input[name=csrf]').attr('value');
  const ft = page.html().find('input[name=ft]').attr('value');
  sleep(3.2);                                          // supera FORM_MIN_SECONDS
  const res = http.post(`${BASE}/contacto.php`, { csrf, ft, nombre: `VU${__VU}`, email: `vu${__VU}-${__ITER}@example.com`, mensaje: 'Mensaje de prueba de carga con más de cinco caracteres', privacidad: '1' }, { headers: { 'X-Forwarded-For': ip } });
  if (res.status >= 500) locked.add(1);
  check(res, { 'sin 5xx': (r) => r.status < 500, 'ok o limitado': (r) => [200, 429].includes(r.status) }, { check: 'sin 5xx' });
  jar.clear(BASE);
}

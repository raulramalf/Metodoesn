#!/usr/bin/env bash
# Prueba de concurrencia con Apache Benchmark.  Uso: tests/load/ab-contacto.sh [BASE_URL]
# 1) Lectura masiva de la home; 2) POST concurrente al formulario con un token inválido (ejercita CSRF/validación
#    sin llenar la BD); 3) comprueba WAL y ausencia de 5xx.
set -euo pipefail
BASE="${1:-http://127.0.0.1:8099}"
DB="$(dirname "$0")/../../data/metodoesn.sqlite"
command -v ab >/dev/null || { echo "Instala apache2-utils (ab)"; exit 1; }

echo "== 1. Lectura: 2000 peticiones, 50 concurrentes"
ab -q -n 2000 -c 50 "$BASE/" | grep -E "Requests per second|Failed requests|Non-2xx|95%|99%"

echo "== 2. POST concurrente (validación + CSRF, 500 peticiones, 25 concurrentes)"
printf 'csrf=x&ft=x&nombre=ab&email=ab%%40example.com&mensaje=prueba+de+carga&privacidad=1' > /tmp/ab-post.txt
OUT=$(ab -q -n 500 -c 25 -p /tmp/ab-post.txt -T application/x-www-form-urlencoded "$BASE/contacto.php")
echo "$OUT" | grep -E "Requests per second|Failed requests|Non-2xx|95%"
echo "$OUT" | grep -q "Non-2xx" && { echo "FALLO: hubo respuestas no-2xx (revisar 5xx / database is locked)"; exit 1; } || echo "OK: 0 respuestas 5xx"

echo "== 3. Verificación SQLite"
if command -v sqlite3 >/dev/null && [ -f "$DB" ]; then
  echo -n "journal_mode: "; sqlite3 "$DB" 'PRAGMA journal_mode;'
  echo -n "integrity_check: "; sqlite3 "$DB" 'PRAGMA integrity_check;'
fi

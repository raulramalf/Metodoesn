#!/usr/bin/env bash
# Genera deploy/metodoesn-hostinger.zip: el repo en "formato raíz" para extraer DIRECTAMENTE en public_html.
# Incluye solo lo necesario para ejecutar (sin tests, docs, node_modules, vendor ni .git).
set -euo pipefail
cd "$(dirname "$0")/.."
OUT=deploy/build; rm -rf "$OUT" deploy/metodoesn-hostinger.zip; mkdir -p "$OUT/data"
cp .htaccess index.php "$OUT/"
cp -a public src includes config "$OUT/"
cp data/.htaccess data/index.html "$OUT/data/"
(cd "$OUT" && zip -qr ../metodoesn-hostinger.zip .)
echo "OK -> deploy/metodoesn-hostinger.zip"; unzip -l deploy/metodoesn-hostinger.zip | tail -1

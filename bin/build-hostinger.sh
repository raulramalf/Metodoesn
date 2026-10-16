#!/usr/bin/env bash
# Genera deploy/metodoesn-hostinger.zip con la estructura que espera Hostinger:
#   public_html/  <- contenido de public/ (index.php en la raíz)
#   src/ includes/ config/ data/  <- fuera de public_html (inaccesibles por web)
set -euo pipefail
cd "$(dirname "$0")/.."
OUT=deploy/build; rm -rf "$OUT" deploy/metodoesn-hostinger.zip; mkdir -p "$OUT/public_html" "$OUT/data"
cp -a public/. "$OUT/public_html/"
cp -a src includes config "$OUT/"
cp data/.htaccess data/index.html "$OUT/data/"
(cd "$OUT" && zip -qr ../metodoesn-hostinger.zip .)
echo "OK -> deploy/metodoesn-hostinger.zip"; unzip -l deploy/metodoesn-hostinger.zip | tail -1

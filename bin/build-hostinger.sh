#!/usr/bin/env bash
# Genera dist/metodoesn-hostinger.zip para extraer DENTRO de public_html en Hostinger.
#
# En los planes compartidos solo se puede servir public_html, así que todo va dentro:
# las páginas de public/ en la raíz y config/, includes/, src/ y data/ como subcarpetas
# bloqueadas por .htaccess. Las páginas buscan su código en "../src", así que en la copia
# se reescribe a "./src". El repositorio no se toca: se empaqueta lo que hay en la rama indicada.
set -euo pipefail
cd "$(dirname "$0")/.."

REF="${1:-origin/main}"
ROOT="$PWD"
OUT="$ROOT/dist/metodoesn-hostinger.zip"
BUILD="$(mktemp -d)"
trap 'rm -rf "$BUILD"' EXIT

git archive "$REF" config includes public src data | tar -x -C "$BUILD"
mv "$BUILD"/public/* "$BUILD"/public/.htaccess "$BUILD"/
rmdir "$BUILD/public"
rm -f "$BUILD/data/.gitkeep" "$BUILD/assets/img/.gitkeep"

# Las páginas de la raíz pasan de "../includes" a "./includes"
sed -i "s|__DIR__ . '/\.\./|__DIR__ . '/|g" "$BUILD"/*.php
if grep -q "__DIR__ . '/\.\./" "$BUILD"/*.php; then
    echo "Quedan rutas con ../ en las páginas" >&2
    exit 1
fi

# Carpetas internas: nunca accesibles desde el navegador
for d in config includes src data; do
    printf 'Require all denied\n' > "$BUILD/$d/.htaccess"
done

# Doble seguro desde la raíz por si el servidor ignora los .htaccess anidados
awk '{ print }
     /^RewriteEngine On$/ {
         print ""
         print "# Código interno y base de datos: prohibidos desde la web"
         print "RewriteRule ^(config|includes|src|data)(/|$) - [F,L]"
     }' "$BUILD/.htaccess" > "$BUILD/.htaccess.tmp"
mv "$BUILD/.htaccess.tmp" "$BUILD/.htaccess"

mkdir -p "$ROOT/dist"
rm -f "$OUT"
if command -v zip >/dev/null; then
    (cd "$BUILD" && zip -qr "$OUT" .)
else
    # Windows: el tar del sistema crea zip
    (cd "$BUILD" && "$SYSTEMROOT/System32/tar.exe" -a -c -f "$(cygpath -w "$OUT")" .htaccess ./*)
fi
echo "Creado dist/metodoesn-hostinger.zip"

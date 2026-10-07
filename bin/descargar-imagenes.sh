#!/usr/bin/env bash
# Descarga las imágenes de la web original a public/assets/img/
set -u
cd "$(dirname "$0")/../public/assets/img"
B="https://metodoesn.com/wp-content/uploads"

dl() { echo "-> $1"; wget -q --show-progress -O "$1" "$2" || { echo "   no se pudo descargar $1"; rm -f "$1"; }; }

dl logo.png     "$B/2026/06/cropped-WhatsApp_Image_2026-06-13_at_19.39.14-removebg-preview.png"
dl hero-1.png   "$B/2026/06/ChatGPT-Image-13-jun-2026-23_43_22.png"
dl hero-2.png   "$B/2026/06/ChatGPT-Image-14-jun-2026-00_20_19.png"
dl metodo-1.png "$B/2026/06/ChatGPT-Image-14-jun-2026-15_00_25.png"
dl metodo-2.png "$B/2026/06/ChatGPT-Image-14-jun-2026-15_03_54.png"
dl metodo-3.png "$B/2026/06/ChatGPT-Image-14-jun-2026-15_08_06.png"
dl elena-1.jpeg "$B/2026/06/cropped-WhatsApp-Image-2026-06-13-at-19.39.14.jpeg"
dl elena-2.jpeg "$B/2026/08/WhatsApp-Image-2026-08-18-at-13.27.42.jpeg"
dl espacio.png  "$B/2026/08/ChatGPT-Image-7-ago-2026-16_16_32.png"
echo "Listo."

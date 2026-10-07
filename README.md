# Método ESN

Web de Elena Sánchez Novo (Entrenamiento | Salud | Nutrición) en PHP + HTML + CSS + JS.

## Requisitos (Ubuntu)
    sudo apt update
    sudo apt install -y php-cli php-sqlite3 php-mbstring wget git

## Arrancar
    ./bin/descargar-imagenes.sh
    php -S localhost:8000 -t public

Los mensajes del formulario se guardan en `data/metodoesn.sqlite`:

    sudo apt install -y sqlite3
    sqlite3 data/metodoesn.sqlite "SELECT * FROM contactos;"

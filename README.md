# 🌿 Método ESN — Elena Sánchez Novo

> **Entrenamiento · Salud · Nutrición**  
> Sitio web oficial, plataforma de reservas y catálogo de servicios desarrollado con **PHP nativo**, **SQLite**, **CSS moderno** y **JavaScript vanilla**.

[![PHP Version](https://img.shields.io/badge/PHP-8.1%2B-777BB4?style=flat-square&logo=php&logoColor=white)](https://www.php.net/)
[![Database](https://img.shields.io/badge/Database-SQLite3-003B57?style=flat-square&logo=sqlite&logoColor=white)](https://www.sqlite.org/)
[![Internationalization](https://img.shields.io/badge/i18n-ES%20|%20EN%20|%20DE-success?style=flat-square)](#-internacionalizaci%C3%B3n-i18n)
[![Design](https://img.shields.io/badge/Styling-Vanilla%20CSS3-264de4?style=flat-square&logo=css3&logoColor=white)](#-dise%C3%B1o-y-estilos)
[![License](https://img.shields.io/badge/License-Proprietary-orange?style=flat-square)](#-licencia-y-cr%C3%A9ditos)

---

## 📋 Tabla de Contenidos

1. [Acerca del Proyecto](#-acerca-del-proyecto)
2. [Características Principales](#-caracter%C3%ADsticas-principales)
3. [Estructura del Proyecto](#-estructura-del-proyecto)
4. [Requisitos del Sistema](#-requisitos-del-sistema)
5. [Instalación y Puesta en Marcha](#-instalaci%C3%B3n-y-puesta-en-marcha)
   - [En Windows (PowerShell)](#en-windows)
   - [En Linux (Ubuntu / Debian)](#en-linux-ubuntu--debian)
   - [En macOS](#en-macos)
6. [Gestión de Datos (SQLite)](#-gesti%C3%B3n-de-datos-sqlite)
7. [Configuración Personalizada](#%EF%B8%8F-configuraci%C3%B3n-personalizada)
8. [Despliegue en Producción](#-despliegue-en-producci%C3%B3n)
9. [Seguridad](#-seguridad)
10. [Licencia y Créditos](#-licencia-y-cr%C3%A9ditos)

---

## 🎯 Acerca del Proyecto

**Método ESN** es la plataforma digital de **Elena Sánchez Novo** (Dietista-Nutricionista colegiada **MAD01639**), especializada en la prescripción individualizada de nutrición clínica, salud deportiva y programas de entrenamiento adaptados.

El sitio combina una presencia institucional de alta gama con un canal funcional de captación de pacientes, resolución de dudas frecuentes, contacto directo y reserva inmediata de citas tanto presenciales (Clínica SurgEOM, Madrid) como telemáticas (videoconsultas online).

---

## ✨ Características Principales

- **🌐 Sistema Multilingüe Completo (i18n)**:
  - Soporte integrado para **Español (ES)**, **Inglés (EN)** y **Alemán (DE)**.
  - Conmutador de idiomas interactivo con banderas vectoriales SVG puras.
  - Persistencia de idioma en sesión y compatibilidad con parámetros URL (`?lang=en`).
- **⚡ Ultrarrápido y Libre de Dependencias**:
  - Desarrollado en PHP nativo sin frameworks pesados ni overhead innecesario.
  - Carga inmediata y puntuaciones óptimas en Core Web Vitals.
- **🛡️ Seguridad Integrada**:
  - Protección activa contra **CSRF** (tokens generados criptográficamente).
  - Trampa **Honeypot** silenciosa contra bots y spam en formularios.
  - Consultas preparadas con **PDO** para prevenir inyección SQL.
  - Sanitización estricta de entradas y escape contextual contra **XSS** (`e()`).
- **🗃️ Base de Datos Integrada (SQLite 3)**:
  - Los contactos y solicitudes se registran automáticamente en `data/metodoesn.sqlite`.
  - Sin necesidad de configurar ni mantener servidores MySQL/PostgreSQL para despliegues ligeros.
- **🎨 Diseño UI/UX Moderno y Responsivo**:
  - Maquetación fluida y adaptable (Desktop, Tablet, Mobile) mediante CSS3 nativo.
  - Menú de navegación interactivo con control de accesibilidad ARIA y cierre automático.
  - Micro-interacciones, efectos scroll-aware y componentes tipo acordeón para FAQ.
- **📅 Integración con Citas en Vivo**:
  - Enlace directo a la agenda médica oficial en **Doctoralia**.
  - Flujo explicativo en 3 pasos para nuevos pacientes.
- **⚖️ Cumplimiento Legal y Privacidad**:
  - Páginas dedicadas para Aviso Legal, Política de Privacidad (RGPD) y Política de Cookies.

---

## 📁 Estructura del Proyecto

```text
Metodoesn/
│
├── bin/                        # Scripts auxiliares y de automatización
│   └── descargar-imagenes.sh   # Descarga/sincronización de imágenes de producción
│
├── config/                     # Configuración del entorno
│   └── config.php              # Constantes globales (teléfono, emails, URLs, base de datos)
│
├── data/                       # Almacenamiento local (persistente)
│   ├── .gitkeep
│   └── metodoesn.sqlite        # Base de datos SQLite (se genera automáticamente)
│
├── includes/                   # Componentes y plantillas reutilizables
│   ├── head.php                # Meta etiquetas, enlaces de fuentes y assets
│   ├── nav.php                 # Barra de navegación principal y selector de idiomas
│   └── footer.php              # Pie de página institucional y enlaces legales
│
├── public/                     # DocumentRoot público (única carpeta accesible vía HTTP)
│   ├── assets/
│   │   ├── css/
│   │   │   └── style.css       # Hoja de estilos principal del sistema de diseño
│   │   ├── js/
│   │   │   └── main.js         # Lógica interactiva (menú, acordeones, i18n, etc.)
│   │   └── img/                # Fotografías, logotipos y recursos visuales
│   │
│   ├── index.php               # Página de inicio / Portada
│   ├── quienes-somos.php       # Presentación de Elena Sánchez Novo y trayectoria
│   ├── servicios.php           # Catálogo de planes y especialidades
│   ├── reserva-de-citas.php    # Módulo informativo y acceso a Doctoralia
│   ├── dudas.php               # Preguntas frecuentes interactivas (FAQ)
│   ├── contacto.php            # Formulario con validación y guardado en SQLite
│   ├── aviso-legal.php         # Información legal
│   ├── politica-de-privacidad.php  # Tratamiento de datos y RGPD
│   └── politica-de-cookies.php     # Gestión de cookies informativas
│
├── src/                        # Núcleo y lógica de negocio
│   ├── config.php              # Enlace/compatibilidad de configuración
│   ├── Database.php            # Singleton de conexión PDO a SQLite con auto-migración
│   ├── functions.php           # Helpers de sanitización, CSRF, assets y navegación
│   └── i18n.php                # Diccionario de traducciones (ES / EN / DE)
│
├── .gitignore                  # Ficheros ignorados por Git
└── README.md                   # Documentación principal del repositorio
```

---

## 💻 Requisitos del Sistema

- **PHP 8.0 o superior** (recomendado PHP 8.1 / 8.2 / 8.3).
- **Extensiones PHP necesarias**:
  - `pdo_sqlite` (o `php-sqlite3`)
  - `mbstring`
  - `session`
- **Herramientas opcionales**:
  - `sqlite3` (CLI para inspeccionar la base de datos local)
  - `curl` / `wget` (para scripts de descarga de recursos)

---

## 🚀 Instalación y Puesta en Marcha

### En Windows

1. **Verificar que PHP está instalado**:
   ```powershell
   php -v
   ```
   > Asegúrate de que en tu archivo `php.ini` estén descomentadas las extensiones:
   > `extension=pdo_sqlite`, `extension=sqlite3` y `extension=mbstring`.

2. **Acceder al directorio del proyecto**:
   ```powershell
   cd Metodoesn
   ```

3. **Iniciar el servidor local**:
   ```powershell
   php -S localhost:8000 -t public
   ```

4. **Abrir en el navegador**:
   Visita [http://localhost:8000](http://localhost:8000).

---

### En Linux (Ubuntu / Debian)

1. **Instalar paquetes necesarios**:
   ```bash
   sudo apt update
   sudo apt install -y php-cli php-sqlite3 php-mbstring sqlite3 git wget
   ```

2. **Clonar y acceder al proyecto**:
   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd Metodoesn
   ```

3. **(Opcional) Descargar las imágenes estáticas**:
   ```bash
   chmod +x ./bin/descargar-imagenes.sh
   ./bin/descargar-imagenes.sh
   ```

4. **Arrancar el servidor de desarrollo**:
   ```bash
   php -S localhost:8000 -t public
   ```

5. **Acceder**:
   Abre tu navegador en [http://localhost:8000](http://localhost:8000).

---

### En macOS

1. **Instalar PHP con Homebrew** (si no lo tienes):
   ```bash
   brew install php sqlite
   ```

2. **Arrancar el servidor**:
   ```bash
   cd Metodoesn
   php -S localhost:8000 -t public
   ```

---

## 🗄️ Gestión de Datos (SQLite)

Cuando los usuarios envían un mensaje a través de la página [Contacto](http://localhost:8000/contacto.php), los datos son persistidos automáticamente en `data/metodoesn.sqlite` en la tabla `contactos`.

### Estructura de la tabla:
| Campo | Tipo | Descripción |
|---|---|---|
| `id` | `INTEGER PRIMARY KEY AUTOINCREMENT` | Identificador único del registro |
| `nombre` | `TEXT` | Nombre facilitado por el usuario |
| `email` | `TEXT NOT NULL` | Dirección de correo electrónico |
| `mensaje` | `TEXT NOT NULL` | Cuerpo de la consulta enviada |
| `ip` | `TEXT` | Dirección IP de origen del envío |
| `creado_en` | `TEXT` | Fecha y hora de creación (`CURRENT_TIMESTAMP`) |

### Consultar los mensajes desde terminal:

```bash
# Consultar todos los contactos ordenados por el más reciente
sqlite3 data/metodoesn.sqlite "SELECT id, nombre, email, creado_en FROM contactos ORDER BY id DESC;"

# Ver el contenido detallado de un contacto específico
sqlite3 data/metodoesn.sqlite "SELECT * FROM contactos WHERE id = 1;"
```

En **Windows (PowerShell)**:
```powershell
sqlite3.exe data\metodoesn.sqlite "SELECT id, nombre, email, creado_en FROM contactos ORDER BY id DESC;"
```

---

## ⚙️ Configuración Personalizada

Todos los datos institucionales, de contacto y enlaces a plataformas externas están centralizados en [`config/config.php`](config/config.php):

```php
define('SITE_NAME', 'Método ESN');
define('SITE_TAGLINE', 'Entrenamiento | Salud | Nutrición');
define('SITE_OWNER', 'Elena Sánchez Novo');
define('SITE_COLLEGIATE_NUMBER', 'MAD01639');
define('SITE_EMAIL', 'contacto@metodoesn.com');
define('SITE_PHONE', '+34 614 467 084');
define('SITE_PHONE_LINK', '+34614467084');
define('SITE_INSTAGRAM', '@metodoESN');
define('SITE_INSTAGRAM_URL', 'https://www.instagram.com/metodo.esn/');
define('SITE_ADDRESS', 'Clínica SurgEOM - MedicoQuirúrgica y Dermatológica');
define('SITE_HOURS', 'Lunes a Viernes de 16:00 a 21:00');
define('BOOKING_URL', 'https://www.doctoralia.es/elena-sanchez-novo/dietista-nutricionista/madrid');
define('SITE_CANONICAL', 'https://metodoesn.com');
define('DB_PATH', __DIR__ . '/../data/metodoesn.sqlite');
```

---

## 🌐 Internacionalización (i18n)

El sistema de traducciones se gestiona en [`src/i18n.php`](src/i18n.php):

- **Añadir nuevas claves de traducción**: Añade la entrada correspondiente en el array de cadenas de `i18n.php` para `'es'`, `'en'` y `'de'`.
- **Usar cadenas traducidas en vistas**:
  ```php
  <?= e(t('clave_de_traduccion', 'Texto por defecto')) ?>
  ```
- **Condicional por idioma activo**:
  ```php
  if (current_lang() === 'en') { ... }
  ```

---

## 🚢 Despliegue en Producción

> [!IMPORTANT]
> En servidores de producción (Apache, Nginx, LiteSpeed, etc.), el **DocumentRoot** debe apuntar **exclusivamente** a la carpeta `public/`.
> 
> Esto garantiza que los directorios `config/`, `data/`, `src/` e `includes/` queden completamente inaccesibles por navegador web directo, protegiendo la base de datos `metodoesn.sqlite` y la lógica interna.

### Configuración recomendada para Nginx:

```nginx
server {
    listen 80;
    server_name metodoesn.com www.metodoesn.com;
    root /var/www/metodoesn/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    }

    location ~ /\.(ht|git) {
        deny all;
    }
}
```

### Permisos del archivo de base de datos en Linux:
Asegúrate de que el usuario del servidor web (`www-data`) tenga permisos de lectura y escritura en la carpeta `data/` y en el archivo SQLite:
```bash
sudo chown -R www-data:www-data data/
sudo chmod -R 775 data/
```

---

## 🔒 Seguridad

- **Prevensión XSS**: Todo dato emitido en vistas pasa por la función `e()` (`htmlspecialchars` con codificación UTF-8).
- **Protección CSRF**: Formularios protegidos mediante token único por sesión (`csrf_token()` y `csrf_check()`).
- **Anti-Spam Honeypot**: Campo invisible `web` en formularios; si un bot lo rellena, la petición se rechaza de inmediato con error 400.
- **Consultas parametrizadas**: Todas las consultas a la base de datos se ejecutan con sentencias preparadas de PDO.

---

## 📄 Licencia y Créditos

- **Titular del proyecto**: Elena Sánchez Novo.
- **Colegiada**: MAD01639.
- **Derechos**: © Todos los derechos reservados.

## Seguridad, accesibilidad, SEO y QA
Ver [`docs/AUDITORIA-SEGURIDAD-A11Y-QA.md`](docs/AUDITORIA-SEGURIDAD-A11Y-QA.md) y [`docs/PLAN-SEO.md`](docs/PLAN-SEO.md).
Despliegue Nginx: `docs/deploy/nginx.conf` · Apache: `public/.htaccess`.
Tests: `composer install && vendor/bin/phpunit` · `npm install && npx playwright test`.

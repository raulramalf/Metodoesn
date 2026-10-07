<header class="site-header">
    <div class="wrap header-inner">
        <a href="/" class="brand" aria-label="<?= e(SITE_NAME) ?> - Inicio">
            <img src="<?= e(img('logo.png')) ?>" alt="" width="44" height="44">
            <span><?= e(SITE_NAME) ?></span>
        </a>
        <button class="nav-toggle" aria-label="Abrir menú" aria-expanded="false" aria-controls="nav">
            <span></span><span></span><span></span>
        </button>
        <nav class="nav" id="nav" aria-label="Principal">
            <a href="/index.php"            class="<?= nav_class('index.php') ?>">Método ESN</a>
            <a href="/quienes-somos.php"    class="<?= nav_class('quienes-somos.php') ?>">Quiénes somos</a>
            <a href="/servicios.php"        class="<?= nav_class('servicios.php') ?>">Servicios</a>
            <a href="/dudas.php"            class="<?= nav_class('dudas.php') ?>">Dudas</a>
            <a href="/contacto.php"         class="<?= nav_class('contacto.php') ?>">Contacto</a>
            <a href="/reserva-de-citas.php" class="btn btn-sm">Reserva tu cita</a>
        </nav>
    </div>
</header>

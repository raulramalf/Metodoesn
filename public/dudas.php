<?php
$pageTitle = 'Dudas';
$pageDesc = 'Preguntas frecuentes sobre el Método ESN: primera consulta, dietas, entrenamiento, consultas online y más.';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">
    <section class="wrap section prose-wide">
        <h1>Preguntas frecuentes</h1>
        <div class="faq">
            <?php foreach ($faqs as [$pregunta, $respuesta]): ?>
                <details>
                    <summary><?= e($pregunta) ?></summary>
                    <p><?= e($respuesta) ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="wrap section cta">
        <h2>¿No has encontrado la respuesta que buscabas?</h2>
        <p>Escríbenos sin compromiso. Resolveremos cualquier duda y te ayudaremos a descubrir si el Método ESN es el camino adecuado para ti.</p>
        <a class="btn" href="/contacto.php">Contactar</a>
    </section>
</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

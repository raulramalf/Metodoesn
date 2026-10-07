<?php
$pageTitle = 'Dudas frecuentes';
$pageDesc  = 'Preguntas frecuentes sobre el Método ESN: primera consulta, dietas, entrenamiento, consultas online y más.';
require __DIR__ . '/../includes/head.php';
require __DIR__ . '/../includes/nav.php';
require __DIR__ . '/../src/content.php';
?>
<main id="main">

    <!-- CABECERA -->
    <section class="wrap section faq-header">
        <p class="kicker reveal">Todo lo que necesitas saber</p>
        <h1 class="reveal" style="--delay:80ms">Preguntas frecuentes</h1>
        <p class="lead reveal" style="--delay:160ms">Si tienes alguna duda antes de dar el primer paso, aquí encontrarás las respuestas más habituales. Si no resolvemos la tuya, escríbenos sin compromiso.</p>

        <!-- Buscador en tiempo real -->
        <div class="faq-search reveal" style="--delay:260ms">
            <label for="faq-input" class="visually-hidden">Buscar pregunta</label>
            <div class="faq-search-wrap">
                <svg class="faq-search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input id="faq-input"
                       type="search"
                       placeholder="Busca tu pregunta…"
                       autocomplete="off"
                       aria-label="Filtrar preguntas frecuentes">
                <button id="faq-clear" class="faq-clear" aria-label="Borrar búsqueda" hidden>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                         aria-hidden="true">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>
            <p class="faq-count" id="faq-count" aria-live="polite"></p>
        </div>
    </section>

    <!-- ACORDEÓN FAQ -->
    <section class="wrap section faq-section">
        <div class="faq" id="faq-list">
            <?php foreach ($faqs as $i => [$pregunta, $respuesta]): ?>
                <details class="faq-item reveal" style="--delay:<?= $i * 60 ?>ms"
                         data-question="<?= htmlspecialchars(mb_strtolower($pregunta . ' ' . $respuesta), ENT_QUOTES) ?>">
                    <summary>
                        <span><?= e($pregunta) ?></span>
                        <span class="faq-chevron" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </span>
                    </summary>
                    <div class="faq-body">
                        <p><?= e($respuesta) ?></p>
                    </div>
                </details>
            <?php endforeach; ?>

            <!-- Mensaje sin resultados (oculto por defecto) -->
            <p class="faq-empty" id="faq-empty" hidden>
                No hay preguntas que coincidan con tu búsqueda.
                <a href="/contacto.php">¿Te ayudamos directamente?</a>
            </p>
        </div>
    </section>

    <!-- CTA FINAL -->
    <section class="wrap section">
        <div class="cta reveal">
            <h2>¿No has encontrado la respuesta?</h2>
            <p>Escríbenos sin compromiso. Resolveremos cualquier duda y te ayudaremos a descubrir si el Método ESN es el camino adecuado para ti.</p>
            <a class="btn" href="/contacto.php">Contactar ahora</a>
        </div>
    </section>

</main>
<?php require __DIR__ . '/../includes/footer.php'; ?>

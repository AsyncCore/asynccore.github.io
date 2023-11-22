<?php
/**
 * @var string $descripcion /src/logged-header.php
 * @var string $titulo /src/logged-header.php
 * @var string $css /src/logged-header.php
 * @var string $js /src/logged-header.php
 */

require '../src/utils/sessionInit.php';
require DIR . '/src/utils/autoloader.php';
require DIR . '/vendor/autoload.php';
include_once DIR . '/src/utils/utils.php';

unsetLoginRegister();

$descripcion = "Página principal de AsynCore";
$titulo = "AsynCore";
$css = ["css/style.css","css/hilos-posts-style.css"];
$js = ["js/script.js"];
$cdn = ["https://friconix.com/cdn/friconix.js"];
include_once DIR . '/src/head.php';
if (isset($_SESSION['USER_ID'])) {
    include_once DIR . '/src/logged-header.php';
} else {
    include_once DIR . '/src/login-header.php';
}
?>
<main>
    <h2 class="editar-titulo">Crear Hilo</h2>
    <form action="" class="edit-form" method="POST">
        <div class="form-group">
            <label for="post-title">Título:</label>
            <input id="post-title" name="post-title" required type="text">
        </div>
        <div class="form-group">
            <label for="post-title">Subtítulo:</label>
            <input id="post-title" name="post-title" required type="text">
        </div>
        <div class="form-group">
            <label for="post-tags">Etiquetas:</label>
            <select id="post-tags" multiple name="post-tags">
                <option value="etiqueta1">Etiqueta 1</option>
                <option value="etiqueta2">Etiqueta 2</option>
                <option value="etiqueta3">Etiqueta 3</option>
            </select>
        </div>

        <div class="form-group">
            <label for="post-content">Contenido:</label>
            <textarea id="post-content" name="post-content" required rows="4"></textarea>
        </div>

        <input class="form-submit" type="submit" value="Crear">
    </form>
</main>
<?php
include_once "../src/footer.php";
?>
</body>
</html>
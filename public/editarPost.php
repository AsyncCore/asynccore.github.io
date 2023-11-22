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
    <h2 class="editar-titulo">Editar Post</h2>
    <form action="" class="edit-form" method="POST">
        <label class="form-label" for="contenido">Contenido:</label>
        <textarea class="form-textarea" id="contenido" name="contenido" required rows="8"></textarea>
        <input class="form-submit" type="submit" value="Guardar Cambios">
    </form>
</main>
<?php
include_once "../src/footer.php";
?>
</body>
</html>
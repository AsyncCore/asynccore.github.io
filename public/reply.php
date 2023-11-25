<?php
    /**
     * @var string $descripcion /src/logged-header.php
     * @var string $titulo      /src/logged-header.php
     * @var string $css         /src/logged-header.php
     * @var string $js          /src/logged-header.php
     */
    
    require '../src/init.php';
    
    $descripcion = "Página para responder a un post";
    $titulo = "RESPONDER A POST";
    $css = ["css/style.css", "css/hilos-posts-style.css"];
    $js = ["js/script.js"];
    $cdn = ["https://friconix.com/cdn/friconix.js"];
    
    include_once DIR . '/src/head.php';
    if (isset($_SESSION['USER_ID'])) {
        include_once DIR . '/src/logged-header.php';
    } else {
        include_once DIR . '/src/login-header.php';
    }
    
    /*if(!isset($_SESSION['USER_ID'])){
        header('Location: /login-register.php');
        die;
    }*/

?>
    <main>
        <h2 class="editar-titulo">Crear Post</h2>
        <form action="" class="edit-form" method="POST">
            <label class="form-label" for="contenido">Contenido:</label>
            <textarea class="form-textarea" id="contenido" name="contenido" required rows="8"></textarea>
            <input class="form-submit" type="submit" value="Crear">
        </form>
    </main>
<?php
    include_once "../src/footer.php";
?>
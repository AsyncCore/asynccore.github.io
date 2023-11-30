<?php
    /**
     * @var string $descripcion /src/logged-header.php
     * @var string $titulo      /src/logged-header.php
     * @var string $css         /src/logged-header.php
     * @var string $js          /src/logged-header.php
     */
    
    use src\managers\TagManager;
    use src\db\DatabaseConnection;
    use src\managers\CategoryManager;
    
    require '../src/init.php';
    include DIR . '/src/processNewThread.php';
    
    $descripcion = 'Página para solicitar una nueva contraseña';
    $titulo = 'Solictar nueva contraseña';
    $css = ['css/style.css', 'css/passwordForms.css'];
    $js = [['js/script.js']];
    $cdn = ['https://friconix.com/cdn/friconix.js'];
    include_once DIR . '/src/head.php';
    if (isset($_COOKIE[COOKIE_NAME]) || isset($_SESSION['USER_ID'])) {
        include_once DIR . '/src/logged-header.php';
    } else {
        include_once DIR . '/src/login-header.php';
    }
?>
<main>
    <section>
        <form action="#" class="reset" method="post">
            <label for="newPassword">Nueva Contraseña:</label>
            <input id="newPassword" name="newPassword" placeholder="Nueva Contraseña" required
                   type="password">
            <label for="confirmPassword">Confirmar Contraseña:</label>
            <input id="confirmPassword" name="confirmPassword" placeholder="Confirmar Contraseña" required
                   type="password">
            <input type="submit" value="Restablecer contraseña">
        </form>
    </section>
</main>
<?php
    include_once '../src/footer.php';
?>
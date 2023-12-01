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
    include '../src/processRecovery.php';
    
    $descripcion = 'Página para solicitar una nueva contraseña';
    $titulo = 'Solictar nueva contraseña';
    $css = ['css/style.css', 'css/mdb-custom.css','css/passwordForms.css'];
    $js = [['js/script.js']];
    $cdn = ['https://friconix.com/cdn/friconix.js'];
    include_once DIR . '/src/head.php';
    if (isset($_COOKIE[COOKIE_NAME]) || isset($_SESSION['USER_ID'])) {
        include_once DIR . '/src/logged-header.php';
    } else {
        include_once DIR . '/src/login-header.php';
    }
?>
    <?php if (isset($message)) : ?>
        <main>
            <section>
                <p><?=$message?></p>
            </section>
        </main>
    <?php
        include_once '../src/footer.php';
        die;
    ?>
    <?php endif; ?>
<main>
    <section>
        <form action="<?=$_SERVER['PHP_SELF']?>" class="recovery" method="post">
            <label for="mail"></label>
            <input id="mail" name="correo" placeholder="Correo institucional" required type="email">
            <input type="submit" value="Recuperar">
        </form>
    </section>
</main>
<?php
    include_once '../src/footer.php';
?>
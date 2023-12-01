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
    include '../src/processUpdatePassword.php';
    
    $descripcion = 'Página para cambiar la contraseña de un usuario';
    $titulo = 'Cambiar Contraseña';
    $css = ['css/style.css', 'css/mdb-custom.css', 'css/passwordForms.css'];
    $js = [['js/script.js'], ['js/login-register-main.js']];
    $cdn = ['https://friconix.com/cdn/friconix.js'];
    include_once DIR . '/src/head.php';
    if (isset($_COOKIE[COOKIE_NAME]) || isset($_SESSION['USER_ID'])) {
        include_once DIR . '/src/logged-header.php';
    } else {
        include_once DIR . '/src/login-header.php';
    }
?>
<main>
    <h1>Cambiar Contraseña</h1>
    <?php
        if (isset($message)) {
            echo $message;
        }
    ?>
    <section>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" class="reset" method="post">
            <label for="newPassword"></label>
            <input id="newPassword" name="newPassword" placeholder="Nueva Contraseña" required
                   type="password">
            <button type='button' class='toggle-password pwd1'
                    onclick="togglePasswordVisibility('newPassword', 'newPasswordToggle')">
                <i class='fi-xnsuxx-eye' id='newPasswordToggle' style='color: #386bc0'></i>
            </button>
            <label for="confirmPassword"></label>
            <input id="confirmPassword" name="confirmPassword" placeholder="Confirmar Contraseña" required
                   type="password">
            <button type='button' class='toggle-password pwd2'
                    onclick="togglePasswordVisibility('confirmPassword', 'confirmPasswordToggle')">
                <i class='fi-xnsuxx-eye' id='confirmPasswordToggle' style='color: #386bc0'></i>
            </button>
            <input name="token" type="hidden" value="<?= $_GET['token'] ?>">
            <input type="submit" value="Restablecer contraseña">
        </form>
    </section>
</main>
<?php
    include_once '../src/footer.php';
?>
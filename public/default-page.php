<?php
    $descripcion = "";
    $titulo = "";
    $css = [];
    $js = [];
    include_once DIR . '/src/head.php';
    if (isset($_SESSION['USER_ID'])) {
        include_once DIR . '/src/logged-header.php';
    } else {
        include_once DIR . '/src/login-header.php';
    }
?>
<div class="container">


</div>
<?php
    include_once DIR . '/src/footer.php';
?>
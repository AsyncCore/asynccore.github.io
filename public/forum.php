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

$descripcion = "Página para las categorías de AsynCore";
$titulo = "AsynCore";
$css = ["css/style.css"];
$js = ["js/script.js"];
$cdn = ["https://friconix.com/cdn/friconix.js"];
include_once DIR . '/src/head.php';
if (isset($_SESSION['USER_ID'])) {
  include_once DIR . '/src/logged-header.php';
} else {
  include_once DIR . '/src/login-header.php';
}
?>
    <div class="container">
        <div class="col-full push-top">
            <h1>Categorias</h1>
        </div>

        <div class="col-full">
            <div class="forum-list">

                <h2 class="list-title">
                    <span>Categorias</span>
                </h2>
                <!--TODO LAS CATEGORIAS SE INTRODUCEN DE LA BASE DE DATOS CON PHP-->
                <div class="forum-listing">

                    <div class="forum-details">
                        <a class="text-xlarge" href="forum.php">$titulo-categoria</a>

                        <p>$subtitulo-categoria</p>

                    </div>

                    <div class="threads-count">
                        <p class="count">$cant-hilos</p> threads
                    </div>

                    <div class="last-thread">
                        <img class="avatar" src="https://i.imgur.com/WPSrfGm.jpg" alt="">
                        <div class="last-thread-details">
                            <a href="thread.php">$titulo-último-hilo</a>
                            <p class="text-xsmall">By <a href="profile.php">$username-propietario-hilo</a>, 16 hours ago</p>
                        </div>
                    </div>

                </div>


            </div>
        </div>

    </div>
<?php
include_once DIR . '/src/footer.php';
?>
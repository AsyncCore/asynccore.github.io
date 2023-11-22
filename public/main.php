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

<main>
    <div class="container ">
        <div class="col-full push-top">
            <div class="thread-list">

                <h2 class="list-title">Últimos Hilos</h2>

                <div class="thread">
                    <div>
                        <p>
                            <a href="thread.php">$Título-hilo</a>
                        </p>
                        <p class="text-faded text-xsmall">
                            By <a href="profile.php">$username-propietario</a>, yesterday($fecha-creacion?).
                        </p>
                    </div>

                    <div class="activity">
                        <p class="replies-count">
                            $cant-reply
                        </p>

                        <img class="avatar-medium"
                             src="http://i0.kym-cdn.com/photos/images/facebook/000/010/934/46623-batman_pikachu_super.png"
                             alt="">

                        <div>
                            <p class="text-xsmall">
                                <a href="profile.php">$username-last-response</a>
                            </p>
                            <p class="text-xsmall text-faded">2 hours ago</p>
                        </div>
                    </div>
                </div>

                <div class="thread">
                    <div>
                        <p>
                            <a href="thread.php">$Título-hilo</a>
                        </p>
                        <p class="text-faded text-xsmall">By <a href="profile.php">$username-propietario</a>, 8 hours ago($fecha-creacion?)</p>
                    </div>

                    <div class="activity">
                        <p class="replies-count">
                            $cant-reply
                        </p>

                        <img class="avatar-medium"
                             src="https://firebasestorage.googleapis.com/v0/b/forum-2a982.appspot.com/o/images%2Favatars%2Fraynathan?alt=media&token=bd9a0f0e-60f2-4e60-b092-77d1ded50a7e"
                             alt="">
                        <span>
                          <a class="text-xsmall" href="profile.php">$username-last-response</a>
                          <p class="text-faded text-xsmall">3 hours ago</p>
                      </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-full push-top" >
            <div class="thread-list">

                <h2 class="list-title">Hilos populares</h2>

                <div class="thread">
                    <div>
                        <p>
                            <a href="thread.php">$Título-hilo</a>
                        </p>
                        <p class="text-faded text-xsmall">
                            By <a href="profile.php">$username-propietario</a>, yesterday($fecha-creacion?).
                        </p>
                    </div>

                    <div class="activity">
                        <p class="replies-count">
                            $cant-reply
                        </p>

                        <img class="avatar-medium"
                             src="http://i0.kym-cdn.com/photos/images/facebook/000/010/934/46623-batman_pikachu_super.png"
                             alt="">

                        <div>
                            <p class="text-xsmall">
                                <a href="profile.php">$username-last-response</a>
                            </p>
                            <p class="text-xsmall text-faded">2 hours ago</p>
                        </div>
                    </div>
                </div>

                <div class="thread">
                    <div>
                        <p>
                            <a href="thread.php">$Título-hilo</a>
                        </p>
                        <p class="text-faded text-xsmall">By <a href="profile.php">$username-propietario</a>, 8 hours ago($fecha-creacion?)</p>
                    </div>

                    <div class="activity">
                        <p class="replies-count">
                            $cant-reply
                        </p>

                        <img class="avatar-medium"
                             src="https://firebasestorage.googleapis.com/v0/b/forum-2a982.appspot.com/o/images%2Favatars%2Fraynathan?alt=media&token=bd9a0f0e-60f2-4e60-b092-77d1ded50a7e"
                             alt="">
                        <span>
                          <a class="text-xsmall" href="profile.php">$username-last-response</a>
                          <p class="text-faded text-xsmall">3 hours ago</p>
                      </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once DIR . '/src/footer.php';
?>

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

$descripcion = "Página de hilo de AsynCore";
$titulo = "AsynCore";
$css = ["css/style.css"];
$js = ["js/script.js",];
$cdn = ["https://friconix.com/cdn/friconix.js"];
include_once DIR . '/src/head.php';
if (isset($_SESSION['USER_ID'])) {
    include_once DIR . '/src/logged-header.php';
} else {
    include_once DIR . '/src/login-header.php';
}
?>

<div class="container">

    <div class="col-large push-top">

        <ul class="breadcrumbs">
            <li><a href="#"><i class="fa fa-home fa-btn"></i>Home</a></li>
            <li><a href="category.php">Discussions</a></li>
            <li class="active"><a href="#">Cooking</a></li>
        </ul>

        <h1>$titulo-hilo</h1>

        <p>
            By <a href="#" class="link-unstyled">Robin</a>, 2 hours ago.
            <span style="float:right; margin-top: 2px;" class="hide-mobile text-faded text-small">3 replies by 3 contributors</span>
        </p>

        <div class="post-list">

            <div class="post">
                <!--TODO LINKEAR LAS VARIABLES DEL USUARIO DE POSTS Y THREADS DE LA BASE DE DATOS-->
                <div class="user-info">
                    <a href="profile.php#profile-details" class="user-name">Robin</a>

                    <a href="profile.php#profile-details">
                        <img class="avatar-large" src="http://i.imgur.com/s0AzOkO.png" alt="">
                    </a>

                    <p class="desktop-only text-small">$num-posts</p>

                    <p class="desktop-only text-small">$num-threads</p>

                    <span class="online desktop-only">$online</span>

                </div>

                <div class="post-content">
                    <div>
                        <p>
                            Is horseradish and Wasabi the same thing? I've heard so many different things.<br><br>
                            I want to know once and for all.
                        </p>
                    </div>
                    <a href="#" style="margin-left: auto;" class="link-unstyled" title="Make a change"><i
                                class="fa fa-pencil"></i></a>
                </div>


                <div class="post-date text-faded">
                    6 hours ago
                </div>

                <div class="reactions">
                    <ul>
                        <li>💡</li>
                        <li>❤️</li>
                        <li>👎</li>
                        <li>👍</li>
                        <li>👌</li>
                    </ul>
                    <button class="btn-xsmall"><span class="emoji">❤️</span>️ 3</button>
                    <button class="btn-xsmall active-reaction"><span class="emoji">👌️</span>️ 1</button>
                    <button class="btn-xsmall">+ <i class="fa fa-smile-o emoji"></i></button>
                </div>

            </div>

            <div class="post">

                <div class="user-info">
                    <a href="profile.php#profile-details" class="user-name">Joseph Kerr</a>

                    <a href="profile.php#profile-details">
                        <img class="avatar-large" src="https://i.imgur.com/OqlZN48.jpg" alt="">
                    </a>

                    <p class="desktop-only text-small">$num-posts</p>

                    <p class="desktop-only text-small">$num-threads</p>

                    <span class="online desktop-only">$online</span>

                </div>

                <div class="post-content">
                    <div>
                        <blockquote class="small">
                            <div class="author">
                                <a href="/user/robin" class=""> robin</a>
                                <span class="time">a month ago</span>
                                <i class="fa fa-caret-down"></i>
                            </div>

                            <div class="quote">
                                <p>Is horseradish and Wasabi the same thing? I've heard so many different things.</p>
                            </div>
                        </blockquote>
                        <p>They're not the same!</p>
                    </div>
                    <a class="edit-post link-unstyled"><i class="fa fa-pencil"></i></a>
                </div>


                <div class="post-date text-faded">
                    6 hours ago
                </div>

                <div class="reactions">
                    <button class="btn-xsmall">+ <i class="fa fa-smile-o emoji"></i></button>
                </div>

            </div>

            <div class="post">

                <div class="user-info">
                    <a href="profile.php#profile-details" class="user-name">Ray-Nathan James</a>

                    <a href="profile.php#profile-details">
                        <img class="avatar-large"
                             src="https://firebasestorage.googleapis.com/v0/b/forum-2a982.appspot.com/o/images%2Favatars%2Fraynathan?alt=media&token=bd9a0f0e-60f2-4e60-b092-77d1ded50a7e"
                             alt="">
                    </a>

                    <p class="desktop-only text-small">$num-posts</p>

                    <p class="desktop-only text-small">$num-threads</p>

                    <span class="offline desktop-only">$offline</span>

                </div>

                <div class="post-content">
                    <div>
                        <p>
                            <a href="/user/Joker" class="">@Joker</a> is right, they're not the same.
                        </p>
                        <p>
                            They are different plants from the same family (mustard/cabbage).
                        </p>
                    </div>
                </div>

                <div class="post-date text-faded">
                    6 hours ago
                </div>

                <div class="reactions">
                    <button class="btn-xsmall">+ <i class="fa fa-smile-o emoji"></i></button>
                </div>

            </div>
        </div>
    </div>

</div>
<?php
include_once DIR . '/src/footer.php';
?>

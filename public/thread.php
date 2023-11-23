<?php
    /**
     * @var string $descripcion /src/logged-header.php
     * @var string $titulo      /src/logged-header.php
     * @var string $css         /src/logged-header.php
     * @var string $js          /src/logged-header.php
     */
    
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    use src\managers\PostsManager;
    use src\managers\ThreadManager;
    use src\managers\CategoryManager;
    
    require '../src/utils/sessionInit.php';
    require DIR . '/src/utils/autoloader.php';
    require DIR . '/vendor/autoload.php';
    include_once DIR . '/src/utils/utils.php';
    
    include DIR . '/src/utils/errorReporting.php';
    
    if (!isset($_GET['t']) || !is_numeric($_GET['t'])) {
        header('Location: /forum.php?t=e');
        die;
    } else if (!isset($_GET['c']) || !is_numeric($_GET['c'])){
        header('Location: /forum.php?c=e');
        die;
    } else {
        $getThread = htmlspecialchars($_GET['t']);
        $getCategory = htmlspecialchars($_GET['c']);
        $db = DatabaseConnection::getInstance()->getConnection();
        $categoryManager = new CategoryManager($db);
        $threadManager = new ThreadManager($db);
        $postManager = new PostsManager($db);
        $userManager = new UserManager($db);
        $thread = $threadManager->getThread($getThread);
        if (!$thread) {
            header('Location: /forum.php?t=nf');
            die;
        }
        $category = $categoryManager->getCategory($getCategory);
        $thread = $threadManager->getThread($getThread);
        $posts = $postManager->getAllPostsByThread($getThread);
        $threadUser = $userManager->getUserById($thread['USER_ID']);
    }
    
    $descripcion = "Página de hilo de AsynCore";
    $titulo = "AsynCore";
    $css = ["css/style.css", "css/footer.css"];
    $js = ["js/script.js",];
    $cdn = ["https://friconix.com/cdn/friconix.js"];
    include_once DIR . '/src/head.php';
    if (isset($_SESSION['USER_ID'])) {
        include_once DIR . '/src/logged-header.php';
    } else {
        include_once DIR . '/src/login-header.php';
    }
?>
<main>
    <div class="container page-content">

        <div class="col-large push-top">

            <ul class="breadcrumbs">
                <li><a href="/main.php"><i class="fa fa-home fa-btn"></i>Home</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li class="active"><a href="/category.php?c=<?= $getCategory ?>"><?= ucfirst(strtolower($category['TITULO'])) ?></a></li>
            </ul>

            <h1><?= $thread['TITULO']?></h1>

            <p>
                By <a href="profile.php?UID=<?= $thread['USER_ID']?>" class="link-unstyled"><?=$threadUser['USERNAME']?>></a>, <?= timeAgo($thread['F_CRE'])?>.
                <span style="float:right; margin-top: 2px;" class="hide-mobile text-faded text-small"><?= count($posts)?> respuestas de </span>
            </p>

            <div class="post-list">

                <div class="post">
                    <!--TODO LINKEAR LAS VARIABLES DEL USUARIO DE POSTS Y THREADS DE LA BASE DE DATOS-->
                    <div class="user-info">
                        <a href="profile.php#profile-details" class="user-name">$username-propietario-hilo</a>

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
                                $contenido-hilo
                            </p>
                        </div>
                        <a href="#" style="margin-left: auto;" class="link-unstyled" title="Make a change"><i
                                    class="fa fa-pencil"></i></a>
                    </div>


                    <div class="post-date text-faded">
                        6 hours ago
                    </div>

                    <div class="reactions">
                        <a href="crearPost.php" class="btn-green btn-small">responder</a>
                    </div>

                </div>

                <div class="post">

                    <div class="user-info">
                        <a href="profile.php#profile-details" class="user-name">$username-respuesta</a>

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
                                    <a href="/user/robin" class="">$username-al-que-responde</a>
                                    <!--Este es el propietario del post al que se está respondiendo-->
                                    <span class="time">a month ago</span>
                                    <i class="fa fa-caret-down"></i>
                                </div>

                                <div class="quote"><!--Este es como una previo del hilo/post al que responde-->
                                    <p>$post/hilo--al-que-responde</p>
                                </div>
                            </blockquote>
                            <p>$contenido</p>
                        </div>
                        <a class="edit-post link-unstyled"><i class="fa fa-pencil"></i></a>
                    </div>


                    <div class="post-date text-faded">
                        6 hours ago
                    </div>

                    <div class="reactions">
                        <a href="crearPost.php" class="btn-green btn-small">responder</a>
                    </div>

                </div>

                <div class="post">

                    <div class="user-info">
                        <a href="profile.php#profile-details" class="user-name">$username-respuesta</a>

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
                                <!--A continuacion separo contenido respuesta del contenido post por que no tengo muy claro como va a ser y en la plantilla parecen ser 2 cosas separadas-->
                                <a href="/user/Joker" class="">@$username-al-que-responde</a>$contenido-respuesta
                            </p>
                            <p>
                                $contenido-post
                            </p>
                        </div>
                    </div>

                    <div class="post-date text-faded">
                        6 hours ago
                    </div>

                    <div class="reactions">
                        <a href="crearPost.php" class="btn-green btn-small">responder</a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</main>
<?php
    include_once DIR . '/src/footer.php';
?>

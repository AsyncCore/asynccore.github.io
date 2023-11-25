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
    
    require '../src/init.php';
    
    $categories = [1, 2, 3, 4, 5]; /*TODO hacerlo dinámico desde BD*/
    
    if (!isset($_GET['c']) || !array_filter($categories, fn($cat) => $cat == $_GET['c'])) {
        header('Location: /forum.php?c=e');
        die;
    } else {
        $getCategory = htmlspecialchars($_GET['c']);
        $db = DatabaseConnection::getInstance()->getConnection();
        $categoryManager = new CategoryManager($db);
        $threadManager = new ThreadManager($db);
        $postManager = new PostsManager($db);
        $userManager = new UserManager($db);
        $category = $categoryManager->getCategory($getCategory);
        if (!$category) {
            header('Location: /forum.php?c=nf');
            die;
        }
        $threads = $threadManager->getAllThreadsByCategory($getCategory);
    }
    
    $descripcion = "FORO DE ASYNCORE - ";
    $titulo = "Categoría ";
    $css = ['css/mdb-custom.css', 'css/style.css', 'css/footer.css'];
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
    <div class="container">
        <div class="col-full push-top">
            <ul class="breadcrumbs">
                <li><a href="/index.php"><i class='fi-xnsuxl-house-solid'></i>Home</a></li>
                <li class="active"><a href="/forum.php">Forum</a></li>
            </ul>

            <div class="forum-header">
                <div class="forum-details">
                    <h1><?= $category['TITULO'] ?></h1>
                    <p class="text-lead"><?= $category['SUBTITULO'] ?></p>
                </div>
                <a href="new-thread.php?c=<?= $getCategory ?>" class="btn-green btn-small">Crear un hilo</a>
            </div>
        </div>


        <div class="col-full push-top">
            <div class="thread-list">
                <h2 class="list-title">Hilos</h2>
                
                <?php foreach ($threads as $thread): ?>
                    <?php
                    $threadUser = $userManager->getUserById($thread['USER_ID']);
                    $post = $postManager->getLastPostByThread($thread['THREAD_ID']);
                    $postUser = $userManager->getUserById($post['USER_ID']);
                    
                    ?>
                    <div class="thread">
                        <div>
                            <p>
                                <a href="thread.php?c=<?= $getCategory ?>&t=<?= $thread['THREAD_ID'] ?>"><?= $thread['TITULO'] ?></a>
                            </p>
                            <p class="text-faded text-xsmall">
                                By
                                <a href="profile.php?UID=<?= $thread['USER_ID'] ?>"><?= $threadUser['USERNAME'] ?></a>, <?= timeAgo($thread['F_CRE']) ?>
                                .
                            </p>
                        </div>

                        <div class="activity">
                            <p class="replies-count">
                                <?= $postManager->getPostCountByThread($thread['THREAD_ID']) ?>
                            </p>

                            <img class="avatar-medium"
                                 src="<?= $threadUser['AVATAR'] ?>"
                                 alt="AVATAR DE <?= $threadUser['USERNAME'] ?>">

                            <div>
                                <p class="text-xsmall">
                                    <a href="profile.php?UID=<?= $post['USER_ID'] ?>"><?= $postUser['USERNAME'] ?></a>
                                </p>
                                <p class="text-xsmall text-faded"><?= timeAgo($post['F_CRE']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<?php
    include_once DIR . '/src/footer.php';
?>

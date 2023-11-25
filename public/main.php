<?php
    /**
     * @var string $descripcion /src/logged-header.php
     * @var string $titulo /src/logged-header.php
     * @var string $css /src/logged-header.php
     * @var string $js /src/logged-header.php
     */
    
    use src\managers\CategoryManager;
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    use src\managers\PostsManager;
    use src\managers\ThreadManager;
    
    require '../src/init.php';
    
    $db = DatabaseConnection::getInstance()->getConnection();
    $categoryManager = new CategoryManager($db);
    $threadManager = new ThreadManager($db);
    $postManager = new PostsManager($db);
    $userManager = new UserManager($db);
    $latestThreads = $threadManager->getLatestThreads();
    $mostRepliedThreads = $threadManager->getMostRepliedThreads();
    
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
                <?php foreach ($latestThreads as $thread): ?>
                    <?php
                    $threadUser = $userManager->getUserById($thread['USER_ID']);
                    $post = $postManager->getLastPostByThread($thread['THREAD_ID']);
                    if(!$post){
                        $post = $thread;
                    }
                    $postUser = $userManager->getUserById($post['USER_ID']);
                    ?>
                    <div class="thread">
                        <div>
                            <p>
                                <a href="thread.php?c=<?=$thread['CAT_ID']?>&t=<?= htmlspecialchars($thread['THREAD_ID']) ?>"><?= htmlspecialchars($thread['TITULO']) ?></a>
                            </p>
                            <p class="text-faded text-xsmall">
                                By <a href="profile.php?UID=<?= htmlspecialchars($thread['USER_ID']) ?>"><?= htmlspecialchars($thread['USERNAME']) ?></a>, <?= htmlspecialchars(timeAgo($thread['F_CRE'])) ?>
                            </p>
                        </div>

                        <div class="activity">
                            <p class="replies-count">
                                <?= $postManager->getPostCountByThread($thread['THREAD_ID']) ?>
                            </p>

                            <img class="avatar-medium"
                                 src="<?= $threadUser['AVATAR'] ?>"
                                 alt="Avatar de <?= $threadUser['USERNAME'] ?>">

                            <div>
                                <p class="text-xsmall">
                                    <a href="profile.php?UID=<?= $postUser['USER_ID'] ?>"><?= $postUser['USERNAME'] ?></a>
                                </p>
                                <p class="text-xsmall text-faded"><?= timeAgo($post['F_CRE']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>
        </div>

        <div class="col-full push-top">
            <div class="thread-list">

                <h2 class="list-title">Hilos populares</h2>
                
                <?php foreach ($mostRepliedThreads as $thread): ?>
                    <?php
                    $threadUser = $userManager->getUserById($thread['USER_ID']);
                    $post = $postManager->getLastPostByThread($thread['THREAD_ID']);
                    if(!$post){
                        $post = $thread;
                    }
                    $postUser = $userManager->getUserById($post['USER_ID']);
                    ?>
                    <div class="thread">
                        <div>
                            <p>
                                <a href="thread.php?c=<?=$thread['CAT_ID']?>&t=<?= htmlspecialchars($thread['THREAD_ID']) ?>"><?= htmlspecialchars($thread['TITULO']) ?></a>
                            </p>
                            <p class="text-faded text-xsmall">
                                By <a href="profile.php?UID=<?= htmlspecialchars($thread['USER_ID']) ?>"><?= htmlspecialchars($thread['USERNAME']) ?></a>, <?= htmlspecialchars(timeAgo($thread['F_CRE'])) ?>
                            </p>
                        </div>

                        <div class="activity">
                            <p class="replies-count">
                                <?= $postManager->getPostCountByThread($thread['THREAD_ID']) ?>
                            </p>

                            <img class="avatar-medium"
                                 src="<?= $threadUser['AVATAR'] ?>"
                                 alt="Avatar de <?= $threadUser['USERNAME'] ?>">

                            <div>
                                <p class="text-xsmall">
                                    <a href="profile.php?UID=<?= $postUser['USER_ID'] ?>"><?= $postUser['USERNAME'] ?></a>
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

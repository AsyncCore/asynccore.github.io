<?php
    /**
     * @var string $descripcion /src/logged-header.php
     * @var string $titulo      /src/logged-header.php
     * @var string $css         /src/logged-header.php
     * @var string $js          /src/logged-header.php
     */
    
    use src\managers\TagManager;
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    use src\managers\PostsManager;
    use src\managers\ThreadManager;
    use src\managers\CategoryManager;
    
    require '../src/init.php';
    include DIR . '/src/utils/errorReporting.php';
    
    if (!isset($_GET['t']) || !is_numeric($_GET['t'])) {
        header('Location: /forum.php?t=e');
        die;
    } else if ((!isset($_GET['c']) || !is_numeric($_GET['c'])) && $_GET['t'] == null) {
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
        $tagManager = new TagManager($db);
        $thread = $threadManager->getThread($getThread);
        if (!$thread) {
            header('Location: /forum.php?t=nf');
            die;
        }
        $category = $categoryManager->getCategory($getCategory);
        if(!$category){
            header('Location: /forum.php?c=nf');
            die;
        }
        $posts = $postManager->getAllPostsByThread($getThread);
        $threadUser = $userManager->getUserById($thread['USER_ID']);
    }
    
    $descripcion = "Página de hilo de AsynCore";
    $titulo = "AsynCore";
    $css = ["css/style.css", "css/footer.css", 'css/tooltip.css', 'css/prism-threads.css'];
    $js = [["js/script.js"], ['js/prism-threads.js']];
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
                <li><a href="/main.php"><i class='fi-xnsuxl-house-solid'></i>Home</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li class="active"><a href="/category.php?c=<?= $getCategory ?>"><?= ucfirst(strtolower($category['TITULO'])) ?></a></li>
            </ul>

            <h1><?= $thread['TITULO']?></h1>
            <h2 style="opacity: 75%; font-size: 25px;"><?=$thread['SUBTITULO']?></h2>

            <p>
                By <a href="profile.php?UID=<?= $thread['USER_ID']?>" class="link-unstyled"><?=$threadUser['USERNAME']?></a>, <?= timeAgo($thread['F_CRE'])?>.
                <span style="float:right; margin-top: 2px;" class="hide-mobile text-faded text-small"><?= count($posts)?> respuestas de <?=$postManager->getPostCountByUniqueUser($thread['THREAD_ID'])?> usuarios</span>
            </p>

            <div class="post-list">
                <div class="post">
                    <div class="user-info">
                        <a href="profile.php?UID=<?=$thread['USER_ID']?>" class="user-name"><?=$threadUser['USERNAME']?></a>

                        <a href="profile.php?UID=<?=$thread['USER_ID']?>">
                            <img class="avatar-large" src="<?=$threadUser['AVATAR']?>" alt="AVATAR DE <?=$threadUser['USERNAME']?>">
                        </a>
                        <?php
                            $numPosts = $postManager->getPostCountByUserId($thread['USER_ID']);
                            $numThreads = $threadManager->getThreadCountByUserId($thread['USER_ID']);
                            $online = $userManager->isUserOnline($thread['USER_ID']);
                            $offline = !$online;
                        ?>
                        <p class="desktop-only text-small"><?= $numPosts == 1 ? $numPosts . ' Post' : $numPosts . ' Posts'?></p>

                        <p class="desktop-only text-small"><?= $numThreads == 1 ? $numThreads . ' Hilo' : $numThreads . ' Hilos'?></p>

                        <span class="user-status <?= $online ? 'online' : 'offline' ?>">
                                <?= $online ? 'Online' : 'Offline' ?>
                        </span>
                    </div>

                    <div class="post-content" style="flex-direction: column;">
                        <div style="display: flex; justify-content: space-between;">
                            <div style="display: flex; gap: 5px;">
                                <?php foreach ($tagManager->getAllTagsByThreadId($thread['THREAD_ID']) as $tag): ?>
                                    <div class='tag-container'>
                                        <span class="tag">
                                        <i class="<?= $tag['ICONO'] ?>"></i>
                                            <!-- <a href="/forum.php?tag=<?= $tag['ETI_ID'] ?>">#<?= $tag['NOMBRE'] ?></a> -->
                                        </span>
                                        <span class='tag-tooltip'><?= $tag['DESC'] ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="edit-container">
                                <a href="/editar.php?t=<?= $thread['THREAD_ID'] ?>" style='margin-left: auto;'
                                   class='link-unstyled'>
                                    <i class='fi-xwsux2-pen'></i></a>
                                <span class='edit-tooltip'>Editar hilo</span>
                            </div>
                        </div>
                        <div style="margin-top: 10px;">
                            <?=html_entity_decode($thread['CONTENIDO'])?>
                        </div>
                    </div>

                    <div class="post-date text-faded">
                        <?= timeAgo($thread['F_CRE'])?>
                    </div>

                    <div class="reactions">
                        <a href="reply.php?t=<?=$thread['THREAD_ID']?>" class="btn-green btn-small">Responder</a>
                    </div>
                </div>
                
                <?php foreach ($posts as $post): ?>
                    <?php
                    $postUser = $userManager->getUserById($post['USER_ID']);
                    ?>
                    <div class="post">
                        <div class="user-info">
                            <a href="profile.php?UID=<?= $post['USER_ID'] ?>"
                               class="user-name"><?= $postUser['USERNAME'] ?></a>

                            <a href="profile.php?UID=<?= $post['USER_ID'] ?>">
                                <img class="avatar-large" src="<?= $postUser['AVATAR'] ?>"
                                     alt="AVATAR DE <?= $postUser['USERNAME'] ?>">
                            </a>
                            <?php
                                $numPosts = $postManager->getPostCountByUserId($post['USER_ID']);
                                $numThreads = $threadManager->getThreadCountByUserId($post['USER_ID']);
                                $online = $userManager->isUserOnline($post['USER_ID']);
                                $offline = !$online;
                            ?>
                            <p class="desktop-only text-small"><?= $numPosts == 1 ? $numPosts . ' Post' : $numPosts . ' Posts' ?></p>

                            <p class="desktop-only text-small"><?= $numThreads == 1 ? $numThreads . ' Hilo' : $numThreads . ' Hilos' ?></p>

                            <span class="user-status <?= $online ? 'online' : 'offline' ?>">
                            <?= $online ? 'Online' : 'Offline' ?>
                        </span>
                        </div>
                        <div class="post-content">
                            <div style='margin-top: 10px;'>
                                <?= getNestedReplyContent($post['POST_ID'], $postManager, $userManager) ?>
                            </div>
                            <a href="/editar.php?p=<?= $post['POST_ID'] ?>" style="margin-left: auto;"
                               class="link-unstyled" title="Editar el post">
                                <i class='fi-xwsux2-pen'></i></a>
                        </div>
                        <div class="post-date text-faded">
                            <?= timeAgo($post['F_CRE']) ?>
                        </div>
                        <div class='reactions'>
                            <a href='reply.php?t=<?=$post['THREAD_ID']?>&p=<?= $post['POST_ID'] ?>' class='btn-green btn-small'>Responder</a>
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

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
    include_once DIR . '/src/utils/errorReporting.php';
    
    $descripcion = "Foro de AsynCore. Un foro de programación para estudiantes de DAW y DAM.";
    $titulo = "Foro de AsynCore";
    $css = ["css/style.css", "css/mdb-custom.css", "css/forum.css", "css/footer.css"];
    $js = [["js/script.js"]];
    $cdn = ["https://friconix.com/cdn/friconix.js"];
    include_once DIR . '/src/head.php';
    if (isset($_SESSION['USER_ID'])) {
        include_once DIR . '/src/logged-header.php';
    } else {
        include_once DIR . '/src/login-header.php';
    }
    
    $db = DatabaseConnection::getInstance()->getConnection();
    $categoryManager = new CategoryManager($db);
    $threadManager = new ThreadManager($db);
    $postManager = new PostsManager($db);
    $userManager = new UserManager($db);
    $categories = $categoryManager->getAllCategories();
    
    foreach ($categories as $key => $category) {
        $lastPost = $postManager->getLastPostByCategory($category['CAT_ID']);
        if ($lastPost) {
            $user = $userManager->getUserById($lastPost['USER_ID']);
            $categories[$key]['LAST_POST'] = $lastPost;
            $categories[$key]['LAST_POST_USER'] = $user;
        }
    }
    $message = '';
    
    foreach (['c', 'nt', 't', 'p', 'UID'] as $param) {
        if (isset($_GET[$param])) {
            $errorKey = $param . '_' . htmlspecialchars($_GET[$param]);
            if (array_key_exists($errorKey, ERROR_MESSAGES)) {
                $message = printMessage($errorKey, ERROR_MESSAGES);
                if ($message) {
                    break;
                }
            }
        }
    }
?>
<main>
    <div class="container">
        <div class="col-full push-top">
            <h1 style="text-align: center">Foro de AsynCore</h1>
        </div>
        <div class="col-full">
            <?= $message ?>
        </div>
        <div class="col-full">
            <div class="forum-list">
                <?php foreach ($categories as $category): ?>
                    <?php
                        $lastThread = $threadManager->getLastThreadByCategoryWithUser($category['CAT_ID']);
                        if ($lastThread) {
                            $user = $userManager->getUserById($lastThread['USER_ID']);
                        }
                        
                        if ($category['CAT_ID'] == 1) {
                            echo <<<HTML
                                    <h2 class="list-title">
                                        <span>ASYNCORE</span>
                                    </h2>
                            HTML;
                        } else if ($category['CAT_ID'] == 2){
                            echo <<<HTML
                                    <h2 class="list-title">
                                        <span>CATEGORÍAS</span>
                                    </h2>
                            HTML;
                        }
                    ?>
                    <div class="forum-listing">
                        <div class="forum-icon">
                            <img src="https://<?= $_SERVER['HTTP_HOST'] . $category['ICONO'] ?>"
                                 alt="Icono de la categoría <?= $category['TITULO'] ?>">
                        </div>
                        <div class="forum-details">
                            <a class="text-xlarge"
                               href="category.php?c=<?= $category['CAT_ID'] ?>"><?= $category['TITULO'] ?></a>
                            <p><?= $category['SUBTITULO'] ?></p>
                        </div>

                        <div class="threads-count">
                            <p class="count"><?= $threadManager->getThreadCountByCategory($category['CAT_ID']) ?></p>
                            hilos
                        </div>
                        <?php if ($lastThread && !isset($category['LAST_POST'])): ?>
                        <div class="last-thread">
                            <img class='avatar' src="<?= $user['AVATAR'] ?>" alt="AVATAR DEL USUARIO <?= $user['USERNAME'] ?>">
                            <div class="last-thread-details">
                                <a href="thread.php?c=<?= $category['CAT_ID'] ?>&t=<?= $lastThread['THREAD_ID'] ?>"><?= $lastThread['TITULO'] ?></a>
                                <p class="text-xsmall">By <a href="profile.php&UID=<?= $lastThread['USER_ID'] ?>"><?= $user['USERNAME'] ?></a>, <?= timeAgo($lastThread['F_CRE']) ?></p>
                            </div>
                        </div>
                        <?php elseif (isset($category['LAST_POST'])): ?>
                            <div class="last-thread">
                                <img class='avatar' src="<?= $category['LAST_POST_USER']['AVATAR'] ?>" alt="AVATAR DEL USUARIO <?= $category['LAST_POST_USER']['USERNAME'] ?>">
                                <div class="last-thread-details">
                                    <a href="thread.php?c=<?= $category['CAT_ID'] ?>&t=<?= $category['LAST_POST']['THREAD_ID'] ?>"><?= $category['LAST_POST']['TITULO'] ?></a>
                                    <p class="text-xsmall">By <a href="profile.php&UID=<?= $category['LAST_POST']['USER_ID'] ?>"><?= $category['LAST_POST_USER']['USERNAME'] ?></a>, <?= timeAgo($category['LAST_POST']['F_CRE']) ?></p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="last-thread">
                                <p>No hay hilos en esta categoría</p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<?php
    include_once DIR . '/src/footer.php';
?>
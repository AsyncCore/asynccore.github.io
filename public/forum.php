<?php
    /**
     * @var string $descripcion /src/logged-header.php
     * @var string $titulo      /src/logged-header.php
     * @var string $css         /src/logged-header.php
     * @var string $js          /src/logged-header.php
     */
    
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    use src\managers\ThreadManager;
    use src\managers\CategoryManager;
    
    require '../src/utils/sessionInit.php';
    require DIR . '/src/utils/autoloader.php';
    require DIR . '/vendor/autoload.php';
    include_once DIR . '/src/utils/utils.php';
    
    $descripcion = "Foro de AsynCore. Un foro de programación para estudiantes de DAW y DAM.";
    $titulo = "Foro de AsynCore";
    $css = ["css/style.css", "css/mdb-custom.css", "css/forum.css", "css/footer.css"];
    $js = ["js/script.js"];
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
    $userManager = new UserManager($db);
    $categories = $categoryManager->getAllCategories();
    
    $message = '';
    if (isset($_GET['c'])) {
        if ($_GET['c'] == 'nf') {
            $message = <<<HTML
                                <div>
                                    <h2>404 - NOT FOUND</h2>
                                    <p>La categoría que estás buscando no existe. Puedes <a href="/main.php">volver a la página principal</a>.</p>
                                </div>
HTML;
            $message = printCategoryFail($message);
        }
    }
?>
    <main>
        <div class="container">
            <div class="col-full push-top">
                <h1>Foro de Asyncore</h1>
            </div>
            <div class="col-full">
                <?= $message ?>
            </div>
            <div class="col-full">
                <div class="forum-list">
                    <h2 class="list-title">
                        <span>Categorías</span>
                    </h2>
                    <?php foreach ($categories as $category): ?>
                        <?php
                        $lastThread = $threadManager->getLastThreadByCategoryWithUser($category['CAT_ID']);
                        if ($lastThread) {
                            $user = $userManager->getUserById($lastThread['USER_ID']);
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
                            <?php if ($lastThread): ?>
                                <div class="last-thread">
                                    <img class='avatar'
                                         src="<?= $user['AVATAR'] ?>"
                                         alt="AVATAR DEL USUARIO <?= $user['USERNAME'] ?>">
                                    <div class="last-thread-details">
                                        <a href="thread.php?c=<?= $category['CAT_ID'] ?>&t=<?= $lastThread['THREAD_ID'] ?>"><?= $lastThread['TITULO'] ?? 'Título del hilo' ?></a>
                                        <p class="text-xsmall">By <a
                                                    href="profile.php&UID=<?= $lastThread['USER_ID'] ?>"><?= $lastThread['USERNAME'] ?></a>, <?= timeAgo($lastThread['F_CRE']) ?>
                                        </p>
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
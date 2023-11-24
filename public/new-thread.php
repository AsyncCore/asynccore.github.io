<?php
    /**
     * @var string $descripcion /src/logged-header.php
     * @var string $titulo      /src/logged-header.php
     * @var string $css         /src/logged-header.php
     * @var string $js          /src/logged-header.php
     */
    
    use src\managers\TagManager;
    use src\db\DatabaseConnection;
    use src\managers\CategoryManager;
    
    require '../src/utils/sessionInit.php';
    require DIR . '/src/utils/autoloader.php';
    require DIR . '/vendor/autoload.php';
    include_once DIR . '/src/utils/utils.php';
    include DIR . '/src/processNewThread.php';
    
    $descripcion = "Página para la creación de hilos del foro de AsynCore";
    $titulo = "Crear hilo";
    $css = ["css/style.css", "css/hilos-posts-style.css"];
    $js = ["js/script.js"];
    $cdn = ["https://friconix.com/cdn/friconix.js"];
    include_once DIR . '/src/head.php';
    if (isset($_SESSION['USER_ID'])) {
        include_once DIR . '/src/logged-header.php';
    } else {
        include_once DIR . '/src/login-header.php';
    }
    $categories = ['1', '2', '3', '4', '5'];
    
    if (!isset($_GET['c']) || !array_filter($categories, fn($cat) => $cat == $_GET['c'])) {
        header('Location: /forum.php?c=e');
        die;
    } else {
        $db = DatabaseConnection::getInstance()->getConnection();
        $tagManager = new TagManager($db);
        $tags = $tagManager->getAllTags();
        $categoryManager = new CategoryManager($db);
        $categoria = $categoryManager->getCategory(htmlspecialchars($_GET['c']));
        if (!$categoria) {
            header('Location: /forum.php?c=nf');
            die;
        }
    }
?>
    <main>
        <h1>Nuevo hilo en <i><?=$categoria['TITULO']?></i></h1>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="create-form" method="POST">
            <div class="form-group">
                <label for="post-title">Título:</label>
                <input id="post-title" name="post-title" required type="text">
            </div>
            <div class="form-group">
                <label for="post-subtitle">Subtítulo:</label>
                <input id="post-subtitle" name="post-subtitle" required type="text">
            </div>

            <div class='form-group'>
                <label>Etiquetas:</label>
                <div id='tag-checkboxes'>
                    <?php foreach ($tags as $tag): ?>
                        <div class="checkbox">
                            <input type="checkbox" id="tag-<?= $tag['ETI_ID'] ?>" name="post-tags[]"
                                   value="<?= $tag['ETI_ID'] ?>">
                            <label for="tag-<?= $tag['ETI_ID'] ?>">
                                #<?= $tag['NOMBRE'] ?>
                                <span class="tooltip"><?= $tag['DESC'] ?></span>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="form-group">
                <label for="post-content">Contenido:</label>
                <textarea id="post-content" name="post-content" required rows="4"></textarea>
            </div>

            <div class="btn-group">
                <button class="btn btn-red">Cancelar</button>
                <button class="btn btn-blue" type="submit" name="Publish">Publicar</button>
            </div>
        </form>
    </main>
<?php
    include_once "../src/footer.php";
?>
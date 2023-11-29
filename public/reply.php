<?php
    /**
     * @var string $descripcion /src/logged-header.php
     * @var string $titulo      /src/logged-header.php
     * @var string $css         /src/logged-header.php
     * @var string $js          /src/logged-header.php
     */
    
    /*TODO HAY QUE REPINTAR EL FORMULARIO!!!!*/
    /* TODO HAY QUE AÑADIR LOS TAGS DE LOS POST!!!*/
    
    use src\managers\TagManager;
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    use src\managers\PostsManager;
    use src\managers\ThreadManager;
    
    require '../src/init.php';
    
    if(isset($_POST['contenido'])) {
        include DIR . '/src/processReply.php';
    }
    
    if (!isset($_GET['t'])) {
        header('Location: /forum.php?t=e');
        die;
    } else {
        $db = DatabaseConnection::getInstance()->getConnection();
        $tagManager = new TagManager($db);
        $tags = $tagManager->getAllTags();
        $threadManager = new ThreadManager($db);
        $threadId = htmlspecialchars($_GET['t']);
        $thread = $threadManager->getThread($threadId);
        if (!$thread) {
            header('Location: /forum.php?t=nf');
            die;
        }
        if (isset($_GET['p'])) {
            $postManager = new PostsManager($db);
            $userManager = new UserManager($db);
            $postId = htmlspecialchars($_GET['p']);
            $post = $postManager->getPost($postId);
            if (!$post) {
                header('Location: /forum.php?p=nf');
                die;
            }
            $replyId = $postId;
            $reply = $postManager->getPost($replyId);
            $username = $userManager->getUserById($reply['USER_ID'])['USERNAME'];
        }
    }
    
    $descripcion = "Página para responder a un post";
    $titulo = "RESPONDER POST";
    $css = ["css/style.css", "css/hilos-posts-style.css"];
    $js = [["js/script.js"], ['/tinymce/tinymce.min.js', 'origin']];
    $cdn = ["https://friconix.com/cdn/friconix.js"];
    
    include_once DIR . '/src/head.php';
    if (isset($_COOKIE[COOKIE_NAME]) || isset($_SESSION['USER_ID'])) {
        include_once DIR . '/src/logged-header.php';
    } else {
        include_once DIR . '/src/login-header.php';
    }
?>
    <main>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                tinymce.init({
                    selector: '#contenido',
                    plugins: ' searchreplace autolink directionality visualblocks visualchars image link media code codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap emoticons autosave',
                    toolbar_mode: 'floating',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    height: 500,
                    menubar: false,
                    toolbar: 'undo redo | code codesample | formatselect | emoticons | bold italic underline | alignleft aligncenter alignright alignjustify | h1 h2 h3 h4 h5 h6 | bullist numlist outdent indent | link image | removeformat | help',
                    setup: function (editor) {
                        editor.on('init', function () {
                            let content = <?= json_encode($reply['CONTENIDO'] ?? '') ?>;
                            let userId = <?= json_encode($reply['USER_ID'] ?? '') ?>;
                            let username = <?= json_encode($username ?? '') ?>;

                            if (content) {
                                editor.setContent(`
                                    <p>
                                        <strong>
                                            <a href="/profile.php?UID=${userId}">${username}</a>
                                        </strong> dijo:
                                    </p>
                                    <blockquote>
                                        <p>
                                            ${content}
                                        </p>
                                    </blockquote>
                                    <p></p>`
                                );
                                editor.focus();
                                let allParagraphs = editor.dom.select('p');
                                let lastParagraph = allParagraphs[allParagraphs.length - 1];
                                editor.selection.setCursorLocation(lastParagraph, 0);
                            }
                        });
                    }
                });

                let form = document.getElementById('form');
                if (form) {
                    form.addEventListener('submit', function() {
                        let editor = tinymce.get('contenido');
                        let content = editor.getContent();
                        document.getElementById('contenido').value = content.replace(/<p><strong>.*?<\/blockquote>/s, '');
                    });
                }
            })
        </script>
        <h2 class="editar-titulo">Responder a: '<?=$thread['TITULO']?>'</h2>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="edit-form" id="form" method="POST">
            <label class="form-label" for="contenido"></label>
            <textarea class="form-textarea" id="contenido" name="contenido" rows="8"></textarea>
            <?php if ($thread ?? false):?>
            <input type="hidden" name="thread" value="<?=$threadId?>">
            <?php endif;?>
            <?php if ($post ?? false):?>
            <input type="hidden" name="post" value="<?=$postId ?? ''?>">
            <?php endif;?>
            <?php if ($replyId ?? false):?>
            <input type="hidden" name="reply" value="<?=$replyId ?? ''?>">
            <?php endif;?>
            <input class="form-submit" type="submit" value="Responder">
        </form>
    </main>
<?php
    include_once "../src/footer.php";
?>
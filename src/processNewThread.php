<?php
    
    use src\Logger;
    use src\LogLevels;
    use src\managers\TagManager;
    use src\db\DatabaseConnection;
    use src\managers\ThreadManager;
    
    require 'init.php';
    
    const TITLE_MIN_LENGTH = 1;
    const TITLE_MAX_LENGTH = 255;
    const SUBTITLE_MIN_LENGTH = 1;
    const SUBTITLE_MAX_LENGTH = 255;
    const CONTENT_MIN_LENGTH = 1;
    const CONTENT_MAX_LENGTH = 65535;
    
    const TITLE_MIN_LENGTH_ERROR = 'El título debe tener al menos ' . TITLE_MIN_LENGTH . ' carácter.';
    const TITLE_MAX_LENGTH_ERROR = 'El título no puede tener más de ' . TITLE_MAX_LENGTH . ' caracteres.';
    const SUBTITLE_MIN_LENGTH_ERROR = 'El subtítulo debe tener al menos ' . SUBTITLE_MIN_LENGTH . ' carácter.';
    const SUBTITLE_MAX_LENGTH_ERROR = 'El subtítulo no puede tener más de ' . SUBTITLE_MAX_LENGTH . ' caracteres.';
    const CONTENT_MIN_LENGTH_ERROR = 'El contenido debe tener al menos ' . CONTENT_MIN_LENGTH . ' carácter.';
    const CONTENT_MAX_LENGTH_ERROR = 'El contenido no puede tener más de ' . CONTENT_MAX_LENGTH . ' caracteres.';
    
    const TITLE_EMPTY_ERROR = 'El título no puede estar vacío.';
    const SUBTITLE_EMPTY_ERROR = 'El subtítulo no puede estar vacío.';
    const CONTENT_EMPTY_ERROR = 'El contenido no puede estar vacío.';
    
    $db = DatabaseConnection::getInstance()->getConnection();
    $tagManager = new TagManager($db);
    $threadManager = new ThreadManager($db);
    
    $errors = [];
    
    $catId = '';
    if (isset($_GET['c'])) {
        $catId = htmlspecialchars($_GET['c']);
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = isset($_POST['post-title']) ? sanitizeData($_POST['post-title']) : null;
        $subtitle = isset($_POST['post-subtitle']) ? sanitizeData($_POST['post-subtitle']) : null;
        $content = isset($_POST['post-content']) ? sanitizeData($_POST['post-content']) : null;
        $tags = $_POST['post-tags'] ?? [];
        
        $errors [] = validateTitle($title);
        $errors [] = validateSubtitle($subtitle);
        $errors [] = validateContent($content);
        
        if (!array_filter($errors)){
            try {
                $threadId = false;//$threadManager->createThread($title, $subtitle, $content, $_SESSION['USER_ID'], $catId);
                
                if (!$threadId) {
                    throw new Exception("Error al crear el hilo", 1);
                }
                
                foreach ($tags as $tagId) {
                    $threadManager->associateTagWithThread($threadId, $tagId);
                }
    
            } catch (Exception $e) {
                Logger::log("Error al crear un hilo: " . $e->getMessage(), __FILE__, LogLevels::ERROR);
                header('Location: /category.php?c=' . $catId . '&nt=e');
                die;
            }
        }
    }


<?php
    
    use src\Logger;
    use src\LogLevels;
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    use src\managers\PostsManager;
    use src\managers\ThreadManager;
    
    require 'init.php';

    const CONTENT_MIN_LENGTH = 1;
    const CONTENT_MAX_LENGTH = 65535;
    const CONTENT_MIN_LENGTH_ERROR = 'La respuesta debe tener al menos ' . CONTENT_MIN_LENGTH . ' carácter.';
    const CONTENT_MAX_LENGTH_ERROR = 'La respuesta no puede tener más de ' . CONTENT_MAX_LENGTH . ' caracteres.';
    const CONTENT_EMPTY_ERROR = 'La respuesta no puede estar vacía.';
    
    $db = DatabaseConnection::getInstance()->getConnection();
    $postManager = new PostsManager($db);
    $threadManager = new ThreadManager($db);
    $userManager = new UserManager($db);
    $errors = [];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $threadId = $_POST['thread'] ?? null;
        $postId = $_POST['post'] ?? null;
        $replyId = $_POST['reply'] ?? null;
        $content = $_POST['contenido'] ?? null;
        
        if (empty($content)) {
            $errors[] = CONTENT_EMPTY_ERROR;
        } else if (strlen($content) < CONTENT_MIN_LENGTH) {
            $errors[] = CONTENT_MIN_LENGTH_ERROR;
        } else if (strlen($content) > CONTENT_MAX_LENGTH) {
            $errors[] = CONTENT_MAX_LENGTH_ERROR;
        }
        
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $content = $purifier->purify($content);
        
        if (!array_filter($errors)) {
            try {
                if (!isset($_SESSION['USER_ID'])) {
                    printMessage('danger', ERROR_MESSAGES['nl']);
                    header('Location: /login-register.php');
                    exit;
                }
                
                $result = $postManager->createPost($_SESSION['USER_ID'], $threadId, $content, $replyId);
                
                if (!$result) {
                    throw new Exception('Error al guardar la respuesta', 1);
                }
                $threadCategory = $threadManager->getThread($threadId)['CAT_ID'];
                $userManager->updateLastSeen($_SESSION['USER_ID']);
                header('Location: /thread.php?c=' . $threadCategory . '&t=' . $threadId);
                exit;
            } catch (Exception $e) {
                Logger::log('Error al procesar la respuesta: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                $errors[] = 'Hubo un error al procesar tu respuesta. Por favor, inténtalo de nuevo.';
            }
        }
    }
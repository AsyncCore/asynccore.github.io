<?php
    
    use src\Logger;
    use src\LogLevels;
    use src\db\DatabaseConnection;
    use src\managers\TokenManager;
    
    require 'init.php';

    $db = DatabaseConnection::getInstance()->getConnection();
    $tokenManager = new TokenManager($db);
    
    if (isset($_SESSION['TOKEN'])) {
        $token = $_SESSION['TOKEN'];
        try {
            $tokenManager->deleteToken($token);
        } catch (Exception $e) {
            Logger::log('Error en el proceso de eliminación de token: ' . $e->getMessage(), __FILE__, LogLevels::EXCEPTION);
            header('Location: /error-pages/dbError.php');
            die;
        }
    }
    
    if (isset($_COOKIE[COOKIE_NAME])) {
        setcookie(COOKIE_NAME, '', 1, '/');
    }
    $_SESSION = [];
    session_destroy();
    header('Location: /login-register.php?logout');
    exit;



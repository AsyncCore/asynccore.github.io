<?php
    
    use src\Logger;
    use src\LogLevels;
    use src\managers\UserManager;
    use src\managers\TokenManager;
    use src\db\DatabaseConnection;
    
    if (isset($_COOKIE[COOKIE_NAME])) {
        $db = DatabaseConnection::getInstance()->getConnection();
        $tokenManager = new TokenManager($db);
        $token = $_COOKIE[COOKIE_NAME];
        try {
            $tokenData = $tokenManager->validateToken($token);
            if ($tokenData) {
                $userManager = new UserManager($db);
                $user = $userManager->getUserById($tokenData['USER_ID']);
                $userManager->updateLastSeen($user['USER_ID']);
                $_SESSION['USER_ID'] = $user['USER_ID'];
                $_SESSION['NAME'] = $user['NAME'];
                $_SESSION['USERNAME'] = $user['USERNAME'];
                $_SESSION['EMAIL'] = $user['EMAIL'];
                $_SESSION['F_REG'] = $user['F_REG'];
                $_SESSION['AVATAR'] = $user['AVATAR'];
                $_SESSION['FIRMA'] = $user['FIRMA'];
                $_SESSION['USER_TYPE'] = $user['USER_TYPE'];
                $_SESSION['LAST_SEEN'] = $user['LAST_SEEN'];
                $_SESSION['TOKEN'] = $token;
                $tokenManager->updateToken($token);
            } else {
                $tokenManager->deleteToken($token);
                setcookie(COOKIE_NAME, '', 1, '/');
                session_destroy();
                header('Location: /login-register.php?nl');
                die;
            }
        } catch (Exception $e) {
            setcookie(COOKIE_NAME, '', 1, '/');
            session_destroy();
            Logger::log('Error en el proceso de manejo de token: ' . $e->getMessage(), __FILE__, LogLevels::EXCEPTION);
            header('Location: /error-pages/dbError.php');
            die;
        }
    } else {
        session_destroy();
        header('Location: /login-register.php?nl');
        die;
    }
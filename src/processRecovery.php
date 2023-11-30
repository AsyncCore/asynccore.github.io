<?php
    
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    use src\managers\TokenManager;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $correo = $_POST['correo'];
        
        $db = DatabaseConnection::getInstance()->getConnection();
        $userManager = new UserManager($db);
        $tokenManager = new TokenManager($db);
        $user = $userManager->getUserByEmail($correo);
        
        if ($user) {
            $token = $tokenManager->generateRecoveryToken($user['USER_ID']);
            
            $message = printMessage('recovery', ERROR_MESSAGES);
        } else {
            $message = printMessage('recovery', ERROR_MESSAGES);
        }
    }

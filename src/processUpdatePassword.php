<?php
    
    use src\Logger;
    use src\LogLevels;
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    use src\managers\TokenManager;
    
    $messageBlueprint = [
        [
            'type' => '',
            'title' => '',
            'message' => ''
        ],
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];
        $token = $_POST['token'];
        
        if ($newPassword !== $confirmPassword) {
            $messageBlueprint['type'] = 'danger';
            $messageBlueprint['message'] = 'Las contraseñas no coinciden';
            $message = printMessage('danger', $messageBlueprint);
            die;
        }
        
        $passwordLength = strlen($newPassword);
        
        if (($passwordLength < 8) || ($passwordLength > 16)) {
            $messageBlueprint['type'] = 'danger';
            $messageBlueprint['message'] = 'La contraseña debe tener al menos 8 caracteres';
            $message = printMessage('danger', $messageBlueprint);
            die;
        }
        
        $db = DatabaseConnection::getInstance()->getConnection();
        $tokenManager = new TokenManager($db);
        
        try {
            $token = $tokenManager->validateToken($token);
            if ($token) {
                $userManager = new UserManager($db);
                $user = $userManager->getUserById($token['USER_ID']);
                if ($user) {
                    $userManager->updatePassword($user['USER_ID'], password_hash($newPassword, PASSWORD_DEFAULT));
                    $tokenManager->deleteToken($token['TOKEN_ID']);
                    $messageBlueprint['type'] = 'success';
                    $messageBlueprint['message'] = 'Contraseña actualizada correctamente. Ya puedes iniciar sesión';
                    $message = printMessage('success', $messageBlueprint);
                    header('Refresh: 5; url=' . URL_BASE . 'login-register.php', true, 302);
                } else {
                    Logger::log('No se encontró el usuario con id: ' . $token['USER_ID'], __FILE__, LogLevels::ERROR);
                    $messageBlueprint['type'] = 'danger';
                    $messageBlueprint['message'] = 'ERROR FATAL: Vuelve a intentarlo más tarde';
                    $message = printMessage('danger', $messageBlueprint);
                }
                sleep(3);
                header('Location: /login-register.php');
            } else {
                Logger::log('No se encontró el token: ' . $token . ' o está expirado.', __FILE__, LogLevels::ERROR);
                $messageBlueprint['type'] = 'danger';
                $messageBlueprint['message'] = 'ERROR FATAL: Vuelve a intentarlo más tarde';
                $message = printMessage('danger', $messageBlueprint);
            }
        } catch (Exception $e) {
            Logger::log('Error al validar el token: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
            $messageBlueprint['type'] = 'danger';
            $messageBlueprint['message'] = 'ERROR FATAL: Vuelve a intentarlo más tarde';
            $message = printMessage('danger', $messageBlueprint);
        }
    }

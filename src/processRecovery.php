<?php
    
    use src\Logger;
    use src\LogLevels;
    use src\mail\MailConfig;
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    use src\managers\TokenManager;
    use PHPMailer\PHPMailer\PHPMailer;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $correo = $_POST['correo'];
        $db = DatabaseConnection::getInstance()->getConnection();
        $userManager = new UserManager($db);
        $tokenManager = new TokenManager($db);
        $user = $userManager->getUserByEmail($correo);
        
        if ($user) {
            try {
                $token = $tokenManager->generateRecoveryToken($user['USER_ID'], $user['EMAIL']);
                $tokenString = $tokenManager->getRecoveryTokenByMail($user['EMAIL'])['TOKEN'];
            } catch (Exception $e) {
                Logger::log('Error en el proceso de generación de token de recuperación: ' . $e->getMessage(), __FILE__, LogLevels::EXCEPTION);
                header('Location: /error-pages/dbError.php');
                die;
            }
            
            if ($token){
                $mail = new PHPMailer(true);
                $mail->CharSet = 'UTF-8';
                $config = MailConfig::getInstance()->getConfigItem('config');
                
                try {
                    $mail->isSMTP();
                    $mail->Host = $config['host'];
                    $mail->SMTPAuth = true;
                    $mail->Username = $config['username'];
                    $mail->Password = $config['password'];
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = $config['port'];
                    
                    $mail->setFrom($config['fromMail'], $config['fromName']);
                    $mail->addAddress($correo);
                    
                    $mail->isHTML();
                    $mail->Subject = 'Recuperación de contraseña - Foro AsynCore';
                    $mail->Body    = 'Buenas, ' . $user['NAME'] . '.<br><br>Para recuperar tu contraseña, haz click en el siguiente enlace: <a href="' . URL_BASE . 'newPassword.php?token=' . $tokenString . '">' . URL_BASE . 'newPassword.php?token=' . $tokenString . '</a><br><br>Si no has solicitado la recuperación de tu contraseña, ignora este mensaje.<br><br>Un saludo, el equipo de AsynCore.';
                    $mail->AltBody = 'Buenas, ' . $user['NAME'] . '. ' . PHP_EOL . ' Para recuperar tu contraseña, haz click en el siguiente enlace: ' . URL_BASE . 'newPassword.php?token=' . $tokenString . '. ' . PHP_EOL . 'Si no has solicitado la recuperación de tu contraseña, ignora este mensaje. ' . PHP_EOL . 'Un saludo, el equipo de AsynCore.';
                    
                    $mail->send();
                } catch (Exception $e) {
                    Logger::log('El mensaje no pudo ser enviado. Mailer Error: ' . $mail->ErrorInfo, __FILE__, LogLevels::ERROR);
                    $message = printMessage('recovery-fail', ERROR_MESSAGES);
                    die;
                }
            }
        }
        $message = printMessage('recovery', ERROR_MESSAGES);
    }

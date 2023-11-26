<?php
    
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    use src\managers\TokenManager;
    
    /* Importar funcionalidad global */
    require 'init.php';
    
    /* Definición de constantes */
    /* INT */
    /**
     * @const NAMES_MIN_LENGTH Longitud mínima de los nombres.
     * @const NAMES_MAX_LENGTH Longitud máxima de los nombres.
     * @const PASSWORD_MIN_LENGTH Longitud mínima de las contraseñas.
     * @const PASSWORD_MAX_LENGTH Longitud máxima de las contraseñas.
     * @const COOKIE_TIME Tiempo de vida de las cookies.
     */
    const NAMES_MIN_LENGTH = 3;
    const NAMES_MAX_LENGTH = 50;
    const PASSWORD_MIN_LENGTH = 8;
    const PASSWORD_MAX_LENGTH = 16;
    
    /* STRING */
    /**
     * @const ACTIVE_TAB_DEFAULT Tab activa por defecto en el formulario.
     * @const ACTIVE_TAB_REGISTER Tab activa para ir al formulario de registro.
     * @const CHECKED Valor del checkbox cuando está marcado.
     * @const EMPTY_STRING Cadena vacía.
     * @const MAIL_ERROR Mensaje de error para el campo de email.
     * @const MAIL_PATTERN Patrón para validar el campo de email.
     * @const MAIL_REQUIRED_ERROR Mensaje de error para el campo de email cuando está vacío.
     * @const NAME_COMPARISON_DEFAULT Nombre de la variable para diferenciar el nombre del usuario del nombre real.
     * @const NAME_ERROR Mensaje de error para el campo de nombre cuando no cumple el patrón.
     * @const NAME_LENGTH_ERROR Mensaje de error para el campo de nombre cuando no cumple la longitud.
     * @const NAME_PATTERN Patrón para validar el campo de nombre.
     * @const NAME_REQUIRED_ERROR Mensaje de error para el campo de nombre cuando está vacío.
     * @const PASSWORD_LENGTH_ERROR Mensaje de error para el campo de contraseña cuando no cumple la longitud.
     * @const PASSWORD_NOT_EQUAL_ERROR Mensaje de error para el campo de repetir contraseña cuando no coincide con el campo de contraseña.
     * @const PASSWORD_REQUIRED_ERROR Mensaje de error para el campo de contraseña cuando está vacío.
     * @const TERMS_ERROR Mensaje de error para el campo de términos y condiciones cuando no está marcado.
     * @const UNCHECKED Valor del checkbox cuando no está marcado.
     * @const USERNAME_PATTERN Patrón para validar el campo de nombre de usuario.
     * @const USERNAME_REQUIRED_ERROR Mensaje de error para el campo de nombre de usuario cuando está vacío.
     * @const USERNAME_LENGTH_ERROR Mensaje de error para el campo de nombre de usuario cuando no cumple la longitud.
     * @const USERNAME_ERROR Mensaje de error para el campo de nombre de usuario cuando no cumple el patrón.
     */
    const ACTIVE_TAB_DEFAULT = 'login';
    const ACTIVE_TAB_REGISTER = 'registro';
    const CHECKED = '1';
    const MAIL_ERROR = "El Email debe ser de EducaMadrid <br> Ejemplo: 'usuario@educa.madrid.org'";
    const MAIL_PATTERN = '/^[a-zA-Z0-9_.+-]+@educa\.madrid\.org$/';
    const MAIL_REQUIRED_ERROR = 'El Email es obligatorio';
    const NAME_COMPARISON_DEFAULT = 'registerName';
    const NAME_ERROR = 'Solo se permiten letras y espacios';
    const NAME_LENGTH_ERROR = 'El nombre debe tener entre ' . NAMES_MIN_LENGTH . ' y ' . NAMES_MAX_LENGTH . ' caracteres';
    const NAME_PATTERN = '/^[a-zA-ZÀ-ÖØ-öø-ÿ ]+$/';
    const NAME_REQUIRED_ERROR = 'El nombre es obligatorio';
    const PASSWORD_LENGTH_ERROR = 'La contraseña debe tener entre ' . PASSWORD_MIN_LENGTH . ' y ' . PASSWORD_MAX_LENGTH . ' caracteres';
    const PASSWORD_NOT_EQUAL_ERROR = 'Las contraseñas no coinciden';
    const PASSWORD_REQUIRED_ERROR = 'La contraseña es obligatoria';
    const TERMS_ERROR = 'Debes aceptar los términos y condiciones';
    const UNCHECKED = '0';
    const USERNAME_PATTERN = '/^[a-zA-Z0-9_.-]+$/';
    const USERNAME_REQUIRED_ERROR = 'El nombre de usuario es obligatorio';
    const USERNAME_LENGTH_ERROR = 'El nombre de usuario debe tener entre ' . NAMES_MIN_LENGTH . ' y ' . NAMES_MAX_LENGTH . ' caracteres';
    const USERNAME_ERROR = 'Solo se permiten letras, números y los caracteres especiales: _ . -';
    
    /* Conexión a la base de datos */
    $db = DatabaseConnection::getInstance()->getConnection();
    
    /* Instancia de UserManager */
    $userManager = new UserManager($db);
    
    /* VARIABLES */
    /* Variables generales del script */
    $activeTab = $_POST['form'] ?? ACTIVE_TAB_DEFAULT;
    $errores = [];
    $cookieName = EMPTY_STRING;
    $cookieValue = EMPTY_STRING;
    
    /* Variables del formulario de login */
    $_SESSION['loginEmail'] = $_SESSION['loginEmail'] ?? EMPTY_STRING;
    $_SESSION['loginPassword'] = $_SESSION['loginPassword'] ?? EMPTY_STRING;
    $_SESSION['loginCheck'] = $_SESSION['loginCheck'] ?? EMPTY_STRING;
    $_SESSION['loginEmailError'] = $_SESSION['loginEmailError'] ?? EMPTY_STRING;
    $_SESSION['loginPasswordError'] = $_SESSION['loginPasswordError'] ?? EMPTY_STRING;
    
    /* Variables del formulario de registro */
    $_SESSION['registerName'] = $_SESSION['registerName'] ?? EMPTY_STRING;
    $_SESSION['registerUserName'] = $_SESSION['registerUserName'] ?? EMPTY_STRING;
    $_SESSION['registerEmail'] = $_SESSION['registerEmail'] ?? EMPTY_STRING;
    $_SESSION['registerPassword'] = $_SESSION['registerPassword'] ?? EMPTY_STRING;
    $_SESSION['registerRepeatPassword'] = $_SESSION['registerRepeatPassword'] ?? EMPTY_STRING;
    $_SESSION['registerCheck'] = $_SESSION['registerCheck'] ?? EMPTY_STRING;
    $_SESSION['registerNameError'] = $_SESSION['registerNameError'] ?? EMPTY_STRING;
    $_SESSION['registerUserNameError'] = $_SESSION['registerUserNameError'] ?? EMPTY_STRING;
    $_SESSION['registerEmailError'] = $_SESSION['registerEmailError'] ?? EMPTY_STRING;
    $_SESSION['registerPasswordError'] = $_SESSION['registerPasswordError'] ?? EMPTY_STRING;
    $_SESSION['registerRepeatPasswordError'] = $_SESSION['registerRepeatPasswordError'] ?? EMPTY_STRING;
    $_SESSION['registerCheckError'] = $_SESSION['registerCheckError'] ?? EMPTY_STRING;
    
    /* Comprobaciones de validación */
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['form'] === 'login') {
        $_SESSION['loginEmail'] = sanitizeData($_POST['loginEmail']);
        $_SESSION['loginPassword'] = sanitizeData($_POST['loginPassword']);
        $_SESSION['loginCheck'] = isset($_POST['loginCheck']) ? CHECKED : UNCHECKED;
        $errores [] = validateMail($_SESSION['loginEmail']);
        $errores [] = validatePassword($_SESSION['loginPassword']);
        $_SESSION['loginEmailError'] = $errores[0];
        $_SESSION['loginPasswordError'] = $errores[1];
        
        if (!array_filter($errores)) {
            $usuario = $userManager->login($_SESSION['loginEmail'], $_SESSION['loginPassword']);
            if (!$usuario) {
                header('Location: login-register.php?loginTab&error&login');
            } else {
                if ($_SESSION['loginCheck'] === CHECKED) {
                    $tokenManager = new TokenManager($db);
                    try{
                        $token = $tokenManager->getTokenByUserId($usuario['USER_ID']);
                        if ($token) {
                            $tokenManager->updateToken($token['TOKEN']);
                            $cookieValue = $token['TOKEN'];
                        }else{
                            $token = $tokenManager->generateToken($usuario['USER_ID']);
                            $cookieValue = $token;
                        }
                        setcookie(COOKIE_NAME, $cookieValue, COOKIE_EXPIRY_TIME, '/', DOMAIN_NAME);
                        $userManager->updateLastSeen($usuario['USER_ID']);
                    }catch (Exception $e) {
                        header("Location: error-pages/dbError.php");
                        die;
                    }
                }
                $_SESSION['NAME'] = $usuario['NAME'];
                $_SESSION['USERNAME'] = $usuario['USERNAME'];
                $_SESSION['EMAIL'] = $usuario['EMAIL'];
                $_SESSION['USER_ID'] = $usuario['USER_ID'];
                $_SESSION['AVATAR'] = $usuario['AVATAR'];
                $_SESSION['F_REG'] = $usuario['F_REG'];
                $_SESSION['USER_TYPE'] = $usuario['USER_TYPE'];
                unsetLoginRegister();
                header('Location: login-register.php?loginTab&success&login');
            }
            die;
        }
        
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form'] == 'register') {
        $_SESSION['registerName'] = sanitizeData($_POST['registerName'], true);
        $_SESSION['registerUserName'] = sanitizeData($_POST['registerUserName'], true);
        $_SESSION['registerEmail'] = sanitizeData($_POST['registerEmail']);
        $_SESSION['registerPassword'] = sanitizeData($_POST['registerPassword']);
        $_SESSION['registerRepeatPassword'] = sanitizeData($_POST['registerRepeatPassword']);
        $_SESSION['registerCheck'] = isset($_POST['registerCheck']) ? CHECKED : UNCHECKED;
        $errores [] = validateName($_SESSION['registerName'], NAME_COMPARISON_DEFAULT);
        $errores [] = validateName($_SESSION['registerUserName'], 'registerUserName');
        $errores [] = validateMail($_SESSION['registerEmail']);
        $errores [] = validatePassword($_SESSION['registerPassword']);
        $errores [] = validatePassword($_SESSION['registerRepeatPassword']);
        $errores [] = $_SESSION['registerPassword'] == $_SESSION['registerRepeatPassword'] ? EMPTY_STRING : PASSWORD_NOT_EQUAL_ERROR;
        $errores [] = $_SESSION['registerCheck'] == CHECKED ? EMPTY_STRING : TERMS_ERROR;
        $_SESSION['registerNameError'] = $errores[0];
        $_SESSION['registerUserNameError'] = $errores[1];
        $_SESSION['registerEmailError'] = $errores[2];
        $_SESSION['registerPasswordError'] = $errores[3];
        $_SESSION['registerRepeatPasswordError'] = $errores[4];
        $_SESSION['registerRepeatPasswordError'] = $errores[5];
        $_SESSION['registerCheckError'] = $errores[6];
        
        if (!array_filter($errores)) {
            $usuario = $userManager->register($_SESSION['registerName'], $_SESSION['registerUserName'], $_SESSION['registerEmail'], $_SESSION['registerPassword']);
            if (!$usuario) {
                header('Location: login-register.php?registerTab&error&register');
            } else {
                $_SESSION['loginEmail'] = $_SESSION['registerEmail'];
                $_SESSION['loginPassword'] = $_SESSION['registerPassword'];
                header('Location: login-register.php?register&success&loginTab');
            }
        } else {
            header('Location: login-register.php?registerTab');
        }
        die;
    }
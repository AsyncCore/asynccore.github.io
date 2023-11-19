<?php
    /* Iniciar sesión para manejar la información del usuario */
    
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    use src\managers\TokenManager;
    
    /* Importar funciones de utilidades */
    require 'utils/sessionInit.php';
    require_once 'utils/utils.php';
    
    /* Definición de constantes */
    /* INT */
    const NAMES_MIN_LENGTH = 3;
    const NAMES_MAX_LENGTH = 50;
    const PASSWORD_MIN_LENGTH = 8;
    const PASSWORD_MAX_LENGTH = 16;
    
    /* STRING */
    const ACTIVE_TAB_DEFAULT = 'login';
    const ACTIVE_TAB_REGISTER = 'registro';
    const CHECKED = '1';
    const EMPTY_STRING = '';
    const MAIL_ERROR = "El Email debe ser de EducaMadrid <br> Ejemplo: 'usuario@educa.madrid.org'";
    const MAIL_PATTERN = '/^[a-zA-Z0-9_.+-]+@educa\.madrid\.org$/';
    const MAIL_REQUIRED_ERROR = 'El Email es obligatorio';
    const METHOD_POST = 'POST';
    const NAME_COMPARISON_DEFAULT = 'registerName';
    const NAME_ERROR = 'Solo se permiten letras y espacios';
    const NAME_LENGTH_ERROR = 'El nombre debe tener entre 3 y 50 caracteres';
    const NAME_PATTERN = '/^[a-zA-ZÀ-ÖØ-öø-ÿ ]+$/';
    const NAME_REQUIRED_ERROR = 'El nombre es obligatorio';
    const PASSWORD_LENGTH_ERROR = 'La contraseña debe tener entre ' . PASSWORD_MIN_LENGTH . ' y ' . PASSWORD_MAX_LENGTH . ' caracteres';
    const PASSWORD_NOT_EQUAL_ERROR = 'Las contraseñas no coinciden';
    const PASSWORD_REQUIRED_ERROR = 'La contraseña es obligatoria';
    const TERMS_ERROR = 'Debes aceptar los términos y condiciones';
    const UNCHECKED = '0';
    const USERNAME_PATTERN = '/^[a-zA-Z0-9_.-]+$/';
    const USERNAME_REQUIRED_ERROR = 'El nombre de usuario es obligatorio';
    const USERNAME_LENGTH_ERROR = 'El nombre de usuario debe tener entre 3 y 50 caracteres';
    const USERNAME_ERROR = 'Solo se permiten letras, números y los caracteres especiales: _ . -';
    define("COOKIE_TIME", time() + 60 * 60 * 24 * 7);
    
    /* Conexión a la base de datos */
    $db = DatabaseConnection::getInstance()->getConnection();
    
    /* Instancia de UserManager */
    $userManager = new UserManager($db);

// Variables para array de errores, valores del formulario, tab activa, cookies y sesiones
    $activeTab = $_POST['form'] ?? ACTIVE_TAB_DEFAULT;
    $errores = [];
    $cookieName = EMPTY_STRING;
    $cookieValue = EMPTY_STRING;
    $success = false;
    
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

// Verificar si se envió el formulario
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
                header('Location: login-register.php?login&error');
            } else {
                if ($_SESSION['loginCheck'] === CHECKED) {
                    $tokenManager = new TokenManager($db);
                    $tokenManager->generateToken($usuario['USER_ID']);
                    $cookieName = 'usuario' . $usuario['USER_ID'];
                    $cookieValue = $usuario['USERNAME'];
                    setcookie($cookieName, $cookieValue, COOKIE_TIME, '/', true, true);
                }
                $_SESSION['NAME'] = $usuario['NAME'];
                $_SESSION['USERNAME'] = $usuario['USERNAME'];
                $_SESSION['EMAIL'] = $usuario['EMAIL'];
                $_SESSION['USER_ID'] = $usuario['USER_ID'];
                $_SESSION['AVATAR'] = $usuario['AVATAR'];
                $_SESSION['FECHA_REGISTRO'] = $usuario['FECHA_REGISTRO'];
                $_SESSION['TIPO_USUARIO'] = $usuario['TIPO_USUARIO'];
                unsetLoginRegister();
                header('Location: login-register.php?login&success');
            }
            die;
        }
        
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form'] == 'register') {
        $_SESSION['registerName'] = sanitizeData($_POST['registerName'], true);
        $_SESSION['registerUserName'] = sanitizeData($_POST['registerUserName']);
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
                header('Location: login-register.php?register&error');
            } else {
                $_SESSION['loginEmail'] = $_SESSION['registerEmail'];
                $_SESSION['loginPassword'] = $_SESSION['registerPassword'];
                header('Location: login-register.php?register&success&loginTab');
            }
        }else{
            header('Location: login-register.php?register');
        }
    }
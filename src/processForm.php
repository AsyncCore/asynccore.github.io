<?php
/* Iniciar sesión para manejar la información del usuario */

use src\db\DatabaseConnection;
use src\UserManager;

session_start();

/* Importar funciones de utilidades */
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


/* Conexión a la base de datos */
$db = DatabaseConnection::getInstance()->getConnection();

/* Instancia de UserManager */
$userManager = new UserManager($db);

// Variables para array de errores, valores del formulario, tab activa, cookies y sesiones
$activeTab = $_POST['form'] ?? ACTIVE_TAB_DEFAULT;
$errores = [];
$cookieName = EMPTY_STRING;
$cookieValue = EMPTY_STRING;
$cookieTime = time() + 60 * 60 * 24 * 7;
$success = false;

/* Variables del formulario de login */
$loginEmail = $loginPassword = $loginCheck = EMPTY_STRING;

/* Variables del formulario de registro */
$registerName = $registerUserName = $registerEmail = $registerPassword = EMPTY_STRING;
$registerRepeatPassword = $registerCheck = EMPTY_STRING;

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['form'] === 'login') {
    $loginEmail = sanitizeData($_POST['loginEmail']);
    $loginPassword = sanitizeData($_POST['loginPassword']);
    $loginCheck = isset($_POST['loginCheck']) ? CHECKED : UNCHECKED;
    $errores [] = validateMail($loginEmail);
    $errores [] = validatePassword($loginPassword);

    if (!array_filter($errores)){
        $success = $userManager->login($loginEmail, $loginPassword);
        if ($success && $loginCheck === CHECKED){

            $_SESSION['user'] = $login;
            header('Location: main.php');
        }else{

        }

    }

}else if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form'] == 'register'){

}



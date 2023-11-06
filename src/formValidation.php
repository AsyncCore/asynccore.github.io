<?php /**
 * formValidation.php.<br>
 * Este archivo contiene la funcionalidad de la página de login y registro.
 * Contiene las funciones para sanear y validar los datos del formulario.
 * Además, contiene las constantes que se utilizan para mostrar los errores en el formulario.
 *
 * @author  Daniel Alonso Lázaro <dalonsolaz@gmail.com>
 * @package src
 */

use src\db\DatabaseOperations;
use src\Logger;
use src\LogLevels;

include_once 'utils/autoloader.php';

/* DEFINICIÓN DE CONSTANTES */
const NAMES_MIN_LENGTH = 3;
const NAMES_MAX_LENGTH = 50;
const PASSWORD_MIN_LENGTH = 8;
const PASSWORD_MAX_LENGTH = 16;
const ACTIVE_TAB_DEFAULT = "login";
const ACTIVE_TAB_REGISTER = "registro";
const CHECKED = "1";
const EMPTY_STRING = "";
const MAIL_ERROR = "El Email debe ser de EducaMadrid <br> Ejemplo: 'usuario@educa.madrid.org'";
const MAIL_PATTERN = "/^[a-zA-Z0-9_.+-]+@educa\.madrid\.org$/";
const MAIL_REQUIRED_ERROR = "El Email es obligatorio";
const METHOD_POST = "POST";
const NAME_COMPARISON_DEFAULT = "registerName";
const NAME_ERROR = "Solo se permiten letras y espacios";
const NAME_LENGTH_ERROR = "El nombre debe tener entre 3 y 50 caracteres";
const NAME_PATTERN = "/^[a-zA-ZÀ-ÖØ-öø-ÿ ]+$/";
const NAME_REQUIRED_ERROR = "El nombre es obligatorio";
const PASSWORD_LENGTH_ERROR = "La contraseña debe tener entre " . PASSWORD_MIN_LENGTH . " y " . PASSWORD_MAX_LENGTH . " caracteres";
const PASSWORD_NOT_EQUAL_ERROR = "Las contraseñas no coinciden";
const PASSWORD_REQUIRED_ERROR = "La contraseña es obligatoria";
const TERMS_ERROR = "Debes aceptar los términos y condiciones";
const UNCHECKED = "0";
const USERNAME_PATTERN = "/^[a-zA-Z0-9_.-]+$/";
const USERNAME_REQUIRED_ERROR = "El nombre de usuario es obligatorio";
const USERNAME_LENGTH_ERROR = "El nombre de usuario debe tener entre 3 y 50 caracteres";
const USERNAME_ERROR = "Solo se permiten letras, números y los caracteres especiales: _ . -";

/* DEFINICIÓN DE VARIABLES */

/* Variables de error en el formulario de login*/
$loginEmailError = $loginPasswordError = EMPTY_STRING;
/* Variables del formulario de login */
$loginEmail = $loginPassword = $loginCheck = EMPTY_STRING;

/* Variables de error en el formulario de registro */
$registerNameError = $registerUserNameError = $registerEmailError = EMPTY_STRING;
$registerPasswordError = $registerRepeatPasswordError = $registerCheckError = EMPTY_STRING;
/* Variables del formulario de registro */
$registerName = $registerUserName = $registerEmail = $registerPassword = EMPTY_STRING;
$registerRepeatPassword = $registerCheck = EMPTY_STRING;

# Establece la pestaña activa en el formulario dependiendo de la que se haya pulsado al enviarlo
$activeTab = $_POST['form'] ?? ACTIVE_TAB_DEFAULT;

$success = $_POST['registerSuccess'] ?? FALSE; /* TODO ????? no recuerdo para qué era esto */

/**
 * sanitizeData.<br>
 * Función para sanear los datos del formulario.
 *
 * @param string $data Datos que se van a sanear.
 * @param bool $case Si es true, convierte la parte del mail que va después de la @ a minúsculas.
 *
 * @return string Devuelve los datos saneados.
 */
function sanitizeData(string $data, bool $case): string
{
    $inicio = strpos($data, "@");
    $fin = strpos($data, ".org");
    $data = trim($data);
    $data = stripslashes($data);
    if ($case) {
        $temp = substr($data, $inicio, $fin);
        $data = str_replace($temp, strtolower($temp), $data);
    }
    return htmlspecialchars($data);
}

/**
 * validateMail.<br>
 * Función para validar el email que comprueba si está vacío y si no lo está comprueba que sea de EducaMadrid.
 *
 * @param string $mail Email que se va a validar
 *
 * @return string Devuelve un string vacío si no hay errores o un string con el error correspondiente.
 */
function validateMail(string $mail): string
{
    if (empty($mail)) {
        return MAIL_REQUIRED_ERROR;
    } else {
        if (!preg_match(MAIL_PATTERN, $mail)) {
            return MAIL_ERROR;
        }
        return EMPTY_STRING;
    }
}

/**
 * validatePassword.<br>
 * Función para validar la password que comprueba si está vacía y si no lo está comprueba la longitud.
 *
 * @param string $password Password que se va a validar
 *
 * @return string Devuelve un string vacío si no hay errores o un string con el error correspondiente.
 */
function validatePassword(string $password): string
{
    if (empty($password)) {
        return PASSWORD_REQUIRED_ERROR;
    } else {
        $length = strlen($password);
        if ($length < PASSWORD_MIN_LENGTH || $length > PASSWORD_MAX_LENGTH) {
            return PASSWORD_LENGTH_ERROR;
        }
        return EMPTY_STRING;
    }
}

/**
 * validateName.<br>
 * Función para validar el nombre que comprueba si está vacío y si no lo está comprueba que cumple el contener solo
 * letras, letras acentuadas y espacios. Además, comprueba la longitud.
 *
 * @param string $name Nombre que se va a validar.
 * @param string $type Tipo de nombre que se va a validar.
 *
 * @return string - Devuelve un string vacío si no hay errores o un string con el error correspondiente.
 */
function validateName(string $name, string $type): string
{
    if (empty($name)) {
        return $type == NAME_COMPARISON_DEFAULT ? NAME_REQUIRED_ERROR : USERNAME_REQUIRED_ERROR;
    }

    if (!preg_match(NAME_PATTERN, $name) && $type == NAME_COMPARISON_DEFAULT) {
        return NAME_ERROR;
    }

    if (!preg_match(USERNAME_PATTERN, $name) && $type != NAME_COMPARISON_DEFAULT) {
        return USERNAME_ERROR;
    }

    $length = strlen($name);
    if ($length < NAMES_MIN_LENGTH || $length > NAMES_MAX_LENGTH) {
        return $type == NAME_COMPARISON_DEFAULT ? NAME_LENGTH_ERROR : USERNAME_LENGTH_ERROR;
    }
    return EMPTY_STRING;
}

/**
 * jsRedirectToMain.<br>
 * Función para redirigir a la página principal enviando el mail del usuario por POST con javascript.
 *
 * @param string $mail Mail del usuario
 *
 * @return void
 */
function jsRedirectToMain(string $mail): void
{
    echo "<form id='redirectForm' method='POST' action='/main.php'>
            <input type='hidden' name='success' value='true'>
            <input type='hidden' name='loginEmail' value='$mail'>
            <!-- TODO quizá enviar un array con la sesión y más datos del usuario? -->
          </form>
          <script type='text/javascript'>
              document.getElementById('redirectForm').submit();
          </script>";
}

/**
 * jsRedirectToLogin.<br>
 * Función que redirige a la página de login enviando el mail y la contraseña del usuario por POST con javascript.
 *
 * @param string $registerEmail
 * @param string $registerPassword
 * @param string $message
 *
 * @return string
 */
function jsRedirectToLoginScreen(string $registerEmail, string $registerPassword, string $message): string
{
    return "<form id='redirectForm' method='POST' action='login-register.php'>
            <input type='hidden' name='form' value='login'>
            <input type='hidden' name='registerSuccess' value='true'>
            <input type='hidden' name='loginEmail' value='$registerEmail'>
            <input type='hidden' name='loginPassword' value='$registerPassword'>
            <input type='hidden' name='message' value='$message'>
          </form>
          <script type='text/javascript'>
              document.getElementById('redirectForm').submit();
          </script>";
}

/* LÓGICA */
# Comprueba si la pestaña que ha enviado el formulario es la pestaña de login
if ($_SERVER["REQUEST_METHOD"] == METHOD_POST && $_POST['form'] == ACTIVE_TAB_DEFAULT) {
    $loginEmail = sanitizeData($_POST["loginEmail"], TRUE);
    $loginEmailError = validateMail($loginEmail);
    $loginPassword = sanitizeData($_POST["loginPassword"], FALSE);
    $loginPasswordError = validatePassword($loginPassword);

    # Establece el valor del checkbox a 0 si no está marcado
    $loginCheck = !isset($_POST["loginCheck"]) ? UNCHECKED : CHECKED;

    # Si hay algún error en el formulario, no se redirige a la página principal
    if ($loginEmailError == EMPTY_STRING && $loginPasswordError == EMPTY_STRING && ($loginCheck == CHECKED xor $loginCheck == UNCHECKED) && $success) {
        jsRedirectToMain($loginEmail);
    }else{
        $redirect = "<form id='redirectForm' method='POST' action='/src/login.php'>
            <input type='hidden' name='loginEmail' value='$loginEmail'>
            <input type='hidden' name='loginPassword' value='$loginPassword'>
            <input type='hidden' name='loginCheck' value='$loginCheck'>
          </form>
          <script type='text/javascript'>
              document.getElementById('redirectForm').submit();
          </script>";
        echo $redirect;
    }
    exit;
}

# Comprueba si la pestaña que ha enviado el formulario es la pestaña de registro
if ($_SERVER["REQUEST_METHOD"] == METHOD_POST && $_POST['form'] == ACTIVE_TAB_REGISTER) {
    $registerName = sanitizeData($_POST["registerName"], FALSE);
    $registerNameError = validateName($registerName, NAME_COMPARISON_DEFAULT);

    $registerUserName = sanitizeData($_POST["registerUserName"], FALSE);
    $registerUserNameError = validateName($registerUserName, "registerUserName");

    $registerEmail = sanitizeData($_POST["registerEmail"], TRUE);
    $registerEmailError = validateMail($registerEmail);

    $registerPassword = sanitizeData($_POST["registerPassword"], FALSE);
    $registerPasswordError = validatePassword($registerPassword);

    $registerRepeatPassword = sanitizeData($_POST["registerRepeatPassword"], FALSE);
    $registerRepeatPasswordError = validatePassword($registerRepeatPassword);
    $registerRepeatPasswordError = $registerPassword == $registerRepeatPassword ? EMPTY_STRING : PASSWORD_NOT_EQUAL_ERROR;

    $registerCheck = !isset($_POST["registerCheck"]) ? UNCHECKED : CHECKED;

    if ($registerCheck === UNCHECKED) {
        $registerCheckError = TERMS_ERROR;
    }

    # Array con todos los errores del formulario
    $errores = [$registerNameError, $registerUserNameError, $registerEmailError, $registerPasswordError, $registerRepeatPasswordError, $registerCheckError];

    # Si no hay callback, todos los false (cadenas vacías) se eliminan y, por tanto, es !false y se redirige al login
    if (!array_filter($errores) && $registerCheck === CHECKED) {
        # Pop-up de registro correcto que se muestra al registrarse correctamente.
        try {
            $insert = new DatabaseOperations();
            $insert->insertAlumno($registerUserName, $registerPassword, $registerEmail);
            $message = <<<HTML
                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </symbol>
                    </svg>
                    <div class="alert alert-success d-flex align-items-center alert-dismissible" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                        <div style="margin-left: 20px;">
                            Usuario <b>
                    HTML. $registerUserName . <<<HTML
                                </b> registrado correctamente.<br>Inicia sesión para continuar...
                            </div>
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    HTML;
            echo jsRedirectToLoginScreen($registerEmail, $registerPassword, $message);
            exit;
        } catch (PDOException $e) {
            Logger::log($e->getMessage(), __DIR__, LogLevels::EXCEPTION);
            echo "Error de la BD: " . $e->getMessage();
            echo "<br>";
            echo "Inténtelo de nuevo más tarde...";
        }
    }
}
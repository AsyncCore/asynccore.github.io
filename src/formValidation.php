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
        include_once 'login.php';
        /*$redirect = "<form id='redirectForm' method='POST' action='src/login.php'>
            <input type='hidden' name='loginEmail' value='$loginEmail'>
            <input type='hidden' name='loginPassword' value='$loginPassword'>
            <input type='hidden' name='loginCheck' value='$loginCheck'>
          </form>
          <script type='text/javascript'>
              document.getElementById('redirectForm').submit();
          </script>";
        echo $redirect;*/
    }
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
            echo $registerUserName;
            $message = '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </symbol>
                    </svg>
                    <div class="alert alert-success d-flex align-items-center alert-dismissible" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                        <div style="margin-left: 20px;"> Usuario <b>' . $registerUserName . '</b> registrado correctamente.<br>Inicia sesión para continuar...</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            echo jsRedirectToLoginScreen($registerEmail, $registerPassword, $message);
            exit;
        } catch (PDOException $e) {
            Logger::log($e->getMessage(), __FILE__, LogLevels::EXCEPTION);
            echo "Error de la BD: " . $e->getMessage();
            echo "<br>";
            echo "Inténtelo de nuevo más tarde...";
        }
    }
}
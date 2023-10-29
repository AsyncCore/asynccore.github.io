<?php
/*TODO añadir comentarios en el código para simplificar su lectura*/
const METHOD = "POST";
const ACTIVE_TAB_DEFAULT = "login";
const ACTIVE_TAB_REGISTER = "registro";
const CHECKED = "1";
const UNCHECKED = "0";
const EMPTY_STRING = "";
const MAIL_OBLIGATORIO = "El Email es obligatorio";
const PASSWORD_OBLIGATORIA = "La contraseña es obligatoria";
const NOMBRE_OBLIGATORIO = "El nombre es obligatorio";
const USUARIO_OBLIGATORIO = "El nombre de usuario es obligatorio";
const MAIL_PATTERN = "/^[a-zA-Z0-9_.+-]+@educa\.madrid\.org$/";
const NAME_PATTERN = "/^[a-zA-ZÀ-ÖØ-öø-ÿ ]+$/";
const USERNAME_PATTERN = "/^[a-zA-Z0-9_.-]+$/";
const MAIL_ERROR = "El Email debe ser de EducaMadrid <br> Ejemplo: 'usuario@educa.madrid.org'";
const NAME_ERROR = "Solo se permiten letras y espacios";
const PASSWORD_MISSING = "Debes escribir una contraseña";
const PASSWORD_NOT_EQUAL = "Las contraseñas no coinciden";
const NAME_LENGTH_ERROR = "El nombre debe tener entre 3 y 50 caracteres";
const TERMS_ERROR = "Debes aceptar los términos y condiciones";
const PASSWORD_MIN_LENGTH = 8;
const PASSWORD_MAX_LENGTH = 16;
const PASSWORD_LENGTH_ERROR = "La contraseña debe tener entre ". PASSWORD_MIN_LENGTH . " y " . PASSWORD_MAX_LENGTH . " caracteres";
const NOMBRES_MIN_LENGTH = 3;
const NOMBRES_MAX_LENGTH = 50;

$loginEmailError = $loginPasswordError = EMPTY_STRING;
$loginEmail = $loginPassword = $loginCheck = EMPTY_STRING;

$registerNameError = $registerUserNameError = $registerEmailError = $registerPasswordError =
$registerRepeatPasswordError = $registerCheckError = EMPTY_STRING;

$registerName = $registerUserName = $registerEmail = $registerPassword =
$registerRepeatPassword = $registerCheck = EMPTY_STRING;

# Setea la pestaña activa en el formulario dependiendo de la que se haya pulsado al enviarlo
$activeTab = $_POST['form'] ?? ACTIVE_TAB_DEFAULT;

function sanitize_data(string $data, bool $case): string
{
    $inicio = strpos($data, "@");
    $fin = strpos($data, ".org");
    $data = trim($data);
    $data = stripslashes($data);
    if($case){
        $temp = substr($data, $inicio, $fin);
        $data = str_replace($temp, strtolower($temp), $data);
    }
    return htmlspecialchars($data);
}

# Comprueba si el formulario de login ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == METHOD && $_POST['form'] == ACTIVE_TAB_DEFAULT) {
    # Comprueba si el campo de email está vacío y si no lo valida y lo sanitiza.
    if (empty($_POST["loginEmail"])) {
        $loginEmailError = MAIL_OBLIGATORIO;
    } else {
        $loginEmail = sanitize_data($_POST["loginEmail"], true);
        if (!preg_match(MAIL_PATTERN, $loginEmail)) {
            $loginEmailError = MAIL_ERROR;
        }
    }

    # Comprueba si el campo de contraseña está vacío y si no lo valida y lo sanitiza.
    if (empty($_POST["loginPassword"])) {
        $loginPasswordError = PASSWORD_OBLIGATORIA;
    } else {
        $loginPassword = sanitize_data($_POST["loginPassword"], false);
        if (strlen($_POST["loginPassword"]) < PASSWORD_MIN_LENGTH) {
            $loginPasswordError = PASSWORD_LENGTH_ERROR;
        } else if (strlen($_POST["loginPassword"]) > PASSWORD_MAX_LENGTH) {
            $loginPasswordError = PASSWORD_LENGTH_ERROR;
        }
    }

    # Establece el valor del checkbox a 0 si no está marcado
    $loginCheck = !isset($_POST["loginCheck"]) ? UNCHECKED : CHECKED;

    # Comprueba si no hay errores en el formulario y si el checkbox está marcado y redirige a la página principal enviando el mail del usuario
    if ($loginEmailError == "" && $loginPasswordError == "" /*&& $loginCheck === CHECKED*/){
        echo "<form id='redirectForm' method='POST' action='/header.php'>
            <input type='hidden' name='success' value='true'>
            <input type='hidden' name='loginEmail' value='$loginEmail'>
          </form>
          <script type='text/javascript'>
              document.getElementById('redirectForm').submit();
          </script>";
//        $dir = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/main.php?success=$loginEmail";
//        header("Location:$dir", true, 302);
        exit;
    }
}

# Comprueba si el formulario de registro ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == METHOD && $_POST['form'] == ACTIVE_TAB_REGISTER) {
    if (empty($_POST["registerName"])) {
        $registerNameError = NOMBRE_OBLIGATORIO;
    } else {
        # Sanitiza el nombre y comprueba que solo contenga letras (con acentos) y espacios
        $registerName = sanitize_data($_POST["registerName"], false);
        if (!preg_match(NAME_PATTERN, $registerName)) {
            $registerNameError = NAME_ERROR;
        }
        if (strlen($_POST["registerName"]) < NOMBRES_MIN_LENGTH) {
            $registerNameError = NAME_LENGTH_ERROR;
        } else if (strlen($_POST["registerName"]) > NOMBRES_MAX_LENGTH) {
            $registerNameError = NAME_LENGTH_ERROR;
        }
    }

    if (empty($_POST["registerUserName"])) {
        $registerUserNameError = USUARIO_OBLIGATORIO;
    } else {
        $registerUserName = sanitize_data($_POST["registerUserName"], false);
        if (!preg_match(USERNAME_PATTERN, $registerUserName)) {
            $registerUserNameError = NAME_ERROR;
        }
        if (strlen($_POST["registerUserName"]) < NOMBRES_MIN_LENGTH) {
            $registerUserNameError = NAME_LENGTH_ERROR;
        } else if (strlen($_POST["registerUserName"]) > NOMBRES_MAX_LENGTH) {
            $registerUserNameError = NAME_LENGTH_ERROR;
        }
    }

    if (empty($_POST["registerEmail"])) {
        $registerEmailError = MAIL_OBLIGATORIO;
    } else {
        $registerEmail = sanitize_data($_POST["registerEmail"], true);
        if (!preg_match(MAIL_PATTERN, $registerEmail)) {
            $registerEmailError = MAIL_ERROR;
        }
    }

    if (empty($_POST["registerPassword"])) {
        $registerPasswordError = PASSWORD_OBLIGATORIA;
    } else {
        $registerPassword = sanitize_data($_POST["registerPassword"], false);
        if (strlen($_POST["registerPassword"]) < PASSWORD_MIN_LENGTH) {
            $registerPasswordError = PASSWORD_LENGTH_ERROR;
        } else if (strlen($_POST["registerPassword"]) > PASSWORD_MAX_LENGTH) {
            $registerPasswordError = PASSWORD_LENGTH_ERROR;
        }
    }

    if (empty($_POST["registerRepeatPassword"])) {
        $registerRepeatPasswordError = PASSWORD_MISSING;
    } else {
        $registerRepeatPassword = sanitize_data($_POST["registerRepeatPassword"], false);
        if (strlen($_POST["registerRepeatPassword"]) < PASSWORD_MIN_LENGTH) {
            $registerRepeatPasswordError = PASSWORD_LENGTH_ERROR;
        } else if (strlen($_POST["registerRepeatPassword"]) > PASSWORD_MAX_LENGTH) {
            $registerRepeatPasswordError = PASSWORD_LENGTH_ERROR;
        }

        if ($_POST["registerRepeatPassword"] !== $_POST["registerPassword"]) {
            $registerRepeatPasswordError = PASSWORD_NOT_EQUAL;
        }
    }


    $registerCheck = !isset($_POST["registerCheck"]) ? UNCHECKED : CHECKED;

    if ($registerCheck === UNCHECKED) {
        $registerCheckError = TERMS_ERROR;
    }

    if ($registerNameError == "" && $registerUserNameError == "" && $registerEmailError == "" &&
        $registerPasswordError == "" && $registerRepeatPasswordError == "" && $registerCheckError == "" && $registerCheck === CHECKED) {
        $message = <<<HTML
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>
            <div class="alert alert-success d-flex align-items-center alert-dismissible" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div style="margin-left: 20px;">
                    Usuario <b>
        HTML . $registerUserName . <<<HTML
                    </b> registrado correctamente.<br>Inicia sesión para continuar...
                </div>
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        HTML;

        echo "<form id='redirectForm' method='POST' action='login-register.php'>
            <input type='hidden' name='form' value='login'>
            <input type='hidden' name='loginEmail' value='$registerEmail'>
            <input type='hidden' name='loginPassword' value='$registerPassword'>
            <input type='hidden' name='message' value='$message'>
          </form>
          <script type='text/javascript'>
              document.getElementById('redirectForm').submit();
          </script>";
//        $dir = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/main.php?success=$loginEmail";
//        header("Location:$dir", true, 302);
        exit;
    }
}
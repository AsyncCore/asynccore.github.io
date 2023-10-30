<?php
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
const PASSWORD_LENGTH_ERROR = "La contraseña debe tener entre ". PASSWORD_MIN_LENGTH . " y " . PASSWORD_MAX_LENGTH . " caracteres";
const PASSWORD_NOT_EQUAL_ERROR = "Las contraseñas no coinciden";
const PASSWORD_REQUIRED_ERROR = "La contraseña es obligatoria";
const TERMS_ERROR = "Debes aceptar los términos y condiciones";
const UNCHECKED = "0";
const USERNAME_PATTERN = "/^[a-zA-Z0-9_.-]+$/";
const USERNAME_REQUIRED_ERROR = "El nombre de usuario es obligatorio";
const USERNAME_LENGTH_ERROR = "El nombre de usuario debe tener entre 3 y 50 caracteres";
const USERNAME_ERROR = "Solo se permiten letras, números y los caracteres especiales: _ . -";

$loginEmailError = $loginPasswordError = EMPTY_STRING;
$loginEmail = $loginPassword = $loginCheck = EMPTY_STRING;

$registerNameError = $registerUserNameError = $registerEmailError = $registerPasswordError =
$registerRepeatPasswordError = $registerCheckError = EMPTY_STRING;

$registerName = $registerUserName = $registerEmail = $registerPassword =
$registerRepeatPassword = $registerCheck = EMPTY_STRING;

# Establece la pestaña activa en el formulario dependiendo de la que se haya pulsado al enviarlo
$activeTab = $_POST['form'] ?? ACTIVE_TAB_DEFAULT;

$success = $_POST['registerSuccess'] ?? false;

# Pop-up de registro correcto que se muestra al registrarse correctamente.
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
            HTML . $registerUserName . <<<HTML
                        </b> registrado correctamente.<br>Inicia sesión para continuar...
                    </div>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            HTML;

/**
 * Función para sanear los datos del formulario.
 * @param string $data Datos que se van a sanear.
 * @param bool $case Si es true, convierte la parte del mail que va después de la @ a minúsculas.
 * @return string Devuelve los datos saneados.
 */
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

/**
 * Función para validar el email que comprueba si está vacío y si no lo está comprueba que sea de EducaMadrid.
 * @param string $mail Email que se va a validar
 * @return string Devuelve un string vacío si no hay errores o un string con el error correspondiente.
 */
function validate_mail(string $mail): string
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
 * Función para validar la password que comprueba si está vacía y si no lo está comprueba la longitud.
 * @param string $password Password que se va a validar
 * @return string Devuelve un string vacío si no hay errores o un string con el error correspondiente.
 */
function validate_password(string $password): string
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
 * Función para validar el nombre que comprueba si está vacío y si no lo está comprueba que cumple el contener solo letras, letras acentuadas y espacios. Además, comprueba la longitud.
 * @param string $name Nombre que se va a validar.
 * @param string $type Tipo de nombre que se va a validar.
 * @return string - Devuelve un string vacío si no hay errores o un string con el error correspondiente.
 */
function validate_name(string $name, string $type): string
{
    if(empty($name)){
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
 * Función para redirigir a la página principal enviando el mail del usuario por POST con javascript.
 * @param string $mail Mail del usuario
 * @return void
 */
function js_redirect_main(string $mail) : void
{
    echo "<form id='redirectForm' method='POST' action='/main.php'>
            <input type='hidden' name='success' value='true'>
            <input type='hidden' name='loginEmail' value='$mail'>
          </form>
          <script type='text/javascript'>
              document.getElementById('redirectForm').submit();
          </script>";
}

# Comprueba si la pestaña que ha enviado el formulario es la pestaña de login
if ($_SERVER["REQUEST_METHOD"] == METHOD_POST && $_POST['form'] == ACTIVE_TAB_DEFAULT) {
    $loginEmail = sanitize_data($_POST["loginEmail"], true);
    $loginEmailError = validate_mail($loginEmail);
    $loginPassword = sanitize_data($_POST["loginPassword"], false);
    $loginPasswordError = validate_password($loginPassword);

    # Establece el valor del checkbox a 0 si no está marcado
    $loginCheck = !isset($_POST["loginCheck"]) ? UNCHECKED : CHECKED;

    if ($loginEmailError == EMPTY_STRING && $loginPasswordError == EMPTY_STRING && !$success){
        js_redirect_main($loginEmail);
        exit;
    }
}

# Comprueba si la pestaña que ha enviado el formulario es la pestaña de registro
if ($_SERVER["REQUEST_METHOD"] == METHOD_POST && $_POST['form'] == ACTIVE_TAB_REGISTER) {
    $registerName = sanitize_data($_POST["registerName"], false);
    $registerNameError = validate_name($registerName, NAME_COMPARISON_DEFAULT);

    $registerUserName = sanitize_data($_POST["registerUserName"], false);
    $registerUserNameError = validate_name($registerUserName, "registerUserName");

    $registerEmail = sanitize_data($_POST["registerEmail"], true);
    $registerEmailError = validate_mail($registerEmail);

    $registerPassword = sanitize_data($_POST["registerPassword"], false);
    $registerPasswordError = validate_password($registerPassword);

    $registerRepeatPassword = sanitize_data($_POST["registerRepeatPassword"], false);
    $registerRepeatPasswordError = validate_password($registerRepeatPassword);
    $registerRepeatPasswordError = $registerPassword == $registerRepeatPassword ? EMPTY_STRING : PASSWORD_NOT_EQUAL_ERROR;

    $registerCheck = !isset($_POST["registerCheck"]) ? UNCHECKED : CHECKED;

    if ($registerCheck === UNCHECKED) {
        $registerCheckError = TERMS_ERROR;
    }

    if ($registerNameError == EMPTY_STRING && $registerUserNameError == EMPTY_STRING && $registerEmailError == EMPTY_STRING &&
        $registerPasswordError == EMPTY_STRING && $registerRepeatPasswordError == EMPTY_STRING && $registerCheckError == EMPTY_STRING && $registerCheck === CHECKED) {

        echo "<form id='redirectForm' method='POST' action='login-register.php'>
            <input type='hidden' name='form' value='login'>
            <input type='hidden' name='registerSuccess' value='true'>
            <input type='hidden' name='loginEmail' value='$registerEmail'>
            <input type='hidden' name='loginPassword' value='$registerPassword'>
            <input type='hidden' name='message' value='$message'>
          </form>
          <script type='text/javascript'>
              document.getElementById('redirectForm').submit();
          </script>";
        exit;
    }
}
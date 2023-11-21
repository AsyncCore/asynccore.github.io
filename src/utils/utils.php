<?php
    /**
     * utils.php
     *
     * Script con funciones que proporcionan utilidad.
     * Contiene funciones para formatear fechas, redirigir a páginas, validar formularios, obtener mensajes de error,
     * imprimir información, etc.
     *
     * @package utils
     * @version 1.0.0
     * @auhor   Daniel Alonso Lázaro <dalonsolaz@gmail.com>
     */
    
    /* CONSTANTES CON EL HTML PARA LOS MODALES DE INFO, ÉXITO Y ALERTA */
    const INFO_SVG = '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </symbol>
                    </svg>';
    
    const SUCCESS_SVG = '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </symbol>
                        </svg>';
    
    const ALERT_SVG = '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol>
                        </svg>';
    
    const INFO = '<div class="alert alert-primary d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                    <div class="d-flex align-items-center flex-column">
                        {message}
                    </div>';
    
    const SUCCESS = '<div class="alert alert-success d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                        <div class="d-flex align-items-center flex-column">
                            {message}
                        </div>';
    
    const WARNING = '<div class="alert alert-warning d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div class="d-flex align-items-center flex-column">
                            {message}
                        </div>;
                    </div>';
    
    const DANGER = '<div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div class="d-flex align-items-center flex-column">
                            {message}
                        </div>;
                    </div>';
    
    /**
     * Función que cambia el formato de una fecha.
     *
     * Lo más usual es que la fecha venga en formato Y-m-d H:i:s y se quiera mostrar en formato d/m/Y H:i:s.
     * También aceptaría d/m/y o d-m-y o cualquier combinación de ellas.
     *
     * @param string $date   Fecha en formato Y-m-d H:i:s.
     * @param string $format Formato de la fecha.
     *
     * @return string Fecha en formato d/m/Y H:i:s.
     */
    function formatDate(string $date, string $format): string
    {
        return date_format(date_create($date), $format);
    }
    
    /**
     * Función para sanear los datos del formulario.
     *
     * Elimina espacios en blanco, convierte a minúsculas y elimina barras invertidas.
     * Además, convierte caracteres especiales en entidades HTML.
     *
     * @param string $data Dato que se va a sanear.
     *
     * @return string Devuelve el dato saneado.
     */
    function sanitizeData(string $data, bool $name = false): string
    {
        if ($name) {
            $data = preg_replace('/\s+/', ' ', $data);
            $data = trim($data);
            $data = stripslashes($data);
            return htmlspecialchars($data);
        }
        $data = trim(strtolower($data));
        $data = stripslashes($data);
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    
    /**
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
     * Función para validar el nombre que comprueba si está vacío y si no lo está comprueba que cumple el contener solo
     * letras, letras acentuadas y espacios. Además, comprueba la longitud.
     *
     * @param string $name Nombre que se va a validar.
     * @param string $type Tipo de nombre que se va a validar para poder devolver el error correcto.
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
     * Imprime un mensaje de éxito de inicio de sesión y proporciona una redirección.
     *
     * @param string $username El nombre de usuario para el cual se está imprimiendo el mensaje de éxito.
     *
     * @returns string Devuelve un string HTML que incluye un mensaje de bienvenida personalizado para el usuario y una redirección a la página principal.
     */
    function printLoginSuccess(string $username): string
    {
        $url = 'https://' . $_SERVER['HTTP_HOST'] . '/' . 'main.php';
        $message = <<<HTML
                    <div class="mb-4">¡Bienvenido <b>$username</b>!</div>
                    <div>Redirigiendo a la página principal...<br>
                        <span class="small">Si no se redirige en 5 segundos, pulsa <a href="$url">aquí</a></span>
                    </div>
                    HTML;
        return SUCCESS_SVG . PHP_EOL . str_replace('{message}', $message, SUCCESS);
    }
    
    /**
     * Imprime un mensaje de error de inicio de sesión.
     *
     * @returns string Devuelve un string HTML que indica un error en el inicio de sesión, como un nombre de usuario o contraseña incorrectos.
     */
    function printLoginFail(): string
    {
        $message = '<div>Nombre de usuario o contraseña incorrectos.</div>';
        return ALERT_SVG . PHP_EOL . str_replace('{message}', $message, DANGER);
    }
    
    /**
     * Imprime un mensaje de error de registro.
     *
     * Esta función también utiliza 'returnSQLError()' para detallar el mensaje de error basándose en el error de SQL.
     *
     * @param string $username El nombre de usuario para el cual se intentó el registro.
     *
     * @return string Devuelve un string HTML que incluye un mensaje de error específico para el intento fallido de registro del usuario.
     * @see returnSQLError()
     */
    function printRegisterFail(string $username): string {
        $sqlError = returnSQLError();
        $message = <<<HTML
                    <div>
                        No se ha podido registrar al usuario <b>$username</b>.<br>
                        $sqlError
                    </div>
                    HTML;
        
        return ALERT_SVG . PHP_EOL . str_replace('{message}', $message, DANGER);
    }
    
    /**
     * Imprime un mensaje de éxito de registro.
     *
     * @param string $username El nombre de usuario que se ha registrado con éxito.
     *
     * @return string Devuelve un string HTML que incluye un mensaje de confirmación de registro exitoso para el usuario.
     */
    function printRegisterSuccess(string $username): string {
        $message = <<<HTML
                    <div>
                        Usuario <b>$username</b> registrado correctamente.<br>
                        Inicia sesión para continuar...
                    </div>
                    HTML;
        
        return SUCCESS_SVG . PHP_EOL . str_replace('{message}', $message, SUCCESS);
    }
    
    /**
     * Devuelve un mensaje de error específico basado en el error de SQL ocurrido.
     *
     * Dependencias:
     *   - Utiliza $_SESSION['USERMANAGER_SQL_ERROR'] para determinar el tipo de error SQL.
     *   - Depende de los valores de sesión $_SESSION['registerEmail'] y $_SESSION['registerUserName'].
     *
     * @return string Mensaje de error basado en el error de SQL.
     */
    function returnSQLError(): string
    {
        if (str_contains($_SESSION['USERMANAGER_SQL_ERROR'], 'EMAIL')) {
            return 'El mail <b>' . $_SESSION['registerEmail'] . '</b> ya existe.';
        } else if (str_contains($_SESSION['USERMANAGER_SQL_ERROR'], 'USERNAME')) {
            return 'El nombre de usuario <b>' . $_SESSION['registerUserName'] . '</b> ya existe.';
        } else {
            return 'Error al registrar el usuario.<br>Por favor, inténtelo de nuevo más tarde.';
        }
    }
    
    /**
     * Limpia las variables de sesión relacionadas con el inicio de sesión y el registro.
     *
     * Previene el posible uso indebido de datos residuales.
     *
     * Efectos Secundarios:
     *   - Elimina todas las variables de sesión utilizadas en el proceso de autenticación.
     *
     * @return void
     */
    function unsetLoginRegister(): void
    {
        $loginRegisterSession = [
            'loginEmail', 'loginPassword', 'loginCheck',
            'loginEmailError', 'loginPasswordError',
            'registerName', 'registerUserName', 'registerEmail',
            'registerPassword', 'registerRepeatPassword', 'registerCheck',
            'registerNameError', 'registerUserNameError', 'registerEmailError',
            'registerPasswordError', 'registerRepeatPasswordError', 'registerCheckError'
        ];
        
        foreach ($loginRegisterSession as $item) {
            if (isset($_SESSION[$item])) {
                unset($_SESSION[$item]);
            }
        }
    }
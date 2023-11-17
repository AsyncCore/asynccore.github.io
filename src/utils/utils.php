<?php
    /**
     * utils.php
     *
     * Archivo con funciones que proporcionan utilidad.
     * Contiene funciones para formatear fechas, redirigir a páginas, validar formularios, etc.
     *
     * @package utils
     * @version 1.0.0
     * @auhor Daniel Alonso Lázaro <dalonsolaz@gmail.com>
     */

    /* FECHAS */
	/**
	 * Función que cambia el formato de una fecha.
     *
	 * Lo más usual es que la fecha venga en formato Y-m-d H:i:s y se quiera mostrar en formato d/m/Y H:i:s.
     * También aceptaría d/m/y o d-m-y o cualquier combinación de ellos.
	 * @param string $date Fecha en formato Y-m-d H:i:s.
     * @param string $format Formato de la fecha.
	 * @return string Fecha en formato d/m/Y H:i:s.
	 */
	function formatDate(string $date, string $format): string
	{
		return date_format(date_create($date), $format);
	}

    /* FORMULARIOS */
    /**
     * Función para sanear los datos del formulario.
     *
     * Elimina espacios en blanco, convierte a minúsculas y elimina barras invertidas.
     * Además, convierte caracteres especiales en entidades HTML.
     *
     * @param string $data Dato que se va a sanear.
     * @return string Devuelve el dato saneado.
     */
    function sanitizeData(string $data): string
    {
        $data = trim(strtolower($data));
        $data = stripslashes($data);
        return htmlspecialchars($data);
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

    /* REDIRECCIONES */

    /**
     * Función para redirigir a la página principal enviando el mail del usuario por POST con javascript.
     *
     * @param string $mail Mail del usuario
     *
     * @return void
     */
    function jsRedirectToMain(string $mail): void
    {
        echo "<form id='redirectForm' method='POST' action='login-register.php'>
                <input type='hidden' name='success' value='true'>
                <input type='hidden' name='loginEmail' value='$mail'>
                <!-- TODO quizá enviar un array con la sesión y más datos del usuario? -->
              </form>
              <script type='text/javascript'>
                  document.getElementById('redirectForm').submit();
              </script>";
    }

    /**
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

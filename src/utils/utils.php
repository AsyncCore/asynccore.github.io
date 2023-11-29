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
     * Función para imprimir el tiempo transcurrido desde una acción del usuario.
     *
     * Imprime el tiempo transcurrido desde una acción del usuario en formato "hace X tiempo".
     * @param string $datetime - Fecha en formato Y-m-d H:i:s.
     *
     * @return string - Devuelve el tiempo transcurrido desde la acción del usuario.
     */
    function timeAgo(string $datetime): string
    {
        $timeAgo = strtotime($datetime);
        $currentTime = time();
        $timeDifference = $currentTime - $timeAgo;
        $seconds = $timeDifference;
        $minutes = round($seconds / 60);
        $hours = round($seconds / 3600);
        $days = round($seconds / 86400);
        $weeks = round($seconds / 604800);
        $months = round($seconds / 2629440);
        $years = round($seconds / 31553280);
        
        if ($seconds <= 60) {
            return 'hace menos de un minuto';
        } else if ($minutes <= 60) {
            return $minutes == 1 ? 'hace un minuto' : "hace $minutes minutos";
        } else if ($hours <= 24) {
            return $hours == 1 ? 'hace una hora' : "hace $hours horas";
        } else if ($days <= 7) {
            return $days == 1 ? 'ayer' : "hace $days días";
        } else if ($weeks <= 4.3) {
            return $weeks == 1 ? 'hace una semana' : "hace $weeks semanas";
        } else if ($months <= 12) {
            return $months == 1 ? 'hace un mes' : "hace $months meses";
        } else {
            return $years == 1 ? 'hace un año' : "hace $years años";
        }
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
    function sanitizeData(string $data, bool $name = false, $contenido = false): string
    {
        if ($name) {
            $data = preg_replace('/\s+/', ' ', $data);
            $data = trim($data);
            $data = stripslashes($data);
            if($contenido){
                return $data;
            }
            return htmlspecialchars($data);
        }
        $data = trim(strtolower($data));
        $data = stripslashes($data);
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    
    function validateTitle($data): string
    {
        if (empty($data)) {
            return TITLE_EMPTY_ERROR;
        } else {
            $length = strlen($data);
            if ($length < TITLE_MIN_LENGTH) {
                return TITLE_MIN_LENGTH_ERROR;
            } else if ($length > TITLE_MAX_LENGTH) {
                return TITLE_MAX_LENGTH_ERROR;
            }
            return EMPTY_STRING;
        }
    }
    
    function validateSubtitle($data): string
    {
        if (empty($data)) {
            return SUBTITLE_EMPTY_ERROR;
        } else {
            $length = strlen($data);
            if ($length < SUBTITLE_MIN_LENGTH) {
                return SUBTITLE_MIN_LENGTH_ERROR;
            } else if ($length > SUBTITLE_MAX_LENGTH) {
                return SUBTITLE_MAX_LENGTH_ERROR;
            }
            return EMPTY_STRING;
        }
    }
    
    function validateContent($data): string
    {
        if (empty($data)) {
            return CONTENT_EMPTY_ERROR;
        } else {
            $length = strlen($data);
            if ($length < CONTENT_MIN_LENGTH) {
                return CONTENT_MIN_LENGTH_ERROR;
            } else if ($length > CONTENT_MAX_LENGTH) {
                return CONTENT_MAX_LENGTH_ERROR;
            }
            return EMPTY_STRING;
        }
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
    
    function getNestedReplyContent($postId, $postManager, $userManager, $depth = 0): string
    {
        if ($depth > 1) {
            return '';
        }
        
        $post = $postManager->getPost($postId);
        if (!$post) {
            return '';
        }
        
        $replyContent = '';
        if ($post['REPLY_ID'] != null) {
            $reply = $postManager->getPost($post['REPLY_ID']);
            $replyUser = $userManager->getUserById($reply['USER_ID']);
            $replyUsername = $replyUser['USERNAME'] ?? '';
            
            $replyContent = "<blockquote class='small'>
                <div class='author'>
                    <a href='profile.php?UID={$reply['USER_ID']}' class=''>{$replyUsername}</a>
                    <span class='time'>" . timeAgo($reply['F_CRE']) . "</span>
                </div>
                <div class='quote'>
                 " . getNestedReplyContent($post['REPLY_ID'], $postManager, $userManager, $depth + 1)
                     . ($depth == 1 ? html_entity_decode($reply['CONTENIDO']) : '') . '
                </div>
            </blockquote>';
        }
        
        return $replyContent . html_entity_decode($post['CONTENIDO']);
    }
    
    function generatePagination($currentPage, $totalPages, $category, $range = 2): string
    {
        $html = '<div class="pagination">';
        
        // Primera y anterior
        if ($currentPage > 1) {
            $html .= '<a href="?c=' . $category . '&page=1">Primera página</a>';
            $html .= '<a href="?c=' . $category . '&page=' . ($currentPage - 1) . '" rel="prev">Anterior</a>';
        }
        
        // Puntos suspensivos para el inicio (si es necesario)
        if ($currentPage - $range > 1) {
            $html .= '<span class="page-separator" style="font-size: 20px">...</span>';
        }
        
        // Rango de paginación
        $start = max(1, $currentPage - $range);
        $end = min($totalPages, $currentPage + $range);
        
        for ($i = $start; $i <= $end; $i++) {
            $activeClass = $i === $currentPage ? 'active' : '';
            $html .= '<a class="' . $activeClass . '" href="?c=' . $category . '&page=' . $i . '">' . $i . '</a>';
            if ($i < $end) {
                $html .= '<span class="page-separator">|</span> ';
            }
        }
        
        // Puntos suspensivos para el final (si es necesario)
        if ($currentPage + $range < $totalPages) {
            $html .= '<span class="page-separator" style="font-size: 20px">...</span>';
        }
        
        // Siguiente y última
        if ($currentPage < $totalPages) {
            $html .= '<a href="?c=' . $category . '&page=' . ($currentPage + 1) . '" rel="next">Siguiente</a>';
            $html .= '<a href="?c=' . $category . '&page=' . $totalPages . '">Última página</a>';
        }
        
        $html .= '</div>';
        
        return $html;
    }





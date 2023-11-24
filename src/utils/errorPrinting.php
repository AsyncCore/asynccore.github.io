<?php
    
    use src\Logger;
    use src\LogLevels;
    
    /**
     * Array asociativo de iconos SVG.
     * @const array SVG_ICONS
     */
    const SVG_ICONS = [
        'INFO' => '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </symbol>
                    </svg>',
        'SUCCESS' => '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </symbol>
                        </svg>',
        'ALERT' => '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </symbol>
                    </svg>',
    ];
    
    /**
     * Array asociativo de tipos de error con el HTML para incrustar el icono.
     * @const array ERROR_TYPES
     */
    const ERROR_TYPES = [
        'INFO' => '<svg class="bi flex-shrink-0 me-2" width="75" height="75" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>',
        'SUCCESS' => '<svg class="bi flex-shrink-0 me-2" width="75" height="75" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>',
        'WARNING' => '<svg class="bi flex-shrink-0 me-2" width="75" height="75" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>',
        'DANGER' => '<svg class="bi flex-shrink-0 me-2" width="75" height="75" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>'
    ];
    
    /**
     * Array asociativo de mensajes de error.
     * @const array ERROR_MESSAGES
     */
    const ERROR_MESSAGES = [
        'c_e' => [
            'type' => 'danger',
            'title' => '400 - BAD REQUEST',
            'message' => 'La categoría que estás buscando no existe.<br>Puedes volver a la <a href="/main.php">página principal</a>.'
        ],
        'c_nf' => [
            'type' => 'danger',
            'title' => '404 - NOT FOUND',
            'message' => 'La categoría no existe o tenemos un problemilla en la BD.<br>Puedes volver a la <a href="/main.php">página principal</a>.'
        ],
        'nt_e' => [
            'type' => 'danger',
            'title' => '400 - BAD REQUEST',
            'message' => 'No se ha podido crear el hilo.<br>Puedes volver a la <a href="/main.php">página principal</a>.'
        ],
        'nt_nf' => [
            'type' => 'danger',
            'title' => '404 - NOT FOUND',
            'message' => 'El hilo no existe o tenemos un problemilla en la BD.<br>Puedes volver a la <a href="/main.php">página principal</a>.'
        ],
        't_e' => [
            'type' => 'danger',
            'title' => '400 - BAD REQUEST',
            'message' => 'El hilo que estás buscando no existe.<br>Puedes volver a la <a href="/main.php">página principal</a>.'
        ],
        't_nf' => [
            'type' => 'danger',
            'title' => '404 - NOT FOUND',
            'message' => 'El hilo no existe o tenemos un problemilla en la BD.<br>Puedes volver a la <a href="/main.php">página principal</a>.'
        ],
        'p_e' => [
            'type' => 'danger',
            'title' => '400 - BAD REQUEST',
            'message' => 'Puedes volver a la <a href="/main.php">página principal</a>.'
        ],
        'p_nf' => [
            'type' => 'danger',
            'title' => '404 - NOT FOUND',
            'message' => 'El post no existe o tenemos un problemilla en la BD.<br>Puedes volver a la <a href="/main.php">página principal</a>.'
        ],
        'UID_e' => [
            'type' => 'danger',
            'title' => '400 - BAD REQUEST',
            'message' => 'El perfil de usuario que estás buscando no existe.<br>Puedes volver a la <a href="/main.php">página principal</a>.'
        ],
        'UID_nf' => [
            'type' => 'danger',
            'title' => '404 - NOT FOUND',
            'message' => 'El usuario no existe o tenemos un problemilla en la BD.<br>Puedes volver a la <a href="/main.php">página principal</a>.'
        ],
        'login_fail' => [
            'type' => 'danger',
            'title' => '',
            'message' => 'El usuario o la contraseña son incorrectos.'
        ],
        'login_success' => [
            'type' => 'success',
            'title' => '',
            'message' => '¡Bienvenido <b>%s</b>! Redirigiendo a la página principal...<br>Si no se redirige en 5 segundos, pulsa <a href="/main.php">aquí</a>'
        ],
        'register_fail' => [
            'type' => 'danger',
            'title' => '',
            'message' => 'No se ha podido registrar al usuario <b>%s</b><br>%s'
        ],
        'register_success' => [
            'type' => 'success',
            'title' => '',
            'message' => 'Usuario <b>%s</b> registrado correctamente.<br>Inicia sesión para continuar...'
        ],
    ];
    
    /**
     * Función que imprime un mensaje de alerta.
     *
     * Imprime un mensaje de alerta con el tipo y el mensaje especificados.
     * @param string $type - Tipo de alerta
     * @param string $message - Mensaje de alerta
     *
     * @return string - Devuelve el HTML formado del mensaje de alerta.
     */
    function printAlert(string $type, string $message): string {
        $typeUpper = strtoupper($type);
        
        if (!in_array($typeUpper, ['INFO', 'SUCCESS', 'WARNING', 'DANGER'])) {
            Logger::log("Tipo de alerta inválido: '$typeUpper'", __FILE__, LogLevels::EXCEPTION);
            throw new InvalidArgumentException("Tipo de alerta no válido: '$typeUpper'");
        }
        
        $alertClass = "alert alert-$type";
        $svgIcon = SVG_ICONS['ALERT'];
        
        if ($typeUpper == 'INFO' || $typeUpper == 'SUCCESS') {
            $svgIcon = SVG_ICONS[$typeUpper];
        }
        
        $svgType = ERROR_TYPES[$typeUpper];
        
        return <<<HTML
        $svgIcon
        <div class="$alertClass d-flex align-items-center" role="alert">
            $svgType
            <div class="d-flex align-items-center flex-column">
                $message
            </div>
        </div>
    HTML;
    }
    
    
    /**
     * Función que imprime un mensaje de error.
     *
     * Imprime un mensaje de error con el tipo y el mensaje especificados.
     * @param string $type - Tipo de mensaje
     * @param array  $messages - Array de mensajes
     * @param array  $dynamicValues - Valores dinámicos para formatear el mensaje
     *
     * @return string
     */
    function printMessage(string $type, array $messages, array $dynamicValues = []): string {
        if (isset($messages[$type])) {
            $error = $messages[$type];
            $formattedMessage = $error['message'];
            
            if (!empty($dynamicValues)) {
                $formattedMessage = sprintf($formattedMessage, ...$dynamicValues);
            }
            
            $message = "<div><h2 style='text-align:center;'>{$error['title']}</h2><p style='font-size: 1.5rem;'>{$formattedMessage}</p></div>";
            return printAlert($error['type'], $message);
        }
        Logger::log("Tipo de mensaje inválido: '$type'", __FILE__, LogLevels::EXCEPTION);
        return '';
    }
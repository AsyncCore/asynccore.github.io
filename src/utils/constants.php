<?php
    /**
     * @file constants.php<br><br>
     *       Archivo que contiene las constantes del proyecto.<br><br>
     *       <strong>NOTA:</strong> Este archivo se incluye en el archivo init.php<br><br>
     * @const DIR Directorio raíz del proyecto.
     * @const URL_BASE URL base del proyecto.
     * @const DOMAIN_NAME Nombre de dominio.
     * @const EMPTY_STRING Cadena vacía.
     * @const TOKEN_EXPIRY_TIME Tiempo de expiración de los tokens.
     * @const TOKEN_LENGTH Longitud de los tokens.
     * @const TOKEN_DATE_FORMAT Formato de fecha de los tokens.
     * @const COOKIE_NAME Nombre de la cookie.
     * @const COOKIE_EXPIRY_TIME Tiempo de expiración de la cookie.
     * @const int MAX_IDLE_TIME Tiempo máximo de inactividad en minutos.
     */
    
    /**
     * @const DIR Directorio raíz del proyecto.
     */
    defined('DIR') || define('DIR', dirname(__DIR__, 2));
    
    /**
     * @const DOMAIN_NAME Nombre de dominio.
     */
    defined('DOMAIN_NAME') || define('DOMAIN_NAME', htmlspecialchars($_SERVER['HTTP_HOST']) ?? 'www.asyncore.es');
    
    /**
     * @const URL_BASE URL base del proyecto.
     */
    defined('URL_BASE') || define('URL_BASE', 'https://' . (DOMAIN_NAME ?? 'www.asyncore.es') . '/');
    
    /**
     * @const EMPTY_STRING Cadena vacía.
     */
    defined('EMPTY_STRING') || define('EMPTY_STRING', '');

    /**
     * @const TOKEN_EXPIRY_TIME Tiempo de expiración de los tokens.
     */
    defined('TOKEN_EXPIRY_TIME') || define('TOKEN_EXPIRY_TIME', time() + 60 * 60 * 24 * 7);
    
    /**
     * @const TOKEN_LENGTH Longitud de los tokens.
     */
    defined('TOKEN_LENGTH') || define('TOKEN_LENGTH', 16);
    
    /**
     * @const TOKEN_DATE_FORMAT Formato de fecha de los tokens.
     */
    defined('TOKEN_DATE_FORMAT') || define('TOKEN_DATE_FORMAT', 'Y-m-d H:i:s');
    
    /**
     * @const COOKIE_NAME Nombre de la cookie.
     */
    defined('COOKIE_NAME') || define('COOKIE_NAME', 'AsynCore');
    
    /**
     * @const COOKIE_EXPIRY_TIME Tiempo de expiración de la cookie.
     */
    defined('COOKIE_EXPIRY_TIME') || define('COOKIE_EXPIRY_TIME', time() + 60 * 60 * 24 * 7);
    
    /**
     * @const int MAX_IDLE_TIME Tiempo máximo de inactividad en minutos.
     */
    defined('MAX_IDLE_TIME') || define('MAX_IDLE_TIME', 5);
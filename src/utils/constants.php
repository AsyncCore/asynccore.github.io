<?php
    /**
     * @file constants.php<br><br>
     *       Archivo que contiene las constantes del proyecto.<br><br>
     *       <strong>NOTA:</strong> Este archivo se incluye en el archivo init.php<br><br>
     * @const DIR Directorio raíz del proyecto.
     * @const URL_BASE URL base del proyecto.
     */
    
    /**
     * @const DIR Directorio raíz del proyecto.
     */
    defined('DIR') || define('DIR', dirname(__DIR__, 2));
    
    /**
     * @const URL_BASE URL base del proyecto.
     */
    defined('URL_BASE') || define('URL_BASE', 'https://' . ($_SERVER['HTTP_HOST'] ?? 'www.asyncore.es') . '/');
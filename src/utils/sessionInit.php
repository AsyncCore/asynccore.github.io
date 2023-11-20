<?php
    /**
     * @file sessionInit.php<br><br>
     * Archivo que inicializa las sesiones y define constantes globales para el proyecto.<br><br>
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
    define('URL_BASE', 'https://' . $_SERVER['HTTP_HOST'] ?? "www.asyncore.es" . '/');
    
    /**
     * Inicialización de sesiones con comprobación de si ya hay una sesión iniciada.
     */
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
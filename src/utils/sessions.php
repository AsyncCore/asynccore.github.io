<?php
    /**
     * @file sessions.php<br><br>
     * Archivo que inicializa las sesiones<br><br>
     *       <strong>NOTA:</strong> Este archivo se incluye en el archivo init.php<br><br>
     */
    
    /**
     * Iniciar la sesión condicionalmente a que no esté ya iniciada.
     */
    if (session_status() == PHP_SESSION_NONE) {
        /**
         * Setear la duración del tiempo de vida de la sesión en 1 hora (3600 segundos)
         */
        ini_set('session.gc_maxlifetime', 3600);
        session_start();
    }
    
    /**
     * Extender el tiempo de vida de la sesión en 1 hora con cada petición.
     */
    $params = session_get_cookie_params();
    setcookie(session_name(), session_id(), time() + 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

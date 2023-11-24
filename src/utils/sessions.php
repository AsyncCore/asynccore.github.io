<?php
    /**
     * @file sessions.php<br><br>
     * Archivo que inicializa las sesiones<br><br>
     *       <strong>NOTA:</strong> Este archivo se incluye en el archivo init.php<br><br>
     */
    
    /**
     * Inicialización de sesiones con comprobación de si ya hay una sesión iniciada.
     */
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
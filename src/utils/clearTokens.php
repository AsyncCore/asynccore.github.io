<?php
    /**
     * Script para limpiar los tokens expirados de la base de datos.
     * Se ejecuta una vez a la semana desde un cron job en el servidor.
     * Se ejecuta los lunes a las 00:00 horas y manda un email con el resultado de la operación.
     */
    use src\managers\TokenManager;
    use src\db\DatabaseConnection;
    
    require 'autoloader.php';

    $db = DatabaseConnection::getInstance()->getConnection();
    $tokenManager = new TokenManager($db);
    $tokenManager->cleanUpExpiredTokens();
<?php
    /**
     * Este archivo contiene los datos de configuración de PHPMailer.
     * Es el archivo real que se utiliza para conectarse al servidor de GMAIL.
     * Mantener en .gitignore.
     *
     * @return array - Array con los datos de configuración de PHPMailer.
     */
    return [
        'config' => [
            'host'     => 'servidor de correo',
            'username' => 'email@email.com',
            'password' => 'contraseña',
            'port'     => 587,
            'from'     => 'campo DE',
            'fromMail' => 'campo FROM',
            'fromName' => 'campo FROMNAME'
        ]
    ];
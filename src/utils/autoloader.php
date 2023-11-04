<?php
    /**
     * Autoloader para cargar las clases del proyecto de forma automática.
     *
     * @param string $class Nombre de la clase que se quiere cargar.
     *
     * @return void
     */

    spl_autoload_register(function($class){
        $prefix = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $file = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $prefix . '.php';
        if(file_exists($file)){
            include_once $file;
        }
    });








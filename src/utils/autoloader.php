<?php
    /**
     * Autoloader
     *
     * Este archivo contiene el autoloader de la aplicación que se encarga de cargar las clases de forma automática.
     */
    spl_autoload_register(function($class){
        $prefix = str_replace('\\', DIRECTORY_SEPARATOR, $class);
        $file = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $prefix . '.php';
        if(file_exists($file)){
            include_once $file;
        }
    });








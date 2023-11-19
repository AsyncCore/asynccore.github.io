<?php
    /**
     * Autoloader
     *
     * Este archivo contiene el autoloader de las clases de AsynCore que se encarga de cargarlas de forma automática.
     */

spl_autoload_register(function ($class) {
    $prefix = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    //echo "\$prefix: " . $prefix . '<br>';
    //echo '__DIR__: ' . __DIR__ . PHP_EOL . "<br>";
    //echo 'DOCUMENT_ROOT: ' . $_SERVER['DOCUMENT_ROOT'] . PHP_EOL . '<br>';
    $file = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . $prefix . '.php';
    //echo 'File path: ' . $file . '<br>';
    if (file_exists($file)) {
        require $file;
    }
});
<?php
    /**
     * @file init.php<br><br>
     *       <strong>NOTA:</strong> Este archivo se incluye en todos los archivos del proyecto.<br><br>
     *       Archivo que contiene el gestor de sesiones, las constantes del proyecto, los autoloader,
     *       el script de utilidad y el gestor de errores.<br><br>
     */
    require 'utils/sessions.php';
    require 'utils/constants.php';
    require 'utils/autoloader.php';
    require '../vendor/autoload.php';
    include_once 'utils/utils.php';
    include_once 'utils/errorPrinting.php';
    include_once 'utils/errorReporting.php';
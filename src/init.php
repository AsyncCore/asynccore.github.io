<?php
    /**
     * @file init.php<br><br>
     *       <strong>NOTA:</strong> Este archivo se incluye en todos los archivos del proyecto.<br><br>
     *       Archivo que contiene el gestor de sesiones, las constantes del proyecto, los autoloader,
     *       el script de utilidad y el gestor de errores.<br><br>
     */
    require 'src/utils/sessions.php';
    require 'src/utils/constants.php';
    require 'src/utils/autoloader.php';
    require 'vendor/autoload.php';
    include 'src/utils/utils.php';
    include 'src/utils/errorPrinting.php';
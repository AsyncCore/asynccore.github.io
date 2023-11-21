<?php
    namespace src\utils;
    /**
     * Comprueba si la constante MAX_IDLE_TIME ya está definida. Si no, la define con un valor de 3.
     * Esta constante representa el tiempo máximo en minutos que se considera para que una sesión sea activa.
     * @const int MAX_IDLE_TIME
     */
    defined('MAX_IDLE_TIME') or define('MAX_IDLE_TIME', 3);
    
    /**
     * La clase Online se utiliza para determinar el número de usuarios actualmente activos en el sitio.
     * Un usuario se considera activo si su archivo de sesión ha sido modificado dentro de un intervalo
     * de tiempo definido por MAX_IDLE_TIME.
     * @package utils
     * @author Daniel Alonso Lázaro <dalonsolaz@gmail.com
     */
    class Online
    {
        /**
         * Determina el número de usuarios activos basándose en los archivos de sesión.
         *
         * @return int|bool El número de usuarios activos o 'false' si no se puede leer el directorio de sesiones.
         */
        public static function who(): bool|int
        {
            $path = session_save_path();
            
            /**
             * Devuelve 'false' si no se puede leer el directorio de sesiones.
             */
            if (trim($path) == '') {
                return false;
            }
            
            $directory = dir($path);
            $i = 0;
            
            while (false !== ($entry = $directory->read())) {
                /* Ignora los directorios '.' y '..' */
                if ($entry != '.' and $entry != '..') {
                    /* Si el tiempo de modificación del archivo es menor que 3 minutos*/
                    if (time() - filemtime($path . "/$entry") < MAX_IDLE_TIME * 60) {
                        $i++;
                    }
                }
            }
            
            $directory->close();
            
            return $i;
        }
    }
<?php
    namespace src\utils;
    
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
            if (trim($path) == '') {
                return false;
            }
            
            $directory = dir($path);
            $i = 0;
            
            while (false !== ($entry = $directory->read())) {
                /* Ignora los directorios '.' y '..' */
                if ($entry != '.' and $entry != '..') {
                    /* Si el tiempo de modificación del archivo es menor que 5 minutos*/
                    if (time() - filemtime($path . "/$entry") < MAX_IDLE_TIME * 60) {
                        $i++;
                    }
                }
            }
            
            $directory->close();
            return $i;
        }
    }
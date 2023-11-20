<?php
    
    namespace src;
    
    use Exception;
    
    /**
     * Clase base para implementar el patrón de diseño Singleton.
     * Impide la creación directa, clonación y deserialización de sus instancias.
     * Utiliza getInstance() para obtener o crear instancias basadas en argumentos.
     *
     * @see     Logger
     * @access  public
     * @package src
     * @author  Daniel Alonso Lázaro
     * @link    https://es.wikipedia.org/wiki/Singleton
     */
    class Singleton
    {
        /**
         * Almacena instancias de la clase o sus subclases.
         *
         * @var array
         */
        private static array $instancias = [];
        
        /**
         * Constructor protegido para prevenir la instanciación directa.
         *
         * @param mixed $args Argumentos para la construcción de la instancia.
         */
        protected function __construct(...$args)
        {
        }
        
        /**
         * Devuelve una instancia de la clase o subclase llamada.
         * Crea la instancia si no existe, o devuelve la existente.
         *
         * @param mixed ...$args Argumentos para la construcción de la instancia.
         *
         * @return static Instancia de la clase llamada.
         */
        public static function getInstance(...$args): Singleton
        {
            $subclase = static::class;
            $key = $subclase . ':' . serialize($args);
            if (!isset(self::$instancias[$key])) {
                self::$instancias[$key] = new static(...$args);
            }
            return self::$instancias[$key];
        }
        
        /**
         * Impide la deserialización de instancias para mantener la unicidad y seguridad.
         * Registra un intento de deserialización como una excepción en el log.
         *
         * @throws Exception Si se intenta deserializar la instancia.
         */
        public function __wakeup()
        {
            Logger::log("No se puede deserializar un objeto singleton.", __FILE__, LogLevels::EXCEPTION);
            throw new Exception("No se puede deserializar un objeto singleton.");
        }
        
        /**
         * Impide la clonación de la instancia para mantener la unicidad.
         */
        protected function __clone(): void
        {
        }
    }


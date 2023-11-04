<?php

    namespace src\db;

    use src\Singleton;

    /**
     * Clase que contiene el objeto con los datos de configuración de la base de datos.
     *
     * Hereda de Singleton para que solo se pueda crear una instancia de esta clase.
     *
     * @see     Singleton
     * @link     https://es.wikipedia.org/wiki/Singleton
     * @access  public
     * @author  Daniel Alonso Lázaro <dalonsolaz@gmail.com>
     * @package src\db
     */
    class DatabaseConfig extends Singleton
    {
        /**
         * @var array $config Array donde se almacenarán los datos de configuración de la base de datos.
         */
        private array $config;

        /**
         * Construye un objeto DatabaseConfig y carga el array de configuración de la base de datos.
         *
         * @see Singleton::getInstance()
         */
        protected function __construct()
        {
            parent::__construct();
            $this->config = require_once __DIR__ . "/../../config/dbConfig.php";
        }

        /**
         * Función que devuelve el array con los parámetros de configuración dependiendo del tipo de conexión que se le
         * pase. Si no existe el tipo de conexión, devuelve NULL.
         *
         * @param string $key Tiene dos valores: "prod" o "dev".
         *
         * @return array|null
         */
        final public function getConfigItem(string $key): ?array
        {
            return $this->config[$key]??NULL;
        }
    }
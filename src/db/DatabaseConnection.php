<?php

namespace src\db;

use PDO;
use PDOException;
use src\Logger;
use src\LogLevels;
use src\Singleton;

include_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'utils/utils.php';

/**
 * DatabaseConnection es una clase que se encarga de gestionar la conexión con la base de datos.
 *
 * Es una subclase de Singleton y, por tanto, solo puede tener una instancia.<br>
 * Utiliza la clase DatabaseConfig para obtener los datos de conexión a la base de datos.<br>
 * También utiliza la clase Logger para registrar las conexiones efectivas y los errores.<br>
 * @var PDO $connection Objeto de la clase PDO que contiene la conexión a la base de datos.
 * @package src\db
 * @version 1.0.0
 * @see Singleton
 * @see DatabaseConfig
 * @see Logger
 * @auhor Daniel Alonso Lázaro <dalonsolaz@gmail.com>
 */
class DatabaseConnection extends Singleton
{
    private PDO $connection;

    /**
     * Constructor de la clase DatabaseConnection.
     *
     * Recibe los datos de conexión a la base de datos a través de la clase DatabaseConfig.<br>
     * Establece la conexión con la base de datos y registra el evento en el log.<br>
     * Si se produce un error, lo registra en el log y termina la ejecución del programa.<br>
     * @return void
     * @see DatabaseConfig
     * @see PDO
     * @see LogLevels
     */
    protected function __construct()
    {
        parent::__construct();
        $config = DatabaseConfig::getInstance()->getConfigItem('prod');
        try{
            $this->connection = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['database'] . ';charset=utf8', $config['username'], $config['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            Logger::log("Conexión a la B.D. establecida", __FILE__, LogLevels::INFO);
        }catch(PDOException $e){
            Logger::log("Error al conectar a la B.D." . $e->getMessage(), __FILE__, LogLevels::ERROR);
            die("Error al conectar a la B.D." . $e->getMessage());
        }
    }

    /**
     * Método para obtener la conexión a la base de datos.
     *
     * Devuelve el objeto de la clase PDO que contiene la conexión a la base de datos.<br>
     * @see PDO
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }
}

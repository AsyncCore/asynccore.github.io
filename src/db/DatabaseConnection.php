<?php

namespace src\db;

use PDO;
use PDOException;
use src\Logger;
use src\LogLevels;
use src\Singleton;

include_once __DIR__ . "/../utils/utils.php";

class DatabaseConnection extends Singleton
{
    private PDO $connection;

    protected function __construct()
    {
        parent::__construct();
        $config = DatabaseConfig::getInstance()->getConfigItem('prod');
        try{
            $this->connection = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['database'] . ';charset=utf8', $config['username'], $config['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            Logger::log("Error al conectar a la B.D." . $e->getMessage(), getFilePath(__FILE__), LogLevels::ERROR);
            die("Error al conectar a la B.D." . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}

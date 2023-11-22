<?php
    namespace src\managers;
    
    use PDO;
    use src\Logger;
    use src\LogLevels;
    
    class ThreadsManager
    {
        private PDO $db;
        private const CREATE_THREAD = 'INSERT INTO HILOS (USER_ID, TITULO, SUBTITULO, CONTENIDO, CAT_ID) VALUES (:userID, :titulo, :subtitulo, :contenido, :catID)';
        
        public function __construct($dbConnection)
        {
            $this->db = $dbConnection;
        }
        
        public function createThread($userId, $title, $subtitulo, $contenido, $catID)
        {
            try {
                $consulta = $this->db->prepare(self::CREATE_THREAD);
                $consulta->bindParam(':userID', $userId);
                $consulta->bindParam(':titulo', $title);
                $consulta->bindParam(':subtitulo', $subtitulo);
                $consulta->bindParam(':contenido', $contenido);
                $consulta->bindParam(':catID', $catID);
                $consulta->execute();
                return $this->db->lastInsertId();
            } catch (\PDOException $e) {
                Logger::log("Error al crear hilo: " . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
    }

<?php
    namespace src\managers;
    
    use PDO;
    use PDOException;
    use src\Logger;
    use src\LogLevels;
    
    class ThreadManager
    {
        private PDO $db;
        private const CREATE_THREAD = 'INSERT INTO HILOS (USER_ID, TITULO, SUBTITULO, CONTENIDO, CAT_ID) VALUES (:userID, :titulo, :subtitulo, :contenido, :catID)';
        
        public function __construct($dbConnection)
        {
            $this->db = $dbConnection;
        }
        
        public function createThread($userId, $title, $subtitulo, $contenido, $catID): bool|string
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
            } catch (PDOException $e) {
                Logger::log("Error al crear hilo: " . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function getThread($threadId)
        {
        }
        
        public function getAllThreads()
        {
        }
        
        public function updateThread($threadId, $newTitle, $newContent)
        {
        }
        
        public function deleteThread($threadId)
        {
        }
        
        public function associateTagWithThread(bool|string $threadId, mixed $tagId)
        {
        }
    }

<?php
    
    namespace src\managers;
    
    use PDO;
    use src\Logger;
    use PDOException;
    use src\LogLevels;
    
    class TagManager
    {
        private PDO $db;
        private const CREATE_TAG = 'INSERT INTO ETIQUETAS (NOMBRE, `DESC`, ICONO) VALUES (:nombre, :desc, :icono)';
        private const GET_TAG = 'SELECT * FROM ETIQUETAS WHERE ETI_ID = :tagID';
        private const GET_ALL_TAGS = 'SELECT * FROM ETIQUETAS';
        private const UPDATE_TAG = 'UPDATE ETIQUETAS SET NOMBRE = :nombre, `DESC` = :desc WHERE ETI_ID = :tagID';
        private const DELETE_TAG = 'DELETE FROM ETIQUETAS WHERE ETI_ID = :tagID';
        private const GET_ALL_TAGS_BY_THREAD_ID = 'SELECT * FROM ETIQUETAS E JOIN HILO_ETIQUETAS TT ON E.ETI_ID = TT.ETI_ID WHERE TT.THREAD_ID = :threadID';
        
        public function __construct($dbConnection)
        {
            $this->db = $dbConnection;
        }
        
        public function createTag(string $name, string $description): bool|string
        {
            try {
                $consulta = $this->db->prepare(self::CREATE_TAG);
                $consulta->bindParam(':nombre', $name);
                $consulta->bindParam(':desc', $description);
                $consulta->execute();
                return $this->db->lastInsertId();
            } catch (PDOException $e) {
                Logger::log('Error al crear etiqueta: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function getTag(string $tagId): bool|string
        {
            try {
                $consulta = $this->db->prepare(self::GET_TAG);
                $consulta->bindParam(':tagID', $tagId);
                $consulta->execute();
                return $consulta->fetch();
            } catch (PDOException $e) {
                Logger::log('Error al obtener etiqueta: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function getAllTags(): bool|array
        {
            try {
                $consulta = $this->db->prepare(self::GET_ALL_TAGS);
                $consulta->execute();
                return $consulta->fetchAll();
            } catch (PDOException $e) {
                error_log('Error al obtener etiquetas: ' . $e->getMessage());
                return false;
            }
        }
        
        public function updateTag($tagId, $newName, $newDescription): bool|int
        {
            try {
                $consulta = $this->db->prepare(self::UPDATE_TAG);
                $consulta->bindParam(':nombre', $newName);
                $consulta->bindParam(':desc', $newDescription);
                $consulta->bindParam(':tagID', $tagId);
                $consulta->execute();
                return $consulta->rowCount(); // Devuelve el número de filas afectadas
            } catch (PDOException $e) {
                Logger::log('Error al actualizar etiqueta: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function deleteTag($tagId): bool|int
        {
            try {
                $consulta = $this->db->prepare(self::DELETE_TAG);
                $consulta->bindParam(':tagID', $tagId);
                $consulta->execute();
                return $consulta->rowCount();
            } catch (PDOException $e) {
                Logger::log('Error al eliminar etiqueta: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function getAllTagsByThreadId($threadId): bool|array
        {
            try {
                $consulta = $this->db->prepare(self::GET_ALL_TAGS_BY_THREAD_ID);
                $consulta->bindParam(':threadID', $threadId);
                $consulta->execute();
                return $consulta->fetchAll();
            } catch (PDOException $e) {
                Logger::log('Error al obtener todas las etiquetas del hilo ' . $threadId . ': ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
    }

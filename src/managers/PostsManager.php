<?php
    namespace src\managers;
    
    use PDO;
    use src\Logger;
    use PDOException;
    use src\LogLevels;
    
    class PostsManager
    {
        private PDO $db;
        private const GET_POST_COUNT_BY_THREAD = 'SELECT COUNT(*) FROM POSTS WHERE THREAD_ID = :threadID';
        private const GET_LAST_POST_BY_THREAD = 'SELECT * FROM POSTS WHERE THREAD_ID = :threadID ORDER BY F_CRE DESC LIMIT 1';
        
        public function __construct($db)
        {
            $this->db = $db;
        }
        
        public function getPostCountByThread($threadId)
        {
            try {
                $consulta = $this->db->prepare(self::GET_POST_COUNT_BY_THREAD);
                $consulta->bindParam(':threadID', $threadId);
                $consulta->execute();
                return $consulta->fetchColumn();
            } catch (PDOException $e) {
                Logger::log('Error al obtener el total de posts: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function getLastPostByThread($threadId){
            try{
                $consulta = $this->db->prepare(self::GET_LAST_POST_BY_THREAD);
                $consulta->bindParam(':threadID', $threadId);
                $consulta->execute();
                return $consulta->fetch();
            } catch (PDOException $e) {
                Logger::log('Error al obtener el último post: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        
    }
<?php
    namespace src\managers;
    
    use PDO;
    use src\Logger;
    use PDOException;
    use src\LogLevels;
    
    class PostsManager
    {
        private PDO $db;
        private const CREATE_POST = 'INSERT INTO POSTS (USER_ID, THREAD_ID, CONTENIDO, F_CRE, REPLY_ID) VALUES (:userID, :threadID, :contenido, NOW(), :replyID)';
        private const GET_POST = 'SELECT * FROM POSTS WHERE POST_ID = :postID';
        private const GET_ALL_POSTS = 'SELECT * FROM POSTS';
        private const GET_ALL_POSTS_BY_THREAD = 'SELECT * FROM POSTS WHERE THREAD_ID = :threadID';
        private const GET_POST_COUNT = 'SELECT COUNT(*) FROM POSTS';
        private const GET_POST_COUNT_BY_UNIQUE_USER = 'SELECT COUNT(DISTINCT USER_ID) FROM POSTS WHERE THREAD_ID = :threadID';
        private const GET_POST_COUNT_BY_USER_ID = 'SELECT COUNT(*) FROM POSTS WHERE USER_ID = :userID';
        private const GET_POST_COUNT_BY_THREAD = 'SELECT COUNT(*) FROM POSTS WHERE THREAD_ID = :threadID';
        private const GET_LAST_POST_BY_THREAD = 'SELECT * FROM POSTS WHERE THREAD_ID = :threadID ORDER BY F_CRE DESC LIMIT 1';
        private const GET_LAST_POST_AND_THREAD_BY_CATEGORY = 'SELECT P.*, H.TITULO, H.THREAD_ID FROM POSTS P INNER JOIN HILOS H ON P.THREAD_ID = H.THREAD_ID WHERE H.CAT_ID = :catID ORDER BY P.F_CRE DESC LIMIT 1';
        
        public function __construct($db)
        {
            $this->db = $db;
        }
        
        public function createPost($userId, $threadId, $content, $replyId = null): bool|string
        {
            try {
                $consulta = $this->db->prepare(self::CREATE_POST);
                $consulta->bindParam(':userID', $userId);
                $consulta->bindParam(':threadID', $threadId);
                $consulta->bindParam(':contenido', $content);
                $consulta->bindParam(':replyID', $replyId);
                $consulta->execute();
                return $this->db->lastInsertId();
            } catch (PDOException $e) {
                Logger::log('Error al crear post: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        /**
         * @param $postId
         *
         * @return false|mixed
         */
        public function getPost($postId): mixed
        {
            try{
                $consulta = $this->db->prepare(self::GET_POST);
                $consulta->bindParam(':postID', $postId);
                $consulta->execute();
                return $consulta->fetch();
            } catch (PDOException $e) {
                Logger::log('Error al obtener post: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        /**
         * @return bool|array
         */
        public function getAllPosts(): bool|array
        {
            try{
                $consulta = $this->db->prepare(self::GET_ALL_POSTS);
                $consulta->execute();
                return $consulta->fetchAll();
            } catch (PDOException $e) {
                Logger::log('Error al obtener todos los posts: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        /**
         * @param string $threadId
         *
         * @return array|false
         */
        public function getAllPostsByThread(string $threadId): bool|array
        {
            try{
                $consulta = $this->db->prepare(self::GET_ALL_POSTS_BY_THREAD);
                $consulta->bindParam(':threadID', $threadId);
                $consulta->execute();
                return $consulta->fetchAll();
            } catch (PDOException $e) {
                Logger::log('Error al obtener todos los posts del hilo ' . $threadId . ': ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        
        public function getPostCount(): bool|int
        {
            try{
                $consulta = $this->db->query(self::GET_POST_COUNT);
                return $consulta->fetchColumn();
            } catch (PDOException $e) {
                Logger::log('Error al obtener el número total de posts: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function getPostCountByThread($threadId)
        {
            try {
                $consulta = $this->db->prepare(self::GET_POST_COUNT_BY_THREAD);
                $consulta->bindParam(':threadID', $threadId);
                $consulta->execute();
                return $consulta->fetchColumn();
            } catch (PDOException $e) {
                Logger::log('Error al obtener el número total de posts en el hilo '. $threadId.': ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function getPostCountByUniqueUser($threadId)
        {
            try {
                $consulta = $this->db->prepare(self::GET_POST_COUNT_BY_UNIQUE_USER);
                $consulta->bindParam(':threadID', $threadId);
                $consulta->execute();
                return $consulta->fetchColumn();
            } catch (PDOException $e) {
                Logger::log('Error al obtener el número total de posts por usuario único: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function getPostCountByUserId($userId)
        {
            try {
                $consulta = $this->db->prepare(self::GET_POST_COUNT_BY_USER_ID);
                $consulta->bindParam(':userID', $userId);
                $consulta->execute();
                return $consulta->fetchColumn();
            } catch (PDOException $e) {
                Logger::log('Error al obtener el número total de posts del usuario ' . $userId . ': ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
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
                Logger::log('Error al obtener el último post del hilo ' . $threadId . ': ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function getLastPostByCategory($categoryId) {
            try {
                $consulta = $this->db->prepare(self::GET_LAST_POST_AND_THREAD_BY_CATEGORY);
                $consulta->bindParam(':catID', $categoryId, PDO::PARAM_INT);
                $consulta->execute();
                return $consulta->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                Logger::log('Error al obtener el último post y hilo de la categoría ' . $categoryId . ': ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function obtenerPostCompleto($postId) {
            $consulta = $this->db->prepare("SELECT * FROM POSTS WHERE POST_ID = :postId");
            $consulta->bindParam(':postId', $postId, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        
    }
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
        private const GET_THREAD = 'SELECT * FROM HILOS WHERE THREAD_ID = :threadID';
        private const GET_LAST_THREAD_BY_CATEGORY = 'SELECT * FROM HILOS WHERE CAT_ID = :catID ORDER BY F_CRE DESC LIMIT 1';
        private const GET_THREAD_COUNT = 'SELECT COUNT(*) FROM HILOS';
        private const GET_THREAD_COUNT_BY_USER_ID = 'SELECT COUNT(*) FROM HILOS WHERE USER_ID = :userID';
        private const GET_THREAD_COUNT_BY_CATEGORY = 'SELECT COUNT(*) FROM HILOS WHERE CAT_ID = :catID';
        private const GET_LAST_THREAD_BY_CATEGORY_WITH_USER = 'SELECT H.*, U.USERNAME FROM HILOS H JOIN USERS U ON H.USER_ID = U.USER_ID WHERE H.CAT_ID = :catID ORDER BY H.F_CRE DESC LIMIT 1';
        private const GET_ALL_THREADS_BY_CATEGORY_AND_DATE_PAGINATED = 'SELECT H.* FROM HILOS H LEFT JOIN (SELECT THREAD_ID, MAX(F_CRE) AS LAST_POST_DATE FROM POSTS GROUP BY THREAD_ID) P ON H.THREAD_ID = P.THREAD_ID WHERE H.CAT_ID = :catID ORDER BY COALESCE(P.LAST_POST_DATE, H.F_CRE) DESC LIMIT :limit OFFSET :offset';
        private const GET_ALL_THREADS_BY_DATE = 'SELECT H.*, U.USERNAME FROM HILOS H JOIN USERS U ON H.USER_ID = U.USER_ID ORDER BY H.F_CRE DESC';
        private const GET_ALL_THREADS_BY_COUNT_RESPONSES = "SELECT H.*, U.USERNAME, COUNT(P.POST_ID) AS NUMERO_RESPUESTAS FROM HILOS H LEFT JOIN POSTS P ON H.THREAD_ID = P.THREAD_ID JOIN USERS U ON H.USER_ID = U.USER_ID GROUP BY H.THREAD_ID, H.TITULO, H.SUBTITULO, H.CONTENIDO, U.USERNAME ORDER BY NUMERO_RESPUESTAS DESC";
        
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
            try {
                $consulta = $this->db->prepare(self::GET_THREAD);
                $consulta->bindParam(':threadID', $threadId);
                $consulta->execute();
                return $consulta->fetch();
            } catch (PDOException $e) {
                Logger::log('Error al obtener hilo: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
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
        
        public function associateTagWithThread(bool|string $threadId, mixed $tagId): bool
        {
            try{
                $consulta = $this->db->prepare('INSERT INTO HILO_ETIQUETAS (THREAD_ID, ETI_ID) VALUES (:threadID, :tagID)');
                $consulta->bindParam(':threadID', $threadId);
                $consulta->bindParam(':tagID', $tagId);
                $consulta->execute();
                return true;
            } catch (PDOException $e){
                Logger::log('Error al asociar etiqueta con hilo: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        /**
         * Método para obtener todos los hilos de una categoría ordenados por fecha de último hilo/post.
         *
         * Devuelve las siguientes columnas: <br>
         * - THREAD_ID: ID del hilo.<br>
         * - USER_ID: ID del usuario que creó el hilo.<br>
         * - TITULO: Título del hilo.<br>
         * - SUBTITULO: Subtítulo del hilo.<br>
         * - CONTENIDO: Contenido del hilo.<br>
         * - F_CRE: Fecha de creación del hilo.<br>
         * - F_EDI: Fecha de edición del hilo.<br>
         * - CAT_ID: ID de la categoría a la que pertenece el hilo.<br>
         *
         * @param string $categoryId ID de la categoría.
         * @param int    $page       Página a obtener.
         * @param int    $threadsPerPage Cantidad de hilos por página.
         *
         * @return bool|array|null
         */
        public function getAllThreadsByCategoryAndDatePaginated(string $categoryId, int $page, int $threadsPerPage): bool|array|null {
            $offset = ($page - 1) * $threadsPerPage;
            try {
                $consulta = $this->db->prepare(self::GET_ALL_THREADS_BY_CATEGORY_AND_DATE_PAGINATED);
                $consulta->bindParam(':catID', $categoryId);
                $consulta->bindValue(':limit', $threadsPerPage, PDO::PARAM_INT);
                $consulta->bindValue(':offset', $offset, PDO::PARAM_INT);
                $consulta->execute();
                return $consulta->fetchAll();
            } catch (PDOException $e) {
                Logger::log('Error al obtener todos los hilos de la categoría ' . $categoryId . ' con paginación: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return null;
            }
        }
        
        public function getLastThreadByCategory($categoryId)
        {
            try {
                $consulta = $this->db->prepare(self::GET_LAST_THREAD_BY_CATEGORY);
                $consulta->bindParam(':catID', $categoryId);
                $consulta->execute();
                return $consulta->fetch();
            } catch (PDOException $e) {
                Logger::log('Error al obtener el último hilo de la categoría ' . $categoryId . ': ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return null;
            }
        }
        
        public function getThreadCount()
        {
            try {
                $consulta = $this->db->query(self::GET_THREAD_COUNT);
                return $consulta->fetchColumn();
            } catch (PDOException $e) {
                Logger::log('Error al obtener el número total de hilos: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function getThreadCountByUserId($userId)
        {
            try {
                $consulta = $this->db->prepare(self::GET_THREAD_COUNT_BY_USER_ID);
                $consulta->bindParam(':userID', $userId);
                $consulta->execute();
                return $consulta->fetchColumn();
            } catch (PDOException $e) {
                Logger::log('Error al obtener el número total de hilos del usuario ' . $userId . ': ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        /**
         * Método para obtener el número de hilos de una categoría.
         *
         * Devuelve el número de hilos de una categoría.<br>
         *
         * @param $categoryId string ID de la categoría.
         *
         * @return mixed|null Devuelve el número de hilos de la categoría, false si no existe o null si hay un error.
         */
        public function getThreadCountByCategory(string $categoryId): mixed
        {
            try {
                $consulta = $this->db->prepare(self::GET_THREAD_COUNT_BY_CATEGORY);
                $consulta->bindParam(':catID', $categoryId, PDO::PARAM_INT);
                $consulta->execute();
                return $consulta->fetchColumn();
            } catch (PDOException $e) {
                Logger::log('Error al obtener la cantidad de hilos de la categoría ' . $categoryId . ': ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return null;
            }
        }
        
        /**
         * Método para obtener el último hilo de una categoría con el usuario que lo creó.
         *
         * Devuelve las siguientes columnas: <br>
         * - THREAD_ID: ID del hilo.<br>
         * - USER_ID: ID del usuario que creó el hilo.<br>
         * - TITULO: Título del hilo.<br>
         * - SUBTITULO: Subtítulo del hilo.<br>
         * - CONTENIDO: Contenido del hilo.<br>
         * - F_CRE: Fecha de creación del hilo.<br>
         * - F_EDI: Fecha de edición del hilo.<br>
         * - CAT_ID: ID de la categoría a la que pertenece el hilo.<br>
         * - USERNAME: Nombre de usuario del usuario que creó el hilo.<br>
         *
         * @param $categoryId string ID de la categoría.
         *
         * @return mixed|null Devuelve un array asociativo con el hilo, false si no existe o null si hay un error.
         */
        public function getLastThreadByCategoryWithUser(string $categoryId): mixed
        {
            try {
                $consulta = $this->db->prepare(self::GET_LAST_THREAD_BY_CATEGORY_WITH_USER);
                $consulta->bindParam(':catID', $categoryId, PDO::PARAM_INT);
                $consulta->execute();
                return $consulta->fetch();
            } catch (PDOException $e) {
                Logger::log('Error al obtener el último hilo de la categoría y el usuario' . $categoryId . ': ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return null;
            }
        }
        
        
        public function getLatestThreads(): array|false
        {
            try {
                $consulta = $this->db->query(self::GET_ALL_THREADS_BY_DATE . ' LIMIT 3');
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                Logger::log('Error al obtener los hilos más recientes: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function getMostRepliedThreads(): array|false
        {
            try {
                $consulta = $this->db->query(self::GET_ALL_THREADS_BY_COUNT_RESPONSES . ' LIMIT 3');
                return $consulta->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                Logger::log('Error al obtener los hilos con más respuestas: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function getLastThreadsByUser($userId, $limit = 5)
        {
            try {
                $consulta = $this->db->prepare('SELECT * FROM THREADS WHERE USER_ID = :userId ORDER BY F_CRE DESC LIMIT :limit');
                $consulta->bindParam(':userId', $userId);
                $consulta->bindParam(':limit', $limit, PDO::PARAM_INT);
                $consulta->execute();
                return $consulta->fetchAll();
            } catch (PDOException $e) {
                Logger::log('Error al obtener últimos hilos: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
    }
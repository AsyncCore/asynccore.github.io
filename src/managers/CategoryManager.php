<?php
    
    namespace src\managers;
    
    use PDO;
    use src\Logger;
    use PDOException;
    use src\LogLevels;
    
    class CategoryManager
    {
        private const CREATE_CATEGORY = 'INSERT INTO CATEGORIA (TITULO, SUBTITULO, ICONO) VALUES (:titulo, :subtitulo, :icono)';
        private const GET_CATEGORY = 'SELECT * FROM CATEGORIA WHERE CAT_ID = :catID';
        private const GET_ALL_CATEGORIES = 'SELECT * FROM CATEGORIA';
        private const UPDATE_CATEGORY = 'UPDATE CATEGORIA SET TITULO = :titulo, SUBTITULO = :subtitulo, ICONO = :icono WHERE CAT_ID = :catID';
        private const DELETE_CATEGORY = 'DELETE FROM CATEGORIA WHERE CAT_ID = :catID';
        private const GET_LAST_THREAD_BY_CATEGORY = 'SELECT * FROM HILOS WHERE CAT_ID = :catID ORDER BY F_CRE DESC LIMIT 1';
        private const GET_THREAD_COUNT_BY_CATEGORY = 'SELECT COUNT(*) FROM HILOS WHERE CAT_ID = :catID';
        private const GET_LAST_THREAD_BY_CATEGORY_WITH_USER = 'SELECT H.*, U.USERNAME FROM HILOS H JOIN USERS U ON H.USER_ID = U.USER_ID WHERE H.CAT_ID = :catID ORDER BY H.F_CRE DESC LIMIT 1';
        private PDO $db;
        
        public function __construct($dbConnection)
        {
            $this->db = $dbConnection;
        }
        
        public function createCategory($title, $subtitle, $icon = null)
        {
        }
        
        /**
         * Método para obtener una categoría.
         *
         * Devuelve las siguientes columnas: <br>
         * - CAT_ID: ID de la categoría.<br>
         * - TITULO: Título de la categoría.<br>
         * - SUBTITULO: Subtítulo de la categoría.<br>
         * - ICONO: Icono de la categoría.<br>
         *
         * @param $categoryId string ID de la categoría.
         *
         * @return mixed|null Devuelve un array asociativo con la categoría, false si no existe o null si hay un error.
         */
        public function getCategory(string $categoryId): mixed
        {
            try {
                $consulta = $this->db->prepare(self::CREATE_CATEGORY);
                $consulta->bindParam(':catID', $categoryId);
                $consulta->execute();
                return $consulta->fetch();
            } catch (PDOException $e) {
                Logger::log('Error al obtener categoría: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return null;
            }
        }
        
        /**
         * Método para obtener todas las categorías.
         *
         * Devuelve las siguientes columnas: <br>
         * - CAT_ID: ID de la categoría.<br>
         * - TITULO: Título de la categoría.<br>
         * - SUBTITULO: Subtítulo de la categoría.<br>
         * - ICONO: Icono de la categoría.<br>
         *
         * @return bool|array|null Devuelve un array asociativo con las categorías, false si no hay categorías o null si hay un error.
         */
        public function getAllCategories(): bool|array|null
        {
            try {
                $consulta = $this->db->query(self::GET_ALL_CATEGORIES);
                return $consulta->fetchAll();
            } catch (PDOException $e) {
                Logger::log('Error al obtener categorías: ' . $e->getMessage(), __FILE__, LogLevels::ERROR);
                return null;
            }
        }
        
        
        public function updateCategory($categoryId, $newTitle, $newSubtitle, $newIcon = null)
        {
        }
        
        public function deleteCategory($categoryId)
        {
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
    }

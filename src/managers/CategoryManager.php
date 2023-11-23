<?php
    
    namespace src\managers;
    
    use PDO;
    use src\Logger;
    use PDOException;
    use src\LogLevels;
    
    class CategoryManager
    {
        private PDO $db;
        private const CREATE_CATEGORY = 'INSERT INTO CATEGORIA (TITULO, SUBTITULO, ICONO) VALUES (:titulo, :subtitulo, :icono)';
        private const GET_CATEGORY = 'SELECT * FROM CATEGORIA WHERE CAT_ID = :catID';
        private const GET_ALL_CATEGORIES = 'SELECT * FROM CATEGORIA';
        private const UPDATE_CATEGORY = 'UPDATE CATEGORIA SET TITULO = :titulo, SUBTITULO = :subtitulo, ICONO = :icono WHERE CAT_ID = :catID';
        private const DELETE_CATEGORY = 'DELETE FROM CATEGORIA WHERE CAT_ID = :catID';
        
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
                $consulta = $this->db->prepare(self::GET_CATEGORY);
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
    }

<?php
    namespace src\managers;
    
    use PDO;
    use src\Logger;
    use PDOException;
    use src\LogLevels;
    
    /**
     * La clase UserManager se encarga de gestionar los usuarios de AsynCore.
     *
     * Esta clase se encarga de gestionar las acciones de los usuarios, tanto de la base de datos como de la sesión.<br>
     * Ofrece múltiples métodos para lidiar con las operaciones más comunes de los usuarios.<br>
     *
     * @package src
     * @version 1.0.0
     * @auhor   Daniel Alonso Lázaro <dalonsolaz@gmail.com>
     */
    class UserManager
    {
        private const REGISTRO = 'INSERT INTO USERS (NAME, USERNAME, PASSWORD, EMAIL, F_REG) VALUES (:name, :username, :password, :mail, NOW())';
        private const LOGIN = 'SELECT * FROM USERS WHERE USERS.EMAIL = :loginEmail';
        private const GET_USER_COUNT = 'SELECT COUNT(*) FROM USERS';
        private const UPDATE_USER_MAIL_BY_ID = 'UPDATE USERS SET USERS.EMAIL = :newMail WHERE USERS.USER_ID = :userID AND USERS.PASSWORD = :password';
        private const UPDATE_USER_PASSWORD_BY_ID = 'UPDATE USERS SET USERS.PASSWORD = :newPassword WHERE USERS.USER_ID = :userID AND USERS.PASSWORD = :password';
        private const UPDATE_LAST_SEEN = 'UPDATE USERS SET USERS.LAST_SEEN = NOW() WHERE USERS.USER_ID = :userID';
        private const GET_LAST_SEEN = 'SELECT USERS.LAST_SEEN FROM USERS WHERE USERS.USER_ID = :userID';
        private const GET_USER_BY_ID = 'SELECT * FROM USERS WHERE USERS.USER_ID = :userID';
        private const DELETE_USER = 'DELETE FROM USERS WHERE USERS.USER_ID = :userID';
        private const GET_USER_AVATAR_BY_ID = 'SELECT USERS.AVATAR FROM USERS WHERE USERS.USER_ID = :userID';
        private const IS_USER_ONLINE = 'SELECT COUNT(*) FROM USERS WHERE USERS.USER_ID = :userID AND LAST_SEEN > DATE_SUB(NOW(), INTERVAL 5 MINUTE)';
        private PDO $db;
        
        /**
         * Constructor de la clase UserManager.
         *
         * Recibe un PDO para poder realizar las operaciones con la base de datos.<br>
         *
         * @param $db PDO Objeto de la clase PDO que contiene la conexión a la base de datos.
         *
         * @return void
         */
        public function __construct(PDO $db)
        {
            $this->db = $db;
        }
        
        /**
         * Método para registrar un usuario.
         *
         * Recibe el nombre de usuario, el email y la contraseña.<br>
         * La 'password' se encripta con password_hash() y la constante de encriptación PASSWORD_DEFAULT, que usa
         * BCrypt.<br> También se pueden usar las constantes PASSWORD_BCRYPT, PASSWORD_ARGON2I o PASSWORD_ARGON2ID.<br>
         *
         * @see https://www.php.net/manual/es/function.password-hash.php
         * @see https://www.php.net/manual/es/password.constants.php
         * @see https://www.php.net/manual/es/password.constants.php#password.constants.options
         *
         * @param $name     string nombre del usuario desde el formulario de registro.
         * @param $username string nombre del usuario desde el formulario de registro.
         * @param $mail     string email del usuario
         * @param $password string contraseña.
         *
         * @return bool
         */
        public function register(string $name, string $username, string $mail, string $password): bool
        {
            try {
                $consulta = $this->db->prepare(self::REGISTRO);
                $consulta->bindParam(':name', $name);
                $consulta->bindParam(':username', $username);
                $consulta->bindParam(':mail', $mail);
                $password = password_hash($password, PASSWORD_DEFAULT);
                $consulta->bindParam(':password', $password);
                $consulta->execute();
                Logger::log("Usuario " . $username . " registrado correctamente", __FILE__, LogLevels::INFO);
                return true;
            } catch (PDOException $e) {
                Logger::log("Error al registrar el usuario " . $username . ": " . $e->getMessage() . " con código de error " . $e->getCode(), __FILE__, LogLevels::ERROR);
                $_SESSION['USERMANAGER_SQL_ERROR'] = $e->getMessage();
                return false;
            }
        }
        
        /**
         * Método para gestionar el login de un usuario.
         *
         * Recibe el email y la contraseña desde el login.
         * Comprueba si el email existe en la base de datos.
         * Si existe, comprueba si la contraseña coincide con la contraseña encriptada de la base de datos.
         * Si coincide, devuelve el usuario.
         * Si no coincide, devuelve false.
         *
         * @param string $loginEmail
         * @param string $loginPassword
         *
         * @return false|mixed
         */
        public function login(string $loginEmail, string $loginPassword): false|array
        {
            try {
                $consulta = $this->db->prepare(self::LOGIN);
                $consulta->bindParam(':loginEmail', $loginEmail);
                $consulta->execute();
                $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
                Logger::log("Usuario " . $loginEmail . " logueado correctamente", __FILE__, LogLevels::INFO);
            } catch (PDOException $e) {
                Logger::log("Error al obtener el usuario con email " . $loginEmail . ": " . $e->getMessage() . " con código de error " . $e->getCode(), __FILE__, LogLevels::ERROR);
                return false;
            }
            
            if (!$usuario || !(password_verify($loginPassword, $usuario['PASSWORD']))) {
                Logger::log('El usuario con el mail ' . $loginEmail . ' se ha intentado loguear pero no existe en la base de datos.', __FILE__, LogLevels::INFO);
                return false;
            } else {
                Logger::log('El usuario con el mail ' . $loginEmail . ' se ha encontrado. Procediendo al sistema de logueo.', __FILE__, LogLevels::INFO);
                return $usuario;
            }
        }
        
        /**
         * Método para obtener el número total de usuarios registrados.
         *
         * Devuelve el número total de usuarios registrados en la base de datos.<br>
         *
         * @return int
         * @throws PDOException
         */
        public function userCount(): int
        {
            try {
                $consulta = $this->db->query(self::GET_USER_COUNT);
                return $consulta->fetchColumn();
            } catch (PDOException $e) {
                Logger::log("Error al obtener el número de usuarios: " . $e->getMessage() . " con código de error " . $e->getCode(), __FILE__, LogLevels::ERROR);
                return -1;
            }
        }
        
        public function getUserAvatarById(string $userId): bool|string
        {
            try {
                $consulta = $this->db->prepare(self::GET_USER_AVATAR_BY_ID);
                $consulta->bindParam(':userID', $userId);
                $consulta->execute();
                return $consulta->fetchColumn();
            } catch (PDOException $e) {
                Logger::log("Error al obtener el avatar del usuario con ID " . $userId . ": " . $e->getMessage() . " con código de error " . $e->getCode(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function getUserById(string $userId)
        {
            try {
                $consulta = $this->db->prepare(self::GET_USER_BY_ID);
                $consulta->bindParam(':userID', $userId);
                $consulta->execute();
                return $consulta->fetch();
            } catch (PDOException $e) {
                Logger::log("Error al obtener el usuario con ID " . $userId . ": " . $e->getMessage() . " con código de error " . $e->getCode(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function isUserOnline(string $userId): bool
        {
            try {
                $consulta = $this->db->prepare(self::IS_USER_ONLINE);
                $consulta->bindParam(':userID', $userId);
                $consulta->execute();
                $fila = $consulta->fetch(PDO::FETCH_ASSOC);
                return !empty($fila) && $fila['COUNT(*)'] > 0;
            } catch (PDOException $e) {
                Logger::log('Error al comprobar si el usuario con ID ' . $userId . ' está online: ' . $e->getMessage() . ' con código de error ' . $e->getCode(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
        
        public function updateLastSeen(string $userId): bool
        {
            try {
                $consulta = $this->db->prepare(self::UPDATE_LAST_SEEN);
                $consulta->bindParam(':userID', $userId);
                return $consulta->execute();
            } catch (PDOException $e) {
                Logger::log('Error al actualizar la última vez que el usuario con ID ' . $userId . ' estuvo online: ' . $e->getMessage() . ' con código de error ' . $e->getCode(), __FILE__, LogLevels::ERROR);
                return false;
            }
        }
    }
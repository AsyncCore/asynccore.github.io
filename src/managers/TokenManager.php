<?php
    namespace src\managers;
    
    /**
     * Clase para la gestión de tokens de autenticación y seguridad.
     *
     * TokenManager es una clase encargada de crear, validar y eliminar tokens de seguridad.<br>
     * Los tokens son utilizados para mantener sesiones de usuario seguras y validar la autenticidad de las solicitudes.<br>
     * Esta clase permite generar tokens únicos para los usuarios, validar su vigencia y limpiar tokens expirados de la base de datos.
     *
     *
     * @link     https://www.php.net/manual/es/function.random-bytes.php
     *           https://www.php.net/manual/es/class.pdo.php
     * @access public
     * @author Daniel Alonso Lázaro <dalonsolaz@gmail.com>
     * @package src\managers
     */
    
    use PDO;
    use Exception;
    use src\Logger;
    use src\LogLevels;
    
    class TokenManager
    {
       /**
         * @const string INSERT_TOKEN consulta para insertar un token en la base de datos.
         * @const string SELECT_TOKEN consulta para seleccionar un token de la base de datos.
         * @const string DELETE_TOKEN consulta para eliminar un token de la base de datos.
         * @const string CLEAN_UP_EXPIRED_TOKENS consulta para eliminar los tokens expirados de la base de datos.
         */
        private const INSERT_TOKEN = 'INSERT INTO TOKENS (TOKEN, USER_ID, F_EXP) VALUES (:token, :userId, :fExp)';
        private const SELECT_TOKEN = 'SELECT * FROM TOKENS WHERE TOKEN = :token AND F_EXP > NOW()';
        private const DELETE_TOKEN = 'DELETE FROM TOKENS WHERE TOKEN = :token';
        private const CLEAN_UP_EXPIRED_TOKENS = 'DELETE FROM TOKENS WHERE F_EXP < NOW()';
        private const GET_TOKEN_BY_USER_ID = 'SELECT * FROM TOKENS WHERE USER_ID = :userId';
        private const UPDATE_TOKEN = 'UPDATE TOKENS SET F_EXP = :nuevaFExp WHERE TOKEN = :token';
        
        /**
         * @var PDO conexión a la base de datos.
         */
        private PDO $db;
        
        /**
         * Constructor de TokenManager.
         *
         * Inicializa el objeto TokenManager con la conexión a la base de datos.
         *
         * @param PDO $db conexión a la base de datos.
         * @see PDO
         * @access public
         */
        public function __construct(PDO $db)
        {
            $this->db = $db;
        }
        
        /**
         * Genera un nuevo token para un usuario.
         *
         * @param int $userId ID del usuario.
         *
         * @return string El token generado.
         * @throws Exception Si hay un error en la generación del token.
         * @access public
         */
        public function generateToken(int $userId): string
        {
            $token = bin2hex(random_bytes(TOKEN_LENGTH));
            $fExp = date(TOKEN_DATE_FORMAT, TOKEN_EXPIRY_TIME);
            try{
                $consulta = $this->db->prepare(self::INSERT_TOKEN);
                $consulta->bindParam(':token', $token);
                $consulta->bindParam(':userId', $userId);
                $consulta->bindParam(':fExp', $fExp);
                if (!$consulta->execute()){
                    Logger::log("Error al generar el token: CÓDIGO SQL -> " . $consulta->errorInfo()[0] . ', CÓDIGO PDO -> ' . $consulta->errorInfo()[1] . ', MENSAJE PDO -> ' .$consulta->errorInfo()[2], __FILE__, LogLevels::EXCEPTION);
                    throw new Exception('Error al generar el token.');
                }
                return $token;
            }catch(Exception $e){
                Logger::log("Error al generar el token: " . $e->getMessage(), __FILE__, LogLevels::EXCEPTION);
                throw new Exception('Error al generar el token.');
            }
        }
        
        /**
         * Valida un token existente.
         *
         * Comprueba si el token proporcionado es válido y aún no ha expirado.
         * En caso de que el token no sea válido o haya expirado, se lanza una excepción.
         *
         * @param string $token El token a validar.
         *
         * @return array|false Retorna los datos del token si es válido, o false si no lo es.
         * @throws Exception Si el token no es válido o no se encuentra.
         */
        public function validateToken(string $token): bool|array
        {
            try{
                $consulta = $this->db->prepare(self::SELECT_TOKEN);
                $consulta->bindParam(':token', $token);
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                if(!$resultado){
                    $this->cleanUpExpiredTokens();
                    Logger::log("No se encontraron datos del token: " . $token, __FILE__, LogLevels::EXCEPTION);
                }
                return $resultado;
            }catch (Exception $e){
                Logger::log("Error al validar el token: " . $e->getMessage(), __FILE__, LogLevels::EXCEPTION);
                throw new Exception('Error al validar el token.');
            }
        }
        
        /**
         * Elimina un token específico de la base de datos.
         *
         * Borra el token proporcionado de la base de datos.
         * Si el token no existe o no se puede eliminar, se lanza una excepción.
         *
         * @param string $token El token a eliminar.
         *
         * @throws Exception Si el token no se puede eliminar o no existe.
         */
        public function deleteToken(string $token): void
        {
            try{
                $consulta = $this->db->prepare(self::DELETE_TOKEN);
                $consulta->bindParam(':token', $token);
                $consulta->execute();
                if($consulta->rowCount() == 0){
                    Logger::log("No se encontraron datos del token: " . $token, __FILE__, LogLevels::EXCEPTION);
                }
            }catch (Exception $e){
                Logger::log("Error al eliminar el token: " . $e->getMessage(), __FILE__, LogLevels::EXCEPTION);
                throw new Exception('Error al eliminar el token.');
            }
        }
        
        /**
         * Limpia los tokens expirados de la base de datos.
         *
         * Elimina todos los tokens que han excedido su fecha de expiración.
         *
         * @return void
         */
        public function cleanUpExpiredTokens(): void
        {
            $filas = $this->db->exec(self::CLEAN_UP_EXPIRED_TOKENS);
            if ($filas >= 0){
                Logger::log("Se han eliminado " . $filas . " tokens expirados..", __FILE__, LogLevels::INFO);
            }
        }
        
        /**
         * @throws Exception
         */
        public function getTokenByUserId(mixed $userId): bool|array
        {
            try{
                $consulta = $this->db->prepare(self::GET_TOKEN_BY_USER_ID);
                $consulta->bindParam(':userId', $userId);
                $consulta->execute();
                return $consulta->fetch(PDO::FETCH_ASSOC);
            }catch (Exception $e){
                Logger::log("Error al obtener el token: " . $e->getMessage(), __FILE__, LogLevels::EXCEPTION);
                throw new Exception('Error al obtener el token.');
            }
        }
        
        /**
         * @throws Exception
         */
        public function updateToken(mixed $token)
        {
            try{
                $fExp = date(TOKEN_DATE_FORMAT, TOKEN_EXPIRY_TIME);
                $consulta = $this->db->prepare(self::UPDATE_TOKEN);
                $consulta->bindParam(':token', $token);
                $consulta->bindParam(':nuevaFExp', $fExp);
                $consulta->execute();
                return $consulta->fetch(PDO::FETCH_ASSOC);
            }catch (Exception $e){
                Logger::log("Error al obtener el token: " . $e->getMessage(), __FILE__, LogLevels::EXCEPTION);
                throw new Exception('Error al obtener el token.');
            }
        }
    }
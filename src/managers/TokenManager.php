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
         * @const int TOKEN_EXPIRY_TIME tiempo de expiración del token en segundos.
         * @const int TOKEN_LENGTH longitud del token.
         * @const string DATE_FORMAT formato de fecha.
         * @const string INSERT_TOKEN consulta para insertar un token en la base de datos.
         * @const string SELECT_TOKEN consulta para seleccionar un token de la base de datos.
         * @const string DELETE_TOKEN consulta para eliminar un token de la base de datos.
         * @const string CLEAN_UP_EXPIRED_TOKENS consulta para eliminar los tokens expirados de la base de datos.
         */
        private const TOKEN_EXPIRY_TIME = 7 * 24 * 60 * 60;
        private const TOKEN_LENGTH = 16;
        private const DATE_FORMAT = 'Y-m-d H:i:s';
        private const INSERT_TOKEN = 'INSERT INTO TOKENS (TOKEN, USER_ID, FECHA_EXP) VALUES (:token, :user_id, :expiry_date)';
        private const SELECT_TOKEN = 'SELECT * FROM TOKENS WHERE TOKEN = :token AND FECHA_EXP > NOW()';
        private const DELETE_TOKEN = 'DELETE FROM TOKENS WHERE TOKEN = :token';
        private const CLEAN_UP_EXPIRED_TOKENS = 'DELETE FROM TOKENS WHERE FECHA_EXP < NOW()';
        
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
            $token = bin2hex(random_bytes(self::TOKEN_LENGTH));
            $expiryDate = date(self::DATE_FORMAT, time() + self::TOKEN_EXPIRY_TIME);
            try{
                $consulta = $this->db->prepare(self::INSERT_TOKEN);
                $consulta->bindParam(':token', $token);
                $consulta->bindParam(':user_id', $userId);
                $consulta->bindParam(':expiry_date', $expiryDate);
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
                    Logger::log("No se encontraron datos del token: " . $token, __FILE__, LogLevels::WARNING);
                    throw new Exception('No se ha encontrado el token.');
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
                    Logger::log("No se encontraron datos del token: " . $token, __FILE__, LogLevels::WARNING);
                    throw new Exception('No se ha encontrado el token.');
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
    }
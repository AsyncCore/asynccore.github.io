<?php
    /** @noinspection PhpPossiblePolymorphicInvocationInspection */

    /**
     * Este archivo contiene las consultas a la base de datos.<br>
     * PDO para conectarse a la B.D.
     * ```
     * try{
     *      $db = new PDO('mysql:host=localhost;dbname=nombreDB;charset=utf8', 'user', 'pass');
     *      $consulta = $db->prepare('QUERY');
     *      $resultado = $consulta->execute();
     *      echo '<pre>';
     *      $resultado = $consulta->fetchAll();
     *      print_r($resultado);
     *      echo '</pre>';
     * }catch(PDOException $e){
     *      echo 'Error al conectar a la B.D.' . $e->getMessage();
     * }
     * ```
     * Una clase por cada clase del modelo de datos.<br>
     * FORM USUARIO ⇒ conjunto de atributos que tiene una validación (ancestro común de todos los formularios)<br>
     * <pre>USUARIO ⇒  C(reate)
     *      R(ead)
     *      U(update)
     *      D(elete)</pre><br>
     * USUARIO MANAGER ⇒ singleton con métodos estáticos que me da arrays de lo que yo le pida.
     */

    namespace config;

    use Exception;
    use PDO;
    use PDOException;
    use src\db\DatabaseConfig;
    use src\Logger;
    use src\LogLevels;

    include_once __DIR__ . "/../src/utils/utils.php";

    const ERROR = "No se ha podido cargar la configuración de la base de datos.";

    try{
        $config = DatabaseConfig::getInstance()->getConfigItem('dev');
        // Si no se ha podido cargar la configuración, se lanza una excepción.
        if(!$config){
            Logger::log(ERROR, getFilePath(__FILE__), LogLevels::ERROR);
            throw new Exception(ERROR);
        }

        // Si alguno de ellos no está definido, se lanza una excepción.
        if(!isset($config['host']) || !isset($config['username']) || !isset($config['password']) || !isset($config['database'])){
            Logger::log(ERROR, getFilePath(__FILE__), LogLevels::ERROR);
            throw new Exception(ERROR);
        }

        $connection = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['database'] . ';charset=utf8', $config['username'], $config['password']);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $connection->prepare("SELECT USERS.USERNAME, USERS.FIRMA, HILOS.TITULO, HILOS.CONTENIDO, HILOS.FECHA_CREACION 
                                    FROM USERS, HILOS
                                    WHERE USERS.USER_ID = HILOS.USER_ID AND HILOS.ID_HILO = 3");

        $consulta->execute();
        $resultado_hilos = $consulta->fetchAll();

        $consulta = $connection->prepare("SELECT POSTS.ID_POST, USERS.USERNAME, USERS.FIRMA, POSTS.CONTENIDO, POSTS.FECHA_CREACION, POSTS.FECHA_EDICION
                                    FROM POSTS
                                        INNER JOIN USERS ON POSTS.USER_ID = USERS.USER_ID
                                    WHERE POSTS.ID_HILO = 3
                                    ORDER BY POSTS.FECHA_CREACION;");

        $consulta->execute();
        $resultado_posts = $consulta->fetchAll();
    }catch(PDOException|Exception $e){
        Logger::log($e->getMessage(), getFilePath(__FILE__), LogLevels::EXCEPTION);
    }
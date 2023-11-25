<?php
    
    
    class DatabaseOperations
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = \src\db\DatabaseConnection::getInstance()->getConnection();
    }

    public function getHilo($idHilo):array
    {
        $consulta = $this->connection->prepare("SELECT USERS.USERNAME, USERS.FIRMA, HILOS.TITULO, HILOS.CONTENIDO, HILOS.FECHA_CREACION, HILOS.FECHA_EDICION 
                                                        FROM USERS, HILOS 
                                                        WHERE USERS.USER_ID = HILOS.USER_ID 
                                                          AND HILOS.ID_HILO = :idHilo");
        $consulta->bindParam(":idHilo", $idHilo, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function getPostsFromHilo($idHilo):array
    {
        $consulta = $this->connection->prepare("SELECT USERS.USERNAME, USERS.FIRMA, POSTS.CONTENIDO, POSTS.FECHA_CREACION, POSTS.FECHA_EDICION 
                                                        FROM POSTS
                                                            INNER JOIN USERS ON POSTS.USER_ID = USERS.USER_ID
                                                        WHERE POSTS.ID_HILO = :idHilo 
                                                        ORDER BY POSTS.FECHA_CREACION");
        $consulta->bindParam(":idHilo", $idHilo, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetchAll();
    }

    public function login($loginEmail, $loginPassword)
    {

        $consulta = $this->connection->prepare('SELECT * FROM USERS WHERE USERS.EMAIL = :loginEmail');
        $consulta->bindParam(':loginEmail', $loginEmail);
        $consulta->execute();

        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
        if (!$usuario) {
            return false;
        }

        if (password_verify($loginPassword, $usuario['password'])) {
            return $usuario;
        } else {
            return false;
        }
    }

    public function insertAlumno($username, $password, $email):bool
    {
        $consulta = $this->connection->prepare("INSERT INTO USERS (USERNAME, PASSWORD, EMAIL, FECHA_REGISTRO) VALUES (:username, :password, :email, NOW())");
        $consulta->bindParam(":username", $username);
        $hashed_pass = sha1($password);
        $consulta->bindParam(":password", $hashed_pass);
        $consulta->bindParam(":email", $email);
        return $consulta->execute();
    }

    public function createHilo($idHilo, $userId, $contenido): bool
    {
        $consulta = $this->connection->prepare("CALL SP_CREAR_HILO(:idHilo, :userId, :contenido)");
        $consulta->bindParam(":idHilo", $idHilo);
        $consulta->bindParam(":userId", $userId);
        $consulta->bindParam(":contenido", $contenido);
        return $consulta->execute();
    }
}
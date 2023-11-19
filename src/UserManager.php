<?php

namespace src;

use PDO;

/**
 * La clase UserManager se encarga de gestionar los usuarios de AsynCore.
 *
 * Esta clase se encarga de gestionar los usuarios de AsynCore, tanto de la base de datos como de la sesión.<br>
 * Ofrece múltiples métodos para lidiar con las operaciones más comunes de los usuarios.<br>
 * @package src
 * @version 1.0.0
 * @auhor Daniel Alonso Lázaro <dalonsolaz@gmail.com>
 */
class UserManager {
    private PDO $db;
    private const REGISTRO = 'INSERT INTO USERS (USERNAME, PASSWORD, EMAIL, FECHA_REGISTRO) VALUES (:username, :password, :mail, NOW())';
    private const LOGIN = 'SELECT * FROM USERS WHERE USERS.EMAIL = :loginEmail';
    private const UPDATE_USERMAIL_BY_ID = 'UPDATE USERS SET USERS.EMAIL = :newMail WHERE USERS.USER_ID = :userID';
    private const UPDATE_USERPASSWORD_BY_ID = 'UPDATE USERS SET USERS.PASSWORD = :newPassword WHERE USERS.USER_ID = :userID';
    private const GET_USER_BY_ID = 'SELECT * FROM USERS WHERE USERS.USER_ID = :userID';
    private const GET_USER_BY_USERNAME = 'SELECT * FROM USERS WHERE USERS.USERNAME = :userName';
    private const GET_USER_BY_EMAIL = 'SELECT * FROM USERS WHERE USERS.EMAIL = :email';
    private const DELETE_USER = 'DELETE FROM USERS WHERE USERS.USER_ID = :userID';

    /**
     * Constructor de la clase UserManager.
     *
     * Recibe un PDO para poder realizar las operaciones con la base de datos.<br>
     * @param $db PDO Objeto de la clase PDO que contiene la conexión a la base de datos.
     * @return void
     */
    public function __construct(PDO $db) {
        $this->$db = $db;
    }

    /**
     * Método para registrar un usuario.
     *
     * Recibe el nombre de usuario, el email y la contraseña.<br>
     * La password se encripta con password_hash() y la constante de encriptación PASSWORD_DEFAULT, que usa BCrypt.<br>
     * También se pueden usar las constantes PASSWORD_BCRYPT, PASSWORD_ARGON2I o PASSWORD_ARGON2ID.<br>
     * @see https://www.php.net/manual/es/function.password-hash.php
     * @see https://www.php.net/manual/es/password.constants.php
     * @see https://www.php.net/manual/es/password.constants.php#password.constants.options
     * @param $username string nombre del usuario desde el formulario de registro.
     * @param $mail string email del usuario
     * @param $password string contraseña.
     * @return void
     */
    public function register(string $username, string $mail, string $password): void {
        $consulta = $this->db->prepare(self::REGISTRO);
        $consulta->bindParam(':username', $username);
        $consulta->bindParam(':mail', $mail);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $consulta->bindParam(':password', $password);
        $consulta->execute();
    }

    /**
     * Método para gestionar el login de un usuario.
     *
     * Recibe el email y la contraseña desde el login.
     * Comprueba si el email existe en la base de datos.
     * Si existe, comprueba si la contraseña coincide con la contraseña encriptada de la base de datos.
     * Si coincide, devuelve el usuario.
     * Si no coincide, devuelve false.
     * @param $loginEmail
     * @param $loginPassword
     * @return false|mixed
     */
    public function login(string $loginEmail, string $loginPassword): false|array {
        $consulta = $this->db->prepare(self::LOGIN);
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
}
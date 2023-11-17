<?php

use src\db\DatabaseOperations;
use src\UserManager;

require_once "../src/db/DatabaseOperations.php";

$mail = $_POST['loginEmail'];
$password = $_POST['loginPassword'];

$login = new DatabaseOperations();
$loginResult = $login->login($mail, $password);
session_start();
if (!$loginResult) {
    $_SESSION['failedLogin'] = true;
    header('Location: login-register.php');
}
if($loginResult) {
    $_SESSION['username'] = $loginResult['username'];
    header('Location: main.php');
}



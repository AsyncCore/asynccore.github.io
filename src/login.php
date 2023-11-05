<?php

use src\db\DatabaseOperations;

include "../src/utils/autoloader.php";

$mail = $_POST['loginEmail'];
$password = $_POST['loginPassword'];

$login = new DatabaseOperations();
$loginResult = $login->login($mail, $password);
session_start();
if (!$loginResult) {
    $_SESSION['failedLogin'] = true;
    header('Location: /login-register.php');
} else {
    $_SESSION['username'] = $loginResult['username'];
    header('Location: /AsyncCore.github.io/public/main.php');
}



<?php

$loginEmailError = $loginPasswordError = "";
$loginEmail = $loginPassword = $loginCheck = "";

$registerNameError = $registerUserNameError = $registerEmailError = $registerPasswordError =
$registerRepeatPasswordError = $registerCheckError = "";

$registerName = $registerUserName = $registerEmail = $registerPassword =
$registerRepeatPassword = $registerCheck = "";

function sanitize_data(string $data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['login'] == 'login'){
    if (empty($_POST["loginEmail"])) {
        $loginEmailError = "El Email es obligatorio";
    } else {
        $loginEmail = sanitize_data($_POST["loginEmail"]);
        if(!preg_match("/^[a-zA-Z0-9_.+-]+@educa\.madrid\.org$/",  $loginEmail)){
            $loginEmailError = "El Email debe ser de EducaMadrid <br> Ejemplo: 'usuario@educa.madrid.org'";
        }
    }

    if(empty($_POST["loginPassword"])) {
        $loginPasswordError = "La contraseña es obligatoria";
    } else {
        $loginPassword = sanitize_data($_POST["loginPassword"]);
        if(strlen($_POST["loginPassword"]) < 8){
            $loginPasswordError = "La contraseña debe tener al menos 8 caracteres";
        }else if(strlen($_POST["loginPassword"]) > 16) {
            $loginPasswordError = "La contraseña debe tener menos de 16 caracteres";
        }
    }

    $loginCheck = $_POST["loginCheck"];

    if($loginEmailError == "" && $loginPasswordError == "" && $loginCheck == "checked"){
        header("Location: ../index.php");
        exit;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['login'] == 'registro') {
    if (empty($_POST["registerName"])) {
        $registerNameError = "El nombre es obligatorio";
    } else {
        $registerName = sanitize_data($_POST["registerName"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $registerName)) {
            $registerNameError = "Solo se permiten letras y espacios";
        }
    }

    if (empty($_POST["registerUserName"])) {
        $registerUserNameError = "El nombre de usuario es obligatorio";
    } else {
        $registerUserName = sanitize_data($_POST["registerUserName"]);
        if (!preg_match("/^[a-zA-Z0-9]*$/", $registerUserName)) {
            $registerUserNameError = "Solo se permiten letras y números";
        }
    }

    if (empty($_POST["registerEmail"])) {
        $registerEmailError = "El Email es obligatorio";
    } else {
        $registerEmail = sanitize_data($_POST["registerEmail"]);
        if (!preg_match("/^[a-zA-Z0-9_.+-]+@educa\.madrid\.org$/", $registerEmail)) {
            $registerEmailError = "El Email debe ser de EducaMadrid <br> Ejemplo: 'usuario@educa.madrid.org'";
        }
    }

    if (empty($_POST["registerPassword"])) {
        $registerPasswordError = "La contraseña es obligatoria";
    } else {
        $registerPassword = sanitize_data($_POST["registerPassword"]);
        if (strlen($_POST["registerPassword"]) < 8) {
            $registerPasswordError = "La contraseña debe tener al menos 8 caracteres";
        } else if (strlen($_POST["registerPassword"]) > 16) {
            $registerPasswordError = "La contraseña debe tener menos de 16 caracteres";
        }
    }

    if (empty($_POST["registerRepeatPassword"])) {
        $registerRepeatPasswordError = "Debes volver a escribir la contraseña";
    } else {
        $registerRepeatPassword = sanitize_data($_POST["registerRepeatPassword"]);
        if (strlen($_POST["registerRepeatPassword"]) < 8) {
            $registerRepeatPasswordError = "La contraseña debe tener al menos 8 caracteres";
        } else if (strlen($_POST["registerRepeatPassword"]) > 16) {
            $registerRepeatPasswordError = "La contraseña debe tener menos de 16 caracteres";
        } else if ($_POST["registerRepeatPassword"] != $_POST["registerPassword"]) {
            $registerRepeatPasswordError = "Las contraseñas no coinciden";
        }
    }

    if (empty($_POST["registerCheck"])) {
        $registerCheckError = "Debes aceptar los términos y condiciones";
    } else {
        $registerCheck = $_POST["registerCheck"];
    }

    if($registerNameError == "" && $registerUserNameError == "" && $registerEmailError == "" &&
        $registerPasswordError == "" && $registerRepeatPasswordError == "" && $registerCheckError == ""){
        header("Location: ../index.php");
        exit;
    }
}
<?php
    include_once "../src/utils/sessionInit.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Metas de la página HTML-->
    <meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
    <meta content="Landing page del proyecto AsynCore" name="description">
    <meta content="Daniel Alonso Lázaro" name="author">
    <meta content="Maksym Dovgan" name="author">
    <meta content="Miguel Martínez Santos" name="author">
    <meta content="Víctor Hellín Sáez" name="author">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="copyright" name="&copy; AsynCore Project 2023">
    <!-- Metas de Open Graph -->
    <meta content="Landing page del proyecto AsynCore" property="og:title">
    <meta content="website" property="og:type">
    <meta content="img/logo/logo.ico" property="og:image">
    <meta content="index.php" property="og:url">
    <meta content="Landing page del proyecto AsynCore" property="og:description">
    <meta content="es_ES" property="og:locale">
    <meta content="en_EN" property="og:locale:alternate">
    <meta content="www.asyncore.es" property="og:site_name">
    <!-- Metas de Apple -->
    <meta content="AsynCore" name="apple-mobile-web-app-title">
    <meta content="AsynCore" name="application-name">
    <!-- Metas de Microsoft -->
    <meta content="#2d89ef" name="msapplication-TileColor">
    <meta content="img/logo/favicon/browserconfig.xml" name="msapplication-config">
    <!-- Metas de Chrome -->
    <meta content="#ffffff" name="theme-color">
    <!-- Favicon -->
    <link href="img/favicon/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
    <link href="img/favicon/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png">
    <link href="img/favicon/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png">
    <link href="img/favicon/site.webmanifest" rel="manifest">
    <link color="#5bbad5" href="/img/favicon/safari-pinned-tab.svg" rel="mask-icon">
    <link href="img/favicon/favicon.ico" rel="shortcut icon">
    <!-- CSS -->
    <link href="css/mdb/mdb.min.css" rel="stylesheet" type="text/css">
    <link href="css/index-style.css" rel="stylesheet" type="text/css">
    <!-- JavaScript -->
    <script src="js/main.js" type="text/javascript"></script>
    <script src="https://friconix.com/cdn/friconix.js" type="text/javascript"></script>
    <title>ASYNCORE PROJECT</title>
</head>
<body>
<main>
    <section>
        <div>
            <a class="logo" href="main.php"><img alt="AsynCore Logo" src="img/logo/logo.svg"></a>
            <h1>Asyn<span>Core</span></h1>
            <p><span id="por">Por</span> y <span id="para">para</span> alumnos</p>
        </div>
        <hr>
        <p class="bottom-p"><a href="login-register.php">Login / Registro</a></p>
        <p><span class="entrar">Entrar como</span> <br><a href="main.php">Visitante</a></p>
    </section>
</main>
<?php
include_once "../src/footer.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Metas de la página HTML-->
    <meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
    <meta content="Página de edición de posts" name="description">
    <meta content="Daniel Alonso Lázaro" name="author">
    <meta content="Maksym Dovgan" name="author">
    <meta content="Miguel Martínez Santos" name="author">
    <meta content="Víctor Hellín Sáez" name="author">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="copyright" name="&copy; AsynCore Project 2023">
    <!-- Metas de Open Graph -->
    <meta content="Editar Post" property="og:title">
    <meta content="website" property="og:type">
    <meta content="/img/logo/logo.ico" property="og:image">
    <meta content="/editarPost.html" property="og:url">
    <meta content="Página de edición de posts" property="og:description">
    <meta content="es_ES" property="og:locale">
    <meta content="en_EN" property="og:locale:alternate">
    <meta content="www.asyncore.es" property="og:site_name">
    <!-- Metas de Apple -->
    <meta content="AsynCore" name="apple-mobile-web-app-title">
    <meta content="AsynCore" name="application-name">
    <!-- Metas de Microsoft -->
    <meta content="#2d89ef" name="msapplication-TileColor">
    <meta content="/img/logo/favicon/browserconfig.xml" name="msapplication-config">
    <!-- Metas de Chrome -->
    <meta content="#ffffff" name="theme-color">
    <!-- Favicon -->
    <link href="/img/favicon/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
    <link href="/img/favicon/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png">
    <link href="/img/favicon/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png">
    <link href="/img/favicon/site.webmanifest" rel="manifest">
    <link color="#5bbad5" href="/img/favicon/safari-pinned-tab.svg" rel="mask-icon">
    <link href="/img/favicon/favicon.ico" rel="shortcut icon">
    <!-- CSS -->
    <link href="/css/mdb/mdb.min.css" rel="stylesheet" type="text/css">
    <link href="/css/hilos-posts-style.css" rel="stylesheet" type="text/css">
    <!-- JavaScript -->
    <script src="/js/main.js" type="text/javascript"></script>
    <title>Editar Post</title>
</head>
<body>
<?php
include_once "../src/header.php";
?>
<main>
    <h2 class="editar-titulo">Editar Post</h2>
    <form action="" class="edit-form" method="POST">
        <label class="form-label" for="contenido">Contenido:</label>
        <textarea class="form-textarea" id="contenido" name="contenido" required rows="8"></textarea>
        <input class="form-submit" type="submit" value="Guardar Cambios">
    </form>
</main>
<?php
include_once "../src/footer.php";
?>
</body>
</html>
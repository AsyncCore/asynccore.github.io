<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Metas de la página HTML-->
    <meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
    <meta content="Página del editor de creación de hilos" name="description">
    <meta content="Daniel Alonso Lázaro" name="author">
    <meta content="Maksym Dovgan" name="author">
    <meta content="Miguel Martínez Santos" name="author">
    <meta content="Víctor Hellín Sáez" name="author">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="copyright" name="&copy; AsynCore Project 2023">
    <!-- Metas de Open Graph -->
    <meta content="Crear hilo" property="og:title">
    <meta content="website" property="og:type">
    <meta content="/img/logo/logo.ico" property="og:image">
    <meta content="/crearHilo.html" property="og:url">
    <meta content="Página del editor de creación de hilos" property="og:description">
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
    <script defer src="/js/main.js" type="text/javascript"></script>
    <title>Crear hilo</title>
</head>
<body>
<?php
include_once "../src/header.php";
?>
<main>
    <h2 class="editar-titulo">Crear Hilo</h2>
    <form action="" class="edit-form" method="POST">
        <div class="form-group">
            <label for="post-title">Título:</label>
            <input id="post-title" name="post-title" required type="text">
        </div>

        <div class="form-group">
            <label for="post-tags">Etiquetas:</label>
            <select id="post-tags" multiple name="post-tags">
                <option value="etiqueta1">Etiqueta 1</option>
                <option value="etiqueta2">Etiqueta 2</option>
                <option value="etiqueta3">Etiqueta 3</option>
            </select>
        </div>

        <div class="form-group">
            <label for="post-content">Contenido:</label>
            <textarea id="post-content" name="post-content" required rows="4"></textarea>
        </div>

        <input class="form-submit" type="submit" value="Crear">
    </form>
</main>
<?php
    include_once "../src/footer.php";
?>
</body>
</html>
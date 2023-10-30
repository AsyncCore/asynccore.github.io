<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Metas de la página HTML-->
    <meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
    <meta content="pagina de error 403" name="description">
    <meta content="Daniel Alonso Lázaro" name="author">
    <meta content="Maksym Dovgan" name="author">
    <meta content="Miguel Martínez Santos" name="author">
    <meta content="Víctor Hellín Sáez" name="author">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="copyright" name="&copy; AsynCore Project 2023">
    <!-- Metas de Open Graph -->
    <meta content="403" property="og:title">
    <meta content="website" property="og:type">
    <meta content="/img/logo/logo.ico" property="og:image">
    <meta content="/error-pages/403.php" property="og:url">
    <meta content="pagina de error 403" property="og:description">
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
    <link href="/css/error-pages.css" rel="stylesheet" type="text/css">
    <link href="prism.css" rel="stylesheet" type="text/css">
    <!-- JavaScript -->
    <script defer src="/js/error-pages.js" type="text/javascript"></script>
    <script defer src="prism.js" type="text/javascript"></script>
    <!-- Font Awesome -->
    <script crossorigin="anonymous" defer src="https://kit.fontawesome.com/9e6ce9bbf3.js"></script>
    <title>403</title>
</head>
<body>

<main>
    <main>
        <div>
            <p>
                <span class="http">HTTP: </span><span class="num-error">403</span></p></div>
        <div style="text-align:center;">
        <pre style="display:inline-block; text-align:left; white-space: pre;">
        <code class="language-php">/* 403.php */</code>
        <code class="language-php">&lt;?php</code>
            <code class="language-php">$usuario = "Tú";</code>
            <code class="language-php">$acceso_permitido = false;</code>

            <code class="language-php">if ($usuario !== "admin") {</code>
                <code class="language-php">echo "ERROR 403 - ACCESO DENEGADO";</code>
            <code class="language-php">} else {</code>
                <code class="language-php">echo "¡Bienvenido, admin!.";</code>
            <code class="language-php">}</code>

            <code class="language-php">if (!$acceso_permitido) {</code>
                <code class="language-php">echo "¡UYUYUY! !Alguien se ha dejado el sudo en casa¡";</code>
            <code class="language-php">}</code>
        <code class="language-php">?&gt;</code>
        </pre>
        </div>
        <a href="https://www.asyncore.es/main.php" class="center-link">Intentar con superpoderes</a>
    </main>
</main>

</body>
</html>
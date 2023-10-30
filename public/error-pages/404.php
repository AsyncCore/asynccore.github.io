<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Metas de la página HTML-->
    <meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
    <meta content="PÁGINA DE ERROR 404 - NO ENCONTRADO" name="description">
    <meta content="Daniel Alonso Lázaro" name="author">
    <meta content="Maksym Dovgan" name="author">
    <meta content="Miguel Martínez Santos" name="author">
    <meta content="Víctor Hellín Sáez" name="author">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="copyright" name="&copy; AsynCore Project 2023">
    <!-- Metas de Open Graph -->
    <meta content="ERROR 404" property="og:title">
    <meta content="website" property="og:type">
    <meta content="/img/logo/logo.ico" property="og:image">
    <meta content="/error-pages/404.php" property="og:url">
    <meta content="PÁGINA DE ERROR 404 - NO ENCONTRADO" property="og:description">
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
    <link href="/error-pages/prism.css" rel="stylesheet" type="text/css">
    <!-- JavaScript "-->"
    <script defer src="/error-pages/prism.js" type="text/javascript"></script>
    <script defer src="/js/error-pages.js" type="text/javascript"></script>
    <!-- Font Awesome -->
    <script crossorigin="anonymous" defer src="https://kit.fontawesome.com/9e6ce9bbf3.js"></script>
    <title>ERROR 404</title>
</head>
<body>
<main>
    <div><p><span class="http">HTTP: </span><span class="num-error">404</span></p></div>
    <div style="text-align:center;">
        <pre style="display:inline-block; text-align:left; white-space: pre;">
        <code class="language-php">/* 404.php */</code>
        <code class="language-php">&lt;?<i id="custom-php" class="jiji">php</i></code>
            <code class="language-php">$url = "<?= $_SERVER['REQUEST_URI']?>";</code>
            <code class="language-php">$no_sabes_escribir = false;</code>
            <code class="language-php">$la_hemos_cagado = true;</code>
            <code class="language-php">$encontrada = false;</code>

            <code class="language-php">if ($url == !$encontrada) {</code>
                <code class="language-php">echo "ERROR 404 - PÁGINA NO ENCONTRADA";</code>
            <code class="language-php">}else{</code>
                <code class="language-php">if ($no_sabes_escribir) {</code>
                    <code class="language-php">echo "Aver hestudiao.";</code>
                <code class="language-php">} else if ($la_hemos_cagado) {</code>
                    <code class="language-php">echo "Lo sentimos...";</code>
                <code class="language-php">}</code>
            <code class="language-php">}</code>

            <code class="language-php">header("Location: https://www.asyncore.es/main.php", true, 302);</code>
            <code class="language-php">exit;</code>
        <code class="language-php">?&gt;</code>
        </pre>
    </div>
    <a href="https://www.asyncore.es/main.php">HOME</a>
</main>
</body>
</html>
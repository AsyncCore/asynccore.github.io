<!DOCTYPE html>
<html lang="es">
<head>
    <meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
    <meta content="Página de ajustes de usuario" name="description">
    <meta content="Daniel Alonso Lázaro" name="author">
    <meta content="Maksym Dovgan" name="author">
    <meta content="Miguel Martínez Santos" name="author">
    <meta content="Víctor Hellín Sáez" name="author">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="copyright" name="&copy; AsynCore Project 2023">
    <meta property="og:title" content="Página de ajustes de usuario">
    <meta property="og:type" content="website">
    <meta property="og:image" content="/img/logo/logo.ico">
    <meta property="og:url" content="/usuario-perfil.html">
    <meta property="og:description" content="Página de ajustes de usuario">
    <meta property="og:locale" content="es_ES">
    <meta property="og:locale:alternate" content="en_EN">
    <meta property="og:site_name" content="www.asyncore.es">
    <meta name="apple-mobile-web-app-title" content="AsynCore">
    <meta name="application-name" content="AsynCore">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-config" content="/img/logo/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/img/favicon/favicon.ico">
    <link href="/css/usuario-perfil-ajustes.css" rel="stylesheet">
    <title>Perfíl de Usuario</title>
    <script defer crossorigin="anonymous" src="https://kit.fontawesome.com/9e6ce9bbf3.js"></script>
    <script defer src="/js/main.js"></script>
</head>
<body>
<?php
include_once "../src/logged-header.php";
?>
<main>
    <section id="contenedor-perfil">
        <div id="col1-fil-all">
            <form action="/old/asyncore-0.2/usuario-perfil.phpsuario-perfil.php">
                <div class="editar-user">
                    <h3>Perfil de Redcario4444 <input type="text" placeholder="Nuevo Nickname" id="nickname"></h3>
                    <p><img src="/img/pruebas/usuario-perfil/images.jpg"><a href="">🖊</a></p>
                    <p>Víctor Hellín Sáez <input type="text" placeholder="Nuevo nombre" id="nombre"></p>
                    <p>Estado: Picando código. <input type="text" placeholder="Nuevo estado" id="estado"></p>
                    <p>Hilos creados: 420</p>
                    <p>Posts realizados: 4215</p>
                    <p>Miembro desde: 12-10-2023</p>
                    <button type="submit" class="botones-envio"> Guardar</button>
                </div>
            </form>
            <form action="/old/asyncore-0.2/usuario-perfil.phpsuario-perfil.php">
                <div class="user-menu">
                    Sobre mi
                    <ul>
                        <li>Estudiando DAW</li>
                        <li>🎵Que pasará que misterios habrá, puede ser mi gran noche🎵</li>
                        <li>Mis cualidades son el manejo de Arrays y Bucles</li>
                        <li>Mi página Web favorita: <a href="https://asyncore.es">asyncore.es</a></li>
                    </ul>
                    <textarea placeholder="Sobre mí" id="sobre-mi"></textarea>
                    <button type="submit" class="botones-envio"> Guardar</button>
                </div>
            </form>
        </div>
    </section>
    <aside>

    </aside>
</main>
<?php
include_once "../src/footer.php";
?>
</body>
</html>
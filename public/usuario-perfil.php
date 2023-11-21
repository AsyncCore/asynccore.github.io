<!DOCTYPE html>
<html lang="es">
<head>
    <meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
    <meta content="Página perfil usuario" name="description">
    <meta content="Daniel Alonso Lázaro" name="author">
    <meta content="Maksym Dovgan" name="author">
    <meta content="Miguel Martínez Santos" name="author">
    <meta content="Víctor Hellín Sáez" name="author">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="copyright" name="&copy; AsynCore Project 2023">
    <meta property="og:title" content="Perfíl de Usuario">
    <meta property="og:type" content="website">
    <meta property="og:image" content="/img/logo/logo.ico">
    <meta property="og:url" content="/usuario-perfil.html">
    <meta property="og:description" content="Página perfil usuario">
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
    <link href="/css/usuario-perfil-style.css" rel="stylesheet">
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
            <div>
                <h3>Perfil de Redcario4444 <a href="">🖊</a></h3>
                <p><img src="/img/pruebas/usuario-perfil/images.jpg"><a href="">🖊</a></p>
                <p>Víctor Hellín Sáez <a href="">🖊</a></p>
                <p>Estado: Picando código. <a href="">🖊</a></p>
                <p>Hilos creados: 420</p>
                <p>Posts realizados: 4215</p>
                <p>Miembro desde: 12-10-2023</p>
            </div>
            <div>
                Sobre mi <a href="">🖊</a>
                <ul>
                    <li>Estudiando DAW</li>
                    <li>🎵Que pasará que misterios habrá, puede ser mi gran noche🎵</li>
                    <li>Mis cualidades son el manejo de Arrays y Bucles</li>
                    <li>Mi página Web favorita: <a href="https://asyncore.es">asyncore.es</a></li>
                </ul>
            </div>
        </div>
        <div id="col2-fil-all">
            <div class="dif">
                <div>
                    <h3>Configuración de Perfíl</h3>
                </div>
                <hr>
                <div>
                    <a href="">Editar Nombre</a>
                </div>
                <hr>
                <div>
                    <a href="">Editar Foto</a>
                </div>
                <hr>
                <div>
                    <a href="">Editar Contraseña</a>
                </div>
                <hr>
                <div>
                    <a href="/usuario-perfil-ajustes.php">Editar Opciones</a>
                </div>
            </div>
            <div class="dif">
                <div>
                    <h3>Últimas participaciones</h3>
                </div>
                <hr>
                <div>
                    <a href="">Bucle While</a>
                </div>
                <hr>
                <div>
                    <a href="">Puntero C</a>
                </div>
                <hr>
                <div>
                    <a href="">Walter White</a>
                </div>
                <hr>
                <div>
                    <a href="">PhP Productions</a>
                </div>
                <hr>
                <div>
                    <a href="">Ciencia en C#</a>
                </div>
            </div>
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
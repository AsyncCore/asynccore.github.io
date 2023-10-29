<?php
$success = $_POST['success'] ?? false;
$loginEmail = $_POST['loginEmail'] ?? false;
$usuario = $success ? substr($loginEmail, 0, strpos($loginEmail, "@")): "Invitado";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Metas de la página HTML-->
    <meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
    <meta content="Página principal de AsynCore" name="description">
    <meta content="Daniel Alonso Lázaro" name="author">
    <meta content="Maksym Dovgan" name="author">
    <meta content="Miguel Martínez Santos" name="author">
    <meta content="Víctor Hellín Sáez" name="author">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="copyright" name="&copy; AsynCore Project 2023">
    <!-- Metas de Open Graph -->
    <meta content="AsynCore" property="og:title">
    <meta content="website" property="og:type">
    <meta content="/img/logo/logo.ico" property="og:image">
    <meta content="/index.html" property="og:url">
    <meta content="Página principal de AsynCore" property="og:description">
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
    <link href="/css/main-style.css" rel="stylesheet" type="text/css">
    <!-- JavaScript -->
    <script defer src="/js/main-main.js" type="text/javascript"></script>
    <script defer src="/js/mdb/mdb.min.js" type="text/javascript"></script>
    <title>AsynCore</title>
</head>
<body>
<header>
    <nav>
        <div class="logo">
            <a href="https://www.asyncore.es">
                <img alt="Logo" src="/img/logo/logo.svg">
                <h1>AsynCore</h1>
            </a>
        </div>
        <div class="barra-busqueda">
            <label>
                <input placeholder="🔎 Barra búsqueda">
            </label>
        </div>
        <p>Bienvenido: <?= $usuario ?></p>
        <div class="user-menu">
            <a href="/usuario-perfil.php"><button id="boton">Usuario</button></a>
            <div class="dropdown-content" id="dropdown">
                <a href="/login-register.php">Login - Registro</a>
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="contenido">
        <aside class="sidebar">
            <ul class="menu">
                <li class="menu-item">
                    <a href="/index.html">Dashboard</a>
                </li>
                <li class="menu-item has-submenu">
                    <a href="#">Navegación<br>Hilos</a>
                    <ul class="submenu">
                        <li><a href="#">Más populares</a></li>
                        <li><a href="#">Últimos modificados</a></li>
                        <li><a href="/crearHilo.php">Crear Hilo</a></li>
                        <li><a href="/editorHilos.php">Editar Hilo</a></li>
                        <li><a href="/crearPost.php">Crear Post</a></li>
                        <li><a href="/editarPost.php">Editar Post</a></li>
                    </ul>
                </li>
                <li class="menu-item has-submenu">
                    <a href="#">Páginas</a>
                    <ul class="submenu">
                        <li class="submenu-item has-submenu">
                            <a href="#">Archivos</a>
                            <ul class="submenu">
                                <li><a href="https://files.asyncore.es">Files</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item has-submenu">
                            <a href="#">Authentication</a>
                            <ul class="submenu">
                                <li><a href="/login-register.php">Login-Registro</a></li>
                                <li><a href="/rememberPassword.html">Recordar<br>contraseña</a></li>
                            </ul>
                        </li>
                        <li class="submenu-item has-submenu">
                            <a href="#">Error</a>
                            <ul class="submenu">
                                <li><a href="/error-pages/404.html">404</a></li>
                            </ul>
                        <li class="submenu-item has-submenu">
                            <a href="#">¿Quiénes Somos?</a>
                            <ul class="submenu">
                                <li><a href="https://github.com/GyllenhaalSP">Daniel Alonso</a></li>
                                <li><a href="https://github.com/xrezu">Maksym Dovgan</a></li>
                                <li><a href="https://github.com/trikytrukos">Miguel Martínez</a></li>
                                <li><a href="https://github.com/Redcario4444">Victor Hellín</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>
        <section>
            <div class="container">
                <div class="thread-content">
                    <div class="user-box">
                        <h4><?= $usuario == "Invitado" ? "Redcario4444" : $usuario ?></h4>
                    </div>
                    <h2>Hilo de ejemplo</h2>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, quos excepturi eaque quia
                    asperiores
                    deserunt et voluptatem veritatis, in dolorem sint quam cupiditate reiciendis minus at, autem
                    aperiam
                    nam? Minima?
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic quaerat nesciunt esse nihil est
                    architecto, harum tenetur nam cumque consequuntur, molestias exercitationem aspernatur! Magni,
                    corporis?
                    Eligendi accusantium ab repellendus commodi!
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure quia ducimus, ex maiores, eius
                    odio culpa
                    fugiat distinctio repellendus consequatur adipisci vitae blanditiis sunt tempora, maxime eum
                    error
                    ratione ipsa?
                    <div class="tag-box">
                        <ul>
                            <li><h6>#PHP</h6></li>
                            <li><h6>#APACHE</h6></li>
                            <li><h6>#MYSQL</h6></li>
                        </ul>
                    </div>
                </div>

                <div class="post-content">
                    <div class="post-user-box">
                        <p>Triky</p>
                    </div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam asperiores explicabo harum
                        incidunt iure, labore omnis perspiciatis quasi quo vero. Distinctio dolore iste quam quas qui
                        quod repellendus sunt voluptatibus.
                    </div>
                    <div>At atque aut autem consequatur deserunt dolore earum facere fuga impedit maiores modi mollitia
                        nam natus nisi officia quisquam saepe sapiente sint, sit unde vel, veniam veritatis vitae.
                        Atque, repellendus.
                    </div>
                    <div>Accusamus aliquam architecto blanditiis culpa eum fugit ipsam iure modi, molestiae provident
                        quam quo reprehenderit sapiente? Debitis id ipsa mollitia non optio pariatur recusandae?
                        Adipisci explicabo molestias perferendis tempore voluptatum.
                    </div>
                </div>
                <div class="post-content">
                    <div class="post-user-box">
                        <p><?= $usuario == "Invitado" ? "Redcario4444" : $usuario ?></p>
                    </div>
                    <div>A accusantium aperiam beatae commodi cumque cupiditate earum illo incidunt itaque,
                        minus nobis placeat possimus, quaerat qui quia sapiente sequi sit, ut.
                    </div>
                    <div>Dolores fugit iure possimus tempora voluptate. Amet dolore ducimus ipsa libero nesciunt optio
                        quae, quia reiciendis repellat rerum ullam vel? Aliquam consequatur dignissimos dolorem odio
                        quis, quos recusandae repudiandae rerum.
                    </div>
                </div>
                <div class="post-content">
                    <div class="post-user-box">
                        <p>GyllenhaalSP</p>
                    </div>
                    <div> Consectetur adipisicing elit. Aperiam asperiores explicabo harum
                        deserunt et voluptatem veritatis, in dolorem sint quam cupiditate reiciendis minus at, autem
                        aperiam
                        nam? Minima?
                    </div>
                </div>
                <div class="post-content">
                    <div class="post-user-box">
                        <p>xrezu</p>
                    </div>
                    <div>Aliquid asperiores aut cum cumque dignissimos ea, fuga incidunt iusto nemo nihil nostrum
                        officiis optio placeat porro praesentium quaerat quam quas ratione reprehenderit sit soluta vero
                        voluptatum! Molestiae, nulla, officia.
                    </div>
                    <div>Atque distinctio, magnam perferendis quibusdam tenetur voluptatem voluptatibus! Eaque fugiat
                        nihil provident quaerat qui quo unde veritatis voluptate! Dolore dolorem ducimus error explicabo
                        in ipsum, iure iusto molestias optio perferendis.
                    </div>
                    <div>Eligendi, est, nisi! Amet cum ex excepturi harum reprehenderit? Amet at beatae consectetur
                        culpa cumque dignissimos ducimus error, esse facere, magnam necessitatibus nulla numquam omnis
                        perferendis repellat, saepe sapiente similique.
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<footer class="footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-left">
                <span class="text-muted">Copyright &copy; AsynCore 2023</span>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
<?php
    /**
     * @var string $currentPath
     * @var string $currentDir
     * @var string $currentRoot
     */
    
    $target_url = $currentDir == '/main.php'
        ? 'https://' . $currentRoot . '/index.php'
        : 'https://' . $currentRoot . '/main.php';
?>

<body>
<header class='header' id='header'>
    <a class='logo' href='<?=$target_url?>'>
        <img alt='AsynCore Logo' src='/img/logo/logo.svg'>
    </a>

    <div class='btn-hamburger'>
        <!-- use .btn-humburger-active to open the menu -->
        <span class='top bar'></span>
        <span class='middle bar'></span>
        <span class='bottom bar'></span>
    </div>

    <!-- use .navbar-open to open nav -->
    <nav class='navbar444'>
        <ul>
            <li class='navbar-item'>
                <a href='login-register.php'>Login / Registro</a>
            </li>
        </ul>
        <ul>
            <li class='navbar-item'>
                <a href='main.php'>Inicio</a>
            </li>
            <li class='navbar-item'>
                <a href='category.php'>Categorias</a>
            </li>
            <li class='navbar-item'>
                <a href='forum.php'>Foro</a>
            </li>
            <li class='navbar-item'>
                <a href='thread.php'>Hilos</a>
            </li>
            <li class='navbar-item'>
                <a href='FAQ.php'>FAQ</a>
            </li>
            <li class='navbar-item'>
                <a href='about-us.php'>¿Quiénes somos?</a>
            </li>
        </ul>
    </nav>
</header>
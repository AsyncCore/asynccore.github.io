<?php
    /**
     * @var string $currentPath
     * @var string $currentDir
     * @var string $currentRoot
     */
    
    $target_url = $currentDir == '/main.php' ? 'https://' . $currentRoot . '/index.php' : 'https://' . $currentRoot . '/main.php';
?>

<body>
<header class='header' id='header'>
    
    <a class='logo' href='<?=$target_url?>>'>
        <img alt='AsynCore Logo' src='/img/logo/logo.svg'>
    </a>
    
    <div class='btn-hamburger'>
        <!-- use .btn-humburger-active to open the menu -->
        <span class='top bar'></span>
        <span class='middle bar'></span>
        <span class='bottom bar'></span>
    </div>
    
    <!-- use .navbar-open to open nav -->
    <nav class='navbar'>
        <ul>
            <li class='navbar-user'>
                <a href='#'>
                    <img
                        class='avatar-small' src="<?=$_SESSION['AVATAR']?>>" alt="Avatar usuario <?=$_SESSION['USERNAME']?>">
                    <span>
                        <?= $_SESSION['USERNAME'] ?? 'Invitado' ?>
                        <img alt='' class='icon-profile' src='/img/icons/arrow-profile.svg'>
                    </span>
                </a>
                
                <!-- dropdown menu -->
                <!-- add class 'active-drop' to show the dropdown -->
                <div id='user-dropdown'>
                    <div class='triangle-drop'></div>
                    <ul class='dropdown-menu'>
                        <li class='dropdown-menu-item'><a href='../public/pruebas/new/profile.html'>View profile</a></li>
                        <li class='dropdown-menu-item'><a href='#'>Log out</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        
        <ul>
            <li class='navbar-item'>
                <a href='main.php'>Inicio</a>
            </li>
            <li class='navbar-item'>
                <a href='../public/pruebas/new/category.html'>Hilos</a>
            </li>
            <li class='navbar-item'>
                <a href='../public/pruebas/new/forum.html'>Forum</a>
            </li>
            <li class='navbar-item'>
                <a href='../public/pruebas/new/thread.html'>Asyncore Files</a>
            </li>
            <li class='navbar-item'>
                <a href='../public/pruebas/new/thread.html'>¿Quien somos?</a>
            </li>
            <!-- Show these option only on mobile-->
            <li class='navbar-item mobile-only'>
                <a href='../public/pruebas/new/profile.html'>My Profile</a>
            </li>
            <li class='navbar-item mobile-only'>
                <a href='../public/pruebas/new/navbar-login.html'>Logout</a>
            </li>
        </ul>
    </nav>
</header>

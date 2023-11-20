
<body>
<header class="header" id="header">
    <a class="logo" href="<?=$target_url?>">
            <img alt="AsynCore Logo" src="img/logo/logo.svg">
    </a>
    <div class="btn-hamburger">
        <span class="top bar"></span>
        <span class="middle bar"></span>
        <span class="bottom bar"></span>   
    </div>    
    <nav class="navbar">
    <ul>
            <li class="navbar-user">
                <a href="#">
                    <img 
                         class="avatar-small" src="$img-loged-user" alt="$img-loged-user">
                    <span>
                    <?=$_SESSION['USERNAME'] ?? "Invitado"?>
                        <img alt="" class="icon-profile" src="<?=$_SESSION['USER-IMAGE'] ?? "img/logo/logo.svg"?>">
                    </span>
                </a>

                <!-- dropdown menu -->
                <!-- add class "active-drop" to show the dropdown -->
                <div id="user-dropdown">
                    <div class="triangle-drop"></div>
                    <ul class="dropdown-menu">
                        <li class="dropdown-menu-item"><a href="usuario-perfil.php">Ver Perfil</a></li>
                        <li class="dropdown-menu-item"><a href="#">Log out</a></li>
                    </ul>
                </div>
            </li>
        </ul>

        <ul>
            <li class="navbar-item">
                <a href="index.html">Inicio</a>
            </li>
            <li class="navbar-item">
                <a href="category.html">Hilos</a>
            </li>
            <li class="navbar-item">
                <a href="files.asyncore.es">Asyncore Files</a>
            </li>
            <li class="navbar-item">
                <a href="quienes-somos.php">¿Quien somos?</a>
            </li>
            <!-- Show these option only on mobile-->
            <li class="navbar-item mobile-only">
                <a href="usuario-perfil.php">Mi Perfil</a>
            </li>
            <li class="navbar-item mobile-only">
                <a href="#">Logout</a>
            </li>
        </ul>
    </nav>
</header>





    <!-- use .navbar-open to open nav -->
   
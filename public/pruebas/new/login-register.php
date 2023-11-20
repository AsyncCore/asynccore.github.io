<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cooking Forum</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script defer src="js/script.js"></script>
</head>
<body>
<header class="header" id="header">

    <a class="logo" href="index.php">
        <img alt="AsynCore Logo" src="/img/logo/logo.svg">
    </a>

    <div class="btn-hamburger">
        <!-- use .btn-humburger-active to open the menu -->
        <span class="top bar"></span>
        <span class="middle bar"></span>
        <span class="bottom bar"></span>
    </div>

    <!-- use .navbar-open to open nav -->
    <nav class="navbar">
        <ul>
            <li class="navbar-user">
                <a href="#">
                    <img
                            class="avatar-small" src="$img-loged-user" alt="$img-loged-user">
                    <span>
                        $loged-user
                        <img alt="" class="icon-profile" src="../../img/icons/arrow-profile.svg">
                    </span>
                </a>

                <!-- dropdown menu -->
                <!-- add class "active-drop" to show the dropdown -->
                <div id="user-dropdown">
                    <div class="triangle-drop"></div>
                    <ul class="dropdown-menu">
                        <li class="dropdown-menu-item"><a href="profile.html">View profile</a></li>
                        <li class="dropdown-menu-item"><a href="#">Log out</a></li>
                    </ul>
                </div>
            </li>
        </ul>

        <ul>
            <li class="navbar-item">
                <a href="index.php">Inicio</a>
            </li>
            <li class="navbar-item">
                <a href="category.html">Hilos</a>
            </li>
            <li class="navbar-item">
                <a href="forum.html">Forum</a>
            </li>
            <li class="navbar-item">
                <a href="thread.html">Asyncore Files</a>
            </li>
            <li class="navbar-item">
                <a href="thread.html">¿Quien somos?</a>
            </li>
            <!-- Show these option only on mobile-->
            <li class="navbar-item mobile-only">
                <a href="profile.html">My Profile</a>
            </li>
            <li class="navbar-item mobile-only">
                <a href="#">Logout</a>
            </li>
        </ul>
    </nav>
</header>

  <div class="container">


  </div>


  <div class="forum-stats desktop-only">
    <hr>
    <ul>
        <li><i class="fa fa-user-circle-o"></i>$count-active-users online</li>
        <li><i class="fa fa-user-o"></i>$count-users registered</li>
        <li><i class="fa fa-comments-o"></i>$count-threads threads</li>
        <li><i class="fa fa-comment-o"></i>$count-posts posts</li>
    </ul>
</div>

<div class="footer-asyncore">
    Asyncore &copy; 2023
</div>

</body>
</html>

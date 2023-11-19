<?php
/**
 * @var string $currentPath
 * @var string $currentDir
 * @var string $currentRoot
 */

$target_url = $currentDir == '/main.php' ? 'https://' . $currentRoot . '/index.php' : 'https://' . $currentRoot . '/main.php';
?>
<body>
<header>
    <nav>
        <div class="logo">
            <a href="<?=$target_url?>">
                <img alt="Logo" src="img/logo/logo.svg">
                <h1>AsynCore</h1>
            </a>
        </div>
        <div class="barra-busqueda">
            <label>
                <input placeholder="🔎 Barra de búsqueda">
            </label>
        </div>
        <div class="user-menu">
            <a href="usuario-perfil.php">
                <button id="boton" class="boton"><?=$_SESSION['USERNAME'] ?? "Invitado"?></button>
            </a>
            <div class="dropdown-content" id="dropdown">
                <a href="login-register.php">Login - Registro</a>
            </div>
        </div>
    </nav>
</header>
<header>
    <nav>
        <div class="logo">
            <a href="
<?php
$currentPath = $_SERVER['PHP_SELF'];
$currentDir = substr($currentPath, strrpos($currentPath, "/"), strlen($currentPath));
$currentRoot = $_SERVER['HTTP_HOST'];
$target_url = $currentDir == '/main.php' ? "https://" . $currentRoot . "/index.php" : "https://" . $currentRoot . "/main.php";
echo $target_url;
echo <<<HTML
                                                       ">
                <img alt="Logo" src="/img/logo/logo.svg">
                <h1>AsynCore</h1>
            </a>
        </div>
        <div class="barra-busqueda">
            <label>
                <input placeholder="🔎 Barra búsqueda">
            </label>
        </div>
        
        <div class="user-menu">
            <a href="/usuario-perfil.php"><button class="boton">Perfil</button></a>
            <div class="dropdown-content" id="dropdown">
                <a href="/login-register.php">Login - Registro</a>
            </div>
        </div>
        </div>
    </nav>
</header>
HTML;
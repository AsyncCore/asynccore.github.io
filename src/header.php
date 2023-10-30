<?php
$success = $_POST['success'] ?? false;
$loginEmail = $_POST['loginEmail'] ?? false;
$usuario = $success ? substr($loginEmail, 0, strpos($loginEmail, "@")) : "Invitado";
echo <<<HTML
<header>
    <nav>
        <div class="logo">
            <a href="
HTML;
$current_path = $_SERVER['PHP_SELF'];
$current_dir = substr($current_path, strrpos($current_path, "/"), strlen($current_path));
$current_host = $_SERVER['HTTP_HOST'];
$target_url = $current_dir == '/main.php' ? "https://" . $current_host . "/index.php" : "https://" . $current_host . "/main.php";
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
            <a href="/usuario-perfil.php"><button class="boton">
HTML;
echo $usuario;
echo <<<HTML
            </button></a>
            <div class="dropdown-content" id="dropdown">
                <a href="/login-register.php">Login - Registro</a>
            </div>
        </div>
        </div>
    </nav>
</header>
HTML;
<?php

    require __DIR__ . '/../src/utils/autoloader.php';
    include_once __DIR__ . '/../config/databaseQueries.php';
    include_once __DIR__ . "/../src/utils/utils.php";

    /**
	 * @var string $usuario         /src/header.php
	 * @var array  $resultado_hilos /config/databaseQueries.php
	 * @var array  $resultado_posts /config/databaseQueries.php
	 */

    if (!isset($resultado_hilos)){
        $resultado_hilos = [];
        $resultado_posts = [];
    }
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
<?php
	include_once "../src/header.php";
?>
<main>
	<div class="contenido">
		<aside class="sidebar">
			<ul class="menu">
				<li class="menu-item">
					<a href="/main.php">INICIO</a>
				</li>
				<li class="menu-item has-submenu">
					<a href="#">Navegación<br>Hilos</a>
					<ul class="submenu">
						<li><a href="/error-pages/500.php">Más populares</a></li>
						<li><a href="/error-pages/403.php">Últimos modificados</a></li>
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
								<li><a href="/error-pages/404.php">404</a></li>
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
			<?php
				$user_hilo = $resultado_hilos[0]['USERNAME'];
				$titulo_hilo = $resultado_hilos[0]['TITULO'];
				$contenido_hilo = $resultado_hilos[0]['CONTENIDO'];
				$firma_hilo = $resultado_hilos[0]['FIRMA'];
				$fecha_creacion_hilo = formatDate($resultado_hilos[0]['FECHA_CREACION']);
			?>
			<div class="container">
				<div class="thread-content">
					<div class="header-content">
						<div class="user-box">
							<h4 class="user-tag"><?= $user_hilo ?></h4>
						</div>
						<h2><?= $titulo_hilo ?></h2>
					</div>
					<div>
						<?= $contenido_hilo ?>
					</div>
					<div class="tag-box">
						<div>
							Firma: <?= $firma_hilo ?> - Creado el <?= $fecha_creacion_hilo ?>
						</div>
						<ul>
							<li><h6>#PHP</h6></li>
							<li><h6>#APACHE</h6></li>
							<li><h6>#MYSQL</h6></li>
						</ul>
					</div>
				</div>
				<?php foreach($resultado_posts as $post): ?>
					<?php $fecha_post = formatDate($post["FECHA_CREACION"]); ?>
					<div class="post-content">
						<div class="post-user-box">
							<p class="user-tag"><?= $post["USERNAME"] ?></p>
						</div>
						<div>
							<?= $post["CONTENIDO"] ?>
							<div class="fecha">
								Firma: <?= $post["FIRMA"] ?> - Fecha de posteo: <?= $fecha_post ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
		</section>
	</div>
</main>
<?php
	include_once "../src/footer.php";
?>
</body>
</html>
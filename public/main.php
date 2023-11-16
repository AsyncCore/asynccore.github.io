<?php
    /**
     * @var string $currentRoot
    * @var string $descripcion
    * @var string $titulo
    * @var string $css
    * @var string $js
    * @var string $mdb
    * @var array $resultado_hilos
    */

    require '../src/utils/autoloader.php';
    require '../vendor/autoload.php';
    include_once '../config/databaseQueries.php';
    include_once "../src/utils/utils.php";

    $user_hilo = $resultado_hilos[0]['USERNAME'];
    $titulo_hilo = $resultado_hilos[0]['TITULO'];
    $contenido_hilo = $resultado_hilos[0]['CONTENIDO'];
    $firma_hilo = $resultado_hilos[0]['FIRMA'];
    $fecha_creacion_hilo = formatDate($resultado_hilos[0]['FECHA_CREACION']);

    /**
	 * @var string $usuario         /src/header.php
	 * @var array  $resultado_hilos /config/databaseQueries.php
	 * @var array  $resultado_posts /config/databaseQueries.php
	 */

    if (!isset($resultado_hilos)){
        $resultado_hilos = [];
        $resultado_posts = [];
    }

    $descripcion = "Página principal de AsynCore";
    $titulo = "AsynCore";
    $css = ["css/main-style.css"];
    $js = ["js/main-main.js", 'js/mdb/mdb.min.js'];
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
					<?php $fecha_post = isset($fecha_post) ? formatDate($post["FECHA_CREACION"]) : ""; ?>
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
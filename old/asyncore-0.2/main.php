<?php
    /**
    * @var string $descripcion /src/logged-header.php
    * @var string $titulo /src/logged-header.php
    * @var string $css /src/logged-header.php
    * @var string $js /src/logged-header.php
    */
    
    require '../src/utils/sessionInit.php';
    require DIR . '/src/utils/autoloader.php';
    require DIR . '/vendor/autoload.php';
    include_once DIR . '/src/utils/utils.php';
    
    unsetLoginRegister();
    
    $descripcion = "Página principal de AsynCore";
    $titulo = "AsynCore";
    $css = ["css/main-style.css"];
    $js = ["js/main-main.js", 'js/mdb/mdb.min.js', 'https://friconix.com/cdn/friconix.js'];
	include_once DIR . '/src/head.php';
    include_once DIR . '/src/logged-header.php';
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
			<!--<div class="container">
				<div class="thread-content">
					<div class="header-content">
						<div class="user-box">
							<h4 class="user-tag"><?php /*= $user_hilo */?></h4>
						</div>
						<h2><?php /*= $titulo_hilo */?></h2>
					</div>
					<div>
						<?php /*= $contenido_hilo */?>
					</div>
					<div class="tag-box">
						<div>
							Firma: <?php /*= $firma_hilo */?> - Creado el <?php /*= $fecha_creacion_hilo */?>
						</div>
						<ul>
							<li><h6>#PHP</h6></li>
							<li><h6>#APACHE</h6></li>
							<li><h6>#MYSQL</h6></li>
						</ul>
					</div>
				</div>
				<?php /*foreach($resultado_posts as $post): */?>
					<?php /*$fecha_post = isset($fecha_post) ? formatDate($post["FECHA_CREACION"]) : ""; */?>
					<div class="post-content">
						<div class="post-user-box">
							<p class="user-tag"><?php /*= $post["USERNAME"] */?></p>
						</div>
						<div>
							<?php /*= $post["CONTENIDO"] */?>
							<div class="fecha">
								Firma: <?php /*= $post["FIRMA"] */?> - Fecha de posteo: <?php /*= $fecha_post */?>
							</div>
						</div>
					</div>
				<?php /*endforeach; */?>
		</section>-->
	</div>
</main>
<?php
	include_once DIR . "/src/footer.php";
?>
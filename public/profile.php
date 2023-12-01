<?php
    /**
     * @var string $descripcion /src/logged-header.php
     * @var string $titulo /src/logged-header.php
     * @var string $css /src/logged-header.php
     * @var string $js /src/logged-header.php
     */
    
    require '../src/init.php';
    
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    use src\managers\PostsManager;
    use src\managers\ThreadManager;
    use src\managers\CategoryManager;
    
    
    $db = DatabaseConnection::getInstance()->getConnection();
    $categoryManager = new CategoryManager($db);
    $threadManager = new ThreadManager($db);
    $postManager = new PostsManager($db);
    $userManager = new UserManager($db);
    
    $username = '';
    $name = '';
    $firma = '';
    $avatar = '';
    $email = '';
    $cantPosts = 0;
    $cantHilos = 0;
    
    if (isset($_SESSION['USER_ID']) || isset($_COOKIE[COOKIE_NAME])) {
        if (isset($_GET['UID']) && is_numeric($_GET['UID'])) {
            $userId = htmlspecialchars($_GET['UID']);
            $userInfo = $userManager->getUserById($userId);
            $username = $userInfo['USERNAME'];
            $name = $userInfo['NAME'];
            $firma = $userInfo['FIRMA'];
            $avatar = $userInfo['AVATAR'];
            $email = $userInfo['EMAIL'];
            $cantPosts = $postManager->getPostCountByUserId($userId);
            $cantHilos = $threadManager->getThreadCountByUserId($userId);
            $ultimasInteracciones = $userManager->obtenerUltimasInteracciones($userId);
            $online = $userManager->isUserOnline($userId);
            $offline = !$online;
        }
    } else {
        header("Location: login-register.php?nl");
    }
    unsetLoginRegister();
    
    <--TODO -->
    
    $descripcion = "Página de perfíl de AsynCore";
    $titulo = "AsynCore";
    $css = ["css/style.css"];
    $js = [["js/script.js"]];
    $cdn = ["https://friconix.com/cdn/friconix.js"];
    include_once DIR . '/src/head.php';
    if (isset($_SESSION['USER_ID']) || isset($_COOKIE[COOKIE_NAME])) {
        include_once DIR . '/src/logged-header.php';
    } else {
        include_once DIR . '/src/login-header.php';
    }
?>
    <div class="container">
    <div class="flex-grid">
        <div class="col-3 push-top">

            <div class="profile-card">

                <p class="text-center">
                    <img src="<?php echo $avatar; ?>" alt="" class="avatar-xlarge">
                </p>

                <h1 class="title"><?php echo $username; ?></h1>

                <p class="text-lead"><?php echo $name; ?></p>

                <p class="text-justify">
                    <?php echo $firma; ?>
                </p>

                <span class="user-status <?= $online ? 'online' : 'offline' ?>"><?php echo $username; ?> <?= $online ? ' online' : ' offline' ?></span>

                <!--TODO ACTUALIZAR BASE DE DATOS PARA AÑADIR ESTOS CAMPOS-->
                <div class="stats">
                    <span><?php echo $cantPosts; ?> posts</span>
                    <span><?php echo $cantHilos; ?> threads</span>
                </div>

                <hr>

                <span>email</span>
                <p class="text-large text-center"><i class="fa fa-globe"></i><?php echo $email; ?></p>

            </div>

            <p class="text-xsmall text-faded text-center">Member since june 2003, last visited 4 hours ago</p>

            <div class="text-center">
                <hr>
                <a href="edit-profile.php" class="btn-green btn-small">Edit Profile</a>
            </div>

        </div>
        <!--AQUI SE MUESTRA LA ACTIVIDAD RECIENTE DE ESTE USUARIO Y ESTOS SON EJEMPLOS DE COSAS QUE PUED EHABER HECHO COMO CREAR HILOS O RESPONDER A POSTS-->
        <!--TODO LO QUE ESTÁ ENTRE PARENTESIS EN LOS HILSO/POSTS ES SOLO TEXTO DE EJEMPLO Y HAY QUE QUITARLO -->
        <!--TODO HACER LA PAGINA EN LA QUE SE MUESTRAN UNICAMENTE TODOS LOS HILOS QUE HA CREADO EL USUARIO(SEE ONLU STARTEDTHREADS)-->
        <div class="col-7 push-top">

            <div class="profile-header">
                  <span class="text-lead">
                      <?php echo $username; ?>'s recent activity
                  </span>
                <a href="#">See only started threads?</a>
            </div>

            <hr>

            <div class="activity-list">
                <?php foreach ($ultimasInteracciones
                    
                    as $interaccion): ?>
                <div class="activity">
                    <div class="activity-header">
                        <!-- Aquí puedes añadir la imagen del avatar del usuario, si está disponible en la estructura de datos -->
                        <p class="title">
                            <?php if ($interaccion['tipo'] == 'post'): ?>
                                Respuesta en el hilo: <?php // Obtén el título del hilo del post aquí ?>
                            <?php elseif ($interaccion['tipo'] == 'hilo'): ?>
                                <?php // Obtén el título del hilo aquí ?>
                            <?php endif; ?>
                            <span><?php echo $username; ?> <!-- Acción realizada (respondió, inició, etc.) --> en <?php // Categoría del hilo/post aquí ?></span>
                        </p>
                    </div>

                    <div class="post-content">
                        <div>
                            <p>
                                <?php
                                    if ($interaccion['tipo'] == 'post') {
                                        $detalle = $postManager->obtenerPostCompleto($interaccion['id']);
                                        $contenido = $detalle['CONTENIDO'];
                                        
                                        // Usar expresiones regulares para mantener bloques de código intactos
                                        $contenido = preg_replace_callback(
                                            '/<pre.*?>.*?<\/pre>/ms',
                                            function ($matches) {
                                                // Devolver los bloques de código sin cambios
                                                return $matches[0];
                                            },
                                            $contenido
                                        );
                                        
                                        // Eliminar todas las demás etiquetas HTML
                                        $contenido = strip_tags($contenido, '<pre><code>');
                                        
                                        echo $contenido;
                                    } elseif ($interaccion['tipo'] == 'hilo') {
                                        // Procesamiento similar para los hilos
                                        // ...
                                    }
                                ?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php
    include_once DIR . '/src/footer.php';
?>
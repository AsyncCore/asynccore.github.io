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
        if(isset($_GET['UID']) && is_numeric($_GET['UID'])){
            $userId = htmlspecialchars($_GET['UID']);
            $userInfo = $userManager->getUserById($userId);
            $username = $userInfo['USERNAME'];
            $name = $userInfo['NAME'];
            $firma = $userInfo['FIRMA'];
            $avatar = $userInfo['AVATAR'];
            $email = $userInfo['EMAIL'];
            $cantPosts = $postManager->getPostCountByUserId($userId);
            $cantHilos = $threadManager->getThreadCountByUserId($userId);
            $ultimosPosts = $postManager->getLastPostsByUser($userId, 2);
            $ultimosHilos = $threadManager->getLastThreadsByUser($userId, 2);
            $online = $userManager->isUserOnline($userId);
            $offline = !$online;
        }
    } else {
        header("Location: login-register.php?nl");
    }
    unsetLoginRegister();
    
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
                    <?php foreach ($ultimosHilos as $hilo): ?>
                        <div class="activity">
                            <div class="activity-header">
                                <img src="https://i.imgur.com/OqlZN48.jpg" alt="" class="hide-mobile avatar-small">
                                <p class="title">
                                    $titulo-hilo
                                    <span>$username started a topic in $categoria</span>
                                </p>

                            </div>

                            <div class="post-content">
                                <div>
                                    <p>$contenido(I absolutely love onions, but they hurt my eyes! Is there a way where
                                        you can chop onions without crying?)</p>
                                </div>
                            </div>

                            <div class="thread-details">
                                <span>4 minutes ago</span>
                                <span>1 comments</span>
                            </div>
                        </div>

                        <div class="activity">
                            <div class="activity-header">

                                <img src="http://i.imgur.com/s0AzOkO.png" alt="" class="hide-mobile avatar-small">

                                <p class="title">
                                    $titulo-hilo/post-al-que-responde
                                    <span>$username replied to $username-propietario topic in $categoria</span>
                                </p>

                            </div>

                            <div class="post-content">
                                <div>
                                    <blockquote class="small">
                                        <div class="author">
                                            <a href="/user/robin" class="">$username-propietario</a>
                                            <span class="time">a month ago</span>
                                            <i class="fa fa-caret-down"></i>
                                        </div>

                                        <div class="quote">
                                            <p>$contenido-hilo/post-al-que-responde(Is horseradish and Wasabi the same
                                                thing? I&amp;#39;ve heard so many different things.)</p>
                                        </div>
                                    </blockquote>

                                    <p>$contenido-de-la-respuesta(They're not the same!)</p>
                                </div>
                            </div>

                            <div class="thread-details">
                                <span>2 days ago</span>
                                <span>1 comment</span>
                            </div>
                        </div>

                        <div class="activity">
                            <div class="activity-header">
                                <img src="https://i.imgur.com/OqlZN48.jpg" alt="" class="hide-mobile avatar-small">
                                <p class="title">
                                    $titulo-hilo/post-al-que-responde
                                    <span><?php echo $username; ?> replied to his own topic in $categoria</span>
                                </p>

                            </div>

                            <div class="post-content">
                                <div>
                                    <p><strong><i>Post deleted due to inappropriate language</i></strong></p>
                                </div>
                            </div>

                            <div class="thread-details">
                                <span>7 days ago</span>
                                <span>7 comments</span>
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
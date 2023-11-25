<?php
    /**
    * @var string $descripcion /src/logged-header.php
    * @var string $titulo /src/logged-header.php
    * @var string $css /src/logged-header.php
    * @var string $js /src/logged-header.php
    */
    
    require '../src/init.php';

    unsetLoginRegister();

    $descripcion = "Página de perfíl de AsynCore";
    $titulo = "AsynCore";
    $css = ["css/style.css"];
    $js = ["js/script.js"];
    $cdn = ["https://friconix.com/cdn/friconix.js"];
	include_once DIR . '/src/head.php';
    if (isset($_SESSION['USER_ID'])) {
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
                      <img src="https://i.imgur.com/OqlZN48.jpg" alt=""
                           class="avatar-xlarge">
                  </p>

                  <h1 class="title">$username</h1>

                  <p class="text-lead">$name</p>

                  <p class="text-justify">
                      $firma
                  </p>

                  <span class="online">$username is online</span>

                    <!--TODO ACTUALIZAR BASE DE DATOS PARA AÑADIR ESTOS CAMPOS-->
                  <div class="stats">
                      <span>$cant-posts posts</span>
                      <span>$cant-hilos threads</span>
                  </div>

                  <hr>

                  <span>email</span>
                  <p class="text-large text-center"><i class="fa fa-globe"></i>$correo-educamadrid</p>

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
                      $username's recent activity
                  </span>
                  <a href="#">See only started threads?</a>
              </div>

              <hr>

              <div class="activity-list">
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
                          <p>$contenido(I absolutely love onions, but they hurt my eyes! Is there a way where you can chop onions without crying?)</p>
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
                                    <p>$contenido-hilo/post-al-que-responde(Is horseradish and Wasabi the same thing? I&amp;#39;ve heard so many different things.)</p>
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
                              <span>$username replied to his own topic in $categoria</span>
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

              </div>
          </div>
      </div>
  </div>
<?php
    include_once DIR . '/src/footer.php';
?>
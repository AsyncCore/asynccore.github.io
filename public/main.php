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
    $css = ["css/style.css"];
    $js = ["js/script.js", "https://friconix.com/cdn/friconix.js"];
	include_once DIR . '/src/head.php';
    include_once DIR . '/src/logged-header.php';
?>
<main>
    <div class="container">
        <div class="col-full">
            <div class="forum-list">
    
                <h2 class="list-title">
                    <a href="category.html">Últimos Hilos</a>
                </h2>
    
                <div class="forum-listing">
                    <div class="forum-details">
                        <a class="text-xlarge" href="forum.html">$titulo-hilo</a>
                        <p>$subtitulo-hilo(no estoy seguro de que exista)</p>
                    </div>
    
                    <div class="threads-count">
                        <p><span class="count">$n-posts</span>posts</p>
                    </div>
    
                    <div class="last-thread">
                        <img alt=""
                             class="avatar" src="https://pbs.twimg.com/profile_images/719242842598699008/Nu43rQz1_400x400.jpg">
                        <div class="last-thread-details">
                            <a href="thread.html">$tag</a>
                            <p class="text-xsmall">De <a href="profile.html">$user</a>, $time-ago</p>
                        </div>
                    </div>
                </div>
    
                <div class="forum-listing">
                    <div class="forum-details">
                        <a class="text-xlarge" href="forum.html">$titulo-hilo</a>
                        <p>$subtitulo-hilo(no estoy seguro de que exista)</p>
                    </div>
    
                    <div class="threads-count">
                        <p><span class="count">$n-posts</span>posts</p>
                    </div>
    
                    <div class="last-thread">
                        <img alt=""
                             class="avatar" src="https://pbs.twimg.com/profile_images/719242842598699008/Nu43rQz1_400x400.jpg">
                        <div class="last-thread-details">
                            <a href="thread.html">$tag</a>
                            <p class="text-xsmall">De <a href="profile.html">$user</a>, $time-ago</p>
                        </div>
                    </div>
                </div>
    
            <div class="forum-list">
    
                <h2 class="list-title">
                    <a href="category.html">Hilos populares</a>
                </h2>
    
                <div class="forum-listing">
                    <div class="forum-details">
                        <a class="text-xlarge" href="forum.html">$titulo-hilo</a>
                        <p>$subtitulo-hilo(no estoy seguro de que exista)</p>
                    </div>
    
                    <div class="threads-count">
                        <p><span class="count">$n-posts</span>posts</p>
                    </div>
    
                    <div class="last-thread">
                        <img alt=""
                             class="avatar" src="https://pbs.twimg.com/profile_images/719242842598699008/Nu43rQz1_400x400.jpg">
                        <div class="last-thread-details">
                            <a href="thread.html">$tag</a>
                            <p class="text-xsmall">De <a href="profile.html">$user</a>, $time-ago</p>
                        </div>
                    </div>
                </div>
    
                <div class="forum-listing">
                    <div class="forum-details">
                        <a class="text-xlarge" href="forum.html">$titulo-hilo</a>
                        <p>$subtitulo-hilo(no estoy seguro de que exista)</p>
                    </div>
    
                    <div class="threads-count">
                        <p><span class="count">$n-posts</span>posts</p>
                    </div>
    
                    <div class="last-thread">
                        <img alt=""
                             class="avatar" src="https://pbs.twimg.com/profile_images/719242842598699008/Nu43rQz1_400x400.jpg">
                        <div class="last-thread-details">
                            <a href="thread.html">$tag</a>
                            <p class="text-xsmall">De <a href="profile.html">$user</a>, $time-ago</p>
                        </div>
                    </div>
                </div>
    
                <div class="forum-listing">
    
                    <div class="forum-details">
                        <a class="text-xlarge" href="forum.html">$titulo-hilo</a>
                        <!-- TODO: Bucle para cargar todos los tags del hilo usando PHP -->
                        <ul class="subforums">
                            <li><a href="#">$tag</a></li>
                            <li><a href="#">$tag</a></li>
                            <li><a href="#">$tag</a></li>
                            <li><a href="#">$tag</a></li>
                        </ul>
    
                    </div>
    
    
                    <div class="threads-count">
                        <p class="count">$n-posts</p>posts
                    </div>
    
                    <div class="last-thread">
                        <img alt=""
                             class="avatar"
                             src="https://firebasestorage.googleapis.com/v0/b/forum-2a982.appspot.com/o/images%2Favatars%2Fraynathan?alt=media&token=bd9a0f0e-60f2-4e60-b092-77d1ded50a7e">
                    <div class="last-thread-details">
                                <a href="thread.html">$tag</a>
                                <p class="text-xsmall">De <a href="profile.html">$user</a>, $time-ago</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
    include_once DIR . '/src/footer.php';
?>

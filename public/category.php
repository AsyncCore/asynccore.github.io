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

    $descripcion = "Página para las categorías de AsynCore";
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
      <div class="col-full push-top">
          <h1>Discussions</h1>
      </div>

      <div class="col-full">
          <div class="forum-list">

              <h2 class="list-title">
                  <a href="category.html">Discussions</a>
              </h2>

              <div class="forum-listing">

                  <div class="forum-details">
                      <a class="text-xlarge" href="forum.html">Pets</a>

                      <p>All things pet related</p>

                  </div>

                  <div class="threads-count">
                      <p class="count">1337</p> threads
                  </div>

                  <div class="last-thread">
                      <img class="avatar" src="https://i.imgur.com/WPSrfGm.jpg" alt="">
                      <div class="last-thread-details">
                          <a href="thread.html">What is the best animal joke y...</a>
                          <p class="text-xsmall">By <a href="profile.php">Blossom</a>, 16 hours ago</p>
                      </div>
                  </div>

              </div>

              <div class="forum-listing">

                  <div class="forum-details">
                      <a class="text-xlarge" href="forum.html">Vehicles</a>

                      <p>Petrol head? This is your section</p>

                  </div>

                  <div class="threads-count">
                      <p class="count">463</p> threads
                  </div>

                  <div class="last-thread">
                      <img class="avatar" src="https://firebasestorage.googleapis.com/v0/b/forum-2a982.appspot.com/o/images%2Favatars%2Fraynathan?alt=media&token=bd9a0f0e-60f2-4e60-b092-77d1ded50a7e" alt="">
                      <div class="last-thread-details">
                          <a href="thread.html">Do you know what FIAT stands f...</a>
                          <p class="text-xsmall">By <a href="profile.php">Ray-Nathan James</a>, three weeks ago</p>
                      </div>
                  </div>

              </div>

              <div class="forum-listing">

                  <div class="forum-details">
                      <a class="text-xlarge" href="forum.html">Fishing</a>

                      <ul class="subforums">
                          <li><a href="#">Freshwater</a></li>
                          <li><a href="#">Saltwater</a></li>
                          <li><a href="#">Underwater</a></li>
                          <li><a href="#">Phising</a></li>
                      </ul>

                  </div>

                  <div class="threads-count">
                      <p class="count">49</p> threads
                  </div>

                  <div class="last-thread">
                      <img class="avatar" src="https://firebasestorage.googleapis.com/v0/b/forum-2a982.appspot.com/o/images%2Favatars%2Fraynathan?alt=media&token=bd9a0f0e-60f2-4e60-b092-77d1ded50a7e" alt="">
                      <div class="last-thread-details">
                          <a href="thread.html">What is the most exciting fish...</a>
                          <p class="text-xsmall">By <a href="profile.php">Ray-Nathan James</a>, 3 hours ago</p>
                      </div>
                  </div>

              </div>

              <div class="forum-listing">

                  <div class="forum-details">
                      <a class="text-xlarge" href="forum.html">Cooking</a>

                      <ul class="subforums">
                        <li><a href="#">Recipes</a></li>
                      </ul>

                  </div>

                  <div class="threads-count">
                      <p class="count">16</p> threads
                  </div>

                  <div class="last-thread">
                      <img class="avatar" src="http://i0.kym-cdn.com/photos/images/facebook/000/010/934/46623-batman_pikachu_super.png" alt="">
                      <div class="last-thread-details">
                          <a href="thread.html">How can I chop onions without...</a>
                          <p class="text-xsmall">By <a href="profile.php">Bruce Wayne</a>, last week</p>
                      </div>
                  </div>

              </div>

              <div class="forum-listing">

                  <div class="forum-details">
                      <a href="forum.html" class="text-xlarge">Miscellaneous</a>
                      <p>The forum for anything</p>
                  </div>

                  <div class="threads-count">
                      <p class="count">0</p> threads
                  </div>

                  <div class="last-thread">
                      No threads here
                  </div>
              </div>

          </div>
      </div>

  </div>
<?php
    include_once DIR . '/src/footer.php';
?>

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

                  <h1 class="title">joker</h1>

                  <p class="text-lead">Joseph Kerr</p>

                  <p class="text-justify">
                      No bio specified.
                  </p>

                  <span class="online">joker is online</span>


                  <div class="stats">
                      <span>116 posts</span>
                      <span>73 threads</span>
                  </div>

                  <hr>

                  <p class="text-large text-center"><i class="fa fa-globe"></i> <a href="#">batman.com</a></p>

              </div>

              <p class="text-xsmall text-faded text-center">Member since june 2003, last visited 4 hours ago</p>

              <div class="text-center">
                <hr>
                <a href="edit-profile.html" class="btn-green btn-small">Edit Profile</a>
              </div>

          </div>

          <div class="col-7 push-top">

              <div class="profile-header">
                  <span class="text-lead">
                      Joker's recent activity
                  </span>
                  <a href="#">See only started threads?</a>
              </div>

              <hr>

              <div class="activity-list">
                  <div class="activity">
                      <div class="activity-header">
                          <img src="https://i.imgur.com/OqlZN48.jpg" alt="" class="hide-mobile avatar-small">
                          <p class="title">
                              How can I chop onions without crying?
                              <span>Joker started a topic in Cooking</span>
                          </p>

                      </div>

                      <div class="post-content">
                        <div>
                          <p>I absolutely love onions, but they hurt my eyes! Is there a way where you can chop onions without crying?</p>
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
                                  Wasabi vs horseraddish?
                                  <span>Joker replied to Robin's topic in Cooking</span>
                              </p>

                          </div>

                          <div class="post-content">
                            <div>
                              <blockquote class="small">
                                  <div class="author">
                                      <a href="/user/robin" class=""> robin</a>
                                      <span class="time">a month ago</span>
                                      <i class="fa fa-caret-down"></i>
                                  </div>

                                  <div class="quote">
                                    <p>Is horseradish and Wasabi the same thing? I&amp;#39;ve heard so many different things.</p>
                                  </div>
                              </blockquote>

                              <p>They're not the same!</p>
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
                              Where is the sign in button??????!?!?!?!
                              <span>Joker replied to his own topic in Questions & Feedback</span>
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
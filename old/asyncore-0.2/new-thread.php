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

    $descripcion = "Página de nuevo hilo de AsynCore";
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

          <h1>Create new thread in <i>Cooking</i></h1>

          <form action="">
              <div class="form-group">
                <label for="thread_title">Title:</label>
                <input type="text" id="thread_title" class="form-input" name="title" >
              </div>

              <div class="form-group">
                <label for="thread_content">Content:</label>
                <textarea id="thread_content" class="form-input" name="content" rows="8" cols="140"></textarea>
              </div>

              <div class="btn-group">
                <button class="btn btn-ghost">Cancel</button>
                <button class="btn btn-blue" type="submit" name="Publish">Publish </button>
              </div>
          </form>
      </div>

  </div>
<?php
    include_once DIR . '/src/footer.php';
?>
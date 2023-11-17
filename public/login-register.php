<?php
include '../src/formValidation.php';
/**
 * Variables del formulario de login.
 * @var string $loginEmailError Error del email
 * @var string $loginPasswordError Error de la Password<br>
 * @var string $loginEmail Email del usuario
 * @var string $loginPassword Password del usuario
 * @var string $loginCheck Checkbox de recordar usuario
 */

/**
 * Variables del formulario de registro. <br>
 * @var string $registerNameError Error del nombre
 * @var string $registerUserNameError Error del nombre de usuario
 * @var string $registerEmailError Error del email
 * @var string $registerPasswordError Error de la Password
 * @var string $registerRepeatPasswordError Error de la Password que no ha sido repetida
 * @var string $registerCheckError Error del checkbox de aceptar términos<br>
 * @var string $registerName Nombre y apellidos del usuario
 * @var string $registerUserName Nombre de usuario
 * @var string $registerEmail Email del usuario
 * @var string $registerPassword Password del usuario
 * @var string $registerRepeatPassword Password del usuario repetida
 * @var string $registerCheck Checkbox de aceptar términos
 */

/** Otras variables <br>
 * @var string $activeTab Pestaña activa
 * @var string $message Mensaje de error o de éxito
 * @var string $autofocus Autofocus en el email
 * @var string $registerGET GET desde registro
 */

$message = EMPTY_STRING;
$autofocus = EMPTY_STRING;
$registerGET = $_GET['register'] ?? FALSE;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $registerGET) {
    $activeTab = 'registro';
}

if ($_SERVER['REQUEST_METHOD'] == METHOD_POST && $_POST['form'] == ACTIVE_TAB_DEFAULT) {
    $loginEmail = $_POST['loginEmail'] ?? EMPTY_STRING;
    $autofocus = $_POST['loginEmail'] ?? EMPTY_STRING;
    $loginPassword = $_POST['loginPassword'] ?? EMPTY_STRING;
    $loginCheck = $_POST['loginCheck'] ?? EMPTY_STRING;
    $message = $_POST['message'] ?? EMPTY_STRING;
}

/*session_start();
$fail = $_SESSION['failedLogin'] ?? FALSE;
if ($fail){
    $message = "<div class='alert alert-danger' role='alert'>El usuario o la contraseña son incorrectos</div>";
}else{
    $message = EMPTY_STRING;
}
session_destroy();*/
$descripcion = 'Página de Login/Registro de AsynCore';
$titulo = 'LOGIN / REGISTRO';
$css = ["/css/bootstrap/bootstrap.min.css", "/css/mdb/mdb.min.css", "/css/login-registro-style.css"];
$js = ['js/main-main.js', '/js/bootstrap/bootstrap.bundle.js', '/js/mdb/mdb.min.js'];
$cdn = "<script defer crossorigin='anonymous' src='https://kit.fontawesome.com/9e6ce9bbf3.js' type='text/javascript'></script>";
include_once "../src/header.php";
?>
<main>
    <section class="pb-1 caja">
        <div>
            <?= $message ?>
        </div>
        <div class="externo">
            <section class="w-100 p4 d-flex justify-content-center pb-2">
                <div style="width: 26rem;">
                    <!-- SELECTOR FORMULARIO -->
                    <!-- LOGIN -->
                    <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?= $activeTab == 'login' ? 'active' : '' ?>"
                               id="tab-login"
                               data-mdb-toggle="pill"
                               href="#pills-login"
                               role="tab"
                               aria-controls="pills-login"
                               aria-selected="true">Login</a>
                        </li>
                        <!-- REGISTRO -->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?= $activeTab == 'registro' ? 'active' : '' ?>"
                               id="tab-register"
                               data-mdb-toggle="pill"
                               href="#pills-register"
                               role="tab"
                               aria-controls="pills-register"
                               aria-selected="false">Regístrate</a>
                        </li>
                    </ul>
                    <!-- SELECTOR FORMULARIO -->

                    <!-- INICIO SESIÓN BOTONES -->
                    <div class="tab-content ">
                        <!-- BOTONES DE LOGIN -->
                        <div class="tab-pane fade <?= $activeTab == 'login' ? 'show active' : '' ?>" id="pills-login"
                             role="tabpanel" aria-labelledby="tab-login">
                            <!-- FORMULARIO DE LOGIN -->
                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <input type="hidden" name="form" value="login">
                                <div class="text-center mb-3">
                                    <p>Inicia sesión con:</p>
                                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>

                                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                                        <i class="fab fa-google"></i>
                                    </button>

                                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                                        <i class="fab fa-twitter"></i>
                                    </button>

                                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                                        <i class="fab fa-github"></i>
                                    </button>
                                </div>
                                <?= $_SERVER['HTTP_HOST']?>
                                <p class="text-center">o:</p>

                                <!-- EMAIL INPUT -->
                                <span class="error"><?= $loginEmailError ?></span>
                                <div class="form-outline mb-4">
                                    <input type="text" id="loginEmail" class="form-control" name="loginEmail"
                                           value="<?= $loginEmail ?>" <?= $autofocus ? 'autofocus': EMPTY_STRING ?>>
                                    <label class="form-label" for="loginEmail">Email</label>
                                </div>

                                <!-- PASSWORD INPUT -->
                                <span class="error"><?= $loginPasswordError ?></span>
                                <div class="form-outline mb-4">
                                    <input type="password" id="loginPassword" class="form-control" name="loginPassword"
                                           value="<?= $loginPassword ?>">
                                    <label class="form-label" for="loginPassword">Contraseña</label>
                                </div>

                                <!-- 2 COLUMN GRID LAYOUT -->
                                <div class="row mb-4">
                                    <div class="col-md-6 d-flex justify-content-center">
                                        <!-- CHECKBOX -->
                                        <div class="form-check mb-3 mb-md-0">
                                            <input class="form-check-input" type="checkbox" id="loginCheck"
                                                   name="loginCheck" <?= $loginCheck == "1" ? "checked" : "" ?>>
                                            <label class="form-check-label" for="loginCheck"> Recuérdame </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex justify-content-center">
                                        <!-- LINK RECORDATORIO CONTRASEÑA-->
                                        <a href="/rememberPassword.html">¿Has olvidado tu contraseña?</a>
                                    </div>
                                </div>

                                <!-- BOTÓN DE ENVÍO -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">Iniciar sesión</button>

                                <!-- LINK AL REGISTRO -->
                                <div class="text-center">
                                    <p>¿No tienes usuario?
                                        <a href="/login-register.php?register=true">Regístrate
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                        <!-- FORMULARIO DE LOGIN -->

                        <!-- FORMULARIO DE REGISTRO -->
                        <div class="tab-pane fade <?= $activeTab == 'registro' ? 'show active' : '' ?>"
                             id="pills-register"
                             role="tabpanel" aria-labelledby="tab-register">
                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <input type="hidden" name="form" value="register">
                                <div class="text-center mb-3">
                                    <p>Regístrate con:</p>
                                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>

                                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                                        <i class="fab fa-google"></i>
                                    </button>

                                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                                        <i class="fab fa-twitter"></i>
                                    </button>

                                    <button type="button" class="btn btn-secondary btn-floating mx-1">
                                        <i class="fab fa-github"></i>
                                    </button>
                                </div>

                                <p class="text-center">o:</p>

                                <!-- NAME INPUT -->
                                <span class="error"><?= $registerNameError ?></span>
                                <div class="form-outline mb-4">
                                    <input type="text" id="registerName" class="form-control" name="registerName"
                                           value="<?= $registerName ?>">
                                    <label class="form-label" for="registerName">Nombre</label>
                                </div>

                                <!-- USERNAME INPUT -->
                                <span class="error"><?= $registerUserNameError ?></span>
                                <div class="form-outline mb-4">
                                    <input type="text" id="registerUsername" class="form-control"
                                           name="registerUserName"
                                           value="<?= $registerUserName ?>">
                                    <label class="form-label" for="registerUsername">Usuario</label>
                                </div>

                                <!-- EMAIL INPUT -->
                                <span class="error"><?= $registerEmailError ?></span>
                                <div class="form-outline mb-4">
                                    <input type="text" id="registerEmail" class="form-control" name="registerEmail"
                                           value="<?= $registerEmail ?>">
                                    <label class="form-label" for="registerEmail">Email</label>
                                </div>

                                <!-- PASSWORD INPUT -->
                                <span class="error"><?= $registerPasswordError ?></span>
                                <div class="form-outline mb-4">
                                    <input type="password" id="registerPassword" class="form-control"
                                           name="registerPassword"
                                           value="<?= $registerPassword ?>">
                                    <label class="form-label" for="registerPassword">Contraseña</label>
                                </div>

                                <!-- REPETIR PASSWORD INPUT -->
                                <span class="error"><?= $registerRepeatPasswordError ?></span>
                                <div class="form-outline mb-4">
                                    <input type="password" id="registerRepeatPassword" class="form-control"
                                           name="registerRepeatPassword" value="<?= $registerRepeatPassword ?>">
                                    <label class="form-label" for="registerRepeatPassword">Repite la contraseña</label>
                                </div>

                                <!-- CHECKBOX -->
                                <span class="error"><?= $registerCheckError ?></span>
                                <div class="form-check d-flex justify-content-center mb-4">
                                    <input class="form-check-input me-2" type="checkbox"
                                           id="registerCheck" aria-describedby="registerCheckHelpText"
                                           name="registerCheck"
                                        <?= $registerCheck == "1" ? "checked" : "" ?>>
                                    <label class="form-check-label" for="registerCheck">
                                        He leído y acepto los términos
                                    </label>
                                </div>

                                <!-- BOTÓN DE ENVÍO -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">Registrarse</button>
                                <!-- LINK AL LOGIN -->
                                <div class="text-center">
                                    <p>¿Ya tienes usuario?
                                        <a href="/login-register.php">Inicia sesión</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <aside>
    </aside>
</main>
<?php
include_once "../src/footer.php";
?>
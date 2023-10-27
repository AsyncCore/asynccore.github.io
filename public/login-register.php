<?php
@include '../src/form-validation.php';
/**
 * Variables del formulario de login
 * @var $loginEmailError
 * @var $loginPasswordError
 * @var $loginEmail
 * @var $loginPassword
 * @var $loginCheck
 * Variables del formulario de registro
 * @var $registerNameError
 * @var $registerUserNameError
 * @var $registerEmailError
 * @var $registerPasswordError
 * @var $registerRepeatPasswordError
 * @var $registerName
 * @var $registerUserName
 * @var $registerEmail
 * @var $registerPassword
 * @var $registerRepeatPassword
 * @var $registerCheck
 * @var $registerCheckError
 */

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta content="text/html;charset=UTF-8" http-equiv="Content-Type">
    <meta content="Página de Login/Registro de AsynCore" name="description">
    <meta content="Daniel Alonso Lázaro" name="author">
    <meta content="Maksym Dovgan" name="author">
    <meta content="Miguel Martínez Santos" name="author">
    <meta content="Víctor Hellín Sáez" name="author">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="copyright" name="&copy; AsynCore Project 2023">
    <meta property="og:title" content="PÁGINA DE LOGIN/REGISTRO DE ASYNCORE">
    <meta property="og:type" content="website">
    <meta property="og:image" content="/img/logo/logo.ico">
    <meta property="og:url" content="login-register.html">
    <meta property="og:description" content="Página de Login/Registro de AsynCore">
    <meta property="og:locale" content="es_ES">
    <meta property="og:locale:alternate" content="en_EN">
    <meta property="og:site_name" content="www.asyncore.es">
    <meta name="apple-mobile-web-app-title" content="AsynCore">
    <meta name="application-name" content="AsynCore">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="msapplication-config" content="/img/logo/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="img/favicon/favicon.ico">
    <link href="/css/mdb/mdb.min.css" rel="stylesheet">
    <link href="/css/login-registro-style.css" rel="stylesheet">
    <title>LOGIN / REGISTRO</title>
    <script defer crossorigin="anonymous" src="https://kit.fontawesome.com/9e6ce9bbf3.js"></script>
    <script defer src="/js/mdb/mdb.min.js"></script>
    <script defer src="/pag-principal-max/main.js"></script>
</head>
<body>
<main>
    <header>
        <nav>
        </nav>
    </header>
    <section>
        <div class="externo">
            <!-- SELECTOR FORMULARIO -->
            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active"
                        id="tab-login"
                        data-mdb-toggle="pill"
                        href="#pills-login"
                        role="tab"
                        aria-controls="pills-login"
                        aria-selected="true">Login</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link"
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
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>">
                        <input type="hidden" name="login" value="login">
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

                        <p class="text-center">o:</p>

                        <!-- EMAIL INPUT -->
                        <span class="error"><?= $loginEmailError ?></span>
                        <div class="form-outline mb-4">
                            <input type="text" id="loginEmail" class="form-control" name="loginEmail" value="<?= $loginEmail ?>">
                            <label class="form-label" for="loginEmail">Email</label>
                        </div>

                        <!-- PASSWORD INPUT -->
                        <span class="error"><?= $loginPasswordError ?></span>
                        <div class="form-outline mb-4">
                            <input type="password" id="loginPassword" class="form-control" name="loginPassword" value="<?= $loginPassword ?>">
                            <label class="form-label" for="loginPassword">Contraseña</label>
                        </div>

                        <!-- 2 COLUMN GRID LAYOUT -->
                        <div class="row mb-4">
                            <div class="col-md-6 d-flex justify-content-center">
                                <!-- CHECKBOX -->
                                <div class="form-check mb-3 mb-md-0">
                                    <input class="form-check-input" type="checkbox" value="<?= $loginCheck ?>" id="loginCheck" name="loginCheck">
                                    <label class="form-check-label" for="loginCheck"> Recuérdame </label>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex justify-content-center">
                                <!-- LINK RECORDATORIO CONTRASEÑA-->
                                <a href="recordarContraseña.html">¿Has olvidado tu contraseña?</a>
                            </div>
                        </div>

                        <!-- BOTÓN DE ENVÍO -->
                        <button type="submit" class="btn btn-primary btn-block mb-4">Iniciar sesión</button>

                        <!-- LINK AL REGISTRO -->
                        <div class="text-center">
                            <p>¿No tienes usuario?
                                <a id="tab-register-switch"
                                   data-mdb-toggle="pill"
                                   href="#pills-register"
                                   role="tab"
                                   aria-controls="pills-register"
                                   aria-selected="false">Regístrate</a>
                            </p>
                        </div>
                    </form>
                </div>
                <!-- FORMULARIO DE REGISTRO -->
                <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                    <form method="post"  action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>">
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
                            <input type="text" id="registerName" class="form-control" name="registerName">
                            <label class="form-label" for="registerName">Nombre</label>
                        </div>

                        <!-- USERNAME INPUT -->
                        <span class="error"><?= $registerUserNameError ?></span>
                        <div class="form-outline mb-4">
                            <input type="text" id="registerUsername" class="form-control" name="registerUserName">
                            <label class="form-label" for="registerUsername">Usuario</label>
                        </div>

                        <!-- EMAIL INPUT -->
                        <span class="error"><?= $registerEmailError ?></span>
                        <div class="form-outline mb-4">
                            <input type="email" id="registerEmail" class="form-control" name="registerEmail">
                            <label class="form-label" for="registerEmail">Email</label>
                        </div>

                        <!-- PASSWORD INPUT -->
                        <span class="error"><?= $registerPasswordError ?></span>
                        <div class="form-outline mb-4">
                            <input type="password" id="registerPassword" class="form-control" name="registerPassword">
                            <label class="form-label" for="registerPassword">Contraseña</label>
                        </div>

                        <!-- REPETIR PASSWORD INPUT -->
                        <span class="error"><?= $registerRepeatPasswordError ?></span>
                        <div class="form-outline mb-4">
                            <input type="password" id="registerRepeatPassword" class="form-control" name="registerRepeatPassword">
                            <label class="form-label" for="registerRepeatPassword">Repite la contraseña</label>
                        </div>

                        <!-- CHECKBOX -->
                        <span class="error"><?= $registerCheckError ?></span>
                        <div class="form-check d-flex justify-content-center mb-4">
                            <input class="form-check-input me-2"
                                type="checkbox"
                                value=""
                                id="registerCheck"
                                aria-describedby="registerCheckHelpText" name="registerCheck">
                            <label class="form-check-label" for="registerCheck">
                                He leído y acepto los términos
                            </label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-3">Registrarse</button>
                        <!-- LINK AL LOGIN -->
                        <div class="text-center">
                            <p>¿Ya tienes usuario?
                                <a id="tab-login-switch"
                                   data-mdb-toggle="pill"
                                   href="#pills-login"
                                   role="tab"
                                   aria-controls="pills-login"
                                   aria-selected="false">Inicia sesión</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <aside>

    </aside>
    <footer>

    </footer>
</main>
</body>
</html>
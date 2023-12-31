<?php
    /**
     * @file login-register.php<br><br>
     * Página de Autenticación de AsynCore
     *
     * Maneja tanto el inicio de sesión como el registro de usuarios.
     * Incluye formularios para ambas funciones y procesa las solicitudes de login y registro.<br><br>
     *
     * Dependencias:<pre>
     *      - sessionInit.php: Inicialización de la sesión y definición de constantes globales.
     *      - autoloader.php: Carga automática de clases.
     *      - processForm.php: Procesamiento de formularios de inicio de sesión y registro.</pre>
     */
    include_once '../src/utils/sessionInit.php';
    require DIR . '/src/utils/autoloader.php';
    include DIR . '/src/processForm.php';
    
    /**
     * Otras variables
     * @var string  $activeTab                   Pestaña activa
     * @var string  $message                     Mensaje de error o de éxito
     * @var string  $autofocus                   Autofocus en el email
     */
    
    /**
     * Pestaña activa por defecto.
     * Se utiliza para mostrar el formulario de inicio de sesión por defecto en el primer acceso a la página.
     */
    $activeTab = ACTIVE_TAB_DEFAULT;
    
    /**
     * Almacena mensajes de retroalimentación para el usuario.
     * Se utiliza para mostrar mensajes de éxito o error después de intentos de inicio de sesión o registro.
     */
    $message = EMPTY_STRING;
    
    /**
     * Controla el enfoque automático en el formulario de inicio de sesión.
     * Se utiliza para mejorar la experiencia del usuario al navegar entre diferentes formularios.
     */
    $autofocus = EMPTY_STRING;
    
    /**
     * Verifica los parámetros GET para determinar si se debe mostrar un mensaje de error o éxito.
     * Los mensajes se basan en las acciones de inicio de sesión o registro y se muestran en función del resultado.
     */
    if (isset($_GET['error'])) {
        if (isset($_GET['login'])) {
            $message = printLoginFail();
        } elseif (isset($_GET['register'])) {
            $message = isset($_SESSION['registerUserName']) ? printRegisterFail($_SESSION['registerUserName']) : '';
        }
    }
    
    if(isset($_GET['success'])) {
        if (isset($_GET['register'])) {
            $message = printRegisterSuccess($_SESSION['registerUserName']);
        }else if (isset($_GET['login']) && isset($_SESSION['NAME'])) {
            $_SESSION['EXPLODE_NAME'] = strpos($_SESSION['NAME'], " ") ? $_SESSION['NAME'] : explode(' ', $_SESSION['NAME'])[0];
            $message = printLoginSuccess($_SESSION['EXPLODE_NAME']);
            unsetLoginRegister();
            header('Refresh: 5; url=https://'. URL_BASE .'/main.php');
        }
    }
    
    /**
     * Maneja el cambio entre los formularios de inicio de sesión y registro.
     * Establece la pestaña activa y el enfoque automático en función de los parámetros GET.
     */
    if(isset($_GET['registerTab'])) {
        $activeTab = ACTIVE_TAB_REGISTER;
        $autofocus = EMPTY_STRING;
    } else if(isset($_GET['loginTab'])) {
        $activeTab = ACTIVE_TAB_DEFAULT;
        $autofocus = 'autofocus';
    }
    
    $descripcion = 'Página de Login/Registro de AsynCore';
    $titulo = 'LOGIN / REGISTRO';
    $css = ["/css/bootstrap/bootstrap.min.css", "/css/mdb/mdb.min.css", "/css/login-registro-style.css"];
    $js = ['/js/main-main.js', '/js/bootstrap/bootstrap.bundle.js', '/js/mdb/mdb.min.js', 'https://friconix.com/cdn/friconix.js', '/js/login-register-main.js'];
    include_once DIR. '/src/head.php';
    include_once DIR . '/src/header.php';
?>
    <main>
        <section>
            <div>
                <?= $message ?>
            </div>
            <div class="container">
                <section class="w-100 h-100 p4 d-flex justify-content-center pb-2">
                    <div style="width: 20rem;">
                        <!-- SELECTOR FORMULARIO -->
                        <!-- LOGIN -->
                        <ul class="nav nav-pills nav-justified mb-3" role="tablist">
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
                            <div class="tab-pane fade <?= $activeTab == 'login' ? 'show active' : '' ?>"
                                 id="pills-login"
                                 role="tabpanel" aria-labelledby="tab-login">
                                <!-- FORMULARIO DE LOGIN -->
                                <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <input type="hidden" name="form" value="login">
                                    <div class="text-center mb-3">
                                        <p>Inicia sesión con:</p>
                                        <button type="button" class="btn btn-secondary btn-floating mx-1">
                                            <i class="fi-onsux3-facebook" style="color: #0866FF"></i>
                                        </button>

                                        <button type="button" class="btn btn-secondary btn-floating mx-1">
                                            <i class="fi-onsux3-google-logo" style='color: #4285F4'></i>
                                        </button>

                                        <button type="button" class="btn btn-secondary btn-floating mx-1">
                                            <i class="fi-onsux3-twitter-solid" style="color: #1D9BF0"></i>
                                        </button>

                                        <button type="button" class="btn btn-secondary btn-floating mx-1">
                                            <i class="fi-onsux3-github-alt" style="color: #181717"></i>
                                        </button>
                                    </div>
                                    <?= $_SERVER['HTTP_HOST'] ?>
                                    <p class="text-center">o:</p>

                                    <!-- EMAIL INPUT -->
                                    <span class="error"><?= $_SESSION['loginEmailError'] ?></span>
                                    <div class="form-outline mb-4">
                                        <input type="text" id="loginEmail" class="form-control" name="loginEmail"
                                               value="<?= $_SESSION['loginEmail'] ?>" <?= $autofocus ? 'autofocus' : EMPTY_STRING ?>>
                                        <label class="form-label" for="loginEmail">Email</label>
                                    </div>

                                    <!-- PASSWORD INPUT -->
                                    <span class="error"><?= $_SESSION['loginPasswordError'] ?></span>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="loginPassword" class="form-control"
                                               name="loginPassword"
                                               value="<?= $_SESSION['loginPassword'] ?>">
                                        <label class="form-label" for="loginPassword">Contraseña</label>
                                        <button type='button' class='toggle-password'
                                                onclick="togglePasswordVisibility('loginPassword', 'loginToggle')">
                                            <i class='fi-xnsuxx-eye' id='loginToggle' style='color: #386bc0'></i>
                                        </button>
                                    </div>

                                    <!-- COLUMNA ÚNICA -->
                                    <div class="row mb-4">
                                        <div class="col-12 d-flex justify-content-center">
                                            <!-- CHECKBOX -->
                                            <div class="form-check mb-3 mb-md-0">
                                                <input class="form-check-input" type="checkbox" id="loginCheck"
                                                       name="loginCheck" <?= $_SESSION['loginCheck'] == "1" ? "checked" : "" ?>>
                                                <label class="form-check-label" for="loginCheck"> Recuérdame </label>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-center">
                                            <!-- LINK RECORDATORIO CONTRASEÑA-->
                                            <a href="/rememberPassword.html">¿Olvidaste tu contraseña?</a>
                                        </div>
                                    </div>

                                    <!-- BOTÓN DE ENVÍO -->
                                    <button type="submit" class="btn btn-primary btn-block mb-4">Iniciar sesión</button>

                                    <!-- LINK AL REGISTRO -->
                                    <div class="text-center">
                                        <p>¿No tienes usuario?
                                            <a href="/login-register.php?registerTab">Regístrate
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
                                        <button type='button' class='btn btn-secondary btn-floating mx-1'>
                                            <i class='fi-onsux3-facebook' style='color: #0866FF'></i>
                                        </button>

                                        <button type='button' class='btn btn-secondary btn-floating mx-1'>
                                            <i class='fi-onsux3-google-logo' style='color: #4285F4'></i>
                                        </button>

                                        <button type='button' class='btn btn-secondary btn-floating mx-1'>
                                            <i class='fi-onsux3-twitter-solid' style='color: #1D9BF0'></i>
                                        </button>

                                        <button type='button' class='btn btn-secondary btn-floating mx-1'>
                                            <i class='fi-onsux3-github-alt' style='color: #181717'></i>
                                        </button>
                                    </div>

                                    <p class="text-center">o:</p>

                                    <!-- NAME INPUT -->
                                    <span class="error"><?= $_SESSION['registerNameError'] ?></span>
                                    <div class="form-outline mb-4">
                                        <input type="text" id="registerName" class="form-control" name="registerName"
                                               value="<?= $_SESSION['registerName'] ?>">
                                        <label class="form-label" for="registerName">Nombre</label>
                                    </div>

                                    <!-- USERNAME INPUT -->
                                    <span class="error"><?= $_SESSION['registerUserNameError'] ?></span>
                                    <div class="form-outline mb-4">
                                        <input type="text" id="registerUsername" class="form-control"
                                               name="registerUserName"
                                               value="<?= $_SESSION['registerUserName'] ?>">
                                        <label class="form-label" for="registerUsername">Usuario</label>
                                    </div>

                                    <!-- EMAIL INPUT -->
                                    <span class="error"><?= $_SESSION['registerEmailError'] ?></span>
                                    <div class="form-outline mb-4">
                                        <input type="text" id="registerEmail" class="form-control" name="registerEmail"
                                               value="<?= $_SESSION['registerEmail'] ?>">
                                        <label class="form-label" for="registerEmail">Email</label>
                                    </div>

                                    <!-- PASSWORD INPUT -->
                                    <span class="error"><?= $_SESSION['registerPasswordError'] ?></span>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="registerPassword" class="form-control"
                                               name="registerPassword"
                                               value="<?= $_SESSION['registerPassword'] ?>">
                                        <label class="form-label" for="registerPassword">Contraseña</label>
                                        <button type='button' class='toggle-password'
                                                onclick="togglePasswordVisibility('registerPassword', 'registerToggle')">
                                            <i class='fi-xnsuxx-eye' id='registerToggle' style="color: #386bc0"></i>
                                        </button>
                                    </div>

                                    <!-- REPETIR PASSWORD INPUT -->
                                    <span class="error"><?= $_SESSION['registerRepeatPasswordError'] ?></span>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="registerRepeatPassword" class="form-control"
                                               name="registerRepeatPassword" value="<?= $_SESSION['registerRepeatPassword'] ?>">
                                        <label class="form-label" for="registerRepeatPassword">Repite la
                                            contraseña</label>
                                        <button type='button' class='toggle-password'
                                                onclick="togglePasswordVisibility('registerRepeatPassword', 'registerToggle2')">
                                            <i class='fi-xnsuxx-eye' id='registerToggle2' style='color: #386bc0'></i>
                                        </button>
                                    </div>

                                    <!-- CHECKBOX -->
                                    <span class="error"><?= $_SESSION['registerCheckError'] ?></span>
                                    <div class="form-check d-flex justify-content-center mb-4">
                                        <input class="form-check-input me-2" type="checkbox"
                                               id="registerCheck" aria-describedby="registerCheckHelpText"
                                               name="registerCheck"
                                            <?= $_SESSION['registerCheck'] == "1" ? "checked" : "" ?>>
                                        <label class="form-check-label" for="registerCheck">
                                            He leído y acepto los términos.
                                        </label>
                                    </div>

                                    <!-- BOTÓN DE ENVÍO -->
                                    <button type="submit" class="btn btn-primary btn-block mb-4">Registrarse</button>
                                    <!-- LINK AL LOGIN -->
                                    <div class="text-center">
                                        <p>¿Ya tienes usuario?
                                            <a href="/login-register.php?loginTab">Inicia sesión</a>
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
    include_once DIR . '/src/footer.php';
?>
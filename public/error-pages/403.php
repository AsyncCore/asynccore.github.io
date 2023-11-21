<?php
    $descripcion = 'PÁGINA DE ERROR 403 - ACCESO DENEGADO';
    $titulo = 'ERROR 403';
    $css = ['/css/error-footer.css', '/css/prism.css', '/css/error-pages.css'];
    $js = ['/js/prism.js', '/js/error-pages.js'];
    $cdn = ['https://friconix.com/cdn/friconix.js'];
    $url = $_SERVER['HTTP_HOST'];
    include_once dirname(__DIR__, 2) . '/src/head.php';
?>
    <main>
        <div class="titulo"><p><span class="http">HTTP: </span><span class="num-error">403</span></p>
        </div>
        <div class="codigo" style="text-align:center;">
            <pre style="display:inline-block; text-align:left; white-space: pre;">
                <code class="language-php">/* 403.php */</code>
                <code class="language-php token important">&lt;?php</code>
                    <code class="language-php">$usuario = "Tú";</code>
                    <code class="language-php">$acceso_permitido = false;</code>

                    <code class="language-php">if ($usuario !== "admin") {</code>
                        <code class="language-php">echo "ERROR 403 - ACCESO DENEGADO";</code>
                    <code class="language-php">} else {</code>
                        <code class="language-php">echo "¡Bienvenido, admin!.";</code>
                    <code class="language-php">}</code>

                    <code class="language-php">if (!$acceso_permitido) {</code>
                        <code class="language-php">echo "¡UYUYUY! ¡Alguien se ha dejado el sudo en casa!";</code>
                    <code class="language-php">}</code>
                <code class="language-php">?&gt;</code>
            </pre>
        </div>
        <a href="https://<?=$url?>/main.php" class="center-link">Intentar con superpoderes</a>
    </main>
<?php
    include_once '../../src/error-footer.php';
?>
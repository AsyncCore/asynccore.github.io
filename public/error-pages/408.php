<?php
    include_once '../../src/utils/sessionInit.php';
    $descripcion = 'PÁGINA DE ERROR 403 - TIMEOUT';
    $titulo = 'ERROR 408';
    $css = ['../css/error-footer-style.css', '../css/prism.css', '../css/error-pages.css'];
    $js = ['../js/prism.js', '../js/error-pages.js', 'https://friconix.com/cdn/friconix.js'];
    include_once dirname(__DIR__, 2) . '/src/head.php';
?>
    <main>
        <div class="titulo"><p><span class="http">HTTP: </span><span class="num-error">408</span></p>
        </div>
        <div class="codigo" style="text-align:center;">
            <pre style="display:inline-block; text-align:left; white-space: pre;">
                <code class="language-php">/* 408.php */</code>
                <code class="language-php token important">&lt;?php</code>
                    <code class="language-php">$cliente ?? sleep(10000);</code>
                    <code class="language-php">$servidor = true;</code>
                    <code class="language-php">$requests = [<?=$_SERVER['HTTP_REFERER']?>]</code>
                    <code class="language-php">$</code>

                    <code class="language-php">foreach ($requests as $request) {</code>
                        <code class="language-php">if ($cliente) {</code>
                            <code class="language-php">$servidor.dameEsto($request);</code>
                        <code class="language-php">} else {</code>
                            <code class="language-php">echo "ZzZzzZzZZZzZ"; </code>
                        <code class="language-php">}</code>
                
                    <code class="language-php">if (!$acceso_permitido) {</code>
                        <code class="language-php">echo "¡UYUYUY! ¡Alguien se ha dejado el sudo en casa!";</code>
                    <code class="language-php">}</code>
                <code class="language-php">?&gt;</code>
            </pre>
        </div>
        <a href="<?= URL_BASE . 'main.php'?>" class="center-link">Intentar con superpoderes</a>
    </main>
<?php
    include_once '../../src/footer.php';
?>
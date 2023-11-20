<?php
    $descripcion = 'PÁGINA DE ERROR 404 - NO ENCONTRADO';
    $titulo = 'ERROR 404';
    $css = ['../css/error-footer-style.css', '../css/prism.css', '../css/error-pages.css'];
    $js = ['../js/prism.js', '../js/error-pages.js', 'https://friconix.com/cdn/friconix.js'];
    $url = $_SERVER['HTTP_HOST'];
    include_once dirname(__DIR__, 2) . '/src/head.php';
?>
<main>
    <div class="titulo"><p><span class="http">HTTP: </span><span class="num-error">404</span></p></div>
    <div class="codigo" style="text-align:center;">
        <pre style="display:inline-block; text-align:left; white-space: pre;">
                <code class="language-php">/* 404.php */</code>
                <code class="language-php token important">&lt;?php</code>
                    <code class="language-php">$url = "<?= $_SERVER['REQUEST_URI'] ?>";</code>
                    <code class="language-php">$no_sabes_escribir = $encontrada = false;</code>
                    <code class="language-php">$la_hemos_cagado = true;</code>

                    <code class="language-php">if ($url == !$encontrada) {</code>
                        <code class="language-php">echo "ERROR 404 - PÁGINA NO ENCONTRADA";</code>
                    <code class="language-php">}else{</code>
                        <code class="language-php">if ($no_sabes_escribir) {</code>
                            <code class="language-php">echo "Aver hestudiao.";</code>
                        <code class="language-php">} else if ($la_hemos_cagado) {</code>
                            <code class="language-php">echo "Lo sentimos...";</code>
                        <code class="language-php">}</code>
                    <code class="language-php">}</code>

                    <code class="language-php">header("Location: https://www.asyncore.es/main.php", true, 302);</code>
                    <code class="language-php">exit;</code>
                <code class="language-php">?&gt;</code></pre>
    </div>
    <a href="https://<?=$url?>/main.php">HOME</a>
</main>
<?php
    include_once dirname(__DIR__, 2) . '/src/footer.php';
?>
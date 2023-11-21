<?php
    $descripcion = 'PÁGINA DE ERROR 500 - ERROR INTERNO DEL SERVIDOR';
    $titulo = 'ERROR 500';
    $css = ['/css/error-footer.css', '/css/prism.css', '/css/error-pages.css'];
    $js = ['/js/prism.js', '/js/error-pages.js'];
    $cdn = ['https://friconix.com/cdn/friconix.js'];
    $url = $_SERVER['HTTP_HOST'];
    include_once dirname(__DIR__, 2) . '/src/head.php';
?>
<main>
    <div><p><span class="http">HTTP: </span><span class="num-error">500</span></p>
    </div>
    <div style="text-align:center;">
        <pre style="display:inline-block; text-align:left; white-space: pre;">
        <code class="language-php">/* 500.php */</code>
        <code class="language-php token important">&lt;?php</code>
            <code class="language-php">$servidor = "un poco cansado";</code>

            <code class="language-php">echo "ERROR 500 - ERROR INTERNO DEL SERVIDOR";</code>

            <code class="language-php">if ($servidor === "un poco cansado") {</code>
                <code class="language-php">echo "Nuestro servidor está con el Kit-Kat.";</code>
                <code class="language-php">echo "¡Vuelve en un rato!";</code>
            <code class="language-php">} else {</code>
                <code class="language-php">echo "Todo está funcionando perfectamente...";</code>
                <code class="language-php">echo "Es broma... Algo va realmente mal...";</code>
            <code class="language-php">}</code>
        <code class="language-php">?&gt;</code>
        </pre>
    </div>
    <a href="https://<?=$url?>/main.php" class="center-link">Volver a la página donde no hay llamas...</a>
</main>
<?php
    include_once '../../src/error-footer.php';
?>
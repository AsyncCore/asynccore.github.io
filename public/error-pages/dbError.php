<?php
    $descripcion = 'PÁGINA DE ERROR DE BASE DE DATOS';
    $titulo = 'ERROR DE BASE DE DATOS';
    $css = ['../css/footer-style.css', 'prism.css', '../css/error-pages.css'];
    $js = ['prism.js', '../js/error-pages.js', 'https://friconix.com/cdn/friconix.js'];
    $url = $_SERVER['HTTP_HOST'];
    include_once dirname(__DIR__, 2) . '/src/head.php';
?>
<main>
    <div class="titulo"><p><span class="db">DB ERROR: </span><span class="num-error">500</span></p></div>
    <div class="codigo" style="text-align:center;">
        <pre style="display:inline-block; text-align:left; white-space: pre;">
            <code class="language-php">/* dbError.php */</code>
            <code class="language-php">&lt;?php</code>
                <code class="language-php">try {</code>
                    <code class="language-php">$conexion = new PDO('mysql:host=asyncore.es;dbname=asyncore;charset=utf8', asyncore, 1234);</code>
                    <code class="language-php">echo "¡Óle! Parece que la factura de internet está pagada...";</code>
                <code class="language-php">} catch (PDOException $e) {</code>
                    <code class="language-php">echo "Vaya... parece que se deben 3 meses :(";</code>
                    <code class="language-php">echo "Estamos pidiendo un préstamo...";</code>
                    <code class="language-php">header("Location: cofidis.php");</code>
                <code class="language-php">}</code>
            <code class="language-php">?&gt;</code>
        </pre>
    </div>
    <a href="https://<?=$url?>/main.php">VOLVER A INICIO</a>
</main>
<?php
    include_once dirname(__DIR__, 2) . '/src/footer.php';
?>

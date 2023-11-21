<?php
    $descripcion = 'PÁGINA DE ERROR DE BASE DE DATOS';
    $titulo = 'ERROR DE BASE DE DATOS';
    $css = ['../css/error-footer.css', '../css/prism.css', '../css/error-pages.css'];
    $js = ['../js/prism.js', '../js/error-pages.js', 'https://friconix.com/cdn/friconix.js'];
    $url = $_SERVER['HTTP_HOST'];
    include_once dirname(__DIR__, 2) . '/src/head.php';
?>
<main>
    <div class="titulo"><p><span class="db">DB ERROR: </span><span class="num-error">500</span></p></div>
    <div class="codigo" style="text-align:center;">
        <pre style="display:inline-block; text-align:left; white-space: pre;">
            <code class="language-php">/* dbError.php */</code>
            <code class="language-php token important">&lt;?php</code>
                <code class="language-php">try {</code>
                    <code class="language-php">$conexion = new PDO('mysql:host=asyncore.es;dbname=asyncore;charset=utf8',
                                        asyncore,
                                        1234);</code>
                    <code class="language-php">echo "Intentando conectar con la base de datos...";</code>
                <code class="language-php">} catch (PDOException $e) {</code>
                    <code class="language-php">echo "Здравствуйте, это атака Кибервымогательство...";</code>
                    <code class="language-php">echo "В следующий раз не используйте дерьмовый пароль.";</code>
                    <code class="language-php">header("Location: hacked.php");</code>
                <code class="language-php">}</code>
            <code class="language-php">?&gt;</code>
        </pre>
    </div>
    <a href="https://<?=$url?>/main.php">VUELVE A INICIO MIENTRAS PAGAMOS EL RESCATE</a>
</main>
<?php
    include_once dirname(__DIR__, 2) . '/src/footer.php';
?>

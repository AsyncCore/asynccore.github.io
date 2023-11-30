<?php
    /**
     * @var string $descripcion /src/logged-header.php
     * @var string $titulo      /src/logged-header.php
     * @var string $css         /src/logged-header.php
     * @var string $js          /src/logged-header.php
     */
    
    require '../src/init.php';
    
    $descripcion = 'Página sobre nosotros de AsynCore';
    $titulo = 'AsynCore';
    $css = ['css/style.css', 'css/about-us.css'];
    $js = [['js/script.js'], ['js/about-us.js']];
    $cdn = ['https://friconix.com/cdn/friconix.js'];
    include_once DIR . '/src/head.php';
    if (isset($_COOKIE[COOKIE_NAME]) || isset($_SESSION['USER_ID'])) {
        include_once DIR . '/src/logged-header.php';
    } else {
        include_once DIR . '/src/login-header.php';
    }
?>
    <main>
        <div id='scene'>
            <div id='left-zone'>
                <ul class='list'>
                    <li class='item'>
                        <input type='radio'
                               id='Asyncore'
                               name='basic_carousel'
                               value='AsynCore'
                               checked='checked'/>
                        <label class='label_straw'
                               for='Asyncore'>AsynCore</label>
                        <div class='content content_straw'><span class='picto'></span>
                            <a href=""><h1>AsynCore</h1></a>
                            <p>Nosotros somos AsynCore</p><br>
                            <p>A cada uno se nos da bien algo...</p>
                        </div>
                    </li>
                    <li class='item'>
                        <input type='radio'
                               id='radio_The garden strawberry (or simply strawberry /ˈstrɔːbᵊri/; Fragaria × ananassa) is a widely grown hybrid species of the genus Fragaria (collectively known as the strawberries)'
                               name='basic_carousel'
                               value='The garden strawberry (or simply strawberry /ˈstrɔːbᵊri/; Fragaria × ananassa) is a widely grown hybrid species of the genus Fragaria (collectively known as the strawberries)'
                        />
                        <label class='label_strawberry'
                               for='radio_The garden strawberry (or simply strawberry /ˈstrɔːbᵊri/; Fragaria × ananassa) is a widely grown hybrid species of the genus Fragaria (collectively known as the strawberries)'>Daniel
                            Alonso</label>
                        <div class='content content_strawberry'><span class='picto'></span>
                            <a href="https://github.com/GyllenhaalSP"><h1>GyllenhaalSP</h1></a><br>
                            <ul style='text-align: center'>
                                <li>Su pasión es el <em>BACK</em>end.</li>
                                <li>PHP se ejecuta de derecha a izquierda.</li>
                                <li>Su amor secreto es C#.</li>
                                <li>Te monta un server antes de que digas HTTPS.</li>
                            </ul>
                        </div>
                    </li>
                    <li class='item'>
                        <input type='radio'
                               id='radio_The apple tree (Malus domestica) is a deciduous tree in the rose family best known for its sweet, pomaceous fruit, the apple. It is cultivated worldwide as a fruit tree, and is the most widely grown species in the genus Malus.'
                               name='basic_carousel'
                               value='The apple tree (Malus domestica) is a deciduous tree in the rose family best known for its sweet, pomaceous fruit, the apple. It is cultivated worldwide as a fruit tree, and is the most widely grown species in the genus Malus.'/>
                        <label class='label_apple'
                               for='radio_The apple tree (Malus domestica) is a deciduous tree in the rose family best known for its sweet, pomaceous fruit, the apple. It is cultivated worldwide as a fruit tree, and is the most widely grown species in the genus Malus.'>Maksym
                            Dovgan</label>
                        <div class='content content_apple'><span class='picto'></span>
                            <a href='https://github.com/xrezu'><h1>Xrezu</h1></a><br>
                            <ul style='text-align: center'>
                                <li>Más conocido como Mr. Trigger.</li>
                                <li>SQLServer es lo suyo.</li>
                                <li>Cree que MaríaDB es el nombre artístico de una cariñosa.</li>
                                <li>Odia los baños y los espacios oscuros.</li>
                            </ul>

                        </div>
                    </li>
                    <li class='item'>
                        <input type='radio'
                               id='radio_A banana is an edible fruit, botanically a berry, produced by several kinds of large herbaceous flowering plants in the genus Musa.'
                               name='basic_carousel'
                               value='A banana is an edible fruit, botanically a berry, produced by several kinds of large herbaceous flowering plants in the genus Musa.'/>
                        <label class='label_banana'
                               for='radio_A banana is an edible fruit, botanically a berry, produced by several kinds of large herbaceous flowering plants in the genus Musa.'>Miguel
                            Martínez</label>
                        <div class='content content_banana'><span class='picto'></span>
                            <a href="https://github.com/trikytrukos"><h1>Trikytrukos</h1></a><br>
                            <ul style='text-align: center'>
                                <li>Le gustan las IAs.</li>
                                <li>El prompter del equipo.</li>
                                <li>Sus GPTs molan.</li>
                                <li>También le gustan las pulas.</li>
                            </ul>
                        </div>
                    </li>
                    <li class='item'>
                        <input type='radio'
                               id='radio_The orange (specifically, the sweet orange) is the fruit of the citrus species Citrus × sinensis in the family Rutaceae.'
                               name='basic_carousel'
                               value='The orange (specifically, the sweet orange) is the fruit of the citrus species Citrus × sinensis in the family Rutaceae.'/>
                        <label class='label_orange'
                               for='radio_The orange (specifically, the sweet orange) is the fruit of the citrus species Citrus × sinensis in the family Rutaceae.'>Víctor
                            Hellín</label>
                        <div class='content content_orange'><span class='picto'></span>
                            <a href="https://github.com/Redcario4444"><h1>Redcario4444</h1></a><br>
                            <ul style='text-align: center'>
                                <li>¿Bootstrap? ¿Eso qué es?</li>
                                <li>Ha descubierto su pasión por el JavaScript.</li>
                                <li>Su etiqueta favorita es &lt;marquee&gt;</li>
                                <li>Antes muerta que sin DOMContentLoaded.</li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div id='middle-border'></div>
            <div id='right-zone'></div>
        </div>
    </main>
<?php
    include_once DIR . '/src/footer.php';
?>
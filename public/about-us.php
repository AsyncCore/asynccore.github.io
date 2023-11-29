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
                            <h1>AsynCore</h1>
                            <p>Nosotros somos AsynCore</p>
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
                            <h1>Daniel Alonso</h1>
                            <p>Este es Daniel Alonso</p>
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
                            <h1>Miguel Martínez</h1>
                            <p>Este es Miguel Martínez</p>
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
                            <h1>Maksym Dovgan</h1>
                            <p>Este es Maksym Dovgan</p>
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
                            <h1>Víctor Hellín</h1>
                            <p>Este es Víctor Hellín</p>
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
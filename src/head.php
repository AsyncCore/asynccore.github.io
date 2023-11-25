<?php
    /**
     * @var string $descripcion
     * @var string $titulo
     * @var array  $css
     * @var array  $js
     * @var array $cdn
     */
    
    $currentPath = $_SERVER['PHP_SELF'];
    $currentDir = substr($currentPath, strrpos($currentPath, '/'), strlen($currentPath));
    $currentRoot = $_SERVER['HTTP_HOST'];
?>
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <!-- Metas de la página HTML-->
        <meta content='text/html;charset=UTF-8' http-equiv='Content-Type'>
        <meta content='<?=$descripcion?>' name='description'>
        <meta content='Daniel Alonso Lázaro' name='author'>
        <meta content='Maksym Dovgan' name='author'>
        <meta content='Miguel Martínez Santos' name='author'>
        <meta content='Víctor Hellín Sáez' name='author'>
        <meta content='width=device-width, initial-scale=1.0' name='viewport'>
        <meta content='copyright' name='&copy; AsynCore Project 2023'>
        <!-- Metas de Open Graph -->
        <meta content='<?=$titulo?>' property='og:title'>
        <meta content='website' property='og:type'>
        <meta content='/img/logo/logo.ico' property='og:image'>
        <meta content='<?=$currentDir?>' property='og:url'>
        <meta content='<?=$descripcion?>' property='og:description'>
        <meta content='es_ES' property='og:locale'>
        <meta content='en_EN' property='og:locale:alternate'>
        <meta content='<?=$currentRoot?>' property='og:site_name'>
        <!-- Metas de Apple -->
        <meta content='AsynCore' name='apple-mobile-web-app-title'>
        <meta content='AsynCore' name='application-name'>
        <!-- Metas de Microsoft -->
        <meta content='#2d89ef' name='msapplication-TileColor'>
        <meta content='/img/logo/favicon/browserconfig.xml' name='msapplication-config'>
        <!-- Metas de Chrome -->
        <meta content='#ffffff' name='theme-color'>
        <!-- Favicon -->
        <link href='/img/favicon/apple-touch-icon.png' rel='apple-touch-icon' sizes='180x180'>
        <link href='/img/favicon/favicon-32x32.png' rel='icon' sizes='32x32' type='image/png'>
        <link href='/img/favicon/favicon-16x16.png' rel='icon' sizes='16x16' type='image/png'>
        <link href='/img/favicon/site.webmanifest' rel='manifest'>
        <link color='#5bbad5' href='img/favicon/safari-pinned-tab.svg' rel='mask-icon'>
        <link href='/img/favicon/favicon.ico' rel='shortcut icon'>
        <!-- CSS -->
        <?php foreach ($css as $cssFile): ?>
            <link href="<?=$cssFile?>" rel='stylesheet' type='text/css'>
        <?php endforeach; ?>
        <!-- JavaScript -->
        <?php foreach ($js as $jsFile): ?>
            <script defer src="<?=$jsFile[0]?>" referrerpolicy="<?=$jsFile[1] ?? ""?>" type='text/javascript'></script>
        <?php endforeach; ?>
        <!-- CDN -->
        <?php if (isset($cdn) && is_array($cdn)): ?>
            <?php foreach ($cdn as $cdn_item): ?>
                <script defer src="<?=$cdn_item?>" type='text/javascript'></script>
            <?php endforeach; ?>
        <?php endif; ?>
        <!-- Título de la página -->
        <title><?=$titulo?></title>
    </head>
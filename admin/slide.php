<?php
    require_once '../access/access_requires.php';
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex, nofollow">
        <meta name="robots" content="noarchive">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo SITE_TITLE.' '.$_SESSION['usuarioNome']; ?></title>
        <link rel="shortcut icon" href="img/favicon.png" />
        <link type="text/css" rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/resets.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/sidebar.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout_slide.css" />
        <script type="text/javascript" src="assets/js-plugins/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="assets/js-plugins/jquery-ui.min.js"></script>
        <script type="text/javascript" src="assets/js-plugins/jquery.mobile.custom.min.js"></script>
        <script type="text/javascript" src="assets/js/sidebar.js"></script>
        <script src="assets/js/layout.js" type="text/javascript"></script>
        <script src="assets/js/slide.js" type="text/javascript"></script>
    </head>
    <body>
        <?php include('assets/sidebar.php'); ?>
        <?php include('assets/messages.php'); ?>        

        <div class="content_section_title" style="background: url('assets/img/slideshow.jpg') scroll center center no-repeat;background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;">
            <div class="content_section_title_inner">
                <h1><i class="fa fa-desktop fa-fw"></i> Slide-show</h1>
            </div>
            
            <?php 
                if(ClassSlide::getQuantidadeSlides() < 4){
                    echo '<i class="fa fa-plus fa-fw" id="adicionar" title="Adicionar novo Slide"></i>';
                }
            ?>

            <div class="content_section_title_color"></div>
        </div>

        <section class="content">
            <div class="box1">

            </div>
            
            <div class="box">
                <div class="box_inner">
                    <form method="post" action="process/Process_Slide.php" class="post" enctype="multipart/form-data">
                        <ul>
                            <li>
                                <input type="text" class="input" name="titulo" placeholder="Título" maxlength="255" required="true">
                                <div class="box_inner_line"></div>
                            </li>
                            <li>
                                <input type="text" class="input" name="subtitulo" placeholder="Subtítulo" maxlength="200">
                                <div class="box_inner_line"></div>
                            </li>
                            <li class="files">
                                <input type="file" name="capa" style="display:none;" class="capa">
                                <button id="archive"><i class="fa fa-file-image-o fa-fw"></i> Imagem</button>
                                <p>Imagem recomendada de: <?php echo CAPA_LARGURA; ?>px de largura por <?php echo CAPA_ALTURA; ?>px de altura</p>
                            </li>
                            <li>
                                <input type="text" class="input" name="link" placeholder="http://www.link.com">
                                <div class="box_inner_line"></div>
                                <p>Adicione o link com 'http://'</p>
                            </li>
                            <li>
                                <button id="enviar" name="enviar">Novo Slide</button>
                            </li>
                        </ul>
                    </form>
                </div>
                <div class="box_color"></div>
            </div>
        </section>
    </body>
</html>
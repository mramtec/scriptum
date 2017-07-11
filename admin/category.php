<?php

    spl_autoload_register(function($class){
        require_once '../class/'.$class.'.php'; 
        require_once '../class/defines.php';
    });
    
    if(session_status() == 1 || session_status() == 0) session_start();
    ClassAccess::access_prot_pag();
    
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="robots" content="noindex, nofollow" />
        <meta name="robots" content="noarchive" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Marcadores & Categorias</title>
        <link type="image/x-icon" rel="shortcut icon" href="../img/favicon.png" />
        <link type="text/css" rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/resets.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/sidebar.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout_category.css" />
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery.mobile.custom.min.js"></script>
        <script type="text/javascript" src="assets/js/sidebar.js"></script>     
        <script src="assets/js/layout.js" type="text/javascript"></script>
        <script src="assets/js/category.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
        
            <?php include('assets/sidebar.php'); ?>
            <?php include('assets/messages.php'); ?>

            <div class="content_section_title" style="background: url(assets/img/categorias.jpg) scroll center center no-repeat;background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;">
                <h1><i class="fa fa-edit fa-fw"></i> <span id="title_section_post">Categorias</span></h1>
                <div class="content_section_title_color"></div>
            </div>    

            <div class="content">

                <div class="box1">
                    <h2>Essa seção disponibiliza a opção de criar classificações para as postagens. Os marcadores são sempre no nível "Pai", ao excluir um marcador isso não excluirá o post vinculado.</h2>
                    <div class="box1_left">
                        <h1 class="box1_title">Criar Categoria</h1>
                        <form method="post" id="post" action="process/Proc_Category.php" enctype="multipart/form-data">
                            <ul>
                                <li><input type="text" name="titulo" placeholder="Titulo" id="titulo"></li>
                                <li>
                                    <button id="open_file">Selecionar arquivo de capa</button>
                                    <input id="file" type="file" name="capa" style="display: none;" accept=".jpg">
                                </li>
                                <li>
                                    <textarea id="descricao" name="descricao" placeholder="Descrição"></textarea>
                                    <div class="box1_description">A descrição não é obrigatória.</div>
                                </li>
                                
                                <li><button name="criar" id="criar">Adicionar</button></li>
                            </ul>
                        </form>
                    </div>

                    <div class="box1_right">
                        <h1 class="box1_title">Categorias</h1>
                        <ul class="box1_right_list">
                            
                        </ul>
                        <div style="text-align: center;">
                            <button class="load">Mais</button>
                        </div>
                    </div>
                </div>
                
                
            </div>
            
        </div>
    </body>
</html>
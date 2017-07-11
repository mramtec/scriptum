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
        <meta charset="utf-8">
        <meta name="robots" content="noindex, nofollow">
        <meta name="robots" content="noarchive">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gerenciador - Publicadas</title>
        <link type="image/x-icon" rel="shortcut icon" href="../img/favicon.png" />
        <link type="text/css" rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/resets.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/sidebar.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout_read.css" />
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery.mobile.custom.min.js"></script>
        <script type="text/javascript" src="assets/js/sidebar.js"></script>
        <script type="text/javascript" src="assets/js/read.js"></script>
    <head>
    <body>
        <div class="container">
            
            <?php include('assets/sidebar.php'); ?>

            <div class="content_section_title" style="background: url(assets/img/publicados.jpg) scroll center center no-repeat;background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;">
                <h1><i class="fa fa-list-alt fa-fw"></i> Publicados</h1>
                <div class="content_section_title_color"></div>
            </div>

            <section class="content">
                <div class="content_inner">
                    <div class="box_top_search">
                        <div class="busca_box">
                            <form method="post">
                                <input type="text" class="busca" name="busca" placeholder="Pesquisar" autofocus="on" id="busca" autocomplete="off">
                            </form>
                        </div>

                        <div class="resultados">
                            <ul>
                            </ul>
                        </div>
                    </div>

                    <div class="posts">
                        <ul>
                        </ul>            
                    </div>

                    <div class="box_load" style="text-align: center;">
                        <h8 style="display: none;"><i class="fa fa-coffee"></i> Ora, Ora, Ora... <?php echo $_SESSION['usuarioNome']; ?>, parece que chegamos ao fim.</h8>
                        <button class="load">Carregar</button>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
<?php

    include_once '../access/access_requires.php';

    spl_autoload_register(function($class){
       require_once '../class/'.$class.'.php'; 
    });
    
    ClassAccess::access_check_privileg();
?>

<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex, nofollow">
        <meta name="robots" content="noarchive">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gerenciador - Membros</title>
        <link type="image/x-icon" rel="shortcut icon" href="../img/favicon.png" />
        <link type="text/css" rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/resets.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/sidebar.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout_users.css" />
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery.mobile.custom.min.js"></script>
        <script type="text/javascript" src="js/users.js"></script>
        <script type="text/javascript" src="assets/js/sidebar.js"></script>
        <script src="assets/js/users.js" type="text/javascript"></script>
    <head>
    <body>
        <div class="container">
            <?php include('assets/sidebar.php'); ?>
            <?php include('assets/messages.php'); ?>

            <div class="content_section_title" style="background: url(assets/img/usuarios.jpg) scroll center top no-repeat;background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;">
                <h1><i class="fa fa-edit fa-fw"></i> <span id="title_section_post">Membros & Convites</span></h1>
                <div class="content_section_title_color"></div>
            </div>            
            
            <div class="content">

                <div class="box_top_search">
                    <div class="busca_box clearfix">
                        <div class="busca_box_left">
                            <form method="post">
                                <input type="text" class="busca" name="busca" placeholder="Pesquisar" id="busca" autocomplete="off">
                            </form>
                        </div>
                        <div class="busca_box_right">
                            <a href="users_invitation" style="color: #989898;"><i class="fa fa-cog fa-fw" style="vertical-align: middle;"></i></a>
                            <i style="color: #989898;vertical-align: middle;" id="novo_usuario" class="fa fa-user-plus fa-fw"></i>
                        </div>
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
                    <h8 style="display: none;"><i class="fa fa-coffee"></i> Uau <?php echo $_SESSION['usuarioNome']; ?>! Parece que chegamos ao fim.</h8>
                    <button class="load">Carregar</button>
                </div>
            </div>

            <div class="box_convite">
                <div class="box_convite_form">
                    <form method="post" id="form_add_user" action="process/Process_Users_Ajax.php">
                        <ul>
                            <li><input type="text" name="email" placeholder="E-mail do convidado" id="convite_email" autocomplete="off"></li>
                            <li>
                                <select id="select" name="privilegio">
                                    <option value="administrador">Administrador</option>
                                    <option value="convidado">Convidado</option>
                                </select>
                            </li>
                            <li><button id="enviar_convite" name="enviar_convite">Enviar</button></li>
                        </ul>
                    </form>
                </div>
                <div class="box_convite_color"></div>
            </div>
        </div>
    </body>
</html>
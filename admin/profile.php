<?php

    include_once '../access/access_requires.php';

    spl_autoload_register(function($class){
       require_once '../class/'.$class.'.php'; 
    });

    if(session_status() == 1 || session_status() == 0) session_start();
    
    $user = NULL;
    
    $users = new ClassUsers();
    foreach( $users->UserExibirSelecionado( $_SESSION['usuarioID'], FALSE ) as $user );

?>

<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex, nofollow">
        <meta name="robots" content="noarchive">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gerenciador - Perfil <?php echo $_SESSION['usuarioNome']; ?></title>
        <link rel="shortcut icon" href="../img/favicon.png" />
        <link type="text/css" rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/resets.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/sidebar.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout_profile.css" />
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery.mobile.custom.min.js"></script>
        <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="assets/js/sidebar.js"></script>
        <script type="text/javascript" src="assets/js/layout.js"></script>
        <script type="text/javascript" src="assets/js/profile.js"></script>
    <head>
    <body>
        <?php
            include('assets/sidebar.php');
        ?>
        
        <div class="content_section_title" style="background: url(<?php if(strlen($_SESSION['usuarioCapa']) != 0){ echo '../'.$_SESSION['usuarioCapa']; }else{ echo 'assets/img/perfil.jpg'; } ?>) scroll center center no-repeat;background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;">
            <div class="content_section_title_inner">
                <h1>Perfil de <?php echo $_SESSION['usuarioNome']; ?></h1>
            </div>
            <div class="content_section_title_color"></div>
        </div>

        <section class="content">
            <div class="content_inner clearfix">
                <div class="box1">
                    <div class="box1_profile clearfix">
                        <form method="post" enctype="multipart/form-data" action="process/Process_User.php" id="form_profile">
                            <input type="hidden" name="perfil_path" value="<?php echo $user->usuario_perfil; ?>">
                            <input type="file" id="file_profile" name="perfil" style="display:none;">
                            
                            <div class="box1_profile_left">
                                <div>
                                    <h2>Perfil</h2>
                                    <p>Recomedado dimensões de: <?php echo PERFIL_LARGURA; ?>px de largura por <?php echo PERFIL_ALTURA; ?>px de altura no formato jpg.</p>
                                    <button id="action_upload_profile">Selecionar Imagem</button>
                                </div>
                            </div>
                            
                            <div class="box1_profile_right">
                            <?php
                                if(is_file('../'.$user->usuario_perfil))
                                    echo '<div class="box1_profile_right_image" style="background:url(../'.$user->usuario_perfil.') scroll center center no-repeat;background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;"></div>';
                                else
                                    echo '<div class="box1_profile_right_image" style="background:url(img/default_user.png) scroll center center no-repeat;background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;"></div>';
                            ?>
                            </div>
                        </form>
                    </div>
                    
                    <div class="box1_capa clearfix">
                        <form method="post" enctype="multipart/form-data" action="process/Process_User.php" id="form_capa">
                            <input type="hidden" name="capa_path" value="<?php echo $user->usuario_capa; ?>">
                            <input type="file" id="file_capa" name="capa" style="display: none;">
                            
                            <div class="box1_capa_left">
                                <div>
                                    <h2>Capa</h2>
                                    <p>Recomendado dimensões de: <?php echo CAPA_LARGURA; ?>px largura e <?php echo CAPA_ALTURA; ?>px de altura no formato jpg, experimente comprimir o arquivo utilizando ferramentas como <a href="http://kraken.io/" target="_blank">kraken.io</a> ou <a href="http://compressor.io/" target="_blank">compressor.io</a>.</p>
                                    <button id="action_upload_capa">Selecionar Imagem</button>
                                </div>
                            </div>
                            

                            <div class="box1_capa_right">
                                <?php
                                    if(is_file('../'.$user->usuario_capa))
                                        echo '<img src="../'.$user->usuario_capa.'" />';
                                    else
                                        echo '<img src="assets/img/default_capa.jpg" />';
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="box2">
                    <form method="post" action="process/Process_User.php" id="form_info">
                        <div class="box2_inner">
                            <div class="box2_inner_text">
                                <input type="text" name="nome" placeholder="Nome" class="input" value="<?php echo $user->usuario_nome; ?>">
                                <div class="box2_inner_line2"></div>
                                <div class="box2_inner_line"></div>
                            </div>

                            <div class="box2_inner_text">
                                <input type="text" name="apelido" placeholder="Apelido" class="input" value="<?php echo $user->usuario_apelido; ?>">
                                <div class="box2_inner_line2"></div>
                                <div class="box2_inner_line"></div>
                            </div>

                            <div class="box2_inner_text">
                                <i class="fa fa-lock fa-fw"></i> <input type="password" class="input senha" name="senha" autocomplete="off" placeholder="Senha" minlength="6">
                                <div class="box2_inner_line2"></div>
                                <div class="box2_inner_line"></div>
                            </div>

                            <div class="box2_inner_about">
                                <h2><i class="fa fa-align-left fa-fw"></i> Sobre Você</h2>
                                <textarea id="descricao" name="descricao" maxlength="255"><?php echo $user->usuario_descricao; ?></textarea>
                                <h3>Limite de 255 caracteres.</h3>
                            </div>

                            <div class="box2_inner_about textarea">
                                <h2><i class="fa fa-font fa-fw"></i> Bibliografia</h2>
                                <textarea id="textarea" name="biografia" maxlength="5000"><?php echo $user->usuario_sobre; ?></textarea>
                            </div>
                        </div>
                        
                        <div class="box_button clearfix">
                            <button class="button" id="alterar" name="alterar">Alterar</button>
                        </div>                        
                    </form>
                    
                </div>
            </div>
            <?php include('assets/messages.php'); ?>
        </section>

    </body>
</html>

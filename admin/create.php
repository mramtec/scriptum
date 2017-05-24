<?php

    include_once '../access/access_requires.php';

    spl_autoload_register(function($class){
       require_once '../class/'.$class.'.php'; 
    });

?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex, nofollow">
        <meta name="robots" content="noarchive">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Criar Postagem<?php echo SITE_TITLE ?></title>
        <link rel="shortcut icon" href="../img/favicon.png" />
        <link type="text/css" rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/resets.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/sidebar.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/layout_create.css" />
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="js/jquery.mobile.custom.min.js"></script>
        <script type="text/javascript" src="assets/js/sidebar.js"></script>
        <script type="text/javascript" src="assets/js/formulario.js"></script>
        <script src="assets/js/layout.js" type="text/javascript"></script>
        <script src="assets/js/create.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <?php include('assets/sidebar.php'); ?>
            <?php include('assets/messages.php'); ?>

            <div class="content_section_title" style="background: url(assets/img/escrevendo.jpg) scroll center bottom no-repeat;background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;">
                <h1><i class="fa fa-edit fa-fw"></i> <span id="title_section_post">Criar Conteúdo</span></h1>
                <div class="content_section_title_color"></div>
            </div>

            <div class="content">
                <div class="content_inner">

                    <form method="post" id="post" action="process/Process_Post_Create.php" class="post" enctype="multipart/form-data">

                        <input type="file" name="miniatura" id="file_miniatura" accept="image/jpeg" style="display: none;">
                        <input type="file" name="capa" id="file_capa" accept="image/jpeg" style="display: none;">

                        <div class="postleft">
                            <div class="postleft_box">
                                <input type="text" class="input titulo" name="titulo" placeholder="Titulo" autocomplete="off" maxlength="255">
                                <div class="box_inner_line2"></div>
                                <div class="box_inner_line"></div>
                            </div>
                            <div class="postleft_box">
                                <input type="text" class="input subtitulo" name="subtitulo" placeholder="Subtitulo" maxlength="255" autocomplete="off">
                                <div class="box_inner_line2"></div>
                                <div class="box_inner_line"></div>
                            </div>
                            
                            <hr class="form_divisor" />
                            
                            <div class="textarea">
                                <textarea id="textarea" name="texto"></textarea>
                            </div>
                        </div>
                        
                        <div class="postright">
                            <div class="postright_box">
                                <div class="postright_box_inner">
                                    <i class="fa fa-tags fa-fw"></i> <input type="text" name="tags" class="tags">
                                    <div class="box_inner_line2"></div>
                                    <div class="box_inner_line"></div>
                                </div>
                                <h3>Separe por virgula, na ordem de melhor relevância ao texto.</h3>
                            </div>
                            
                            <hr class="form_divisor" />
                            
                            <div class="postright_box">
                                <div class="postright_box_inner postagem_box">
                                    <h2><i class="fa fa-newspaper-o fa-fw"></i> Postagem</h2>
                                </div>
                                <div class="postagem_inner">
                                    <select class="select" name="status" id="select">
                                        <option value="1">Publicar</option>
                                        <option value="0">Rascunho</option>
                                    </select>
                                </div>
                            </div>
                            
                            <hr class="form_divisor" />
                                
                            <div class="postright_box">
                                <div class="postright_box_inner categoria_box">
                                    <h2><i class="fa fa-th-list fa-fw"></i> Categoria</h2>
                                </div>
                            
                                <div class="categoria_inner">
                                    <select class="select" name="categoria">
                                        <?php 

                                        $category = new ClassCategory();
                                        $data = $category->category_todos();
                                        if($data){
                                            foreach($data as $value)
                                                echo '<option value="'.$value->categoria_url.'">'.$value->categoria_titulo.'</option>';

                                        }else
                                            echo '<option value="">Sem categoria</option>';

                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="clearfix"></div>
                        
                        <div class="postbottom clearfix">
                            <div class="bottom_box imagem_miniatura">
                                <div class="bottom_box_inner">
                                    <div class="bottom_box_inner_title">
                                        <h2>Miniatura</h2>
                                        <h3>Dimensões recomendadas: largura <?php echo MINIATURA_LARGURA; ?>px & altura <?php echo MINIATURA_ALTURA; ?>px</h3>
                                    </div>

                                    <div class="bottom_box_inner_actions">
                                        <i id="action_upload" class="fa fa-cloud-upload fa-fw"></i>
                                    </div>

                                    <div class="bottom_box_inner_color"></div>
                                    <div class="bottom_box_inner_bg"></div>
                                </div>
                            </div>

                            <div class="bottom_box imagem_capa">
                                <div class="bottom_capa_inner">
                                    <div class="bottom_capa_inner_title">
                                        <h2>Capa</h2>
                                        <h3>Dimensões recomendadas: largura <?php echo CAPA_LARGURA; ?>px & altura <?php echo CAPA_ALTURA; ?>px</h3>
                                    </div>

                                    <div class="bottom_capa_inner_actions">
                                        <i id="action_upload_capa" class="fa fa-cloud-upload fa-fw"></i>
                                    </div>

                                    <div class="bottom_capa_inner_color"></div>
                                    <div class="bottom_capa_inner_bg"></div>
                                </div>
                            </div>
                        </div>

                        <div class="box_button_down clearfix">
                            <button class="button btn_publicar" name="create" title="Criar">Publicar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
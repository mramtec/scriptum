<?php


    spl_autoload_register(function($class){
        require_once '../class/'.$class.'.php'; 
        require_once '../class/defines.php';
    });
    
    if(session_status() == 1 || session_status() == 0) session_start();
    ClassAccess::access_prot_pag();
    

    $GET = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    $Categoria = new ClassCategory();
    foreach($Categoria->CategoriaSelecionado('id', $GET) as $DATA);

?>

<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="robots" content="noindex, nofollow" />
        <meta name="robots" content="noarchive" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Marcadores & Categorias <?php echo $DATA->categoria_titulo; ?></title>
        <link type="image/x-icon" rel="shortcut icon" href="../img/favicon.png" />
        <link type="text/css" rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/resets.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/sidebar.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout_category_edit.css" />
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery.mobile.custom.min.js"></script>
        <script type="text/javascript" src="assets/js/sidebar.js"></script>     
        <script src="assets/js/layout.js" type="text/javascript"></script>
        <script src="assets/js/category_edit.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
        
            <?php include('assets/sidebar.php'); ?>
            <?php include('assets/messages.php'); ?>

            <div class="content_section_title" style="background: url(assets/img/categorias.jpg) scroll center center no-repeat;background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;">
                <h1><i class="fa fa-edit fa-fw"></i>Categoria: <span id="title_section_post"><?php echo $DATA->categoria_titulo; ?></span></h1>
                <div class="content_section_title_color"></div>
            </div>    

            <div class="content">
                <div class="box1">
                    <div class="box1_left">
                        <form method="post" id="post" action="process/Proc_Category.php" enctype="multipart/form-data">
                            <ul>
                                <li><input type="text" name="titulo" placeholder="Titulo" id="titulo" value="<?php echo $DATA->categoria_titulo; ?>"></li>
                                <li>
                                    <button id="open_file">Selecionar arquivo de capa</button>
                                    <input id="file" type="file" name="capa" style="display: none;" accept=".jpg">
                                    <input type="hidden" name="capa_path" value="<?php echo $DATA->categoria_imagem; ?>">
                                    <p>Altura: <?php echo CAPA_ALTURA; ?>px & Largura: <?php echo CAPA_LARGURA; ?></p>
                                </li>
                                <li>
                                    <textarea id="descricao" name="descricao" placeholder="Descrição"><?php echo $DATA->categoria_descricao; ?></textarea>
                                    <div class="box1_description">A descrição não é obrigatória.</div>
                                </li>
                                
                                <li><button class="button_edit" name="atualizar" value="<?php echo $DATA->id; ?>">Alterar</button></li>
                            </ul>
                        </form>
                    </div>
                    <div class="box1_right">
                        <?php 
                        
                        if(is_file('../'.$DATA->categoria_imagem))
                            echo '<img src="../'.$DATA->categoria_imagem.'" />';
                        else
                            echo '<img src="assets/img/default_capa.jpg" title="Sem imagem" />';
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
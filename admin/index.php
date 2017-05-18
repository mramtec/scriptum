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
        <link type="text/css" rel="stylesheet" href="assets/css/layout_index.css" />
        <script type="text/javascript" src="assets/js-plugins/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="assets/js-plugins/jquery-ui.min.js"></script>
        <script type="text/javascript" src="assets/js-plugins/jquery.mobile.custom.min.js"></script>
        <script type="text/javascript" src="assets/js/sidebar.js"></script>
        <script src="assets/js/index.js" type="text/javascript"></script>
    </head>
    <body>
        <?php include('assets/sidebar.php'); ?>

        <div class="content_section_title" style="background: url(<?php if(strlen($_SESSION['usuarioCapa']) != 0){ echo '../'.$_SESSION['usuarioCapa']; }else{ echo 'assets/img/inicio.jpg'; } ?>) scroll center center no-repeat;background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;">
            <div class="content_section_title_inner">
                <h1>Bem vindo <?php echo $_SESSION['usuarioNome']; ?></h1>
            </div>
            <div class="content_section_title_color"></div>
        </div>

        <section class="content">
            <div class="box1 clearfix">
                <div class="box1_left">
                    <div class="box1_left_inner">
                        <h1><i class="fa fa-user-circle fa-fw"></i> Últimos Acessos</h1>
                        <div class="box1_left_inner_list">
                            <?php
                                $LastAccess = new ClassAccess();
                                $DataAccess = $LastAccess->AccessReturnReg(0, 6);
                                if($DataAccess != false){

                                    foreach($DataAccess as $UsersData){
                                        echo '<div class="box1_left_inner_line">';
                                            echo '<h2><i class="fa fa-laptop fa-fw"></i> '.$UsersData->acesso_nome.' - <span>'.$UsersData->acesso_descricao.'</span></h2>';
                                            echo '<h3>'.date('d/m/Y H:i', strtotime($UsersData->acesso_data)).'h</h3>';
                                        echo '</div>';
                                    }
                                }else{
                                    echo '<div class="box1_left_inner_line">';
                                        echo '<h2><i class="fa fa-info-circle"></i> Nenhum Registro</h2>';
                                    echo '</div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="box1_right">
                    <div class="box1_right_inner">
                        <h1><i class="fa fa-address-book fa-fw"></i> Atividades Recentes</h1>
                        <div class="box1_right_inner_list">
                            <?php
                                $Activity = new ClassActivity();
                                $Data = $Activity->getActivityReg(0, 8);
                                if($Data != false){
                                    foreach($Data as $values){
                                        echo '<div class="box1_right_inner_line">';
                                            echo '<h2><i class="fa fa-info-circle fa-fw"></i> '.$values->atividade_usuario_nome.' - <span>'.$values->atividade_descricao.'</span></h2>';
                                            echo '<h3>Registrado em: '.date('d/m/Y H:i', strtotime($values->atividade_hora)).'h</h3>';
                                        echo '</div>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="posts">
                <div class="box2 clearfix">

                </div>

                <div class="more">Mais</div>
                <div class="endload">Acabou a tinta...</div>
            </div>
            
            
        </section>
    </body>
</html>
<?php
    
    spl_autoload_register(function($class){
       require_once '../class/'.$class.'.php';
       require_once '../class/defines.php';
    });
    
    $convite = new ClassInvite();
    
    $Activation         = filter_input(INPUT_GET, 'activation', FILTER_DEFAULT);
    $Activation_Origem  = filter_input(INPUT_GET, 'origem', FILTER_DEFAULT);
    
    if(!isset($Activation)) header('Location: '.SITE);

?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="robots" content="noindex, nofollow" />
        <meta name="robots" content="noarchive" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Ativação por Email - <?php echo SITE_TITLE; ?></title>
        <link rel="shortcut icon" href="../img/favicon.png" />
        <link type="text/css" rel="stylesheet" href="css/resets.css" />
        <link type="text/css" rel="stylesheet" href="css/index.css" />
        <link type="text/css" rel="stylesheet" href="../admin/assets/font-awesome/css/font-awesome.min.css"/>
        <script src="../admin/assets/js-plugins/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="../admin/assets/js-plugins/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../admin/assets/js-plugins/jquery.mobile.custom.min.js" type="text/javascript"></script>
        <script src="js/index.js" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <h1>Bem-vindo a <?php echo SITE_TITLE; ?></h1>
        </header>
        <section class="content">
            <?php

            if($convite->InviteBusca(base64_decode($Activation_Origem), 1, true, false) == false){

                echo '<div class="message">';
                    echo '<h1><i class="fa fa-info-circle"></i></h1>';
                    echo '<h2>Não existe o convite ou o email já foi ativado.</h2>';
                echo '</div>';

            }else{

                foreach($convite->InviteBusca(base64_decode($Activation_Origem), 1, true, false) as $data);
                
                if($data->convite_codigo != $Activation){
                    echo '<div class="message">';
                        echo '<h1><i class="fa fa-info-circle"></i></h1>';
                        echo '<h2>Código de validação não confere com a base de dados.</h2>';
                    echo '</div>';
                }else{

                ?>

            <div class="box1">
                <h1>Essa etapa é para preenchimento de informações para acesso e também para requisitos básicos sobre você. 
                    <br>Após isso você será encaminhado para o painel administrativo.</h1>
            </div>
            <div class="box2">
                <form method="post" action="process/Process_Activation.php" id="form">
                    <ul style="margin: 3em 0;">
                        <li><input class="input nome" type="text" name="nome" placeholder="Nome" autocomplete="off" required></li>
                        <li><input class="input apelido" type="text" name="apelido" placeholder="Apelido (opcional)"></li>
                        <li>
                            <div class="passwords">
                                <input class="input senha" type="password" placeholder="Senha" autocomplete="off" required>
                                <input class="input senha2" type="password" name="senha" placeholder="Confirme Senha" autocomplete="off" required>
                            </div>
                        </li>
                        <li><input type="hidden" name="email" value="<?php echo base64_decode($Activation_Origem); ?>"></li>
                        <li>
                            <textarea class="input" name="descricao" placeholder="Deixe uma breve descrição sobre você!" maxlength="255" id="textarea"></textarea>
                            <br>
                            <h3 id="count"></h3>
                        </li>
                    </ul>
                    <button class="button" name="next_step">Cadastrar</button>
                </form>
            </div>
                <?php }
                
                }?>
        </section>
    </body>
</html>
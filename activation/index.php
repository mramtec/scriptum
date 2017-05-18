<?php
    
    spl_autoload_register(function($class){
       require_once '../class/'.$class.'.php';
    });
    
    $convite = new ClassForm();
    
    $Activation = filter_input(INPUT_GET, 'activation', FILTER_DEFAULT);
    $Activation_Origem = filter_input(INPUT_GET, 'origem', FILTER_DEFAULT);
    
    if(!isset($Activation))
        header('Location: '.SITE);

?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="robots" content="noindex, nofollow" />
        <meta name="robots" content="noarchive" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Ativação de email</title>
        <link rel="shortcut icon" href="../img/favicon.png" />
        <link type="text/css" rel="stylesheet" href="css/resets.css" />
        <link type="text/css" rel="stylesheet" href="css/index.css" />
        <link type="text/css" rel="stylesheet" href="../admin/assets/font-awesome/css/font-awesome.min.css"/>
        <script type="text/javascript" src="js-plugins/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js-plugins/jquery-ui.min.js"></script>
        <script type="text/javascript">
            $(function(){
                
                var status = 0;
                var total = 255;
                var restante = 0;
                
                function openCount(){
                    if(status == 0){
                        setTimeout(function(){
                            $('#count').show('drop', {direction: 'down'}, 300);
                        }, 200);
                    }
                }
                
                function closeCount(){
                    if(status == 1){
                        setTimeout(function(){
                            $('#count').hide('drop', {direction: 'down'}, 300);
                        }, 200);
                    }
                }

                $('#textarea').keyup(function(){

                   var lengthText = $(this).val();

                   if(lengthText.length == 0){
                        $('#count').text('');
                        closeCount();
                   }else{
                       restante = total - lengthText.length;
                       $('#count').text("Restam " + restante);
                       openCount();
                   }
                       
                });
            });
        </script>
    </head>
    <body>
        <header>
            <h1>Bem-vindo a <?php echo SITE_TITLE; ?></h1>
        </header>
        <section class="content">
                <?php

                if($convite->users_convite_busca(base64_decode($Activation_Origem), 1, true, false) == false){
                    echo '<div class="message">';
                        echo '<h1><i class="fa fa-info-circle"></i></h1>';
                        echo '<h2>Não existe o convite ou o email já foi ativado.</h2>';
                    echo '</div>';
                }else{
                    foreach($convite->users_convite_busca(base64_decode($Activation_Origem), 1, true, false) as $data);
                        if($data->convite_codigo != $Activation){
                            echo '<div class="message">';
                                echo '<h1><i class="fa fa-info-circle"></i></h1>';
                                echo '<h2>Código de validação não confere com a base de dados.</h2>';
                            echo '</div>';
                        }else{

                ?>
            
            
            <div class="box1">
                <h1>Essa etapa é para preenchimento dos dados para acesso e requisitos básicos sobre você. 
                    <br>Após isso você será encaminhado para o painel administrativo.</h1>
            </div>
            <div class="box2">
                <form method="post" action="process/Process_Activation.php" id="form">
                    <ul style="margin: 3em 0;">
                        <li><input class="input nome" type="text" name="nome" placeholder="Nome" autocomplete="off"></li>
                        <li><input class="input apelido" type="text" name="apelido" placeholder="Apelido"></li>
                        <li><input class="input senha" type="password" name="senha" placeholder="Senha" autocomplete="off"></li>
                        <li><input class="input" type="hidden" name="email" value="<?php echo base64_decode($Activation_Origem); ?>" style="background: lightgray;"></li>
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
        <script type="text/javascript">
            $(function(){
                
                $('.input').keyup(function(){
                    $(this).css('border', '1px #ddd solid');
                });
                
                $('.button').click(function(){
                    $('#form').submit(function(){
                        var nome = $('.nome');
                        var nomeValue = $('.nome').val();
                        var apelido = $('.apelido');
                        var apelidoValue = $('.apelido').val();
                        var senha = $('.senha');
                        var senhaValue = $('.senha').val();
                        
                        if(nomeValue.length == 0){
                            nome.css('border', '1px #ee5555 solid');
                            return false;
                        }
                        
                        if(apelidoValue.length == 0){
                            apelido.css('border', '1px #ee5555 solid');
                            return false;
                        }
                        
                        if(senhaValue.length == 0){
                            senha.css('border', '1px #ee5555 solid');
                            return false;
                        }
                    });
                });
            });
        </script>
    </body>
</html>
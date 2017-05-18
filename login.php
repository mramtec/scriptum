<?php

    $login_profile = filter_input(INPUT_GET, 'profile', FILTER_DEFAULT);
    $login_access = filter_input(INPUT_GET, 'access', FILTER_DEFAULT);
    $login_name = filter_input(INPUT_GET, 'name', FILTER_DEFAULT);

?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="robots" content="noindex, nofollow" />
        <meta name="robots" content="noarchive" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login</title>
        <link href="admin/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="admin/assets/css/resets.css" rel="stylesheet" type="text/css"/>
        <link href="admin/assets/css/login.css" rel="stylesheet" type="text/css"/>
        <script src="admin/assets/js-plugins/jquery-1.11.3.min.js" type="text/javascript"></script>
        <script src="admin/assets/js-plugins/jquery-ui.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.box_login').show('drop', {direction: 'down'}, 500);
            });
        </script>
    </head>
    <body id="scene">
        <div class="container layer">

            <section class="box_login">
                <div class="box_login_inner">
                    <form method="post" action="access/access_verify_data.php">
                        <div class="box_user_image">
                            <img src="img/default.png" id="img_default"/>
                        </div>
                        <div class="box_user_mail">
                            <img src="admin/icon/icon_user_login.png"><input class="input usuario" type="text" name="usuario" id="email" placeholder="E-mail" autocomplete="off" autofocus="true" required>
                        </div>
                        <div class="box_user_pass">
                            <img src="admin/icon/icon_user_pass.png"><input class="input senha" type="password" name="senha" id="senha" placeholder="Senha" autocomplete="off" required>
                        </div>
                        <?php
                                if(isset($login_access)){
                                    switch($login_access){
                                        case 'denied':
                                            echo '<h3><i class="fa fa-exclamation-triangle"></i> Acesso Negado</h3>';
                                            break;

                                        case '0':
                                            echo '<h3><i class="fa fa-exclamation-triangle"></i> Seu acesso foi bloqueado.</h3>';
                                            break;

                                        case 'not_authorized':
                                            echo '<h3><i class="fa fa-exclamation-triangle"></i> Não autorizado</h3>';
                                            break;
                                    }
                                }
                            ?>
                        <div class="box_user_btn">
                            <button class="button none" type="submit">Acessar</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

        <script>

        </script>
    </body>
</html>
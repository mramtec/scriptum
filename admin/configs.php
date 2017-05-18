<?php
    require_once '../access/access_requires.php';
    spl_autoload_register(function($class){
       require_once '../class/'.$class.'.php'; 
    });
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="robots" content="noindex, nofollow" />
        <meta name="robots" content="noarchive" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Configurações</title>
        <link type="image/x-icon" rel="shortcut icon" href="../img/favicon.png" />
        <link type="text/css" rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/resets.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/sidebar.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout.css" />
        <link type="text/css" rel="stylesheet" href="assets/css/layout_config.css" />
        <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery.mobile.custom.min.js"></script>
        <script src="assets/js/layout.js" type="text/javascript"></script>
        <script type="text/javascript" src="assets/js/sidebar.js"></script>
    </head>
    <body>
        <div class="container">
        
            <?php include('assets/sidebar.php'); ?>
            <?php include('assets/messages.php'); ?>
            
            <div class="content_section_title" style="background: url(assets/img/configuracoes.jpg) fixed center center no-repeat;background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;">
                <h1><i class="fa fa-edit fa-fw"></i> <span id="title_section_post">Configurações</span></h1>
                <div class="content_section_title_color"></div>
            </div>
            
            <div class="content clearfix">
                <div class="content_inner">
                    <form method="post" id="post" class="post clearfix" action="process/Process_Config_Mail.php">
                        <div class="box1 clearfix">
                            <h1 class="box1_title"><i class="fa fa-envelope-o"></i> Configuração de E-mail</h1>

                            <?php
                                $configMail = new ClassConfig();
                                foreach($configMail->Config_Email_Fetch() as $mail);
                            ?>

                            <div class="box1_left">
                                <ul>
                                    <li><input type="text" class="input" name="mail_host" placeholder="Host" autocomplete="off" value="<?php if($mail->config_mail_host != NULL) echo $mail->config_mail_host; ?>"></li>
                                    <li><input type="text" class="input" name="mail_username" placeholder="Usuário" value="<?php echo $mail->config_mail_username; ?>"></li>
                                    <li><input type="password" class="input" name="mail_password" placeholder="Password" value="<?php echo $mail->config_mail_password; ?>"></li>
                                    <li><input type="text" class="input" name="mail_port" placeholder="Porta" value="<?php if($mail->config_mail_port == 0){ echo 0; }else{ echo $mail->config_mail_port; } ?>"></li>
                                    <li><input type="text" class="input" name="mail_origem" placeholder="Email" value="<?php echo $mail->config_mail_origem; ?>"></li>
                                </ul>
                            </div>
                            <div class="box1_right">
                                <h1 class="box1_title"><i class="fa fa-lock"></i> Segurança & Criptografia</h1>
                                <ul>
                                    <li><input type="checkbox" name="mail_smtp_auth" value="1"<?php if($mail->config_mail_smtp_auth == 1) echo 'checked'; ?>> Autênticar no servidor</li>
                                    <li><input type="radio" name="mail_smtp_secure" value="ssl" <?php if($mail->config_mail_smtp_secure == 'ssl') echo 'checked'; ?>> SSL</li>
                                    <li><input type="radio" name="mail_smtp_secure" value="tls" <?php if($mail->config_mail_smtp_secure == 'tls') echo 'checked'; ?>> TLS</li>
                                </ul>
                            </div>
                        </div>

                        <div class="box0">
                            <button class="button btn_publicar" name="config_apply">Aplicar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
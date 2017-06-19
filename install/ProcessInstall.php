<?php

    spl_autoload_register(function($class){
        require_once '../class/'.$class.'.php'; 
    });

    $installTrue = filter_input(INPUT_POST, 'send', FILTER_DEFAULT);
    $HostDB      = filter_input(INPUT_POST, 'host_db', FILTER_DEFAULT);
    $UserDB      = filter_input(INPUT_POST, 'user_db', FILTER_DEFAULT);
    $PassDB      = filter_input(INPUT_POST, 'pass_db', FILTER_DEFAULT);
    $DB          = filter_input(INPUT_POST, 'database_db', FILTER_DEFAULT);
    $Dominio     = filter_input(INPUT_POST, 'domain', FILTER_DEFAULT);
    $PagLogin    = filter_input(INPUT_POST, 'login_page', FILTER_DEFAULT);
    $PagAdmin    = filter_input(INPUT_POST, 'admin_page', FILTER_DEFAULT);
    $NomeSite    = filter_input(INPUT_POST, 'site_name', FILTER_DEFAULT);
    $Descricao   = filter_input(INPUT_POST, 'description', FILTER_DEFAULT);
    $Nome        = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
    $Email       = filter_input(INPUT_POST, 'mail', FILTER_DEFAULT);
    $Senha       = filter_input(INPUT_POST, 'pass', FILTER_DEFAULT);
    $MiniaturaW  = filter_input(INPUT_POST, 'thumbs_width', FILTER_SANITIZE_NUMBER_INT);
    $MiniaturaH  = filter_input(INPUT_POST, 'thumbs_height', FILTER_SANITIZE_NUMBER_INT);
    $CapaW       = filter_input(INPUT_POST, 'cover_width', FILTER_SANITIZE_NUMBER_INT);
    $CapaH       = filter_input(INPUT_POST, 'cover_height', FILTER_SANITIZE_NUMBER_INT);
    $PerfilW     = filter_input(INPUT_POST, 'profile_width', FILTER_SANITIZE_NUMBER_INT);
    $PerfilH     = filter_input(INPUT_POST, 'profile_height', FILTER_SANITIZE_NUMBER_INT);
    $TimeZone    = filter_input(INPUT_POST, 'timezone', FILTER_DEFAULT);
    $TimeEspec   = filter_input(INPUT_POST, 'timezone_specified', FILTER_DEFAULT);
    
    $TimeZoneInsert = NULL;
    
    if(isset($installTrue)){
        
        if(strlen($TimeEspec) != 0)
            $TimeZoneInsert = $TimeEspec;
        else
            $TimeZoneInsert = $TimeZone;
        
        
        $SystemConfig = '<?php

            date_default_timezone_set("'.$TimeZoneInsert.'");

            define("ACCESS_LOGIN_PAGE", "'.$PagLogin.'");
            define("ACCESS_ADMIN_PAGE", "'.$PagAdmin.'");
            define("SITE", "'.$Dominio.'");
            define("SITE_TITLE", "'.$NomeSite.'");
            define("SITE_DESCRIPTION", "'.$Descricao.'");

            define("MINIATURA_LARGURA", '.$MiniaturaW.');
            define("MINIATURA_ALTURA", '.$MiniaturaH.');
            define("CAPA_LARGURA", '.$CapaW.');
            define("CAPA_ALTURA", '.$CapaH.');
            define("PERFIL_LARGURA", '.$PerfilW.');
            define("PERFIL_ALTURA", '.$PerfilH.');
            
            define("LOGO", "'.$Dominio.'/assets/img/logo_mail.png");
        ';
                //define("LOGO", "https://conhecaolugar.com.br/assets/img/logo_mail.png");
        file_put_contents('../class/defines.php', $SystemConfig);

        
        $DataBaseConfig = 
        '<?php

            define("DB_HOST", "'.$HostDB.'");
            define("DB_NAME", "'.$DB.'");
            define("DB_USER", "'.$UserDB.'");
            define("DB_PASS", "'.$PassDB.'");';
        
        file_put_contents('../class/defines_database.php', $DataBaseConfig);
        

        $htAccess = 
                'AddHandler application/x-httpd-php70 .php

                RewriteEngine on
                RewriteCond %{REQUEST_FILENAME} !-d
                RewriteCond %{REQUEST_FILENAME}\.php -f
                RewriteRule ^(.*)$ $1.php
                
                Options -Indexes';
        
        file_put_contents('../.htaccess', $htAccess);

        mkdir(0644, true, '../uploads/');
        mkdir(0644, true, '../uploads/capas/');
        mkdir(0644, true, '../uploads/capas_perfil/');
        mkdir(0644, true, '../uploads/images/');
        mkdir(0644, true, '../uploads/miniatura/');
        mkdir(0644, true, '../uploads/perfil/');
        mkdir(0644, true, '../uploads/slide/');
        mkdir(0644, true, '../uploads/categoria/');
        
        $Installation = new ClassDataAdmin();
        $Installation->setEmail($Email);
        $Installation->setName($Nome);
        $Installation->setPass($Senha);

        if($Installation->getCreateDefaultTables() == TRUE){
            return header('Location: ../access/access_verify_data.php?new_user_login='.base64_encode($Email).'&new_user_pass='.base64_encode($Senha).'&first_installation=true');
        }else{
            echo 'Installation Fail!';
        }
        
    }

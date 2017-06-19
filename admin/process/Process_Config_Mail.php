<?php
    
    include_once '../../access/access_requires.php';

    spl_autoload_register(function($class){
       require_once '../../class/'.$class.'.php'; 
    });

    $Config_Post = filter_input(INPUT_POST, 'config_apply', FILTER_DEFAULT);
    
    $Config_Mail_Host = filter_input(INPUT_POST, 'mail_host', FILTER_DEFAULT);
    $Config_Mail_Username = filter_input(INPUT_POST, 'mail_username', FILTER_DEFAULT);
    $Config_Mail_Password = filter_input(INPUT_POST, 'mail_password', FILTER_DEFAULT);
    $Config_Mail_Port = filter_input(INPUT_POST, 'mail_port', FILTER_SANITIZE_NUMBER_INT);
    $Config_Mail_Origem = filter_input(INPUT_POST, 'mail_origem', FILTER_DEFAULT);
    $Config_Mail_SMTP_Auth = filter_input(INPUT_POST, 'mail_smtp_auth', FILTER_DEFAULT);
    $Config_Mail_SMTP_Secure = filter_input(INPUT_POST, 'mail_smtp_secure', FILTER_DEFAULT);
    
    
    if(isset($Config_Post)){
        
        $Email = new ClassConfig();
        $Email->setConfigHost($Config_Mail_Host);
        $Email->setConfigUsername($Config_Mail_Username);
        $Email->setConfigPass($Config_Mail_Password);
        $Email->setConfigSecure($Config_Mail_SMTP_Secure);
        $Email->setConfigAuth($Config_Mail_SMTP_Auth);
        $Email->setConfigPort($Config_Mail_Port);
        $Email->setConfigOrige($Config_Mail_Origem);
        
        if($Email->Config_Email_Param())
            return header('Location: ../configs.php?message=009');
        else
            return header('Location: ../configs.php?message=401');

    }
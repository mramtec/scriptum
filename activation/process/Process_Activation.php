<?php
    
    require_once '../../class/defines.php';
    
    spl_autoload_register(function($class){
       require_once '../../class/'.$class.'.php'; 
    });
    
    $ConfigUser = filter_input(INPUT_POST, 'next_step', FILTER_DEFAULT);
    
    $Config_User_Name   = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
    $Config_User_Nick   = filter_input(INPUT_POST, 'apelido', FILTER_DEFAULT);
    $Config_User_Pass   = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
    $ConfigUserMail     = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
    $Config_User_About  = filter_input(INPUT_POST, 'descricao', FILTER_DEFAULT);


    if(isset($ConfigUser)){
        
        $FORM = new ClassForm();
        $FORM->setEmailCadastro($ConfigUserMail);

        if($FORM->UserConviteBusca($ConfigUserMail, 1, true, false) == false)
                 header('Location: '.SITE);//echo 'Não existe o convite'; // Adicionar um HEADER
        else{
            
            foreach( $FORM->UserConviteBusca($ConfigUserMail, 1, true, false) as $value );

            $USER = new ClassUsers();
            $USER->setNome($Config_User_Name);
            $USER->setApelido($Config_User_Nick);
            $USER->setSenha($Config_User_Pass);
            $USER->setEmail($ConfigUserMail);
            $USER->setDescricao($Config_User_About);
            $USER->setPrivilegio($value->convite_privilegio);
            $USER->setAcesso(1);

            if($USER->UserNovo()){

                if($FORM->isUserConviteDelete())
                    return header('Location: '.SITE.'/access/access_verify_data.php?new_user_login='.base64_encode($ConfigUserMail).'&new_user_pass='.base64_encode($Config_User_Pass));
                else
                    return header('Location: '.SITE.'/login?condition=not_exist&access=error_on_delete_invitation');

            }else
                header('Location: '.SITE);

        }
        
    }

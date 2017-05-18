<?php
    
    require_once '../../class/defines.php';
    
    spl_autoload_register(function($class){
       require_once '../../class/'.$class.'.php'; 
    });
    
    $Config_User = filter_input(INPUT_POST, 'next_step', FILTER_DEFAULT);
    
    $Config_User_Name = filter_input(INPUT_POST, 'nome', FILTER_DEFAULT);
    $Config_User_Nick = filter_input(INPUT_POST, 'apelido', FILTER_DEFAULT);
    $Config_User_Pass = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
    $Config_User_Mail = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
    $Config_User_About = filter_input(INPUT_POST, 'descricao', FILTER_DEFAULT);

    if(isset($Config_User)){
        
        $User = new ClassForm();
        if($User->users_convite_busca($Config_User_Mail, 1, true, false) == false)
                 header('Location: '.SITE);//echo 'Não existe o convite'; // Adicionar um HEADER
        else{
            
            foreach( $User->users_convite_busca($Config_User_Mail, 1, true, false) as $value ){
                
                $user = new ClassUsers();
                $user->nome = $Config_User_Name;
                $user->apelido = $Config_User_Nick;
                $user->exibicao = $Config_User_Name;
                $user->senha = $Config_User_Pass;
                $user->email = $Config_User_Mail;
                $user->descricao = $Config_User_About;
                $user->privilegio = $value->convite_privilegio;
                $user->acesso = 1;

                if($user->users_novo()){
                    
                    $User->form_email = $Config_User_Mail;
                    if($User->users_convite_delete())
                        return header('Location: '.SITE.'access/access_verify_data.php?new_user_login='.base64_encode($Config_User_Mail).'&new_user_pass='.base64_encode($Config_User_Pass));
                    else
                        return header('Location: '.SITE.'login?condition=not_exist&access=error_on_delete_invitation');

                }else{
                    header('Location: '.SITE);
                }
                
            }
        }
        
    }

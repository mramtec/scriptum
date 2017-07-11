<?php


    spl_autoload_register(function($class){
        require_once '../../class/'.$class.'.php'; 
        require_once '../../class/defines.php';
    });
    
    if(session_status() == 1 || session_status() == 0) session_start();
    ClassAccess::access_prot_pag();
    
    

    $user_remove_profile = filter_input(INPUT_POST, "remove_profile", FILTER_DEFAULT);
    $user_remove_capa = filter_input(INPUT_POST, "remove_capa", FILTER_DEFAULT);
    
    $user_nome_select = filter_input(INPUT_POST, "nome_select", FILTER_DEFAULT);
    $user_apelido_select = filter_input(INPUT_POST, "apelido_select", FILTER_DEFAULT);
    
    

    if(isset($user_remove_profile)){

        $user = new ClassUsers();
        $user->id = $user_remove_profile;
        foreach ($user->users_exibir_selecionado() as $value);

        if(is_file('../../'.$value->usuario_perfil)){
            ClassArchives::arquivo_excluir('../../'.$value->usuario_perfil);
            unset($_SESSION['usuarioFoto']);
            echo "true";
        }else{
            echo "false";
        }

    }
    
    
    if(isset($user_remove_capa)){
        
        $user = new ClassUsers();
        $user->id = $user_remove_capa;
        foreach ($user->users_exibir_selecionado() as $value);

        if(is_file('../../'.$value->usuario_capa)){
            ClassArchives::arquivo_excluir('../../'.$value->usuario_capa);
            echo "true";
        }else{
            echo "false";
        }
    }
    
    
    if(isset($user_nome_select)){
        $user = new ClassUsers();
        $user->id = $user_nome_select;
        
        if($user->users_alt_apelido("nome"))
            echo "true";
        else
            echo "error";
    }
    
    if(isset($user_apelido_select)){
        $user = new ClassUsers();
        $user->id = $user_apelido_select;
        
        if($user->users_alt_apelido("apelido"))
            echo "true";
        else
            echo "error";
    }
    
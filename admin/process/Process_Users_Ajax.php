<?php

    spl_autoload_register(function($class){
        require_once '../../class/'.$class.'.php'; 
        require_once '../../class/defines.php';
    });
    
    if(session_status() == 1 || session_status() == 0) session_start();

    ClassAccess::access_prot_pag();
    ClassAccess::access_check_privileg();

    $user_offset                = filter_input(INPUT_POST, "offset", FILTER_SANITIZE_NUMBER_INT);
    $user_buscar                = filter_input(INPUT_POST, 'search', FILTER_DEFAULT);
    $user_alterar_privilegio    = filter_input(INPUT_POST, 'alterar_privilegio', FILTER_SANITIZE_NUMBER_INT);
    $user_acesso                = filter_input(INPUT_POST, 'acesso', FILTER_DEFAULT);
    
    $user_delete                = filter_input(INPUT_POST, 'delete_user', FILTER_SANITIZE_SPECIAL_CHARS);
    $user_delete_capa           = filter_input(INPUT_POST, 'delete_capa', FILTER_DEFAULT);
    $user_delete_perfil         = filter_input(INPUT_POST, 'delete_perfil', FILTER_DEFAULT);

    $user_like                  = filter_input(INPUT_POST, 'user_like', FILTER_DEFAULT);
    
    $user_convite = filter_input(INPUT_POST, 'enviar_convite', FILTER_DEFAULT);
    $user_email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
    $user_privilegio = filter_input(INPUT_POST, 'privilegio', FILTER_DEFAULT);


    if(isset($user_offset)){
        
        $user = new ClassUsers();        
        $data = $user->users_exibir_todos($user_offset);
        
        if($data != false){
            foreach ( $data as $conteudo ) {
                echo '<li id="post_'.$conteudo->id.'">';
                    echo '<div class="box_post clearfix">';
                        
                        echo '<div class="box_post_left">';
                            echo '<div class="box_post_left_left">';
                                if(is_file('../../'.$conteudo->usuario_perfil))
                                    echo '<img src="../'.$conteudo->usuario_perfil.'" />';
                                else
                                    echo '<img src="assets/img/default_user.png" />';
                            echo '</div>';
                            echo '<h2>'.$conteudo->usuario_nome.'</h2>';
                            echo '<h3>Nível de acesso: <span id="rotulo_'.$conteudo->id.'">'.$conteudo->usuario_privilegio.'</span> <i style="margin: 0 0.5em; cursor: pointer" class="fa fa-undo" id="acesso_privilegio" data-id="'.$conteudo->id.'"></i></h3>';
                        echo '</div>';

                        echo '<div class="box_post_right clearfix">';    
                            echo '<div class="box_post_right_item">';
                                echo '<div class="lock">';
                                    if($_SESSION['usuarioID'] != $conteudo->id){
                                        if($conteudo->usuario_acesso == 0){
                                            echo '<div id="'.$conteudo->id.'_lock">';
                                                echo '<i data-id="'.$conteudo->id.'" class="fa fa-lock"></i>';
                                            echo '</div>';
                                        }else if($conteudo->usuario_acesso == 1){
                                            echo '<div id="'.$conteudo->id.'_lock">';
                                                echo '<i data-id="'.$conteudo->id.'" class="fa fa-unlock"></i>';
                                            echo '</div>';
                                        }
                                    }else{
                                            echo '<div>';
                                                echo '<i class="fa fa-smile-o"></i>';
                                            echo '</div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="box_post_right_item delete_item">';
                                if($_SESSION['usuarioID'] != $conteudo->id){
                                    echo '<i class="fa fa-trash-o"  style="cursor:pointer;" id="delete" '
                                    . 'data-delete-id="'.$conteudo->id.'" data-delete-capa="'.$conteudo->usuario_capa.'" data-delete-perfil="'.$conteudo->usuario_perfil.'"></i>';
                                }
                            echo '</div>';
                        echo '</div>';

                        if($conteudo->usuario_capa != "" && is_file("../../".$conteudo->usuario_capa)){
                            echo '<div class="color"></div>';
                            echo '<div class="bg" style="background: url(../'.$conteudo->usuario_capa.') scroll center center no-repeat; background-size: cover; -moz-background-size: cover; -webkit-background-size: cover; filter: blur(5px);"></div>';
                        }

                    echo '</div>';
                echo "</li>";
            }

        }else{
            echo "false";
        }
    }

    
    if(isset($user_buscar)){
        
        $busca = new ClassUsers();
        $data = $busca->users_buscar($user_buscar);

        if(!$data){

            echo '<li>';
                echo '<a><i class="fa fa-binoculars"></i> Usuário não localizado!</a>';
            echo '</li>';

        }else{
            
            foreach ( $data as $value ) {
                echo '<li>';
                    echo '<a>'.$value->usuario_nome.'</a>';
                echo '</li>';
            }
        }
        
    }

    /*
    if(isset($user_like)){

        if(ClassForm::users_convite_busca($user_like) == true)
            echo 1;
        else
            echo 0;
        
    }
    */

    if(isset($user_delete)){
        
        $delete = new ClassUsers();
        $delete->setID($user_delete);

        foreach ( $delete->UserExibirSelecionado() as $value );

        if(is_file("../../".$user_delete_capa) && is_file("../../".$value->usuario_capa)){
            ClassArchives::arquivo_excluir("../../".$value->usuario_capa);
        }
        
        if(is_file("../../".$user_delete_perfil) && is_file("../../".$value->usuario_perfil)){
            ClassArchives::arquivo_excluir("../../".$value->usuario_perfil);
        }
        
        if($delete->users_excluir($user_delete)){
            echo "true";
        }else{
            echo "error";
        }

    }
    

    if(isset($user_alterar_privilegio)){
        
        $user = new ClassUsers();
        $user->setID($user_alterar_privilegio);
        $data = $user->UserExibirSelecionado();
        
        $escolha = '';

        foreach ($data as $value);

        if($value->usuario_privilegio == 'administrador'){
            $user->setPrivilegio('convidado');
            $escolha = 'convidado';
        }else{
            $user->setPrivilegio('administrador');
            $escolha = 'administrador';
        }

        if($user->UserAlternarPrivilegio())
            echo $escolha;
        else
            echo 'error';
    }
    
    
    if(isset($user_acesso)){
        
        $user = new ClassUsers();
        $user->setID($user_acesso);
        $data = $user->UserExibirSelecionado();
        
        $acesso = '';
        
        foreach($data as $value);
        
            if($value->usuario_acesso == 1){
                $user->setAcesso(0);
                $acesso = 'lock';
            }else if($value->usuario_acesso == 0){
                $user->setAcesso(1);
                $acesso = 'unlock';
            }
            
            if($user->UserAlternarAcesso())
                echo $acesso;
            else
                echo 'error';

    }
    

    if(isset($user_convite)){
        
        if(ClassInvite::InviteBusca($user_email, 1, false, false) == true){
            return header('Location: ../users.php?message=502');
        }else{
            
            $user = new ClassInvite();
            $user->setEmailCadastrado($user_email);
            $user->setFormPrivilegio($user_privilegio);

            if($user->InviteNovo())
                return header('Location: ../users.php?message=501');
            else
                return header('Location: ../users.php?message=503');
        }

    }
    
   
<?php

    spl_autoload_register(function($class){
        require_once '../../class/'.$class.'.php'; 
        require_once '../../class/defines.php';
    });
    
    if(session_status() == 1 || session_status() == 0) session_start();
    ClassAccess::access_prot_pag();


    $post_ler = filter_input(INPUT_POST, "offset", FILTER_SANITIZE_SPECIAL_CHARS);
    $post_buscar = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_SPECIAL_CHARS);
    
    $post_load_bg = filter_input(INPUT_POST, 'load_bg', FILTER_SANITIZE_SPECIAL_CHARS);
    
    $post_delete = filter_input(INPUT_POST, 'delete_post', FILTER_SANITIZE_SPECIAL_CHARS);
    $post_delete_miniatura = filter_input(INPUT_POST, 'delete_miniatura', FILTER_SANITIZE_SPECIAL_CHARS);
    $post_delete_capa = filter_input(INPUT_POST, 'delete_capa', FILTER_SANITIZE_SPECIAL_CHARS);

    $post_publish = filter_input(INPUT_POST, 'publish', FILTER_SANITIZE_SPECIAL_CHARS);


    if(isset($post_ler)){
        
        $read = new ClassPost();        
        $data = $read->PostTodos($post_ler, 2);
        
        if($data != false){
            foreach ( $data as $conteudo ) {
                echo '<li id="post_'.$conteudo->id.'">';
                    echo '<div class="box_post clearfix">';
                        echo '<div class="box_post_left">';
                            echo '<h2>'.$conteudo->post_titulo;
                            if($conteudo->post_status == "0"){
                                echo "<span> - rascunho</span>";
                            }
                            echo '</h2>';
                            if($conteudo->post_agendamento_stats == 1){
                                echo '<h3><i class="fa fa-clock-o"></i> agendado para: '.
                                        date('d', strtotime($conteudo->post_agendamento)).'/'.
                                        date('m', strtotime($conteudo->post_agendamento)).'/'.
                                        date('Y', strtotime($conteudo->post_agendamento)).' às '.
                                        date('H', strtotime($conteudo->post_agendamento)).':'.
                                        date('i', strtotime($conteudo->post_agendamento)).'h</h3>';
                            }else{
                                echo '<h3><i class="fa fa-calendar-check-o"></i> Publicado em: '.date('d/m/Y H:i', strtotime($conteudo->post_data)).'h</h3>';
                            }

                            if($conteudo->post_autor_id == '' || $conteudo->post_autor_nome == ''){
                                echo '<h4><i class="fa fa-user" title="Autor"></i> Admin</h4>';    
                            }else{
                                echo '<h4><i class="fa fa-user" title="Autor"></i> '.$conteudo->post_autor_nome.'</h4>';    
                            }
                            
                        echo '</div>';

                        echo '<div class="box_post_right clearfix">';
                            
                            if($conteudo->post_autor_id == $_SESSION['usuarioID'] || $_SESSION['privilegio'] == 'administrador'){    
                                echo '<div class="box_post_right_item">';                        
                                    echo '<a href="edit.php?id='.$conteudo->id.'">';
                                        echo '<i class="fa fa-edit"></i>';
                                    echo '</a>';    
                                echo '</div>';
                            }

                            if($conteudo->post_autor_id == $_SESSION['usuarioID'] || $_SESSION['privilegio'] == 'administrador'){
                                echo '<div class="box_post_right_item delete_item">';
                                    echo '<i class="fa fa-trash-o"  style="cursor:pointer;" id="delete" data-delete-id="'.$conteudo->id.'" '
                                            . 'data-delete-capa="'.$conteudo->post_capa.'" '
                                            . 'data-delete-miniatura="'.$conteudo->post_miniatura.'"></i>';
                                echo '</div>';
                            }

                            if($conteudo->post_agendamento_stats == 1){
                                echo '<div class="box_post_right_item" id="publicar_agora" data-agenda-id="'.$conteudo->id.'">';
                                    echo '<h9 id="publish_'.$conteudo->id.'"><i class="fa fa-paper-plane" style="cursor:pointer;"></i></h9>';
                                    echo '<h10 id="publish_hide_'.$conteudo->id.'" style="display:none;"><i class="fa fa-check-circle"></i></h10>';
                                echo '</div>';
                            }else{
                                echo '<div class="box_post_right_item">';
                                    echo '<h9><i class="fa fa-check-circle"></i></h9>';
                                echo '</div>';
                            }
                        echo '</div>';

                        if($conteudo->post_miniatura != "" && is_file("../../".$conteudo->post_miniatura)){
                            echo '<div class="color"></div>';
                            echo '<div class="bg" style="background: url(../'.$conteudo->post_miniatura.') scroll center center no-repeat; background-size: cover; -moz-background-size: cover; -webkit-background-size: cover; filter: blur(5px);"></div>';
                        }else if($conteudo->post_capa != "" && is_file("../../".$conteudo->post_capa)){
                            echo '<div class="color"></div>';
                            echo '<div class="bg" style="background: url(../'.$conteudo->post_capa.') scroll center center no-repeat; background-size: cover; -moz-background-size: cover; -webkit-background-size: cover; filter: blur(5px);"></div>';
                        }

                    echo '</div>';
                echo "</li>";
            }

        }else{
            echo "false";
        }
    }

    
    if(isset($post_buscar)){
        
        $busca = new ClassPost();
        $data = $busca->post_buscar($post_buscar);

        if(!$data){

            echo '<li>';
                echo '<a><i class="fa fa-binoculars"></i> Nada localizado!</a>';
            echo '</li>';

        }else{
            
            foreach ( $data as $value ) {
                echo '<li>';
                    echo '<a href="edit?id='.$value->id.'">'.$value->post_titulo.'</a>';
                echo '</li>';
            }
        }
        
    }
    
    
    if(isset($post_load_bg)){
        
        $bg = new ClassPost();
        $bg->id = $post_load_bg;
        
        
        foreach($bg->post_selecionado() as $value){
            echo $value->post_miniatura;
        }
    }
    
    
    if(isset($post_delete)){

        $ExecDelete = new ClassPost();
        $ExecRemove = new ClassArchives();
        $Registro = new ClassActivity();        

        $Data = $ExecDelete->PostSelecionado('id', $post_delete);

        $Registro->setUsuarioID($_SESSION['usuarioID']);
        $Registro->setUsuarioNome($_SESSION['usuarioNome']);
        
        if($Data != false){
            foreach ( $Data as $value );

                
            $ExecRemove->setArquivoPath('../../'.$post_delete_capa);
            $ExecRemove->getExcluirArquivo();

            $ExecRemove->setArquivoPath('../../'.$post_delete_miniatura);
            $ExecRemove->getExcluirArquivo();
            
            
            if($ExecDelete->PostExcluir($post_delete)){

                $Registro->setDescricao('Apagou a publicação : '.$value->post_titulo);
                echo 'true';

            }else{

                $Registro->setDescricao('Falha na tentativa de apagar a publicação : '.$value->post_titulo);
                echo 'error2';

            }
            

        }else{
            echo 'error';
        }
        
        $Registro->getActivity();
    }
    
    
    
    if(isset($post_publish)){

        $post = new ClassPost();
        $post->agendamento_stats = "0";
        $post->agendamento = null;
        $post->id = $post_publish;
        
        if($post->post_publicar_agora()){
            echo "true";
        }else{
            echo "false";
        }
        
    }
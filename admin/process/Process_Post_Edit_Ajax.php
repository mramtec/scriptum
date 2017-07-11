<?php

    spl_autoload_register(function($class){
        require_once '../../class/'.$class.'.php'; 
        require_once '../../class/defines.php';
    });
    
    if(session_status() == 1 || session_status() == 0) session_start();
    ClassAccess::access_prot_pag();
    

    $ApagarMini     = filter_input(INPUT_POST, 'apagar_mini', FILTER_DEFAULT);
    $ApagarCapa     = filter_input(INPUT_POST, 'apagar_capa', FILTER_DEFAULT);
    $ApagarPost     = filter_input(INPUT_POST, 'apagar_post', FILTER_SANITIZE_NUMBER_INT);
    $PostTitle      = filter_input(INPUT_POST, 'post_title', FILTER_DEFAULT);

    if(isset($ApagarMini)){
        $Post = new ClassPost();
        $FileMini = new ClassArchives();
        $FileMini->setArquivoPath('../../'.$ApagarMini);
        if($FileMini->getExcluirArquivo()){
            $Post->PostApagarImagem($ApagarPost, 'miniatura');

            $Registro = new ClassActivity();
            $Registro->setUsuarioID($_SESSION['usuarioID']);
            $Registro->setUsuarioNome($_SESSION['usuarioNome']);
            $Registro->setDescricao('Apagou a miniatura em: '.$PostTitle);
            $Registro->getActivity();

            echo '1';
        }else
            echo '0';
    }
    
    if(isset($ApagarCapa)){
        
        $Post = new ClassPost();
        $FileMini = new ClassArchives();
        $FileMini->setArquivoPath('../../'.$ApagarCapa);
        if($FileMini->getExcluirArquivo()){
            $Post->PostApagarImagem($ApagarPost, 'capa');
            
            $Registro = new ClassActivity();
            $Registro->setUsuarioID($_SESSION['usuarioID']);
            $Registro->setUsuarioNome($_SESSION['usuarioNome']);
            $Registro->setDescricao('Apagou a capa em: '.$PostTitle);
            $Registro->getActivity();

            echo '1';
        }else
            echo '0';
    }    
    
    
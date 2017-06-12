<?php

    include_once '../../access/access_requires.php';

    spl_autoload_register(function($class){
       require_once '../../class/'.$class.'.php'; 
    });
    
    $ProfileAlterar         = filter_input(INPUT_POST, "alterar", FILTER_DEFAULT);
    $ProfileNome            = filter_input(INPUT_POST, "nome", FILTER_DEFAULT);
    $ProfileApelido         = filter_input(INPUT_POST, "apelido", FILTER_DEFAULT);
    $ProfileDescricao       = filter_input(INPUT_POST, "descricao", FILTER_DEFAULT);
    $ProfileBiografia       = filter_input(INPUT_POST, "biografia", FILTER_DEFAULT);
    $ProfileCapaPath        = filter_input(INPUT_POST, "capa_path", FILTER_DEFAULT);
    $ProfilePerfilPath      = filter_input(INPUT_POST, "perfil_path", FILTER_DEFAULT);
    $ProfilePassword        = filter_input(INPUT_POST, "senha", FILTER_DEFAULT);
    $ProfilePassValidation  = FALSE;

   
    
    if(isset($ProfileAlterar)){
         var_dump($_POST);
        $User = new ClassUsers();
        
        $User->setID($_SESSION['usuarioID']);
        $User->setNome($ProfileNome);
        $User->setApelido($ProfileApelido);
        $User->setDescricao($ProfileDescricao);
        $User->setBiografia($ProfileBiografia);
        
        
        if(strlen($ProfilePassword) != 0){
            $User->setSenha($ProfilePassword);
            $ProfilePassValidation = TRUE;
        }
        
        if($User->UserEditar($ProfilePassValidation) === TRUE){
            
            if(session_status() == 1 || session_status() == 0) session_start();
            $_SESSION['usuarioNome'] = $ProfileNome;
            header("Location: ../profile?message=601");

        }else
            header("Location: ../profile?message=602");
            
  

    }
    
    
    if(isset($_FILES['perfil'])){
        
        $User = new ClassUsers();
        $User->setID($_SESSION['usuarioID']);
        
        if($_FILES['perfil']['size'] != 0){
            
            $FilePerfil = new ClassArchives();
            $FilePerfil->setArquivo($_FILES['perfil']);
            $FilePerfil->setLocal('uploads/perfil/');
            
            if(is_file('../../'.$ProfilePerfilPath)){
                $FilePerfil->setArquivoPath('../../'.$ProfilePerfilPath);
                $FilePerfil->getExcluirArquivo();
            }
            
            if($FilePerfil->getValidaoArquivo('perfil') !== TRUE)
                return header('Location: ../profile?message='.$FilePerfil->getValidaoArquivo('perfil'));
            else{
                if($FilePerfil->getValidarPasta() !== TRUE)
                    return header('Location: ../profile?message='.$FilePerfil->getValidarPasta());
                
                $User->setPerfil($FilePerfil->getNovoArquivo());
            }
        }else{
            $User->setPerfil(NULL);
        }
        
        if($User->UserPerfil())
            header("Location: ../profile?message=605");
        else
            header("Location: ../profile?message=603");
        
        
    }
    
    
    if(isset($_FILES['capa'])){

        $User = new ClassUsers();
        $User->setID($_SESSION['usuarioID']);

        if($_FILES['capa']['size'] != 0){
            
            $FileCapa = new ClassArchives();
            $FileCapa->setArquivo($_FILES['capa']);
            $FileCapa->setLocal('uploads/capas_perfil/');
            
            
            if(is_file('../../'.$ProfileCapaPath)){
                    $FileCapa->setArquivoPath('../../'.$ProfileCapaPath);
                    $FileCapa->getExcluirArquivo ();
            }
            
            if($FileCapa->getValidaoArquivo('capa') !== TRUE){
                return header('Location: ../profile?message='.$FileCapa->getValidaoArquivo('capa'));
            }else{
                
                if($FileCapa->getValidarPasta() !== TRUE)
                    return header('Location: ../profile?message='.$FileCapa->getValidarPasta());
                
                $User->setCapa($FileCapa->getNovoArquivo());
            }
            
        }else{
            $User->setCapa(NULL);
        }
        
       if($User->UserCapa()){
            header("Location: ../profile?message=606");
        }else
            header("Location: ../profile?message=604");
    }
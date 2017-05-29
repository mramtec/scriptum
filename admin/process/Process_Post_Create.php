<?php
    
    include_once '../../access/access_requires.php';

    spl_autoload_register(function($class){
       require_once '../../class/'.$class.'.php'; 
    });
    

    $POST               = filter_input(INPUT_POST, "create", FILTER_DEFAULT);
    $Titulo             = filter_input(INPUT_POST, "titulo", FILTER_DEFAULT);
    $Subtitulo          = filter_input(INPUT_POST, "subtitulo", FILTER_DEFAULT);
    $Texto              = filter_input(INPUT_POST, "texto", FILTER_DEFAULT);
    $Tags               = filter_input(INPUT_POST, "tags", FILTER_DEFAULT);
    $Categoria          = filter_input(INPUT_POST, "categoria", FILTER_DEFAULT);
    $Status             = filter_input(INPUT_POST, "status", FILTER_DEFAULT);
    
    
    if(isset($POST)){
       
        $insert = new ClassPost();
        
        if($Titulo != '')
            $insert->setTitulo($Titulo);
        else
            return header('Location: ../create?message=101');

        $insert->setSubTitulo($Subtitulo);
        $insert->setTexto($Texto);
        $insert->setCategoria($Categoria);
        $insert->setStatus($Status);
        $insert->setAutorID($_SESSION['usuarioID']);
        $insert->setAutorNome($_SESSION['usuarioNome']);


        if($_FILES['capa']['size'] != 0){

            $FileCapa = new ClassArchives();
            $FileCapa->setArquivo($_FILES['capa']);
            $FileCapa->setLocal('uploads/capa/');
                
            if($FileCapa->getValidaoArquivo('capa') === true)
                $insert->setImagemCapa($FileCapa->getNovoArquivo());
            else
                return header('Location: ../create?message='.$FileCapa->getValidaoArquivo('capa'));

        }else
            $insert->setImagemCapa(NULL);


        if($_FILES['miniatura']['size'] != 0){

            $FileMini = new ClassArchives();
            $FileMini->setArquivo($_FILES['miniatura']);
            $FileMini->setLocal('uploads/miniatura/');

            if($FileMini->getValidaoArquivo('miniatura') === true)
                $FileMini->getNovoArquivo();
            else
                return header('Location: ../create?message='.$FileMini->getValidaoArquivo('miniatura'));
                
        }else
            $insert->setImagemMini(NULL);


        if($insert->PostNovo()){
            
            $Registro = new ClassActivity();
            $Registro->setUsuarioID($_SESSION['usuarioID']);
            $Registro->setUsuarioNome($_SESSION['usuarioNome']);
            $Registro->setDescricao('Fez uma nova publicação: '.$Titulo);
            $Registro->getActivity();
            
            header('Location: ../create?message=001');
        }else
            header('Location: ../create?message=119');

    }
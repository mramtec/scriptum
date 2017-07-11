<?php


    spl_autoload_register(function($class){
        require_once '../../class/'.$class.'.php'; 
        require_once '../../class/defines.php';
    });
    
    if(session_status() == 1 || session_status() == 0) session_start();
    ClassAccess::access_prot_pag();

    
    $CategoriaCriar         = filter_input(INPUT_POST, 'criar', FILTER_DEFAULT);
    $CategoriaEditar        = filter_input(INPUT_POST, 'atualizar', FILTER_SANITIZE_NUMBER_INT);
    $CategoriaTitulo        = filter_input(INPUT_POST, 'titulo', FILTER_DEFAULT);
    $CategoriaDescricao     = filter_input(INPUT_POST, 'descricao', FILTER_DEFAULT);
    $CategoriaImagemPath    = filter_input(INPUT_POST, 'capa_path', FILTER_DEFAULT);



    if(isset($CategoriaCriar)){
        
        
        $Categoria = new ClassCategory();
        $Categoria->setTitulo($CategoriaTitulo);
        $Categoria->setDescricao($CategoriaDescricao);
        
        
        if($_FILES['capa']['size'] != 0){
            
            $Arquivo = new ClassArchives();
            $Arquivo->setArquivo($_FILES['capa']);
            $Arquivo->setLocal('uploads/categoria/');

            if($Arquivo->getValidaoArquivo('capa') === TRUE)
                $Categoria->setImagem($Arquivo->getNovoArquivo(ClassTools::forURL($CategoriaTitulo)));
            else {
                return header('Location: ../category.php?message='.$Arquivo->getValidaoArquivo('capa'));
            }
            
            
        }else{
            $Categoria->setImagem(NULL);
        }

        
        if($Categoria->CategoriaNova())
            return header('Location: ../category.php?message=014');
        else
            return header('Location: ../category.php?message=207');

    

    }
    
    
    
    if(isset($CategoriaEditar)){
        
        
        $Categoria = new ClassCategory();
        $Categoria->setId($CategoriaEditar);
        $Categoria->setTitulo($CategoriaTitulo);
        $Categoria->setDescricao($CategoriaDescricao);
        
        if($_FILES['capa']['size'] != 0){
            
            $Arquivo = new ClassArchives();
            $Arquivo->setArquivo($_FILES['capa']);
            $Arquivo->setLocal('uploads/categoria/');
            
            if(is_file('../../'.$CategoriaImagemPath)){
                $Arquivo->setArquivoPath('../../'.$CategoriaImagemPath);
                $Arquivo->getExcluirArquivo();
            }
            
            if($Arquivo->getValidaoArquivo('capa') === TRUE)
                $Categoria->setImagem($Arquivo->getNovoArquivo());
            else
                return header('Location: ../category_edit.php?id='.$CategoriaEditar.'&message='.$Arquivo->getValidaoArquivo('capa'));

        }else{
            $Categoria->setImagem($CategoriaImagemPath);
        }
        
        
        if($Categoria->CategoriaEditar())
            return header('Location: ../category_edit.php?id='.$CategoriaEditar.'&message=008');
        else
            return header('Location: ../category_edit.php?id='.$CategoriaEditar.'&message=208');

        
        
    }
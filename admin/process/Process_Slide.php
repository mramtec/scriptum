<?php


    spl_autoload_register(function($class){
        require_once '../../class/'.$class.'.php'; 
        require_once '../../class/defines.php';
    });
    
    if(session_status() == 1 || session_status() == 0) session_start();
    ClassAccess::access_prot_pag();


    $POST               = filter_input(INPUT_POST, "enviar", FILTER_DEFAULT);
    $Titulo             = filter_input(INPUT_POST, "titulo", FILTER_DEFAULT);
    $SubTitulo          = filter_input(INPUT_POST, "subtitulo", FILTER_DEFAULT);
    $Link               = filter_input(INPUT_POST, "link", FILTER_DEFAULT);
    
    
    $DELETE             = filter_input(INPUT_POST, "delete", FILTER_SANITIZE_NUMBER_INT);
    $LocalImagem        = filter_input(INPUT_POST, "delete-archive", FILTER_DEFAULT);
    
    
    $LIST               = filter_input(INPUT_POST, 'list', FILTER_DEFAULT);
    
    
    if(isset($POST)){
        
        $Slide = new ClassSlide();
        
        if($_FILES['capa']['size'] == 0){
            return header('Location: ../create?message=301');
        }else{
            $Arquivo = new ClassArchives();
            $Arquivo->setArquivo($_FILES['capa']);
            
            if($Arquivo->getValidaoArquivo('capa') !== true) {

                return header('Location: ../slide?message='.$FileCapa->getValidaoArquivo('capa'));

            }else{
                
                $Arquivo->setLocal('uploads/slide/');
                $Slide->setImagem( $Arquivo->getNovoArquivo() );

            }
        }

        $Slide->setTitulo($Titulo);
        $Slide->setSubtitulo($SubTitulo);
        $Slide->setLink($Link);
        
        if($Slide->getNovoSlide() === true){
            
            $Registro = new ClassActivity();
            $Registro->setUsuarioID($_SESSION['usuarioID']);
            $Registro->setUsuarioNome($_SESSION['usuarioNome']);
            $Registro->setDescricao('Adicionou um novo slide: '.$Titulo);
            $Registro->getActivity();
            
            return header('Location: ../slide?message=001');
            
        }else
            return header('Location: ../slide?message=306');

    }
    
    
    
    if(isset($LIST)){

        $SlideItens = new ClassSlide();
        foreach($SlideItens->getSlides('DESC') as $Slide){

            echo '<div class="box1_grid" id="item_'.$Slide->id.'">';
                echo '<button id="excluir" data-path="'.$Slide->slide_imagem.'" data-id="'.$Slide->id.'"> Excluir <i class="fa fa-trash-o fa-fw"></i></button>';
                echo '<div class="box1_grid_inner">';
                    echo '<h1>'.$Slide->slide_titulo.'</h1>';
                    echo '<h2>'.$Slide->slide_descricao.'</h2>';
                    echo '<a href="'.$Slide->slide_link.'"><button>Acessar</button></a>';
                echo '</div>';
                echo '<div class="box1_grid_color"></div>';
                echo '<div class="box1_grid_bg" style="background: url(../'.$Slide->slide_imagem.') scroll center center no-repeat;background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;"></div>';
            echo '</div>';

        }

    }
    
    
    
    if(isset($DELETE)){
        
        $SlideDelete = new ClassSlide();
        $SlideArchive = new ClassArchives ();
        
        if($SlideDelete->getDeleteSlide($DELETE)){
            $SlideArchive->setArquivoPath($LocalImagem);
            $SlideArchive->getExcluirArquivo();
            
            $Registro = new ClassActivity();
            $Registro->setUsuarioID($_SESSION['usuarioID']);
            $Registro->setUsuarioNome($_SESSION['usuarioNome']);
            $Registro->setDescricao('Removeu um slide');
            $Registro->getActivity();
            
            echo true;
        }else{
            echo false;
        }
            
        
    }
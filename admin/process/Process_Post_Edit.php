<?php

    spl_autoload_register(function($class){
        require_once '../../class/'.$class.'.php'; 
        require_once '../../class/defines.php';
    });
    
    if(session_status() == 1 || session_status() == 0) session_start();
    ClassAccess::access_prot_pag();
    

    $EDITAR         = filter_input(INPUT_POST, 'editar', FILTER_DEFAULT);
    $ID             = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $Titulo         = filter_input(INPUT_POST, 'titulo', FILTER_DEFAULT);
    $Subtitulo      = filter_input(INPUT_POST, 'subtitulo', FILTER_DEFAULT);
    $Texto          = filter_input(INPUT_POST, 'texto', FILTER_DEFAULT);
    $Tags           = filter_input(INPUT_POST, 'tags', FILTER_DEFAULT);
    $Categoria      = filter_input(INPUT_POST, 'categoria', FILTER_DEFAULT);
    $PathMiniatura  = filter_input(INPUT_POST, 'path_miniatura', FILTER_DEFAULT);
    $PathCapa       = filter_input(INPUT_POST, 'path_capa', FILTER_DEFAULT);
    $Status         = filter_input(INPUT_POST, 'status', FILTER_DEFAULT);
    
    $AgendamentoStats  = filter_input(INPUT_POST, 'agendamento_stats', FILTER_DEFAULT);
    $AgendamentoDia    = filter_input(INPUT_POST, 'agendamento_dia', FILTER_DEFAULT);
    $AgendamentoMes    = filter_input(INPUT_POST, 'agendamento_mes', FILTER_DEFAULT);
    $AgendamentoAno    = filter_input(INPUT_POST, 'agendamento_ano', FILTER_DEFAULT);
    $AgendamentoHora   = filter_input(INPUT_POST, 'agendamento_hora', FILTER_DEFAULT);
    $AgendamentoMinuto = filter_input(INPUT_POST, 'agendamento_minuto', FILTER_DEFAULT);
    
    
    if($AgendamentoStats == 1)
        $Agendamento = $AgendamentoAno.'-'.$AgendamentoMes.'-'.$AgendamentoDia.' '.$AgendamentoHora.':'.$AgendamentoMinuto.':00';
    else
        $Agendamento = null;
    
    if(isset($EDITAR)){
        
        $Editar = new ClassPost();        
        $Editar->setID($ID);
        $Editar->setTitulo($Titulo);
        $Editar->setSubTitulo($Subtitulo);
        $Editar->setTexto($Texto);
        $Editar->setTags($Tags);
        $Editar->setCategoria($Categoria);
        $Editar->setStatus($Status);
        $Editar->setAgendamentoStats($AgendamentoStats);
        $Editar->setAgendamento($Agendamento);


        if($_FILES['miniatura']['size'] != 0){

                $FileMini = new ClassArchives();
                $FileMini->setArquivo($_FILES['miniatura']);
                $FileMini->setLocal('uploads/miniatura/');
                
                if($FileMini->getValidaoArquivo('miniatura') === true)
                    $Editar->setImagemMini($FileMini->getNovoArquivo ());
                else
                    return header('Location: ../edit?id='.$ID.'&message='.$FileMini->getValidaoArquivo('miniatura'));

        }else
            $Editar->setImagemMini($PathMiniatura);


        if($_FILES['capa']['size'] != 0){

            $FileCapa = new ClassArchives();
            $FileCapa->setArquivo($_FILES['capa']);
            $FileCapa->setLocal('uploads/capa/');

            if($FileCapa->getValidaoArquivo('capa') === true)
                $Editar->setImagemCapa($FileCapa->getNovoArquivo());
            else
                return header('Location: ../edit?id='.$ID.'&message='.$FileCapa->getValidaoArquivo('capa'));

        }else{
            $Editar->setImagemCapa($PathCapa);
        }
        
        
        if($Editar->PostEditar()){
            
            $Registro = new ClassActivity();
            $Registro->setUsuarioID($_SESSION['usuarioID']);
            $Registro->setUsuarioNome($_SESSION['usuarioNome']);
            $Registro->setDescricao('Fez uma alteração em: '.$Titulo);
            $Registro->getActivity();
            
            return header('Location: ../edit?id='.$ID.'&message=002');
        }else
            return header('Location: ../edit?id='.$ID.'&message=119');

    }
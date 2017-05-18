<?php
    
    include_once '../../access/access_requires.php';

    spl_autoload_register(function($class){
       require_once '../../class/'.$class.'.php'; 
    });
    

    $POST               = filter_input(INPUT_POST, "create", FILTER_SANITIZE_SPECIAL_CHARS);
    $Titulo             = filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_SPECIAL_CHARS);
    $Subtitulo          = filter_input(INPUT_POST, "subtitulo", FILTER_SANITIZE_SPECIAL_CHARS);
    $Texto              = filter_input(INPUT_POST, "texto", FILTER_DEFAULT);
    $Tags               = filter_input(INPUT_POST, "tags", FILTER_SANITIZE_SPECIAL_CHARS);
    $Categoria          = filter_input(INPUT_POST, "categoria", FILTER_DEFAULT);
    $Status             = filter_input(INPUT_POST, "status", FILTER_SANITIZE_SPECIAL_CHARS);
    /*$AgendamentoStats   = filter_input(INPUT_POST, "agendamento_stats", FILTER_SANITIZE_SPECIAL_CHARS);
    $AgendamentoDia     = filter_input(INPUT_POST, "agendamento_dia", FILTER_SANITIZE_SPECIAL_CHARS);
    $AgendamentoMes     = filter_input(INPUT_POST, "agendamento_mes", FILTER_SANITIZE_SPECIAL_CHARS);
    $AgendamentoAno     = filter_input(INPUT_POST, "agendamento_ano", FILTER_SANITIZE_SPECIAL_CHARS);
    $AgendamentoHora    = filter_input(INPUT_POST, "agendamento_hora", FILTER_SANITIZE_SPECIAL_CHARS);
    $AgendamentoMinuto  = filter_input(INPUT_POST, "agendamento_minuto", FILTER_SANITIZE_SPECIAL_CHARS);


    if($AgendamentoStats == 1)
        $Agendamento = $AgendamentoAno.'-'.$AgendamentoMes.'-'.$AgendamentoDia.' '.$AgendamentoHora.':'.$AgendamentoMinuto.':00';
    else
        $Agendamento = null;
*/    
    
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
            $FileCapa->setLocal('uploads/capas/');
                
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
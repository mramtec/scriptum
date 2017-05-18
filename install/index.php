<?php

    spl_autoload_register(function($class){
       require_once '../class/'.$class.'.php'; 
    });
    
    $Installation = new ClassDataAdmin();
    $Installation->getRowsTable();
    if($Installation->getCreateDefaultTables() == TRUE){
        echo 'Instalação concluída, os dados de acesso inicial:';
        echo '<br><br>';
        echo 'Email: sistema@sis.com';
        echo '<br>';
        echo 'Senha: sistema';
    }
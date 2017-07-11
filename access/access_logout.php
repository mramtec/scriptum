<?php
 
    spl_autoload_register(function($class){
        require_once '../class/'.$class.'.php'; 
        require_once '../class/defines.php';
    });
    
    if(session_status() == 1 || session_status() == 0) session_start();

    if(session_status() == 1 || session_status() == 0)
        session_start();
    
    $access = new ClassAccess();
    $access->access_logout( 2 );
<?php
    
    include_once 'access_requires.php';
    
    if(session_status() == 1 || session_status() == 0)
        session_start();
    
    $access = new ClassAccess();
    $access->access_logout( 2 );
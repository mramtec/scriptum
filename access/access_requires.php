<?php
  
    $defines = 'class/defines.php';

    if(is_file('../'.$defines)){
        require_once '../'.$defines;
    }else if(is_file('../../'.$defines)){
        require_once '../../'.$defines;
    }else if(is_file('../../../'.$defines)){
        require_once '../../../'.$defines;
    }
    
    spl_autoload_register(function($class){
        if(is_file('../class/'.$class.'.php')){
            require_once '../class/'.$class.'.php';
        }
        if(is_file('../../class/'.$class.'.php')){
            require_once '../../class/'.$class.'.php';
        }
        if(is_file('../../../class/'.$class.'.php')){
            require_once '../../../class/'.$class.'.php';
        }
    });

    if(session_status() == 1 || session_status() == 0) session_start();
    ClassAccess::access_prot_pag();

?>

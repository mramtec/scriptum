<?php
    
    include_once 'access_requires.php';

    $NovoUserLogin = filter_input(INPUT_GET, 'new_user_login', FILTER_DEFAULT);
    $NovoPassLogin = filter_input(INPUT_GET, 'new_user_pass', FILTER_DEFAULT);

    $Form_User = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
    $Form_Pass = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    
    $email = strlen($Form_User) == 0 ? base64_decode($NovoUserLogin) : $Form_User;
    $senha = strlen($Form_Pass) == 0 ? base64_decode($NovoPassLogin) : $Form_Pass;
    
    $installation = filter_input(INPUT_GET, 'first_installation', FILTER_VALIDATE_BOOLEAN);
    
    if(isset($email)){
        
        
        if($installation == TRUE){
            unlink('../install/index.php');
            unlink('../install/ProcessInstall.php');
            rmdir('../install');
        }
        
        
        $Access = new ClassAccess();
        $Access->setEmail($email);
        $Access->setSenha($senha);
        
        $permiss = $Access->access_verif_permiss();

        if($permiss != true){
            header('Location: ' . ACCESS_LOGIN_PAGE . '?access=' . $permiss);
        }else{        
            if($Access->access_verifica()){

                if($Access->access_verif_permiss()){
                    if(session_status() == 1 || session_status() == 0) session_start();
                    header('Location: ' .  ACCESS_ADMIN_PAGE . '?status_session='. session_status() . '&id=' . $_SESSION['usuarioSessionID']);
                }

            }else{
                header('Location: ' . ACCESS_LOGIN_PAGE . '?access=denied&condition=not_exist');
            }
        }
    }else{
        header('Location: ' .  ACCESS_LOGIN_PAGE . '?access=denied');
    }
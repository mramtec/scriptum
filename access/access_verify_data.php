<?php
    
    include_once 'access_requires.php';

    $NovoUserLogin = filter_input(INPUT_GET, 'new_user_login', FILTER_DEFAULT);
    $NovoPassLogin = filter_input(INPUT_GET, 'new_user_pass', FILTER_DEFAULT);

    $Form_User = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
    $Form_Pass = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    
    $email = strlen($Form_User) == 0 ? base64_decode($NovoUserLogin) : $Form_User;
    $senha = strlen($Form_Pass) == 0 ? base64_decode($NovoPassLogin) : $Form_Pass;
    
    if(isset($email)){
        
        $access = new ClassAccess();
        $access->access_define_data($email, $senha);
        $permiss = $access->access_verif_permiss();

        if($permiss != 'true'){
            header('Location: ' . ACCESS_LOGIN_PAGE . '?' . $permiss);
        }else{        
            if($access->access_verifica()){

                if($access->access_verif_permiss()){
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
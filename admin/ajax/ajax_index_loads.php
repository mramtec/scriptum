<?php

    require_once '../../class/defines.php';
    
    spl_autoload_register(function($class){
        require_once '../../class/'.$class.'.php';    
    });

    $ajax_offset = filter_input(INPUT_POST, 'offset', FILTER_SANITIZE_NUMBER_INT);
    $ajax_last_access = filter_input(INPUT_POST, 'last_access', FILTER_DEFAULT);

    if(isset($ajax_offset)){
        
        $post = new ClassPost();
        $post_fetch = $post->PostTodos($ajax_offset, 2, 8);
        
        if($post_fetch == 0){
            echo 0;
        }else{
            foreach($post_fetch as $key => $data):
                
                if(is_file('../../'.$data->post_miniatura))
                    $is_file_stats = '';
                else{
                    $is_file_stats = ' style="color:#989898;"';
                }
                
                echo '<div class="box2_grid" style="background: url(../'.$data->post_miniatura.') scroll center center no-repeat; background-size: cover;">';
                    echo '<div class="box2_grid_inner">';
                        echo '<h1'.$is_file_stats.'>'.$data->post_titulo.' <a href="edit?id='.$data->id.'"'.$is_file_stats.'><i class="fa fa-edit" style="display: none;"></i></a></h1>';
                        echo '<h2'.$is_file_stats.'>'.$data->post_subtitulo.'</h2>';
                    echo '</div>';
                    
                    if(is_file('../../'.$data->post_miniatura)){
                        echo '<div class="color"></div>';
                    }else{
                        echo '<div class="color" style="background: #ddd;"></div>';
                    }
                echo '</div>';
            endforeach;
        }
    }

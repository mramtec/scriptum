<?php

    require_once '../class/ClassPost.php';
    require_once '../class/ClassCategory.php';

    $offset = filter_input(INPUT_POST, "offset", FILTER_SANITIZE_NUMBER_INT);
    
    if(isset($offset)){
        
        $post = new ClassPost();
        $foreach = $post->post_todos($offset, 1, 6, false);
        
        if($foreach != false){
            foreach($foreach as $data){
                echo '<div class="box1_grid">';
                    echo '<a href="post.php?u='.$data->post_url.'">';
                        echo '<div class="box1_grid_inner">';
                            echo '<div class="box1_grid_inner_logo"><img src="img/logo.png" title="Isabel Tavares" /></div>';

                                if(strlen($data->post_categoria) != 0)
                                    echo '<div class="box1_grid_inner_tag">'. ClassCategory::categoria_identificar_titulo ($data->post_categoria).' <i class="fa fa-tags"></i></div>';

                                echo '<div class="box1_grid_inner_text">';
                                    echo $data->post_titulo;
                                echo '</div>';
                                echo '<div class="box1_grid_inner_border"></div>';
                                echo '<div class="box1_grid_inner_color"></div>';
                                echo '<div class="box1_grid_inner_color2"></div>';
                                echo '<div class="box1_grid_inner_image" style="background: url(';
                                    echo $data->post_miniatura;
                                echo ') scroll center center no-repeat;background-size: cover;"></div>';
                        echo '</div>';
                    echo '</a>';
                echo '</div>';
            }
        }else{
            echo 0;
        }
    }
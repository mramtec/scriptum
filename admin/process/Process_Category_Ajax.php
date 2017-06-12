<?php

    include_once '../../access/access_requires.php';
    
    spl_autoload_register(function($class){
        require_once '../../class/'.$class.'.php'; 
    });

    $cat_offset         = filter_input(INPUT_POST, 'offset', FILTER_SANITIZE_NUMBER_INT);
    $CategoriaDelete    = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT);
    
    
    if(isset($cat_offset)){
        
        $category = new ClassCategory();
        $data = $category->category_todos((int) $cat_offset);
        
        if($data == false){
            echo 0;
        }else{
            foreach($data as $value){
                echo '<li class="clearfix" id="cat_'.$value->id.'">';
                    echo '<div class="box1_right_item_left"><span><i class="fa fa-tag fa-fw"></i> '.$value->categoria_titulo.'</span></div>';

                    echo '<div class="box1_right_item_right">'
                        . '<ul>'
                            . '<li>'
                            . '<a href="category_edit.php?id='.$value->id.'"><i class="fa fa-edit fa-fw"></i></a>'
                            . '<i class="fa fa-trash-o" id="delete" data-id="'.$value->id.'" style="cursor: pointer;"></i>'
                            . '</li>'
                        . '</ul>'
                    . '</div>';
                echo '</li>';
            }
        }        
    }
    
    if(isset($CategoriaDelete)){
        
        $Categoria = new ClassCategory();
        $Categoria->setId($CategoriaDelete);
        if($Categoria->CategoriaExcluir('id'))
            echo 1;
        else
            echo 0;
    }
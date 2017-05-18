<?php

    include_once '../../access/access_requires.php';
    //require_once '../../class/ClassCategory.php';
    
    spl_autoload_register(function($class){
        require_once '../../class/'.$class.'.php'; 
    });

    $cat_offset = filter_input(INPUT_POST, 'offset', FILTER_SANITIZE_NUMBER_INT);
    $cat_delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_NUMBER_INT);
    
    $cat_criar = filter_input(INPUT_POST, 'criar', FILTER_DEFAULT);
    $cat_titulo = filter_input(INPUT_POST, 'titulo', FILTER_DEFAULT);
    $cat_descricao = filter_input(INPUT_POST, 'descricao', FILTER_DEFAULT);

    if(isset($cat_criar)){
        
        $category = new ClassCategory();
        $category->titulo = $cat_titulo;
        $category->descricao = $cat_descricao;

        if($category->category_novo())
            echo 1;
        else
            echo 0;

    }
    
    if(isset($cat_offset)){
        
        $category = new ClassCategory();
        $data = $category->category_todos((int) $cat_offset);
        
        if($data == false){
            echo 0;
        }else{
            foreach($data as $value){
                echo '<li class="clearfix" id="cat_'.$value->id.'">';
                    echo '<div class="box1_right_item_left"><i class="fa fa-tags fa-fw"></i> <span>'.$value->categoria_titulo.'</span></div>';
                    echo '<div class="box1_right_item_right" id="delete" data-id="'.$value->id.'"><i class="fa fa-trash-o" style="cursor: pointer;"></i></div>';
                echo '</li>';
            }
        }        
    }
    
    if(isset($cat_delete)){
        
        $category = new ClassCategory();
        $category->id = $cat_delete;
        
        if($category->category_excluir())
            echo 1;
        else
            echo 0;
    }
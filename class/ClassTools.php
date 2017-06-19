<?php

spl_autoload_register(function($class){
   require_once $class.'.php'; 
});


class ClassTools {

    public static function forURL($str, $replace = array(), $delimiter="_"){
        
        setlocale(LC_ALL, 'en_US.UTF8');

        if(!empty($replace)) {
            $str = str_replace((array)$replace, ' ', $str);
        }

        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;

    }
    
    
        
    public static function IdentificarCategoria( $URL ){
        
            $sql = "SELECT * FROM categoria WHERE categoria_url = :url LIMIT 1";
            $category = ClassDataBase::prepare( $sql );
            $category->bindValue( ':url', $URL );
            
            if($category->execute()){

                foreach($category->fetchAll() as $data)
                    return $data->categoria_titulo;

            }else{
                return "Sem Categoria";
            }
        
    }
    
}

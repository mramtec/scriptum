<?php

spl_autoload_register(function($class){
   require_once $class.'.php'; 
});


class ClassCategory extends ClassDataBase{
    
    public $id;
    public $url;
    public $titulo;
    public $descricao;
    
    
    public function category_novo(){
        
        $sql = "INSERT INTO categoria (categoria_url, categoria_titulo, categoria_descricao) VALUES (:url, :titulo, :descricao)";
        $category = ClassDataBase::prepare($sql);
        $category->bindValue(':url', ClassPost::post_url_edit($this->titulo));
        $category->bindValue(':titulo', $this->titulo);
        $category->bindValue(':descricao', $this->descricao);
        if($category->execute())
            return true;
        else
            return false;

    }
    
    
    public function category_editar(){
        
        $sql = "UPDATE categoria SET categoria_url = :url, categoria_titulo = :titulo, categoria_descricao = :descricao WHERE id = :id";
        $category = ClassDataBase::prepare($sql);
        $category->bindValue(':url', ClassPost::post_url_edit($this->titulo));
        $category->bindValue(':titulo', $this->titulo);
        $category->bindValue(':descricao', $this->descricao);
        $category->bindValue(':id', $this->id);
        
        if($category->execute())
            return true;
        else
            return false;
    }
    
    
    public function category_excluir(){
        
        $data = self::category_selecionado();
        foreach($data as $value);

        $post = ClassDataBase::prepare("UPDATE posts SET post_categoria = NULL WHERE post_categoria = :url");
        $post->bindValue(':url', $value->categoria_url);
        if($post->execute()){
            
            $sql = "DELETE FROM categoria WHERE id = :id";
            $category = ClassDataBase::prepare($sql);
            $category->bindValue(':id', $this->id);
            if($category->execute()){
                return true;    
            }else
                return false;

        }else{
            return false;
        }

    }
    
    public function category_todos($offset = null){

        $sql = '';
        
        if($offset != null){
            $sql = "SELECT * FROM categoria ORDER BY id DESC LIMIT $offset, 8";
        }else{
            $sql = "SELECT * FROM categoria ORDER BY id DESC";
        }

        $category = ClassDataBase::prepare($sql);
        if($category->execute()){
            if($category->rowCount() != 0)
                return $category->fetchAll();
            else
                return false;
        }else{
            return false;
        }
    }

    public function category_selecionado($where = 'id'){
        if($where == 'id'){
            $sql = "SELECT * FROM categoria WHERE id = :id";
            $category = ClassDataBase::prepare($sql);
            $category->bindValue(':id', $this->id);
        }else if($where == 'url'){
            $sql = "SELECT * FROM categoria WHERE categoria_url = :url";
            $category = ClassDataBase::prepare($sql);
            $category->bindValue(':url', $this->url);
        }
            
        if($category->execute()){
            if($category->rowCount() != 0)
                return $category->fetchAll();
            else
                return false;
        }else{
            return false;
        }
    }
    
    
    public static function categoria_identificar_titulo($where){
        
            $sql = "SELECT * FROM categoria WHERE categoria_url = :url LIMIT 1";
            $category = ClassDataBase::prepare($sql);
            $category->bindValue(':url', $where);
            
            if($category->execute()){
                foreach($category->fetchAll() as $data){
                    return $data->categoria_titulo;
                }
            }else{
                return "Sem Categoria";
            }
        
    }
}
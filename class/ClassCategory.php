<?php


spl_autoload_register(function($class){
   require_once $class.'.php'; 
});


class ClassCategory extends ClassDataBase{
    
    
    private $id;
    private $url;
    private $titulo;
    private $descricao;
    private $Imagem;
    
    
    function setId($id) {
        $this->id = $id;
    }

    
    function setUrl($url) {
        $this->url = $url;
    }

    
    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    
    function setImagem($Imagem) {
        $this->Imagem = $Imagem;
    }
   

    
    public function CategoriaNova(){

        $sql = "INSERT INTO categoria (categoria_url, categoria_titulo, categoria_descricao, categoria_imagem) VALUES (:url, :titulo, :descricao, :imagem)";

        $Categoria = ClassDataBase::prepare($sql);
        $Categoria->bindValue(':url', ClassTools::forURL($this->titulo));
        $Categoria->bindValue(':titulo', $this->titulo);
        $Categoria->bindValue(':descricao', $this->descricao);
        $Categoria->bindValue(':imagem', $this->Imagem);

        if($Categoria->execute())
            return true;
        else
            return false;

    }
    
    
    
    public function CategoriaEditar(){
        
        $sql = "UPDATE categoria SET categoria_url = :url, categoria_titulo = :titulo, categoria_descricao = :descricao, categoria_imagem = :imagem WHERE id = :id";

        $Categoria = ClassDataBase::prepare($sql);
        $Categoria->bindValue(':url', ClassTools::forURL($this->titulo));
        $Categoria->bindValue(':titulo', $this->titulo);
        $Categoria->bindValue(':descricao', $this->descricao);
        $Categoria->bindValue(':imagem', $this->Imagem);
        $Categoria->bindValue(':id', $this->id);


        if($Categoria->execute())
            return true;
        else
            return false;


    }
    
    
    
    public function CategoriaExcluir($ID = NULL){
        
        $data = self::CategoriaSelecionado($ID);
        $this->id = $ID;
        foreach($data as $value);

        $post = ClassDataBase::prepare("UPDATE posts SET post_categoria = NULL WHERE post_categoria = :url");
        $post->bindValue(':url', $value->categoria_url);

        $Arquivo = new ClassArchives();
        $Arquivo->setArquivoPath('../../'.$value->categoria_imagem);
        $Arquivo->getExcluirArquivo();
        
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

    
    
    public function CategoriaSelecionado( $where = 'id' ){
        
        $Categoria = NULL;
        
        if($where == 'id'){
            
            $sql = "SELECT * FROM categoria WHERE id = :id";
            $Categoria = ClassDataBase::prepare($sql);
            $Categoria->bindValue(':id', $this->id);
            
        }else if($where == 'url'){

            $sql = "SELECT * FROM categoria WHERE categoria_url = :url";
            $Categoria = ClassDataBase::prepare($sql);
            $Categoria->bindValue(':url', $this->url);

        }

        if($Categoria->execute()){
            return $Categoria->fetchAll();
        }else{
            return false;
        }
    }
    
    

    public static function CategoriaPostSelecionada( $Categoria = NULL, $DESC_ASC = 'DESC', $OFFSet = 0, $Limit = 6 ){
        
        $SQL = "SELECT * FROM posts WHERE post_categoria = '$Categoria' ORDER BY post_data $DESC_ASC LIMIT $OFFSet, $Limit";
        $CategoriaQuery = ClassDataBase::prepare($SQL);
        if($CategoriaQuery->execute())
            if($CategoriaQuery->rowCount() == 0)
                return false;
            else
                return $CategoriaQuery->fetchAll();
        else
            return false;
        
    }
    
    
    public static function CategoriaIdentificar($where){
        
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
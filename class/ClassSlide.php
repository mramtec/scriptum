<?php



class ClassSlide extends ClassDataBase{
    
    private $titulo;
    private $subtitulo;
    private $imagem;
    private $link;
    
    
    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setSubtitulo($subtitulo) {
        $this->subtitulo = $subtitulo;
    }

    function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    function setLink($link) {
        $this->link = $link;
    }

    
    public function getNovoSlide(){
        
        $SQL = "INSERT INTO slide (slide_titulo, slide_descricao, slide_link, slide_imagem, slide_data) VALUES (:titulo, :descricao, :link, :imagem, :data)";
        $QuerySQL = ClassDataBase::prepare($SQL);
        $QuerySQL->bindValue(':titulo', $this->titulo);
        $QuerySQL->bindValue(':descricao', $this->subtitulo);
        $QuerySQL->bindValue(':link', $this->link);
        $QuerySQL->bindValue(':imagem', $this->imagem);
        $QuerySQL->bindValue(':data', date('Y-m-d H:i:s'));
        
        if ($QuerySQL->execute()) {
            return true;
        } else {
            return false;
        }

    }
    
    
    public function getSlides($Order = 'ASC'){
        
        $SQL = "SELECT * FROM slide ORDER BY id $Order";
        $QuerySQL = ClassDataBase::prepare($SQL);
        if($QuerySQL->execute()){
            return $QuerySQL->fetchAll();
        }else{
            return false;
        }
        
    }
    
    
    public function getDeleteSlide($id){
        
        $SQL = "DELETE FROM slide WHERE id = :id";
        $QuerySQL = ClassDataBase::prepare($SQL);
        $QuerySQL->bindValue(':id', $id);
        
        if($QuerySQL->execute())
            return true;
        else {
            return false;
        }

    }
    
    
    public static function getQuantidadeSlides(){
        
        $QuerySQL = ClassDataBase::prepare("SELECT * FROM slide");
        
        if($QuerySQL->execute()){
            return $QuerySQL->rowCount();
        }else{
            return false;
        }

    }
    
    
}

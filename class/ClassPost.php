<?php

spl_autoload_register(function($class){
   require_once $class.'.php'; 
});


class ClassPost extends ClassDataBase{


    private $id;
    private $url;
    private $titulo;
    private $subtitulo;
    private $texto;
    private $tags;
    private $categoria;
    private $imagem_capa;
    private $imagem_miniatura;
    private $rascunho;
    private $agendamento;
    private $agendamento_stats;
    private $autor_id;
    private $autor_nome;
    private $status;
    private $visualizacoes;
    

    public function setID($id){
        $this->id = $id;
    }
    
    public function setURL($url){
        $this->url = $url;
    }
    
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    
    public function setSubTitulo($subtitulo){
        $this->subtitulo = $subtitulo;
    }
    
    public function setTexto($texto){
        $this->texto = $texto;
    }
    
    public function setTags($tags){
        $this->tags = $tags;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }
    
    public function setImagemCapa($imagemCapa){
        $this->imagem_capa = $imagemCapa;
    }
    
    public function setImagemMini($imagemMiniatura){
        $this->imagem_miniatura = $imagemMiniatura;
    }
    
    public function setRascunho($rascunho){
        $this->rascunho = $rascunho;
    }
    
    public function setAgendamento($agenda){
        $this->agendamento = $agenda;
    }
    
    public function setAgendamentoStats($agendaStats){
        $this->agendamento_stats = $agendaStats;
    }
    
    public function setAutorID($autorID){
        $this->autor_id = $autorID;
    }
    
    public function setAutorNome($autorNome){
        $this->autor_nome = $autorNome;
    }
    
    public function setStatus($stats){
        $this->status = $stats;
    }
    
    public function setVisualizacoes($view){
        $this->visualizacoes = $view;
    }

    
    public function PostNovo(){
        
        $sql = "INSERT INTO posts (post_url, post_titulo, post_subtitulo, post_texto, post_tags, post_categoria, post_status, post_miniatura, post_capa, post_data, post_agendamento_stats, post_agendamento, post_autor_id, post_autor_nome) "
             . "VALUES (:url, :titulo, :subtitulo, :texto, :tags, :categoria, :status, :miniatura, :capa, :data, :agendamento_stats, :agendamento, :autor_id, :autor_nome)";
        
        $post = ClassDataBase::prepare($sql);
        $post->bindValue(':url', self::post_url_edit($this->titulo));
        $post->bindValue(':titulo', $this->titulo);
        $post->bindValue(':subtitulo', $this->subtitulo);
        $post->bindValue(':texto', $this->texto);
        $post->bindValue(':tags', $this->tags);
        $post->bindValue(':categoria', $this->categoria);
        $post->bindValue(':status', $this->status);
        $post->bindValue(':miniatura', $this->imagem_miniatura);
        $post->bindValue(':capa', $this->imagem_capa);
        $post->bindValue(':data', date('Y-m-d H:i:s'));
        $post->bindValue(':agendamento_stats', $this->agendamento_stats);
        $post->bindValue(':agendamento', $this->agendamento);
        $post->bindValue(':autor_id', $this->autor_id);
        $post->bindValue(':autor_nome', $this->autor_nome);
        
        try{
            
            if($post->execute())
                return true;
            else
                return false;
            
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }
    
    
    public function PostExcluir($id){

        $post = ClassDataBase::prepare("DELETE FROM posts WHERE id = :id");
        $post->bindValue(':id', $id);
        
        if($post->execute()){
            return true;
        }else{
            return false;
        }

    }
    
    
    public function PostSelecionado( $where = 'id', $value = NULL ){
        
        if($where == 'id'){

            $Query = ClassDataBase::prepare("SELECT * FROM posts WHERE id = :id");
            $Query->bindValue(':id', $value);

        }elseif($where == 'url'){
            
            $Query = ClassDataBase::prepare("SELECT * FROM posts WHERE post_url = :url");
            $Query->bindValue(':url', $value);

        }
        
        if($Query->execute())
            return $Query->fetchAll();
        else
            return false;
    
    }
    
    
    public function PostEditar(){
        
        $sql = "UPDATE posts SET "
                . "post_url = :url, "
                . "post_titulo = :titulo, "
                . "post_subtitulo = :subtitulo, "
                . "post_texto = :texto, "
                . "post_tags = :tags, "
                . "post_categoria = :categoria, "
                . "post_status = :status, "
                . "post_miniatura = :miniatura, "
                . "post_capa = :capa, "
                . "post_agendamento_stats = :agendamento_stats, "
                . "post_agendamento = :agendamento "
                . " WHERE id = :id";
        
        $post = ClassDataBase::prepare($sql);
        $post->bindValue(':url', self::post_url_edit($this->titulo));
        $post->bindValue(':titulo', $this->titulo);
        $post->bindValue(':subtitulo', $this->subtitulo);
        $post->bindValue(':texto', $this->texto);
        $post->bindValue(':tags', $this->tags);
        $post->bindValue(':categoria', $this->categoria);
        $post->bindValue(':status', $this->status);
        $post->bindValue(':miniatura', $this->imagem_miniatura);
        $post->bindValue(':capa', $this->imagem_capa);
        $post->bindValue(':agendamento_stats', $this->agendamento_stats);
        $post->bindValue(':agendamento', $this->agendamento);
        $post->bindValue(':id', $this->id);
        
        if($post->execute()){
            return true;
        }else{
            return false;
        }

    }
    
    
    public function PostApagarImagem($ID, $Value){
        
        if($Value == 'capa'){
            $Query = ClassDataBase::prepare("UPDATE posts SET post_capa = NULL WHERE id = :id");
            $Query->bindValue(':id', $ID);
            if($Query->execute())
                return true;
            else
                return false;            
        }
        if($Value == 'mini'){
            $Query = ClassDataBase::prepare("UPDATE posts SET post_miniatura = NULL WHERE id = :id");
            $Query->bindValue(':id', $ID);
            if($Query->execute())
                return true;
            else
                return false;            
        }

    }
    
    
    public function PostVisualizacoes(){
        
        $post = ClassDataBase::prepare("UPDATE posts SET post_visualizacoes = :num WHERE id = :id");
        $post->bindValue(':num', $this->visualizacoes);
        $post->bindValue(':id', $this->id);
        if($post->execute())
            return true;
        else 
            return false;

    }    
    
    
    public function post_update_imagem(string $opcao, int $id){
        if($opcao == "miniatura"){

            $update = ClassDataBase::prepare("UPDATE posts SET post_miniatura = :miniatura WHERE id = :id");
            $update->bindValue(":miniatura", "");

        }else if($opcao == "capa"){

            $update = ClassDataBase::prepare("UPDATE posts SET post_capa = :capa WHERE id = :id");
            $update->bindValue(":capa", "");
            
        }else{
            return false;
        }
        
        $update->bindValue(":id", $id);

        if($update->execute())
            return true;
        else
            return false;

    }


    public static function post_url_edit($str, $replace = array(), $delimiter="_"){
        
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


    public function post_subs_rasc(int $id){
        
        $data = self::post_selecionado($id);
        
        if($data->status == 1)
            $status = 0;
        else
            $status = 1;
        
        
        $sql = "UPDATE posts SET post_status = :status WHERE id = :id";
        $post = ClassDataBase::prepare($sql);
        $post->bindValue(':status', $status);
        $post->bindValue(':id', $id);
        
        if($post->execute())
            return true;
        else
            return false;

    }
    
    
    public function post_todos( $offset, $status = 1, $limite = 4, $order_by = false, $random = false){
        
        if($status == 1){
            $status_opt = "WHERE post_status = 1";
        }elseif($status == 0){
            $status_opt = "WHERE post_status = 0";
        }elseif($status == 2)
            $status_opt = "";
        
        if($order_by == true){
            $order_by = "post_visualizacoes";
        }else if($order_by == false && $random == false){
            $order_by = "post_data";
        }else if($order_by == false && $random == true){
            $order_by = "RAND()";
        }
        $data_hoje = date('Y-m-d H:i:s');
        
        $sql = "SELECT * FROM posts $status_opt ORDER BY $order_by DESC LIMIT $offset, $limite";
        $post = ClassDataBase::prepare($sql);
        
        if($post->execute()){
            if($post->rowCount() == 0)
                return false;
            else
                return $post->fetchAll();
        }else{
            return false;
        }
        
    }
    
    
    public function post_selecionado( $where = 'id' ){
        
        if($where == 'id'){

            $post = ClassDataBase::prepare("SELECT * FROM posts WHERE id = :id");
            $post->bindValue(':id', $this->id);

        }else if($where == 'url'){

            $post = ClassDataBase::prepare("SELECT * FROM posts WHERE post_url = :url");
            $post->bindValue(':url', $this->url);

        }

        if($post->execute())
            return $post->fetchAll();
        else
            return false;
        
    }
    
    
    public function post_buscar( string $like ){
        $sql = "SELECT * FROM posts WHERE post_titulo LIKE '%{$like}%' OR (post_tags LIKE '%{$like}%') ORDER BY post_data DESC LIMIT 4";
        $post = ClassDataBase::prepare($sql);
        $post->execute();
        
        if($post->rowCount() == 0){
            return false;
        }else{
            return $post->fetchAll();
        }
    }
    
    
    public static function post_publicar_agendamento(){
        
        $postFecth = ClassDataBase::prepare("SELECT id, post_agendamento_stats, post_agendamento FROM posts");
        if($postFecth->execute()){
            $data = $postFecth->fetchAll();
            
            foreach($data as $value){
                
                if($value->post_agendamento_stats == 1){
                    if($value->post_agendamento <= date('Y-m-d H:i:s')){
                        $update = ClassDataBase::prepare("UPDATE posts SET post_agendamento_stats = 0, post_agendamento = null WHERE id = $value->id");
                        $update->execute();
                    }
                }
            }
            
        }
    }
    
    public function post_publicar_agora(){
        
        $sql = "UPDATE posts SET post_agendamento_stats = :agendamento_stats, post_agendamento = :agendamento WHERE id = :id";
        $post = ClassDataBase::prepare($sql);
        $post->bindValue(':agendamento_stats', $this->agendamento_stats);
        $post->bindValue(':agendamento', $this->agendamento);
        $post->bindValue(':id', $this->id);
        
        if($post->execute())
            return true;
        else
            return false;

    }
    
    
    public function post_visualizacoes(){
        
        $post = ClassDataBase::prepare("UPDATE posts SET post_visualizacoes = :num WHERE id = :id");
        $post->bindValue(':num', $this->visualizacoes);
        $post->bindValue(':id', $this->id);
        if($post->execute())
            return true;
        else 
            return false;

    }
/*    
    public function post_data(){
        //$inicio = "2017-05-15";
        $data_hoje = date("Y-m-d H:i:s");
        $sql = "SELECT * FROM posts WHERE data <= '{$data_hoje}'";
        $post = DB::prepare($sql);
        $post->execute();
        
        if($post->rowCount() == 0){
            return "sem valores";
        }else{
            return $post->fetchAll();
        }
        
    }
*/
}

<?php

spl_autoload_register(function($class){
   require_once $class.'.php'; 
});


class ClassUsers extends ClassDataBase {
    
    public $id;
    public $url;
    public $nome;
    public $apelido;
    public $opcao_nome;     #Deprecated.
    public $exibicao;
    public $descricao;
    public $descricao_bibliografica;
    public $senha;
    public $email;
    public $privilegio;
    public $acesso;
    public $capa_arquivo;
    public $perfil_arquivo;
    public $data_convite;
    
    private $ID;
    private $URL;
    private $Nome;
    private $Apelido;
    private $Exibicao;
    private $Descricao;
    private $Biografia;
    private $Senha;
    private $Email;
    private $Privilegio;
    private $Acesso;
    private $Capa;
    private $Perfil;
    
    
    public function setID($id){
        $this->ID = $id;
    }
    
    public function setURL($url){
        $this->URL = $url;
    }
    
    public function setNome($nome){
        $this->Nome = $nome;
    }
    
    
    public function setApelido($apelido){
        $this->Apelido = $apelido;
    }
    
    
    public function setExibicao($exibicao){
        $this->Exibicao = $exibicao;
    }
    
    
    public function setDescricao($descricao){
        $this->Descricao = $descricao;
    }
    
    
    public function setBiografia($biografia){
        $this->Biografia = $biografia;
    }
    
    
    public function setSenha($senha){
        $this->Senha = $senha;
    }
    
    
    public function setEmail($mail){
        $this->Email = $mail;
    }
    
    
    public function setPrivilegio($privilegio){
        $this->Privilegio = $privilegio;
    }
    
    
    public function setAcesso($acesso){
        $this->Acesso = $acesso;
    }
    
    
    public function setCapa($capa){
        $this->Capa = $capa;
    }
    
    
    public function setPerfil($perfil){
        $this->Perfil = $perfil;
    }
    
    
    public function UserEditar( $pass = FALSE ){
        
        $sql = NULL;
        
        if( $pass === TRUE ){
            $sql = "UPDATE usuarios SET "
                    . "usuario_url = :url, "
                    . "usuario_nome = :nome, "
                    . "usuario_apelido = :apelido, "
                    . "usuario_descricao = :descricao, "
                    . "usuario_sobre = :sobre, "
                    . "usuario_senha = :senha "
                    . "WHERE id = :id";
        }else{
            $sql = "UPDATE usuarios SET "
                    . "usuario_url = :url, "
                    . "usuario_nome = :nome, "
                    . "usuario_apelido = :apelido, "
                    . "usuario_descricao = :descricao, "
                    . "usuario_sobre = :sobre "
                    . "WHERE id = :id";
        }

        $users = ClassDataBase::prepare($sql);
        $users->bindValue(":url", ClassPost::post_url_edit($this->Nome));
        $users->bindValue(":nome", $this->Nome);
        $users->bindValue(":apelido", $this->Apelido);
        $users->bindValue(":descricao", $this->Descricao);
        $users->bindValue(":sobre", $this->Biografia);
        if($pass === TRUE){ $users->bindValue(":senha", md5($this->Senha)); }
        $users->bindValue(":id", $this->ID);

        if($users->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    
    public function UserPerfil(){
        
        $sql = NULL;
        $Query = NULL;
        
        $sql = "UPDATE usuarios SET usuario_perfil = :perfil WHERE id = :id";
        $Query = ClassDataBase::prepare($sql);
        $Query->bindValue(':perfil', $this->Perfil);
        $Query->bindValue(':id', $this->ID);
        
        if($Query->execute()){
            
            if(session_status() == 1 || session_status() == 0) session_start();
            $_SESSION['usuarioFoto'] = $this->Perfil;
            return true;

        }else
            return false;

    }
    
    
    public function UserCapa(){
        
        $sql = NULL;
        $Query = NULL;
        
        $sql = "UPDATE usuarios SET usuario_capa = :capa WHERE id = :id";
        $Query = ClassDataBase::prepare($sql);
        $Query->bindValue(':capa', $this->Capa);
        $Query->bindValue(':id', $this->ID);
        
        if($Query->execute()){

            if(session_status() == 1 || session_status() == 0) session_start();
            $_SESSION['usuarioCapa'] = $this->Capa;
            return true;

        }else
            return false;

    }

    
    public function UserExibirSelecionado( $ID = NULL, $UserURL = false ){
        
        if( $ID != NULL ) $this->ID = $ID;

        if($UserURL == TRUE){

            $users = ClassDataBase::prepare("SELECT * FROM usuarios WHERE usuario_url = :url LIMIT 1");
            $users->bindValue(":url", $this->URL);

        }else{

            $users = ClassDataBase::prepare("SELECT * FROM usuarios WHERE id = :id LIMIT 1");
            $users->bindValue(":id", $this->ID);
            
        }
        
            if($users->execute()){
                return $users->fetchAll();
            }else{
                return false;
            }        

    }
    
    
    public function UsersAll($offset = 0, $limite = 6, $OrderBy = 'ORDER BY id DESC'){
        
        $users = ClassDataBase::prepare("SELECT * FROM usuarios {$OrderBy} LIMIT {$offset}, {$limite}");
        $users->execute();
        
        if($users->rowCount() == 0)
            return false;
        else
            return $users->fetchAll();
    }
            
    
    public function users_exibir_todos( $offset ){
        
        $users = ClassDataBase::prepare("SELECT * FROM usuarios ORDER BY usuario_cadastro DESC LIMIT {$offset}, 6");
        $users->execute();
        
        if($users->rowCount() == 0)
            return false;
        else
            return $users->fetchAll();

    }
    
   
    public function users_editar( $pass = false ){                // Se a opção for 1, entao a alteração da senha é aplicada.
        
        if($pass == true){
            $sql = "UPDATE usuarios SET usuario_url = :url, usuario_nome = :nome, usuario_apelido = :apelido, usuario_capa = :capa, usuario_perfil = :perfil, usuario_descricao = :descricao, usuario_sobre = :sobre, usuario_senha = :senha WHERE id = :id";
        }else{
            $sql = "UPDATE usuarios SET usuario_url = :url, usuario_nome = :nome, usuario_apelido = :apelido, usuario_capa = :capa, usuario_perfil = :perfil, usuario_descricao = :descricao, usuario_sobre = :sobre WHERE id = :id";
        }
        
        $users = ClassDataBase::prepare($sql);
        $users->bindValue(":url", ClassPost::post_url_edit($this->nome));
        $users->bindValue(":nome", $this->nome);
        $users->bindValue(":apelido", $this->apelido);
        $users->bindValue(":capa", $this->capa_arquivo);
        $users->bindValue(":perfil", $this->perfil_arquivo);
        $users->bindValue(":descricao", $this->descricao);
        $users->bindValue(":sobre", $this->descricao_bibliografica);

        if($pass == true) $users->bindValue(":senha", md5($this->senha));
        
        $users->bindValue(":id", $this->id);
        
        if($users->execute()){
            
            if(session_status() == 1 || session_status() == 0) session_start();
            $_SESSION['usuarioNome'] = $this->nome;
            $_SESSION['usuarioFoto'] = $this->perfil_arquivo;
            $_SESSION['usuarioCapa'] = $this->capa_arquivo;
            return true;

        }else{
            return false;
        }
    }
    
    
    public function users_novo(){
        
        $sql = "INSERT INTO usuarios (usuario_url, usuario_nome, usuario_apelido, usuario_exibicao, usuario_senha, usuario_email, usuario_descricao, usuario_privilegio, usuario_acesso, usuario_cadastro) "
             . "VALUES (:url, :nome, :apelido, :exibicao, :senha, :email, :descricao, :privilegio, :acesso, :cadastro)";
        
        $user = ClassDataBase::prepare($sql);
        $user->bindValue(':url', ClassPost::post_url_edit($this->nome));
        $user->bindValue(':nome', $this->nome);
        $user->bindValue(':apelido', $this->apelido);
        $user->bindValue(':exibicao', $this->nome);
        $user->bindValue(':senha', md5($this->senha));
        $user->bindValue(':email', $this->email);
        $user->bindValue(':descricao', $this->descricao);
        $user->bindValue(':privilegio', $this->privilegio);
        $user->bindValue(':acesso', $this->acesso);
        $user->bindValue(':cadastro', date('Y-m-d H:i:s'));

        if($user->execute())
            return true;
        else
            return false;
    }
    
    
    public function users_excluir( $id ){
        $sql = "DELETE FROM usuarios WHERE id = $id";
        $user = ClassDataBase::prepare($sql);
        if($user->execute())
            return true;
        else
            return false;
    }
    
    
    public function users_alt_privileg(){
        $sql = "UPDATE usuarios SET usuario_privilegio = :privilegio WHERE id = :id";
        $user = ClassDataBase::prepare($sql);
        $user->bindValue(":privilegio", $this->privilegio);
        $user->bindValue(":id", $this->id);
        
        if($user->execute())
            return true;
        else
            return false;
    }
    
    
    public function users_alt_apelido( $string ){
        $sql = "UPDATE usuarios SET usuario_exibicao = :escolha WHERE id = :id";
        $user = ClassDataBase::prepare($sql);
        $user->bindValue(":escolha", $string);
        $user->bindValue(":id", $this->id);
        
        if($user->execute())
            return true;
        else
            return false;
    }
    
    
    public function users_alt_acesso(){
        $sql = "UPDATE usuarios SET usuario_acesso = :acesso WHERE id = :id";
        $user = ClassDataBase::prepare($sql);
        $user->bindValue(":acesso", $this->acesso);
        $user->bindValue(":id", $this->id);
        
        if($user->execute())
            return true;
        else
            return false;
    }
    

    
    public function users_buscar( $like ){
        $sql = "SELECT * FROM usuarios WHERE usuario_nome LIKE '%{$like}%' OR (usuario_apelido LIKE '%{$like}%') ORDER BY usuario_cadastro DESC LIMIT 4";
        $post = ClassDataBase::prepare($sql);
        $post->execute();
        
        if($post->rowCount() == 0){
            return false;
        }else{
            return $post->fetchAll();
        }
    }   

    
    public static function users_login_profile( $email){
        
        $sql = "SELECT usuario_perfil, usuario_capa FROM usuarios WHERE usuario_email = :email LIMIT 1";
        $users = ClassDataBase::prepare($sql);
        $users->bindValue(':email', $email);
        if($users->execute()){
            if($users->rowCount() != 0)
                return $users->fetchAll();
            else
                return false;
        }else{
            return false;
        }
        
    }
}
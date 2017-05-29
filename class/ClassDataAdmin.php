<?php

spl_autoload_register(function($class){
   require_once $class.'.php'; 
});

class ClassDataAdmin extends ClassDataBase{


    private $NameTable;
    private $Email;
    private $Password;
    private $Name;

    public function setEmail($mail){
        $this->Email = $mail;
    }
    
    
    public function setPass($pass){
        $this->Password = $pass;
    }
    
    
    public function setName($nome){
        $this->Name = $nome;
    }
    
    public function setNameTable($table){
        $this->NameTable = $table;
    }
    
    
    public static function getExistTable( $Like = NULL ){
        
        $sql = NULL;
        
        if($Like == NULL){
            $sql = "SHOW TABLES LIKE '$this->NameTable'";
        }else{
            $sql = "SHOW TABLES LIKE '$Like'";
        }

        $Table = ClassDataBase::prepare($sql);
        if($Table->execute()){
            
            if($Table->rowCount() > 0)
                return true;
            else
                return false;
            
        }else{
            return false;
        }
    }
    
    
    public function getRowsTable(){

        $Table = ClassDataBase::prepare("SHOW TABLES");
        if($Table->execute()){
            
            if($Table->rowCount() == 0)
                return 'empty';
            else
                return true;

        }
    }
    
    
    public function getCreateTable(){
        
    }
    
    
    public function getCreateDefaultTables(){
        
        $AcessoSQL = "CREATE TABLE acessos (
                        id INT NOT NULL AUTO_INCREMENT,
                        acesso_nome VARCHAR(255) NOT NULL,
                        acesso_id INT NOT NULL,
                        acesso_data DATETIME NOT NULL,
                        acesso_descricao VARCHAR(255) NULL,
                        PRIMARY KEY (id)
                    );";

        
        $AtividadeSQL = "CREATE TABLE atividades (
                            id INT NOT NULL AUTO_INCREMENT,
                            atividade_usuario_id INT NOT NULL,
                            atividade_usuario_nome VARCHAR(255) NOT NULL,
                            atividade_descricao VARCHAR(255) NULL,
                            atividade_hora DATETIME NOT NULL,
                            PRIMARY KEY(id)
                        )";


        $CategoriaSQL = "CREATE TABLE categoria(
                            id INT NOT NULL AUTO_INCREMENT,
                            categoria_url VARCHAR(255) NOT NULL,
                            categoria_titulo VARCHAR(255) NOT NULL,
                            categoria_descricao VARCHAR(255) NULL,
                            PRIMARY KEY (id)
                        )";
        
        
        $ConfigMailSQL = "CREATE TABLE config_email(
                            id INT NOT NULL AUTO_INCREMENT,
                            config_mail_host VARCHAR(255) NULL DEFAULT NULL,
                            config_mail_username VARCHAR(255) NULL DEFAULT NULL,
                            config_mail_smtp_auth VARCHAR(255) NULL DEFAULT NULL,
                            config_mail_password VARCHAR(255) NULL DEFAULT NULL,
                            config_mail_smtp_secure BOOL NULL DEFAULT NULL,
                            config_mail_port INT NULL DEFAULT NULL,
                            config_mail_origem VARCHAR(255) NULL DEFAULT NULL,
                            PRIMARY KEY (id)
                        )";

        $ConviteSQL =   "CREATE TABLE convites(
                            id INT NOT NULL AUTO_INCREMENT,
                            convite_email VARCHAR(255) NOT NULL,
                            convite_privilegio VARCHAR(100) NOT NULL DEFAULT 'convidado',
                            convite_codigo VARCHAR(255) NOT NULL,
                            convite_data DATETIME NOT NULL,
                            PRIMARY KEY (id)
                        )";


        $PostSQL =  "CREATE TABLE posts(
                        id INT NOT NULL AUTO_INCREMENT,
                        post_url VARCHAR(255) NOT NULL,
                        post_titulo VARCHAR (255) NOT NULL,
                        post_subtitulo VARCHAR(255) NOT NULL,
                        post_texto TEXT NULL,
                        post_tags VARCHAR(255) NULL,
                        post_categoria VARCHAR(100) NULL,
                        post_status BOOL NOT NULL DEFAULT '1',
                        post_miniatura TEXT NULL,
                        post_capa TEXT NULL,
                        post_data DATETIME NOT NULL,
                        post_agendamento_stats BOOL NULL DEFAULT '0',
                        post_agendamento VARCHAR(100) NULL,
                        post_autor_id INT NOT NULL,
                        post_autor_nome	VARCHAR(255) NULL,
                        post_visualizacoes	INT NULL DEFAULT '0',
                        PRIMARY KEY (id)
                    )";

        $UsuarioSQL =  "CREATE TABLE usuarios(
                            id INT NOT NULL AUTO_INCREMENT,
                            usuario_url VARCHAR(255) NOT NULL,
                            usuario_nome VARCHAR(255) NULL,
                            usuario_apelido VARCHAR(255) NULL,
                            usuario_sexo VARCHAR(50) NULL,
                            usuario_senha VARCHAR(255) NOT NULL,
                            usuario_email VARCHAR(255) NOT NULL,
                            usuario_capa TEXT NULL,
                            usuario_perfil TEXT NULL,
                            usuario_descricao VARCHAR(255) NULL,
                            usuario_sobre TEXT NULL,
                            usuario_privilegio VARCHAR(100) NOT NULL DEFAULT 'convidado',
                            usuario_acesso VARCHAR(3) NULL,
                            usuario_cadastro DATETIME NULL,
                            usuario_ult_acesso DATETIME NULL,
                            PRIMARY KEY (id)
                        )";

        $SlideSQL = "CREATE TABLE slide (
                        id INT NOT NULL AUTO_INCREMENT,
                        slide_titulo VARCHAR(255) NOT NULL,
                        slide_descricao VARCHAR(255) NULL,
                        slide_link TEXT NULL,
                        slide_imagem TEXT NOT NULL,
                        slide_data DATETIME NOT NULL,
                        PRIMARY KEY (id)
                    )";
        
        if(!self::getExistTable('acessos')){
            $AcessoQuery = ClassDataBase::prepare($AcessoSQL);
            $AcessoQuery->execute();
        }
        
        
        if(!self::getExistTable('atividades')){
            $AtividadeQuery = ClassDataBase::prepare($AtividadeSQL);
            $AtividadeQuery->execute();
        }
        
        if(!self::getExistTable('categoria')){
            $CategoriaQuery = ClassDataBase::prepare($CategoriaSQL);
            $CategoriaQuery->execute();
        }
        
        if(!self::getExistTable('config_email')){
            $ConfigMailQuery = ClassDataBase::prepare($ConfigMailSQL);
            $ConfigMailQuery->execute();
        }
        
        if(!self::getExistTable('convites')){
            $ConvitesQuery = ClassDataBAse::prepare($ConviteSQL);
            $ConvitesQuery->execute();
        }
        
        if(!self::getExistTable('posts')){
            $PostQuery = ClassDataBase::prepare($PostSQL);
            $PostQuery->execute();
        }
        
        if(!self::getExistTable('slide')){
            $SlideQuery = ClassDataBase::prepare($SlideSQL);
            $SlideQuery->execute();
        }
        
        if(!self::getExistTable('usuarios')){
            
            $UsuarioQuery = ClassDataBase::prepare($UsuarioSQL);
            
            if($UsuarioQuery->execute())
                $InsertUser = ClassDataBase::prepare ("INSERT INTO usuarios "
                        . "(usuario_url, usuario_nome, usuario_senha, usuario_email, usuario_privilegio, usuario_acesso)"
                        . " VALUES (:url, :nome, :senha, :email, :privilegio, :acesso)");
                
                $InsertUser->bindValue(':url', ClassPost::post_url_edit($this->Name));
                $InsertUser->bindValue(':nome', $this->Name);
                $InsertUser->bindValue(':senha', md5($this->Password));
                $InsertUser->bindValue(':email', $this->Email);
                $InsertUser->bindValue(':privilegio', 'administrador');
                $InsertUser->bindValue(':acesso', 1);

                if($InsertUser->execute())
                    return true;
                else
                    return false;
        }

    }

}

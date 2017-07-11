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
    
    
    
    public function getCreateDefaultTables(){
        
        $PostSQL =  "CREATE TABLE IF NOT EXISTS `posts` (
                        `id` INT NOT NULL AUTO_INCREMENT,
                        `post_url` VARCHAR(255) NOT NULL,
                        `post_titulo` VARCHAR(255) NOT NULL,
                        `post_subtitulo` VARCHAR(255) NULL,
                        `post_texto` LONGTEXT NULL,
                        `post_tags` VARCHAR(255) NULL,
                        `post_categoria_id` INT NULL,
                        `post_categoria` VARCHAR(255) NULL,
                        `post_status` TINYINT NOT NULL DEFAULT 1,
                        `post_miniatura` LONGTEXT NULL,
                        `post_capa` LONGTEXT NULL,
                        `post_data` DATETIME NULL,
                        `post_agendamento_stats` TINYINT NULL,
                        `post_agendamento` VARCHAR(100) NULL,
                        `post_autor_id` INT NULL,
                        `post_autor_nome` VARCHAR(255) NULL,
                        `post_visualizacoes` INT NULL DEFAULT 0,
                        PRIMARY KEY (`id`))
                      ENGINE = InnoDB";

        $PostQuery = ClassDataBase::prepare($PostSQL);
        $PostQuery->execute();

        
        
        
        $AcessoSQL = "CREATE TABLE IF NOT EXISTS `acessos` (
                        `id` INT NOT NULL AUTO_INCREMENT,
                        `acesso_nome` VARCHAR(255) NULL,
                        `acesso_id` INT NOT NULL,
                        `acesso_data` DATETIME NOT NULL,
                        `acesso_descricao` VARCHAR(255) NULL,
                        PRIMARY KEY (`id`, `acesso_id`))
                      ENGINE = InnoDB";

        $AcessoQuery = ClassDataBase::prepare($AcessoSQL);
        $AcessoQuery->execute();
        
        
        
        $AtividadeSQL = "CREATE TABLE IF NOT EXISTS `atividades` (
                            `id` INT NOT NULL AUTO_INCREMENT,
                            `atividade_usuario_id` INT NOT NULL,
                            `atividade_usuario_nome` VARCHAR(255) NULL,
                            `atividade_descricao` VARCHAR(255) NULL,
                            `atividade_hora` DATETIME NOT NULL,
                            PRIMARY KEY (`id`, `atividade_usuario_id`))
                          ENGINE = InnoDB";

        $AtividadeQuery = ClassDataBase::prepare($AtividadeSQL);
        $AtividadeQuery->execute();

        

        $CategoriaSQL = "CREATE TABLE IF NOT EXISTS `categoria` (
                            `id` INT NOT NULL AUTO_INCREMENT,
                            `categoria_url` VARCHAR(255) NOT NULL,
                            `categoria_titulo` VARCHAR(255) NOT NULL,
                            `categoria_descricao` VARCHAR(255) NULL,
                            `categoria_imagem` LONGTEXT NULL,
                            PRIMARY KEY (`id`)
                        )ENGINE = InnoDB";
        
        $CategoriaQuery = ClassDataBase::prepare($CategoriaSQL);
        $CategoriaQuery->execute();

        
        
        $SubCategoriasSQL = "CREATE TABLE IF NOT EXISTS `subcategoria` (
                                `id` INT NOT NULL AUTO_INCREMENT,
                                `id_categoria` INT NOT NULL,
                                `subcategoria_url` VARCHAR(255) NOT NULL,
                                `subcategoria_titulo` VARCHAR(255) NOT NULL,
                                `subcategoria_descricao` VARCHAR(255) NULL,
                                `subcategoria_imagem` LONGTEXT NULL,
                                PRIMARY KEY (`id`)
                            )ENGINE = InnoDB;";

        $SubCategoriasQuery = ClassDataBase::prepare($SubCategoriasSQL);
        $SubCategoriasQuery->execute();
        
        

        $ConfigMailSQL = "CREATE TABLE IF NOT EXISTS `config_email` (
                            `id` INT NOT NULL AUTO_INCREMENT,
                            `config_mail_host` VARCHAR(255) NULL,
                            `config_mail_username` VARCHAR(255) NULL,
                            `config_mail_smtp_auth` VARCHAR(255) NULL,
                            `config_mail_password` VARCHAR(255) NULL,
                            `config_mail_smtp_secure` TINYINT NULL,
                            `config_mail_port` INT NULL,
                            `config_mail_origem` VARCHAR(255) NULL,
                            PRIMARY KEY (`id`))
                          ENGINE = InnoDB;";

        $ConfigMailQuery = ClassDataBase::prepare($ConfigMailSQL);
        $ConfigMailQuery->execute();
        
        

        $UsuarioSQL =  "CREATE TABLE IF NOT EXISTS `usuarios` (
                        `id` INT NOT NULL AUTO_INCREMENT,
                        `usuario_url` VARCHAR(255) NULL,
                        `usuario_nome` VARCHAR(255) NULL,
                        `usuario_apelido` VARCHAR(255) NULL,
                        `usuario_sexo` VARCHAR(255) NULL,
                        `usuario_senha` VARCHAR(255) NOT NULL,
                        `usuario_email` VARCHAR(255) NOT NULL,
                        `usuario_capa` LONGTEXT NULL,
                        `usuario_perfil` LONGTEXT NULL,
                        `usuario_descricao` VARCHAR(255) NULL,
                        `usuario_sobre` LONGTEXT NULL,
                        `usuario_privilegio` VARCHAR(100) NOT NULL DEFAULT 'administrador',
                        `usuario_acesso` TINYINT NOT NULL DEFAULT '1' COMMENT 'Acesso é um valor booleano para definir se pode ou não acessar o sistema.',
                        `usuario_cadastro` DATETIME NULL,
                        `usuario_ult_acesso` DATETIME NULL,
                        PRIMARY KEY (`id`),
                        UNIQUE INDEX `id_UNIQUE` (`id` ASC))
                      ENGINE = InnoDB";

        $UsuarioQuery = ClassDataBase::prepare($UsuarioSQL);
        $UsuarioQuery->execute();



        $ConviteSQL =   "CREATE TABLE convites(
                            id INT NOT NULL AUTO_INCREMENT,
                            convite_email VARCHAR(255) NOT NULL,
                            convite_privilegio VARCHAR(100) NOT NULL DEFAULT 'convidado',
                            convite_codigo VARCHAR(255) NOT NULL,
                            convite_data DATETIME NOT NULL,
                            PRIMARY KEY (id)
                        )";

        $ConvitesQuery = ClassDataBAse::prepare($ConviteSQL);
        $ConvitesQuery->execute();



        $SlideSQL = "CREATE TABLE IF NOT EXISTS `slide` (
                        `id` INT NOT NULL AUTO_INCREMENT,
                        `slide_titulo` VARCHAR(255) NOT NULL,
                        `slide_descricao` VARCHAR(255) NULL,
                        `slide_link` LONGTEXT NULL,
                        `slide_imagem` LONGTEXT NOT NULL,
                        `slide_data` DATETIME NOT NULL,
                        PRIMARY KEY (`id`))
                      ENGINE = InnoDB";

        $SlideQuery = ClassDataBase::prepare($SlideSQL);
        $SlideQuery->execute();
        
        
//
//
//        
//        $FK_Usuarios_and_Posts = "CREATE TABLE IF NOT EXISTS `usuarios_has_posts` (
//                                `usuarios_id` INT NOT NULL,
//                                `posts_id` INT NOT NULL,
//                                PRIMARY KEY (`usuarios_id`, `posts_id`),
//                                INDEX `fk_usuarios_has_posts_posts1_idx` (`posts_id` ASC),
//                                INDEX `fk_usuarios_has_posts_usuarios1_idx` (`usuarios_id` ASC),
//                                CONSTRAINT `fk_usuarios_has_posts_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`)
//                                  ON DELETE NO ACTION
//                                  ON UPDATE NO ACTION,
//                                CONSTRAINT `fk_usuarios_has_posts_posts1` FOREIGN KEY (`posts_id`) REFERENCES `posts` (`id`)
//                                  ON DELETE NO ACTION
//                                  ON UPDATE NO ACTION)
//                              ENGINE = InnoDB";
//
//        $FK_Usuarios_and_PostsQuery = ClassDataBase::prepare($FK_Usuarios_and_Posts);
//        $FK_Usuarios_and_PostsQuery->execute();

        /* Fim da execução dos scripts SQL */

        

        $InsertUser = ClassDataBase::prepare ("INSERT INTO usuarios "
                . "(usuario_url, usuario_nome, usuario_senha, usuario_email, usuario_privilegio, usuario_acesso)"
                . " VALUES (:url, :nome, :senha, :email, :privilegio, :acesso)");

        $InsertUser->bindValue(':url', ClassTools::forURL($this->Name));
        $InsertUser->bindValue(':nome', $this->Name);
        $InsertUser->bindValue(':senha', md5($this->Password));
        $InsertUser->bindValue(':email', $this->Email);
        $InsertUser->bindValue(':privilegio', 'administrador');
        $InsertUser->bindValue(':acesso', 1);

        if($InsertUser->execute()){
            
            $AtividadeInsertSQL = "INSERT INTO atividades (atividade_usuario_id, atividade_usuario_nome, atividade_descricao, atividade_hora)"
                          . "VALUES (:usuario_id, :usuario_nome, :atividade_descricao, :atividade_hora)";
            
            $AtividadeInsertQuery = ClassDataBase::prepare($AtividadeInsertSQL);
            $AtividadeInsertQuery->bindValue(':usuario_id', 1);
            $AtividadeInsertQuery->bindValue(':usuario_nome', $this->Name);
            $AtividadeInsertQuery->bindValue(':atividade_descricao', 'Usuário '.$this->Name.' instalou o sistema.');
            $AtividadeInsertQuery->bindValue(':atividade_hora', date('Y-m-d H:i:s'));
            $AtividadeInsertQuery->execute();

            return true;
        }else
            return false;
        

    }

}

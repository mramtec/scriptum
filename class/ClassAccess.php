<?php

spl_autoload_register(function($class){
   require_once $class.'.php'; 
});


class ClassAccess extends ClassDataBase {
    
    private $AccessName;
    private $AccessID;
    private $AccessProfilePic;
    private $AccessDescription;
    private $email;
    private $senha;
    public $privilegio;
    public $acesso;
    
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    
    public function setSenha($senha){
        $this->senha = md5($senha);
    }
    
    
    public function access_verifica(){
      
        $sql = "SELECT * FROM usuarios WHERE usuario_email = :email AND usuario_senha = :senha LIMIT 1";
        $access = ClassDataBase::prepare($sql);
        $access->bindValue(':email', $this->email);
        $access->bindValue(':senha', $this->senha);
        $access->execute();
        
        if($access->rowCount() == 0){
            return false;
        }else{
            
            $data = $access->fetchAll();
            
            foreach ($data as $value);
            
            if($this->email == $value->usuario_email && $this->senha == $value->usuario_senha){
                
                date_default_timezone_set('America/Bahia');

                if(session_status() != 2) session_start();
                
                $_SESSION['usuarioID'] = $value->id;
                $_SESSION['usuarioFoto'] = $value->usuario_perfil;
                $_SESSION['usuarioNome'] = $value->usuario_nome;
                $_SESSION['usuarioCapa'] = $value->usuario_capa;
                $_SESSION['usuarioEmail'] = $value->usuario_email;
                $_SESSION['privilegio'] = $value->usuario_privilegio;
                $_SESSION['usuarioSessionID'] = session_id();
                $_SESSION['usuarioTime'] = date('H:i:s');
                
                self::access_registry($value->id);
                
                $this->AccessID = $value->id;
                $this->AccessName = $value->usuario_nome;
                $this->AccessProfilePic = $value->usuario_perfil;
                $this->AccessDescription = 'Fez login no sistema.';
                self::AccessRegistry();

                return true;

            }else{
                return false;
            }

        }
    }
    
    
    public function access_verif_permiss(){

        $access = ClassDataBase::prepare("SELECT usuario_nome, usuario_acesso, usuario_perfil FROM usuarios WHERE usuario_email = :email LIMIT 1");
        $access->bindValue(':email', $this->email);

        if($access->execute()){
            
            if($access->rowCount() != 0){
                $data = $access->fetchAll();
                
                foreach($data as $value):                
                    if($value->usuario_acesso == 0)
                        return 'name='.base64_encode($value->nome).'&access=0&profile'.base64_encode($value->perfil);
                    else
                        return true;
                    
                endforeach;
                
            }else{
                return false;
            }

        }else
            return false;
    }
    
    
    public static function access_prot_pag(){
        
        self::access_check_status();
        
        if(!isset($_SESSION['usuarioID'])){
            
            if(isset($_SESSION['usuarioID']))
                unset($_SESSION['usuarioID']);
            
            if(isset($_SESSION['usuarioFoto']))
                unset($_SESSION['usuarioFoto']);
            
            if(isset($_SESSION['usuarioNome']))
                unset($_SESSION['usuarioNome']);
            
            if(isset($_SESSION['usuarioCapa']))
                unset($_SESSION['usuarioCapa']);
            
            if(isset($_SESSION['usuarioEmail']))
                unset($_SESSION['usuarioEmail']);
            
            if(isset($_SESSION['privilegio']))
                unset($_SESSION['privilegio']);
            
            if(isset($_SESSION['usuarioTime']))
                unset($_SESSION['usuarioTime']);
            
            session_unset();
            
            header('Location: ' . ACCESS_LOGIN_PAGE. '?access=not_authorized');
        }
    }
    
    
    public static function access_check_privileg(){

        if($_SESSION['privilegio'] == 'convidado'){
            header('Location: ' . ACCESS_ADMIN_PAGE);
        }

    }


    public static function access_check_status(){
        
        date_default_timezone_set('America/Bahia');
           
        $horario1 = $_SESSION['usuarioTime'];//'12:00:00'; // logou.
        $horario2 = date('H:i:s');//'12:30:00'; // hora atual.
        $timeOut = strtotime($horario2) - strtotime($horario1);

        if($timeOut >= 10){

            $access = ClassDataBase::prepare("SELECT usuario_acesso, usuario_privilegio FROM usuarios WHERE id = :id");
            $access->bindValue(':id', $_SESSION['usuarioID']);
            if($access->execute()){   


                $data = $access->fetchAll();

                foreach($data as $value){
                    if($value->usuario_acesso == 0){
                        self::access_logout(1);
                    }else if($value->usuario_privilegio == 'convidado'){

                        $_SESSION['privilegio'] = 'convidado';
                        $_SESSION['usuarioTime'] = date('H:i:s');

                    }else if($value->usuario_privilegio == 'administrador'){

                        $_SESSION['privilegio'] = 'administrador';
                        $_SESSION['usuarioTime'] = date('H:i:s');

                    }else
                        $_SESSION['usuarioTime'] = date('H:i:s');
                    
                }
            }else{
                return false;
            }
        }
  
    }


    public function access_logout( int $option = null ){
            
            $nome = base64_encode($_SESSION['usuarioNome']);
            $perfil = base64_encode($_SESSION['usuarioFoto']);

            $this->AccessID = $_SESSION['usuarioID'];
            $this->AccessName = $_SESSION['usuarioNome'];
            $this->AccessProfilePic = $_SESSION['usuarioFoto'];
            $this->AccessDescription = 'Saiu do sistema.';
            self::AccessRegistry();

            if(isset($_SESSION['usuarioID']))
                unset($_SESSION['usuarioID']);

            if(isset($_SESSION['usuarioFoto']))
                unset($_SESSION['usuarioFoto']);
            
            if(isset($_SESSION['usuarioNome']))
                unset($_SESSION['usuarioNome']);
            
            if(isset($_SESSION['usuarioCapa']))
                unset($_SESSION['usuarioCapa']);
            
            if(isset($_SESSION['usuarioEmail']))
                unset($_SESSION['usuarioEmail']);
            
            if(isset($_SESSION['privilegio']))
                unset($_SESSION['privilegio']);
            
            session_unset();
            
            if($option == null)                                         // Opção padrão para redirecionar para tela de login.
                header('Location: ' . ACCESS_LOGIN_PAGE);
            
            if($option == 1)                                            // Opção para redirecionar caso seja solicitada tela de bloqueio por demanda.
                header('Location: ' . ACCESS_LOGIN_PAGE . '?access=blocked_on_demand');
            
            if($option == 2)
                header('Location: ' . ACCESS_LOGIN_PAGE . '?name='.$nome.'&profile='.$perfil);
    }


    public static function access_registry( int $id ){

        $access = ClassDataBase::prepare("UPDATE usuarios SET usuario_ult_acesso = :ult_acesso WHERE id = :id");
        $access->bindValue(':ult_acesso', date('Y-m-d H:i:s'));
        $access->bindValue(':id', $id);
        $access->execute();
        
    }
    
    
    public function AccessUsers($offset = 0, $limite = 6, $OrderBy = 'ORDER BY usuario_ult_acesso'){
        
        $Access = ClassDataBase::prepare("SELECT * FROM usuarios {$OrderBy} LIMIT {$offset}, {$limite}");
        if($Access->execute()){
            if($Access->rowCount() != 0)
                return $Access->fetchAll();
            else
                return false;
        }else
            return false;
    }
    
    
    public function AccessReturnReg($offset = 0, $limit = 6){
        
        $Access = ClassDataBase::prepare("SELECT * FROM acessos ORDER BY acesso_data ASC LIMIT $offset, $limit");
        
        if($Access->execute())
            return $Access->fetchAll();
        else
            return false;
        
    }
    
    
    private function AccessRegistry(){
        
        $sql = "INSERT INTO acessos (acesso_nome, acesso_id, acesso_data, acesso_descricao) VALUES"
                . "(:usuario_nome, :usuario_id, :sistema_data, :usuario_descricao)";
        
        $Access = ClassDataBase::prepare($sql);
        $Access->bindValue(':usuario_nome', $this->AccessName);
        $Access->bindValue(':usuario_id', $this->AccessID);
        $Access->bindValue(':sistema_data', date('Y-m-d H:i:s'));
        $Access->bindValue(':usuario_descricao', $this->AccessDescription);
        
        if($Access->execute()){
            return true;
        }else{
            return false;
        }
        
    }
}

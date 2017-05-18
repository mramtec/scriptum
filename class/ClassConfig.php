<?php

spl_autoload_register(function($class){
   require_once $class.'.php'; 
});


class ClassConfig extends ClassDataBase{
    
    private $id;
    private $config_mail_host;
    private $config_mail_smtp_auth;
    private $config_mail_username;
    private $config_mail_password;
    private $config_mail_smtp_secure;
    private $config_mail_port;
    private $config_mail_origem;
            
    
    public function setConfigHost($host){
        $this->config_mail_host = $host;
    }
    
    public function setConfigAuth($smtp_auth){
        $this->config_mail_smtp_auth = $smtp_auth;
    }
    
    public function setConfigUsername($username){
        $this->config_mail_username = $username;
    }
    
    public function setConfigPass($pass){
        $this->config_mail_password = $pass;
    }
    
    public function setConfigSecure($smtpSecure){
        $this->config_mail_smtp_secure = $smtpSecure;
    }
    
    public function setConfigPort($port){
        $this->config_mail_port = $port;
    }
    
    public function setConfigOrige($origem){
        $this->config_mail_origem = $origem;
    }
    
    public function Config_Email_Param(){
        
        
        $sql = "UPDATE config_email SET "
                . "config_mail_host = :config_mail_host, "
                . "config_mail_smtp_auth = :config_mail_smtp_auth, "
                . "config_mail_username = :config_mail_username, "
                . "config_mail_password = :config_mail_password, "
                . "config_mail_smtp_secure = :config_mail_smtp_secure, "
                . "config_mail_port = :config_mail_port, "
                . "config_mail_origem = :config_mail_origem "
                . "WHERE id = :id";
        
        $config = ClassDataBase::prepare($sql);
        $config->bindValue(':config_mail_host', $this->config_mail_host);
        $config->bindValue(':config_mail_smtp_auth', $this->config_mail_smtp_auth);
        $config->bindValue(':config_mail_username', $this->config_mail_username);
        $config->bindValue(':config_mail_password', $this->config_mail_password);
        $config->bindValue(':config_mail_smtp_secure', $this->config_mail_smtp_secure);
        $config->bindValue(':config_mail_port', $this->config_mail_port);
        $config->bindValue(':config_mail_origem', $this->config_mail_origem);
        $config->bindValue(':id', 1);

        if($config->execute())
            return true;
        else
            return false;
        
    }
    
    
    public function Config_Fundo_Alt(){
        
        //if(strl($this->config_imagem_fundo))
        
    }
    
    private static function Config_Create_Default_Mail(){
        
        $check = ClassDataBase::prepare("SELECT * FROM config_email");
        if($check->execute()){
            if($check->rowCount() == 0){
                
                $sql = "INSERT INTO config_email (config_mail_host,"
                        . " config_mail_smtp_auth, "
                        . "config_mail_username, "
                        . "config_mail_password, "
                        . "config_mail_smtp_secure, "
                        . "config_mail_port, "
                        . "config_mail_origem)"
                . "VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL)";
        
                $config = ClassDataBase::prepare($sql);
                if($config->execute()) return true;
            }else{
                return false;
            }
        }

    }
    
    public function Config_Email_Fetch(){
        
        self::Config_Create_Default_Mail();
        $check = ClassDataBase::prepare("SELECT * FROM config_email");
        if($check->execute()){
            return $check->fetchAll();
        }
//        
//        $sql = "SELECT * FROM config_email WHERE id = 1";
//        $config = ClassDataBase::prepare($sql);
//        if($config->execute())
//            return $config->fetchAll();
//        else
//            return false;
//        
    }
    
}

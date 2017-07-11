<?php

    require_once 'php-mailer/PHPMailerAutoload.php';
    require_once 'defines.php';

    spl_autoload_register(function($class){
       require_once $class.'.php'; 
    });


    /*
     * 
     * Os arquivos que fazem uso ou dependem desta classe são:
     * 
     * * activation/index.php
     * * activation/process/Process_Activation.php
     * * admin/process/Process_Users_Ajax.php
     * 
     */
    
    
class ClassInvite extends ClassDataBase {


    private $CodigoAtivacao;
    private $EmailCadastrado;
    private $FormPrivilegio;

    
    public function getEmailCadastrado() {
        return $this->EmailCadastrado;
    }

    public function getFormPrivilegio() {
        return $this->FormPrivilegio;
    }

    public function setEmailCadastrado($EmailCadastrado) {
        $this->EmailCadastrado = $EmailCadastrado;
    }

    public function setFormPrivilegio($FormPrivilegio) {
        $this->FormPrivilegio = $FormPrivilegio;
    }

            
    
    public function InviteNovo(){
        
        $this->CodigoAtivacao = md5(date('Y-m-d H:i:s'));

        $ClassConfig = new ClassConfig();

        foreach($ClassConfig->Config_Email_Fetch() as $Config_Mail);

            $mail = new PHPMailer;
            //$mail->SMTPDebug = 3;
            $mail->isSMTP();                                                                  // Set mailer to use SMTP
            $mail->Host         = $Config_Mail->config_mail_host;                             // Specify main and backup SMTP servers
            $mail->SMTPAuth     = $Config_Mail->config_mail_smtp_auth;                        // Enable SMTP authentication
            $mail->Username     = $Config_Mail->config_mail_username;                         // SMTP username
            $mail->Password     = $Config_Mail->config_mail_password;                         // SMTP password
            $mail->SMTPSecure   = $Config_Mail->config_mail_smtp_secure;                      // Enable TLS encryption, `ssl` also accepted
            $mail->Port         = $Config_Mail->config_mail_port;                             // TCP port to connect to
            $mail->CharSet      = 'UTF-8';

            $mail->setFrom($Config_Mail->config_mail_origem, SITE_TITLE);
            $mail->addAddress($this->EmailCadastrado, $this->EmailCadastrado);                // Add a recipient
            $mail->isHTML(true);
            $mail->Subject = 'Acesso ao '.SITE_TITLE;

            $message = '<table border="0" width="100%">'
                    . '<tr>'
                        . '<td>'
                            . '<br/>'
                            . '<center><img src="'.LOGO.'" width="190" /></center>'
                        . '</td>'
                    . '</tr>'
                    . '<tr style="color:#868686;">'
                        . '<td align="center">'
                        . '<br>'
                        . '<br>'
                        . '<b>Oi, bem-vindo!</b>'
                        . '<br>'
                        . 'Abaixo tem o endereço para acessar a ativação ao sistema do '.SITE_TITLE.'!'
                        . '<br>'
                        . '<br>'
                        . '<a style="color:#545454;" href="'.SITE.'/activation?activation='.$this->CodigoAtivacao.'&origem='. base64_encode($this->EmailCadastrado).'">Ativar Cadastro</a>'
                        . '<br>'
                        . '<br>'
                        . '<p>Ou copie e cole na barra de endereços o link: '.SITE.'/activation?activation='.$this->CodigoAtivacao.'&origem='. base64_encode($this->EmailCadastrado).'</p>'
                        . '</td>'
                    . '</tr>'
                    . '</table>';
            $mail->Body    = $message;


        if(!$mail->send())
            return false;
        else{

            $users = ClassDataBase::prepare("INSERT INTO convites (convite_email, convite_privilegio, convite_codigo, convite_data) VALUES (:convite_email, :privilegio, :codigo_ativacao, :data_convite)");
            $users->bindValue(':convite_email', $this->EmailCadastrado);
            $users->bindvalue(':privilegio', $this->FormPrivilegio);
            $users->bindValue(':codigo_ativacao', $this->CodigoAtivacao);
            $users->bindValue(':data_convite', date('Y-m-d H:i:s'));
            $users->execute();

            return true;

        }

        
    }
    
    
    public static function InviteBusca($email, $limit = 3, $fetch = false, $like = true){
        
        $sql = '';
        if($like == true){
            $sql = "SELECT * FROM convites WHERE convite_email LIKE '%{$email}%' LIMIT {$limit}";
        }else{
            $sql = "SELECT * FROM convites WHERE convite_email = '$email' LIMIT $limit";
        }

        $users = ClassDataBase::prepare($sql);

        if($users->execute()){
            
            if($users->rowCount() != 0 && $fetch === true){
                return $users->fetchAll();
            }else
                return false;

        }else
            return false;
        
    }
    
    
    public function isInviteDelete(){

        $sql = "DELETE FROM convites WHERE convite_email = :email";
        $users = ClassDataBase::prepare($sql);
        $users->bindValue(':email', $this->EmailCadastrado);
        if($users->execute())
            return true;
        else
            return false;

    }

}

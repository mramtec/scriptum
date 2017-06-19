<?php

    require_once 'php-mailer/PHPMailerAutoload.php';
    require_once 'defines.php';

    spl_autoload_register(function($class){
       require_once $class.'.php'; 
    });


    
class ClassForm extends ClassUsers{

    
    
    public $form_email;
    public $form_privilegio;
    private $form_codigo_ativacao;
    private $EmailCadastrado;
    
    
    
    public function setEmailCadastro($email){
        $this->EmailCadastrado = $email;
    }
    
    
    public function getEmailCadastro(){
        return $this->EmailCadastrado;
    }
    
    
    public function users_novo(){
        
        $this->form_codigo_ativacao = md5(date('Y-m-d H:i:s'));

        $Config_Load_Mail = new ClassConfig();

        foreach($Config_Load_Mail->Config_Email_Fetch() as $Config_Mail);

        $mail = new PHPMailer;
        //$mail->SMTPDebug = 1;
        $mail->isSMTP();                                                                // Set mailer to use SMTP
        $mail->Host = $Config_Mail->config_mail_host;                                   // Specify main and backup SMTP servers
        $mail->SMTPAuth = $Config_Mail->config_mail_smtp_auth;                          // Enable SMTP authentication
        $mail->Username = $Config_Mail->config_mail_username;                           // SMTP username
        $mail->Password = $Config_Mail->config_mail_password;                           // SMTP password
        $mail->SMTPSecure = $Config_Mail->config_mail_smtp_secure;                      // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $Config_Mail->config_mail_port;                                   // TCP port to connect to
        $mail->CharSet = 'UTF-8';

        $mail->setFrom($Config_Mail->config_mail_origem, SITE_TITLE);
        $mail->addAddress($this->form_email, $this->form_email);                        // Add a recipient
        //$mail->addAddress($email);                                                    // Name is optional
        //$mail->addReplyTo($email, $nome);
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        $mail->isHTML(true);

        $mail->Subject = 'Acesso ao '.SITE_TITLE;

        $message = '<table border="0" width="100%">'
                . '<tr>'
                    . '<td>'
                        . '<br/>'
                        . '<center><img src="'.LOGO.'" width="190" /></center>'
                    . '</td>'
                . '</tr>'
                . '<tr>'
                    . '<td align="center">'
                    . '<br>'
                    . '<br>'
                    . '<b>Oi, bem-vindo!</b>'
                    . '<br>'
                    . 'Abaixo tem o endereço para acessar a ativação ao sistema do '.SITE_TITLE.'!'
                    . '<br>'
                    . '<br>'
                    . '<a href="'.SITE.'/activation?activation='.$this->form_codigo_ativacao.'&origem='. base64_encode($this->form_email).'">Ativar Cadastro</a>'
                    . '<br>'
                    . '<br>'
                    . '<br>'
                    . '<b>Ou copie e cole na barra de endereços o link: '.SITE.'/activation?activation='.$this->form_codigo_ativacao.'&origem='. base64_encode($this->form_email).'</b>'
                    . '</td>'
                . '</tr>'
                . '</table>';
        $mail->Body    = $message;


        if(!$mail->send())
            return false;
        else{

            $users = ClassDataBase::prepare("INSERT INTO convites (convite_email, convite_privilegio, convite_codigo, convite_data) VALUES (:convite_email, :privilegio, :codigo_ativacao, :data_convite)");
            $users->bindValue(':convite_email', $this->form_email);
            $users->bindvalue(':privilegio', $this->form_privilegio);
            $users->bindValue(':codigo_ativacao', $this->form_codigo_ativacao);
            $users->bindValue(':data_convite', date('Y-m-d H:i:s'));
            $users->execute();

            return true;
        }

        
    }
    
    
    public static function UserConviteBusca($email, $limit = 3, $fetch = false, $like = true){
        
        $sql = '';
        if($like == true){
            $sql = "SELECT * FROM convites WHERE convite_email LIKE '%{$email}%' LIMIT {$limit}";
        }else{
            $sql = "SELECT * FROM convites WHERE convite_email = '$email' LIMIT $limit";
        }

        $users = ClassDataBase::prepare($sql);

        if($users->execute()){
            
            if($users->rowCount() != 0){

                if($fetch == true){
                    return $users->fetchAll();
                }else{
                    return true;
                }

            }else
                return false;

        }else
            return false;
        
    }
    
    
    public function isUserConviteDelete(){
        $sql = "DELETE FROM convites WHERE convite_email = :email";
        $users = ClassDataBase::prepare($sql);
        $users->bindValue(':email', $this->EmailCadastrado);
        if($users->execute())
            return true;
        else
            return false;
    }

}

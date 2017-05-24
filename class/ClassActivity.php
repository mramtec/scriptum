<?php

class ClassActivity{
    
    private $usuarioID;
    private $usuarioNome;
    private $descricao;
    
    
    public function setUsuarioID($id){
        $this->usuarioID = $id;
    }
    
    public function setUsuarioNome($nome){
        $this->usuarioNome = $nome;
    }
    
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }
    
    
    public function getActivity(){
        
        $sql =  "INSERT INTO atividades (atividade_usuario_id, atividade_usuario_nome, atividade_descricao, atividade_hora) "
                . "VALUES (:usuario_id, :usuario_nome, :descricao, :data_hora)";
        
        $Activity = ClassDataBase::prepare($sql);
        $Activity->bindValue(':usuario_id', $this->usuarioID);
        $Activity->bindValue(':usuario_nome', $this->usuarioNome);
        $Activity->bindValue(':descricao', $this->descricao);
        $Activity->bindValue(':data_hora', date('Y-m-d H:i:s'));

        if($Activity->execute())
            return true;
        else
            return false;
        
    }
    
    
    public function getActivityReg($offset = 0, $limit = 6){
        
        $sql = "SELECT * FROM atividades ORDER BY id DESC LIMIT $offset, $limit";
        $Activity = ClassDataBase::prepare($sql);
        if($Activity->execute())
            return $Activity->fetchAll();
        else
            return false;
        
    }
    
}
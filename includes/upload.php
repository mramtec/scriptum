<?php
  require_once 'functions.php';

  function uploadPDF($arquivo){

      if(!empty($_FILES)){


        $tamanho = $_FILES["documento"]["size"];          // Variável para informação do tamanho do arquivo recebido por formulário.
        $pasta_tmp = $_FILES["documento"]["tmp_name"];    // Variável para informação da localização da pasta temporária.
        $tipo = $_FILES["documento"]["type"];             // Variável para identificar se é um documento PDF.


            if($tipo != "application/pdf")                         // Inspeciona se o arquivo é um PDF (Portable Document File).
                return "<h2>Arquivo não é um documento</h2>";      // Caso não seja, retorna para o solicitante uma mensagem e interrompe o procedimento.


        $pasta = 'uploads/doc/';                    // Localização do novo local do arquivo.
        $move_pasta = '../'.$pasta;                 // Localização para mover.
        $nome = md5(date('Y-m-d H:i:s'));           // Novo nome do arquivo.
        $extensao = '.pdf';                         // Extensão do arquivo.
        $tamanho_limite = 1024 * 1024 * 512;        // Limite de 512MB medidos em bytes.

        if($tamanho <= $tamanho_limite){                // Verifica se o tamanho obedece o limite de upload.

          if(move_uploaded_file( $pasta_tmp , $move_pasta.$nome.$extensao ))    // Caso o limite de tamanho seja obedecido, move o arquivo para a pasta destinada.
              return $pasta.$nome.$extensao;                                    // Retorna para o solicitante a localização do arquivo. No caso: sucesso no procedimento.
          else
            return "Error Desconhecido";              // Erro desconhecimento é provável ser de permissão de pasta.

        }else
          return false;                               // Caso tenha erro geral nos procedimentos anteriores, retorna false.


      }

  }


  function apagarPDF($arquivo){

      $locReal = '../'.$arquivo;

      if(is_file($locReal)){
            return "Arquivo Existe";
      }
  }



  function uploadMiniatura($arquivo){

        if(!empty($_FILES["miniatura"])){

            $tamanho = $_FILES['miniatura']['size'];
            $tipo = $_FILES['miniatura']['type'];
            $pasta_tmp = $_FILES['miniatura']['tmp_name'];

            $arrayTipos = array('image/jpg', 'image/jpeg', 'image/pjeg', 'image/png');

            if(!in_array($tipo, $arrayTipos))
              return "Não Permitido";

              $pasta = 'uploads/miniatura/';                            // Localização do novo local do arquivo.
              $move_pasta = '../'.$pasta;                               // Localização para mover.
              $nome = md5(date('Y-m-d H:i:s'));                         // Novo nome do arquivo.
              $extensao = ($tipo == 'image/png' ? '.png' : '.jpg');
              $tamanho_limite = 1024 * 1024 * 3;                        // Limite de 3MB medidos em bytes.


            if($tamanho <= $tamanho_limite){

              if(move_uploaded_file( $pasta_tmp , $move_pasta.$nome.$extensao ))                  // Caso o limite de tamanho seja obedecido, move o arquivo para a pasta destinada.
                  return $pasta.$nome.$extensao;                                                  // Retorna para o solicitante a localização do arquivo. No caso: sucesso no procedimento.
              else
                return "Error Desconhecido";              // Erro desconhecimento é provável ser de permissão de pasta.

            }else{
              return "Arquivo maior que o recomendado";
            }


        }
  }

?>

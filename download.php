<?php

  set_time_limit(0);                              // Define o tempo máximo de execução em 0 para as conexões lentas

  include_once 'includes/functions.php';

  $link = connectBD();

  if(!isset($_GET['id'])){
        return false;
        exit;
  }

  $id = escapeBD($link, $_GET['id']);

  $query = mysqli_query($link, "SELECT * FROM ebook WHERE id = '$id'");
  $fetch = mysqli_fetch_assoc($query);

  if( !file_exists($fetch['doc']) ){

        echo "Arquivo Não Localizado";
        exit;

  }else{

  $novoNome = $fetch['doc'].'.pdf';

  // Configuramos os headers que serão enviados para o browser
  header('Content-Description: File Transfer');
  header('Content-Disposition: attachment; filename="'.$fetch['url'].'.pdf"');
  header('Content-Type: application/octet-stream');
  header('Content-Transfer-Encoding: binary');
  header('Content-Length: ' . filesize($fetch['doc']));
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Pragma: public');
  header('Expires: 0');

  // Envia o arquivo para o cliente
      if(readfile($fetch['doc'])){

          $view = $fetch['downs'] + 1;
          $update_view = mysqli_query($link, "UPDATE ebook SET downs = '$view' WHERE id = '$id'");

      }


  }
?>

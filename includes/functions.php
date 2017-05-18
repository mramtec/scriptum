<?php

	function connectBD(){				// Função para abrir o banco de dados.
		$conn = mysqli_connect('localhost', 'isabe574_user', 'd$!1&8#bGhEN', 'isabe574_blog') or die(mysqli_connect_error());
		mysqli_set_charset($conn, 'utf8') or die(mysqli_error($conn));

		return $conn;
	}

/* ======================================================================================================================== */

	function closeBD($value){			// Função para fechar o banco de dados.
		$exec = mysqli_close($value) or die(mysqli_error($value));

		return $exec;
	}

/* ======================================================================================================================== */

	function escapeBD($link, $data){			// Livrar de SQL Injection

		if(!is_array($data)){

			$data = mysqli_real_escape_string($link, $data);

		}else{
			$valor = $data;

			foreach ($valor as $key => $value) {
				$key = mysqli_real_escape_string($link, $key);					// Limpa as chaves
				$value = mysqli_real_escape_string($link, $value);				// Limpa os valores

				$data[$key] = $value;											// Remonta o array.

			}

		}

		return $data;
	}



/* ============================== URL ============================== */

function paraURL($str, $replace=array(), $delimiter='-') {
	setlocale(LC_ALL, 'en_US.UTF8');

		if( !empty($replace) ) {
				$str = str_replace((array)$replace, ' ', $str);
		}

		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		return $clean;
}



/* ============================== Select em formulário ============================== */
	function select($value, $return){
		if($value == $return)
			return "selected";
		else
			return "";
	}

	function dataUser($data){
		$srt_to_time = date('d m Y', strtotime($data));
		$ex_data = explode(' ', $srt_to_time);

		switch ($ex_data[1]) {
			case '1':
				$ex_data[1] = 'janeiro';
				break;

			case '2':
				$ex_data[1] = 'fevereiro';
				break;

			case '3':
				$ex_data[1] = 'março';
				break;

			case '4':
				$ex_data[1] = 'abril';
				break;

			case '5':
				$ex_data[1] = 'maio';
				break;

			case '6':
				$ex_data[1] = 'junho';
				break;

			case '7':
				$ex_data[1] = 'julho';
				break;

			case '8':
				$ex_data[1] = 'agosto';
				break;

			case '9':
				$ex_data[1] = 'setembro';
				break;

			case '10':
				$ex_data[1] = 'outubro';
				break;

			case '11':
				$ex_data[1] = 'novembro';
				break;

			case '12':
				$ex_data[1] = 'dezembro';
				break;

			default:
				$ex_data[1] = '00';
				break;
		}

		return $ex_data[0].' '.$ex_data[1].' '.$ex_data[2];
	}

/* ======================================================================================================================== */

	// Funções para manipulação do banco de dados.

	function readBD($link, $table, $params, $fields){		// 1º $link = Link do BD, 2º $table: Tabela, 3º $params: Parametros finais, 4º $fields: seleções dos itens no banco de dados.
		$params = ($params) ? " {$params}" : null;

		$query_read = "SELECT {$fields} FROM {$table}{$params}";
		$result = execBD($link, $query_read);

		if(!mysqli_num_rows($result)){

			return false;

		}else{
			while($dados = mysqli_fetch_assoc($result)){
				$resultado[] = $dados;
			}
			return $resultado;
		}
	}



	function inserirBD($link, $table, array $data){		// Inserção no banco de dados.

		$clearData = escapeBD($link, $data);

		$campos = implode(", ", array_keys($clearData));
		$valores = "'".implode("', '", $clearData)."'";

		$query_insert = "INSERT INTO {$table} ( {$campos} ) VALUES ( {$valores} )";
		$add_BD = execBD($link, $query_insert);

		if($add_BD)
			return "Adicionado";
		else
			return "Error";
	}

/* ======================================================================================================================== */

	function execBD($link, $query){				// Executa query no banco de dados.
		$result = mysqli_query($link, $query) or die(mysqli_error($link));

		return $result;
	}

/* ========================================================================================================================= */

		function validaUsuario($usuario, $senha){

			$link = connectBD();

			$n_usuario = escapeBD($link, $usuario);
			$n_senha = escapeBD($link, $senha);

			$query = mysqli_query($link, "SELECT * FROM usuarios WHERE usuario = '{$n_usuario}' AND senha = '{$n_senha}' LIMIT 1") or die(mysqli_error($link));

			if(mysqli_num_rows($query) == 0)
				expulsaVisitante(); 	//return "Sem resultados";
			else{

				$resultado = mysqli_fetch_assoc($query);
				$r_nome = $resultado['usuario'];
				$r_senha = $resultado['senha'];
				/*
				foreach ($query as $resultado) {
					$r_nome = $resultado['usuario'];
					$r_senha = $resultado['senha'];
				}
				*/

				if($r_nome == $n_usuario || $r_senha == $n_senha){		// Se os dados confere, inicia a sessão e libera o acesso.

					session_start();

					$_SESSION['usuarioID'] = $resultado['id'];
					$_SESSION['usuarioNome'] = $resultado['nome'];
					$_SESSION['email'] = $resultado['email'];

					return true;

				}else{
					return false;
				}
			}

		}



		function protegePagina(){
			if(!isset($_SESSION['usuarioID']) || !isset($_SESSION['usuarioNome'])){
				expulsaVisitante();
			}elseif(!isset($_SESSION['usuarioID']) && isset($_SESSION['usuarioNome'])){
				expulsaVisitante();
			}
		}




		function expulsaVisitante(){
			if(isset($_SESSION)){
				unset($_SESSION['usuarioID']);
				unset($_SESSION['usuarioNome']);
				unset($_SESSION['email']);

				header('Location: http://isabeltavares.com/login');
				exit();
			}else{
				header('Location: http://isabeltavares.com/login');
				exit();
			}

		}



function visualizacoes($id){

	$link = connectBD();
	$id_post = $id;
	$sql = "SELECT visualizacoes FROM posts WHERE id = '$id'";
	$resultado = mysqli_query($link, $sql);

	$post = mysqli_fetch_assoc($resultado);

		if($post['visualizacoes'] == 0){
			$novo_acesso = 1;
			$update = "UPDATE posts SET visualizacoes = '$novo_acesso' WHERE id = '$id_post'";
			$exec_update = mysqli_query($link, $update) or mysql_error();
		}else{
			$novo_acesso = $post['visualizacoes'] + 1;
			$update = "UPDATE posts SET visualizacoes = '$novo_acesso' WHERE id = '$id_post'";
			$exec_update = mysqli_query($link, $update) or mysql_error();
		}

		if($exec_update)
				return true;
			else
				return false;
		closeBD($link);
	}


	function refreshPage($time){
		header('refresh: '.$time.';');
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>A7Network - Criar uma Nova Conta</title>
</head>
<body>
	<form action="" method="POST">
		Nome:<br/>
		<input type="text" name="nome"/><br><br>

		E-mail:<br/>
		<input type="text" name="email"/><br><br>

		Senha:<br/>
		<input type="password" name="senha"/><br><br>

		<input type="submit" value="Criar Conta"/>
	</form>
</body>
</html>
<?php
	
	// Iniciando sessão
	session_start();

	// Adicionando arquivo global de conexão
	require "global.php";

	// Verificando se existe alguma sessão aberta
	if(isset($_SESSION["login"])) {
		header("Location: index.php");
	} else {
		echo "<br/><br/>";
		// Salvando variaveis do cadastro
		if(isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["senha"]) && !empty($_POST["senha"])) {

			// Salvado variaveis do cadastro
			$senha = md5(addslashes($_POST["senha"]));
			$dados = array(
				"nome" => "Visitante",
				"email" => addslashes($_POST["email"])
			);
			//$email = addslashes($_POST["email"]);
			//$senha = md5(addslashes($_POST["email"]));

			// Verificando se existe uma conta cadastrada com esse E-mail
			$sql = "SELECT * FROM usuarios WHERE email = '".$dados["email"]."'";
			$sql = $pdo->query($sql);
			if($sql->rowCount() <= 0) {

				// Verificando se nome foi enviado
				if(isset($_POST["nome"]) && !empty($_POST["nome"])) {
					// criando consulta com o nome adicionado
					$sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('".$dados["nome"]."', '".$dados["email"]."', '".$senha."')";
				} else {
					// criando consulta sem nome
					$sql = "INSERT INTO usuarios (email, senha) VALUES ('".$dados["email"]."', '".$senha."')";
				}

				// Executando consulta
				$pdo->query($sql);
				echo $dados;

				/*
					Salvando informações do usuário
					cadastrado em uma sessão
				*/
				$_SESSION["login"] = $dados;

				// Redirecionando pra página inícial
				header("Location: index.php");
			} else {
				echo "Já existe um usuário cadastrado com esse endereço de E-mail...";
			}
		} else {
			echo "Preencha os dados corretamente!";
		}
	}

?>
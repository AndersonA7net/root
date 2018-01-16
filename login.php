<h3>Entre com sua Conta</h3>
<form action="" method="POST">
	E-mail:<br/>
	<input type="text" name="email"/><br><br>
	Senha:<br/>
	<input type="password" name="senha"/><br><br>

	<div class="link">
		<a href="novaConta.php">Criar uma Nova Conta</a><br>
		<a href="recuperarSenha.php">Esqueceu a Senha?</a>
	</div><br/>
	<input type="submit" value="Entrar">
</form>
<?php

	// Iniciando sessão
	session_start();

	// Adicionando arquivo global de conexão
	require "global.php";

	// Verificando se a sessão já foi criada
	if(!isset($_SESSION["login"])) {

		// Verificando se o usuário enviou os dados
		if(isset($_POST["email"]) && isset($_POST["senha"])) {
			
			// Salvando váriaveis de acesso
			$email = addslashes($_POST["email"]);
			$senha = md5(addslashes($_POST["senha"]));

			// Montando consulta de login
			$sql = "SELECT * FROM usuarios WHERE email = '".$email."' AND senha = '".$senha."'";

			// Fazendo consulta
			$resultado = $pdo->query($sql);
			
			// Verificando se existe o usuário
			if($resultado->rowCount() > 0) {

				// Salvando primeiro registro
				$dados = $resultado->fetch();

				// Definindo sessão
				$_SESSION["login"] = $dados;

				// Redirecionar pra página inicial, já logado
				header("Location: index.php");
			} else {
				echo "E-mail ou Senha incorreto!";
			}
		}
	} else {
		/*
			Redirecionando usuário pra tela inícial
			se a sessão já foi iniciada
		*/
		header("Location: index.php");
	}

?>
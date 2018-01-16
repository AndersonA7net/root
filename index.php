<?php
	session_start();
	if(!isset($_SESSION["login"])) {
		header("Location: login.php");
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>A7Network - Início</title>
</head>
<body>
	<h2>Bem Vindo <span><?php echo $_SESSION["login"]["nome"] ?></span></h2>
</body>
</html>
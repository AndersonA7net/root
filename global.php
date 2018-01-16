<?php

	$dsn = "mysql:dbname=bonieky;host=localhost;charset=utf8";
	$dbuser = "root";
	$dbpass = "";

	try {
		$pdo = new PDO($dsn, $dbuser, $dbpass);
	} catch(PDOException $e) {
		echo $e-getMessage();
	}

?>
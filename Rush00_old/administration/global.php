<?php
	if (file_exists("../config.php"))
		include_once("../config.php");
	else if (file_exists("../../config.php"))
		include_once("../../config.php");
	else
	{
		header('Location: /install/');
		exit;
	}

	$mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DBNAME);

	if ($mysqli->connect_errno)
		exit("Échec de la connexion : " . $mysqli->connect_error . "<br>Si le Probleme perciste editez ou alors supprimez le fichier config.php et réessayez");


	session_start();

	if (!isset($_SESSION[user]) || $_SESSION[user][rank] < 10)
	{
		header('Location: /');
		exit;
	}

	//	$mysqli->query("INSERT INTO `article` (`id`, `category`, `photo`, `nom`, `color`, `size`, `description`, `stock`, `price`, `time_delivery`) VALUES (NULL, '1', 'photo', 'nom', 'color', 'size', 'description', '1', '1', '1')");

?>
<?php
	include_once("./global.php");
	unset($_SESSION["user"]);
	session_destroy();
	header('Location: /');
	exit;
?>
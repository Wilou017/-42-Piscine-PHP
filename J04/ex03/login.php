<?php
	session_start();

	include 'auth.php';

	if (auth($_GET['login'], $_GET['passwd']))
	{
		$_SESSION['loggued_on_user'] = $_GET['login'];
		die ("OK\n");
	}
	$_SESSION['loggued_on_user'] = "";
	die ("ERROR\n");
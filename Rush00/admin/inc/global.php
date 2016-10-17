<?php
	session_start();

	define('ROOT', $_SERVER['DOCUMENT_ROOT']);
	include_once ROOT."/inc/includes.php";

	if (!user_ranked(10))
		redirect('/');
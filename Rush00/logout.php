<?php

	include_once $_SERVER['DOCUMENT_ROOT'].'/inc/global.php';

	update('panier', array("panier" => json_encode($_SESSION['panier'])), array("userid" => $_SESSION['user']['id'], "payed" => 0));

	$_SESSION = array();
	session_destroy();
	redirect('/');
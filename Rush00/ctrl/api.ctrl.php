<?php
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		include_once $_SERVER['DOCUMENT_ROOT'].'/inc/global.php';


	$return['result'] = true;

	if (isset($_POST['submit_artselect']) && isset($_POST['acrtid']))
		$return['data'] = get("*", "articles", array('id' => $_POST['acrtid']));

	if (isset($_POST['submit_addart']) && isset($_POST['acrtid']))
		addToPanier($_POST['acrtid'], 1);

	if (isset($_POST['submit_delartsdf']) && isset($_POST['acrtid']))
	{
		foreach ($_SESSION['panier'] as $key => $article) {
			if ($article['id'] == $_POST['acrtid'])
				unset($_SESSION['panier'][$key]);
		}
		update('panier', array('panier' => json_encode($_SESSION['panier'])), array('userid' => $_SESSION['user']['id'], "payed" => "0"));
	}

	if (isset($_POST['submit_changeqqt']) && isset($_POST['acrtid']) && isset($_POST['value']))
	{
		foreach ($_SESSION['panier'] as $key => $article) {
			if ($article['id'] == $_POST['acrtid'])
				$_SESSION['panier'][$key]['count'] = $_POST['value'];
		}
		update('panier', array('panier' => json_encode($_SESSION['panier'])), array('userid' => $_SESSION['user']['id'], "payed" => "0"));
	}

	if (isset($_POST['submit_valide']))
	{
		update('panier', array('payed' => "1"), array('userid' => $_SESSION['user']['id'], "payed" => "0"));
		$_SESSION['panier'] = Array();
		set('panier', array("userid" => $_SESSION['user']['id'],
									"panier" => "{}",
									"payed" => 0));
	}

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		die(json_encode($return));
	}
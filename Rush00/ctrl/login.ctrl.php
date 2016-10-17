<?php
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		include_once $_SERVER['DOCUMENT_ROOT'].'/inc/global.php';


	$return['result'] = false;

	if (isset($_POST['submit_login']))
	{

		if (isset($_POST['email']) && isset($_POST['pass']))
		{
			$email = $_POST['email'];
			$pass = $_POST['pass'];

			$user = get("*", "users",  array('email' => $email));


			if (!$user)
				$return['message'] = "Email invalide";
			else if ($user['email_checked'] != 1)
				$return['message'] = "Veuillez verifier votre email";
			else if (!password_verify($pass, $user['password']))
				$return['message'] = "Mot de Passe invalide";
			else
			{
				$userpanier = get("*", "panier", array("userid" => $user['id'], "payed" => "0"));
				if(!$userpanier)
				{
					set('panier', array("userid" => $user['id'],
									"panier" => (isset($_SESSION['panier'])) ? json_encode($_SESSION['panier']) : "{}",
									"payed" => 0));
				}
				else
				{
					$userpanier =json_decode(html_entity_decode($userpanier['panier']), true);
					if (count($userpanier) < 1)
					{
						update('panier', array("panier" => json_encode($_SESSION['panier'])), array("userid" => $_SESSION['user']['id'], "payed" => 0));
					}
					else
						$_SESSION['panier'] = $userpanier;
				}

				$_SESSION['user'] = $user;
				$return['result'] = true;
			}
		}
		else
			$return['message'] = "Merci de remplir le champs";
	}

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		die(json_encode($return));
	}
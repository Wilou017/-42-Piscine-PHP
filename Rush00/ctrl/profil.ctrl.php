<?php
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		include_once $_SERVER['DOCUMENT_ROOT'].'/inc/global.php';


	$return['result'] = false;

	if (user_logged() && isset($_POST['submit_profil']))
	{
		if (isset($_POST['oldpass']) && isset($_POST['newpass']) && isset($_POST['newpass2']))
		{
			$oldpass = $_POST['oldpass'];
			$newpass = $_POST['newpass'];
			$newpass2 = $_POST['newpass2'];

			if (!password_verify($oldpass, $_SESSION['user']['password']))
				$return['message'] = "Ancien Mot de Passe invalide";
			else if (!preg_match('/^(?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\\-={}[\\]\\\\|;\':",.\\/<>?]).{8,}$/', $newpass))
				$return['message'] = "le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre, une caractères special et doit faire au moins 8 caractères au total";

			else if ($newpass != $newpass2)
				$return['message'] = "Les mots de passe ne correspondent pas";
			else
			{
				if (!update("users", array("password" => password_hash($newpass, PASSWORD_BCRYPT)), array("id" => $_SESSION['user']['id'])))
					$return['message'] = mysqli_error($db);
				else
					$return['result'] = true;
			}
		}
		else
			$return['message'] = "Merci de remplir le champs";
	}


	if (user_logged() && isset($_POST['submit_deletingaccount']))
	{
		if(del("users", array("id" => $_SESSION['user']['id'])))
			$return['result'] = true;
		else
			$return['message'] = "Une erreur est survenue";
	}

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		die(json_encode($return));
	}
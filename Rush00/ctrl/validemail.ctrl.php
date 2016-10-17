<?php
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		include_once $_SERVER['DOCUMENT_ROOT'].'/inc/global.php';


	$return['result'] = false;

	if (isset($_POST['submit_validemail']))
	{

		if (isset($_POST['token']))
		{
			$token = $_POST['token'];

			if (!get("*", "users", array('token' => $token)))
				$return['message'] = "Token invalide";
			else
			{
				$user = array("email_checked" => "1");

				if(!update('users', $user, array('token' => $token)))
					$return['message'] = mysqli_error($db);
				else
				{
					$return['result'] = true;
					$return['message'] = "Email validé";
				}
			}
		}
		else
			$return['message'] = "Merci de remplir le champs";
	}

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		die(json_encode($return));
	}
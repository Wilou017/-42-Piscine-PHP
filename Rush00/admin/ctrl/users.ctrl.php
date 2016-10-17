<?php
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		include_once $_SERVER['DOCUMENT_ROOT'].'/admin/inc/global.php';


	$return['result'] = false;

	if (user_ranked(10) && isset($_POST['submit_delusr']))
	{

		if (isset($_POST['userid']))
		{
			$userid = $_POST['userid'];

			$userid = get("*", "users",  array('id' => $userid));

			if (!$userid)
				$return['message'] = "Utilisateur introuvable";
			else if(del("users", array("id" => $userid['id'])))
				$return['result'] = true;
			else
				$return['message'] = "Une erreur est survenue";
		}
		else
			$return['message'] = "Error";
	}

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		die(json_encode($return));
	}
<?php
	if (isset($_POST['login_submit']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
	{
		extract($_POST);
		$email = addslashes(htmlentities($email));
		$password = addslashes(htmlentities($password));

		$selected_user = $mysqli->query("SELECT * FROM `user` WHERE `email` LIKE '".$email."' LIMIT 1");
		if ($selected_user->num_rows < 1)
			$error_login = "Email invalide";

		$selected_user =  $selected_user->fetch_assoc();
		if (!isset($error_login) && !password_verify($password, $selected_user['password']))
			$error_login = "Mot de passe invalide";

		if (!isset($error_login))
		{
			if (password_needs_rehash($selected_user['password'], PASSWORD_DEFAULT))
				$mysqli->query("UPDATE `user` SET `password` = '".password_hash($password, PASSWORD_DEFAULT)."' WHERE `user`.`id` = ". $selected_user['id']);
			$_SESSION['user'] = $selected_user;
		}
	}
?>
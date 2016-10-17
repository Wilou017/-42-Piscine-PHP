<?php
	if(isset($_POST['submit_register']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email_one']) && isset($_POST['email_two']) && isset($_POST['pass_one']) && isset($_POST['pass_two']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email_one']) && !empty($_POST['email_two']) && !empty($_POST['pass_two']) && !empty($_POST['pass_two']))
	{
		extract($_POST);
		$firstname = addslashes(htmlentities($firstname));
		$lastname = addslashes(htmlentities($lastname));
		$email_one = addslashes(htmlentities($email_one));
		$email_two = addslashes(htmlentities($email_two));
		$pass_one = addslashes(htmlentities($pass_one));
		$pass_two = addslashes(htmlentities($pass_two));

		if(filter_var($email_one, FILTER_VALIDATE_EMAIL) === false && filter_var($email_two, FILTER_VALIDATE_EMAIL) === false)
			$error = "email non valide";

		if(!isset($error) && $email_one != $email_two)
			$error = "les email ne correspondent pas";

		if(!isset($error) && $pass_one != $pass_two)
			$error = "les Mot de passe ne correspondent pas";

		if(!isset($error) && preg_match("/^[a-zA-Z -]+$/", $firstname . $lastname) == 0)
			$error = "le nom est le prenom ne peuvent contenir que les lettre";

		if(strlen($pass_one) <= 6)
			$error = "Le Mot de passe doit faire plus de 6 caracteres";

		if (!isset($error) && $mysqli->query("SELECT COUNT(email) as nb FROM `user` WHERE `email` LIKE '$email_one' LIMIT 1")->fetch_assoc()[nb] > 0)
			$error = "email deja utilisé";

		if(!isset($error))
		{
			$pass_one = password_hash($pass_one, PASSWORD_DEFAULT);
			$next_id = $mysqli->query("SELECT Auto_increment FROM information_schema.tables WHERE table_name='user'")->fetch_assoc()['Auto_increment'];

			$mysqli->query("INSERT INTO `user` (`id`, `token`, `rank`, `firstname`, `lastname`, `email`, `password`, `email_checked`) VALUES (
					'" . $next_id . "',
					'" . md5($next_id) . "',
					'1',
					'".$firstname."',
					'".$lastname."',
					'".$email_one."',
					'".$pass_one."',
					'0');");
			$_SESSION['user'] = $mysqli->query("SELECT * FROM `user` WHERE `email` LIKE '".$email_one."' AND `password` LIKE '".$pass_one."' LIMIT 1")->fetch_assoc();
			header('Location: /');
			exit;
		}
	}
?>
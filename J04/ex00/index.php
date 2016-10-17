<?php
	session_start();

	if ($_GET['submit'] == "OK") {
		$_SESSION['user'] = $_GET;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Formulaire</title>
</head>
<body>
	<form action="index.php" method="get">
		Identifiant: <input type="text" name="login" value="<?= $_SESSION['user']['login'] ?>">
		<br/>
		Mot de passe: <input type="password" name="passwd" value="<?= $_SESSION['user']['passwd'] ?>">
		<br/>
		<input type="submit" name="submit" value="OK">
	</form>
</body>
</html>

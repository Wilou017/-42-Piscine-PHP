<?php
if (file_exists("../config.php"))
{
	header('Location: /');
	exit;
}

if(isset($_POST['submit']))
{
	$mysqli = new mysqli($_POST['MYSQL_HOST'], $_POST['MYSQL_USER'], $_POST['MYSQL_PASS']);
	if (!$mysqli->connect_errno)
	{
		if ($mysqli->query("SHOW DATABASES LIKE '".$_POST['MYSQL_DBNAME']."'")->fetch_array())
			$mysqli->query("DROP DATABASE `".$_POST['MYSQL_DBNAME']."`;");

		$config = fopen('../config.php', 'x');
		fputs($config, "<?php\n");
		fputs($config, "define('MYSQL_HOST', '".$_POST['MYSQL_HOST']."');\n");
		fputs($config, "define('MYSQL_USER', '".$_POST['MYSQL_USER']."');\n");
		fputs($config, "define('MYSQL_PASS', '".$_POST['MYSQL_PASS']."');\n");
		fputs($config, "define('MYSQL_DBNAME', '".$_POST['MYSQL_DBNAME']."');\n");
		fputs($config, "define('CMS_SITENAME', '".$_POST['CMS_SITENAME']."');\n");
		fputs($config, "?>");
		fclose($config);

		$mysqli->query("CREATE DATABASE `".$_POST['MYSQL_DBNAME']."`;");
		$mysqli->query("USE `".$_POST['MYSQL_DBNAME']."`;");

		$array = explode(";\n", file_get_contents("db_amaitre.sql"));
		for ($i=0; $i < count($array) ; $i++) {
			$str = $array[$i];
			if ($str != '')
			{
				$str .= ';';
				$mysqli->query($str);
			}
		}
		$error = "Site installé<br>";
	}
	else
		$error = "Impossible de se conncter avec cet utilisateur";
}
?>
<html>
	<head>
		<title>Instalation du site</title>
	</head>
	<body>
		<?php	if (isset($error)) echo $error;
				if ("Site installé" != $error)
				{ ?>
					<form method="post">
						MYSQL_HOST: <input type="text" name="MYSQL_HOST"><br>
						MYSQL_USER: <input type="text" name="MYSQL_USER"><br>
						MYSQL_PASS: <input type="text" name="MYSQL_PASS"><br>
						MYSQL_DBNAME: <input type="text" name="MYSQL_DBNAME"><br>
						CMS_SITENAME: <input type="text" name="CMS_SITENAME"><br>
						<input type="submit" name="submit" value="Enregistrer">
					</form>
		<?php	}
				else
				{ ?>
					<a href="/">Retour au site</a>
		<?php	} ?>
	</body>
</html>

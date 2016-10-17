<?php

	define('ROOT', $_SERVER['DOCUMENT_ROOT']);
	error_reporting(0);

	$return['result'] = false;

	if (!file_exists(ROOT."/inc/config/config.php") &&
		isset($_POST["submit_Conf_DB"]) &&
		isset($_POST["host"]) &&
		isset($_POST["user"]) &&
		isset($_POST["pass"]) &&
		isset($_POST["database"]) &&
		isset($_POST["sitename"]) &&
		isset($_POST["siteurl"]))
	{
		if (!empty($_POST["host"]) && !empty($_POST["user"]) && !empty($_POST["database"]))
		{
				$db = mysqli_connect($_POST['host'], $_POST['user'], $_POST['pass']);
				if (!mysqli_connect_errno())
				{
					if (mysqli_fetch_array(mysqli_query($db, "SHOW DATABASES LIKE '".$_POST['database']."'")))
						mysqli_query($db, "DROP DATABASE `".$_POST['database']."`;");

					$config = fopen(ROOT."/inc/config/config.php", 'x');
					fputs($config, "<?php\n");
					fputs($config, "define('MYSQL_HOST', '".$_POST['host']."');\n");
					fputs($config, "define('MYSQL_USER', '".$_POST['user']."');\n");
					fputs($config, "define('MYSQL_PASS', '".$_POST['pass']."');\n");
					fputs($config, "define('MYSQL_DBNAME', '".$_POST['database']."');\n");
					fputs($config, "define('SITENAME', '".$_POST['sitename']."');\n");
					fputs($config, "define('SITEURL', '".$_POST['siteurl']."');\n");
					fputs($config, "define('SITEMAIL', '".$_POST['sitemail']."');\n");
					fclose($config);

					mysqli_query($db, "CREATE DATABASE `".$_POST['database']."` CHARACTER SET utf8 COLLATE utf8_general_ci;");
					mysqli_query($db, "USE `".$_POST['database']."`;");

					$array = explode(";\n", file_get_contents(ROOT."/inc/config/db_amaitre.sql"));
					for ($i=0; $i < count($array) ; $i++) {
						$str = $array[$i];
						if ($str != '') {
							$str .= ';';
							mysqli_query($db, $str);
						}
					}
					$return['result'] = true;
				}
				else
					$return['message'] = "Impossible de se conncter avec cet utilisateur";
			}
			else
				$return['message'] = "Merci de remplire tout les champs";
		}
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		die(json_encode($return));
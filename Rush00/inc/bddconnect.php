<?php

	$db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DBNAME);
	mysqli_set_charset($db, "utf8");

	if (user_logged())
	{
		$_SESSION['user'] = get("*", "users",  array('id' => $_SESSION['user']['id']));
		if (!$_SESSION['user'])
			unset($_SESSION['user']);
	}

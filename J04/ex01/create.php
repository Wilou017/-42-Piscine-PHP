<?php
	if ($_POST['submit'] != "OK")
		die ("ERROR\n");

	if ($_POST['login'] == "" || $_POST['passwd'] == "")
		die ("ERROR\n");

	$login = $_POST['login'];
	$pass = $_POST['passwd'];

	if (!file_exists('../private/passwd'))
	{
		mkdir('../private');
		$users = Array();
	}
	else
		$users = unserialize(file_get_contents('../private/passwd'));

	foreach ($users as $user) {
		if ($user['login'] == $login)
			die ("ERROR\n");
	}

	$users = array_merge($users, array(array('login' => $login, 'passwd' => hash('sha512', $pass))));

	file_put_contents('../private/passwd', serialize($users));

	echo "OK\n";
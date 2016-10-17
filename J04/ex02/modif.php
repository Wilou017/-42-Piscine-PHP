<?php
	if ($_POST['submit'] != "OK")
		die ("ERROR\n");

	if ($_POST['login'] == "" || $_POST['oldpw'] == "" || $_POST['newpw'] == "")
		die ("ERROR\n");

	$login = $_POST['login'];
	$oldass = $_POST['oldpw'];
	$newpass = $_POST['newpw'];

	$users = unserialize(file_get_contents('../private/passwd'));

	$search = false;
	$i = 0;

	foreach ($users as $user) {
		if ($user['login'] == $login && $user['passwd'] == hash('sha512', $oldass))
		{
			$search = true;
			break;
		}
		$i++;
	}

	if ($search === false)
		die ("ERROR\n");

	$users[$i]['passwd'] = hash('sha512', $pass);

	file_put_contents('../private/passwd', serialize($users));

	echo "OK\n";
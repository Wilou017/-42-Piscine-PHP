<?php

	function auth($login, $passwd)
	{
		if ($login == "" || $passwd == "")
			return false;

		if(!file_exists('../private/passwd'))
			return false;
		$users = unserialize(file_get_contents('../private/passwd'));

		$search = false;

		foreach ($users as $user) {
			if ($user['login'] == $login && $user['passwd'] == hash('sha512', $passwd))
			{
				$search = true;
				break;
			}
		}

		if ($search === false)
			return false;
		return true;
	}
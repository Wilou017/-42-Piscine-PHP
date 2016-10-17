<?php
	session_start();

	date_default_timezone_set("Europe/Paris");

	if ($_SESSION['loggued_on_user'] != "") {
		if (!file_exists('../private/chat'))
			$chats = Array();
		else
			$chats = unserialize(file_get_contents('../private/chat'));

		foreach ($chats as $chat) {
			printf("[%s] <b>%s</b>: %s<br />\n", date("H:i", $chat['time']), $chat['Login'], $chat['msg']);
		}
		echo "<script langage=\"javascript\">top.frames['chat'].location ='chat.php';</script>\n";
	}
	else
		echo "ERROR\n";

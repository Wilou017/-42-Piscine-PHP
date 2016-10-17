<?php
	session_start();

	if ($_SESSION['loggued_on_user'] != "") {
		if ($_POST['msg']) {
			if (!file_exists('../private/chat'))
				$chats = Array();
			else
				$chats = unserialize(file_get_contents('../private/chat'));
			$fd = fopen('../private/chat', 'a');
			flock($fd, LOCK_SH | LOCK_EX);
			$newpost = array('Login' => $_SESSION['loggued_on_user'],
					'time' => time(),
					'msg' => $_POST['msg']);
			file_put_contents('../private/chat', serialize(array_merge($chats, array($newpost))));
			fclose($fd);
		} ?>
		<form action="speak.php" method="post">
			<input type="text" name='msg'>
			<input type="submit" value="Envoyer">
		</form>
	<?php
	}
	else
		echo "ERROR\n";
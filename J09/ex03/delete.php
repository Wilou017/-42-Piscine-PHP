<?php

	$return = array('request' => false);

	if(isset($_POST['delete_todo']))
	{
		$fp = fopen('list.csv', 'a+');
		$oldTab = Array();
		 while (($data = fgetcsv($fp, 1000, ";")) !== FALSE)
		 {
		 	if($_POST['todoID'] != $data[0])
				$oldTab[] = $data;
		 }
		fclose($fp);

		$fp = fopen('list.csv', 'w');
		foreach ($oldTab as $todo) {
			fputcsv($fp, $todo, ";");
		}
		fclose($fp);
		$return['request'] = true;
	}

	echo json_encode($return);
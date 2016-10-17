<?php

	$return = array('request' => false);

	if(isset($_POST['insert_todo']))
	{
		$fp = fopen('list.csv', 'a+');

		$lastid = 0;

		 while (($data = fgetcsv($fp, 1000, ";")) !== FALSE)
			$lastid = $data[0] + 1;

		if (fputcsv($fp, array($lastid, htmlentities($_POST['todo'])), ";"));
			$return['request'] = true;
			$return['data'] = array($lastid, htmlentities($_POST['todo']));
		fclose($fp);
	}

	echo json_encode($return);
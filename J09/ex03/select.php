<?php

	$return = array('request' => false);

	if(isset($_POST['select_todo']))
	{
		$fp = fopen('list.csv', 'a+');

		$return['data'] = Array();

		 while (($data = fgetcsv($fp, 1000, ";")) !== FALSE)
			$return['data'][] = $data;
			$return['request'] = true;

		fclose($fp);
	}

	echo json_encode($return);
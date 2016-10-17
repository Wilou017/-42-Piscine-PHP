#!/usr/bin/php
<?php

	$handle = fopen("php://stdin","r");
	$users = Array();
	fgetcsv($handle, NULL, ';');
	$i = 0;
	while ($line = fgetcsv($handle, NULL, ';'))
	{
		if (is_numeric($line[1])) {
			if (array_key_exists($line[0], $users))
				$users[$line[0]][] = array('Note' => $line[1],
											'Noteur' => $line[2],
											'FB' => $line[3]);
			else
				$users[$line[0]][0] = array('Note' => $line[1],
											'Noteur' => $line[2],
											'FB' => $line[3]);
		}
	}

	ksort($users);

	if ($argc == 2 && $argv[1] == "moyenne")
	{
		$somme = 0;
		$nb_note = 0;
		foreach ($users as $nom => $user) {
			foreach ($user as $notes) {
				if($notes['Noteur'] != "moulinette")
				{
					$somme += $notes['Note'];
					$nb_note++;
				}
			}
		}
		echo ($somme / $nb_note)."\n";
	}
	elseif ($argc == 2 && $argv[1] == "moyenne_user")
	{
		foreach ($users as $nom => $user) {
			$somme = 0;
			$nb_note = 0;
			foreach ($user as $notes) {
				if($notes['Noteur'] != "moulinette")
				{
					$somme += $notes['Note'];
					$nb_note++;
				}
			}
			echo $nom.":".($somme/$nb_note)."\n";
		}
	}
	elseif ($argc == 2 && $argv[1] == "ecart_moulinette")
	{
		foreach ($users as $nom => $user) {
			$somme = 0;
			$nb_note = 0;
			foreach ($user as $notes) {
				if($notes['Noteur'] == "moulinette")
					$moulinette = $notes['Note'];
			}
			foreach ($user as $notes) {
				if($notes['Noteur'] != "moulinette")
				{
					$somme += $notes['Note'] - $moulinette;
					$nb_note++;
				}
			}
			echo $nom.":".($somme/$nb_note)."\n";
		}
	}
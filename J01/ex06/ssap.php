#!/usr/bin/php
<?php
	unset($argv[0]);
	$result = Array();
	foreach ($argv as $av)
	{
		$tab = explode(' ', $av);
		$lentab = count($tab);
		for ($i = 0; $i < $lentab; $i++) {
			if(strlen($tab[$i]) < 1)
				unset($tab[$i]);
		}
		$result = array_merge($result, $tab);
	}
	asort($result);
	$tab = array_values($tab);
	foreach ($result as $mot)
		echo "$mot\n";
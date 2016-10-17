#!/usr/bin/php
<?php
	if ($argc > 1)
	{
		unset($argv[0]);
		$tab = explode(' ', $argv[1]);
		$lentab = count($tab);
		for ($i = 0; $i < $lentab; $i++) {
			if(strlen($tab[$i]) < 1)
				unset($tab[$i]);
		}
		$tab[count($tab)] = $tab[0];
		unset($tab[0]);
		foreach ($tab as $mot)
			echo "$mot ";
		echo "\n";
	}
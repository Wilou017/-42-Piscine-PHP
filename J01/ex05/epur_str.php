#!/usr/bin/php
<?php
	if ($argc > 1)
	{
		$tab = explode(' ', trim($argv[1]));
		$lentab = count($tab);
		for ($i = 0; $i < $lentab; $i++) {
			if(strlen($tab[$i]) < 1)
				unset($tab[$i]);
		}
		echo implode(' ', $tab)."\n";
	}


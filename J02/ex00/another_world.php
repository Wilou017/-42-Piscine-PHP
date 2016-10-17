#!/usr/bin/php
<?php
	function cleararg($value)
	{
		$tab = explode(' ', trim($value));
		$lentab = count($tab);
		for ($i = 0; $i < $lentab; $i++) {
			if(strlen($tab[$i]) < 1)
				unset($tab[$i]);
		}
		return implode($tab, ' ');
	}

	if ($argc >= 2) {
		echo cleararg(str_replace("\t", ' ', $argv[1]))."\n";
	}
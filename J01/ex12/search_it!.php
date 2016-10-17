#!/usr/bin/php
<?php
	if ($argc >= 3) {
		$couples = Array();
		unset($argv[0]);
		$key = $argv[1];
		unset($argv[1]);
		foreach ($argv as $val) {
			$couples[] = split(':', $val);
		}
		for ($i = count($couples)-1; $i >= 0; $i--) {
			if($couples[$i][0] == $key){
				echo $couples[$i][1]."\n";
				break;
			}
		}
	}
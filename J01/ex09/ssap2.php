#!/usr/bin/php
<?php
	function ft_trie($result)
	{
		$num = Array();
		$ascii = Array();
		$string = Array();

		foreach ($result as $ele) {
			if(is_numeric($ele) == TRUE)
				$num[] = $ele;
		}
		asort($num, SORT_STRING);

		foreach ($result as $ele) {
			if(ctype_alpha($ele) == TRUE)
				$string[] = $ele;
		}
		sort($string, SORT_NATURAL | SORT_FLAG_CASE);

		foreach ($result as $ele) {
			if(ctype_alpha($ele) == FALSE && is_numeric($ele) == FALSE)
				$ascii[] = $ele;
		}
		sort($ascii);

		return array_merge($string, $num, $ascii);
	}

	unset($argv[0]);
	$result = Array();
	foreach ($argv as $av)

		$tab = explode(' ', $av);
		$lentab = count($tab);
		for ($i = 0; $i < $lentab; $i++) {
			if(strlen($tab[$i]) < 1)
				unset($tab[$i]);
		}
		$result = array_merge($result, $tab);
	}
	$result = array_values(ft_trie($result));
	foreach ($result as $mot)
		echo "$mot\n";
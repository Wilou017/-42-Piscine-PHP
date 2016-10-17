<?php
	function ft_split($str)
	{
		$tab = explode(' ', $str);
		$lentab = count($tab);
		for ($i = 0; $i < $lentab; $i++) {
			if(strlen($tab[$i]) < 1)
				unset($tab[$i]);
		}
		asort($tab);
		$tab = array_values($tab);
		return $tab;
	}
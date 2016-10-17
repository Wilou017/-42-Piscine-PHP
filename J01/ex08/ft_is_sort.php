<?php
	function ft_is_sort($tab)
	{
		$tab2 = $tab;
		asort($tab2);
		$tab2 = array_values($tab2);
		for ($i=0; $i < count($tab); $i++) {
			if($tab2[$i] != $tab[$i])
				return false;
		}
		return true;
	}
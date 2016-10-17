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
		return implode($tab);
	}

	function ft_gettab($value)
	{
		$value = cleararg($value);
		preg_match('/^([-]{0,1}\\d+)([\\/+\\-%*])([-]{0,1}\\d+)$/', $value, $matches);
		return ($matches);
	}

	if ($argc == 2) {
		$tab = ft_gettab($argv[1]);
		if (count($tab) < 4)
			echo "Syntax Error\n";
		else
		{
			$num1 = trim($tab[1]);
			$num2 = trim($tab[3]);
			$op = trim($tab[2]);

			switch ($op) {
				case '+':
					echo $num1 + $num2;
					break;
				case '-':
					echo $num1 - $num2;
					break;
				case '*':
					echo $num1 * $num2;
					break;
				case '/':
					echo $num1 / $num2;
					break;
				case '%':
					echo $num1 % $num2;
					break;
				default:
					break;
			}
			echo "\n";
		}
	}
	else echo "Incorrect Parameters\n";
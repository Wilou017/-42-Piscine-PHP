#!/usr/bin/php
<?php
	echo "Entrez un nombre: ";
	while (($nb = fgets(fopen("php://stdin","r")))) {
		$nb = trim($nb);
		if (!is_numeric($nb))
			echo "'$nb' n'est pas un chiffre\n";
		else
		{
			if ($nb % 2)
				echo "Le chiffre $nb est Impair\n";
			else
				echo "Le chiffre $nb est Pair\n";

		}
		echo "Entrez un nombre: ";
	}
	echo "\n";
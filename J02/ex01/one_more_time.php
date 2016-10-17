#!/usr/bin/php
<?php
	date_default_timezone_set("Europe/Paris");

	$months = ["Mois",
				"Janvier",
				"Fevrier",
				"Mars",
				"Avril",
				"Mai",
				"Juin",
				"Juillet",
				"Aout",
				"Septembre",
				"Octobre",
				"Novembre",
				"Decembre"];

	$days = ["Jour",
			"Lundi",
			"Mardi",
			"Mercredi",
			"Jeudi",
			"Vendredi",
			"Samedi",
			"Dimanche"];

	function parsing($str) {
		global $months, $days;

		$str = explode(" ", $str);
		$time = explode(":", $str[4]);

		$key_day = array_search(strtolower($str[0]), array_map('strtolower', $days));
		$key_month = array_search(strtolower($str[2]), array_map('strtolower', $months));


		$day = $str[1];
		$month = $key_month;
		$year = $str[3];
		$hour = $time[0];
		$min = $time[1];
		$sec = $time[2];

		if (count($str) != 5 || !checkdate($month, $day, $year) ||
			$key_month == FALSE || $key_day == FALSE ||
			!is_numeric($str[1]) || !is_numeric($str[3]) ||
			$hour > 23 || $hour < 0 || $min > 59 || $min < 0 || $sec > 59 || $sec < 0 ||
			strlen($hour) != 2 || strlen($min) != 2 || strlen($sec) != 2)
			die ("Wrong Format\n");

		echo mktime($hour, $min, $sec, $month, $day, $year, -1) . "\n";
	}


	if ($argc < 2)
		exit(1);
	parsing($argv[1]);
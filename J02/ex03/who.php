#!/usr/bin/php
<?php
	date_default_timezone_set('CET');
	$fd = fopen("/var/run/utmpx", "rb");
	while ($octs = fread($fd, 628))
	{
		$unpacked = unpack("a256login/a4id/a32line/ipid/itype/i1time/a256host/i16pad", $octs);
		if ($unpacked["type"] == 7)
			$user[$unpacked["line"]] = array("login" => $unpacked["login"], "time" => $unpacked["time"]);
	}
	ksort($user);
	foreach($user as $line => $data){
		$test = printf("%-7s  %-7s  %s\n", $data["login"], $line,date("M  j H:i", $data["time"]));
	}
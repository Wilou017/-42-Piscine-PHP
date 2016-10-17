#!/usr/bin/php
<?php
	function inspect($prev_matches) {
		$str = preg_replace_callback(array('/(>)(.*?)(<)/s', '/(title=")(.*?)(")/s'), function ( $matches ) { return ($matches[1] . strtoupper( $matches[2]) . $matches[3] ); }, $prev_matches[0]);
		return $str;
	}

	if ($argc != 2 || !file_exists($argv[1]))
		exit(1);

	$str = file_get_contents($argv[1]);
	if($str)
	{
		$pattern = '/<a\s*(.*?)>(.*?)<\/a>/s';
		$str = preg_replace_callback($pattern, "inspect", $str);
		echo $str;
	}
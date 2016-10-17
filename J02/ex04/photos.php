#!/usr/bin/php
<?php
	if($argc < 2)
		die();

	unset($argv[0]);
	foreach ($argv as $site) {
		if(preg_match('/https{0,1}:\\/\\/(.+\\.\\w+)/', $site, $matches))
		{
			mkdir($matches[1]);
			$str = file_get_contents($site);
			if(preg_match('/<img .*src="(.*)".*>/', $str, $images))
			{
				unset($images[0]);
				foreach ($images as $img_link) {
					if (!preg_match('/https{0,1}:\\/\\//', $img_link))
						$img_link = $site.$img_link;

					copy($img_link,$matches[1].'/'.array_pop(explode('/',$img_link)));
					echo "$img_link in ".$matches[1].'/'.array_pop(explode('/',$img_link));
				}
				var_dump($images);
			}
		}
	}
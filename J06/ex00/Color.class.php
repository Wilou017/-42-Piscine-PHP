<?php

	/**
	*  Color
	*/
	class Color
	{

		public $red = 0;
		public $green = 0;
		public $blue = 0;
		public static $verbose = False;

		public function __construct(array $tab)
		{
			if(array_key_exists('rgb', $tab) && is_numeric($tab['rgb']))
			{
				$hexa = dechex(intval($tab['rgb']));
				$hexa = sprintf("%06s", $hexa);

				$this->setRed(hexdec(substr($hexa, 0, 2)))
						->setGreen(hexdec(substr($hexa, 2, 2)))
						->setBlue(hexdec(substr($hexa, 4, 2)));
			}
			else if (array_key_exists('red', $tab) || array_key_exists('green', $tab) || array_key_exists('blue', $tab))
			{
				if (array_key_exists('red', $tab) && is_numeric($tab['red']) && $tab['red'] >= 0 && $tab['red'] <= 255)
					$this->setRed($tab['red']);
				if (array_key_exists('green', $tab) && is_numeric($tab['green']) && $tab['blue'] >= 0 && $tab['blue'] <= 255)
					$this->setGreen($tab['green']);
				if (array_key_exists('blue', $tab) &&is_numeric($tab['blue']) &&$tab['green'] >= 0 && $tab['green'] <= 255)
					$this->setBlue($tab['blue']);
			}
			else
				die("Unable instantiation". PHP_EOL);

			if (self::$verbose === True)
				printf('Color( red: % 3d, green: % 3d, blue: % 3d ) constructed.'.PHP_EOL, $this->getRed(), $this->getGreen(), $this->getBlue());
		}

		function __destruct()
		{
			if (self::$verbose === True)
				printf('Color( red: % 3d, green: % 3d, blue: % 3d ) destructed.'.PHP_EOL, $this->getRed(), $this->getGreen(), $this->getBlue());
		}
		function __toString()
		{
			return (sprintf('Color( red: % 3d, green: % 3d, blue: % 3d )', $this->getRed(), $this->getGreen(), $this->getBlue()));
		}

		static function doc()
		{
			return (file_get_contents(__DIR__."/Color.doc.txt"). PHP_EOL);
		}

		public function getRed(){
			return $this->red;
		}

		public function setRed($val){
			$this->red = intval($val);
			return  $this;
		}

		public function getBlue(){
			return $this->blue;
		}

		public function setBlue($val){
			$this->blue = intval($val);
			return  $this;
		}

		public function getGreen(){
			return $this->green;
		}

		public function setGreen($val){
			$this->green = intval($val);
			return  $this;
		}

		public function add(Color $instance)
		{
			return new Color(array('red' => $instance->red + $this->getRed(),
									'green' => $instance->green + $this->getGreen(),
									'blue' => $instance->blue + $this->getBlue()));
		}

		public function sub(Color $instance)
		{
			return new Color(array('red' => abs($instance->red - $this->getRed()),
									'green' => abs($instance->green - $this->getGreen()),
									'blue' => abs($instance->blue - $this->getBlue())));
		}

		public function mult($f)
		{
			return new Color(array('red' => $f * $this->getRed(),
									'green' => $f * $this->getGreen(),
									'blue' => $f * $this->getBlue()));
		}
	}

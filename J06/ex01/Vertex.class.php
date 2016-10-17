<?php

	require_once 'Color.class.php';

	/**
	*  Vertex
	*/
	class Vertex
	{

		private $_x;
		private $_y;
		private $_z;
		private $_w = 1.0;
		private $_color;
		private $_colordefined = false;
		public static $verbose = False;

		public function __construct(array $tab)
		{

			if (array_key_exists('x', $tab) && array_key_exists('y', $tab) && array_key_exists('z', $tab))
			{
				$this->setX($tab['x'])->setY($tab['y'])->setZ($tab['z']);

				if (array_key_exists('w', $tab))
					$this->setW($tab['w']);

				if (array_key_exists('color', $tab))
					$this->setColor($tab['color']);
				else
				{
					$_colordefined = true;
					$this->setColor(new Color(array('red' => 0xff, 'green' => 0xff, 'blue' => 0xff)));
				}

			}
			else
				die("Unable instantiation". PHP_EOL);

			if (self::$verbose === True)
				printf('Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s ) constructed'.PHP_EOL, $this->getX(), $this->getY(), $this->getZ(), $this->getW(), $this->getColor());
		}

		function __destruct()
		{
			if (self::$verbose === True)
				printf('Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s ) distructed'.PHP_EOL, $this->getX(), $this->getY(), $this->getZ(), $this->getW(), $this->getColor());
		}
		function __toString()
		{
			return (sprintf('Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f%s )', $this->getX(), $this->getY(), $this->getZ(), $this->getW(), (!$this->_colordefined && self::$verbose === True) ? (", ".$this->getColor()) : ""));
		}

		static function doc()
		{
			return (file_get_contents(__DIR__."/Vertex.doc.txt"). PHP_EOL);
		}

		public function getX(){
			return $this->_x;
		}

		public function setX($val){
			$this->_x = $val;
			return  $this;
		}

		public function getY(){
			return $this->_y;
		}

		public function setY($val){
			$this->_y = $val;
			return  $this;
		}

		public function getZ(){
			return $this->_z;
		}

		public function setZ($val){
			$this->_z = $val;
			return  $this;
		}

		public function getW(){
			return $this->_w;
		}

		public function setW($val){
			$this->_w = $val;
			return  $this;
		}

		public function getColor(){
			return $this->_color;
		}

		public function setColor($val){
			$this->_color = $val;
			return  $this;
		}
	}

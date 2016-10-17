<?php

	require_once 'Vertex.class.php';

	/**
	*  Vector
	*/
	Class Vector
	{
		private $_x = 1.0;
		private $_y = 1.0;
		private $_z = 1.0;
		private $_w = 0.0;
		public static $verbose = False;

		public function __construct( array $tab )
		{
		if (array_key_exists("x", $tab) &&
			array_key_exists("y", $tab) &&
			array_key_exists("z", $tab))
		{
			$this->_x = $tab["x"];
			$this->_y = $tab["y"];
			$this->_z = $tab["z"];
		}
		else
		{
			if (!array_key_exists("orig", $tab) )
				$tab["orig"] = new Vertex(array("x" => 0.0,
												   "y" => 0.0,
												   "z" => 0.0));
			$this->_x = $tab["dest"]->getX() - $tab["orig"]->getX();
			$this->_y = $tab["dest"]->getY() - $tab["orig"]->getY();
			$this->_z = $tab["dest"]->getZ() - $tab["orig"]->getZ();
			$this->_w = 0.0;
		}

			if (self::$verbose === True)
				printf('Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) constructed'.PHP_EOL, $this->getX(), $this->getY(), $this->getZ(), $this->getW());

		}

		public function __toString()
		{
			return(sprintf('Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f )', $this->getX(), $this->getY(), $this->getZ(), $this->getW()));
		}

		public function __destruct()
		{
			printf('Vector( x:%.2f, y:%.2f, z:%.2f, w:%.2f ) destructed'.PHP_EOL, $this->getX(), $this->getY(), $this->getZ(), $this->getW());
		}

		public function __get($attr)
		{
			return ($this->$attr);
		}

		static function doc()
		{
			return (file_get_contents(__DIR__.'/Vector.doc.txt'). PHP_EOL);
		}

		public function normalize()
		{
			$norme = $this->magnitude();
			return (new Vector(['dest' => new Vertex(['x' => $this->_x / $norme, 'y' => $this->_y / $norme, 'z' => $this->_z / $norme])]));
		}

		public function add ($rhs)
		{
			$x = $this->getX() + $rhs->getX();
			$y = $this->getY() + $rhs->getY();
			$z = $this->getZ() + $rhs->getZ();
			$vec = new Vertex( array( 'x' => $x, 'y' => $y, 'z' => $z, 'w' => 0 ) );
			return (new Vector(array('dest' => $vec)));
		}

		public function sub ($rhs)
		{
			$x = $this->getX() - $rhs->getX();
			$y = $this->getY() - $rhs->getY();
			$z = $this->getZ() - $rhs->getZ();
			$vec = new Vertex( array( 'x' => $x, 'y' => $y, 'z' => $z, 'w' => 0 ) );
			return (new Vector(array('dest' => $vec)));
		}

		public function scalarProduct($k)
		{
			return (new Vector(['dest' => new Vertex(['x' => $this->_x * $k, 'y' => $this->_y * $k, 'z' => $this->_z * $k])]));
		}

		public function dotProduct($rhs)
		{
			$x = $this->getX() * $rhs->getX();
			$y = $this->getY() * $rhs->getY();
			$z = $this->getZ() * $rhs->getZ();
			return ($x + $y + $z);
		}

		public function cos($rhs)
		{
			return ($this->_x * $rhs->_x + $this->_y * $rhs->_y + $this->_z * $rhs->_z) /
			sqrt(($this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z) * ($rhs->_x * $rhs->_x +
				  $rhs->_y * $rhs->_y + $rhs->_z * $rhs->_z));

		}

		public function crossProduct($rhs)
		{
			return new Vector(array("x" =>	$this->_y * $rhs->_z - $this->_z * $rhs->_y,
									"y" =>	$this->_z * $rhs->_x - $this->_x * $rhs->_z,
									"z" =>	$this->_x * $rhs->_y - $this->_y * $rhs->_x));

		}

		public function opposite()
		{
			$x = $this->getX() * -1;
			$y = $this->getY() * -1;
			$z = $this->getZ() * -1;
			$tab = new Vertex ( array('x' => $x, 'y' => $y, 'z' => $z, 'w' => $this->getW()));
			return (new Vector( array('dest' => $tab)));
		}
		public function magnitude()
		{
			return (sqrt(($this->_x * $this->_x) + ($this->_y * $this->_y) + ($this->_z * $this->_z)));
		}

		public function getX()
		{
			return $this->_x;
		}

		public function getY()
		{
			return $this->_y;
		}

		public function getZ()
		{
			return $this->_z;
		}

		public function getW()
		{
			return $this->_w;
		}


	}
<?php

	/**
	* Lannister
	*/
	class Lannister
	{
		function sleepWith($class)
		{
			if($class instanceof Cersei || $class instanceof Tyrion)
				echo "Not even if I'm drunk !\n";
		}
	}
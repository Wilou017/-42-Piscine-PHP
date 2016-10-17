<?php

	/**
	* Tyrion
	*/
	class Tyrion
	{
		function sleepWith($class)
		{
			if($class instanceof Cersei || $class instanceof Jaime)
				echo "Not even if I'm drunk !\n";
			if($class instanceof Sansa)
				echo "Let's do this.\n";

		}
	}
<?php

	/**
	* Jaime
	*/
	class Jaime
	{
		function sleepWith($class)
		{
			if($class instanceof Sansa)
				echo "Let's do this.\n";
			if($class instanceof Tyrion)
				echo "Not even if I'm drunk !\n";
			if($class instanceof Cersei)
				echo "With pleasure, but only in a tower in Winterfell, then.\n";
		}
	}
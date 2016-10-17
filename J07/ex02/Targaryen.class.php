<?php

	/**
	* Targaryen
	*/
	class Targaryen
	{
		function resistsFire()
		{
			return false;
		}

		function getBurned()
		{
			if (!static::resistsFire())
				return "burns alive";
			else
				return "emerges naked but unharmed";
		}
	}
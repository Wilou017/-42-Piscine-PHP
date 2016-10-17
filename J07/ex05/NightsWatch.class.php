<?php

	/**
	* NightsWatch
	*/
	class NightsWatch implements IFighter
	{
		private $array;

		public function recruit($class)
		{
			if ($class instanceof IFighter)
			{
				$this->array[] = $class;
			}
		}
		public function fight()
		{
			foreach ($this->array as $value) {
				$value->fight();
			}
		}
	}
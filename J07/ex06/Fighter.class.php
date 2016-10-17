<?php
	ini_set('display_errors','on');

	/**
	* Fighter
	*/
	abstract class Fighter
	{

		private $type;

		abstract function fight($target);

		function __construct($type)
		{
			$this->type = $type;
		}

		function getType()
		{
			return ($this->type);
		}
	}
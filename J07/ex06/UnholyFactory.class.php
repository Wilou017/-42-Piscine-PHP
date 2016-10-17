<?php

	/**
	* UnholyFactory
	*/
	class UnholyFactory
	{
		public $types;

		function __construct()
		{
			$this->types = Array();
		}

		function absorb($class)
		{
			if (!($class instanceof Fighter)) {
				print("(Factory can't absorb this, it's not a fighter)\n");
			}
			else if(array_key_exists($class->getType(), $this->types))
				printf("(Factory already absorbed a fighter of type %s)\n", $class->getType());
			else
			{
				printf("(Factory absorbed a fighter of type %s)\n", $class->getType());
				$this->types[$class->getType()] = $class;
			}
		}

		function fabricate($requested_fighter)
		{
			if(array_key_exists($requested_fighter, $this->types))
			{
				printf("(Factory fabricates a fighter of type %s)\n", $requested_fighter);
				return $this->types[$requested_fighter];
			}
			else
				printf("(Factory hasn't absorbed any fighter of type %s)\n", $requested_fighter);
			return NULL;
		}
	}
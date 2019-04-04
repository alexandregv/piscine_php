<?php

abstract class Fighter
{
	private $_type;

	public function __construct($type)
	{
		$this->_type = $type;	
	}

	abstract public function fight($target);

	public function getType()
	{
		return $this->_type;
	}
}

?>

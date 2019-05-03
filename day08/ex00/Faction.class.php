<?php

abstract class Faction
{
	private $_name;
	private $_motto;

	public function __construct()
	{

	}

	public function getName()  { return $this->_name;  }
	public function getMotto() { return $this->_motto; }

	private function setName()  { return $this->_name;  }
	private function setMotto() { return $this->_motto; }
}

?>

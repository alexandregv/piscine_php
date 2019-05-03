<?php

class Orks extends Faction
{
	private $_name = "Orks";	
	private $_motto = "GRRRRRRRRRR";	

	public function getName()  { return $this->_name; }
	public function getMotto() { return $this->_motto; }
}

?>

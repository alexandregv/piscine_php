<?php

require_once('Faction.class.php');

class Empire extends Faction
{
	public function __construct()
	{
		parent::__construct();
		$this->_name = 'The Empire';
		$this->_motto = 'For the Empire!';
	}
}

?>

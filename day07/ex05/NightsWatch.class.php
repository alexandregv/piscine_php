<?php

class NightsWatch
{
	private $_fighters = [];

	public function recruit($fighter)
	{
		if ($fighter instanceof IFighter)
			$this->_fighters[] = $fighter;	
	}

	public function fight()
	{
		foreach ($this->_fighters as $fighter)
			$fighter->fight();
	}
}

?>

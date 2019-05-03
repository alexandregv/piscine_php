<?php

require_once('Ship.class.php');

class ShipFactory
{
	private $_absorbedTypes = [];

	public function absorb($ship)
	{
		if ($ship instanceof IShip)
		{
			$type = $ship->getType();
			if (in_array($type, $this->_absorbedTypes))
				echo "(Factory already absorbed a ship of type $type)", PHP_EOL;
			else
			{
				$this->_absorbedTypes[] = $type;
				echo "(Factory absorbed a ship of type $type)", PHP_EOL;
			}
		}
		else echo "(Factory can't absorb this, it's not a ship)", PHP_EOL;
	}

	public function fabricate($type)
	{
		if (in_array($type, $this->_absorbedTypes))
		{
			echo "(Factory fabricates a ship of type $type)", PHP_EOL;
			$className = str_replace(' ', '', ucwords($type));
			return new $className();
		}
		else echo "(Factory hasn't absorbed any ship of type $type)", PHP_EOL;
		return NULL;
	}

}

?>

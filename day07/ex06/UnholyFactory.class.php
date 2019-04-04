<?php

class UnholyFactory
{
	private $_absorbedTypes = [];

	public function absorb($fighter)
	{
		if ($fighter instanceof Fighter)
		{
			$type = $fighter->getType();
			if (in_array($type, $this->_absorbedTypes))
				echo "(Factory already absorbed a fighter of type $type)", PHP_EOL;
			else
			{
				$this->_absorbedTypes[] = $type;
				echo "(Factory absorbed a fighter of type $type)", PHP_EOL;
			}
		}
		else echo "(Factory can't absorb this, it's not a fighter)", PHP_EOL;
	}

	public function fabricate($type)
	{
		if (in_array($type, $this->_absorbedTypes))
		{
			echo "(Factory fabricates a fighter of type $type)", PHP_EOL;
			$className = str_replace(' ', '', ucwords($type));
			return new $className();
		}
		else echo "(Factory hasn't absorbed any fighter of type $type)", PHP_EOL;
		return NULL;
	}
}

?>

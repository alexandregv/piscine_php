<?php

class Lannister
{
	public function sleepWith($other)
    {
        if ($other instanceof Lannister)
            echo "Not even if I'm drunk !", PHP_EOL;
        else
            echo "Let's do this.", PHP_EOL;
    }
}

?>
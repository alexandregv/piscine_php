<?php

class Jaime extends Lannister
{
    public function sleepWith($other)
    {
        if ($other instanceof Cersei)
            echo 'With pleasure, but only in a tower in Winterfell, then.', PHP_EOL;
        else
            parent::sleepWith($other);
    }
}

?>

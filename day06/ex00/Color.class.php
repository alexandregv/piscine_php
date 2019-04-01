<?php

class Color
{
	public static $verbose = False;

	public $red = 0;
	public $green = 0;
	public $blue = 0;

	function __construct($params)
	{
		if (!empty($params['rgb']))
		{
			list($this->red, $this->green, $this->blue) = sscanf($params['rgb'], "#%02x%02x%02x");
		
		}
		else if (isset($params['red']) && isset($params['green']) && isset($params['blue']))
		{
			$this->red   = floor($params['red'  ]);
			$this->green = floor($params['green']);
			$this->blue  = floor($params['blue' ]);
			if (self::$verbose === True)
				echo "Color( red: ", str_pad($this->red, 3, ' ', STR_PAD_LEFT), ", green: ", str_pad($this->green, 3, ' ', STR_PAD_LEFT), ", blue: ", str_pad($this->blue, 3, ' ', STR_PAD_LEFT), " ) constructed.\n";
		}
		else exit("ERROR\n");
	}

	function __destruct()
	{
		//if (self::$verbose === True)
		//	echo "Destruct", "\n";
	}

	function __toString()
	{
		return "Color( red: $this->red, green: $this->green, blue: $this->blue )\n";
	}

	public function doc()
	{
		return "lol une doc\n";
	}

	public function add($other)
	{
		return new Color(array('red' => $this->red + $other->red, 'green' => $this->green + $other->green, 'blue' => $this->blue + $other->blue));
	}

	public function sub($other)
	{
		return new Color(array('red' => $this->red - $other->red, 'green' => $this->green - $other->green, 'blue' => $this->blue - $other->blue));
	}

	public function mult($other)
	{
		return new Color(array('red' => $this->red * $other->red, 'green' => $this->green * $other->green, 'blue' => $this->blue * $other->blue));
	}
}

?>

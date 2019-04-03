<?php

class Color
{
	public static $verbose = False;

	// ======[ Atributes ]=====

	public $red = 0;
	public $green = 0;
	public $blue = 0;
	public $dec = 0;

	// ======[ Special methods ]=====

	function __construct($params)
	{
		if (!empty($params['rgb']))
		{
			$this->red   = floor($params['rgb'] / (256 * 256));
			$this->green = floor($params['rgb'] / 256) % 256;
			$this->blue  = $params['rgb'] % 256;
		}
		else if (isset($params['red']) && isset($params['green']) && isset($params['blue']))
		{
			$this->red   = floor($params['red'  ]);
			$this->green = floor($params['green']);
			$this->blue  = floor($params['blue' ]);
		}
		if (self::$verbose === True)
			echo "Color( red: ", str_pad($this->red, 3, ' ', STR_PAD_LEFT), ", green: ", str_pad($this->green, 3, ' ', STR_PAD_LEFT), ", blue: ", str_pad($this->blue, 3, ' ', STR_PAD_LEFT), " ) constructed.\n";
	}

	function __destruct()
	{
		if (self::$verbose === True)
			echo "Color( red: ", str_pad($this->red, 3, ' ', STR_PAD_LEFT), ", green: ", str_pad($this->green, 3, ' ', STR_PAD_LEFT), ", blue: ", str_pad($this->blue, 3, ' ', STR_PAD_LEFT), " ) destructed.\n";
	}

	function __toString()
	{
		return ("Color( red: " . str_pad($this->red, 3, ' ', STR_PAD_LEFT) . ", green: " . str_pad($this->green, 3, ' ', STR_PAD_LEFT) . ", blue: " . str_pad($this->blue, 3, ' ', STR_PAD_LEFT) . " )");
	}

	// ======[ Class methods ]=====

	public static function doc() { return "\n" . file_get_contents(__CLASS__ . '.doc.txt'); }

	// ======[ Intance methods ]=====

	public function add($other)
	{
		return new Color(array('red' => $this->red + $other->red, 'green' => $this->green + $other->green, 'blue' => $this->blue + $other->blue));
	}

	public function sub($other)
	{
		return new Color(array('red' => $this->red - $other->red, 'green' => $this->green - $other->green, 'blue' => $this->blue - $other->blue));
	}

	public function mult($f)
	{
		return new Color(array('red' => $this->red * $f, 'green' => $this->green * $f, 'blue' => $this->blue * $f));
	}
}

?>

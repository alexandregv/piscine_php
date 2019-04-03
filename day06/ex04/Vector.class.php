<?php

require_once 'Color.class.php';
require_once 'Vertex.class.php';

class Vector
{
	public static $verbose = False;

	// ======[ Atributes ]=====

	private $_x;
	private $_y;
	private $_z;
	private $_w;

	// ======[ Special methods ]=====

	function __construct(array $kwargs)
	{
		if (array_key_exists('orig', $kwargs))
			$orig = $kwargs['orig'];
		else
			$orig = new Vertex(['x' => 0.0, 'y' => 0.0, 'z' => 0.0, 'w' => 1.0]);

		$this->_x = $kwargs['dest']->getX() - $orig->getX();
		$this->_y = $kwargs['dest']->getY() - $orig->getY();
		$this->_z = $kwargs['dest']->getZ() - $orig->getZ();
		$this->_w = 0.0;
	
		if (self::$verbose === True)
			echo 'Vector( ',
				'x:', number_format($this->getX(), 2, '.', ''), ', ',
				'y:', number_format($this->getY(), 2, '.', ''), ', ',
				'z:', number_format($this->getZ(), 2, '.', ''), ', ',
				'w:', number_format($this->getW(), 2, '.', ''),
				" ) constructed\n";	
	}

	function __destruct()
	{
		if (self::$verbose === True)
			echo 'Vector( x:', number_format($this->getX(), 2, '.', ''), ', y:', number_format($this->getY(), 2, '.', ''), ', z:', number_format($this->getZ(), 2, '.', ''), ', w:', number_format($this->getW(), 2, '.', ''), " ) destructed\n";	
	}

	function __toString()
	{
		return 'Vector( x:' . number_format($this->getX(), 2, '.', '') . ', y:' . number_format($this->getY(), 2, '.', '') . ', z:' . number_format($this->getZ(), 2, '.', '') . ', w:' . number_format($this->getW(), 2, '.', '') . ' )';	
	}

	// ======[ Class methods ]=====

	public static function doc() { return "\n" . file_get_contents(__CLASS__ . '.doc.txt'); }

	// ======[ Accessors ]=====

	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }
	public function getZ() { return $this->_z; }
	public function getW() { return $this->_w; }

	// ======[ Instance methods ]=====

	public function magnitude()
	{
		return (float)(sqrt(pow($this->getX(), 2) + pow($this->getY(), 2) + pow($this->getZ(), 2)
		));
	}

	public function normalize()
	{
		$mag = $this->magnitude();
		if ($mag == 1.0)
			return clone $this;
		return new Vector(['dest' => new Vertex([
			'x' => $this->getX() / $mag,
			'y' => $this->getY() / $mag,
			'z' => $this->getZ() / $mag]
		)]);
	}

	public function add(Vector $rhs)
	{
		return new Vector(['dest' => new Vertex([
			'x' => $this->getX() + $rhs->getX(),
			'y' => $this->getY() + $rhs->getY(),
			'z' => $this->getZ() + $rhs->getZ()
		])]);
	}

	public function sub(Vector $rhs)
	{
		return new Vector(['dest' => new Vertex([
			'x' => $this->getX() - $rhs->getX(),
			'y' => $this->getY() - $rhs->getY(),
			'z' => $this->getZ() - $rhs->getZ()
		])]);
	}

	public function opposite()
	{
		return new Vector(['dest' => new Vertex([
			'x' => -$this->getX(),
			'y' => -$this->getY(),
			'z' => -$this->getZ()])]);
	}

	public function scalarProduct($k)
	{
		return new Vector(['dest' => new Vertex([
			'x' => $this->getX() * $k,
			'y' => $this->getY() * $k,
			'z' => $this->getZ() * $k
		])]);
	}

	public function dotProduct(Vector $rhs)
	{
		return (float)($this->getX() * $rhs->getX() + $this->getY() * $rhs->getY() + $this->getZ() * $rhs->getZ()
		);
	}

	public function crossProduct(Vector $rhs)
	{
		return new Vector(['dest' => new Vertex([
			'x' => $this->getY() * $rhs->getZ() - $this->getZ() * $rhs->getY(),
			'y' => $this->getZ() * $rhs->getX() - $this->getX() * $rhs->getZ(),
			'z' => $this->getX() * $rhs->getY() - $this->getY() * $rhs->getX()
		])]);
	}

	public function cos(Vector $rhs)
	{
		return ($this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude()));	
	}

}

?>

<?php

require_once 'Color.class.php';

class Vertex
{
	public static $verbose = False;

	private $_x;
	private $_y;
	private $_z;
	private $_w;
	private $_color;

	// ======[ Special methods ]=====

	function __construct(array $kwargs)
	{
		$this->setX($kwargs['x']);
		$this->setY($kwargs['y']);
		$this->setZ($kwargs['z']);
		
		if (array_key_exists('w', $kwargs))
			$this->setW($kwargs['w']);
		else
			$this->setW(1.0);
		
		if (array_key_exists('color', $kwargs))
			$this->setColor($kwargs['color']);
		else
			$this->setColor(new Color(array('red' => 255, 'green' => 255, 'blue' => 255)));

		if (self::$verbose === True)
			echo 'Vertex( x: ', number_format($this->getX(), 2, '.', ''), ', y: ', number_format($this->getY(), 2, '.', ''), ', z:', number_format($this->getZ(), 2, '.', ''), ', w:', number_format($this->getW(), 2, '.', ''), ', ', $this->getColor() , " ) constructed\n";	
	}

	function __destruct()
	{
		if (self::$verbose === True)
			echo 'Vertex( x: ', number_format($this->getX(), 2, '.', ''), ', y: ', number_format($this->getY(), 2, '.', ''), ', z:', number_format($this->getZ(), 2, '.', ''), ', w:', number_format($this->getW(), 2, '.', ''), ', ', $this->getColor() , " ) destructed\n";	
	}

	function __toString()
	{
		if (self::$verbose === True)
			return 'Vertex( x: ' . number_format($this->getX(), 2, '.', '') . ', y: ' . number_format($this->getY(), 2, '.', '') . ', z:' . number_format($this->getZ(), 2, '.', '') . ', w:' . number_format($this->getW(), 2, '.', '') . ', ' . $this->getColor() . ' )';	
		else
			return 'Vertex( x: ' . number_format($this->getX(), 2, '.', '') . ', y: ' . number_format($this->getY(), 2, '.', '') . ', z:' . number_format($this->getZ(), 2, '.', '') . ', w:' . number_format($this->getW(), 2, '.', '') . ' )';	
	}

	// ======[ Class methods ]=====

	public static function doc()
	{
		return "\n" . file_get_contents('Vertex.doc.txt');
	}

	// ======[ Accessors ]=====

	public function getX() { return $this->_x; }
	public function getY() { return $this->_y; }
	public function getZ() { return $this->_z; }
	public function getW() { return $this->_w; }
	public function getColor() { return $this->_color; }

	public function setX($val) { $this->_x = $val; }
	public function setY($val) { $this->_y = $val; }
	public function setZ($val) { $this->_z = $val; }
	public function setW($val) { $this->_w = $val; }
	public function setColor($val) { $this->_color = $val; }

	// ======[ Instance methods ]=====

}

?>

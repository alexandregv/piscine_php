<?php

require_once 'Color.class.php';
require_once 'Vertex.class.php';
require_once 'Vector.class.php';

class Matrix
{
	public static $verbose = False;

	// ======[ Class constants ]=====

	const IDENTITY		= 'IDENTITY';
	const SCALE			= 'SCALE';
	const RX			= 'Ox ROTATION';
	const RY			= 'Oy ROTATION';
	const RZ			= 'Oz ROTATION';
	const TRANSLATION	= 'TRANSLATION';
	const PROJECTION	= 'PROJECTION';

	// ======[ Atributes ]=====

	public $matrix = [];

	private $_preset;
	private $_scale;
	private $_angle;
	private $_vtc;
	private $_fov;
	private $_ratio;
	private $_near;
	private $_far;

	// ======[ Special methods ]=====

	function __construct(array $kwargs)
	{
		$this->setPreset($kwargs['preset']);

		if ($_preset == SCALE || array_key_exists('scale', $kwargs))
			$this->setScale($kwargs['scale']);

		if ($_preset == RX || $_preset == RY || $_preset == RZ || array_key_exists('angle', $kwargs))
			$this->setAngle($kwargs['angle']);

		if ($_preset == TRANSLATION || array_key_exists('vtc', $kwargs))
			$this->setVtc($kwargs['vtc']);

		if ($_preset == PROJECTION || array_key_exists('fov', $kwargs))
			$this->setFov($kwargs['fov']);

		if ($_preset == PROJECTION || array_key_exists('ratio', $kwargs))
			$this->setRatio($kwargs['ratio']);

		if ($_preset == PROJECTION || array_key_exists('near', $kwargs))
			$this->setNear($kwargs['near']);

		if ($_preset == PROJECTION || array_key_exists('far', $kwargs))
			$this->setFar($kwargs['far']);

		if (self::$verbose === True && !empty($this->getPreset()))
			echo 'Matrix ', $this->getPreset(), ($this->getPreset() == Matrix::IDENTITY ? '' : ' preset') ," instance constructed\n";

		$this->matrix = array_fill(0, 16, 0.00);
		$presetFunction = '_preset' . str_replace(' ', '', ucwords(strtolower($kwargs['preset'])));
		if (!empty($kwargs['preset']))
			$this->{$presetFunction}();
	}

	function __destruct()
	{
		if (self::$verbose === True)
			echo "Matrix instance destructed\n";	
	}

	function __toString()
	{
		return (
			"M | vtcX | vtcY | vtcZ | vtxO\n".
			"-----------------------------\n".
			'x | '. number_format($this->getMatrixAt(0, 0), 2, '.', ''). ' | '. number_format($this->getMatrixAt(0, 1), 2, '.', ''). ' | '. number_format($this->getMatrixAt(0, 2), 2, '.', ''). ' | '. number_format($this->getMatrixAt(1, 3), 2, '.', ''). "\n".
			'y | '. number_format($this->getMatrixAt(1, 0), 2, '.', ''). ' | '. number_format($this->getMatrixAt(1, 1), 2, '.', ''). ' | '. number_format($this->getMatrixAt(1, 2), 2, '.', ''). ' | '. number_format($this->getMatrixAt(1, 3), 2, '.', ''). "\n".
			'z | '. number_format($this->getMatrixAt(2, 0), 2, '.', ''). ' | '. number_format($this->getMatrixAt(2, 1), 2, '.', ''). ' | '. number_format($this->getMatrixAt(2, 2), 2, '.', ''). ' | '. number_format($this->getMatrixAt(2, 3), 2, '.', ''). "\n".
			'w | '. number_format($this->getMatrixAt(3, 0), 2, '.', ''). ' | '. number_format($this->getMatrixAt(3, 1), 2, '.', ''). ' | '. number_format($this->getMatrixAt(3, 2), 2, '.', ''). ' | '. number_format($this->getMatrixAt(3, 3), 2, '.', '')
		);
	}

	// ======[ Class methods ]=====

	public static function doc() { return "\n" . file_get_contents(__CLASS__ . '.doc.txt'); }

	// ======[ Accessors ]=====

	public function getPreset()	{ return $this->_preset; }
	public function getScale()	{ return $this->_scale; }
	public function getAngle()	{ return $this->_angle; }
	public function getVtc()	{ return $this->_vtc; }
	public function getFov()	{ return $this->_fov; }
	public function getRatio()	{ return $this->_ratio; }
	public function getNear()	{ return $this->_near; }
	public function getFar()	{ return $this->_far; }

	private function setPreset($val)	{ $this->_preset = $val; }
	private function setScale($val)		{ $this->_scale	= $val; }
	private function setAngle($val)		{ $this->_angle = $val; }
	private function setVtc($val)		{ $this->_vtc = $val; }
	private function setFov($val)		{ $this->_fov = $val; }
	private function setRatio($val)		{ $this->_ratio = $val; }
	private function setNear($val)		{ $this->_near = $val; }
	private function setFar($val)		{ $this->_far = $val; }

	// ======[ Instance public methods ]=====

	public function getMatrixAt($x, $y)			{ return $this->matrix[$y + $x + 3 * $x]; }
	public function setMatrixAt($x, $y, $val)	{ $this->matrix[$y + $x + 3 * $x] = $val; }

	public function mult(Matrix $rhs)
	{
		$coords = [];
		for ($y = 0; $y < 16; $y += 4)
		{
			for ($x = 0; $x < 4; $x++)
			{
				$coords[$y + $x] = 0;
				$coords[$y + $x] += $this->matrix[$y + 0] * $rhs->matrix[$x + 0];
				$coords[$y + $x] += $this->matrix[$y + 1] * $rhs->matrix[$x + 4];
				$coords[$y + $x] += $this->matrix[$y + 2] * $rhs->matrix[$x + 8];
				$coords[$y + $x] += $this->matrix[$y + 3] * $rhs->matrix[$x + 12];
			}
		}
		$matrix = new Matrix([]);
		$matrix->matrix = $coords;
		return $matrix;
	}

	public function transformVertex(Vertex $vtx)
	{
		$args = [];
		$args['x'] = ($vtx->getX() * $this->getMatrixAt(0, 0)) + ($vtx->getY() * $this->getMatrixAt(0, 1)) + ($vtx->getZ() * $this->getMatrixAt(2, 2)) + ($vtx->getW() * $this->getMatrixAt(0, 3));
		$args['y'] = ($vtx->getX() * $this->getMatrixAt(1, 0)) + ($vtx->getY() * $this->getMatrixAt(1, 1)) + ($vtx->getZ() * $this->getMatrixAt(1, 2)) + ($vtx->getW() * $this->getMatrixAt(1, 3));
		$args['z'] = ($vtx->getX() * $this->getMatrixAt(2, 0)) + ($vtx->getY() * $this->getMatrixAt(2, 1)) + ($vtx->getZ() * $this->getMatrixAt(2, 2)) + ($vtx->getW() * $this->getMatrixAt(2, 3));
		$args['w'] = ($vtx->getX() * $this->getMatrixAt(2, 3)) + ($vtx->getY() * $this->getMatrixAt(3, 0)) + ($vtx->getZ() * $this->getMatrixAt(3, 2)) + ($vtx->getW() * $this->getMatrixAt(3, 3));
		$args['color'] = $vtx->getColor();
		return new Vertex($args);
	}

	// ======[ Instance private methods ]=====

	private function _presetIdentity()
	{
		$this->setMatrixAt(0, 0, 1.00);	// 1 0 0 0
		$this->setMatrixAt(1, 1, 1.00);	// 0 1 0 0
		$this->setMatrixAt(2, 2, 1.00);	// 0 0 1 0
		$this->setMatrixAt(3, 3, 1.00);	// 0 0 0 1
	}

	private function _presetScale()
	{
		$this->setMatrixAt(0, 0, $this->getScale()); // S 0 0 0
		$this->setMatrixAt(1, 1, $this->getScale()); // 0 S 0 0
		$this->setMatrixAt(2, 2, $this->getScale()); // 0 0 S 0
		$this->setMatrixAt(3, 3, 1.00);			  	 // 0 0 0 1
	}

	private function _presetOxRotation()
	{
		$this->_presetIdentity();
		$this->setMatrixAt(0, 0,  1);
		$this->setMatrixAt(1, 1,  cos($this->getAngle()));
		$this->setMatrixAt(1, 2, -sin($this->getAngle()));
		$this->setMatrixAt(2, 1,  sin($this->getAngle()));
		$this->setMatrixAt(2, 2,  cos($this->getAngle()));
	}

	private function _presetOyRotation()
	{
		$this->_presetIdentity();
		$this->setMatrixAt(0, 0,  cos($this->getAngle()));
		$this->setMatrixAt(0, 2,  sin($this->getAngle()));
		$this->setMatrixAt(1, 1,  1);
		$this->setMatrixAt(2, 0, -sin($this->getAngle()));
		$this->setMatrixAt(2, 2,  cos($this->getAngle()));
	}

	private function _presetOzRotation()
	{
		$this->_presetIdentity();
		$this->setMatrixAt(0, 0,  cos($this->getAngle()));
		$this->setMatrixAt(0, 1, -sin($this->getAngle()));
		$this->setMatrixAt(1, 0,  sin($this->getAngle()));
		$this->setMatrixAt(1, 1,  cos($this->getAngle()));
		$this->setMatrixAt(2, 2,  1);
	}

	private function _presetTranslation()
	{
		$this->_presetIdentity();
		$this->setMatrixAt(0, 3,  $this->getVtc()->getX());
		$this->setMatrixAt(1, 3,  $this->getVtc()->getY());
		$this->setMatrixAt(2, 3,  $this->getVtc()->getZ());
	}

	private function _presetProjection()
	{
		$this->_presetIdentity();
		$this->setMatrixAt(1, 1, 1 / tan(0.5 * deg2rad($this->getFov())));
		$this->setMatrixAt(0, 0, $this->getMatrixAt(1, 1) / $this->getRatio());
		$this->setMatrixAt(2, 2, -1 * (-$this->getNear() - $this->getFar()) / ($this->getNear() - $this->getFar()));
		$this->setMatrixAt(2, 3, (2 * $this->getNear() * $this->getFar()) / ($this->getNear() - $this->getFar()));
		$this->setMatrixAt(3, 2, -1);
		$this->setMatrixAt(3, 3, 0);
	}	

}

?>

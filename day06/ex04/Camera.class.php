<?php

class Camera
{
	static $verbose = false;

	// ======[ Atributes ]=====

	private $_proj;
	private $_tR;
	private $_tT;
	private $_origin;
	private $_width;
	private $_height;
	private $_ratio;

	// ======[ Special methods ]=====

	public function __construct($kwargs)
	{
		$this->_origin = $kwargs['origin'];
		$this->_tT     = new Matrix(['preset' => Matrix::TRANSLATION, 'vtc' => new Vector(['dest' => new Vertex(['x' => -$this->_origin->getX(),
																											 	 'y' => -$this->_origin->getY(),
																											 	 'z' => -$this->_origin->getZ(),
																											 	 'w' => -$this->_origin->getW()
		])])]);
		$this->_tR 	   = $this->_transpose($kwargs['orientation']);
		$this->_width  = (float)$kwargs['width'] / 2.00;
		$this->_height = (float)$kwargs['height'] / 2.00;
		$this->_ratio  = $this->_width / $this->_height;
		$this->_proj   = new Matrix([
			'preset' => Matrix::PROJECTION,
			'fov' 	 => $kwargs['fov'],
			'ratio'  => $this->_ratio,
			'near'   => $kwargs['near'],
			'far'    => $kwargs['far']
		]);
		if (Self::$verbose) {
			echo "Camera instance constructed\n";
		}
	}

	function __destruct()
	{
		if (Self::$verbose)
			echo "Camera instance destructed\n";
	}

	function __toString()
	{
		return (
			"Camera( \n" .
			"+ Origine: " . $this->_origin . "\n" .
			"+ tT:\n" . $this->_tT . "\n" .
			"+ tR:\n" . $this->_tR . "\n" .
			"+ tR->mult( tT ):\n" . $this->_tR->mult($this->_tT) . "\n" .
			"+ Proj:\n" . $this->_proj . "\n)"
		);
	}

	// ======[ Class methods ]=====

	public static function doc() { return "\n" . file_get_contents(__CLASS__ . '.doc.txt'); }

	// ======[ Instance methods ]=====

	public function watchVertex(Vertex $worldVertex)
	{
		$vtx = $this->_proj->transformVertex($this->_tR->transformVertex($worldVertex));
		$vtx->setX($vtx->getX() * $this->getRatio());
		$vtx->setY($vtx->getY() * $this->getRatio());
		$vtx->setColor($worldVertex->getColor());
		return $vtx;
	}

	private function _transpose(Matrix $matrix)
	{
		$matrix->matrix = [
			$matrix->getMatrixAt(0, 0), $matrix->getMatrixAt(1, 0), $matrix->getMatrixAt(2, 0), $matrix->getMatrixAt(3, 0),
			$matrix->getMatrixAt(0, 1), $matrix->getMatrixAt(1, 1), $matrix->getMatrixAt(2, 1), $matrix->getMatrixAt(3, 1),
			$matrix->getMatrixAt(0, 2), $matrix->getMatrixAt(1, 2), $matrix->getMatrixAt(2, 2), $matrix->getMatrixAt(3, 2),
			$matrix->getMatrixAt(0, 3), $matrix->getMatrixAt(1, 3), $matrix->getMatrixAt(2, 3), $matrix->getMatrixAt(3, 3)
		];
		return $matrix;
	}

}

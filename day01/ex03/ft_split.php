<?php
	function ft_split($str)
	{
		$tab = explode(" ", preg_replace('/ +/', ' ', trim($str)));
		sort($tab);
		return ($tab));
	}
?>
#!/usr/bin/php
<?php
	function ft_split($str)
	{
		return explode(" ", preg_replace('/ +/', ' ', trim($str)));
	}
	//print_r(ft_split("      Hello          World AAA   "));
?>
#!/usr/bin/php
<?php
	function ft_split($str)
	{
		return explode(" ", preg_replace('/ +/', ' ', trim($str)));
	}

	function ft_is_operator($str)
	{
		return ($str == "+" || $str == "-" || $str == "*" || $str == "/" || $str == "%");
	}

	if ($argc < 2)
		return;

	array_shift($argv);
	$searched = array_shift($argv);
	$tab = array();
	foreach ($argv as $arg)
	{
		$kv = explode(':', $arg);
		$tab[$kv[0]] = $kv[1];
	}
	if (array_key_exists($searched, $tab))
		echo $tab[$searched], "\n";
?>
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

	if ($argc != 2)
		exit("Incorrect Parameters\n");
	$argv[1] = strtr($argv[1], array('+' => ' + ', '-' => ' - ', '*' => ' * ', '/' => ' / ', '%' => ' % '));
	if (preg_match('/\- [0-9]*/', $argv[1]))
		$argv[1] = preg_replace('/ \- /', '-', $argv[1]);
	$argv = ft_split($argv[1]);
	if (!(is_numeric($argv[0]) && is_numeric($argv[2]) && ft_is_operator($argv[1])))
		exit("Syntax Error\n");
	switch ($argv[1])
	{
		case "+":
			echo $argv[0] + $argv[2], "\n";
			break;
		case "-":
			echo $argv[0] - $argv[2], "\n";
			break;
		case "*";
			echo $argv[0] * $argv[2], "\n";
			break;
		case "/":
			echo $argv[0] / $argv[2], "\n";
			break;
		case "%":
			echo $argv[0] % $argv[2], "\n";
			break;
	}
?>
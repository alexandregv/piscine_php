#!/usr/bin/php
<?php
	function ft_print_array($array)
	{
		foreach ($array as $line)
			echo $line, "\n";
	}

	if ($argc < 2)
		return;
	array_shift($argv);
	$argv = implode(' ', $argv);
	$argv = preg_replace('/ +/', ' ', trim($argv));
	$argv = explode(' ', $argv);
	sort($argv);
	ft_print_array($argv);
?>
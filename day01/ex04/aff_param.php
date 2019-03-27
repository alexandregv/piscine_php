#!/usr/bin/php
<?php
	function ft_print_array($array)
	{
		foreach ($array as $line)
			echo $line, "\n";
	}

	array_shift($argv);
	ft_print_array($argv);
?>
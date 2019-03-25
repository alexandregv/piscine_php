#!/usr/bin/php
<?php
	if ($argc != 4)
		exit("Incorrect Parameters\n");
	//array_shift($argv);
	$argv = array_map("trim", $argv);
	
	switch ($argv[2])
	{
		case "+":
			echo $argv[1] + $argv[3];
			break;
		case "-":
			echo $argv[1] - $argv[3];
			break;
		case "*";
			echo $argv[1] * $argv[3];
			break;
		case "/":
			echo $argv[1] / $argv[3];
			break;
		case "%":
			echo $argv[1] % $argv[3];
			break;
	}
?>
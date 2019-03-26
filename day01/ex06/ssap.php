#!/usr/bin/php
<?php
	if ($argc < 2)
		return;
	array_shift($argv);
	$argv = implode(' ', $argv);
	$argv = preg_replace('/ +/', ' ', trim($argv));
	$argv = explode(' ', $argv);
	sort($argv);
	foreach ($argv as $arg)
		echo $arg . "\n";
?>
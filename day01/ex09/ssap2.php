#!/usr/bin/php
<?php
	if ($argc < 2)
		return;
	array_shift($argv);
	$argv = explode(' ', implode(' ', $argv));
	natcasesort($argv);
	foreach ($argv as $arg)
		echo $arg . "\n";
?>
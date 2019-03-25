#!/usr/bin/php
<?php
	if ($argc < 2)
		return;
	$tab = explode(' ', next($argv));
	array_push($tab, array_shift($tab));
	$tab = implode(' ', $tab);
	echo preg_replace('/ +/', ' ', trim($tab)) . "\n";
?>
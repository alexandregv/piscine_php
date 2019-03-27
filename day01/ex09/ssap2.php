#!/usr/bin/php
<?PHP
	function	ssap2_sort($a, $b)
	{
		$len_a = strlen($a);
		$len_b = strlen($b);
		$a = strtolower($a);
		$b = strtolower($b);
		$i = 0;
		$charset = implode('', array_merge(range('a', 'z'), array_merge(range('0', '9'), array_merge(range('!', '/'), array_merge(range(':', '@'), array_merge(range('[', '`'), range('{', '~')))))));
		while ($i < $len_a || $i < $len_b)
		{
			$pos_a = strpos($charset, $a[$i]);
			$pos_b = strpos($charset, $b[$i]);
			if ($pos_a < $pos_b)
				return (-1);
			else if ($pos_a > $pos_b)
				return (1);
			else
				++$i;
		}
	}

	if ($argc < 2)
		return;

	array_shift($argv);
	$tab = explode(' ', preg_replace('/ +/', ' ', trim(implode(' ', $argv))));
	usort($tab, 'ssap2_sort');
	foreach ($tab as $value)
		echo $value, "\n";
?>
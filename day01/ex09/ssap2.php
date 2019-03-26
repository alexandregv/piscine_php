#!/usr/bin/php
<?php
	function cmp($a, $b)
	{
		for ($i = 0; ($i < strlen($a) && $i < strlen($b)); $i++)
		{
			$c1 = $a[$i];
			$c2 = $b[$i];
			if ($c1 == $c2)
				continue ;
			if (ctype_alpha($c1))
			{
				if (ctype_alpha($c2))
				{
					if (strcmp(strtolower($c1), strtolower($c2)) == 0)
						continue ;
					return (strcmp(strtolower($c1), strtolower($c2)));
				}
				return (-1);
			}
			else if (is_numeric($c1))
			{
				if (ctype_alpha($c2))
					return (1);
				else if (is_numeric($c2))
					return (strcmp($c1, $c2));
				return (-1);
			}
			else
			{
				if (!ctype_alpha($c2) && !is_numeric($c2))
					return (strcmp($c1, $c2));
				return (1);
			}
		}
		return (strlen($a) - strlen($b));
	}

	if ($argc < 2)
		return ;
	array_shift($argv);
	$array = array();
	foreach ($argv as $arg)
		$array = array_merge($array, array_filter(explode(' ', trim($argv)), "strlen"));
	usort($arr, "cmp");
	foreach ($arr as $str)
		printf("%s\n", $str);
?>
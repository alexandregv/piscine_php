#!/usr/bin/php
<?php
	while (42)
	{
		echo 'Entrez un nombre: ';
		$input = trim(fgets(STDIN));
		if (feof(STDIN) == true) exit("\n");
		if (is_numeric($input)) echo "Le chiffre {$input} est " . ($input[strlen($input)-1] % 2 == 0 ? "Pair" : "Impair") . "\n";
		else echo "'{$input}' n'est pas un chiffre\n";
	}
?>
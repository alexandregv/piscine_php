<?php
    while (42)
    {
        echo 'Entrez un nombre: ';
        $input = trim(fgets(STDIN));
        if (feof(STDIN) == true) exit();
        if (is_numeric($input)) echo "Le chiffre {$input} est " . ($input % 2 == 0 ? "Pair" : "Impair") . "\n";
        else echo "'{$input}' n'est pas un chiffre\n";
    }
?>
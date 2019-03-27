#!/usr/bin/php
<?php
	function ft_print_array($array)
	{
		foreach ($array as $line)
			echo $line, "\n";
	}

	if ($argc < 2)
		return ;
	switch ($argv[1])
	{
		case "moyenne":
			moyenne();
			break;
		case "moyenne_user":
			moyenne_user();
			break;
		case "ecart_moulinette":
			ecart_moulinette();
			break;
	}

	function moyenne()
	{
		$notes = array();
		fgetcsv(STDIN);
		while ($data = fgetcsv(STDIN, 0, ";"))
			if ($data[1] != "" && $data[2] != "moulinette")
				$notes[] = $data[1];
		echo array_sum($notes) / count($notes), "\n";
	}

	function moyenne_user()
	{
		$notes_users = array();
		fgetcsv(STDIN);
		while ($data = fgetcsv(STDIN, 0, ";"))
			if ($data[1] != "" && $data[2] != "moulinette")
				$notes_users[$data[0]][] = $data[1];
		ksort($notes_users);
		foreach ($notes_users as $user => $notes)
			$notes_users[$user] = array_sum($notes) / count($notes);
		foreach ($notes_users as $user => $moyenne)
			if ($moyenne)
				echo $user, ':', $moyenne, "\n";
	}

	function ecart_moulinette()
	{
		$notes_users = array();
		$notes_users_mouli = array();
		fgetcsv(STDIN);
		while ($data = fgetcsv(STDIN, 0, ";"))
			if ($data[1] != "" && $data[2] != "moulinette")
				$notes_users[$data[0]][] = $data[1];
			elseif ($data[2] == "moulinette")
				$notes_users_mouli[$data[0]] = $data[1];
		ksort($notes_users);
		foreach ($notes_users as $user => $notes)
			$notes_users[$user] = array_sum($notes) / count($notes);
		foreach ($notes_users as $user => $moyenne)
			if ($moyenne)
				echo $user, ':', $moyenne - $notes_users_mouli[$user], "\n";
	}
?>
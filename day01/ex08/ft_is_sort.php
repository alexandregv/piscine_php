#!/usr/bin/php
<?php
	function ft_is_sort($tab)
	{
		$sorted = array_values($tab);
		sort($sorted);
		return ($tab === $sorted || $tab === array_reverse($sorted));
	}

	/*
	$tab = array("!/@#;^", "42", "Hello World", "salut", "zZzZzZzZ");
	$tab[] = "Et qu'est-ce qu'on fait maintenant ?";
	if (ft_is_sort($tab))
		echo "Le tableau est trie\n";
	else
		echo "Le tableau n'est pas trie\n";
	*/
?>
<?php
	function ft_is_sort($tab)
	{
		$sorted = array_values($tab);
		sort($sorted);
		return ($tab === $sorted || $tab === array_reverse($sorted));
	}
?>
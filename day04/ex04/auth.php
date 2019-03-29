<?php

function auth($login, $passwd)
{
	$accounts = file_exists('../private/passwd') ? unserialize(file_get_contents('../private/passwd')) : array();
	$account_id = array_search($login, array_column($accounts, 'login'));
	if ($account_id !== FALSE)
	{
		$account = $accounts[$account_id];
		if ($account['login'] == $login && $account['passwd'] == hash('whirlpool', $passwd . 'salt'))
			return TRUE;
		else
			return FALSE;
	}
	return FALSE;
}

?>
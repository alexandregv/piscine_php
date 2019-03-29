<?php

if (   isset($_POST['submit']) && $_POST['submit'] == "OK"
	&& isset($_POST['oldpw' ]) && $_POST['oldpw' ] != ""
	&& isset($_POST['newpw' ]) && $_POST['newpw' ] != "")
{
	if(!file_exists('../private/'))
		mkdir('../private/', 0755);
	
	if (file_exists('../private/passwd'))
		$accounts = unserialize(file_get_contents('../private/passwd'));
	else
		$accounts = array();

	$account_id = array_search($_POST['login'], array_column($accounts, 'login'));
	if ($account_id !== FALSE)
	{
		$account = $accounts[$account_id];
		if ($account['login'] == $_POST['login'] && $account['passwd'] == hash('whirlpool', $_POST['oldpw'] . 'salt'))
		{
			$accounts[$account_id]['passwd'] = hash('whirlpool', $_POST['newpw'] . 'salt');
			$data = serialize($accounts);
			file_put_contents('../private/passwd', $data);
			echo "OK\n";
		}
		else echo "ERROR\n";
	}
	else echo "ERROR\n";
}
else echo "ERROR\n";

?>

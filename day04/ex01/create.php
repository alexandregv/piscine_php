<?php

if (   isset($_POST['submit']) && $_POST['submit'] == "OK"
	&& isset($_POST['login' ]) && $_POST['login' ] != ""
	&& isset($_POST['passwd']) && $_POST['passwd'] != "")
{
	if(!file_exists('../private/'))
		mkdir('../private/', 0755);
	
	if (file_exists('../private/passwd'))
		$accounts = unserialize(file_get_contents('../private/passwd'));
	else
		$accounts = array();

	if (array_search($_POST['login'], array_column($accounts, 'login')) === FALSE)
	{
		$accounts[] = array('login' => $_POST['login'], 'passwd' => hash('whirlpool', $_POST['passwd'] . 'salt'));
		$data = serialize($accounts);
		file_put_contents('../private/passwd', $data);
		echo "OK\n";
	}
	else echo "ERROR\n";
}
else echo "ERROR\n";

?>
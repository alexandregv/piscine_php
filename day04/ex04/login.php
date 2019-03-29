<?php
session_start();

include('auth.php');

if (isset($_POST['login']) && isset($_POST['passwd']))
{
	if (auth($_POST['login'], $_POST['passwd']) === TRUE)
	{
		$_SESSION['loggued_on_user'] = $_POST['login'];
		echo "OK\n";
	}
	else
	{
		$_SESSION['loggued_on_user'] = '';
		echo "ERROR\n";
	}
}
else echo "ERROR\n";

?>
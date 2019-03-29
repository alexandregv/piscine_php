<?php
session_start();
if (isset($_GET['submit']) == "OK" && isset($_GET['login']) && isset($_GET['passwd']))
{
	$_SESSION['login'] = $_GET['login'];
	$_SESSION['passwd'] = $_GET['passwd'];
}
?>
<html><body>
<form method="GET" action="index.php">
	Identifiant: <input type="text" name="login" value="<?php isset($_SESSION['login']) ? $_SESSION['login'] : ''; ?>" />
	<br />
	Mot de passe: <input type="password" name="passwd" value="<?php isset($_SESSION['passwd']) ? $_SESSION['passwd'] : ''; ?>" />
	<input type="submit" name="submit" value="OK" />
</form>
</body></html>

<?php

require_once('ShipFactory.class.php');

require_once('FregateImperiale.class.php');
require_once('DestroyerImperial.class.php');
require_once('RavajeurOrk.class.php');
require_once('ExplozeurOrk.class.php');
require_once('DefonceurChaos.class.php');
require_once('PurificateurChaos.class.php');

require_once('Empire.class.php');
require_once('Orks.class.php');
require_once('chaos.class.php');

echo "Debut\n";

$e = new Empire();
echo $e->getName();

exit;

$factory = new ShipFactory();
$factory->absorb(new FregateImperiale());
$factory->absorb(new DestroyImperial());
$factory->absorb(new RavajeurOrk());
$factory->absorb(new ExplozeurOrk());
$factory->absorb(new DefonceurChaos());
$factory->absorb(new PurificateurChaos());

$requested_ships = [
	'fregate imperiale',
	'destroyer imperial',
	'ravajeur ork',
	'explozeur ork',
	'defonceur chaos',
	'purificateur chaos',
];

$actual_ships = [];
foreach ($requested_ships as $ship)
	if (($new_ship = $factory->fabricate($ship)) != null)
		$actual_ships[] = $new_ship;

echo "Fin\n";

?>

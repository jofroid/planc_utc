<?php
require_once 'app/classes/Inscription.class.php';
require_once 'app/classes/permission.class.php';
use \Plancutc\classes;

$i = new Inscription();
$quartiers = $i->getQuartiers();

if (isset ($_GET['function'])) {
	switch ($_GET['function']){
		case 'insert' : {
			$i->insertInscription();
			Atomik::flash("Votre profil a correctement été créé");
			Atomik::redirect("?action=moncompte");
			break;
		}
	}
}




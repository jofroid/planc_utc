<?php
require_once 'app/classes/Infos_profil.class.php';
use \Plancutc\classes;

$i = new Infos_profil();
$infos = $i->getMesInfos();

if (isset ($_GET['function'])) {
	switch ($_GET['function']){
		case 'update' : {
			$i->insertModifs();
			Atomik::flash("Votre profil a correctement été modifié");
			Atomik::redirect("?action=moncompte");
			break;
		}
	}
}




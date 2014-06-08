<?php
require_once 'app/classes/Infos_profil.class.php';
use \Plancutc\classes;

$i = new Infos_profil();
$infos = $i->getMesInfos();

if (isset ($_GET['function']) && $_GET['function'] == 'update'){
	if ($i->updateModifs()) {
		Atomik::flash("Votre profil a correctement été modifié");
		Atomik::redirect("moncompte");
	}
}




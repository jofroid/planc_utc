<?php

require_once 'app/classes/Mon_compte.class.php';
use \Plancutc\classes;

if (Atomik::get('session.login')){	
	$m = new Mon_compte();
	$compte = $m->getCompte();
}
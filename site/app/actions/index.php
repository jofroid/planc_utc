<?php

// your action code goes here
require '/Cas/Cas.php';
use \Plancutc\cas;

$res="non identifie";
if(isset($_GET['ticket']))
{	
	$connec=new Cas("https://cas.utc.fr/cas/");
	if($connec->authenticate($_GET['ticket'], "http://localhost:8080/PlancUTC/planc_utc/site/"))
		$res="ca marche";
	else
		$res="marche pas";
}
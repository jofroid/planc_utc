<?php
require '/Cas/Cas.php';
use \Plancutc\cas;
use \Ginger\Client\GingerClient;

if(isset($_GET['ticket']))
{	
	$_connec=new Cas("https://cas.utc.fr/cas/");
	if($user=$_connec->authenticate($_GET['ticket'], "http://localhost:8080/PlancUTC/planc_utc/site/?action=login"))
	{	
		$_gingerClient = new GingerClient("fauxginger", "http://localhost:8080/ginger/index.php/v1/");
		$_userInfo = $_gingerClient->getUser($user);
		Atomik::set('session.login', $_userInfo->login);
		Atomik::set('session.prenom', $_userInfo->prenom);
		Atomik::set('session.nom', $_userInfo->nom);
		Atomik::set('session.adulte', $_userInfo->is_adulte);
		Atomik::set('session.mail', $_userInfo->mail);
		header("Location: http://localhost:8080/PlancUTC/planc_utc/site/?login=1");
	}
	else
		header("Location: http://localhost:8080/PlancUTC/planc_utc/site/?login=0");
}
else
{
	header("Location: https://cas.utc.fr/cas/login?service=".urlencode("http://localhost:8080/PlancUTC/planc_utc/site/?action=login"));
}
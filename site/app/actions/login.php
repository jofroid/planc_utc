<?php
require '/Cas/Cas.php';
require '/config.php';
use \Plancutc\cas;
use \Ginger\Client\GingerClient;

if(isset($_GET['ticket']))
{	
	$_connec=new Cas("https://cas.utc.fr/cas/");
	if($user=$_connec->authenticate($_GET['ticket'], $_CONFIG["self_url"]."?action=login"))
	{	
		$_gingerClient = new GingerClient($_CONFIG["ginger_apikey"], $_CONFIG["ginger_server"]);
		$_userInfo = $_gingerClient->getUser($user);
		Atomik::set('session.login', $_userInfo->login);
		Atomik::set('session.prenom', $_userInfo->prenom);
		Atomik::set('session.nom', $_userInfo->nom);
		Atomik::set('session.adulte', $_userInfo->is_adulte);
		Atomik::set('session.mail', $_userInfo->mail);
		header("Location: ".$_CONFIG["self_url"]."?login=1");
	}
	else
		header("Location: ".$_CONFIG["self_url"]."?login=0");
}
else
{
	header("Location: https://cas.utc.fr/cas/login?service=".urlencode($_CONFIG["self_url"]."?action=login"));
}
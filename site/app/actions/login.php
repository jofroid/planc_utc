<?php
require '/Cas/Cas.php';
use \Plancutc\cas;

if(isset($_GET['ticket']))
{	
	$connec=new Cas("https://cas.utc.fr/cas/");
	if($connec->authenticate($_GET['ticket'], "http://localhost:8080/PlancUTC/planc_utc/site/?action=login"))
	{	
		Atomik::set('session.username', 'Corentin');
		Atomik::set('session.login', 'brascore');
		header("Location: http://localhost:8080/PlancUTC/planc_utc/site/?login=1");
	}
	else
		header("Location: http://localhost:8080/PlancUTC/planc_utc/site/?login=0");
}
else
{
	header("Location: https://cas.utc.fr/cas/login?service=".urlencode("http://localhost:8080/PlancUTC/planc_utc/site/?action=login"));
}
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

		$this->db = Atomik::get('db');
		$_query= $this->db->prepare("SELECT login FROM etudiant where login='".$_userInfo->login."';");
		$_query->execute();
		if(!$_query->fetch())
		{
			$_query=$this->db->prepare("INSERT INTO etudiant VALUES ('$_userInfo->login', '$_userInfo->nom', '$_userInfo->prenom', '0', '$_userInfo->is_adulte', '$_userInfo->mail');");
			$_query->execute();
		}
		header("Location: ".$_CONFIG["self_url"]."?login=1");
	}
	else
		header("Location: ".$_CONFIG["self_url"]."?login=0");
}
else
{
	header("Location: https://cas.utc.fr/cas/login?service=".urlencode($_CONFIG["self_url"]."?action=login"));
}
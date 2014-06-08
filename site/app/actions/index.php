<?php
require '/config.php';
require '/app/classes/permission.class.php';

// your action code goes here
if(isset($_GET['login']))	
	if($_GET['login'])
		$this->flash('Vous êtes maintenant connecté.');
	else	
		$this->flash('La connexion a échoué.', 'error');
if(isset($_GET['logout']))
	$this->flash('Vous vous êtes déconnecté avec succès.');
if(isset($_GET['forbidden']))
	$this->flash("Vous n'êtes pas autorisé à accéder à cette page.");
$_p=new Permission();
$login=$_p->getLogin();
$snake=$_CONFIG['self_url']."?action=snake";
$pong=$_CONFIG['self_url']."?action=pong";
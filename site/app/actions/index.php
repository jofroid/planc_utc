<?php

// your action code goes here
if(isset($_GET['login']))	
	if($_GET['login'])
		$this->flash('Vous êtes maintenant connecté.');
	else	
		$this->flash('La connexion a échoué.', 'error');
if(isset($_GET['logout']))
	$this->flash('Vous vous êtes déconnecté avec succès.');
$login=Atomik::get('session.username');

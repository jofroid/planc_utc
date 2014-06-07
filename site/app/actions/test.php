<?php

$db = Atomik::get('db');

// or in actions:

	//$post = $db->selectOne('etudiant', array('login' => 'pleymari'));
	

	$stmt = $db->query('SELECT * FROM etudiant INNER JOIN infos_profil ON infos_profil.loginEtudiant = etudiant.login INNER JOIN uv_etudiant ON uv_etudiant.loginEtudiant = login ');
	//var_dump($stmt); 

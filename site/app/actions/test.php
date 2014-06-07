<?php

$db = Atomik::get('db');

// or in actions:

	$post = $db->selectOne('etudiant', array('login' => 'pleymari'));
	var_dump($post); 
<?php

	
	require_once 'classes/Store.class.php';
	use \Plancutc\actions\classes;

	$store = new Store();
	$result = $store->get_profile_correspond('pleymari','h',19);
	var_dump($result);
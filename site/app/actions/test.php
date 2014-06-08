<?php

	
	require_once 'app/classes/Store.class.php';
	use \Plancutc\app\classes;

	$store = new Store();
	$result = $store->get_profile_correspond('eez',17,'H');
	echo(json_encode($result));





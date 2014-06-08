<?php
	

	Atomik::disableLayout();
	
	require_once 'app/classes/Store.class.php';
	require_once 'app/classes/permission.class.php';
	use \Plancutc\app\classes;
	$permission = new Permission();
	if($permission->isRegistered())
	{
		$store = new Store();
		$result = $store->get_profile_correspond('eez',17,'H');
		echo(json_encode($result));
	}
	else
	{
		echo "Non connecté";
	}



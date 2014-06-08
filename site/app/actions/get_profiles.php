<?php
	

	Atomik::disableLayout();
	
	require_once 'app/classes/Store.class.php';
	require_once 'app/classes/permission.class.php';
	use \Plancutc\app\classes;
	$permission = new Permission();
	if($permission->isRegistered())
	{
		$login_user = $permission->getLogin();
		$store = new Store();
		$result = $store->get_profile_correspond($login_user,17,$store->get_orientation($login_user),$store->get_sexe($login_user));
		echo(json_encode($result));
	}
	else
	{
		echo "Non connecté";
	}



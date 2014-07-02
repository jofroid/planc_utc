<?php
	Atomik::disableLayout();
	require_once 'app/classes/SuperWink.class.php';
	require_once 'app/classes/permission.class.php';
	use \Plancutc\app\classes;

	$permission = new Permission();
	if($permission->isRegistered())
	{
		
		$login_user = $permission->getLogin();
		$superwink = new SuperWink();
	
		if($permission->loginExist($_GET['logindest']) == 1)
		{
			$wink->sendSuperWinkWink(date("Y:m:d"),$login_user,$_GET['logindest']);
		}
		else
		{
			echo "erreur => login n'existe pas";
		}
	}
	else
	{	
		
	}
	
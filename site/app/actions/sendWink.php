<?php

	require_once 'app/classes/Wink.class.php';
	use \Plancutc\app\classes;

	
	$wink = new Wink();
	$wink->sendWink(date("Y:m:d"),"pleymari","veroclar");

	$result = $wink->getWinkUser("pleymari");
	echo(json_encode($result));
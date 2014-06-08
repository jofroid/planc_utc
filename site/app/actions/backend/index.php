<?php 
require '/app/classes/backend.class.php';
require '/app/classes/permission.class.php';

$_p=new Permission();

if(!$_p->isAdmin())
	Atomik::redirect('?forbidden=1&action=index');

$backend = new Backend_profils();
list($logins,$prenoms,$noms) = $backend->get_profile_correspond();

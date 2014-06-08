<?php
require '/app/classes/backend.class.php';
require '/app/classes/permission.class.php';

$_p=new Permission();

if(!$_p->isAdmin())
	Atomik::redirect('?forbidden=1&action=index');

if(isset($_POST['nom']))
{
	$backend = new Backend_quartiers();
	$backend->create($_POST['nom']);
	Atomik::redirect('backend/showQuartier');
}
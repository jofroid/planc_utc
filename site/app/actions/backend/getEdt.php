<?php 
require '/app/classes/backend.class.php';
require '/app/classes/permission.class.php';
require_once 'app/classes/Edt.class.php';
require_once 'app/classes/Curl.class.php';

$_p=new Permission();

if(!$_p->isAdmin())
	Atomik::redirect('?forbidden=1&action=index');


if (isset($_POST['MODCASID']))
{
	$edt = new Edt();

	$edt->download_all_edt($_POST['MODCASID']);

}

$edt = new Edt();
$edt->insertCours("aabrante",'assets/edt/EDT_P14');
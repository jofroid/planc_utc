<?php
require '/app/classes/permission.class.php';

$_p=new Permission();

if(!$_p->isAdmin())
	Atomik::redirect('?forbidden=1&action=index');

$this->db = Atomik::get('db');
$_query= $this->db->prepare("DELETE FROM quartier WHERE id='".$this->escape($_POST['id'])."';");
$_query->execute();
Atomik::redirect('backend/showQuartier');
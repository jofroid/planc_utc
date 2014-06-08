<?php
require '/app/classes/permission.class.php';

$_p=new Permission();

if(!$_p->isAdmin())
	Atomik::redirect('?forbidden=1&action=index');

$this->db = Atomik::get('db');
$_query= $this->db->prepare("DELETE FROM ETUDIANT WHERE login='".$this->escape($_POST['login'])."';");
$_query->execute();
Atomik::redirect('backend');
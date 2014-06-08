<?php

class Permission
{
	public function __construct()
	{
		$this->login=Atomik::get('session.login');
		$this->db = Atomik::get('db');
	}

	public function isRegistered()
	{
		if(isset($this->login))
			return 1;
		else
			return 0;
	}

	public function isAdmin()
	{
		if ($this->isRegistered())
		{
				$query= $this->db->prepare("SELECT is_admin FROM etudiant where login='".$this->login."';");
				$query->execute();
				if($res=$query->fetch())
					return $res['is_admin']; 
		}
		else
			return 0;
	}

	public function loginExist($login)
	{
		$query= $this->db->prepare("SELECT is_admin FROM etudiant where login='".$login."';");
		$query->execute();
		if($query->fetch())
			return 1;
		else
			return 0;
	}
}
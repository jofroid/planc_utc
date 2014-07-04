<?php
Class SuperWink {


	function __construct ()
	{
		$this->db = Atomik::get('db');
	}



	public function sendSuperWink($date,$loginExpediteur, $loginDestinataire)
	{
		if( ($loginExpediteur != $loginDestinataire) )
		{	
			if(!$this->SuperWinkExist($loginExpediteur, $loginDestinataire))
			{
				if (!$this->matchSuperWink($loginDestinataire))
					echo ("pas ok !");
				else
					echo("ok");

				$req = $this->db->prepare('INSERT INTO superwink 
					(date,loginExpediteur,loginDestinataire) VALUES(?,?,?)
					');
				$req->execute(array($date,$loginExpediteur,$loginDestinataire));
				return true;
			}
			else
			{
				$req = $this->db->prepare('DELETE FROM superwink 
					WHERE loginExpediteur = ?
					AND loginDestinataire = ?
					');
				$req->execute(array($loginExpediteur,$loginDestinataire));
				return true;
			}
			
		}
		else
		{
			return false;
		}

	}
	
	public function matchSuperWink($loginExpediteur) {
		return $this->db->selectOne("Wink", "loginDestinataire = '" . Atomik::get("session.login") . "' AND loginExpediteur = '" . Atomik::escape($loginExpediteur) . "';") ?  true : false;
	}

	public function SuperWinkExist($loginExpediteur, $loginDestinataire)
	{
		$req = $this->db->prepare('SELECT * FROM superwink 
				WHERE loginExpediteur = ?
				AND loginDestinataire = ?
				');
			$req->execute(array($loginExpediteur,$loginDestinataire));
		if($req->fetch())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getSuperWinkUser($loginUser)
	{
		$req = $this->db->prepare('SELECT * FROM superwink 
				WHERE loginExpediteur = ?
				ORDER BY date
				');
		$req->execute(array($loginUser));
		
		$tab[0] = array('number' => 0);
        $i = 0;
        while($donnees = $req->fetch())
        {
            $tab[$i+1] = array('loginDestinataire' => $donnees['loginDestinataire'], 'date' => $donnees['date']);
            $i++;
        }
        $tab[0] = array('number' => $i);
        
		if($i > 0)
		{
			return $tab;
		}
		else
		{
			return null;
		}
	}
};


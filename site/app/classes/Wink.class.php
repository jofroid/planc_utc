<?php
Class Wink {


	function __construct ()
	{
		$this->db = Atomik::get('db');
	}



	public function sendWink($date,$loginExpediteur, $loginDestinataire)
	{
		if( ($loginExpediteur != $loginDestinataire) && !$this->winkExist($loginExpediteur, $loginDestinataire) )
		{	
			$this->matchWink($loginExpediteur);
			
			die;
			$req = $this->db->prepare('INSERT INTO wink 
				(date,loginExpediteur,loginDestinataire) VALUES(?,?,?)
				');
			$req->execute(array($date,$loginExpediteur,$loginDestinataire));
			return true;
		}
		else
		{
			
		}

	}
	
	public function matchWink($loginExpediteur) {
		return $this->db->selectOne("Wink", "loginDestinataire = '" . Atomik::get("session.login") . "' AND loginExpediteur = '" . Atomik::escape($loginExpediteur) . "';") ?  true : false;
	}

	public function winkExist($loginExpediteur, $loginDestinataire)
	{
		$req = $this->db->prepare('SELECT * FROM wink 
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

	public function getWinkUser($loginUser)
	{
		$req = $this->db->prepare('SELECT * FROM wink 
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


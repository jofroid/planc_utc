<?php
Class Store {


	function __construct ()
	{
		$this->db = Atomik::get('db');
	}

	public function get_orientation($login_user)
	{
		$req = $this->db->prepare('SELECT orientation FROM infos_profil 
				WHERE loginEtudiant = ?
				
				');
		$req->execute(array($login_user));
		if($donnees = $req->fetch())
		{
			return $donnees['orientation'];
		}
		else
		{
			return null;
		}
	}

	public function get_sexe($login_user)
	{
		$req = $this->db->prepare('SELECT sexe FROM infos_profil 
				WHERE loginEtudiant = ?
				
				');
		$req->execute(array($login_user));
		if($donnees = $req->fetch())
		{
			return $donnees['sexe'];
		}
		else
		{
			return null;
		}
	}


	public function get_profile_correspond($login_user,$age,$orientation,$sexe_user)
	{
		if($orientation != "B")
		{
			$req = $this->db->prepare('SELECT * FROM etudiant 
				INNER JOIN infos_profil ON infos_profil.loginEtudiant = login 
				LEFT JOIN uv_etudiant ON uv_etudiant.loginEtudiant = login 
				LEFT JOIN image ON id = avatar
				WHERE sexe = ?
				AND (orientation = ? OR orientation = "B")
				AND login != ?
				ORDER BY abs(age-?)
				
				');
			$req->execute(array($orientation,$sexe_user,$login_user,$age));
		}
		else
		{
			$req = $this->db->prepare('SELECT * FROM etudiant 
				INNER JOIN infos_profil ON infos_profil.loginEtudiant = login 
				LEFT JOIN uv_etudiant ON uv_etudiant.loginEtudiant = login 
				LEFT JOIN image ON id = avatar
				WHERE (orientation = ? OR orientation = "B")
				AND login != ?
				ORDER BY abs(age-?)
				
				');

			$req->execute(array($sexe_user,$login_user,$age));
		}
		

		$tab[0] = array('number' => 0);
        $i = 0;
        while($donnees = $req->fetch())
        {
            $tab[$i+1] = array('login' => $donnees['login'], 'prenom' => $donnees['prenom'], 'nom' => $donnees['nom'], 'semestre' => $donnees['semestre'], 'age' => $donnees['age'], 'source' => $donnees['source']);
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

	public function get_winked($login_user)
	{
		$req="SELECT et.login, et.prenom, et.nom, inf.semestre, inf.age FROM (SELECT et.login, et.prenom, et.nom FROM etudiant et INNER JOIN wink w ON et.login=w.loginDestinataire WHERE loginExpediteur='$login_user') et LEFT JOIN infos_profil inf ON et.login=inf.loginEtudiant;";
		$query=$this->db->prepare($req);
		$req->execute();
		$tab[0] = array('number' => 0);
        $i = 0;
		while($donnees = $req->fetch())
		{
			$tab[$i+1] = array('login' => $donnees['login'], 'prenom' => $donnees['prenom'], 'nom' => $donnees['nom'], 'semestre' => $donnees['semestre'], 'age' => $donnees['age'], 'source' => $donnees['source']);
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
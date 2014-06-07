<?php
Class Store {


	function __construct ()
	{
		$this->db = Atomik::get('db');
	}


	public function get_profile_correspond($login_user,$age,$orientation)
	{
		$stmt = $this->db->prepare('SELECT * FROM etudiant 
				INNER JOIN infos_profil ON infos_profil.loginEtudiant = login 
				INNER JOIN uv_etudiant ON uv_etudiant.loginEtudiant = login 
				INNER JOIN image ON image.id = avatar 
				WHERE sexe = ?
				AND login != ?
				
				');
		$stmt->execute(array($orientation,$login_user));
		$i = 0;
		while($donnees = $stmt->fetch())
		{
			$prenom[$i] = $donnees['prenom'];
			$nom[$i] = $donnees['nom'];
			$age[$i] = $donnees['age'];
			$i++;
		}
		if($i > 0)
		{
			return array($prenom,$nom,$age,);
		}
		else
		{
			return null;
		}
		
	}
	
	
	
};

?>



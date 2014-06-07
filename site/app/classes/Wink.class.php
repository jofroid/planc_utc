<?php
Class Wink {


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
				ORDER BY abs(age-?)
				');
		$stmt->execute(array($orientation,$login_user,$age));
		$i = 0;
		while($donnees = $stmt->fetch())
		{
			$prenom[$i] = $donnees['prenom'];
			$nom[$i] = $donnees['nom'];
			$age[$i] = $donnees['age'];
			$source[$i] = $donnees['source'];

			$i++;
		}
		if($i > 0)
		{
			return array($prenom,$nom,$age,$source); 
		}
		else
		{
			return null;
		}
		
	}

	public function sendWink($loginExpediteur, $loginDestinataire)
	{
		$fields = array(
		    'loginExpediteur' => array('required' => true),
		    'loginDestinataire' => array('required' => true)
		);

		if (($data = $this->filter($_POST, $fields)) === false) {
		    $this->flash($this['app.filters.messages'], 'error');
		    return;
		}

		$this->db->insert('wink', $data);

		$this->flash('Post successfully added!', 'success');
		$this->redirect('index');
	}

	
	
	
	
};

?>



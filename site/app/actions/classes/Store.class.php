<?php
Class Store {


	function __construct ()
	{
		$this->db = Atomik::get('db');
	}


	public function get_profile($login_user)
	{
		$stmt = $this->db->query('SELECT * FROM etudiant 
				INNER JOIN infos_profil ON loginEtudiant = login 
				INNER JOIN uv_etudiant ON loginEtudiant = login ');
		//$stmt->execute(array('my new post', 'lorem ipsum ...'));
		$i = 0;
		while($donnees = $stmt->fetch())
		{
			$id[$i] = $donnees['news_id'];
			$i++;
		}
		return array($id,$date,$title,$description,$img,$slug);
	}
	
	
	
};

?>



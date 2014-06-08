<?php

Class Backend_profils
{

	function __construct ()
	{
		$this->db = Atomik::get('db');
	}


	public function get_profile_correspond()
	{
		$stmt = $this->db->prepare('SELECT login, nom, prenom FROM etudiant;');
		$stmt->execute();
		$i = 0;
		while($donnees = $stmt->fetch())
		{
			$prenom[$i] = $donnees['prenom'];
			$nom[$i] = $donnees['nom'];
			$login[$i] = $donnees['login'];
			$i++;
		}
		if($i > 0)
		{
			return array($login, $prenom,$nom);
		}
		else
		{
			return null;
		}
	}
};
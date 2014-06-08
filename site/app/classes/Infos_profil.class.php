<?php

class Infos_profil 
{
	function __construct (){
		$this->db = Atomik::get('db');
	}

	/* Renvoi les informations de la table infos_profils */
	public function getMesInfos(){
		$res["infos_profil"] = $this->db->selectOne("infos_profil, quartier", "loginEtudiant = '". Atomik::get('session.login') . "' AND infos_profil.adresse=quartier.id;");
		
		$res["quartier"] =  $this->db->select("quartier", "nom != '". Atomik::escape($res["infos_profil"]['nom'])."'");
		return $res;
	}
	
	public function updateModifs() {
		if (strlen($_POST['telephone']) == 10){
			$quartier = $this->db->selectOne("quartier", "nom = '". Atomik::escape($_POST['adresse'])."'");
			$data = array('tel' =>  Atomik::escape($_POST['telephone']), 'adresse' => $quartier['id']);
			$this->db->update("infos_profil", $data);
			return true;
		}
		else 
		{
			Atomik::flash("La taille de votre téléphone doit être de 10 caractères");
			return false;
		}
	}	
};

<?php

class Infos_profil 
{
	function __construct (){
		$this->db = Atomik::get('db');
	}

	/* Renvoi les informations de la table infos_profils */
	public function getMesInfos(){
		$res["infos_profil"] = $this->db->selectOne("infos_profil, quartier", "loginEtudiant = 'brascore' AND infos_profil.adresse=quartier.id;");
		
		$res["quartier"] =  $this->db->select("quartier", "nom != '". $res["infos_profil"]['nom']."'");
		return $res;
	}
	
	public function insertModifs() {
		$quartier = $this->db->selectOne("quartier", "nom = '".$_POST['adresse']."'");
		$data = array('tel' =>  $_POST['telephone'], 'adresse' => $quartier['id']);
		$this->db->update("infos_profil", $data);	
	}
	
};

?>

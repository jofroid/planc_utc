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

		if (strlen($_POST['telephone']) == 10 && strlen($_POST['semestre']) < 10 && strlen($_POST['semestre']) >2){
			$quartier = $this->db->selectOne("quartier", "nom = '". Atomik::escape($_POST['adresse'])."'");

			$data = array('tel' =>  Atomik::escape(Atomik::escape($_POST['telephone'])), 'adresse' => Atomik::escape($quartier['id']), 'semestre' =>Atomik::escape($_POST['semestre']), 'orientation' =>Atomik::escape($_POST['orientation']));
		 	$this->db->update("infos_profil", $data ,	"loginEtudiant='" . Atomik::get("session.login") . "';");
			return true;
		}
		else 
		{
			Atomik::flash("Les informations transmises ne sont pas correctes");
			return false;
		}
	}
};

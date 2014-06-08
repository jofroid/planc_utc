<?php

class Infos_profil 
{
	function __construct (){
		$this->db = Atomik::get('db');
	}

/*	public function maj_infos_profil($data) {
		$fields = array(
				'avatar' => array('required' => true),
				'tel' => array('required' => true),
				'email' => array('required' => true),
				'adresse' => array('required' => true));
		$this['db']->update("infos_profil", $fields);
		
	}
*/
	
	public function getMesInfos(){
		$res["infos_profil"] = $this->db->selectOne("infos_profil, quartier", "loginEtudiant = 'brascore' AND infos_profil.adresse=quartier.id;");
		var_dump($res);
		
		$res["quartier"] =  $this->db->select("quartier", "nom != '". $res["infos_profil"]['nom']."'");
		return $res;
	}
	
	public function insertModifs() {
		$quartier = $this->db->selectOne("quartier", "nom = '".$_POST['adresse']."'");
		$data = array('tel' => $quartier['id'], 'adresse' => $_POST['telephone']);
		
		$this->db->update("infos_profil", $data);	
		var_dump($data);
	}
	
};

?>

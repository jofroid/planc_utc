<?php

class Mon_compte
{
	function __construct (){
		$this->db = Atomik::get('db');
	}
	
	public function getCompte() {
		$res['etudiant'] = $this->db->selectOne("etudiant", "login='".Atomik::get("session.login")."'");
		$res['infos_profil'] = $this->db->selectOne("infos_profil", "loginEtudiant = '" . $res['etudiant']['login'] . "'");
		$res['image'] = $this->db->selectOne("image", "id = '" . $res['infos_profil']['avatar'] . "'");
		$res['quartier'] = $this->db->selectOne("quartier", "id=" . $res['infos_profil']['adresse']);
		return $res;	
	}
	
}
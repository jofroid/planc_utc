<?php
Class Etudiant {

	//Attributs
	public $nom;
	public $prenom;
	public $sexe;
	public $age;
	public $login;

	function __construct ($nom, $prenom, $sexe, $age, $login){
		$this->nom = $nom;
		$this->prenom = $prenom;
		$this->sexe = $sexe;
		$this->age = $age;
		$this->login = $login;
	}
	
	
	function inserer () {
	}
	
	public static function getEtudiants(){
		
	}
};

?>

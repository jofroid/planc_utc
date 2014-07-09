<?php
require_once 'app/classes/permission.class.php';

class InfosProfil
{
	function __construct (){
		$this->db = Atomik::get('db');
	}

	public function getQuartiers(){
		$res =  $this->db->select("quartier");
		return $res;
	}
	
	public function check_upload_img()
	{
		$erreur = NULL;
		$maxsize = 1024*50;
		if($_FILES['avatar']['size'] > $maxsize)
		{
			atomik::flash("Le fichier est trop gros");
			atomik::redirect("inscription");
		}
		$extensions_valides = array( 'jpg' , 'jpeg' , 'png' );
			//1. strrchr renvoie l'extension avec le point (« . »).
			//2. substr(chaine,1) ignore le premier caractère de chaine.
			//3. strtolower met l'extension en minuscules.
			$extension_upload = strtolower(  substr(  strrchr($_FILES['avatar']['name'], '.')  ,1)  );
			if ( !in_array($extension_upload,$extensions_valides) )
			{
				atomik::flash("L'extension incorrecte");
				atomik::redirect("inscription");
			}

			$image_sizes = getimagesize($_FILES['avatar']['tmp_name']);
			$width = 350;
			$height = 250;

			if($erreur == NULL)
			{
				$alea = md5(uniqid(rand(), true));
				$nom = $alea.".".$extension_upload;
				$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],"assets/images/profile_picture/$nom");
				if ($resultat)
				{
					return $nom;
				}
			}		
	}

	public function insertSexe($login,$sexe,$orientation)
	{
		$this->db->insert("infos_profil",array("sexe" => $sexe, "orientation" => $orientation));
	}

	public function updateTel($login,$tel)
	{
		$this->db->update("infos_profil",array("tel" => $tel), array("login" => $login));
	}

	public function updateAdresse($login,$adresse)
	{
		$tis->db->update("infos_profil",array("adresse" => $adresse),array("login" => $login));
	}
};

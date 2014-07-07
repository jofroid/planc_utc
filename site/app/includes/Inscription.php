<?php
require_once 'app/classes/permission.class.php';

class Inscription
{
	function __construct (){
		$this->db = Atomik::get('db');
	}

	/* Renvoi les informations de la table etudiant*/
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
	
	public function insertInscription() {
		$avatar_test = $this->check_upload_img();
		echo $avatar_test; 
		$avatar	=	array(
						'visible' => 1,
						'source' => $avatar_test,
						'dateUpload' =>  date("Y-m-d"),
						'loginEtudiant' => Atomik::get('session.login')
					);
		
		$this->db->insert("image", $avatar);
		$id_avatar = $this->db->selectOne("image", "source = '".$avatar_test."'");
		$avatar_test = $this->check_upload_img();
		$data 	= 	array(
						'loginEtudiant' => Atomik::get('session.login'),
						'age' => $_POST['age'], 
						'sexe' => $_POST['sexe'], 
						'tel' =>  $_POST['telephone'], 
						'adresse' => $_POST['adresse'], 
						'orientation' =>  $_POST['orientation'], 
						'semestre' =>  $_POST['semestre'],
						'avatar' => $id_avatar['id']
					);
		$this->db->insert("infos_profil", $data);	
	}
};

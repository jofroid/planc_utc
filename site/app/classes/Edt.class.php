<?php
class Edt
{
	
	function __construct ()
	{
		$this->db = Atomik::get('db');
	}

	// Télécharge tous les fichiers *.edt du serveur du SME (si c'est pas déjà fait)
	// Retourne false si pas fini

	public function download_all_edt($modcasid)
	{
		$curl = new CURL(strpos($_SERVER['HTTP_HOST'],'utc') !== false);
		$curl->setCookies('MODCASID='.$modcasid);
		/* On récupère la liste sur /sme/EDT/ */
		$liste = $curl->get('http://wwwetu.utc.fr/sme/EDT/');
		preg_match('#([a-zA-Z]{3})-20([0-9]{2})#isU', $liste, $m);
		if (!isset($m[2])) die('MODCASID errone ou expire..');
		$semestre = ($m[1] == 'Sep' ? 'A' : 'P') . $m[2];
		preg_match_all('#"([a-z]{8}.edt)"#isU', $liste, $m);
		$dispo = $m[1];
		// On crée le dossier du semestre si il n'a pas été téléchargé

		

		/* On récupère la liste des fichiers déjà téléchargés */
		$dossier =  'assets/edt/'.'EDT_' . $semestre;
		if (!is_dir($dossier)) mkdir($dossier);
		$already = scandir($dossier);
		/**/

		/* On télécharge ceux qui ne sont pas déjà téléchargés */
		$todo = array_diff($dispo,$already);
		$i = 0;
		echo 'Nombre de fichiers a telecharger : ' . count($todo) . ' / ' . count($dispo) . ' ['.$semestre.']<br/>';
		foreach($todo as $f)
		{
			$c = $curl->get('http://wwwetu.utc.fr/sme/EDT/' . $f);
			echo $c;
			file_put_contents($dossier . '/' . $f, $c);

			$i++;
			if ($i >= 20) break; // On évite de surcharger le serveur
		}

	}

	public function download_edt($login,$modcasid,$dossier)
	{
		$curl = new CURL(strpos($_SERVER['HTTP_HOST'],'utc') !== false);
		$curl->setCookies('MODCASID='.$modcasid);
		$fichier = $login.'.edt';
		$c = $curl->get('http://wwwetu.utc.fr/sme/EDT/' . $fichier);
		file_put_contents($dossier . '/' . $fichier, $c);
	}


	public function insertCours($login,$folder)
	{
		$c = file_get_contents($folder . '/'.$login.'.edt');
		
		/* Quand il y a un "/" alors on fait une copie de la ligne */
		$ls = explode("\n",$c);
			for($i = 0; $i < sizeof($ls); $i++)
			{
				$x = explode('/',$ls[$i]);
				for ($y = 1; $y < sizeof($x); $y++)
				{
					array_push($ls,substr($x[0],0,19).$x[$y]);
				}
				$ls[$i] = $x[0];
			}
			$c = implode("\n",$ls);
			/**/

			preg_match('#([A-Z]{2}[0-9]{2})(?: )+([0-9]{1})#isU',$c,$m);
			$semestre = $m[1];
			$nbuv = $m[2];
			//$designation = '';
			$designation = substr($ls[3],1,strpos($ls[3],' (')-1);
			$nom = '';
			$prenom = '';
			$email = '';
			preg_match('#\(([a-z-]+.[a-z-]+@etu.utc.fr)\)#isU',$ls[3],$m);
			if (isset($m[1])) $email = $m[1];
			$titre = $login;
			if ($designation != '') $titre .= " '$designation'";
			if ($email != '') $titre .= " : $email";
			echo "<strong>$titre</strong><br/>";


			preg_match_all('#' . self::regex() . '#isU',$c,$m);
			//print_r($m);
			$n = sizeof($m[0]);
			for($i = 0; $i < $n; $i++)
			{

				$debut = explode(':',$m[5][$i]);
				$debut = $debut[0]*60+$debut[1];
				$fin = explode(':',$m[6][$i]);
				$fin = $fin[0]*60+$fin[1];
				$groupe = $m[3][$i];
				if ($groupe == '') $groupe = 0;

				$jour = str_replace(array('LUNDI','MARDI','MERCREDI','JEUDI','VENDREDI','SAMEDI'),array(0,1,2,3,4,5),$m[4][$i]);
				echo $m[1][$i].','.$m[2][$i].','.$groupe.','.$jour.','.$debut.','.$fin.','.$m[7][$i].','.$m[8][$i];
				echo '<br/>';
				$data = array(
				    'login' => $login,
				    'uv' => $m[1][$i],
				    'type' => $m[2][$i],
				    'groupe' => $groupe,
				    'jour' => $jour,
				    'debut' =>$debut ,
				    'fin' => $fin,
				    'frequence' => $m[7][$i],
				    'salle' => $m[8][$i] 
				);
				$this->db->insert('cours', $data);
			}

			$data = array('semestre' => $semestre );
			$this->db->update('infos_profil', $data, array('loginEtudiant' => $login));
	}

	private static function regex()
	{
		$regex = '([A-Z0-9]{4})'; // 1: UV (2 lettres, 2 chiffres) [cas particuliers : C2I1]
		$regex .= '(?: )+';
		$regex .= '(C|D|T)'; // 2: Type (Cours,TD,TP)
		$regex .= '(?: )*';
		$regex .= '([0-9]{0,2})'; // 3: Groupe de TD ou TP (facultatif)
		$regex .= '(?: )+';
		$regex .= '(LUNDI|MARDI|MERCREDI|JEUDI|VENDREDI|SAMEDI)'; // 4: Jour
		$regex .= '(?: |\.)+';
		$regex .= '([0-9]{1,2}:[0-9]{2})'; // 5: Heure début
		$regex .= '-';
		$regex .= '([0-9]{1,2}:[0-9]{2})'; // 6: Heure fin
		$regex .= ',';
		$regex .= '(F[0-9]{1})'; // 7: Fréquence (1 fois toutes les N semaines)
		$regex .= ',S=';
		$regex .= '([A-Z0-9]{5})?'; // 8: Salle (facultatif à cause de SPJE) [cas particuliers : GAUSS]
		$regex .= "(?: |\n)";
		return $regex;
	}
}
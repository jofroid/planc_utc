<?php
use \Ginger\Client\GingerClient;

class Etudiant
{
	const TABLE 		= "etudiant";
	const TABLE_SESSION = "etudiant_sessions";
	const DUREE_SESSION = 604800; // 3600*24*7 (1 semaine de durée)

	private $login = "";
	private $nom = "";
	private $prenom = "";
	private $is_admin = false;
	private $is_adult = false;
	private $email = "";

	// ID persistant lié au login
	public $id_persistant = "";

	// ID temporaire lié à la connexion
	public $id_temporaire = "";

	public static function avecLogin($login)
	{
		$etudiant = new Etudiant();
		$etudiant->login = $login;

		$db = Atomik::get("db");
		$row = $db->selectOne(self::TABLE, array('login' => $login));
		if (!$row)
		{
			// L'étudiant ne s'est jamais connecté à Wink (sacrilège!), on récupère depuis Ginger ses infos
			$gingerClient = new GingerClient(Atomik::get("ginger_apikey"), Atomik::get("ginger_server"));
			$userInfo = $gingerClient->getUser($login);
			if ($userInfo != null)
			{
				$etudiant->nom = $userInfo->nom;
				$etudiant->prenom = $userInfo->prenom;
				$etudiant->email = $userInfo->mail;
			}
			else
			{
				Log::error("GingerClient: Utilisateur inexistant dans Ginger: " . $login);
				throw new Exception("Vous êtes inconnu auprès du SiMDE. Impossible de vous connecter à Wink");
			}

			// On lui crée son identifiant ID persistant lié à son login
			$etudiant->id_persistant = md5(uniqid('', true));

			// On l'insère (enfin) dans la base de données
			$etudiant->create();
		}
		else
		{
			$etudiant->login = $row['login'];
			$etudiant->nom = $row['nom'];
			$etudiant->prenom = $row['prenom'];
			$etudiant->email = $row['email'];
			$etudiant->is_adult = $row['is_adult'];
			$etudiant->is_admin = $row['is_admin'];
			if ($row['id_persistant'] == '')
			{
				$row['id_persistant'] = md5(uniqid('', true));
				$db->update(self::TABLE, array('id_persistant' => $row['id_persistant']), array('login' => $row['login']));
			}
			$etudiant->id_persistant = $row['id_persistant'];
		}
		return $etudiant;
	}

	public static function avecCookie($id_persistant, $id_temporaire)
	{
		$db = Atomik::get("db");
		$row_persistant = $db->selectOne(self::TABLE, array('id_persistant' => $id_persistant));
		$row_temporaire = $db->selectOne(self::TABLE_SESSION, array('id_temporaire' => $id_temporaire));
		if (strtotime($row_temporaire["date_expiration"]) <= time())
		{
			// Couille dans le paté, le mec a rallongé la durée de son cookie !
			// On lui supprime le cookie dans la base de données
			$db->delete(self::TABLE_SESSION, array('id_temporaire' => $id_temporaire));
			return null;
		}
		if ($row_persistant["login"] != $row_temporaire["login"])
		{
			// Les deux cookies ne correspondent pas au même login
			// Couille dans le paté
			$db->delete(self::TABLE_SESSION, array('id_temporaire' => $id_temporaire));
			return null;
		}

		$etudiant = new Etudiant();
		$etudiant->login = $row_persistant['login'];
		$etudiant->nom = $row_persistant['nom'];
		$etudiant->prenom = $row_persistant['prenom'];
		$etudiant->email = $row_persistant['email'];
		$etudiant->is_adult = $row_persistant['is_adult'];
		$etudiant->is_admin = $row_persistant['is_admin'];
		$etudiant->id_persistant = $row_persistant['id_persistant'];
		$etudiant->id_temporaire = $row_temporaire['id_temporaire'];
		return $etudiant;
	}

	public function genIdTemporaire()
	{
		$db = Atomik::get("db");
		$db->delete(self::TABLE_SESSION, array('login' => $this->login));
		$this->id_temporaire = md5(uniqid('', true));
		$date_expiration = time() + self::DUREE_SESSION;
		$cookie = array(
			'id_temporaire' 	=> $this->id_temporaire,
			'date_expiration' 	=> $date_expiration,
			);

		$db->insert(self::TABLE_SESSION, array(
			'login' => $this->login,
			'id_temporaire' => $this->id_temporaire,
			'date_expiration' => date("Y-m-d H:i:s", $date_expiration)
			));
		return $cookie;
	}

	private function create()
	{
		$db = Atomik::get("db");
		$db->insert(self::TABLE, array(
			'login' 		=> $this->login,
			'nom' 			=> $this->nom,
			'prenom' 		=> $this->prenom,
			'is_admin' 		=> false,
			'is_adult' 		=> $this->is_adult,
			'email' 		=> $this->email,
			'id_persistant' => $this->id_persistant
			));
	}
}
?>
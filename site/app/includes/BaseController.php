<?php
abstract class BaseController extends \Atomik\Controller\Controller
{
	protected $etudiant = null;
	public function __construct() {}

	public function _isLogged() 
	{
		if (isset($_COOKIE["id_temporaire"]) && isset($_COOKIE["id_persistant"]))
		{
			// On vérifie que les deux cookies sont liés bien au même login
			$etudiant = Etudiant::avecCookie($_COOKIE["id_persistant"], $_COOKIE["id_temporaire"]);
			if (!$etudiant)
			{
				setcookie($_COOKIE["id_temporaire"], null, -1);
				setcookie($_COOKIE["id_persistant"], null, -1);
				unset($_COOKIE["id_temporaire"]);
				unset($_COOKIE["id_persistant"]);
				return false;
			}
			$this->etudiant = $etudiant;
			return true;
		}
		return false;
	}
}
?>
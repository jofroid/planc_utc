<?php

Atomik::needed("Store");
Atomik::needed("Wink");

class AjaxController extends BaseController
{
	public function profiles()
	{
		$store = new Store();
		//$result = $store->get_profile_correspond($login_user,17,$store->get_orientation($login_user),$store->get_sexe($login_user));
		$result = $store->get_profile_by_location($this->etudiant->login,17,$store->get_orientation($this->etudiant->login),$store->get_sexe($this->etudiant->login),1,1);
		echo json_encode($result);
	}

	public function sendwink()
	{
		$wink = new Wink();
	
		if(Etudiant::loginExist($_GET['logindest']))
		{
			$wink->sendWink(date("Y:m:d"),$this->etudiant->login,$_GET['logindest']);
		}
		else
		{
		
		}
	}

	protected function preDispatch()
	{
			$this->_disableLayout();
			if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
			{
			    // C'est une requête AJAX
			    if (!$this->_isLogged())
				{
					$this->_redirect("/auth/login");
				}

			}
			else
			{
			    // C'est une requête normale
			    $this->_trigger404("Vous n'avez pas le droit d'accéder à cette zone.");
			}
	}
}
?>
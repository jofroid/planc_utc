<?php

Atomik::needed("Inscription");
Atomik::needed("Wink");

class InscriptionController extends BaseController
{
	public function index()
	{
		
	}

	protected function preDispatch()
	{
		if (!$this->_isLogged())
		{
			$this->_redirect("/auth/login");
		}
	}
}
?>
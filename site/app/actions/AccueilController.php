<?php
class AccueilController extends BaseController
{
	protected function preDispatch()
	{
		if (!$this->_isLogged())
		{
			Atomik::redirect('auth/login');
		}
	}

	public function index()
	{
		return $this->etudiant;
	}
}
?>
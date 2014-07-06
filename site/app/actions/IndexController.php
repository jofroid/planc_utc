<?php
class IndexController extends BaseController
{
	public function index()
	{
		if ($this->_isLogged())
		{
			$this->_setView("accueil");
		}
		else
		{
			$this->_disableLayout();
			$this->_setView("index");
			return array('url_cas' => Atomik::url('/auth/login'));
		}
	}
}
?>
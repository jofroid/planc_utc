<?php
Class Images {

	//Attributs
	public $id_image;
	public $source;
	public $visible;
	public $legende;
	public $date_upload;

	function __construct ($id_image, $source, $visible, $legende, $date_upload){
		$this->id_image = $id_image;
		$this->source = $source;
		$this->visible = $visible;
		$this->legende = $legende;
		$this->date_upload = $login;
	}


	function inserer () {

	}

	public static function getImages(){

	}
};

?>

<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Escritorio extends Sagyc{
	private $accesox;
	private $comic;
	private $editar;

	public function __construct(){
		parent::__construct();
	}
	
}

$db = new Escritorio();
if(strlen($function)>0){
  echo $db->$function();
}


?>

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
	public function busca_afiliados(){
		try{
			if (isset($_REQUEST['buscar']) and strlen(trim($_REQUEST['buscar']))>0){
				$texto=trim(htmlspecialchars($_REQUEST['buscar']));
				$sql="SELECT * from afiliados
				where Filiacion like '%$texto%' or ape_pat like '%$texto%' or ape_mat like '%$texto' or nombre like '%$texto' order by afiliados.idfolio desc limit 100";
			}
			else{
				$sql="SELECT * from afiliados order by afiliados.idfolio desc limit 100";
			}
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			return $sth->fetchAll();
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function reset_pass(){
		try{
			$idfolio=$_REQUEST['folio'];
			$sql="select * from afiliados where idfolio=:idfolio";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idfolio",$idfolio);
			$sth->execute();
			$resp=$sth->fetch(PDO::FETCH_OBJ);

			$fecha=date("Y-m-d H:i:s");
			$arreglo+=array('fpass_sol'=>$fecha);
			$arreglo+=array('up_pass'=>1);
			$arreglo+=array('idfolio'=>$idfolio);
			$arreglo+=array('filiacion'=>$resp->Filiacion);
			$arreglo+=array('nombre'=>$resp->nombre);
			$arreglo+=array('ape_pat'=>$resp->ape_pat);
			$arreglo+=array('ape_mat'=>$resp->ape_mat);
			$x=$this->insert('bit_datos', $arreglo);
			return $x;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
}

$db = new Escritorio();
if(strlen($function)>0){
  echo $db->$function();
}


?>

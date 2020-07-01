<?php
require_once("../control_db.php");

class Diasnocre extends Sagyc{
	public function dias(){
		try{
			$sql="SELECT * FROM diasnocred";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			$res=$sth->fetchAll();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}

	function guardar_dias(){
		$x="";
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();
		if (isset($_REQUEST['descripcion'])){
			$arreglo+=array('descripcion'=>$_REQUEST['descripcion']);
		}
		if (isset($_REQUEST['fecha'])){
			$fx=explode("-",$_REQUEST['fecha']);
			$arreglo+=array('fecha'=>$fx['2']."-".$fx['1']."-".$fx['0']);
		}

		if (isset($_REQUEST['recurrente'])){
			$arreglo+=array('recurrente'=>$_REQUEST['recurrente']);
		}
		if($id==0){
			$x.=$this->insert('diasnocred', $arreglo);
		}
		else{
			$x.=$this->update('diasnocred',array('iddias'=>$id), $arreglo);
		}
		return $x;
	}

	public function dias_edit($iddias){
		try{

			$sql="SELECT * FROM diasnocred where iddias=:iddias";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":iddias",$iddias);
			$sth->execute();
			$res=$sth->fetch();
			return $res;
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}



}


if(strlen($function)>0){
	$personal = new Diasnocre();
	echo $personal->$function();
}

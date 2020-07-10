<?php
require_once("../control_db.php");

class Diasno extends Sagyc{

	public function dias(){
		try{

			$sql="SELECT * FROM diasno";
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
		if (isset($_REQUEST['id'])){$id=clean_var($_REQUEST['id']);}
		$arreglo =array();
		if (isset($_REQUEST['descripcion'])){
			$arreglo+=array('descripcion'=>clean_var($_REQUEST['descripcion']));
		}
		if (isset($_REQUEST['fecha'])){
			$fx=explode("-",clean_var($_REQUEST['fecha']));
			$arreglo+=array('fecha'=>$fx['2']."-".$fx['1']."-".$fx['0']);
		}

		if (isset($_REQUEST['recurrente'])){
			$arreglo+=array('recurrente'=>clean_var($_REQUEST['recurrente']));
		}
		if($id==0){
			$x.=$this->insert('diasno', $arreglo);
		}
		else{
			$x.=$this->update('diasno',array('iddias'=>$id), $arreglo);
		}
		return $x;
	}

	public function dias_edit($iddias){
		try{
			$sql="SELECT * FROM diasno where iddias=:iddias";
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
	$personal = new Diasno();
	echo $personal->$function();
}

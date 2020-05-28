<?php
require_once("../control_db.php");
if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Diasno extends Sagyc{

	public function dias(){
		try{
			self::set_names();
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

	public function dias_edit($iddias){
		try{
			parent::set_names();
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

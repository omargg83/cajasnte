<?php
require_once("../control_db.php");

if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}

class Oficios extends Sagyc{
	private $accesox;
	private $comic;
	private $editar;

	public function __construct(){
		parent::__construct();
	}
	public function bloques_guardar(){
		self::set_names();
		$x="";
		$arreglo =array();

		if (isset($_REQUEST['fusuario']) and strlen($_REQUEST['fusuario'])>0){
			$fx=explode("-",$_REQUEST['fusuario']);
			$arreglo+=array('fusuario'=>$fx['2']."-".$fx['1']."-".$fx['0']." 23:59:59");
		}
		else{
			$arreglo+=array('fusuario'=>NULL);
		}

		if (isset($_REQUEST['faportacion']) and strlen($_REQUEST['faportacion'])>0){
			$fx=explode("-",$_REQUEST['faportacion']);
			$arreglo+=array('faportacion'=>$fx['2']."-".$fx['1']."-".$fx['0']." 23:59:59");
		}
		else{
			$arreglo+=array('faportacion'=>NULL);
		}

		if (isset($_REQUEST['fbeneficiarios']) and strlen($_REQUEST['fbeneficiarios'])>0){
			$fx=explode("-",$_REQUEST['fbeneficiarios']);
			$arreglo+=array('fbeneficiarios'=>$fx['2']."-".$fx['1']."-".$fx['0']." 23:59:59");
		}
		else{
			$arreglo+=array('fbeneficiarios'=>NULL);
		}

		if (isset($_REQUEST['fretiro']) and strlen($_REQUEST['fretiro'])>0){
			$fx=explode("-",$_REQUEST['fretiro']);
			$arreglo+=array('fretiro'=>$fx['2']."-".$fx['1']."-".$fx['0']." 23:59:59");
		}
		else{
			$arreglo+=array('fretiro'=>NULL);
		}

		$sql="select * from bit_bloques limit 1";
		$sth = $this->dbh->prepare($sql);
		$sth->execute();
		$row=$sth->fetch();
		$contar=$sth->rowCount();
		$x="";
		if($contar==1){
			$x=$this->update('bit_bloques',array('id'=>$row['id']), $arreglo);
		}
		else{
			$x=$this->insert('bit_bloques', $arreglo);
		}
		return $x;
	}
	public function blog_guardar(){
		///////////////////////
		$x="";
		if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
		$arreglo =array();

		if (isset($_REQUEST['nombre'])){
			$arreglo = array('nombre'=>$_REQUEST['nombre']);
		}
		if (isset($_REQUEST['texto'])){
			$arreglo+=array('texto'=>$_REQUEST['texto']);
		}
		if (isset($_REQUEST['corto'])){
			$arreglo+=array('corto'=>$_REQUEST['corto']);
		}
		if (isset($_REQUEST['limite']) and strlen($_REQUEST['limite'])>0){
			$fx=explode("-",$_REQUEST['limite']);
			$arreglo+=array('limite'=>$fx['2']."-".$fx['1']."-".$fx['0']." 23:59:59");
		}
		else{
			$arreglo+=array('limite'=>NULL);
		}

		if (isset($_REQUEST['noticia']) and strlen($_REQUEST['noticia'])>0){
			$arreglo+=array('noticia'=>1);
		}
		else{
			$arreglo+=array('noticia'=>NULL);
		}

		if (isset($_REQUEST['alerta']) and strlen($_REQUEST['alerta'])>0){
			$arreglo+=array('alerta'=>1);
		}
		else{
			$arreglo+=array('alerta'=>NULL);
		}

		if (isset($_REQUEST['baner']) and strlen($_REQUEST['baner'])>0){
			$arreglo+=array('baner'=>1);
		}
		else{
			$arreglo+=array('baner'=>NULL);
		}

		if($id==0){
			$x=$this->insert('bit_blog', $arreglo);
		}
		else{
			$x=$this->update('bit_blog',array('id'=>$id), $arreglo);
		}
		return $x;
	}
	public function blog_editar($id){
		try{
			self::set_names();
			$sql="select * from bit_blog where id=:id";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":id",$id);
			$sth->execute();
			return $sth->fetch();
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function blog_lista(){
		try{
			self::set_names();
			$sql="select * from bit_blog";
			$sth = $this->dbh->prepare($sql);
			//$sth->bindValue(":idfolio",$_SESSION['idfolio']);
			$sth->execute();
			return $sth->fetchAll();
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function reporte_1($desde,$hasta){
		try{
				$sql="
				SELECT idfolio, filiacion, fpass_sol as fsol, fpass_up as fecha, 'Contraseña' as tipo, nombre, ape_pat, ape_mat, up_pass as estado from bit_datos where fpass_up between '$desde' and '$hasta' and up_pass>0
				union
				SELECT idfolio, filiacion, fcorreo_sol as fsol, fcorreo_up as fecha, 'Correo' as tipo, nombre, ape_pat, ape_mat, up_correo as estado from bit_datos where fcorreo_up between '$desde' and '$hasta' and up_correo>0
				union
				SELECT idfolio, filiacion, faport_sol as fsol, faport_up as fecha, 'Aportación' as tipo, nombre, ape_pat, ape_mat, up_aportacion as estado from bit_datos where faport_up between '$desde' and '$hasta' and up_aportacion>0
				union
				SELECT idfolio, filiacion, fbene_sol as fsol, fbene_up as fecha, 'Beneficiarios' as tipo, nombre, ape_pat, ape_mat, up_bene as estado from bit_datos where fbene_up between '$desde' and '$hasta' and up_bene>0
				union
				SELECT idfolio, filiacion, fdatos_sol as fsol, fdatos_up as fecha, 'Datos' as tipo, nombre, ape_pat, ape_mat, up_datos as estado from bit_datos where fdatos_up between '$desde' and '$hasta' and up_datos>0
				";
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			return $sth->fetchAll();
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function borrar_blog(){
		if (isset($_POST['id'])){$id=$_POST['id'];}
		return $this->borrar('bit_blog',"id",$id);
	}
}

$db = new Oficios();
if(strlen($function)>0){
  echo $db->$function();
}


?>

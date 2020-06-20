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

	public function guardar_datos(){			/////////////////////////////////////PARA CAMBIOS DE DATOS
		$x="";
		$arreglo =array();
		$id=$_REQUEST['id'];

		$sql="select * from afiliados where idfolio=:idfolio";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":idfolio",$id);
		$sth->execute();
		$row=$sth->fetch();

		$cambios="";
		$tipo_cuenta=$_REQUEST['tipo_cuenta'];
		$num_cuenta=$_REQUEST['num_cuenta'];
		$titular=$_REQUEST['titular'];
		$clave_banco=$_REQUEST['clave_banco'];
		$plaza_banxico=$_REQUEST['plaza_banxico'];
		$sucursal=$_REQUEST['sucursal'];
		$tipo_cuenta2=$_REQUEST['tipo_cuenta2'];
		$benef_app_paterno=$_REQUEST['benef_app_paterno'];
		$benef_app_materno=$_REQUEST['benef_app_materno'];
		$benef_nombre=$_REQUEST['benef_nombre'];
		$benef_direccion=$_REQUEST['benef_direccion'];
		$benef_ciudad=$_REQUEST['benef_ciudad'];

		$arr=array();
		$fecha=date("Y-m-d H:i:s");
		$arreglo+=array('fup'=>$fecha);
		$arreglo+=array('update'=>1);
		$arreglo+=array('idfolio'=>$row['idfolio']);

		$arreglo+=array('filiacion'=>$row['Filiacion']);
		$arreglo+=array('nombre'=>$row['nombre']);
		$arreglo+=array('ape_pat'=>$row['ape_pat']);
		$arreglo+=array('ape_mat'=>$row['ape_mat']);
		$x=$this->insert('bancos', $arreglo);
		return $x;
	}
	public function cancela_datos(){
		$x="";
		$sql="select * from bit_datos where idfolio=:idfolio and up_datos=1";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":idfolio",$_SESSION['idfolio']);
		$sth->execute();
		$row=$sth->fetch();

		$x=$this->borrar('bit_datos','id',$row['id']);
		if($x){
			$arr=array();
			$arr+=array('error'=>0);
			$arr+=array('terror'=>"");
		}
		else{
			$arr=array();
			$arr+=array('error'=>1);
			$arr+=array('terror'=>"Error favor de verificar");
		}
		return json_encode($arr);
	}

	public function guardar_acceso(){			/////////////////////////////////////PARA CAMBIOS DE ACCESO
		$x="";
		$arreglo =array();
		$idfolio=$_REQUEST['id'];
		$sql="select * from afiliados where idfolio=:idfolio";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":idfolio",$idfolio);
		$sth->execute();
		$row=$sth->fetch();

		$cambios="";
		$correo=$_REQUEST['correo'];
		$celular=$_REQUEST['celular'];
		if($row['correo']!=$correo){
			$cambios.=" d_dom:".trim($correo);
		}
		if($row['celular']!=$celular){
			$cambios.=" e_civ:".trim($celular);
		}
		if(strlen($cambios)>1){

			$fecha=date("Y-m-d H:i:s");
			$arreglo =array();
			$arreglo+=array('tipo'=>"CORREO");
			$arreglo+=array('fcorreo_sol'=>$fecha);
			$arreglo+=array('up_correo'=>1);
			$arreglo+=array('correo'=>trim($_REQUEST['correo']));
			$arreglo+=array('celular'=>trim($_REQUEST['celular']));

			$arreglo+=array('idfolio'=>$row['idfolio']);
			$arreglo+=array('filiacion'=>$row['Filiacion']);
			$arreglo+=array('nombre'=>$row['nombre']);
			$arreglo+=array('ape_pat'=>$row['ape_pat']);
			$arreglo+=array('ape_mat'=>$row['ape_mat']);
			$x=$this->insert('bit_datos', $arreglo);

			return $x;
		}
		else{
			$arr=array();
			$arr+=array('error'=>1);
			$arr+=array('terror'=>"No hay cambios");
			return json_encode($arr);
		}
	}
	public function cancela_acceso(){
		$x="";
		$sql="select * from bit_datos where idfolio=:idfolio and up_correo=1";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":idfolio",$_SESSION['idfolio']);
		$sth->execute();
		$row=$sth->fetch();
		$contar=$sth->rowCount();

		$x=$this->borrar('bit_datos','id',$row['id']);
		if($x){
			$arr=array();
			$arr+=array('error'=>0);
			$arr+=array('terror'=>"");
		}
		else{
			$arr=array();
			$arr+=array('error'=>1);
			$arr+=array('terror'=>"Error favor de verificar");
		}
		return json_encode($arr);
	}

	public function guardar_pass(){				/////////////////////////////////////PARA CAMBIOS DE CONTRASEÑA
		$x="";
		$arreglo =array();
		$idfolio=$_REQUEST['id'];
		$sql="select * from afiliados where idfolio=:idfolio";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":idfolio",$idfolio);
		$sth->execute();
		$row=$sth->fetch();

		if(trim($_REQUEST['pass1'])==trim($_REQUEST['pass2'])){
			$arreglo+=array('password'=>trim($_REQUEST['pass1']));

			$fecha=date("Y-m-d H:i:s");
			$arreglo+=array('tipo'=>"PASSWORD");
			$arreglo+=array('fpass_sol'=>$fecha);
			$arreglo+=array('up_pass'=>1);

			$arreglo+=array('idfolio'=>$idfolio);
			$arreglo+=array('filiacion'=>$row['Filiacion']);
			$arreglo+=array('nombre'=>$row['nombre']);
			$arreglo+=array('ape_pat'=>$row['ape_pat']);
			$arreglo+=array('ape_mat'=>$row['ape_mat']);
			$x=$this->insert('bit_datos', $arreglo);
			return $x;
		}
		else{
			$arr=array();
			$arr+=array('error'=>1);
			$arr+=array('terror'=>"No coinciden contraseñas");
			return json_encode($arr);
		}
	}
	public function cancela_pass(){
		$x="";
		$sql="select * from bit_datos where idfolio=:idfolio and up_pass=1";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":idfolio",$_SESSION['idfolio']);
		$sth->execute();
		$row=$sth->fetch();
		$contar=$sth->rowCount();

		$x=$this->borrar('bit_datos','id',$row['id']);
		if($x){
			$arr=array();
			$arr+=array('error'=>0);
			$arr+=array('terror'=>"");
		}
		else{
			$arr=array();
			$arr+=array('error'=>1);
			$arr+=array('terror'=>"Error favor de verificar");
		}
		return json_encode($arr);
	}

}

$db = new Escritorio();
if(strlen($function)>0){
  echo $db->$function();
}


?>

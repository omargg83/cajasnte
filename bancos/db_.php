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
	public function bancos(){
		try{
			$sql="select * from bancos where idfolio=:idfolio";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idfolio",$_SESSION['idfolio']);
			$sth->execute();
			return $sth->fetch(PDO::FETCH_OBJ);
		}
		catch(PDOException $e){
			return "Database access FAILED! ".$e->getMessage();
		}
	}
	public function guardar_bancos(){			////////PARA CAMBIOS DE DATOS
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

		$res=$this->bancos();
		$cambios="";
		if($res){
			if($res->tipo_cuenta!=$tipo_cuenta){
				$cambios.=" $tipo_cuenta:".trim($tipo_cuenta);
			}
			if($res->num_cuenta!=$num_cuenta){
				$cambios.=" $num_cuenta:".trim($num_cuenta);
			}
			if($res->titular!=$titular){
				$cambios.=" $titular:".trim($titular);
			}
			if($res->clave_banco!=$clave_banco){
				$cambios.=" $clave_banco:".trim($clave_banco);
			}
			if($res->plaza_banxico!=$plaza_banxico){
				$cambios.=" $plaza_banxico:".trim($plaza_banxico);
			}
			if($res->sucursal!=$sucursal){
				$cambios.=" $sucursal:".trim($sucursal);
			}
			if($res->tipo_cuenta2!=$tipo_cuenta2){
				$cambios.=" $tipo_cuenta2:".trim($tipo_cuenta2);
			}
			if($res->benef_app_paterno!=$benef_app_paterno){
				$cambios.=" $benef_app_paterno:".trim($benef_app_paterno);
			}
			if($res->benef_app_materno!=$benef_app_materno){
				$cambios.=" $benef_app_materno:".trim($benef_app_materno);
			}
			if($res->benef_nombre!=$benef_nombre){
				$cambios.=" $benef_nombre:".trim($benef_nombre);
			}
			if($res->benef_direccion!=$benef_direccion){
				$cambios.=" $benef_direccion:".trim($benef_direccion);
			}
			if($res->benef_ciudad!=$benef_ciudad){
				$cambios.=" $benef_ciudad:".trim($benef_ciudad);
			}
		}
		else{
			$cambios="cambios";
		}

		if(strlen($cambios)>1){
			$arr=array();
			$fecha=date("Y-m-d H:i:s");
			$arreglo+=array('up_date'=>1);
			$arreglo+=array('fup'=>$fecha);
			$arreglo+=array('idfolio'=>$row['idfolio']);
			$arreglo+=array('filiacion'=>$row['Filiacion']);
			$arreglo+=array('nombre'=>$row['nombre']);
			$arreglo+=array('ape_pat'=>$row['ape_pat']);
			$arreglo+=array('ape_mat'=>$row['ape_mat']);

			$arreglo+=array('tipo_cuenta'=>trim($tipo_cuenta));
			$arreglo+=array('num_cuenta'=>trim($num_cuenta));
			$arreglo+=array('titular'=>trim($titular));
			$arreglo+=array('clave_banco'=>trim($clave_banco));
			$arreglo+=array('plaza_banxico'=>trim($plaza_banxico));
			$arreglo+=array('sucursal'=>trim($sucursal));
			$arreglo+=array('tipo_cuenta2'=>trim($tipo_cuenta2));
			$arreglo+=array('benef_app_paterno'=>trim($benef_app_paterno));
			$arreglo+=array('benef_app_materno'=>trim($benef_app_materno));
			$arreglo+=array('benef_nombre'=>trim($benef_nombre));
			$arreglo+=array('benef_direccion'=>trim($benef_direccion));
			$arreglo+=array('benef_ciudad'=>trim($benef_ciudad));

			$x=$this->insert('bit_bancos', $arreglo);
			return $x;
		}
		else{
			$arr=array();
			$arr+=array('error'=>1);
			$arr+=array('terror'=>"No hay cambios");
			return json_encode($arr);
		}
	}
	public function cancela_datos(){
		$x="";
		$sql="select * from bit_bancos where idfolio=:idfolio and up_date=1";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":idfolio",$_SESSION['idfolio']);
		$sth->execute();
		$row=$sth->fetch();

		$x=$this->borrar('bit_bancos','idbanco',$row['idbanco']);
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

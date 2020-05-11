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

	public function guardar_datos(){						/////////////////////////////////////PARA CAMBIOS DE DATOS
		$x="";
		$arreglo =array();
		$id=$_REQUEST['id'];

		$sql="select * from afiliados where idfolio=:idfolio";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":idfolio",$id);
		$sth->execute();
		$row=$sth->fetch();

		$cambios="";
		$d_dom=$_REQUEST['d_dom'];
		$e_civ=$_REQUEST['e_civ'];
		$n_con=$_REQUEST['n_con'];
		$l_loc=$_REQUEST['l_loc'];
		$m_mun=$_REQUEST['m_mun'];
		$c_c_t=$_REQUEST['c_c_t'];
		$u_bic=$_REQUEST['u_bic'];
		$d_sin=$_REQUEST['d_sin'];
		$r_rrg=$_REQUEST['r_rrg'];
		$c_psp=$_REQUEST['c_psp'];

		$correo=$_REQUEST['correo'];
		$celular=$_REQUEST['celular'];

		if($row['d_dom']!=$d_dom){
			$cambios.=" d_dom:".trim($d_dom);
		}
		if($row['e_civ']!=$e_civ){
			$cambios.=" e_civ:".trim($e_civ);
		}
		if($row['n_con']!=$n_con){
			$cambios.=" n_con:".trim($n_con);
		}
		if($row['l_loc']!=$l_loc){
			$cambios.=" l_loc:".trim($l_loc);
		}
		if($row['m_mun']!=$m_mun){
			$cambios.=" m_mun:".trim($m_mun);
		}
		if($row['c_c_t']!=$c_c_t){
			$cambios.=" c_c_t:".trim($c_c_t);
		}
		if($row['u_bic']!=$u_bic){
			$cambios.=" u_bic:".trim($u_bic);
		}
		if($row['d_sin']!=$d_sin){
			$cambios.=" d_sin:".trim($d_sin);
		}
		if($row['r_rrg']!=$r_rrg){
			$cambios.=" r_rrg:".trim($r_rrg);
		}
		if($row['c_psp']!=$c_psp){
			$cambios.=" c_psp:".trim($c_psp);
		}

		$cambio_cel=0;
		if($row['correo']!=$correo){
			$cambios.=" correo:".trim($correo);
			$cambio_cel=1;
		}

		if($row['celular']!=$celular){
			$cambios.=" celular:".trim($celular);
			$cambio_cel=1;
		}


		if(strlen($cambios)>1){
			$arreglo+=array('d_dom'=>trim($d_dom));
			$arreglo+=array('e_civ'=>trim($e_civ));
			$arreglo+=array('n_con'=>trim($n_con));
			$arreglo+=array('l_loc'=>trim($l_loc));
			$arreglo+=array('m_mun'=>trim($m_mun));
			$arreglo+=array('c_c_t'=>trim($c_c_t));
			$arreglo+=array('u_bic'=>trim($u_bic));
			$arreglo+=array('d_sin'=>trim($d_sin));
			$arreglo+=array('r_rrg'=>trim($r_rrg));
			$arreglo+=array('c_psp'=>trim($c_psp));
			$arreglo+=array('correo'=>trim($correo));
			$arreglo+=array('celular'=>trim($celular));

			//$x=$this->update('afiliados',array('idfolio'=>$_SESSION['idfolio']), $arreglo);
			$sql="select * from bit_datos where idfolio=:idfolio and (up_datos=1 or up_datos=0 or up_datos is null) limit 1";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idfolio",$_SESSION['idfolio']);
			$sth->execute();
			$row=$sth->fetch();
			$contar=$sth->rowCount();

			$fecha=date("Y-m-d H:i:s");
			$arreglo+=array('fdatos_sol'=>$fecha);
			$arreglo+=array('up_datos'=>1);

			if($cambio_cel==1){
				$arreglo+=array('up_correo'=>1);
				$arreglo+=array('fcorreo_sol'=>$fecha);
			}

			if($contar==1){
				$this->update('bit_datos',array('id'=>$row['id']), $arreglo);
			}
			else{
				$arreglo+=array('idfolio'=>$row['idfolio']);
				$arreglo+=array('filiacion'=>$row['filiacion']);
				$arreglo+=array('nombre'=>$row['nombre']);
				$arreglo+=array('ape_pat'=>$row['ape_pat']);
				$arreglo+=array('ape_mat'=>$row['ape_mat']);
				$this->insert('bit_datos', $arreglo);
			}
			////////////////////////////
			return $x;
		}
		else{
			return "No hay cambios...";
		}
	}
	public function guardar_acceso(){			/////////////////////////////////////PARA CAMBIOS DE ACCESO
		$x="";
		$arreglo =array();
		$idfolio=$_REQUEST['id'];
		////////////////////////////////////////aca
		$sql="select * from bit_datos where idfolio=:idfolio and (up_correo is null or up_correo=1 or up_correo=0) limit 1";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":idfolio",$_SESSION['idfolio']);
		$sth->execute();
		$contar=$sth->rowCount();
		$row=$sth->fetch();
			$fecha=date("Y-m-d H:i:s");
			$arreglo =array();
			$arreglo+=array('fcorreo_sol'=>$fecha);
			$arreglo+=array('up_correo'=>1);
			$arreglo+=array('correo'=>trim($_REQUEST['correo']));
			$arreglo+=array('celular'=>trim($_REQUEST['celular']));
			if($contar==1){
				$x=$this->update('bit_datos',array('id'=>$row['id']), $arreglo);
			}
			else{
				$arreglo+=array('idfolio'=>$_SESSION['idfolio']);
				$arreglo+=array('filiacion'=>$_SESSION['filiacion']);
				$arreglo+=array('nombre'=>$_SESSION['nombre']);
				$arreglo+=array('ape_pat'=>$_SESSION['ape_pat']);
				$arreglo+=array('ape_mat'=>$_SESSION['ape_mat']);
				$x=$this->insert('bit_datos', $arreglo);
			}
		return $x;
	}
	public function guardar_pass(){				/////////////////////////////////////PARA CAMBIOS DE CONTRASEÑA
		$x="";
		$arreglo =array();
		if(trim($_REQUEST['pass1'])==trim($_REQUEST['pass2'])){
			$arreglo+=array('password'=>trim($_REQUEST['pass1']));

			////////////////////////////////////////aca
			$sql="select * from bit_datos where idfolio=:idfolio and (up_pass=1 or up_pass=0 or up_pass is null) limit 1";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idfolio",$_SESSION['idfolio']);
			$sth->execute();
			$row=$sth->fetch();
			$contar=$sth->rowCount();

			$fecha=date("Y-m-d H:i:s");
			$arreglo+=array('fpass_sol'=>$fecha);
			$arreglo+=array('up_pass'=>1);
			if($contar==1){
				$this->update('bit_datos',array('id'=>$row['id']), $arreglo);
			}
			else{
				$arreglo+=array('idfolio'=>$_SESSION['idfolio']);
				$arreglo+=array('filiacion'=>$_SESSION['filiacion']);
				$arreglo+=array('nombre'=>$_SESSION['nombre']);
				$arreglo+=array('ape_pat'=>$_SESSION['ape_pat']);
				$arreglo+=array('ape_mat'=>$_SESSION['ape_mat']);
				$this->insert('bit_datos', $arreglo);
			}
			////////////////////////////
			return $x;
		}
		else{
			return "No coinciden contraseñas";
		}
	}
	public function cancela_datos(){
		$x="";
		$sql="select * from bit_datos where idfolio=:idfolio and up_datos=1";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":idfolio",$_SESSION['idfolio']);
		$sth->execute();
		$row=$sth->fetch();
		$contar=$sth->rowCount();

		$arreglo =array();
		$arreglo+=array('up_datos'=>0);
		$x=$this->update('bit_datos',array('id'=>$row['id']), $arreglo);
		return $x;
	}
	public function cancela_acceso(){
		$x="";
		$sql="select * from bit_datos where idfolio=:idfolio and up_correo=1";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":idfolio",$_SESSION['idfolio']);
		$sth->execute();
		$row=$sth->fetch();
		$contar=$sth->rowCount();

		$arreglo =array();
		$arreglo+=array('up_correo'=>0);
		$x=$this->update('bit_datos',array('id'=>$row['id']), $arreglo);
		return $x;
	}
	public function cancela_pass(){
		$x="";
		$sql="select * from bit_datos where idfolio=:idfolio and up_pass=1";
		$sth = $this->dbh->prepare($sql);
		$sth->bindValue(":idfolio",$_SESSION['idfolio']);
		$sth->execute();
		$row=$sth->fetch();
		$contar=$sth->rowCount();

		$arreglo =array();
		$arreglo+=array('up_pass'=>0);
		$x=$this->update('bit_datos',array('id'=>$row['id']), $arreglo);
		return $x;
	}
}

$db = new Escritorio();
if(strlen($function)>0){
  echo $db->$function();
}


?>

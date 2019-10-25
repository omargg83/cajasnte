<?php
	if (!isset($_SESSION)) { session_start(); }
	if (isset($_REQUEST['function'])){$function=$_REQUEST['function'];}	else{ $function="";}
	if (isset($_REQUEST['ctrl'])){$ctrl=$_REQUEST['ctrl'];}	else{ $ctrl="";}

	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	date_default_timezone_set("America/Mexico_City");

	class Sagyc{
		public $nivel_personal;
		public $nivel_captura;
		public $derecho=array();
		public $lema;
		public $personas;
		public $arreglo;
		public $limite=300;

		public function __construct(){
			$this->Salud = array();
			date_default_timezone_set("America/Mexico_City");

			$_SESSION['mysqluser']="sagyce18_sagyc";
			$_SESSION['mysqlpass']="sagyc123$";
			$_SESSION['servidor'] ="sagyc2.com.mx";
			$_SESSION['bdd']="sagyce18_caja";

			$this->dbh = new PDO("mysql:host=".$_SESSION['servidor'].";dbname=".$_SESSION['bdd']."", $_SESSION['mysqluser'], $_SESSION['mysqlpass']);

		}
		public function set_names(){
			return $this->dbh->query("SET NAMES 'utf8'");
		}
		public function login(){
			$arreglo=array();
			if(isset($_SESSION['idfolio']) and $_SESSION['autoriza'] == 1) {
				///////////////////////////sesion abierta
				$x="";
				$x.="<nav class='navbar navbar-expand-sm navbar-dark fixed-top barra' style='opacity:1;'>";
					$x.="<img src='img/caja.png' width='20' alt='logo'>";
					$x.="<a class='navbar-brand' href='#afiliado/afiliado'> Caja de Ahorro y Crédito</a>";

					$x.="<button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#principal' aria-controls='principal' aria-expanded='false' aria-label='Toggle navigation'>";
						$x.="<i class='fab fa-rocketchat'></i>";
					$x.="</button>";

					$x.="<div class='collapse navbar-collapse' id='principal'>";

						$x.="<ul class='navbar-nav mr-auto'>";
							$x.="<li class='nav-item dropdown'>";
								$x.="<a class='nav-link navbar-brand' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-user-edit'></i> Datos</a>";
							$x.="</li>";

							$x.="<li class='nav-item dropdown'>";
								$x.="<a class='nav-link navbar-brand' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-money-check-alt'></i> Crédito</a>";
							$x.="</li>";
							$x.="<li class='nav-item dropdown'>";
								$x.="<a class='nav-link navbar-brand' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-university'></i> Ahorro</a>";
							$x.="</li>";
						$x.="</ul>";

						$x.="<ul class='navacceso navbar-nav navbar-right' id='notificaciones'></ul>";

						$x.="<ul class='nav navbar-nav navbar-right'>";
							$x.="<li class='nav-item'>";
								$x.="<a class='nav-link pull-left' onclick='salir()'>";
									$x.="<i class='fas fa-door-open' style='color:red;'></i>Salir";
								$x.="</a>";
							$x.="</li>";
						$x.="</ul>";
					$x.="</div>";
				$x.="</nav>";

				$y="";
				$y.="<div class='fijaproceso main' id='contenido'>";
				$y.="</div>";

				$arreglo=array('sess'=>"abierta", 'header'=>$x, 'cuerpo'=>$y, 'admin'=>"");
				///////////////////////////fin sesion abierta
			}
			else {
				///////////////////////////login
				$valor="fondo/fondo5.jpg";
				$x="<form id='acceso' action=''>
						<div class='container'>
								<center><img src='img/caja.png' width='150px'></center>
								<p class='input_title'>Usuario o correo:</p>
								<div class='form-group input-group'>
									<div class='input-group-prepend'>
										<span class='input-group-text'> <i class='fas fa-user-circle'></i> </span>
									</div>
									<input class='form-control' placeholder='Introduzca usuario o correo' type='text'  id='userAcceso' name='userAcceso' required>
								</div>
								<p class='input_title'>Contraseña:</p>
								<div class='form-group input-group'>
									<div class='input-group-prepend'>
										<span class='input-group-text'> <i class='fa fa-lock'></i> </span>
									</div>
									<input class='form-control' placeholder='Contraseña' type='password'  id='passAcceso' name='passAcceso' required>
								</div>
								<button class='btn btn-warning btn-block' type='submit'><i class='fa fa-check'></i>Aceptar</button>
								<button class='btn btn-outline-info btn-block' type='button' id='recuperar'><i class='fas fa-key'></i>Recuperar contraseña</button>
								<center>http://sagyc.com.mx</center>
						</div>
					</form>";
				$arreglo=array('sess'=>"cerrada", 'fondo'=>$valor, 'carga'=>$x);
				//////////////////////////fin login
			}
			return json_encode($arreglo);
		}
		public function acceso(){

			$userPOST = htmlspecialchars($_REQUEST["userAcceso"]);
			$passPOST = $_REQUEST["passAcceso"];


			self::set_names();
			$sql="select * from afiliados where Filiacion=:usuario and password=:pass";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":usuario",$userPOST);
			$sth->bindValue(":pass",$passPOST);
			$sth->execute();
			$datos=$sth->fetch();

			if(is_array($datos)){
				$userBD = $datos['Filiacion'];
				$passwordBD = $datos['password'];
				if($userBD == $userPOST and $passPOST==$passwordBD){
					$_SESSION['autoriza']=1;
					$_SESSION['filiacion']=$datos['Filiacion'];
					$_SESSION['nombre']=$datos['nombre'];
					$_SESSION['ape_pat']=$datos['ape_pat'];
					$_SESSION['ape_mat']=$datos['ape_mat'];
					$_SESSION['idfolio']=$datos['idfolio'];
					$_SESSION['llave']=md5(rand(10000,99999).$passwordBD);

					$_SESSION['anio']=date("Y");
					$_SESSION['mes']=date("m");
					$_SESSION['dia']=date("d");
					$_SESSION['nocuenta'] = 1;
					$_SESSION['ventana'] = "";
					$_SESSION['administrador']=0;
					$_SESSION['hasta']=date("Y");
					$_SESSION['foco']=mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));

					$arr=array();
					$arr=array('acceso'=>1,'idpersona'=>$_SESSION['idfolio']);
					return json_encode($arr);
				}
			}
			else {
				$arr=array();
				$arr=array('acceso'=>0,'idpersona'=>0);
				return json_encode($arr);
			}
		}

		public function salir(){
			$_SESSION['autoriza'] = 0;
			$_SESSION['idpersona']="";
		}
		public function insert($DbTableName, $values = array()){
			try{
				self::set_names();
				$this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

				foreach ($values as $field => $v)
				$ins[] = ':' . $field;

				$ins = implode(',', $ins);
				$fields = implode(',', array_keys($values));
				$sql="INSERT INTO $DbTableName ($fields) VALUES ($ins)";
				$sth = $this->dbh->prepare($sql);
				foreach ($values as $f => $v){
					$sth->bindValue(':' . $f, $v);
				}
				$sth->execute();
				return $this->lastId = $this->dbh->lastInsertId();
			}
			catch(PDOException $e){
				return "Database access FAILED!".$e->getMessage();
			}
		}
		public function update($DbTableName, $id = array(), $values = array()){
			try{
				self::set_names();
				$this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
				$x="";
				$idx="";
				foreach ($id as $field => $v){
					$condicion[] = $field.'= :' . $field."_c";
				}
				$condicion = implode(' and ', $condicion);
				foreach ($values as $field => $v){
					$ins[] = $field.'= :' . $field;
				}
				$ins = implode(',', $ins);

				$sql2="update $DbTableName set $ins where $condicion";
				$sth = $this->dbh->prepare($sql2);
				foreach ($values as $f => $v){
					$sth->bindValue(':' . $f, $v);
				}
				foreach ($id as $f => $v){
					if(strlen($idx)==0){
						$idx=$v;
					}
					$sth->bindValue(':' . $f."_c", $v);
				}
				if($sth->execute()){
					return "$idx";
				}
				else{
					return "error";
				}
			}
			catch(PDOException $e){
				return "------->$sql2 <------------- Database access FAILED!".$e->getMessage();
			}
		}
		public function borrar($DbTableName, $key,$id){
			try{
				self::set_names();
				$sql="delete from $DbTableName where $key=$id";
				$this->dbh->query($sql);
				return 1;
			}
			catch(PDOException $e){
				return "------->$sql <------------- Database access FAILED!".$e->getMessage();
			}
		}
		public function general($sql){
			try{
				self::set_names();
				$sth = $this->dbh->prepare($sql);
				$sth->execute();
				return $sth->fetchAll();
			}
			catch(PDOException $e){
				return "Database access FAILED!".$e->getMessage();
			}
		}

		public function afiliado(){
			try{
				self::set_names();
				$sql="select * from afiliados where idfolio=:idfolio";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":idfolio",$_SESSION['idfolio']);
				$sth->execute();
				return $sth->fetch();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
		}
		public function creditos(){
			try{
				self::set_names();
				$sql="select * from creditos where filiacion=:filiacion";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":filiacion",$_SESSION['filiacion']);
				$sth->execute();
				return $sth->fetchAll();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
		}
		public function datos_credito($clv_cred){
			try{
				self::set_names();
				$sql="SELECT clv_cred,crx.idfolio,fecha,crx.monto,observa,crx.estado,plazo,if(crx.estado=1,'ACTIVO','INACTIVO') as cred_esta,interes,crx.total,crx.quin_ini,crx.anio_ini,crx.quin_fin,crx.anio_fin,nocheque,aportacion,(select saldo_actual from detallepago where idcredito=crx.clv_cred order by anio desc,quincena desc,iddetalle limit 1) as saldo_actual FROM creditos crx where crx.clv_cred=:clv_cred";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":clv_cred",$clv_cred);
				$sth->execute();
				return $sth->fetch();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
		}
		public function aporta($clv_cred){
			try{
				self::set_names();
				$sql="select SUM(monto) as aporta from detallepago where idcredito=:clv_cred order by anio,quincena,iddetalle";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":clv_cred",$clv_cred);
				$sth->execute();
				return $sth->fetch();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
		}

	}

	$db = new Sagyc();
	if(strlen($function)>0){
		echo $db->$function();
	}

	function moneda($valor){
		return "$ ".number_format( $valor, 2, "." , "," );
	}
	function fecha($fecha,$key=""){
		$fecha = new DateTime($fecha);
		if($key==1){
			$mes=$fecha->format('m');
			if ($mes==1){ $mes="Enero";}
			if ($mes==2){ $mes="Febrero";}
			if ($mes==3){ $mes="Marzo";}
			if ($mes==4){ $mes="Abril";}
			if ($mes==5){ $mes="Mayo";}
			if ($mes==6){ $mes="Junio";}
			if ($mes==7){ $mes="Julio";}
			if ($mes==8){ $mes="Agosto";}
			if ($mes==9){ $mes="Septiembre";}
			if ($mes==10){ $mes="Octubre";}
			if ($mes==11){ $mes="Noviembre";}
			if ($mes==12){ $mes="Diciembre";}

			return $fecha->format('d')." de $mes de ".$fecha->format('Y');
		}
		if($key==2){
			return $fecha->format('d-m-Y H:i:s');
		}
		else{
			return $fecha->format('d-m-Y');
		}
	}
?>

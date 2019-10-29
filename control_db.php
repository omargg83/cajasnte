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
				$y.="<div class='wrapper'>";
					$y.="<div class='content navbar-default'>";
						$y.="<div class='container-fluid'>";
							$y.="<div class='sidebar sidenav' id='navx'>";

								$nombre=$_SESSION['nombre']." ".$_SESSION['ape_pat']." ".$_SESSION['ape_mat'];
								$y.="<div class='text-center'> ";
									$y.=$_SESSION['filiacion']."<br>";
									$y.=$nombre;
								$y.="</div>";

								if($_SESSION['administrador']==1){
									$y.="<hr>";
									$y.="<a href='#afiliado/afiliado' class='activeside'><i class='fas fa-home'></i> <span>Inicio</span></a>";
									$y.="<a href='#admin/bloques' title='Bloques'><i class='far fa-check-square'></i><span>Actualizar</span></a>";
									$y.="<a href='#admin/blog' title='Bloques'><i class='fas fa-rss-square'></i><span>Pizarrón</span></a>";
								}
								else{
									$y.="<hr>";
									$y.="<a href='#afiliado/afiliado' class='activeside'><i class='fas fa-home'></i> <span>Inicio</span></a>";
									$y.="<a href='#afiliado/datos' title='Datos'><i class='fas fa-users-cog'></i> <span>Datos</span></a>";				/////////////// listo
									$y.="<a href='#aportacion/aportacion' title='Aportación'><i class='fas fa-users-cog'></i> <span>Aportación</span></a>";				/////////////// listo
									$y.="<a href='#beneficiarios/beneficiarios' title='Beneficiarios'><i class='fas fa-users-cog'></i> <span>Beneficiarios</span></a>";				/////////////// listo
									$y.="<hr>";

									$y.="<a href='#creditos/credito' title='Creditos'><i class='fas fa-money-check-alt'></i><span>Creditos</span></a>";
									$y.="<a href='#ahorro/ahorro' title='Ahorro'><i class='fas fa-university'></i> <span>Ahorro</span></a>";			////////////// Listo
									$y.="<hr>";

									$y.="<a href='#afiliado/acceso' title='Acceso'><i class='fas fa-at'></i> <span>Acceso</span></a>";			////////////// Listo
									$y.="<a href='#afiliado/pass' title='Contraseña'><i class='fas fa-key'></i> <span>Contraseña</span></a>";			////////////// Listo
								}
							$y.="</div>";
						$y.="</div>";

						$y.="<div class='fijaproceso main' id='contenido'>";
						$y.="</div>";
					$y.="</div>";
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
								<button class='btn btn-outline-info btn-block' type='button' onclick='recuperar()'><i class='fas fa-key'></i>Recuperar contraseña</button>
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
			$passPOST = htmlspecialchars($_REQUEST["passAcceso"]);

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

					$_SESSION['administrador']=0;
					$_SESSION['hasta']=date("Y");
					$_SESSION['foco']=mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));

					$arr=array();
					$arr=array('acceso'=>1,'idpersona'=>$_SESSION['idfolio']);
					return json_encode($arr);
				}
			}
			else {
				$sql="select * from usuarios where NOMBRE=:usuario and CLAVE_ACC=:pass";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":usuario",$userPOST);
				$sth->bindValue(":pass",$passPOST);
				$sth->execute();
				$datos=$sth->fetch();
				if(is_array($datos)){
					$userBD = trim($datos['NOMBRE']);
					$passwordBD = trim($datos['CLAVE_ACC']);
					if($userPOST == $userBD and $passPOST==$passwordBD){
						$_SESSION['autoriza']=1;
						$_SESSION['filiacion']=$datos['RFC'];
						$_SESSION['nombre']=$datos['NOMBRE'];
						$_SESSION['idfolio']=$datos['CLV_PER'];
						$_SESSION['ape_pat']="";
						$_SESSION['ape_mat']="";

						$_SESSION['administrador']=1;
						$_SESSION['hasta']=date("Y");
						$_SESSION['foco']=mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));

						$arr=array();
						$arr=array('acceso'=>1,'idpersona'=>0);
						return json_encode($arr);
					}
				}
				else{
					$arr=array();
					$arr=array('acceso'=>0,'idpersona'=>0);
					return json_encode($arr);
				}
			}
		}

		public function recuperar_form(){
			$x="<form id='recuperarx' action=''>
				<div class='container'>
						<center><img src='img/caja.png' width='150px'></center>
						<br><center><h5>Recuperar contraseña</h5></center>
						<hr>
						<p class='input_title'><center>Correo electrónico o Número telefónico registrado</center></p>
						<div class='form-group input-group'>
							<div class='input-group-prepend'>
								<span class='input-group-text'> <i class='fa fa-lock'></i> </span>
							</div>
							<input class='form-control' placeholder='Correo o telefono' type='text'  id='telefono' name='telefono' required>
						</div>

						<button class='btn btn-warning btn-block' type='submit' ><i class='fas fa-share-square'></i>Recuperar</button>
						<button class='btn btn-outline-info btn-block' type='button' onclick='acceso()'><i class='fas fa-long-arrow-alt-left'></i>Regresar</button>

						<center>http://sagyc.com.mx</center>
				</div>
			</form>";
			return $x;
		}
		public function manda_pass(){
			require 'librerias15/PHPMailer-5.2-stable/PHPMailerAutoload.php';
			$telefono = $_REQUEST["telefono"];

			$sql="select * from afiliados where correo='$telefono' or celular='$telefono'";
			$rx=$this->general($sql,1);

			$fecha=date("Y-m-d H:i:s");
			if(count($rx)>0){
				$correo=$rx[0]['correo'];
				$pass=$rx[0]['password'];
				$filiacion=$rx[0]['Filiacion'];
				$tipo=2;

				if (filter_var(trim($correo), FILTER_VALIDATE_EMAIL) and trim($correo)==trim($telefono)) {
					$mail = new PHPMailer();
					$mail->CharSet = 'UTF-8';
					$mail->IsSMTP();
					$mail->SMTPAuth = true;
					$mail->SMTPSecure = "ssl";
					$mail->Host = "cs8.webhostbox.net";
					$mail->Port = 465;
					$mail->Username = "no_reply@snte.sagyc.com.mx";
					$mail->Password = "1234567890";

					$mail->From = "no_reply@snte.sagyc.com.mx";
					$mail->FromName = "SNTE";
					$mail->Subject = "SNTE";
					$mail->AltBody = "AVISO";

					$t="<br>Sistema de Credito y caja de ahorro<br>";
					$t.="la contraseña es: <b>".$pass."</b>";

					$mail->MsgHTML($t);

					$mail->AddAddress("$correo");
					$mail->AddAttachment("img/caja.png");

					$mail->IsHTML(true);
					if(!$mail->Send()) {
						echo $mail->ErrorInfo;
					} else {

					}
					$tipo="R:$telefono";
					$sql="insert into abitacora (acceso, fecha, tipo,enviado) values ('$filiacion','$fecha','$tipo','1') ";
					$rx=$this->general($sql,1);
				}
				else{
					$numero=$rx[0]['celular'];
					$t=trim($rx[0]['password']);
					$filiacion=$rx[0]['Filiacion'];
					$tipo=2;

					if ($numero==$telefono){
						//////////////esto es lo nuevo

						$telefono="+52".$telefono;
						$texto="SNTE La clave es: $t";
						$user='sagyc';
						$pass = 'sagyc123';
						$url="http://usa.bulksms.com/eapi/submission/send_sms/2/2.0?username=".$user."&password=".$pass."&message=".urlencode($texto)."&msisdn=".$telefono;

						$curl = curl_init();
						curl_setopt($curl, CURLOPT_URL, $url);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl, CURLOPT_HEADER, false);
						$str = curl_exec($curl);
						curl_close($curl);

						///////////hasta aqui se envia.. comienza la comprobación.
						list($status,$descripcion,$batch)=explode("|",$str);

						$url="http://usa.bulksms.com/eapi/reception/get_inbox/1/1.1?username=".$user."&password=".$pass."&last_retrieved_id=".$batch;
						$curl = curl_init();
						curl_setopt($curl, CURLOPT_URL, $url);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl, CURLOPT_HEADER, false);
						$str = curl_exec($curl);
						curl_close($curl);

					}
				}
			}
			else{
				return "No registrado";
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
		public function general($sql,$tipo=1){
			try{
				self::set_names();
				$sth = $this->dbh->prepare($sql);
				$sth->execute();
				if($tipo==1){
					return $sth->fetchAll();
				}
				else{
					return $sth->fetch();
				}
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
		public function credito_detalle($clv_cred){
			try{
				self::set_names();
				$sql="select anio,if (estado=1,'A',if(estado=6,'Inicial',if(estado=7,'Reim',ROUND(quincena,0)))) as quin_nombre,saldo_anterior,monto,saldo_actual, observaciones from detallepago where idcredito=:clv_cred order by anio,quincena,iddetalle";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":clv_cred",$clv_cred);
				$sth->execute();
				return $sth->fetchAll();
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

		public function datos_ahorro($anio_tmp){
			try{
				self::set_names();
				$sql="select idfolio,anio,ahorrototal,saldofinal,saldo_anterior,monto,interes,montointeres,interestotal,
				if (retiro=1,'R',ROUND(quincena,0)) as quin_nombre,observaciones from registro where idfolio=:idfolio and anio=:anio_tmp
				order by anio,quincena,idregistro asc";
				$sth = $this->dbh->prepare($sql);

				$sth->bindValue(":idfolio",$_SESSION['idfolio']);
				$sth->bindValue(":anio_tmp",$anio_tmp);
				$sth->execute();
				return $sth->fetchAll();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
		}
		public function ahorro($anio_tmp){
			try{
				self::set_names();

				$sql="select sum(monto) as monto,sum(montointeres) as interesx from registro where idfolio=:idfolio and anio=:anio_tmp";
				$sth = $this->dbh->prepare($sql);

				$sth->bindValue(":idfolio",$_SESSION['idfolio']);
				$sth->bindValue(":anio_tmp",$anio_tmp);
				$sth->execute();
				return $sth->fetch();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
		}
		public function anio_ant_interes($anio_tmp){
			try{
				self::set_names();
				$ANIX=$anio_tmp-1;

				$sql="select SUM(montointeres) as interestotal from registro where idfolio=:idfolio and anio=:anio_tmp order by anio,quincena";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":idfolio",$_SESSION['idfolio']);
				$sth->bindValue(":anio_tmp",$ANIX);
				$sth->execute();
				return $sth->fetch();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
		}
		public function xahorro_anterior($anio_tmp){
			try{
				self::set_names();
				$sql="select * from registro where idfolio=:idfolio and anio<:anio_tmp order by anio desc,quincena desc";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":idfolio",$_SESSION['idfolio']);
				$sth->bindValue(":anio_tmp",$anio_tmp);
				$sth->execute();
				return $sth->fetch();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
		}
		public function ahorro_tmp($anio_tmp){
			try{
				self::set_names();
				$sql="select sum(monto) as monto from registro where idfolio=:idfolio and anio=:anio_tmp and monto>=0";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":idfolio",$_SESSION['idfolio']);
				$sth->bindValue(":anio_tmp",$anio_tmp);
				$sth->execute();
				return $sth->fetch();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
		}
		public function retiro_tmp($anio_tmp){
			try{
				self::set_names();
				$sql="select sum(monto) as montoxy from registro where idfolio=:idfolio and anio=:anio_tmp and registro.monto<0";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":idfolio",$_SESSION['idfolio']);
				$sth->bindValue(":anio_tmp",$anio_tmp);
				$sth->execute();
				return $sth->fetch();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
		}
		public function ahorro_anual($anio_tmp){
			try{
				self::set_names();
				$sql="select sum(monto) as ahorroanual from registro where idfolio=:idfolio and anio=:anio_tmp and registro.monto>0";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":idfolio",$_SESSION['idfolio']);
				$sth->bindValue(":anio_tmp",$anio_tmp);
				$sth->execute();
				return $sth->fetch();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
		}
		public function saldofinal($anio_tmp){
			try{
				self::set_names();
				$sql="select idfolio,anio,ahorrototal,saldofinal,saldo_anterior,monto,interes,montointeres,interestotal,if (retiro=1,'R',ROUND(quincena,0)) as quin_nombre,observaciones from registro where idfolio=:idfolio order by anio desc,quincena desc,idregistro desc";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":idfolio",$_SESSION['idfolio']);
				$sth->execute();
				return $sth->fetch();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
		}

		public function guardar_datos(){
			$x="";
			$arreglo =array();

			$x="";
			$arreglo =array();
			if (isset($_REQUEST['d_dom']) and strlen($_REQUEST['d_dom'])>0){
				$arreglo+=array('d_dom'=>$_REQUEST['d_dom']);
			}
			else{
				$arreglo+=array('d_dom'=>NULL);
			}
			if (isset($_REQUEST['e_civ']) and strlen($_REQUEST['e_civ'])>0){
				$arreglo+=array('e_civ'=>$_REQUEST['e_civ']);
			}
			else{
				$arreglo+=array('e_civ'=>NULL);
			}
			if (isset($_REQUEST['n_con']) and strlen($_REQUEST['n_con'])>0){
				$arreglo+=array('n_con'=>$_REQUEST['n_con']);
			}
			else{
				$arreglo+=array('n_con'=>NULL);
			}
			if (isset($_REQUEST['l_loc']) and strlen($_REQUEST['l_loc'])>0){
				$arreglo+=array('l_loc'=>$_REQUEST['l_loc']);
			}
			else{
				$arreglo+=array('l_loc'=>NULL);
			}
			if (isset($_REQUEST['m_mun']) and strlen($_REQUEST['m_mun'])>0){
				$arreglo+=array('m_mun'=>$_REQUEST['m_mun']);
			}
			else{
				$arreglo+=array('m_mun'=>NULL);
			}
			if (isset($_REQUEST['c_c_t']) and strlen($_REQUEST['c_c_t'])>0){
				$arreglo+=array('c_c_t'=>$_REQUEST['c_c_t']);
			}
			else{
				$arreglo+=array('c_c_t'=>NULL);
			}
			if (isset($_REQUEST['u_bic']) and strlen($_REQUEST['u_bic'])>0){
				$arreglo+=array('u_bic'=>$_REQUEST['u_bic']);
			}
			else{
				$arreglo+=array('u_bic'=>NULL);
			}
			if (isset($_REQUEST['d_sin']) and strlen($_REQUEST['d_sin'])>0){
				$arreglo+=array('d_sin'=>$_REQUEST['d_sin']);
			}
			else{
				$arreglo+=array('d_sin'=>NULL);
			}
			if (isset($_REQUEST['r_rrg']) and strlen($_REQUEST['r_rrg'])>0){
				$arreglo+=array('r_rrg'=>$_REQUEST['r_rrg']);
			}
			else{
				$arreglo+=array('r_rrg'=>NULL);
			}
			if (isset($_REQUEST['c_psp']) and strlen($_REQUEST['c_psp'])>0){
				$arreglo+=array('c_psp'=>$_REQUEST['c_psp']);
			}
			else{
				$arreglo+=array('c_psp'=>NULL);
			}
			////////////////////////////////////////aca
			$sql="select * from bit_datos where idfolio=:idfolio and estado=0";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idfolio",$_SESSION['idfolio']);
			$sth->execute();
			$row=$sth->fetch();
			$contar=$sth->rowCount();

			$fecha=date("Y-m-d H:i:s");
			$arreglo+=array('fecha'=>$fecha);

			if($contar==1){
				$this->update('bit_datos',array('id'=>$row['id']), $arreglo);
			}
			else{
				$arreglo+=array('estado'=>0);
				$arreglo+=array('idfolio'=>$_SESSION['idfolio']);
				$arreglo+=array('nombre'=>$_SESSION['nombre']);
				$arreglo+=array('ape_pat'=>$_SESSION['ape_pat']);
				$arreglo+=array('ape_mat'=>$_SESSION['ape_mat']);
				$this->insert('bit_datos', $arreglo);
			}
			////////////////////////////
			return $x;
		}
		public function guardar_acceso(){
			$x="";
			$arreglo =array();
			if (isset($_REQUEST['correo'])){
				$arreglo+=array('correo'=>$_REQUEST['correo']);
			}
			if (isset($_REQUEST['telefono'])){
				$arreglo+=array('celular'=>$_REQUEST['telefono']);
			}
			$x=$this->update('afiliados',array('idfolio'=>$_SESSION['idfolio']), $arreglo);


			////////////////////////////////////////aca
			$sql="select * from bit_datos where idfolio=:idfolio and estado=0";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idfolio",$_SESSION['idfolio']);
			$sth->execute();
			$row=$sth->fetch();
			$contar=$sth->rowCount();

			$fecha=date("Y-m-d H:i:s");
			$arreglo+=array('fecha'=>$fecha);

			if($contar==1){
				$this->update('bit_datos',array('id'=>$row['id']), $arreglo);
			}
			else{
				$arreglo+=array('estado'=>0);
				$arreglo+=array('idfolio'=>$_SESSION['idfolio']);
				$arreglo+=array('nombre'=>$_SESSION['nombre']);
				$arreglo+=array('ape_pat'=>$_SESSION['ape_pat']);
				$arreglo+=array('ape_mat'=>$_SESSION['ape_mat']);
				$x=$this->insert('bit_datos', $arreglo);
			}
			return $x;
		}
		public function guardar_pass(){
			$x="";
			$arreglo =array();
			if(trim($_REQUEST['pass1'])==trim($_REQUEST['pass2'])){
				$arreglo+=array('password'=>trim($_REQUEST['pass1']));
				$x=$this->update('afiliados',array('idfolio'=>$_SESSION['idfolio']), $arreglo);

				////////////////////////////////////////aca
				$sql="select * from bit_datos where idfolio=:idfolio and estado=0";
				$sth = $this->dbh->prepare($sql);
				$sth->bindValue(":idfolio",$_SESSION['idfolio']);
				$sth->execute();
				$row=$sth->fetch();
				$contar=$sth->rowCount();

				$fecha=date("Y-m-d H:i:s");
				$arreglo+=array('fecha'=>$fecha);

				if($contar==1){
					$this->update('bit_datos',array('id'=>$row['id']), $arreglo);
				}
				else{
					$arreglo+=array('estado'=>0);
					$arreglo+=array('idfolio'=>$_SESSION['idfolio']);
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
		public function guardar_aportacion(){
			$arreglo =array();

			$sql="select * from bit_datos where idfolio=:idfolio and estado=0";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idfolio",$_SESSION['idfolio']);
			$sth->execute();
			$row=$sth->fetch();
			$contar=$sth->rowCount();

			$arreglo=array();
			if (isset($_REQUEST['a_qui'])){
				$arreglo+=array('aportacion'=>$_REQUEST['a_qui']);
			}

			$fecha=date("Y-m-d H:i:s");
			$arreglo+=array('fecha'=>$fecha);

			if($contar==1){
				$this->update('bit_datos',array('id'=>$row['id']), $arreglo);
			}
			else{
				$arreglo+=array('estado'=>0);
				$arreglo+=array('idfolio'=>$_SESSION['idfolio']);
				$arreglo+=array('nombre'=>$_SESSION['nombre']);
				$arreglo+=array('ape_pat'=>$_SESSION['ape_pat']);
				$arreglo+=array('ape_mat'=>$_SESSION['ape_mat']);
				$x=$this->insert('bit_datos', $arreglo);
			}
			return $_SESSION['idfolio'];
		}
		public function guardar_beneficiarios(){
			$x="";
			$arreglo =array();
			/////BEN1
			if (isset($_REQUEST['ben1'])){
				$arreglo+=array('BA'=>$_REQUEST['ben1']);
			}
			if (isset($_REQUEST['parentesco1'])){
				$arreglo+=array('PA'=>$_REQUEST['parentesco1']);
			}
			if (isset($_REQUEST['porcentaje1'])){
				$arreglo+=array('BFA'=>$_REQUEST['porcentaje1']);
			}

			/////BEN 2
			if (isset($_REQUEST['ben2'])){
				$arreglo+=array('BB'=>$_REQUEST['ben2']);
			}
			if (isset($_REQUEST['parentesco2'])){
				$arreglo+=array('PB'=>$_REQUEST['parentesco2']);
			}
			if (isset($_REQUEST['porcentaje2'])){
				$arreglo+=array('BFB'=>$_REQUEST['porcentaje2']);
			}

			/////BEN 3
			if (isset($_REQUEST['ben3'])){
				$arreglo+=array('BC'=>$_REQUEST['ben3']);
			}
			if (isset($_REQUEST['parentesco3'])){
				$arreglo+=array('PC'=>$_REQUEST['parentesco3']);
			}
			if (isset($_REQUEST['porcentaje3'])){
				$arreglo+=array('BFC'=>$_REQUEST['porcentaje3']);
			}

			/////BEN 4
			if (isset($_REQUEST['ben3'])){
				$arreglo+=array('BD'=>$_REQUEST['ben3']);
			}
			if (isset($_REQUEST['parentesco3'])){
				$arreglo+=array('PD'=>$_REQUEST['parentesco3']);
			}
			if (isset($_REQUEST['porcentaje3'])){
				$arreglo+=array('BFD'=>$_REQUEST['porcentaje3']);
			}

			/////BEN 5
			if (isset($_REQUEST['ben5'])){
				$arreglo+=array('BE'=>$_REQUEST['ben5']);
			}
			if (isset($_REQUEST['parentesco5'])){
				$arreglo+=array('PE'=>$_REQUEST['parentesco5']);
			}
			if (isset($_REQUEST['porcentaje5'])){
				$arreglo+=array('BFE'=>$_REQUEST['porcentaje5']);
			}

			////////////////////////////////////////aca
			$sql="select * from bit_datos where idfolio=:idfolio and estado=0";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idfolio",$_SESSION['idfolio']);
			$sth->execute();
			$row=$sth->fetch();
			$contar=$sth->rowCount();

			$fecha=date("Y-m-d H:i:s");
			$arreglo+=array('fecha'=>$fecha);

			if($contar==1){
				$this->update('bit_datos',array('id'=>$row['id']), $arreglo);
			}
			else{
				$arreglo+=array('estado'=>0);
				$arreglo+=array('idfolio'=>$_SESSION['idfolio']);
				$arreglo+=array('nombre'=>$_SESSION['nombre']);
				$arreglo+=array('ape_pat'=>$_SESSION['ape_pat']);
				$arreglo+=array('ape_mat'=>$_SESSION['ape_mat']);
				$this->insert('bit_datos', $arreglo);
			}
			////////////////////////////
			return $x;
		}

		public function bloques(){
			self::set_names();
			$x="";
			$arreglo =array();

			if (isset($_REQUEST['usuario'])){
				$arreglo+=array('usuario'=>$_REQUEST['usuario']);
			}
			else{
				$arreglo+=array('usuario'=>0);
			}
			if (isset($_REQUEST['aportacion'])){
				$arreglo+=array('aportacion'=>$_REQUEST['aportacion']);
			}
			else{
				$arreglo+=array('aportacion'=>0);
			}
			if (isset($_REQUEST['beneficiarios'])){
				$arreglo+=array('beneficiarios'=>$_REQUEST['beneficiarios']);
			}
			else{
				$arreglo+=array('beneficiarios'=>0);
			}

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
		public function blo_lista(){
			try{
				self::set_names();
				$sql="select * from bit_bloques limit 1";
				$sth = $this->dbh->prepare($sql);
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
		public function blog_noticia(){
			try{
				self::set_names();
				$sql="select * from bit_blog where noticia=1";
				$sth = $this->dbh->prepare($sql);
				$sth->execute();
				return $sth->fetchAll();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
		}
		public function blog_alerta(){
			try{
				self::set_names();
				$sql="select * from bit_blog where alerta=1";
				$sth = $this->dbh->prepare($sql);
				$sth->execute();
				return $sth->fetchAll();
			}
			catch(PDOException $e){
				return "Database access FAILED! ".$e->getMessage();
			}
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
				$x.=$this->insert('bit_blog', $arreglo);
			}
			else{
				$x.=$this->update('bit_blog',array('id'=>$id), $arreglo);
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

		public function subir_file(){
			$contarx=0;
			$arr=array();

			foreach ($_FILES as $key){
				$extension = pathinfo($key['name'], PATHINFO_EXTENSION);
				$n = $key['name'];
				$s = $key['size'];
				$string = trim($n);
				$string = str_replace( $extension,"", $string);
				$string = str_replace( array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'), array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'), $string );
				$string = str_replace( array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'), array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'), $string );
				$string = str_replace( array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'), array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'), $string );
				$string = str_replace( array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'), array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'), $string );
				$string = str_replace( array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'), array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'), $string );
				$string = str_replace( array('ñ', 'Ñ', 'ç', 'Ç'), array('n', 'N', 'c', 'C',), $string );
				$string = str_replace( array(' '), array('_'), $string);
				$string = str_replace(array("\\","¨","º","-","~","#","@","|","!","\"","·","$","%","&","/","(",")","?","'","¡","¿","[","^","`","]","+","}","{","¨","´",">","<",";",",",":","."),'', $string );
				$string.=".".$extension;
				$n_nombre=date("YmdHis")."_".$contarx."_".rand(1,1983).".".$extension;
				$destino="historial/".$n_nombre;

				if(move_uploaded_file($key['tmp_name'],$destino)){
					chmod($destino,0666);
					$arr[$contarx] = array("archivo" => $n_nombre);
				}
				else{

				}
				$contarx++;
			}
			$myJSON = json_encode($arr);
			return $myJSON;
		}
		public function guardar_file(){
			$arreglo =array();
			$x="";
			if (isset($_REQUEST['id'])){$id=$_REQUEST['id'];}
			if (isset($_REQUEST['ruta'])){$ruta=$_REQUEST['ruta'];}
			if (isset($_REQUEST['tipo'])){$tipo=$_REQUEST['tipo'];}
			if (isset($_REQUEST['ext'])){$ext=$_REQUEST['ext'];}
			if (isset($_REQUEST['tabla'])){$tabla=$_REQUEST['tabla'];}
			if (isset($_REQUEST['campo'])){$campo=$_REQUEST['campo'];}
			if (isset($_REQUEST['direccion'])){$direccion=$_REQUEST['direccion'];}
			if (isset($_REQUEST['keyt'])){$keyt=$_REQUEST['keyt'];}
			if($tipo==1){	//////////////update
				$arreglo+=array($campo=>$direccion);
				$x=$this->update($tabla,array($keyt=>$id), $arreglo);
				rename("historial/$direccion", "$ruta/$direccion");
			}
			else{
				$arreglo+=array($campo=>$direccion);
				$arreglo+=array($keyt=>$id);
				$x=$this->insert($tabla, $arreglo);
				rename("historial/$direccion", "$ruta/$direccion");
			}
			return $x;
		}
		public function eliminar_file(){
			$arreglo =array();
			$x="";
			if (isset($_REQUEST['ruta'])){$ruta=$_REQUEST['ruta'];}
			if (isset($_REQUEST['key'])){$key=$_REQUEST['key'];}
			if (isset($_REQUEST['keyt'])){$keyt=$_REQUEST['keyt'];}
			if (isset($_REQUEST['tabla'])){$tabla=$_REQUEST['tabla'];}
			if (isset($_REQUEST['campo'])){$campo=$_REQUEST['campo'];}
			if (isset($_REQUEST['tipo'])){$tipo=$_REQUEST['tipo'];}
			if (isset($_REQUEST['borrafile'])){$borrafile=$_REQUEST['borrafile'];}

			if($borrafile==1){
				if ( file_exists($_REQUEST['ruta']) ) {
					unlink($_REQUEST['ruta']);
				}
				else{
				}
			}
			if($tipo==1){ ////////////////actualizar tabla
				$arreglo+=array($campo=>"");
				$x.=$this->update($tabla,array($keyt=>$key), $arreglo);
			}
			if($tipo==2){
				$x.=$this->borrar($tabla,$keyt,$key);
			}
			return "$x";
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

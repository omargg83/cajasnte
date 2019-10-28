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

								}
								else{
									$y.="<hr>";
									$y.="<a href='#afiliado/afiliado' class='activeside'><i class='fas fa-home'></i> <span>Inicio</span></a>";
									$y.="<a href='#afiliado/datos' title='Datos'><i class='fas fa-users-cog'></i> <span>Datos</span></a>";				/////////////// listo
									$y.="<a href='#afiliado/datos' title='Aportación'><i class='fas fa-users-cog'></i> <span>Aportación</span></a>";				/////////////// listo
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
			if (isset($_REQUEST['numero'])){
				$arreglo+=array('numero'=>$_REQUEST['numero']);
			}

			if (isset($_REQUEST['frecibido'])){
				$fx=explode("-",$_REQUEST['frecibido']);
				$arreglo+=array('frecibido'=>$fx['2']."-".$fx['1']."-".$fx['0']);
			}

			$arreglo+=array('modificado'=>date("Y-m-d H:i:s"));

			//$x.=$this->update('afiliados',array('idfolio'=>$_SESSION['idfolio']), $arreglo);
			//return $x;
			return "Guardando";
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
			return $x;
		}
		public function guardar_pass(){
			$x="";
			$arreglo =array();
			if(trim($_REQUEST['pass1'])==trim($_REQUEST['pass2'])){
				$arreglo+=array('password'=>trim($_REQUEST['pass1']));
				$x=$this->update('afiliados',array('idfolio'=>$_SESSION['idfolio']), $arreglo);
				return $x;
			}
			else{
				return "No coinciden contraseñas";
			}
		}

		public function guardar_beneficiarios(){
			$x="";
			$arreglo =array();
			/*aqui agregar todos los campos necesarios aguas con los nombres*/
			if (isset($_REQUEST['bene1'])){
				$arreglo+=array('bene1'=>$_REQUEST['bene1']);
			}
			if (isset($_REQUEST['par1'])){
				$arreglo+=array('par1'=>$_REQUEST['par1']);
			}
			if (isset($_REQUEST['porcentaje1'])){
				$arreglo+=array('porcentaje1'=>$_REQUEST['porcentaje1']);
			}

			$x.=$this->update('afiliados',array('idfolio'=>$_SESSION['idfolio']), $arreglo);
			return $x;
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

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
			try{
				$this->Salud = array();
				date_default_timezone_set("America/Mexico_City");
				$_SESSION['mysqluser']="sagyce18_sagyc";
				$_SESSION['mysqlpass']="sagyc123$";
				$_SESSION['servidor'] ="sagyc2.com.mx";
				$_SESSION['bdd']="sagyce18_caja";
				$this->dbh = new PDO("mysql:host=".$_SESSION['servidor'].";dbname=".$_SESSION['bdd']."", $_SESSION['mysqluser'], $_SESSION['mysqlpass']);
			}
			catch(PDOException $e){
				return "Database access FAILED!";
			}
		}
		public function set_names(){
			return $this->dbh->query("SET NAMES 'utf8'");
		}
		public function login(){
			$arreglo=array();
			if(isset($_SESSION['idfolio']) and $_SESSION['autoriza'] == 1) {
				$arreglo=array('sess'=>"abierta", 'admin'=>"");
			}
			else {
				$valor="fondo/fondo5.jpg";
				$arreglo=array('sess'=>"cerrada", 'fondo'=>$valor);
			}
			return json_encode($arreglo);
		}
		public function acceso(){
			$userPOST = htmlspecialchars(trim($_REQUEST["userAcceso"]));
			$passPOST = htmlspecialchars(trim($_REQUEST["passAcceso"]));

			self::set_names();
			$sql="select idfolio, Filiacion, password, nombre, ape_pat, ape_mat from afiliados where Filiacion=:usuario and password=:pass";
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":usuario",$userPOST);
			$sth->bindValue(":pass",$passPOST);
			$sth->execute();
			$datos=$sth->fetch();

			if(is_array($datos)){
				$userBD = trim($datos['Filiacion']);
				$passwordBD = trim($datos['password']);

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
		public function ses(){
			if(isset($_SESSION['idfolio']) and isset($_SESSION['idfolio']) and (strlen($_SESSION['llave'])>0)){
				$arr=array();
				$arr=array('sess'=>"abierta");
				return json_encode($arr);
			}
			else{
				$arr=array();
				$arr=array('sess'=>"cerrada");
				return json_encode($arr);
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
			$_SESSION['idfolio']="";
			session_destroy();
		}

		public function insert($DbTableName, $values = array()){
			$arreglo=array();
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
				if ($sth->execute()){
					$arreglo+=array('id'=>$this->lastId = $this->dbh->lastInsertId());
					$arreglo+=array('error'=>0);
					$arreglo+=array('terror'=>'');
					$arreglo+=array('param1'=>'');
					$arreglo+=array('param2'=>'');
					$arreglo+=array('param3'=>'');
					return json_encode($arreglo);
				}
			}
			catch(PDOException $e){
				$arreglo+=array('id'=>0);
				$arreglo+=array('error'=>1);
				$arreglo+=array('terror'=>$e->getMessage());
				return json_encode($arreglo);
			}
		}
		public function update($DbTableName, $id = array(), $values = array()){
			$arreglo=array();
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
					$arreglo+=array('id'=>$idx);
					$arreglo+=array('error'=>0);
					$arreglo+=array('terror'=>'');
					$arreglo+=array('param1'=>'');
					$arreglo+=array('param2'=>'');
					$arreglo+=array('param3'=>'');
					return json_encode($arreglo);
				}
			}
			catch(PDOException $e){
				$arreglo+=array('id'=>0);
				$arreglo+=array('error'=>1);
				$arreglo+=array('terror'=>$e->getMessage());
				return json_encode($arreglo);
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
		public function cambios($tipo,$idfolio){
			if($tipo==1){					///////////////////////Contraseña
				$sql="select * from bit_datos where idfolio=:idfolio and up_pass=1";
			}
			if($tipo==2){					///////////////////////Correo
				$sql="select * from bit_datos where idfolio=:idfolio and up_correo=1";
			}
			if($tipo==3){					///////////////////////datos
				$sql="select * from bit_datos where idfolio=:idfolio and up_datos=1";
			}
			if($tipo==4){					///////////////////////aportacion
				$sql="select * from bit_datos where idfolio=:idfolio and up_aportacion=1";
			}
			if($tipo==5){					///////////////////////beneficiarios
				$sql="select * from bit_datos where idfolio=:idfolio and up_bene=1";
			}
			$sth = $this->dbh->prepare($sql);
			$sth->bindValue(":idfolio",$idfolio);
			$sth->execute();
			return $sth->fetch();
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

	if(strlen($ctrl)>0){
		$db = new Sagyc();
		if(strlen($function)>0){
			echo $db->$function();
		}
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
			if($key==3){
				return $fecha->format('d-m-Y H:i:s');
			}
			else{
				return $fecha->format('d-m-Y');
			}
		}
?>

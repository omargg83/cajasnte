<?php
	//Conectamos a la base de datos
	include '../conn.php';
	
	$tipo = $_POST["tipo"]; 
	if($tipo==1){
		//Obtenemos los datos del formulario de acceso
		$userPOST = $_POST["userAcceso"]; 
		$passPOST = $_POST["passAcceso"];

		//Filtro anti-XSS
		$userPOST = htmlspecialchars(mysqli_real_escape_string($link, $userPOST));
		$passPOST = htmlspecialchars(mysqli_real_escape_string($link, $passPOST));
		
		//Escribimos la consulta necesaria
		$sql="select * from afiliados where Filiacion='$userPOST' and password='$passPOST'";
		
		//Obtenemos los resultados
		$resultado = mysqli_query($link, $sql);
		$datos = mysqli_fetch_array($resultado);
		
		//Guardamos los resultados del nombre de usuario en minúsculas
		//y de la contraseña de la base de datos
		$userBD = $datos['Filiacion'];
		$passwordBD = $datos['password'];
			
		//Comprobamos si los datos son correctos
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
		} else {
			echo "Usuario o Contraseña incorecta";
		}
	}
	if($tipo==2){
		$telefono = $_POST["telefono"]; 
		
		require '../librerias/gmail/PHPMailerAutoload.php';
		
		$sql="select * from afiliados where correo='$telefono' or celular='$telefono'";
		$fecha=date("Y-m-d H:i:s");
		$consulta=mysqli_query($link,$sql);
		$num_rows=mysqli_num_rows($consulta);
		$rx=mysqli_fetch_array($consulta);
		if ($num_rows>0){
			
			
			if (filter_var(trim($telefono), FILTER_VALIDATE_EMAIL) and trim($rx['correo'])==trim($telefono)) {
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
				$t.="la contraseña es: <b>".$rx['password']."</b>";
				
				$mail->MsgHTML($t);
				
				$mail->AddAddress("$telefono");			
				$mail->AddAttachment("logo_completo.jpg");
				
				$mail->IsHTML(true);
				if(!$mail->Send()) {
					echo $mail->ErrorInfo;
				} else {
					
				}
				$tipo="R:$telefono";
				$row = mysqli_query($link,"insert into abitacora (acceso, fecha, tipo,enviado) values ('".$rx['Filiacion']."','$fecha','$tipo','1') ");
			}
			else{			
				$numero=trim($rx['celular']);
				if ($numero==$telefono){
					$t=trim($rx['password']);
					
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
					
					
					list($status,$descripcion,$batch)=explode("|",$str);
					if($status==0){
						$sql="insert into abitacora (acceso, fecha, tipo,numero, enviado, texto) values ('".$rx['Filiacion']."','$fecha','$tipo','$numero','3', '$t') ";
						if(mysqli_query($link,$sql)){
							
						}						
					}
					else{
						////////////se trata de enviar por la appop
						$sql="insert into abitacora (acceso, fecha, tipo,numero, enviado, texto) values ('".$rx['Filiacion']."','$fecha','$tipo','$numero','0', '$t') ";
						if(mysqli_query($link,$sql)){
							
						}
					}
				}
			}
		}
		else{
			echo "No registrado";
		}
		
		
	}
?>

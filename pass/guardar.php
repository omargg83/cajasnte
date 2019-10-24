<?php
	//Conectamos a la base de datos
	include '../conn.php';
	
	//Obtenemos los datos del formulario de acceso
	$tipo = $_POST["tipo"]; 
	
	if($tipo=="password"){
		$pass1 = $_POST["pass1"]; 
		$pass2 = $_POST["pass2"];
		$sql="update afiliados set password='$pass1' where idfolio='".$_SESSION['idfolio']."'";
	}
	if($tipo=="correo"){		
		$correo = $_POST["correo"]; 
		$telefono = $_POST["telefono"];
		$sql="update afiliados set correo='$correo', celular='$telefono' where idfolio='".$_SESSION['idfolio']."'";
	}
	
	if(mysqli_query($link,$sql)){
		echo 1;
	}
	else{
		echo mysqli_error($link);
	}
?>
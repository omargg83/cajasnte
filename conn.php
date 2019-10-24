<?php
	session_start();

	$hostname = "sagyc2.com.mx";
	$username = "sagyce18_sagyc";
	$password = "sagyc123$";
	$database = "sagyce18_caja";
	 
	$link = mysqli_connect("$hostname","$username","$password", "$database");
	date_default_timezone_set('America/Chicago'); 
	if (mysqli_connect_errno($link)) {
		header('Location: index.php');
	    //echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
	}
?>

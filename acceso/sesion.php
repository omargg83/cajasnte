<?php
	session_start();
	
	if(!isset($_SESSION['user']) and $_SESSION['estado'] != 'Autenticado') {
		//header('Location: index.php');
		
	} 
	else {
		
	}
?>
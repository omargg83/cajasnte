<?php 
	include 'conn.php';
	
	if(!isset($_SESSION['autoriza'])){
		include('login.php');
        die();
	}
	
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>SNTE</title>

	 <!-- Animation library for notifications   -->
    <link href="librerias/animate.min.css" rel="stylesheet"/>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="librerias/modulos.css"/>
	
	<!--     Fonts and icons     -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="assets/css/sweetalert.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	
	<link rel="stylesheet" href="librerias/load/dist/css-loader.css">
</head>
<body>
	<nav class="navbar navbar-expand-sm navbar-light bg-light fixed-top barra">
	<div class='container'>
	  <a class="navbar-brand home" href="#"><img src='img/caja.png' width='20px'> Caja de Ahorro y Crédito</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">

		  <li class="nav-item">
			<a class="nav-link creditos"  href="#"><i class='fas fa-money-check-alt'></i> Crédito</a>
		  </li>
		 
		  <li class="nav-item">
			<a class="nav-link ahorro" href="#"><i class='fas fa-university'></i> Ahorro</a>
		  </li>
		</ul> 
		
		  <ul class='nav navbar-nav navbar-right'>
		  <li class="nav-item">
		  <a class="nav-link pull-left" href="acceso/salir.php">
			<i class='fas fa-sign-out-alt'></i> Salir
			</a>
			</li>
		</ul>
		
	  </div>
	 </div>
	</nav>
	<br><br><br>
	
<div class="wrapper">
	
	<div class="content navbar-default">
		<div class="container">
			<div id='contenido'>
	
			</div>
			<div id='datos'>
	
			</div>
			
		</div>
	</div>
		
	<div class="loader loader-default is-active" id='cargando' data-text="Cargando"></div>
</div>
   <?php include 'footer.php' ?>    



</body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!--   Core JS Files   -->
    <script src="librerias/jquery-3.3.1.min.js" type="text/javascript"></script>
	
	  <!--  Notifications Plugin    -->
    <script src="librerias/bootstrap-notify.js"></script>
	<script src="assets/js/sweetalert.min.js"></script>
	<script src="librerias/VentanaCentrada.js" type="text/javascript"></script>
	<script src="sagyc.js" type="text/javascript"></script>

</html>

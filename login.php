<?php 
	include 'acceso/sesion.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Acceso o registro</title>

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

	<link rel="stylesheet" type="text/css" href="index.css"/>
	
	<link rel="stylesheet" href="librerias/load/dist/css-loader.css">
</head>
<body >
	<div id='data'>
		<form id="acceso" action="">
			<div class='container'>
				<h1 class='welcome text-center'></h1>
				<div class='card card-container'>
					<h2 class='login_title text-center'>Acceso SNTE</h2>
						<hr><center><img src='img/caja.png' width='100px'></center>
						
						<p class='input_title'>Filiación:</p>
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fas fa-user-circle"></i> </span>
							</div>
							<input class="form-control" placeholder="Introduzca aqui la Filiación" type="text"  id="userAcceso" name="userAcceso" required>
						</div>
						
						<p class='input_title'>Contraseña:</p>
						<div class="form-group input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
							</div>
							<input class="form-control" placeholder="Contraseña" type="password"  id="passAcceso" name="passAcceso" required>
						</div>
						
						<br>
						<button class="btn btn-warning btn-block" type="submit"><i class='fa fa-check'></i>Aceptar</button>
						<button class="btn btn-outline-info btn-block" id='recuperar'>¿Olvidó la contraseña?</button>
						
				</div>
			</div>
		</form>
	</div>
	
	<div class="loader loader-default" id='cargando' data-text="Cargando"></div>
	
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
	
	
	
	<style> 
	body {
	   background-image: url("img/fondo5.jpg");
	   background-color: #cccccc;
	   
		background-repeat: no-repeat;
		background-attachment: fixed ;
		background-position: top ; 
		-webkit-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		height: 100%;
		overflow: hidden;	
	}
	.cuerpo{
		
	}
	</style>
	
	<script type="text/javascript">
		
		$(document).on("click",'#recuperar',function(e){
			e.preventDefault();
			$.ajax({
				url:   'acceso/recuperar.php',
				  beforeSend: function () {
					$("#data").html("Procesando, espere por favor...");
				  },
				  success:  function (response) {
					$("#data").html('');
					$("#data").html(response);
				  }
			});
		});

		$(document).on('submit','#acceso',function(e){
			e.preventDefault();
			var tipo=1;
			var userAcceso=document.getElementById("userAcceso").value;
			var passAcceso=document.getElementById("passAcceso").value;
			var parametros={
				"tipo":tipo,
				"userAcceso":userAcceso,
				"passAcceso":passAcceso
			}; 
			
			var btn=$(this).find(':submit')
			$(btn).attr('disabled', 'disabled');
			var tmp=$(btn).children("i").attr('class');
			$(btn).children("i").removeClass();
			$(btn).children("i").addClass("fas fa-spinner fa-pulse");
				
			$.ajax({
				url: "acceso/acceder.php",
				type: "POST",
				data: parametros
			}).done(function(echo){
				if (echo !== "") {
					swal({
							  title: echo,
							  text: "",
							  type: "error",
							  showCancelButton: false,
							  confirmButtonColor: "#34495E",
							  confirmButtonText: "Continuar!",
							  closeOnConfirm: true,
							  html: false
						}, function(){

						});
				} else {
					window.location.replace("principal.php");
				}
				$(btn).children("i").removeClass();
				$(btn).children("i").addClass(tmp);
				$(btn).prop('disabled', false);
			});
		});
		
		$(document).on('submit','#recovery',function(e){
			e.preventDefault();
			var telefono=document.getElementById("telefono").value;
			telefono=telefono.trim();
			if(telefono.length>2){
				var btn=$(this).find(':submit')
				$(btn).attr('disabled', 'disabled');
				var tmp=$(btn).children("i").attr('class');
				$(btn).children("i").removeClass();
				$(btn).children("i").addClass("fas fa-spinner fa-pulse");
				
				var tipo=2;
				var parametros={
					"tipo":tipo,
					"telefono":telefono
				}; 
				$.ajax({
					url: "acceso/acceder.php",
					type: "POST",
					data: parametros,
					beforeSend: function(objeto){
						$(btn).children("i").addClass(tmp);
					},
					success:function(response){
						if (response !== "") {
						swal({
								  title: response,
								  text: "",
								  type: "error",
								  showCancelButton: false,
								  confirmButtonColor: "#34495E",
								  confirmButtonText: "Continuar!",
								  closeOnConfirm: true,
								  html: false
							}, function(){

							});
						} else {
							swal({
								  title: "Se notificó correctamente",
								  text: "",
								  type: "success",
								  showCancelButton: false,
								  confirmButtonColor: "#34495E",
								  confirmButtonText: "Continuar!",
								  closeOnConfirm: true,
								  html: false
							}, function(){
								
							});
						}	
						$(btn).children("i").removeClass();
						$(btn).children("i").addClass(tmp);
						$(btn).prop('disabled', false);
					}
				});
			}
			else{
				$( "#telefono" ).focus();
				$( "#telefono" ).val("");
			}
		});

		
	</script>

	
</html>
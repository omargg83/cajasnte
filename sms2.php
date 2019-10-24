<?php
if(in_array  ('curl', get_loaded_extensions())) {
    echo "CURL is available on your web server";
}
else{
    echo "CURL is not available on your web server";
}
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
	<title>Salud Pública</title>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script src="librerias15/jquery-3.3.1.min.js" type="text/javascript"></script>
	<script src="librerias15/jquery/jquery-1.11.3.js"></script>
	<script src="librerias15/jquery/jquery-ui.js"></script>
	
	<script src="sms.js" type="text/javascript"></script>
	
</head>
<body >
	<div id='data'>
		<form id="acceso" action="">
			<div class='container'>
				<h1 class='welcome text-center'></h1>
				<div class='card card-container' style='
				-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
				-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);
				box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.75);'>
					<h2 class='login_title text-center'>Salud Pública</h2>
						
						<button class="btn btn-secondary btn-block" type="submit"><i class='fa fa-check'></i>Aceptar</button>
				</div>
			</div>
			<div class='container2'>
			</div>
		</form>
		
		<div id='container2'>
			aca
		</div>
	</div>
</body>
</html>




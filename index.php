<?php
	session_start();
	require_once("control_db.php");
	$bdd = new Sagyc();
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
	<title>Caja Seccion 15 SNTE</title>
	<link rel="icon" type="image/png" href="img/favicon.ico">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<link rel="stylesheet" href="librerias15/load/dist/css-loader.css">
</head>
<?php
	echo "<body style='background-image: url(\"fondo/fondo5.jpg\")'>";
?>

<header class="d-block p-2" id='header'>
</header>

<div class="page-wrapper d-block p-2" id='bodyx'>
</div>

<div class="modal animated fadeInDown" tabindex="-1" role="dialog" id="myModal">
	<div class="modal-dialog" role="document" id='modal_dispo'>
		<div class="modal-content" id='modal_form'>

		</div>
	</div>
</div>

<div class="loader loader-default is-active" id='cargando' data-text="Cargando">
	<h2><span style='font-color:white'></span></h2>
</div>

</body>
	<!--   Core JS Files   -->
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

	<!--
		<script src="librerias15/jquery-3.4.1.min.js" type="text/javascript"></script>
	-->

	<!--   url   -->
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

	<!--
		<script src="librerias15/jquery/jquery-ui.js"></script>
		<link rel="stylesheet" type="text/css" href="librerias15/jquery/jquery-ui.min.css" />
	-->


	<!-- Animation library for notifications   -->
  <link href="librerias15/animate.css" rel="stylesheet" type="text/css"/>




	<!--   Alertas   -->
	<script src="librerias15/swal/dist/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="librerias15/swal/dist/sweetalert2.min.css">

	<!--   para imprimir   -->
	<script src="librerias15/VentanaCentrada.js" type="text/javascript"></script>

	<!--   Cuadros de confirmación y dialogo   -->
	<link rel="stylesheet" href="librerias15/jqueryconfirm/css/jquery-confirm.css">
	<script src="librerias15/jqueryconfirm/js/jquery-confirm.js"></script>

	<!--   iconos   -->
	<!-- <link rel="stylesheet" href="librerias15/fontawesome-free-5.12.1-web/css/all.css">-->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<!--<script src="librerias15/popper.js"></script>-->
	<script src="librerias15/tooltip.js"></script>

	<!--   Propios   -->
	<script src="sagycv4.js"></script>
	<link rel="stylesheet" type="text/css" href="librerias15/modulos.css"/>

	<!--   Tablas
	<script type="text/javascript" src="librerias15/DataTables/datatables.js"></script>  <-listo
	<script type="text/javascript" src="librerias15/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="librerias15/DataTables/DataTables-1.10.18/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="librerias15/DataTables/DataTables-1.10.18/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="librerias15/DataTables/DataTables-1.10.18/js/jszip.min.js"></script>
	<script type="text/javascript" src="librerias15/DataTables/DataTables-1.10.18/js/pdfmake.min.js"></script>
	<script type="text/javascript" src="librerias15/DataTables/DataTables-1.10.18/js/vfs_fonts.js"></script>
	<script type="text/javascript" src="librerias15/DataTables/DataTables-1.10.18/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="librerias15/DataTables/DataTables-1.10.18/js/buttons.print.min.js"></script>

	<link rel="stylesheet" type="text/css" href="librerias15/DataTables/datatables.min.css"/>  <-listo
	<link rel="stylesheet" type="text/css" href="librerias15/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.css"/>
-->

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>

	<!--   Boostrap   -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<!--<link rel="stylesheet" href="librerias15/css/bootstrap.min.css">-->
	<!--<script src="librerias15/js/bootstrap.js"></script>-->
	<script src="librerias15/jQuery-MD5-master/jquery.md5.js"></script>


</html>

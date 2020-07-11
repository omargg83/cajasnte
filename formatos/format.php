<?php
	require_once("db_.php");
  $row=$db->blo_lista();

  $fecha_actual = strtotime(date("Y-m-d H:i:s",time()));
  $fecha_entrada = strtotime(fecha($row['fretiro']));
  if($fecha_actual <= $fecha_entrada){

		$sql="select * from afiliados where idfolio='".$_SESSION['idfolio']."'";
		$row=$db->general($sql,0);

		echo "<div class='jumbotron text-center'>";
		echo "<a href='#' class='btn btn-warning btn-sm' id='imprime_formato' title='Imprimir Formato de retiro con cheque' data-lugar='formatos/formato' data-tipo='1' title='Formato de retiro'><i class='fas fa-print'></i><span>Formato de retiro con Cheque  </span></a>";
		if (empty($row['num_cuenta'])) {
			echo "<div class='alert alert-danger' role='alert'>
  						Recuerda que para poder imprimir el formato de <b>retiro con transferencia</b>, antes deberás llenar en <b>Bancos</b> tu información
					</div>";
		}
		else {
		echo "<a href='#' class='btn btn-warning btn-sm' id='imprime_formato2' title='Imprimir Formato de retiro con Transferencia' data-lugar='formatos/formato2' data-tipo='1' title='Formato de retiro'><i class='fas fa-print'></i><span>Formato de retiro con Transferencia</span></a>";
		}
		echo "</div>";
  }


?>

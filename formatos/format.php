<?php
	require_once("db_.php");
  $row=$db->blo_lista();

  $fecha_actual = strtotime(date("Y-m-d H:i:s",time()));
  $fecha_entrada = strtotime(fecha($row['fretiro']));
  if($fecha_actual <= $fecha_entrada){
		echo "<div class='jumbotron text-center'>";
    echo "<a href='#' class='btn btn-warning btn-sm' id='imprime_formato' title='Imprimir Formato de retiro con cheque' data-lugar='formatos/formato' data-tipo='1' title='Formato de retiro'><i class='fas fa-print'></i><span>F. retiro con Cheq.</span></a>";
    echo "<a href='#' class='btn btn-warning btn-sm' id='imprime_formato2' title='Imprimir Formato de retiro con Transferencia' data-lugar='formatos/formato2' data-tipo='1' title='Formato de retiro'><i class='fas fa-print'></i><span>F. retiro con Transf.</span></a>";
		echo "</div>";
  }


?>

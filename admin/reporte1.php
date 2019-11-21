<?php
  require_once("../control_db.php");
  if($_SESSION['administrador']!=1){
    exit();
  }
  $desde=$_REQUEST['desde'];
  $hasta=$_REQUEST['hasta'];

  $desde = date("Y-m-d", strtotime($desde))." 00:00:00";
  $hasta = date("Y-m-d", strtotime($hasta))." 23:59:59";

  $row=$db->reporte_1($desde,$hasta);
?>
<div class='container-fluid'>

  <div class="content table-responsive table-full-width" style="background-color: white;">
    <table class='table' id='x_lista' style='font-size:12px'>
    <thead><tr><th>Folio</th><th>Filiación</th><th>Nombre</th><th>Fecha solicitud</th><th>Fecha actualización</th><th>Actualizó</th><th>Estado</th></tr></thead>
    <?php

      foreach($row as $key){
        echo "<tr>";
        echo "<td>".$key['idfolio']."</td>";
        echo "<td>".$key['filiacion']."</td>";
        echo "<td>".$key['nombre']." ".$key['ape_pat']." ".$key['ape_mat']."</td>";
        echo "<td>".fecha($key['fsol'],2)."</td>";
        echo "<td>".fecha($key['fecha'],2)."</td>";
        echo "<td>".$key['tipo']."</td>";
        echo "<td>";
        if ($key['estado']==2)
          echo "Actualizado";
        if ($key['estado']==1)
          echo "Por procesar";
        echo "</td>";
        echo "</tr>";
      }
      echo "</tr>";
?>
    </table>
  </div>
</div>


<script>
	$(document).ready( function () {
		lista("x_lista");
	});
</script>

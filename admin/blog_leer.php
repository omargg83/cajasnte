<?php
	require_once("db_.php");
  $id=$_REQUEST['id'];

  $row = $db->blog_editar($id);
  $nombre=$row['nombre'];
  $texto=$row['texto'];
  $corto=$row['corto'];
  $imagen=$row['imagen'];
  if(strlen($imagen)>2 or file_exists("archivos/".$imagen)){
    echo "<div class='col-3'>";
      echo "<img src='archivos/$imagen' width='100px' heigth='200px' alt='Miniatura'>";
    echo "</div>";
  }

  echo "<div class='card'>";
    echo "<div class='card-header'>";
      echo "<b>$nombre</b><br>";
      echo "$corto";

      echo "<div class='btn-group float-right'>";
        echo "<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='afiliado/index' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>";
      echo "</div>";

    echo "</div>";
    echo "<div class='card-body'>";
      echo $texto;

      echo "<br><div class='btn-group'>";
        echo "<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='afiliado/index' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>";
      echo "</div>";

  echo "</div>";
?>

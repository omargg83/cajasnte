<?php
  require_once("../control_db.php");
  $id=$_REQUEST['id'];

  $row = $db->blog_editar($id);
  $nombre=$row['nombre'];
  $texto=$row['texto'];
  $corto=$row['corto'];

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

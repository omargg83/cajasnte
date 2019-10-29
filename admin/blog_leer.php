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
    echo "</div>";
    echo "<div class='card-body'>";
      echo $texto;
    echo "</div>";
    echo "<div class='card-footer'>";
      echo "<button type='button' class='btn btn-outline-secondary btn-sm' data-dismiss='modal' title='Cancelar'><i class='fas fa-sign-out-alt'></i>Cerrar</button>";
    echo "</div>";
  echo "</div>";
?>

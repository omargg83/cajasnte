<?php
  require_once("../control_db.php");
  $id=$_REQUEST['id'];
  $nombre="";
  $texto="";
  $corto="";
  if($id>0){
    $row = $db->blog_editar($id);
    $nombre=$row['nombre'];
    $texto=$row['texto'];
    $corto=$row['corto'];
  }

  echo "<div class='container'>";
    echo "<form autocomplete=off id='form_personal' action='' data-lugar='control_db' data-funcion='blog_guardar' data-destino='admin/blog_editar'>";
    echo "<input  type='hidden' id='id' NAME='id' value='$id'>";
      echo "<div class='card'>";
        echo "<div class='card-header'>";
          echo "Mensaje";
        echo "</div>";
        echo "<div class='card-body'>";
          echo "<div class='row'>";
            echo  "<div class='col-sm-4'>";
              echo "<label>Nombre</label>";
              echo "<input class='form-control' type='text' id='nombre' NAME='nombre' value='$nombre' maxlength='45' placeholder='Nombre del mensaje'>";
            echo "</div>";

            echo  "<div class='col-sm-6'>";
              echo "<label>Asunto</label>";
              echo "<input class='form-control' type='text' id='corto' NAME='corto' value='$corto' maxlength='200' placeholder='Asunto'>";
            echo "</div>";
          echo "</div>";

          echo "<div class='row'>";
            echo  "<div class='col-sm-12'>";
              echo "<label>Mensaje</label>";
              echo "<textarea class='form-control' type='text' id='texto' NAME='texto' placeholder='Mensaje' rows='10'>$texto</textarea>";
            echo "</div>";
          echo "</div>";

        echo "</div>";
        echo "<div class='card-footer'>";
          echo "<div class='btn-group'>";
            echo "<button class='btn btn-outline-secondary btn-sm' type='submit' title='Guardar cambios' ><i class='far fa-save'></i>Guardar</button>";
          echo "</div>";
        echo "</div>";
      echo "</div>";
    echo "</form>";
  echo "</div>";

?>

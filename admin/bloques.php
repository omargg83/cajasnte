<?php
  require_once("../control_db.php");
  $row=$db->blo_lista();
  $id=$row['id'];
  $usuario=$row['usuario'];
  $aportacion=$row['aportacion'];
  $beneficiarios=$row['beneficiarios'];

  if(strlen($row['fusuario'])>0){
    $fusuario=fecha($row['fusuario']);
  }
  else{
    $fusuario="";
  }

  if(strlen($row['faportacion'])>0){
    $faportacion=fecha($row['faportacion']);
  }
  else{
    $faportacion="";
  }
  if(strlen($row['fbeneficiarios'])>0){
    $fbeneficiarios=fecha($row['fbeneficiarios']);
  }
  else{
    $fbeneficiarios="";
  }

  echo "<div class='container'>";
    echo "<form id='form_comision' action='' data-lugar='control_db' data-funcion='bloques'>";
      echo "<input class='form-control' type='hidden' id='id' NAME='id' value='$id' placeholder='No. Empleado' readonly>";
      echo "<div class='card'>";
        echo "<div class='card-header'>";
          echo "Activación de bloques para actualizar";
        echo "</div>";
        echo "<div class='card-body'>";
        echo "<div class='row'>";
          echo "<div class='col-2'>";
              echo "<div class='form-check'>";
                echo "<label class='form-check-label'>Bloque</label>";
              echo "</div>";
          echo "</div>";

          echo "<div class='col-2'>";
            echo "<label class='form-check-label'>Fecha Limite</label>";
          echo "</div>";
        echo "</div>";

          echo "<div class='row'>";
            echo "<div class='col-2'>";
                echo "<div class='form-check'>";
                  echo "<input type='checkbox' class='form-check-input' id='usuario' name='usuario' value=1"; if($usuario==1){ echo " checked";} echo ">";
                  echo "<label class='form-check-label' for='usuario'>Datos de usuario</label>";
                echo "</div>";
            echo "</div>";

            echo "<div class='col-2'>";
              echo  "<input class='form-control fechaclass' type='text' id='fusuario' NAME='fusuario' value='$fusuario' maxlength='13' placeholder='Fecha'>";
            echo "</div>";
          echo "</div>";

          echo "<div class='row' >";
            echo "<div class='col-2'>";
              echo "<div class='form-check'>";
                echo "<input type='checkbox' class='form-check-input' id='aportacion' name='aportacion' value=1"; if($aportacion==1){ echo " checked";} echo ">";
                echo "<label class='form-check-label' for='aportacion'>Aportación</label>";
              echo "</div>";
            echo "</div>";
            echo "<div class='col-2'>";
              echo  "<input class='form-control fechaclass' type='text' id='faportacion' NAME='faportacion' value='$faportacion' maxlength='13' placeholder='Fecha'>";
            echo "</div>";

          echo "</div>";

          echo "<div class='row' >";
            echo "<div class='col-2'>";
              echo "<div class='form-check'>";
                echo "<input type='checkbox' class='form-check-input' id='beneficiarios' name='beneficiarios' value=1"; if($beneficiarios==1){ echo " checked";} echo ">";
                echo "<label class='form-check-label' for='beneficiarios'>Beneficiarios</label>";
              echo "</div>";
            echo "</div>";
            echo "<div class='col-2'>";
              echo  "<input class='form-control fechaclass' type='text' id='fbeneficiarios' NAME='fbeneficiarios' value='$fbeneficiarios' maxlength='13' placeholder='Fecha'>";
            echo "</div>";
          echo "</div>";


        echo "</div>";

        echo "<div class='card-footer'>";
          echo "<button class='btn btn-warning btn-sm' type='submit'><i class='far fa-save'></i>Guardar</button>";
        echo "</div>";
      echo "</div>";
    echo "</form>";
  echo "</div>";
 ?>
 <script>
   $(function() {
     fechas();
   });
 </script>

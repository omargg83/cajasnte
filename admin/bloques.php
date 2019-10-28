<?php
  require_once("../control_db.php");
  $row=$db->blo_lista();
  $id=$row['id'];
  $usuario=$row['usuario'];
  $aportacion=$row['aportacion'];
  $beneficiarios=$row['beneficiarios'];


  echo "<div class='container'>";
    echo "<form id='form_comision' action='' data-lugar='control_db' data-funcion='bloques'>";
      echo "<input class='form-control' type='hidden' id='id' NAME='id' value='$id' placeholder='No. Empleado' readonly>";
      echo "<div class='card'>";
        echo "<div class='card-header'>";
          echo "Activación de bloques para actualizar";
        echo "</div>";
        echo "<div class='card-body'>";

          echo "<div class='form-check'>
            <input type='checkbox' class='form-check-input' id='usuario' name='usuario' value=1";
            if($usuario==1){ echo " checked";}
            echo ">
            <label class='form-check-label' for='usuario'>Datos de usuario</label>
          </div>";

          echo "<div class='form-check'>
            <input type='checkbox' class='form-check-input' id='aportacion' name='aportacion' value=1";
            if($aportacion==1){ echo " checked";}
            echo ">
            <label class='form-check-label' for='aportacion'>Aportación</label>
          </div>";

          echo "<div class='form-check'>
            <input type='checkbox' class='form-check-input' id='beneficiarios' name='beneficiarios' value=1";
            if($beneficiarios==1){ echo " checked";}
            echo ">
            <label class='form-check-label' for='beneficiarios'>Beneficiarios</label>
          </div>";


        echo "</div>";

        echo "<div class='card-footer'>";
          echo "<button class='btn btn-warning btn-sm' type='submit'><i class='far fa-save'></i>Guardar</button>";
        echo "</div>";
      echo "</div>";
    echo "</form>";
  echo "</div>";
 ?>

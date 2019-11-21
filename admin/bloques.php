<?php
  require_once("../control_db.php");
  
  if($_SESSION['administrador']!=1){
    exit();
  }

  $row=$db->blo_lista();
  $id=$row['id'];

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

  if(strlen($row['fretiro'])>0){
    $fretiro=fecha($row['fretiro']);
  }
  else{
    $fretiro="";
  }

  echo "<div class='container'>";
    echo "<form id='form_comision' action='' data-lugar='control_db' data-funcion='bloques'>";
      echo "<input class='form-control' type='hidden' id='id' NAME='id' value='$id' placeholder='No. Empleado' readonly>";
      echo "<div class='card'>";
        echo "<div class='card-header'>";
          echo "<img src='img/caja.png' width='20' alt='logo'> - ";
          echo "Activación de bloques para actualizar información";
        echo "</div>";
        echo "<div class='card-body'>";
        echo "<div class='row'>";
          echo "<div class='col-4'>";
              echo "<div class='form-check'>";
                echo "<label class='form-check-label'><b>Bloque</b></label>";
              echo "</div>";
          echo "</div>";

          echo "<div class='col-4'>";
            echo "<label class='form-check-label'><b>Fecha Limite</b></label>";
          echo "</div>";
        echo "</div>";
        echo "<br>";
          echo "<div class='row'>";
            echo "<div class='col-4'>";
                echo "<div class='form-check'>";
                  echo "<label class='form-check-label' for='usuario'>Datos de usuario</label>";
                echo "</div>";
            echo "</div>";

            echo "<div class='col-4'>";
              echo  "<input class='form-control fechaclass' type='text' id='fusuario' NAME='fusuario' value='$fusuario' maxlength='13' placeholder='Fecha' required>";
            echo "</div>";
          echo "</div>";

          echo "<div class='row' >";
            echo "<div class='col-4'>";
              echo "<div class='form-check'>";
                echo "<label class='form-check-label' for='aportacion'>Aportación</label>";
              echo "</div>";
            echo "</div>";
            echo "<div class='col-4'>";
              echo  "<input class='form-control fechaclass' type='text' id='faportacion' NAME='faportacion' value='$faportacion' maxlength='13' placeholder='Fecha' required>";
            echo "</div>";

          echo "</div>";

          echo "<div class='row' >";
            echo "<div class='col-4'>";
              echo "<div class='form-check'>";
                echo "<label class='form-check-label' for='beneficiarios'>Beneficiarios</label>";
              echo "</div>";
            echo "</div>";
            echo "<div class='col-4'>";
              echo  "<input class='form-control fechaclass' type='text' id='fbeneficiarios' NAME='fbeneficiarios' value='$fbeneficiarios' maxlength='13' placeholder='Fecha' required>";
            echo "</div>";
          echo "</div>";


          echo "<div class='row' >";
            echo "<div class='col-4'>";
              echo "<div class='form-check'>";
                echo "<label class='form-check-label' for='formato_retiro'>Formato de retiro</label>";
              echo "</div>";
            echo "</div>";
            echo "<div class='col-4'>";
              echo  "<input class='form-control fechaclass' type='text' id='fretiro' NAME='fretiro' value='$fretiro' maxlength='13' placeholder='Fecha' required>";
            echo "</div>";
          echo "</div>";

        echo "</div>";

        echo "<div class='card-footer'>";
          echo "<div class='btn-group'>";
            echo "<button class='btn btn-warning btn-sm' type='submit'><i class='far fa-save'></i>Guardar</button>";
            echo "<a class='btn btn-warning btn-sm' href='#afiliado/index' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</a>";
          echo "</div>";
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

<?php
  require_once("../control_db.php");

  $alerta=$db->blog_alerta();
  echo "<div class='container' id='trabajo'>";
  foreach($alerta as $key){
    echo "<div class='alert alert-success'>";
    echo $key['corto'];
    echo "</div>";
  }

  $row=$db->afiliado();
  $folio=$row['idfolio'];
  $filiacion=$row['Filiacion'];
  $ape_pat=$row['ape_pat'];
  $ape_mat=$row['ape_mat'];
  $nombre=$row['nombre'];
  $a_qui=$row['a_qui'];

    echo "<div class='container'>";
    	echo "<form id='form_comision' action='' data-lugar='control_db' data-funcion='guardar_aportacion' data-destino='aportacion/aportacion'>";
      echo "<input class='form-control' type='hidden' id='id' NAME='id' value='$folio' placeholder='No. Empleado' readonly>";

      echo "<div class='card'>";
    		echo "<div class='card-header'>";
    			echo "Aportacion";
    		echo "</div>";

        echo "<div class='card-body'>";
          echo "<div class='row'>";
            echo "<div class='col-xl-2 col-lg-2 col-md-2 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='idfolio'>Socio</label>";
                echo "<input class='form-control' type='text' id='idfolio' NAME='idfolio' value='".$row['idfolio']."' placeholder='No. Empleado' readonly>";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-3 col-lg-4 col-md-4 col-sm-4'>";
              echo "<div class='form-group'>";
                echo "<label for='Filiacion'>Filiación</label>";
                echo "<input class='form-control' type='text' id='Filiacion' NAME='Filiacion' value='$filiacion' placeholder='Filiacion' readonly>";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-2 col-lg-4 col-md-4 col-sm-4'>";
              echo "<div class='form-group'>";
                echo "<label for='ape_pat'>A. PATERNO</label>";
                echo "<input class='form-control' type='text' id='ape_pat' NAME='ape_pat' value='$ape_pat' placeholder='APELLIDO PATERNO' readonly>";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-2 col-lg-4 col-md-4 col-sm-4'>";
              echo "<div class='form-group'>";
                echo "<label for='ape_mat'>A. MATERNO</label>";
                echo "<input class='form-control' type='text' id='ape_mat' NAME='ape_mat' value='$ape_mat' placeholder='APELLIDO MATERNO' readonly>";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-3 col-lg-4 col-md-4 col-sm-4'>";
              echo "<div class='form-group'>";
                echo "<label for='nombre'>NOMBRE (S)</label>";
                echo "<input class='form-control' type='text' id='nombre' NAME='nombre' value='$nombre' placeholder='NOMBRE (S)' readonly>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
          echo "<div class='row'>";
            echo "<div class='col-xl-2 col-lg-3 col-md-3 col-sm-4'>";
              echo "<div class='form-group'>";
                echo "<label>Aportacion Ahorro</label>";
                echo "<input class='form-control' type='text' id='a_qui' NAME='a_qui' value='" .$a_qui."' placeholder='Aportacion Ahorro'>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";

        $row=$db->blo_lista();
        $aportacion=$row['aportacion'];
        $faportacion=fecha($row['faportacion']);
        $fecha_actual = strtotime(date("Y-m-d H:i:s",time()));
        $fecha_entrada = strtotime($faportacion);

    		echo "<div class='card-footer'>";
          if(($aportacion==1 and $fecha_actual <= $fecha_entrada) or ($aportacion==1 and strlen($faportacion)==0)){
            echo "<div class='btn-group'>";
              echo "<button class='btn btn-warning btn-sm' type='submit'><i class='far fa-save'></i>Guardar</button>";
              echo "<a class='btn btn-warning btn-sm' href='#afiliado/index' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</a>";
            echo "</div>";
          }
    		echo "</div>";
      echo "</div>";
    	echo "</form>";

      $cambio=$db->cambios();
      if($cambio['up_aportacion']==1){
        echo "<br><div class='card'>";
          echo "<div class='card-header'>";
            echo "Datos generales actuales pendientes por actualizar";
          echo "</div>";
          echo "<div class='card-body'>";
            echo "<div class='row'>";
              echo "<div class='col-6'>";
              echo "<label>Aportacion Ahorro</label>";
              echo "<input class='form-control' type='text' id='a_qui1' NAME='a_qui1' value='" .number_format($cambio['aportacion'],2)."' placeholder='Aportacion Ahorro' readonly>";
              echo "</div>";
                ///////////////////////////////


            echo "</div>";
          echo "</div>";
        echo "</div>";
      }


    echo "</div>";
?>

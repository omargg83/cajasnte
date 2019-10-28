<?php
  require_once("../control_db.php");
  $row=$db->afiliado();
  $folio=$row['idfolio'];
  $filiacion=$row['Filiacion'];
  $ape_pat=$row['ape_pat'];
  $ape_mat=$row['ape_mat'];
  $nombre=$row['nombre'];
  $e_civ=$row['e_civ'];
  $a_qui=$row['a_qui'];

    echo "<div class='container'>";
    	echo "<form id='form_comision' action='' data-lugar='control_db' data-funcion='guardar_aportacion'>";
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
                echo "<label for='a_qui'>Aportacion Ahorro</label>";
                echo "<input class='form-control' type='text' id='a_qui' NAME='a_qui' value='" .number_format($a_qui,2)."' placeholder='Aportacion Ahorro'>";
              echo "</div>";
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

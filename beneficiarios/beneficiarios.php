<?php
  	require_once("../control_db.php");
    $row=$db->afiliado();

    $ben1="aqui poner nombre1";
    $parentesco1="aqui poner parentesco1";
    $porcentaje1="poner porcentaje1";

    $ben2="aqui poner nombre2";
    $parentesco2="aqui poner parentesco2";
    $porcentaje2="poner porcentaje2";


    echo "<div class='container'>";
    	echo "<form id='form_comision' action='' data-lugar='control_db' data-destino='datos/editar' data-funcion='guardar_beneficiarios'>";
      ///ir a control_db.php en la funcion guardar_beneficiarios se guardan los beneficirios;

      echo "<div class='card'>";
    		echo "<div class='card-header'>";
    			echo "Beneficiarios";
    		echo "</div>";

        echo "<div class='card-body'>";

          //////////bloque beneficiario 1
          echo "<div class='row'>";
            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='bene1'>Beneficiario</label>";
                echo "<input class='form-control' type='text' id='bene1' NAME='bene1' value='$ben1' placeholder='No. Empleado' readonly>";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='par1'>Parentesco</label>";
                echo "<input class='form-control' type='text' id='par1' NAME='par1' value='$parentesco1' placeholder='Filiacion' readonly>";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='porcentaje1'>Porcentaje</label>";
                echo "<input class='form-control' type='text' id='porcentaje1' NAME='porcentaje1' value='$parentesco1' placeholder='Filiacion' readonly>";
              echo "</div>";
            echo "</div>";
    			echo "</div>";

          //////////bloque beneficiario 2
          echo "<div class='row'>";
            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='bene2'>Beneficiario</label>";
                echo "<input class='form-control' type='text' id='bene2' NAME='bene2' value='$ben2' placeholder='No. Empleado' readonly>";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='par2'>Parentesco</label>";
                echo "<input class='form-control' type='text' id='par2' NAME='par2' value='$parentesco2' placeholder='Filiacion' readonly>";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='porcentaje2'>Porcentaje</label>";
                echo "<input class='form-control' type='text' id='porcentaje2' NAME='porcentaje2' value='$parentesco2' placeholder='Filiacion' readonly>";
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

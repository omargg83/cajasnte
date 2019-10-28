<?php
  	require_once("../control_db.php");
    $row=$db->afiliado();

    $ben1=$row['BA'];
    $parentesco1=$row['PA'];
    $porcentaje1=$row['BFA'];

    $ben2=$row['BB'];
    $parentesco2=$row['PB'];
    $porcentaje2=$row['BFB'];

    $ben3=$row['BC'];
    $parentesco3=$row['PC'];
    $porcentaje3=$row['BFC'];

    $ben4=$row['BD'];
    $parentesco4=$row['PD'];
    $porcentaje4=$row['BFD'];

    $ben5=$row['BE'];
    $parentesco5=$row['PE'];
    $porcentaje5=$row['BFE'];


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
                echo "<label for='ben1'>Beneficiario</label>";
                echo "<input class='form-control' type='text' id='ben1' NAME='ben1' value='$ben1' placeholder='No. Empleado' readonly>";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='parentesco1'>Parentesco</label>";
                echo "<input class='form-control' type='text' id='parentesco1' NAME='parentesco1' value='$parentesco1' placeholder='Filiacion' readonly>";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='porcentaje1'>Porcentaje</label>";
                echo "<input class='form-control' type='text' id='porcentaje1' NAME='porcentaje1' value='$porcentaje1' placeholder='Filiacion' readonly>";
              echo "</div>";
            echo "</div>";
    			echo "</div>";

          //////////bloque beneficiario 2
          echo "<div class='row'>";
            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='ben2'>Beneficiario</label>";
                echo "<input class='form-control' type='text' id='ben2' NAME='ben2' value='$ben2' placeholder='No. Empleado' readonly>";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='parentesco2'>Parentesco</label>";
                echo "<input class='form-control' type='text' id='parentesco2' NAME='parentesco2' value='$parentesco2' placeholder='Filiacion' readonly>";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='porcentaje2'>Porcentaje</label>";
                echo "<input class='form-control' type='text' id='porcentaje2' NAME='porcentaje2' value='$porcentaje2' placeholder='Filiacion' readonly>";
              echo "</div>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
//////////bloque beneficiario 3
        echo "<div class='row'>";
          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='ben3'>Beneficiario</label>";
              echo "<input class='form-control' type='text' id='ben3' NAME='ben3' value='$ben3' placeholder='No. Empleado' readonly>";
            echo "</div>";
          echo "</div>";

          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='parentesco3'>Parentesco</label>";
              echo "<input class='form-control' type='text' id='parentesco3' NAME='parentesco3' value='$parentesco3' placeholder='Filiacion' readonly>";
            echo "</div>";
          echo "</div>";

          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='porcentaje3'>Porcentaje</label>";
              echo "<input class='form-control' type='text' id='porcentaje3' NAME='porcentaje3' value='$porcentaje3' placeholder='Filiacion' readonly>";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";

      //////////bloque beneficiario 4
              echo "<div class='row'>";
                echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
                  echo "<div class='form-group'>";
                    echo "<label for='ben4'>Beneficiario</label>";
                    echo "<input class='form-control' type='text' id='ben4' NAME='ben4' value='$ben4' placeholder='No. Empleado' readonly>";
                  echo "</div>";
                echo "</div>";

                echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
                  echo "<div class='form-group'>";
                    echo "<label for='parentesco4'>Parentesco</label>";
                    echo "<input class='form-control' type='text' id='parentesco4' NAME='parentesco4' value='$parentesco4' placeholder='Filiacion' readonly>";
                  echo "</div>";
                echo "</div>";

                echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
                  echo "<div class='form-group'>";
                    echo "<label for='porcentaje4'>Porcentaje</label>";
                    echo "<input class='form-control' type='text' id='porcentaje4' NAME='porcentaje4' value='$porcentaje4' placeholder='Filiacion' readonly>";
                  echo "</div>";
                echo "</div>";
              echo "</div>";
            echo "</div>";

            //////////bloque beneficiario 4
                    echo "<div class='row'>";
                      echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
                        echo "<div class='form-group'>";
                          echo "<label for='ben5'>Beneficiario</label>";
                          echo "<input class='form-control' type='text' id='ben5' NAME='ben5' value='$ben5' placeholder='No. Empleado' readonly>";
                        echo "</div>";
                      echo "</div>";

                      echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
                        echo "<div class='form-group'>";
                          echo "<label for='parentesco5'>Parentesco</label>";
                          echo "<input class='form-control' type='text' id='parentesco5' NAME='parentesco5' value='$parentesco5' placeholder='Filiacion' readonly>";
                        echo "</div>";
                      echo "</div>";

                      echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
                        echo "<div class='form-group'>";
                          echo "<label for='porcentaje5'>Porcentaje</label>";
                          echo "<input class='form-control' type='text' id='porcentaje5' NAME='porcentaje5' value='$porcentaje5' placeholder='Filiacion' readonly>";
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

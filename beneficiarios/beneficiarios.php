<?php
  	require_once("../control_db.php");
    $row=$db->afiliado();
    echo "<div class='container' id='trabajo'>";
    $filiacion=$row['Filiacion'];
    $ape_pat=$row['ape_pat'];
    $ape_mat=$row['ape_mat'];
    $nombre=$row['nombre'];

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

      echo "<form id='form_benef' action='' data-lugar='control_db' data-funcion='guardar_beneficiarios' data-destino='beneficiarios/beneficiarios'>";
      echo "<input class='form-control' type='hidden' id='id' NAME='id' value='".$_SESSION['idfolio']."' placeholder='Beneficiario' >";
      echo "<div class='card'>";
    		echo "<div class='card-header'>";
    			echo "Beneficiarios";
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

          //////////bloque beneficiario 1
          echo "<div class='row'>";
            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='ben1'>Beneficiario 1</label>";
                echo "<input class='form-control' type='text' id='ben1' NAME='ben1' value='$ben1' placeholder='Beneficiario' >";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='parentesco1'>Parentesco</label>";
                echo "<input class='form-control' type='text' id='parentesco1' NAME='parentesco1' value='$parentesco1' placeholder='Parentesco' >";
              echo "</div>";
            echo "</div>";

            echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
              echo "<div class='form-group'>";
                echo "<label for='porcentaje1'>Porcentaje</label>";
                echo "<input class='form-control' type='text' id='porcentaje1' NAME='porcentaje1' value='$porcentaje1' placeholder='Porcentaje' >";
              echo "</div>";
            echo "</div>";
    			echo "</div>";

        //////////bloque beneficiario 2
        echo "<div class='row'>";
          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='ben2'>Beneficiario 2</label>";
              echo "<input class='form-control' type='text' id='ben2' NAME='ben2' value='$ben2' placeholder='Beneficiario' >";
            echo "</div>";
          echo "</div>";

          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='parentesco2'>Parentesco</label>";
              echo "<input class='form-control' type='text' id='parentesco2' NAME='parentesco2' value='$parentesco2' placeholder='Parentesco' >";
            echo "</div>";
          echo "</div>";

          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='porcentaje2'>Porcentaje</label>";
              echo "<input class='form-control' type='text' id='porcentaje2' NAME='porcentaje2' value='$porcentaje2' placeholder='Porcentaje' >";
            echo "</div>";
          echo "</div>";
        echo "</div>";

        //////////bloque beneficiario 3
        echo "<div class='row'>";
          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='ben3'>Beneficiario 3</label>";
              echo "<input class='form-control' type='text' id='ben3' NAME='ben3' value='$ben3' placeholder='Beneficiario' >";
            echo "</div>";
          echo "</div>";

          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='parentesco3'>Parentesco</label>";
              echo "<input class='form-control' type='text' id='parentesco3' NAME='parentesco3' value='$parentesco3' placeholder='Parentesco' >";
            echo "</div>";
          echo "</div>";

          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='porcentaje3'>Porcentaje</label>";
              echo "<input class='form-control' type='text' id='porcentaje3' NAME='porcentaje3' value='$porcentaje3' placeholder='Porcentaje' >";
            echo "</div>";
          echo "</div>";
        echo "</div>";

        /////////bloque beneficiario 4
        echo "<div class='row'>";
          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='ben4'>Beneficiario 4</label>";
              echo "<input class='form-control' type='text' id='ben4' NAME='ben4' value='$ben4' placeholder='Beneficiario' >";
            echo "</div>";
          echo "</div>";

          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='parentesco4'>Parentesco</label>";
              echo "<input class='form-control' type='text' id='parentesco4' NAME='parentesco4' value='$parentesco4' placeholder='Parentesco' >";
            echo "</div>";
          echo "</div>";

          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='porcentaje4'>Porcentaje</label>";
              echo "<input class='form-control' type='text' id='porcentaje4' NAME='porcentaje4' value='$porcentaje4' placeholder='Porcentaje' >";
            echo "</div>";
          echo "</div>";
        echo "</div>";


        //////////bloque beneficiario 4
        echo "<div class='row'>";
          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='ben5'>Beneficiario 5</label>";
              echo "<input class='form-control' type='text' id='ben5' NAME='ben5' value='$ben5' placeholder='Beneficiario' >";
            echo "</div>";
          echo "</div>";

          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='parentesco5'>Parentesco</label>";
              echo "<input class='form-control' type='text' id='parentesco5' NAME='parentesco5' value='$parentesco5' placeholder='Parentesco' >";
            echo "</div>";
          echo "</div>";

          echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-3'>";
            echo "<div class='form-group'>";
              echo "<label for='porcentaje5'>Porcentaje</label>";
              echo "<input class='form-control' type='text' id='porcentaje5' NAME='porcentaje5' value='$porcentaje5' placeholder='Porcentaje' >";
            echo "</div>";
          echo "</div>";
        echo "</div>";
      echo "</div>";

      $row=$db->blo_lista();
      $beneficiarios=$row['beneficiarios'];
      $fbeneficiarios=fecha($row['fbeneficiarios']);
      $fecha_actual = strtotime(date("Y-m-d H:i:s",time()));
      $fecha_entrada = strtotime($fbeneficiarios);

        echo "<div class='card-footer'>";
          if(($beneficiarios==1 and $fecha_actual <= $fecha_entrada) or ($beneficiarios==1 and strlen($beneficiarios)==0)){
            echo "<div class='btn-group'>";
              echo "<button class='btn btn-warning btn-sm' type='submit'><i class='far fa-save'></i>Guardar</button>";
              echo "<a class='btn btn-warning btn-sm' href='#afiliado/index' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</a>";
            echo "</div>";
          }
        echo "</div>";

      echo "</div>";
    	echo "</form>";

    	$cambio=$db->cambios();
    	if($cambio['up_bene']==1){
    		echo "<br><div class='card'>";
    			echo "<div class='card-header'>";
    				echo "Datos generales actuales pendientes por actualizar";
    			echo "</div>";
    			echo "<div class='card-body'>";
    				echo "<div class='row'>";
              echo "<div class='col-4'>";
                echo "<label>Beneficiario 1</label>";
                echo "<input class='form-control' type='text' id='ben1_1' NAME='ben1_1' value='".$cambio['BA']."' placeholder='Beneficiario' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label >Parentesco 1</label>";
                echo "<input class='form-control' type='text' id='parentesco1_1' NAME='parentesco1_1' value='".$cambio['PA']."' placeholder='Parentesco' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label>Porcentaje 1</label>";
                echo "<input class='form-control' type='text' id='porcentaje1_1' NAME='porcentaje1_1' value='".$cambio['BFA']."' placeholder='Porcentaje' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label>Beneficiario 2</label>";
                echo "<input class='form-control' type='text' id='ben1_2' NAME='ben1_1' value='".$cambio['BB']."' placeholder='Beneficiario' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label >Parentesco 2</label>";
                echo "<input class='form-control' type='text' id='parentesco1_2' NAME='parentesco1_1' value='".$cambio['PB']."' placeholder='Parentesco' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label>Porcentaje 2</label>";
                echo "<input class='form-control' type='text' id='porcentaje1_2' NAME='porcentaje1_1' value='".$cambio['BFB']."' placeholder='Porcentaje' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label>Beneficiario 3</label>";
                echo "<input class='form-control' type='text' id='ben1_2' NAME='ben1_1' value='".$cambio['BC']."' placeholder='Beneficiario' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label >Parentesco 3</label>";
                echo "<input class='form-control' type='text' id='parentesco1_2' NAME='parentesco1_1' value='".$cambio['PC']."' placeholder='Parentesco' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label>Porcentaje 3</label>";
                echo "<input class='form-control' type='text' id='porcentaje1_2' NAME='porcentaje1_1' value='".$cambio['BFC']."' placeholder='Porcentaje' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label>Beneficiario 4</label>";
                echo "<input class='form-control' type='text' id='ben1_2' NAME='ben1_1' value='".$cambio['BD']."' placeholder='Beneficiario' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label >Parentesco 4</label>";
                echo "<input class='form-control' type='text' id='parentesco1_2' NAME='parentesco1_1' value='".$cambio['PD']."' placeholder='Parentesco' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label>Porcentaje 4</label>";
                echo "<input class='form-control' type='text' id='porcentaje1_2' NAME='porcentaje1_1' value='".$cambio['BFD']."' placeholder='Porcentaje' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label>Beneficiario 5</label>";
                echo "<input class='form-control' type='text' id='ben1_2' NAME='ben1_1' value='".$cambio['BE']."' placeholder='Beneficiario' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label >Parentesco 5</label>";
                echo "<input class='form-control' type='text' id='parentesco1_2' NAME='parentesco1_1' value='".$cambio['PE']."' placeholder='Parentesco' readonly>";
              echo "</div>";

              echo "<div class='col-4'>";
                echo "<label>Porcentaje 5</label>";
                echo "<input class='form-control' type='text' id='porcentaje1_2' NAME='porcentaje1_1' value='".$cambio['BFE']."' placeholder='Porcentaje' readonly>";
              echo "</div>";

    				echo "</div>";
    			echo "</div>";
    		echo "</div>";
    	}
    echo "</div>";
    echo "</div>";
?>

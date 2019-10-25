<?php
	require_once("../control_db.php");
	$row=$db->afiliado();
  $folio=$row['idfolio'];
  $filiacion=$row['Filiacion'];
  $ape_pat=$row['ape_pat'];
  $ape_mat=$row['ape_mat'];
  $nombre=$row['nombre'];
  $e_civ=$row['e_civ'];

echo "<div class='container'>";
	echo "<form id='form_comision' action='' data-lugar='control_db' data-destino='datos/editar' data-funcion='guardar_datos'>";
  echo "<div class='card'>";
		echo "<div class='card-header'>";
			echo "Datos generales";
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

        echo "<div class='col-xl-2 col-lg-3 col-md-3 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='r_reg'>Región</label>";
            echo "<input class='form-control' type='text' id='r_reg' NAME='r_reg' value='".$row['r_reg']." ".$row['r_rrg']."' placeholder='Región' readonly>";
          echo "</div>";
        echo "</div>";

        echo "<div class='col-xl-3 col-lg-6 col-md-6 col-sm-5'>";
          echo "<div class='form-group'>";
            echo "<label for='c_psp'>Clave Presupuestal</label>";
            echo "<input class='form-control' type='text' id='c_psp' NAME='c_psp' value='".$row['c_psp']."' placeholder='Clave Presupuestal' readonly>";
          echo "</div>";
        echo "</div>";



        echo "<div class='col-xl-3 col-lg-3 col-md-3 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='d_dom'>Correo</label>";
            echo "<input class='form-control' type='text' id='mail' NAME='mail' value='".$row['correo']."' placeholder='Correo' readonly>";
          echo "</div>";
        echo "</div>";

        echo  "<div class='col-xl-3 col-lg-3 col-md-4 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='d_dom'>Celular</label>";
            echo "<input class='form-control' type='text' id='celular' NAME='celular' value='".$row['celular']."' placeholder='Celular' readonly>";
          echo "</div>";
        echo "</div>";

        $Fecha_Ingreso=$row['Fecha_Ingreso'];
        list($Fecha_Ingreso,$hora) = explode(" ",$Fecha_Ingreso);
        list($anio,$mes,$dia) = explode("-",$Fecha_Ingreso);
        $Fecha_Ingreso=$dia."-".$mes."-".$anio;

        /*echo  "<div class='col-xl-2 col-lg-3 col-md-3 col-sm-4'>";
        echo "<div class='form-group'>";
        echo "<label for='Fecha_Ingreso'>Fecha de ingreso</label>";
        echo "<input class='form-control' type='text' id='Fecha_Ingreso' NAME='Fecha_Ingreso' value='".$Fecha_Ingreso."' placeholder='Fecha de ingreso' readonly>";
        echo "</div>";
        echo "</div>";*/
				echo "<div class='col-xl-2 col-lg-3 col-md-3 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='a_qui'>Aportacion Ahorro</label>";
            echo "<input class='form-control' type='text' id='a_qui' NAME='a_qui' value='" .number_format($row['a_qui'],2)."' placeholder='Aportacion Ahorro' readonly>";
          echo "</div>";
        echo "</div>";

			echo "</div>";
			echo "<hr>";
			echo "<div class='row'>";
        echo "<div class='col-xl-12 col-lg-8 col-md-8 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='d_dom'>Domicilio</label>";
            echo "<input class='form-control' type='text' id='d_dom' NAME='d_dom' value='".$row['d_dom']."' placeholder='Dirección' readonly>";
          echo "</div>";
        echo "</div>";

				echo "<div class='col-xl-3 col-lg-3 col-md-3 col-sm-3'>";
					echo "<div class='form-group'>";
						echo "<label for='e_civ'>Estado civil</label>";

						echo "<select class='form-control' name='e_civ' id='e_civ'>";
						echo "<option value='' selected style='color: silver;'>Seleccione...</option>";
							echo  "<option value='SOLTERO'"; if ($e_civ=='SOLTERO'){echo  " selected";}			echo  ">Soltero</option>";
							echo  "<option value='DIVORCIADA '"; if ($e_civ=='DIVORCIADA'){echo  " selected";}			echo  ">DIVORCIADA</option>";
						echo  "</select>";
					echo "</div>";
				echo "</div>";

				echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='n_con'>Nombre del conyugue</label>";
            echo "<input class='form-control' type='text' id='n_con' NAME='n_con' value='".$row['n_con']."' placeholder='Conyugue'>";
          echo "</div>";
        echo "</div>";

				echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='n_con'>Localidad</label>";
            echo "<input class='form-control' type='text' id='n_con' NAME='n_con' value='".$row['n_con']."' placeholder='Conyugue'>";
          echo "</div>";
        echo "</div>";

				echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='n_con'>Municipio</label>";
            echo "<input class='form-control' type='text' id='n_con' NAME='n_con' value='".$row['n_con']."' placeholder='Conyugue'>";
          echo "</div>";
        echo "</div>";

				echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='n_con'>Telefono</label>";
            echo "<input class='form-control' type='text' id='n_con' NAME='n_con' value='".$row['n_con']."' placeholder='Conyugue'>";
          echo "</div>";
        echo "</div>";
      echo "</div>";

			echo "<div class='row'>";
				echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4'>";
					echo "<div class='form-group'>";
						echo "<label for='n_con'>Clave del centro de trabajo</label>";
						echo "<input class='form-control' type='text' id='n_con' NAME='n_con' value='".$row['n_con']."' placeholder='Conyugue'>";
					echo "</div>";
				echo "</div>";

				echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4'>";
					echo "<div class='form-group'>";
						echo "<label for='n_con'>Ubicación</label>";
						echo "<input class='form-control' type='text' id='n_con' NAME='n_con' value='".$row['n_con']."' placeholder='Conyugue'>";
					echo "</div>";
				echo "</div>";

				echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4'>";
					echo "<div class='form-group'>";
						echo "<label for='n_con'>Delegación</label>";
						echo "<input class='form-control' type='text' id='n_con' NAME='n_con' value='".$row['n_con']."' placeholder='Conyugue'>";
					echo "</div>";
				echo "</div>";

				echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4'>";
					echo "<div class='form-group'>";
						echo "<label for='n_con'>Región</label>";
						echo "<input class='form-control' type='text' id='n_con' NAME='n_con' value='".$row['n_con']."' placeholder='Conyugue'>";
					echo "</div>";
				echo "</div>";

				echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4'>";
					echo "<div class='form-group'>";
						echo "<label for='n_con'>Clave Presupuestal</label>";
						echo "<input class='form-control' type='text' id='n_con' NAME='n_con' value='".$row['n_con']."' placeholder='Conyugue'>";
					echo "</div>";
				echo "</div>";

				echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4'>";
					echo "<div class='form-group'>";
						echo "<label for='n_con'>Per. Quincenal</label>";
						echo "<input class='form-control' type='text' id='n_con' NAME='n_con' value='".$row['n_con']."' placeholder='Conyugue'>";
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

<?php
	require_once("../control_db.php");
	$row=$db->afiliado();
  $folio=$row['idfolio'];
  $filiacion=$row['Filiacion'];
  $ape_pat=$row['ape_pat'];
  $ape_mat=$row['ape_mat'];
  $nombre=$row['nombre'];


	$d_dom=$row['d_dom'];
	$l_loc=$row['l_loc'];
	$m_mun=$row['m_mun'];

	$e_civ=$row['e_civ'];
	$conyuge=$row['n_con'];

echo "<div class='container'>";
	echo "<form id='form_comision' action='' data-lugar='control_db' data-funcion='guardar_datos'>";
	  echo "<input class='form-control' type='hidden' id='id' NAME='id' value='".$row['idfolio']."' placeholder='No. Empleado' readonly>";
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


			echo "</div>";
			echo "<hr>";
			echo "<div class='row'>";
        echo "<div class='col-xl-12 col-lg-8 col-md-8 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='d_dom'>Domicilio</label>";
            echo "<input class='form-control' type='text' id='d_dom' NAME='d_dom' value='".$row['d_dom']."' placeholder='Dirección'>";
          echo "</div>";
        echo "</div>";

				echo "<div class='col-xl-3 col-lg-3 col-md-3 col-sm-3'>";
					echo "<div class='form-group'>";
						echo "<label for='e_civ'>Estado civil</label>";

						echo "<select class='form-control' name='e_civ' id='e_civ'>";
						echo "<option value='' selected style='color: silver;'>Seleccione...</option>";
							echo  "<option value='CASADA'"; if ($e_civ=='CASADA'){echo  " selected";}			echo  ">CASADA</option>";
							echo  "<option value='CASADO '"; if ($e_civ=='CASADO'){echo  " selected";}			echo  ">CASADO</option>";
							echo  "<option value='CONCUBINATO'"; if ($e_civ=='CONCUBINATO'){echo  " selected";}			echo  ">CONCUBINATO</option>";
							echo  "<option value='DIVORCIADA '"; if ($e_civ=='DIVORCIADA'){echo  " selected";}			echo  ">DIVORCIADA</option>";
							echo  "<option value='DIVORCIADO'"; if ($e_civ=='DIVORCIADO'){echo  " selected";}			echo  ">DIVORCIADO</option>";
							echo  "<option value='MADRE SOLTERA '"; if ($e_civ=='MADRE SOLTERA'){echo  " selected";}			echo  ">MADRE SOLTERA</option>";
							echo  "<option value='PADRE SOLTERO'"; if ($e_civ=='PADRE SOLTERO'){echo  " selected";}			echo  ">PADRE SOLTERO</option>";
							echo  "<option value='SEPARADA '"; if ($e_civ=='SEPARADA'){echo  " selected";}			echo  ">SEPARADA</option>";

							echo  "<option value='SEPARADO '"; if ($e_civ=='SEPARADO'){echo  " selected";}			echo  ">SEPARADO</option>";
							echo  "<option value='SOLTERA'"; if ($e_civ=='SOLTERA'){echo  " selected";}			echo  ">SOLTERA</option>";
							echo  "<option value='SOLTERO'"; if ($e_civ=='SOLTERO'){echo  " selected";}			echo  ">SOLTERO</option>";
							echo  "<option value='UNIÓN LIBRE'"; if ($e_civ=='UNIÓN LIBRE'){echo  " selected";}			echo  ">UNIÓN LIBRE</option>";
							echo  "<option value='VIUDA'"; if ($e_civ=='VIUDA'){echo  " selected";}			echo  ">VIUDA</option>";
							echo  "<option value='VIUDO'"; if ($e_civ=='VIUDO'){echo  " selected";}			echo  ">VIUDO</option>";
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
            echo "<label for='l_loc'>Localidad</label>";
            echo "<input class='form-control' type='text' id='l_loc' NAME='l_loc' value='".$row['l_loc']."' placeholder='Conyugue'>";
          echo "</div>";
        echo "</div>";

				echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='m_mun'>Municipio</label>";
            echo "<input class='form-control' type='text' id='m_mun' NAME='m_mun' value='".$row['m_mun']."' placeholder='Conyugue'>";
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

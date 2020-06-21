<?php
	require_once("db_.php");

	$row=$db->afiliado();
	$idfolio=$row['idfolio'];
	$filiacion=$row['Filiacion'];
	$ape_pat=$row['ape_pat'];
	$ape_mat=$row['ape_mat'];
	$nombre=$row['nombre'];

	$tipo_cuenta="";
	$num_cuenta="";
	$titular="";
	$clave_banco="";
	$plaza_banxico="";
	$sucursal="";
	$tipo_cuenta2="";
	$benef_app_paterno="";
	$benef_app_materno="";
	$benef_nombre="";
	$benef_direccion="";
	$benef_ciudad="";

	$res=$db->bancos();
	if($res){
		$tipo_cuenta=$res->tipo_cuenta;
		$num_cuenta=$res->num_cuenta;
		$titular=$res->titular;
		$clave_banco=$res->clave_banco;
		$plaza_banxico=$res->plaza_banxico;
		$sucursal=$res->sucursal;
		$tipo_cuenta2=$res->tipo_cuenta2;
		$benef_app_paterno=$res->benef_app_paterno;
		$benef_app_materno=$res->benef_app_materno;
		$benef_nombre=$res->benef_nombre;
		$benef_direccion=$res->benef_direccion;
		$benef_ciudad=$res->benef_ciudad;
	}


echo "<div class='container' id='div_trabajo'>";
	echo "<form id='form_comision' action='' data-lugar='bancos/db_' data-funcion='guardar_bancos' data-destino='bancos/datos' data-div='div_trabajo'>";
	  echo "<input class='form-control form-control-sm' type='hidden' id='id' NAME='id' value='$idfolio' readonly>";
  echo "<div class='card'>";
		echo "<div class='card-header'>";
			echo "<img src='img/caja.png' width='20' alt='logo'> - ";
			echo "Datos generales actuales";
		echo "</div>";
    echo "<div class='card-body'>";
      echo "<div class='row'>";
        echo "<div class='col-xl-2 col-lg-2 col-md-2 col-sm-3'>";
          echo "<div class='form-group'>";
            echo "<label for='idfolio'>Socio</label>";
            echo "<input class='form-control form-control-sm' type='text' id='idfolio' NAME='idfolio' value='".$row['idfolio']."' placeholder='No. Empleado' readonly>";
          echo "</div>";
        echo "</div>";

        echo "<div class='col-xl-3 col-lg-4 col-md-4 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='Filiacion'>Filiación</label>";
            echo "<input class='form-control form-control-sm' type='text' id='Filiacion' NAME='Filiacion' value='$filiacion' placeholder='Filiacion' readonly>";
          echo "</div>";
        echo "</div>";

        echo "<div class='col-xl-2 col-lg-4 col-md-4 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='ape_pat'>A. PATERNO</label>";
            echo "<input class='form-control form-control-sm' type='text' id='ape_pat' NAME='ape_pat' value='$ape_pat' placeholder='APELLIDO PATERNO' readonly>";
          echo "</div>";
        echo "</div>";

        echo "<div class='col-xl-2 col-lg-4 col-md-4 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='ape_mat'>A. MATERNO</label>";
            echo "<input class='form-control form-control-sm' type='text' id='ape_mat' NAME='ape_mat' value='$ape_mat' placeholder='APELLIDO MATERNO' readonly>";
          echo "</div>";
        echo "</div>";

        echo "<div class='col-xl-3 col-lg-4 col-md-4 col-sm-4'>";
          echo "<div class='form-group'>";
            echo "<label for='nombre'>NOMBRE (S)</label>";
            echo "<input class='form-control form-control-sm' type='text' id='nombre' NAME='nombre' value='$nombre' placeholder='NOMBRE (S)' readonly>";
          echo "</div>";
        echo "</div>";
			echo "</div>";

			echo "<hr>";
			echo "<div class='row'>";
				echo "<div class='col-4'>";
					echo "<div class='form-group'>";
						echo "<label for='e_civ'>Tipo de cuenta</label>";
						echo "<select class='form-control form-control-sm' name='tipo_cuenta' id='tipo_cuenta'>";
							echo  "<option value='SANTAN'"; if ($tipo_cuenta=='SANTAN'){echo  " selected";}			echo  ">SANTANDER</option>";
							echo  "<option value='CASADO'"; if ($tipo_cuenta=='CASADO'){echo  " selected";}			echo  ">OTRAS</option>";
						echo  "</select>";
					echo "</div>";
				echo "</div>";

				echo "<div class='col-4'>";
					echo "<div class='form-group'>";
						echo "<label for='n_con'>Número de cuenta</label>";
						echo "<input class='form-control form-control-sm' type='text' id='num_cuenta' NAME='num_cuenta' value='$num_cuenta' placeholder='Número de cuenta' maxlength=20 required>";
					echo "</div>";
				echo "</div>";

				echo "<div class='col-4'>";
					echo "<div class='form-group'>";
						echo "<label for='n_con'>Nombre del titular</label>";
						echo "<input class='form-control form-control-sm' type='text' id='titular' NAME='titular' value='$titular' placeholder='Nombre del titular' maxlength=40 required>";
					echo "</div>";
				echo "</div>";

	      echo "<div class='col-3'>";
	        echo "<div class='form-group'>";
	          echo "<label for='d_dom'>Clave del banco.</label>";
	          echo "<input class='form-control form-control-sm' type='text' id='clave_banco' NAME='clave_banco' value='$clave_banco' placeholder='Clave del banco' maxlength=5 required>";
	        echo "</div>";
	      echo "</div>";

	      echo "<div class='col-3'>";
	        echo "<div class='form-group'>";
	          echo "<label for='d_dom'>Plaza Banxico</label>";
	          echo "<input class='form-control form-control-sm' type='text' id='plaza_banxico' NAME='plaza_banxico' value='$plaza_banxico' placeholder='Plaza Banxico' maxlength=5>";
	        echo "</div>";
	    	echo "</div>";

	      echo "<div class='col-3'>";
	        echo "<div class='form-group'>";
	          echo "<label for='d_dom'>Sucursal titular</label>";
	          echo "<input class='form-control form-control-sm' type='text' id='sucursal' NAME='sucursal' value='$sucursal' placeholder='Sucursal titular' maxlength=5>";
	        echo "</div>";
	    	echo "</div>";

				echo "<div class='col-3'>";
					echo "<div class='form-group'>";
						echo "<label for='e_civ'>Tipo de cuenta</label>";
						echo "<select class='form-control form-control-sm' name='tipo_cuenta2' id='tipo_cuenta2'>";
							echo  "<option value='02'"; if ($tipo_cuenta2=='02'){echo  " selected";}			echo  ">02 - Débito</option>";
							echo  "<option value='04'"; if ($tipo_cuenta2=='04'){echo  " selected";}			echo  ">40 - Clabe</option>";
						echo  "</select>";
					echo "</div>";
				echo "</div>";

				echo "<div class='col-4'>";
	        echo "<div class='form-group'>";
	          echo "<label for='d_dom'>Apellido paterno del beneficiario</label>";
	          echo "<input class='form-control form-control-sm' type='text' id='benef_app_paterno' NAME='benef_app_paterno' value='$benef_app_paterno' placeholder='Apellido paterno del beneficiario' maxlength=20>";
	        echo "</div>";
	    	echo "</div>";

				echo "<div class='col-4'>";
	        echo "<div class='form-group'>";
	          echo "<label for='d_dom'>Apellido materno del beneficiario</label>";
	          echo "<input class='form-control form-control-sm' type='text' id='benef_app_materno' NAME='benef_app_materno' value='$benef_app_materno' placeholder='Apellido materno del beneficiario' maxlength=20>";
	        echo "</div>";
	    	echo "</div>";

				echo "<div class='col-4'>";
	        echo "<div class='form-group'>";
	          echo "<label for='d_dom'>Nombre del beneficiario</label>";
	          echo "<input class='form-control form-control-sm' type='text' id='benef_nombre' NAME='benef_nombre' value='$benef_nombre' placeholder='Nombre del beneficiario' maxlength=120>";
	        echo "</div>";
	    	echo "</div>";

				echo "<div class='col-8'>";
	        echo "<div class='form-group'>";
	          echo "<label for='d_dom'>Dirección del beneficiario</label>";
	          echo "<input class='form-control form-control-sm' type='text' id='benef_direccion' NAME='benef_direccion' value='$benef_direccion' placeholder='Dirección del beneficiario' maxlength=140>";
	        echo "</div>";
	    	echo "</div>";

				echo "<div class='col-4'>";
	        echo "<div class='form-group'>";
	          echo "<label for='d_dom'>Ciudad del beneficiario</label>";
	          echo "<input class='form-control form-control-sm' type='text' id='benef_ciudad' NAME='benef_ciudad' value='$benef_ciudad' placeholder='Ciudad del beneficiario' maxlength=35>";
	        echo "</div>";
	    	echo "</div>";

    	echo "</div>";
  echo "</div>";

		$cambio=$db->cambios(6,$idfolio);

		echo "<div class='card-footer'>";
			if(!$cambio){
				//if($fecha_actual <= $fecha_entrada){
					echo "<div class='btn-group'>";
						echo "<button class='btn btn-warning btn-sm' type='submit'><i class='fas fa-sync'></i>Enviar cambios</button>";
					echo "</div>";
				//}
				//else{
					//echo "<b>Lo sentimos, por el momento no se pueden actualizar estos datos en Caja de Ahorro</b>";
				//}
			}
			else{
				echo "<b>Información pendiente por actualizar</b>";
			}
		echo "</div>";
  echo "</div>";
	echo "</form>";


	if ($cambio){
		echo "<br><div class='card' id='datos_c'>";
			echo "<div class='card-header'>";
				echo "<i class='fas fa-exclamation'></i> Datos generales actuales pendientes por actualizar - en breve serán actualizados en las oficinas de caja de ahorro";
			echo "</div>";
			echo "<div class='card-body'>";
				echo "<div class='row'>";

					echo "<div class='col-4'>";
						echo "<div class='form-group'>";
							echo "<label for='e_civ'>Tipo de cuenta</label>";
							echo "<select class='form-control form-control-sm' name='tipo_cuenta' id='tipo_cuenta' readonly>";
								echo  "<option value='SANTAN'"; if ($cambio['tipo_cuenta']=='SANTAN'){echo  " selected";}			echo  ">SANTANDER</option>";
								echo  "<option value='CASADO'"; if ($cambio['tipo_cuenta']=='CASADO'){echo  " selected";}			echo  ">OTRAS</option>";
							echo  "</select>";
						echo "</div>";
					echo "</div>";

					echo "<div class='col-4'>";
						echo "<div class='form-group'>";
							echo "<label for='n_con'>Número de cuenta</label>";
							echo "<input class='form-control form-control-sm' type='text' id='num_cuenta' NAME='num_cuenta' value='".$cambio['num_cuenta']."' placeholder='Número de cuenta' maxlength=20 readonly>";
						echo "</div>";
					echo "</div>";

					echo "<div class='col-4'>";
						echo "<div class='form-group'>";
							echo "<label for='n_con'>Nombre del titular</label>";
							echo "<input class='form-control form-control-sm' type='text' id='titular' NAME='titular' value='".$cambio['titular']."' placeholder='Nombre del titular' maxlength=40 readonly>";
						echo "</div>";
					echo "</div>";

					echo "<div class='col-3'>";
		        echo "<div class='form-group'>";
		          echo "<label for='d_dom'>Clave del banco.</label>";
		          echo "<input class='form-control form-control-sm' type='text' id='clave_banco' NAME='clave_banco' value='".$cambio['clave_banco']."' placeholder='Clave del banco' maxlength=5 readonly>";
		        echo "</div>";
		      echo "</div>";

					echo "<div class='col-3'>";
					 echo "<div class='form-group'>";
						 echo "<label for='d_dom'>Plaza Banxico</label>";
						 echo "<input class='form-control form-control-sm' type='text' id='plaza_banxico' NAME='plaza_banxico' value='".$cambio['plaza_banxico']."' placeholder='Plaza Banxico' maxlength=5 readonly>";
					 echo "</div>";
				 echo "</div>";

				 echo "<div class='col-3'>";
					 echo "<div class='form-group'>";
						 echo "<label for='d_dom'>Sucursal titular</label>";
						 echo "<input class='form-control form-control-sm' type='text' id='sucursal' NAME='sucursal' value='".$cambio['sucursal']."' placeholder='Sucursal titular' maxlength=5 readonly>";
					 echo "</div>";
				 echo "</div>";

				 echo "<div class='col-3'>";
 					echo "<div class='form-group'>";
 						echo "<label for='e_civ'>Tipo de cuenta</label>";
 						echo "<select class='form-control form-control-sm' name='tipo_cuenta2' id='tipo_cuenta2' readonly>";
 							echo  "<option value='02'"; if ($cambio['tipo_cuenta2']=='02'){echo  " selected";}			echo  ">02 - Débito</option>";
 							echo  "<option value='04'"; if ($cambio['tipo_cuenta2']=='04'){echo  " selected";}			echo  ">40 - Clabe</option>";
 						echo  "</select>";
 					echo "</div>";
 				echo "</div>";

				echo "<div class='col-4'>";
	        echo "<div class='form-group'>";
	          echo "<label for='d_dom'>Apellido paterno del beneficiario</label>";
	          echo "<input class='form-control form-control-sm' type='text' id='benef_app_paterno' NAME='benef_app_paterno' value='".$cambio['benef_app_paterno']."' placeholder='Apellido paterno del beneficiario' maxlength=20 readonly>";
	        echo "</div>";
	    	echo "</div>";

				echo "<div class='col-4'>";
	        echo "<div class='form-group'>";
	          echo "<label for='d_dom'>Apellido materno del beneficiario</label>";
	          echo "<input class='form-control form-control-sm' type='text' id='benef_app_materno' NAME='benef_app_materno' value='".$cambio['benef_app_materno']."' placeholder='Apellido materno del beneficiario' maxlength=20 readonly>";
	        echo "</div>";
	    	echo "</div>";

				echo "<div class='col-4'>";
	        echo "<div class='form-group'>";
	          echo "<label for='d_dom'>Nombre del beneficiario</label>";
	          echo "<input class='form-control form-control-sm' type='text' id='benef_nombre' NAME='benef_nombre' value='".$cambio['benef_nombre']."' placeholder='Nombre del beneficiario' maxlength=120 readonly>";
	        echo "</div>";
	    	echo "</div>";

				echo "<div class='col-8'>";
	        echo "<div class='form-group'>";
	          echo "<label for='d_dom'>Dirección del beneficiario</label>";
	          echo "<input class='form-control form-control-sm' type='text' id='benef_direccion' NAME='benef_direccion' value='".$cambio['benef_direccion']."' placeholder='Dirección del beneficiario' maxlength=140 readonly>";
	        echo "</div>";
	    	echo "</div>";

				echo "<div class='col-4'>";
					echo "<div class='form-group'>";
						echo "<label for='d_dom'>Ciudad del beneficiario</label>";
						echo "<input class='form-control form-control-sm' type='text' id='benef_ciudad' NAME='benef_ciudad' value='".$cambio['benef_ciudad']."' placeholder='Ciudad del beneficiario' maxlength=35 readonly>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
					//////////////////////////////
				echo "<div class='card-footer'>";
					echo "<div class='row'>";
						echo "<div class='col-6'>";
							echo "<button class='btn btn-warning btn-sm' type='button' onclick='cancela_bancos()'><i class='fas fa-eraser'></i>Cancelar cambios</button>";
						echo "</div>";
					echo "</div>";
				echo "</div>";

		echo "</div>";
	}

echo "</div>";

?>

<script type="text/javascript">

	function cancela_bancos(){
		$.confirm({
			title: 'Cancelar',
			content: '¿Desea cancelar la actualización de información?',
			buttons: {
				Aceptar: function () {
					$.ajax({
	 					data:  {
							"function":"cancela_datos"
	 					},
	 					url:  "bancos/db_.php",
	 					type:  'post',
		 				success:  function (response) {
							console.log(response);
							$("#div_trabajo").load("bancos/datos.php");
							var datos = JSON.parse(response);
							if (datos.error==0){
								$("#datos_c").remove();
								Swal.fire({
									type: 'success',
									title: "Se canceló correctamente",
									showConfirmButton: false,
									timer: 1000
								});
							}
							else{
								Swal.fire({
									type: 'error',
									title: "Error favor de verificar",
									showConfirmButton: false,
									timer: 2000
								});
							}
		 				}
	 				});
				},
				Regresar: function () {

				}
			}
		});
	}
</script>

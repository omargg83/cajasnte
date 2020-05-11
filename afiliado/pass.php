<?php
	require_once("db_.php");
	$row=$db->afiliado();
	$idfolio=$row['idfolio'];
	$filiacion=$row['Filiacion'];
	$ape_pat=$row['ape_pat'];
	$ape_mat=$row['ape_mat'];
	$nombre=$row['nombre'];
?>
<div class='container'>
<form id='form_comision' action='' data-lugar='afiliado/db_' data-funcion='guardar_pass' data-destino='afiliado/pass'>
  <input class="form-control" type="hidden" id="id" name="id" value='<?php echo $_SESSION['idfolio']; ?>'>
  <div class='card'>
    <div class='card-header'>
			<img src='img/caja.png' width='20' alt='logo'> -
			Cambiar contraseña
    </div>
    <div class='card-body'>
			<?php
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
			 ?>
      <div class="form-group input-group">
        <label class="col-md-4 control-label" for="pass1">Contraseña</label>
        <div class="input-group-prepend">
          <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
        </div>
        <input class="form-control" placeholder="Contraseña" type="password" id="pass1" name="pass1" required>
      </div>

      <div class="form-group input-group">
        <label class="col-md-4 control-label" for="pass2">Repetir contraseña</label>
        <div class="input-group-prepend">
          <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
        </div>
        <input class="form-control" placeholder="Repetir Contraseña" type="password"  id="pass2" name="pass2" required>
      </div>
    </div>

    <div class='card-footer'>
      <div class="btn-group">
        <button type='submit' class="btn btn-warning btn-sm" ><i class="far fa-save"></i> Guardar</button>
      </div>
    </div>
    </div>
</form>
<?php


$cambio=$db->cambios(1,$_SESSION['idfolio']);
if ($cambio){
	if($cambio['up_pass']==1){
		echo "<br><div class='card' id='datos_c'>";
			echo "<div class='card-header'>";
				echo "<i class='fas fa-exclamation'></i> Datos de contraseña - en breve serán actualizados en las oficinas de caja de ahorro";
			echo "</div>";
			echo "<div class='card-body'>";
				echo "<div class='row'>";
					echo "<div class='col-6'>";
						echo "<label for='c2'>Contraseña</label>";
						echo "<input class='form-control form-control-sm' type='text' id='e_civ1' NAME='e_civ1' value='".$cambio['password']."' readonly>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
					//////////////////////////////
				echo "<div class='card-footer'>";
					echo "<div class='row'>";
						echo "<div class='col-6'>";
							echo "<button class='btn btn-warning btn-sm' type='button' onclick='cancela_pass()'><i class='fas fa-eraser'></i>Cancelar cambios</button>";
						echo "</div>";
					echo "</div>";
				echo "</div>";

		echo "</div>";
	}
}

 ?>
</div>


<script type="text/javascript">
	function cancela_pass(){
		$.confirm({
			title: 'Cancelar',
			content: '¿Desea cancelar la actualización de información?',
			buttons: {
				Aceptar: function () {
					$.ajax({
	 					data:  {
							"function":"cancela_pass"
	 					},
	 					url:  "afiliado/db_.php",
	 					type:  'post',
		 				success:  function (response) {
							if (!isNaN(response)){
								$("#datos_c").remove();
								Swal.fire({
								  type: 'success',
								  title: "Se canceló correctamente",
								  showConfirmButton: false,
								  timer: 1000
								});
							}
							else{

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

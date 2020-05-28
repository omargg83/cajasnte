<?php
require_once("db_.php");
$db = new Diasno();
	$id=$_REQUEST['id'];
	if($id>0){
		$pers = $db->dias_edit($id);
		$recurrente=$pers['recurrente'];
		$descripcion=$pers['descripcion'];
		$fecha=fecha($pers['fecha']);
	}
	else{
		$recurrente=0;
		$descripcion="";
		$fecha=date("d-m-Y");
	}
?>

<div class="container">
	<form action="" id="form_personal" data-lugar="dias/db_" data-funcion="guardar_dias">
		<input type="hidden" value="<?php echo $id; ?>" name="id" id="id">
		<div class="card">
			<div class="card-header">Dias de descanso</div>
			<div class="card-body">
				<div class="row">
					<div class="col-2">
						<label for="fecha">Fecha</label>
						<input type="text" placeholder="Fecha" id="fecha" name="fecha" value="<?php echo $fecha; ?>" class="form-control fechaclass" autocomplete=off >
					</div>

					<div class="col-5">
						<label for="descripcion">Descripción</label>
						<input type="text" placeholder="Descripción" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" class="form-control">
					</div>

					<div class='col-sm-3'>
						<label>Recurrente </label><br>
						<input type='checkbox' name='recurrente' id='recurrente' value=1
						<?php
						if($recurrente==1){ echo " checked";}
						?>
						>
					</div>

				</div>
			</div>
			<div class="card-footer">
				<div class="row">
					<div class="col-12">
						<div class="btn-group">
							<button class="btn btn-outline-secondary btn-sm" type="submit"><i class='far fa-save'></i>Guardar</button>
							<button class='btn btn-outline-secondary btn-sm' id='lista_penarea' data-lugar='dias/lista' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script>
$(function() {
	fechas();
	$(document).ready( function () {
		$('table.datatable').DataTable({
			"pageLength": 100,
			"language": {
				"sSearch": "Buscar aqui",
				"lengthMenu": "Mostrar _MENU_ registros",
				"zeroRecords": "No se encontró",
				"info": " Página _PAGE_ de _PAGES_",
				"infoEmpty": "Sin registros",
				"infoFiltered": "(filtered from _MAX_ total records)",
				"paginate": {
					"first":      "Primero",
					"last":       "Ultimo",
					"next":       "Siguiente",
					"previous":   "Anterior"
				},
			}
		});
	});
});
</script>

<?php
	require_once("db_.php");
  $resp=$db->citas_afiliados();
  echo "<div class='container-fluid'>";
	echo "<br><h5>Citas</h5><hr>";
?>
		<div class="content table-responsive table-full-width" >
			<table class="table-sm display compact hover" id="x_lista">
			<thead>
			<th>#</th>
			<th>Horario</th>
			<th>Tipo</th>
      <th>Observaciones</th>
			</tr>
			</thead>
			<tbody>
			<?php
        foreach($resp as $key){
					echo "<tr id=".$key->id." class='edit-t'>";

					echo "<td>";
  					echo "<div class='btn-group'>";
  					echo "<button class='btn btn-warning btn-sm' id='edit_persona' title='Editar' data-lugar='admin/blog_editar'><i class='fas fa-pencil-alt'></i>Ver</button>";
        		echo "<button class='btn btn-warning btn-sm' id='cita_cancela' onclick='cancela_cita(".$key->id.")'><i class='far fa-trash-alt'></i>Cancelar cita</button>";
  					echo "</div>";
					echo "</td>";

					echo "<td>".fecha($key->fecha,3)."</td>";
					echo "<td>";
          if ($key->tipo==1){
            echo "Retiro";
          }
          else{
            echo "Credito";
          }
          echo "</td>";
					echo "<td>".$key->observaciones."</td>";
					echo "</tr>";
				}
			?>
			</tbody>
			</table>
		</div>
	</div>

<script>
	$(document).ready( function () {
		lista("x_lista");
	});
</script>

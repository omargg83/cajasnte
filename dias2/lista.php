<?php
	require_once("db_.php");
	$db = new Diasnocre();
	$pd = $db->dias();
	echo "<br><h5>Lista de dias de descanso para Creditos</h5><hr>";
?>
		<div class="content table-responsive table-full-width">
			<table class="table-sm display compact hover" id="x_lista">
			<thead>
			<th>#</th>
			<th>-</th>
			<th>Dia</th>
			<th>Descripción</th>
			<th>Recurrente</th>
			</tr>
			</thead>
			<tbody>
			<?php
				for($i=0;$i<count($pd);$i++){
					echo "<tr id=".$pd[$i]['iddias']." class='edit-t'>";
					echo "<td>";
					echo $i+1;
					echo "</td>";
					echo "<td>";

					echo "<div class='btn-group'>";
					echo "<button class='btn btn-outline-secondary btn-sm' id='edit_dias' title='Editar' data-lugar='dias2/editar'><i class='fas fa-pencil-alt'></i></button>";
					echo "</div>";

					echo "</td>";
					echo "<td>";
					echo $pd[$i]["fecha"];
					echo "</td>";
					echo "<td>".$pd[$i]["descripcion"]."</td>";
					if ($pd[$i]['recurrente']==1)
					{
					echo "<td>"."Si"."</td>";
					}
					else
					{

	        echo "<td>"."No"."</td>";

					}
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

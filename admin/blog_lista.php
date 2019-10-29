<?php
  require_once("../control_db.php");
	$pd = $db->blog_lista();
	echo "<div class='container-fluid'>";
	echo "<br><h5>Lista de mensajes</h5><hr>";
?>
		<div class="content table-responsive table-full-width">
			<table class="table-sm display compact hover" id="x_lista">
			<thead>
			<th>#</th>
			<th>-</th>
			<th>Foto</th>
			<th>Nombre</th>
			</tr>
			</thead>
			<tbody>
			<?php
        foreach($pd as $key){
					echo "<tr id=".$key['id']." class='edit-t'>";

					echo "<td>";
  					echo "<div class='btn-group'>";
  					echo "<button class='btn btn-outline-secondary btn-sm' id='edit_persona' title='Editar' data-lugar='admin/blog_editar'><i class='fas fa-pencil-alt'></i></button>";
  					echo "</div>";
					echo "</td>";

					echo "<td>".$key["nombre"]."</td>";
					echo "<td>".$key["asunto"]."</td>";
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

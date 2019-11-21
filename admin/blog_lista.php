<?php
  require_once("../control_db.php");
	$pd = $db->blog_lista();
	echo "<div class='container-fluid'>";
	echo "<br><h5>Lista de mensajes</h5><hr>";
?>
		<div class="content table-responsive table-full-width" >
			<table class="table-sm display compact hover" id="x_lista">
			<thead>
			<th>#</th>
			<th>Nombre</th>
			<th>Asunto</th>
      <th>Limite</th>
			</tr>
			</thead>
			<tbody>
			<?php
        foreach($pd as $key){
					echo "<tr id=".$key['id']." class='edit-t'>";

					echo "<td>";
  					echo "<div class='btn-group'>";
  					echo "<button class='btn btn-warning btn-sm' id='edit_persona' title='Editar' data-lugar='admin/blog_editar'><i class='fas fa-pencil-alt'></i></button>";

            		echo "<button class='btn btn-warning btn-sm' id='eliminar_comision' data-lugar='control_db' data-destino='admin/blog_lista' data-id='".$key['id']."' data-funcion='borrar_blog' data-div='trabajo'><i class='far fa-trash-alt'></i></i></button>";


  					echo "</div>";
					echo "</td>";

					echo "<td>".$key["nombre"]."</td>";
					echo "<td>".$key["corto"]."</td>";
					echo "<td>".fecha($key["limite"])."</td>";
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

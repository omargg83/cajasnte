<?php
	require_once("db_.php");
	$pd = $db->busca_afiliados();
	echo "<div class='container-fluid'>";
	echo "<br><h5>Reestablecer contraseña</h5>";
	echo "<hr>";
?>
		<div class="content table-responsive table-full-width" >
			<table id='x_lista' class='dataTable compact hover row-border' style='font-size:10pt;'>
			<thead>
			<th>#</th>
			<th>Folio</th>
			<th>Filiación</th>
			<th>Nombre</th>
			<th>Apellido Paterno</th>
			<th>Apellido materno</th>
			<th>Correo</th>
			</tr>
			</thead>
			<tbody>
			<?php
				if (count($pd)>0){
					foreach($pd as $key){
						echo "<tr id='".$key['idfolio']."' class='edit-t'>";
						echo "<td>";
							echo "<div class='btn-group'>";
								echo "<button class='btn btn-outline-secondary btn-sm' id='contra' title='Editar' onclick='reset_pass(".$key['idfolio'].")'><i class='fas fa-key'></i></button>";
							echo "</div>";
						echo "</td>";
						echo "<td>".$key["idfolio"]."</td>";
						echo "<td>".$key["Filiacion"]."</td>";
						echo "<td>".$key["nombre"]."</td>";
						echo "<td>".$key["ape_pat"]."</td>";
						echo "<td>".$key["ape_mat"]."</td>";
						echo "<td>".$key["correo"]."</td>";
						echo "</tr>";
					}
				}
			?>
			</tbody>
			</table>
		</div>
	</div>

<script>
	$(document).ready( function () {
		lista("x_lista");
	} );
</script>

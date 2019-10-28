<?php
	require_once("../control_db.php");
	$row=$db->blog_activo();

	echo "<div class='container'>";

	echo "<div id='trabajo'>";
		echo "<div class='alert alert-success'>";
		echo "<strong>Nota:</strong> solo se muestra la información del ciclo anterior y actual, para mas detalles acuda a las oficinas de caja de ahorro";
		echo "</div>";
	echo "</div>";

	echo "<div class='row'>";
	foreach($row as $key){
		echo "<div class='card' style='width: 18rem;'>
			<div class='card-body'>
				<h5 class='card-title'>".$key['nombre']."</h5>
				<p class='card-text'>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
				<a href='#' class='card-link'>Card link</a>
				<a href='#' class='card-link'>Another link</a>
			</div>
		</div>";
	}
	echo "</div>";
?>

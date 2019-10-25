<?php
	require_once("../control_db.php");
	$row=$db->afiliado();
	$folio=$row['idfolio'];
	$filiacion=$row['Filiacion'];
	$ape_pat=$row['ape_pat'];
	$ape_mat=$row['ape_mat'];
	$nombre=$row['nombre'];
	echo "<div class='container'>";

	echo "<div id='trabajo'>";
		echo "<div class='alert alert-success'>";
		echo "<strong>Nota:</strong> solo se muestra la información del ciclo anterior y actual, para mas detalles acuda a las oficinas de caja de ahorro";
		echo "</div>";
	echo "</div>";
?>
<div class='row'>
	<div class="card" style="width: 18rem;">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			<a href="#" class="card-link">Card link</a>
			<a href="#" class="card-link">Another link</a>
		</div>
	</div>

	<div class="card" style="width: 18rem;">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			<a href="#" class="card-link">Card link</a>
			<a href="#" class="card-link">Another link</a>
		</div>
	</div>

	<div class="card" style="width: 18rem;">
		<div class="card-body">
			<h5 class="card-title">Card title</h5>
			<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
			<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			<a href="#" class="card-link">Card link</a>
			<a href="#" class="card-link">Another link</a>
		</div>
	</div>

</div>

<?php


	echo "</div>";
?>

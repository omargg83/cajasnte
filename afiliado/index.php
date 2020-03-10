<?php
	require_once("../control_db.php");

	$alerta=$db->blog_alerta();
	echo "<div class='container' id='trabajo'>";
	foreach($alerta as $key){
		echo "<div class='alert alert-success'>";
		echo $key['corto'];
		echo "</div>";
	}

	$noticia=$db->blog_noticia();

	echo "<div class='row'>";
	foreach($noticia as $key){
		echo "<div class='col-sm-6'>
			<div class='card'>
				<div class='card-body'>";
					$imagen=$key['imagen'];
					echo "<h5 class='card-title'><b>".$key['nombre']."</b></h5>";
					echo "<div class='row'>";
						echo "<div class='col-12'>";
							echo "<p class='card-text'>".$key['corto']."</p>";
							echo "<button class='btn btn-warning btn-sm' id='edit_".$key['id']."' title='Editar' data-lugar='admin/blog_leer'  data-id='".$key['id']."'><i class='fas fa-pencil-alt'></i>Leer</button>";
						echo "</div>";
/*
						if(strlen($imagen)>2 or file_exists("archivos/".$imagen)){
							echo "<div class='col-2'>";
								echo "<img src='archivos/$imagen' width='100px' heigth='200px' alt='Miniatura'>";
							echo "</div>";
						}
						*/


					echo "</div>";
				echo "</div>
			</div>
		</div>";
	}
	echo "</div>";

	echo "<hr>";

	/*<div class='container'>
		<div id='carouselExampleControls' class='carousel slide' data-ride='carousel'>
		  <div class='carousel-inner'>
		    <div class='carousel-item active'>
		      <img class='d-block w-100' height='400px' src='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQ2TSnUJUflEJdnfIu1oW6cs6yJftEe0UgaZrmri20270ODlBzY' alt='First slide'>
				  <div class='carousel-caption d-none d-md-block'>
				    <h5>texto 1</h5>
				    <p>asunto</p>
				  </div>
		    </div>
		    <div class='carousel-item'>
		      <img class='d-block w-100' height='400px' src='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTBAEzBYSDsSDCr-VU2Lkf92mAGzaBnX2TWUqvknzL1FkSw2K4A' alt='Second slide'>
		    </div>
		    <div class='carousel-item'>
		      <img class='d-block w-100' height='400px' src='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQ5jhvNlr5LhxePfXrbTK2uE3yTZXwUvC9tl-10him0b8GwuYt7' alt='Third slide'>
		    </div>
		  </div>
		  <a class='carousel-control-prev' href='#carouselExampleControls' role='button' data-slide='prev'>
		    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
		    <span class='sr-only'>Previous</span>
		  </a>
		  <a class='carousel-control-next' href='#carouselExampleControls' role='button' data-slide='next'>
		    <span class='carousel-control-next-icon' aria-hidden='true'></span>
		    <span class='sr-only'>Next</span>
		  </a>
		</div>
	</div>*/
?>
<div align="center">
		<img src='img/snte.jpeg'>
</div>
<iframe width="360" height="315" src="https://www.youtube.com/embed/XaP-63SYRbo"
frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
</iframe>

<iframe width="360" height="315" src="https://www.youtube.com/embed/-0GYyxvHdbA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

<iframe width="360" height="315" src="https://www.youtube.com/embed/j_dRYZfC0_g" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

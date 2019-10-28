<?php
  require_once("../control_db.php");
	echo "<nav class='navbar navbar-expand-lg navbar-light bg-light '>

	<a class='navbar-brand' ><i class='fas fa-users'></i> Pizarrón</a>

	  <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='principal' aria-expanded='false' aria-label='Toggle navigation'>
		<span class='navbar-toggler-icon'></span>
	  </button>
		  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
			<ul class='navbar-nav mr-auto'>";
			echo"<li class='nav-item active'><a class='nav-link barranav' title='Mostrar todo' id='lista_comision' data-lugar='admin/blog_lista'><i class='fas fa-list-ul'></i><span>Lista</span></a></li>";
      echo"<li class='nav-item active'><a class='nav-link barranav izq' title='Nuevo' id='new_personal' data-lugar='admin/blog_editar'><i class='fas fa-plus'></i><span>Nuevo</span></a></li>";
			echo "</ul>";

			echo "<form class='form-inline my-2 my-lg-0' id='consulta_avanzada' action='' data-destino='a_personal/lista' data-funcion='guardar' data-div='trabajo'>
			<input class='form-control mr-sm-2' type='search' placeholder='Busqueda global' aria-label='Search' name='valor' id='valor'>
			<div class='btn-group'>
			<button class='btn btn-outline-secondary btn-sm' type='submit' title='Buscar' ><i class='fas fa-search'></i></button>
			</div>
			</form>";
		echo "
	  </div>
	</nav>";
	echo "<div id='trabajo'>";
		include 'blog_lista.php';
	echo "</div>";
?>

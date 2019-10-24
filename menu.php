<div class="sidebar" data-color="azure" data-image="assets/img/sidebar-5.jpg">

	<div class="sidebar-wrapper">
		<div class="logo">
			<a href="https://www.easytarget.com.mx" class="simple-text">
				Sunnergy
			</a>
		</div>
		
		<?php
			echo "<div class='container'>";
			echo "Usuario: <b>".$_SESSION['user']."</b><br>";
			echo "Tienda: <b>".$_SESSION['tienda']."</b><br>";
			echo "</div>";
		?>
		
		<ul class="nav">
			<li class="active">
				<a href="principal.php">
					<i class="pe-7s-graph"></i>
					<p>Mi Tablero</p>
				</a>
			</li>
			
			<li class="active">
				<a href="ventas.php">
					<i class="pe-7s-graph"></i>
					<p>Ventas</p>
				</a>
			</li>
			
			<?php
				if($_SESSION['nivel']==1){
					echo '<li class="active">
						<a href="compras.php">
							<i class="pe-7s-graph"></i>
							<p>Compras</p>
						</a>
					</li>';
				}
			?>
				
			<li class="active">
				<a href="inventario.php">
					<i class="pe-7s-graph"></i>
					<p>Inventario</p>
				</a>
			</li>
			
			
			
			<?php
				if($_SESSION['nivel']==1){
					echo '<li class="active">
						<a href="proveedores.php">
							<i class="pe-7s-graph"></i>
							<p>Proveedores</p>
						</a>
					</li>';
					
					echo '<li class="active">
						<a href="tienda.php">
							<i class="pe-7s-graph"></i>
							<p>Tienda</p>
						</a>
					</li>';
				}
			?>
			
			<li class="active">
				<a href="traspasos.php">
					<i class="pe-7s-graph"></i>
					<p>Traspasos</p>
				</a>
			</li>
			
		</ul>
		
			
		
	
	</div>
</div>
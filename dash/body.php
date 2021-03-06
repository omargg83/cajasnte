<?php
	require_once("db_.php");
?>
<div class='wrapper'>
  <div class='content navbar-default'>
    <div class='container-fluid'>
      <div class='sidebar sidenav' id='navx'>
        <?php
        $nombre=$_SESSION['nombre']." ".$_SESSION['ape_pat']." ".$_SESSION['ape_mat'];
        echo "<div class='text-center'>";
          echo $_SESSION['filiacion']."<br>";
          echo $nombre;
        echo "</div>";


        if($_SESSION['administrador']==1){
          echo "<hr>
          <a href='#dash/index' class='activeside'><i class='fas fa-home'></i> <span>Inicio</span></a>
          <a href='#admin/bloques' title='Bloques'><i class='far fa-check-square'></i><span>Actualizar</span></a>
          <a href='#admin/blog' title='Bloques'><i class='fas fa-rss-square'></i><span>Anuncios</span></a>
          <a href='#admin/bitacora' title='Bitacora'><i class='fas fa-clipboard-list'></i><span>Bitacora</span></a>
          <a href='#pass/index' title='Cambio de contraseña'><i class='fas fa-key'></i><span>Contraseñas</span></a>
          <a href='#citas/index2' title='Creditos'><i class='far fa-calendar-check'></i><span>Citas</span></a>
					<a href='#dias/index' title='dias'><i class='far fa-calendar-check'></i><span>Dias Retiros NO</span></a>
					<a href='#dias2/index' title='dias2'><i class='far fa-calendar-check'></i><span>Dias Creditos NO</span></a>";
        }
        else{
          echo "<hr>";
          $row=$db->blo_lista();

          echo "<a href='#dash/index' class='activeside'><i class='fas fa-home'></i> <span>Inicio</span></a>";

          //////////////////datos
          echo "<a href='#afiliado/datos' title='Datos'><i class='fas fa-users-cog'></i> <span>Datos";
          $fecha_actual = strtotime(date("Y-m-d H:i:s",time()));
          $fecha_entrada = strtotime(fecha($row['fusuario']));
          if($fecha_actual <= $fecha_entrada){
              echo "<span class='badge badge-pill badge-warning'><i class='fas fa-pencil-alt'></i></span>";
          }
          echo "</span></a>";

          /////////////////aportacion
          echo "<a href='#aportacion/aportacion' title='Aportación'><i class='far fa-money-bill-alt'></i> <span>Aportación";
          $fecha_actual = strtotime(date("Y-m-d H:i:s",time()));
          $fecha_entrada = strtotime(fecha($row['faportacion']));
          if($fecha_actual <= $fecha_entrada){
              echo "<span class='badge badge-pill badge-warning'><i class='fas fa-pencil-alt'></i></span>";
          }
          echo "</span></a>";				/////////////// listo

          //////////////////beneficiarios
          echo "<a href='#beneficiarios/beneficiarios' title='Beneficiarios'><i class='fas fa-users'></i> <span>Beneficiarios";
          $fecha_actual = strtotime(date("Y-m-d H:i:s",time()));
          $fecha_entrada = strtotime(fecha($row['fbeneficiarios']));
          if($fecha_actual <= $fecha_entrada){
              echo "<span class='badge badge-pill badge-warning'><i class='fas fa-pencil-alt'></i></span>";
          }
          echo "</span></a>";				/////////////// listo

					echo "<hr> <a href='#afiliado/acceso' title='Cambio de correo electronico y celular'><i class='fas fa-at'></i> <span>Cambiar Correo</span></a>
					<a href='#afiliado/pass' title='Contraseña'><i class='fas fa-key'></i> <span>Contraseña</span></a><hr>";


          echo"<a href='#creditos/credito' title='Consulta de Creditos'><i class='fas fa-money-check-alt'></i><span>Créditos</span></a>";
          echo"<a href='#ahorro/ahorro' title='Consulta de Ahorro'><i class='fas fa-university'></i> <span>Ahorro</span></a>";

					echo "<hr>";
					echo"<a href='#citas/index' title='Agendar Cita en caja de ahorro'><i class='far fa-calendar-check'></i><span>Citas</span></a>";
					echo"<a href='#bancos/datos' title='Ingresar cuenta bancaria para deposito de ahorro'><i class='fas fa-university'></i> <span>Bancos</span></a>";


					$fecha_actual = strtotime(date("Y-m-d H:i:s",time()));
					$fecha_entrada = strtotime(fecha($row['fretiro']));
					if($fecha_actual <= $fecha_entrada){
						echo"<a href='#formatos/format' title='Formatos'><i class='fas fa-print'></i><span>Formatos de retiro</span></a>";
					}
					echo "<hr>";

        }
      ?>
      </div>
    </div>

		<?php
			$alerta=$db->blog_alerta();
			echo "<div class='container' id='alerta_div'>";
			foreach($alerta as $key){
				echo "<div class='alert alert-success'>";
				echo $key['corto'];
				echo "</div>";
			}
			echo "</div>";
		?>
    <div class='fijaproceso main' id='contenido'>
    </div>
  </div>
</div>

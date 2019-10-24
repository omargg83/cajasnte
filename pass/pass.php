<?php
	include '../conn.php';
	
	$tipo=$_REQUEST['tipo'];
	if($tipo=="password"){
?>
		<form id="form" accept-charset="utf-8">	
			<div class='card'>
				<div class='card-header'><b>Cambiar contraseña</b>
				</div>
				<div class='card-body'>		
					<div class="form-group input-group">
						<label class="col-md-4 control-label" for="pass1">Contraseña</label>  
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
						</div>
						<input class="form-control" placeholder="Contraseña" type="password" id="pass1" name="pass1" required>
					</div>
					
					<div class="form-group input-group">
						<label class="col-md-4 control-label" for="pass2">Repetir contraseña</label>  
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
						</div>
						<input class="form-control" placeholder="Repetir Contraseña" type="password"  id="pass2" name="pass2" required>
					</div>
					
					<div class="form-group">
						<button type='submit' class="btn btn-warning cambiar" data-form="password"><i class="far fa-save"></i> Cambiar </button>
					</div>
				</div>
			</div>
		</form>

	
	<?php
	}
	if($tipo=="acceso"){
		$sql="select * from afiliados where idfolio='".$_SESSION['idfolio']."'";
		$row=mysqli_fetch_array(mysqli_query($link,$sql));
		$correo=$row['correo'];
		$celular=$row['celular'];
		
	?>
	
	<form accept-charset="utf-8">	
			<div class='card'>
				<div class='card-header'><b>Cambiar acceso</b>
				</div>
				<div class='card-body'>		
					<div class="form-group input-group">
						<label class="col-md-4 control-label" for="pass1">Correo</label>  
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="far fa-envelope-open"></i> </span>
						</div>
						<input class="form-control" placeholder="Correo" type="text" id="correo" name="correo" value='<?php echo $correo; ?>'>
					</div>
					
					<div class="form-group input-group">
						<label class="col-md-4 control-label" for="pass2">Cambiar telefono</label>  
						<div class="input-group-prepend">
							<span class="input-group-text"> <i class="fas fa-mobile-alt"></i> </span>
						</div>
						<input class="form-control" placeholder="Cambiar telefono" type="text"  id="telefono" name="telefono" value='<?php echo $celular; ?>'>
					</div>
					
					<div class="form-group">
						<button type='submit' class="btn btn-warning guardar" data-form="correo" ><i class="far fa-save"></i> Guardar</button>
					</div>
				</div>
			</div>
		</form>
		
	<?php
	}
	
	?>
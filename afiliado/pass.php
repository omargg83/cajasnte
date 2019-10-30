<?php
	require_once("../control_db.php");
?>
<div class='container'>
<form id='form_comision' action='' data-lugar='control_db' data-funcion='guardar_pass'>
  <input class="form-control" type="hidden" id="id" name="id" value='<?php echo $_SESSION['idfolio']; ?>'>
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
    </div>

    <div class='card-footer'>
      <div class="btn-group">
        <button type='submit' class="btn btn-warning btn-sm" ><i class="far fa-save"></i> Guardar</button>
      </div>
    </div>
    </div>
  </div>
</form>
</div>

<?php
  require_once("../control_db.php");
  $row=$db->afiliado();
  $correo=$row['correo'];
  $celular=$row['celular'];
 ?>

<div class='container'>
  <form id='form_comision' action='' data-lugar='control_db' data-funcion='guardar_acceso'>
    <input class="form-control" type="hidden" id="id" name="id" value='<?php echo $_SESSION['idfolio']; ?>'>
    <div class='card'>

      <div class='card-header'>
        <img src='img/caja.png' width='20' alt='logo'> -
        Cambiar acceso
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
          <label class="col-md-4 control-label" for="pass2">Cambiar teléfono</label>
          <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fas fa-mobile-alt"></i> </span>
          </div>
          <input class="form-control" placeholder="Cambiar teléfono" type="text"  id="telefono" name="telefono" value='<?php echo $celular; ?>'>
        </div>
      </div>
      <div class='card-footer'>
        <div class="btn-group">
          <button type='submit' class="btn btn-warning btn-sm" ><i class="far fa-save"></i> Guardar</button>
          <a class='btn btn-warning btn-sm' href='#afiliado/index' title='regresar'><i class='fas fa-undo-alt'></i>Regresar</a>
        </div>
      </div>
    </div>
  </form>
</div>

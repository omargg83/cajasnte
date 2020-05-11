<?php
	require_once("db_.php");
  if($_SESSION['administrador']!=1){
    exit();
  }

  $fecha=date("d-m-Y");
  $nuevafecha = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
  $fecha1 = date ( "d-m-Y" , $nuevafecha );

  ?>
  <form id='consulta_avanzada' action='' data-destino='admin/reporte1' data-div='resultado' data-funcion='reporte_1' autocomplete='off'>
    <div class='container' >
      <div class='jumbotron'>
        <h5><center>Operaciones</center></h5>
        <div class='row'>
          <div class='col-6'>
              <label>Del</label>
              <input class="form-control fechaclass" placeholder="Desde...." type="text" id='desde' name='desde' value='<?php echo $fecha1; ?>' autocomplete="off">
          </div>

          <div class='col-6'>
            <label>Al</label>
            <input class="form-control fechaclass" placeholder="Hasta...." type="text" id='hasta' name='hasta' value='<?php echo $fecha; ?>' autocomplete="off">
          </div>

        </div>

        <div class='row'>
          <div class='col-sm-4'>
            <div class='btn-group'>
              <button title='Buscar' class='btn btn-warning btn-sm' id='buscar_canalizado' type='submit' id='lista_buscar'><i class='fa fa-search'></i><span> Consultar</span></button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </form>

  <div id='resultado'>

  </div>

  <script>
  $(function() {
    fechas();
  });
  </script>

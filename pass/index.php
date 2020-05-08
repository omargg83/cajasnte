<?php
  require_once("../control_db.php");
?>

 <nav class='navbar navbar-expand-sm navbar-light bg-light'>
 		  <a class='navbar-brand' ><i class="fas fa-key"></i>Contraseñas</a>
 		  <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
 			<span class='navbar-toggler-icon'></span>
 		  </button>
 		  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
 			<ul class='navbar-nav mr-auto'>
        <div class='form-inline my-2 my-lg-0' id='daigual' action='' >
          <div class="input-group  mr-sm-2">
            <input type="text" class="form-control form-control-sm" placeholder="Buscar afiliado" aria-label="Buscar" aria-describedby="basic-addon2"  id='buscar' onkeyup='Javascript: if (event.keyCode==13) buscarx()'>
            <div class="input-group-append">
              <button class="btn btn-outline-secondary btn-sm" type="button" onclick='buscarx()'><i class='fas fa-search'></i></button>
            </div>
          </div>
				</div>
 			</li>
 			</ul>
 		</div>
 	  </div>
 	</nav>

<?php

   echo "<div id='trabajo' style='margin-top:5px;'>";
    include 'lista.php';
   echo "</div>";

 ?>
<script type="text/javascript">
  function buscarx(){
    var buscar = $("#buscar").val();
    $.ajax({
      data:  {
        "buscar":buscar
      },
      url:   'pass/lista.php',
      type:  'post',
      success:  function (response) {
        $("#trabajo").html(response);
      }
    });
  }
  function reset_pass(folio){
    $.confirm({
			title: 'Contraseña',
			content: '¿Desea reestablecer la contraseña de afiliado seleccionado?',
			buttons: {
				Aceptar: function () {
					$.ajax({
						data:  {
  						"folio":folio,
  						"function":"reset_pass"
  					},
						url: "control_db.php",
						type:  'post',
						timeout:10000,
						success:  function (response) {
              if (!isNaN(response)){
                Swal.fire({
                  type: 'success',
                  title: "Se reestablecio la contraseña correctamente",
                  showConfirmButton: false,
                  timer: 1000
                });
              }
              else{
                Swal.fire({
                  type: 'error',
                  title: "error favor de verificar",
                  showConfirmButton: false,
                  timer: 1000
                });
              }
						},
						error: function(jqXHR, textStatus, errorThrown) {
							if(textStatus==="timeout") {
								Swal.fire({
								  type: 'error',
								  title: textStatus,
								  showConfirmButton: false,
								  timer: 700
								});
							}
						}
					});
				},
				Cancelar: function () {

				}
			}
		});
  }

</script>

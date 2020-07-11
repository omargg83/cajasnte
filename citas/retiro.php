<?php
	require_once("db_.php");

	////////////////////////////////////con esto se bloquea por 5 meses las citas
		$fecha=date("Y-m-d H:i:s");
		$nuevafecha = strtotime ( '+5 month' , strtotime ( date("Y-m-d H:i:s") ) ) ;
		$fecha1 = date ( "Y-m-d H:i:s" , $nuevafecha );

		$sql="select * from citas where idfolio='".$_SESSION['idfolio']."' and (fecha between '$fecha' and '$fecha1') and tipo=1 and apartado=2";
		$sth = $db->dbh->query($sql);
		$no_citas=$sth->rowCount();
		$resp=$sth->fetchAll(PDO::FETCH_OBJ);

		$sql="select * from citas where idfolio='".$_SESSION['idfolio']."' and (fecha between '$fecha' and '$fecha1') and tipo=1 and apartado=3";
		$sth = $db->dbh->query($sql);
		$canceladas=$sth->rowCount();
		$resp=$sth->fetchAll(PDO::FETCH_OBJ);
		if($no_citas>0 or $canceladas>1){
			echo "<script>
			Swal.fire({
		type: 'error',
  	title: 'Lo sentimos',
		showConfirmButton: false,
		timer: 5000,
  	text: 'Ha usado el maximo de citas y/o cancelaciones permitidas',
  	footer: 'Favor de comunicarse directamente a Caja de ahorro'
		})
			</script>";
			return 0;
		}
	//////////////////////////////////////////hasta aqui el bloqueo

  $fecha=date("d-m-Y");
  $nuevafecha = strtotime ( '+9 day' , strtotime ( $fecha ) ) ;
  $fecha1 = date ( "d-m-Y" , $nuevafecha );

echo "<div class='card'>";
  echo "<div class='card-header'>";
    echo "Citas para retiro";
  echo "</div>";
  echo "<div class='card-body'>";
    echo "<div class='row'>";
      echo "<div class='col-3'>";
          echo "<label>Seleccione el dia a partir del 15 de julio del 2020</label>";
			echo "</div>";
			echo "<div class='col-2'>";
          echo "<input class='form-control fechacita' placeholder='Fecha' type='text' id='desde' name='desde' value='$fecha1' autocomplete='off' readonly>";
      echo "</div>";
			echo "<div class='col-3'>";
        echo "<select class='form-control' name='hora' id='hora'>";
					echo  "<option value='asignar'>Búsqueda automática</option>";
					for($i=9; $i<=16; $i++){
						echo "<optgroup label='$i'>";
						for($j=0; $j<=55; $j=$j+5){
							$t=str_pad($j,2,"0",STR_PAD_LEFT);
							echo  "<option value='$i:$t'>$i:$t</option>";
						}
						echo "</optgroup>";
					}
        echo  "</select>";
      echo "</div>";
      echo "<div class='col-3'>";
        echo "<button class='btn btn-warning btn-sm' id='data' type='button' onclick='verificar(1)'><i class='far fa-calendar-check'></i>Comprobar disponibilidad</button>";
      echo "</div>";
    echo "</div>";
  echo "</div>";
echo "</div>";
?>

 <script>

 $(function() {
	 var holidayDates = new Array();

	 $.ajax({
     url: "citas/dias_bloqueo.php",
     type: "POST",
     timeout:1000,
     beforeSend: function () {

     },
     success:function(response){
			var data = JSON.parse(response);
			for (var i = 0, len = data.length; i < len; i++) {
				holidayDates.push(data[i].dia);
	    }
     }
   });

   $.datepicker.regional['es'] = {
      closeText: 'Cerrar',
      prevText: 'Mes anterior',
      nextText: 'Mes siguiente',
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
      weekHeader: 'Sm',
      dateFormat: 'dd-mm-yy',
      firstDay: 0,
      isRTL: false,
      minDate: +1,
			maxDate: "+5M",
      numberOfMonths: 1,
      showMonthAfterYear: false,
      yearSuffix: '',
			beforeShowDay: function(date){
					var day = date.getDay();
	        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
	        return [ day != 0 && day != 6 && holidayDates.indexOf(string) == -1 ]
	    }
    };

   $.datepicker.setDefaults($.datepicker.regional['es']);
   $(".fechacita").datepicker();
 });
 </script>

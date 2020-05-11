<?php
	require_once("db_.php");

  $fecha=date("d-m-Y");
  $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
  $fecha1 = date ( "d-m-Y" , $nuevafecha );

echo "<div class='card'>";
  echo "<div class='card-header'>";
    echo "Citas para credito";
  echo "</div>";
  echo "<div class='card-body'>";
    echo "<div class='row'>";
      echo "<div class='col-6'>";
          echo "<label>Dia</label>";
          echo "<input class='form-control fechacita' placeholder='Fecha' type='text' id='desde' name='desde' value='$fecha1' autocomplete='off' readonly>";
      echo "</div>";
      echo "<div class='col-3'>";
        echo "<label>Hora</label>";
        echo "<select class='form-control' name='hora' id='hora'>";
          echo  "<option value='9'>9</option>";
          echo  "<option value='10'>10</option>";
          echo  "<option value='11'>11</option>";
          echo  "<option value='12'>12</option>";
          echo  "<option value='13'>13</option>";
          echo  "<option value='14'>14</option>";
          echo  "<option value='15'>15</option>";
          echo  "<option value='16'>16</option>";
          echo  "<option value='17'>17</option>";
          echo  "<option value='18'>18</option>";
        echo  "</select>";
      echo "</div>";
      echo "<div class='col-3'>";
        echo "<label>Minuto</label>";
        echo "<select class='form-control' name='minuto' id='minuto'>";
          echo  "<option value='00'>00</option>";
          echo  "<option value='10'>10</option>";
          echo  "<option value='20'>20</option>";
          echo  "<option value='30'>30</option>";
          echo  "<option value='40'>40</option>";
          echo  "<option value='50'>50</option>";
        echo  "</select>";
      echo "</div>";
    echo "</div>";
    echo "<div class='row'>";
      echo "<div class='col-12'>";
        echo "<button class='btn btn-warning btn-sm' id='data' type='button' onclick='verificar(2)'><i class='far fa-calendar-check'></i>Comprobar disponibilidad</button>";
      echo "</div>";
    echo "</div>";
  echo "</div>";
echo "</div>";


 ?>

 <script>
 $(function() {
   $.datepicker.regional['es'] = {
      closeText: 'Cerrar',
      yearRange: '2020:2021',
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
      numberOfMonths: 1,
      showMonthAfterYear: false,
      beforeShowDay: $.datepicker.noWeekends,
      yearSuffix: ''
    };

   $.datepicker.setDefaults($.datepicker.regional['es']);
   $(".fechacita").datepicker();
 });
 </script>

<?php
	require_once("../control_db.php");
	$resp=$db->creditos();
?>
<div class='container'>
	<div class='card'>
		<div class='card-header'>
		<?php
		echo "<div class='row'>";
			echo  "<div class='col-sm-2'>";
				echo "<label>";
				echo "Seleccione un crédito";
				echo "</label>";
			echo "</div>";
			echo  "<div class='col-sm-10'>";
				echo "<select class='form-control' name='clv_cred' id='clv_cred' class='form-control' onclick='clv_cred()'>";
				echo "<option value='' disabled selected style='color: silver;'>Seleccione un credito</option>";
					foreach($resp as $key){
						echo  "<option value='".$key['clv_cred']."'>#".$key['clv_cred']." ".$key['fecha']." : ".number_format($key['monto'],2)."</option>";
					}
				echo  "</select>";
			echo "</div>";
		echo "</div>";
		?>
		</div>
		<div class='card-body' id='datos_cred'>
		</div>
	</div>
</div>
	<script type="text/javascript">

	function clv_cred(){
		var id=$("#clv_cred").val();
		var xyId = 0;
		 $.ajax({
				data:  {
					"clv_cred":id
				},
				url:  "creditos/datos.php",
				type:  'post',
			beforeSend: function () {
				$("#datos_cred").html("<div class='container' style='background-color:white; width:300px'><center><img src='img/carga1.gif' width='100px'></center></div>");
			},
			success:  function (response) {
				$("#datos_cred").html('');
				$("#datos_cred").html(response);
			}
		});
	}

	</script>

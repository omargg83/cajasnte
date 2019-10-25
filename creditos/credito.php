<?php
	require_once("../control_db.php");
?>
	<div class='card'>
		<div class='card-header'>
		<?php
		/*
		$sql="select * from creditos where filiacion='".$_SESSION['filiacion']."'";
		$resp=mysqli_query($link,$sql);*/
		echo "<div class='row'>";
			echo  "<div class='col-sm-2'>";
				echo "<label>";
				echo "Seleccione un crédito";
				echo "</label>";
			echo "</div>";
			echo  "<div class='col-sm-10'>";
				echo "<select class='form-control' name='clv_cred' id='clv_cred' class='form-control'>";
				echo "<option value='' disabled selected style='color: silver;'>Seleccione un credito</option>";
				/*
					while ($row1 = mysqli_fetch_array($resp)){
						echo  "<option value='".$row1['clv_cred']."'>#".$row1['clv_cred']." ".$row1['fecha']." : ".number_format($row1['monto'],2)."</option>";
					}
					*/
				echo  "</select>";
			echo "</div>";
		echo "</div>";
		?>
		</div>
		<div class='card-body' id='datos_cred'>
		</div>
	</div>

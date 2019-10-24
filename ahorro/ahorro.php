<?php
	include '../conn.php';
	$id=$_SESSION['idfolio'];
	
	$anio_tmp=date("Y");
	
		$sql="select idfolio,anio,ahorrototal,saldofinal,saldo_anterior,monto,interes,montointeres,interestotal, 
		if (retiro=1,'R',ROUND(quincena,0)) as quin_nombre,observaciones from registro where idfolio='$id' and anio='$anio_tmp'
		order by anio,quincena,idregistro asc";
		$resp=mysqli_query($link,$sql);
		
		$sql="select sum(monto) as monto,sum(montointeres) as interesx from registro where idfolio='$id' and anio='$anio_tmp'";
		$ahortmp=mysqli_query($link,$sql);
		$ahorronum=mysqli_num_rows($ahortmp);
		$ahorro=mysqli_fetch_array($ahortmp);
		
		echo "<div class='card'>
		  <div class='card-header'><b>Caja de ahorro</b></div>";
			echo "<div class='card-body'>";
				echo "<div class='row'>";
					/////////INTERES AÑO Anterior
					$ANIX=$anio_tmp-1;
					$sql="select SUM(montointeres) as interestotal from registro where idfolio='$id' and anio='$ANIX' order by anio,quincena";
					$anio_ant_interes=mysqli_fetch_array(mysqli_query($link,$sql));
					
					// echo  "<div class='col-sm-3'>";
						// echo "<div class='form-group'>";
							// echo "<label for='idfolio'>Interes Año Anterior</label>";
							// echo "<input class='form-control moneda' type='text' id='idfolio' NAME='idfolio' value='".number_format($anio_ant_interes['interestotal'],2)."' placeholder='Interes Año Anterior' readonly>";
						// echo "</div>";
					// echo "</div>";
					
					
					
					$P_INTERESANTERIOR=$anio_ant_interes['interestotal'];


					$csql="select * from registro where idfolio='$id' and anio<$anio_tmp order by anio desc,quincena desc";
					$anio_ant=mysqli_fetch_array(mysqli_query($link,$csql));
					$xahorro_anterior=$anio_ant['saldofinal']-$P_INTERESANTERIOR;
					
					//////////////////////////Ahorro anterior
					// echo  "<div class='col-sm-3'>";
						// echo "<div class='form-group'>";
							// echo "<label for='idfolio'>Ahorro Anterior</label>";
							// echo "<input class='form-control moneda' type='text' id='idfolio' NAME='idfolio' value='".number_format($xahorro_anterior,2)."' placeholder='Ahorro Año Anterior' readonly>";
						// echo "</div>";
					// echo "</div>";
					
					// echo  "<div class='col-sm-3'>";
						// echo "<div class='form-group'>";
							// echo "<label for='idfolio'>Saldo Anterior</label>";
							// echo "<input class='form-control moneda' type='text' id='idfolio' NAME='idfolio' value='".number_format($anio_ant['saldofinal'],2)."' placeholder='Saldo Año Anterior' readonly>";
						// echo "</div>";
					// echo "</div>";
					
					
					///////////////////
					
					
					
					$sql="select sum(monto) as monto from registro where idfolio=$id and anio='$anio_tmp' and monto>=0";
					$ahorro_tmp=mysqli_fetch_array(mysqli_query($link,$sql));		
					// //////Ahorro actual
					// echo  "<div class='col-sm-3'>";
						// echo "<div class='form-group'>";
							// echo "<label for='idfolio'>Ahorro actual</label>";
							// echo "<input class='form-control  moneda' type='text' id='idfolio' NAME='idfolio' value='".number_format($ahorro_tmp['monto'],2)."' placeholder='Ahorro actual' readonly>";
						// echo "</div>";
					// echo "</div>";
					
					
					$sql="select sum(monto) as montoxy from registro where idfolio='$id' and anio='$anio_tmp' and registro.monto<0";
					$retiro_tmp=mysqli_fetch_array(mysqli_query($link,$sql));
					// ////retiro actual
					// echo  "<div class='col-sm-3'>";
						// echo "<div class='form-group'>";
							// echo "<label for='idfolio'>Retiro anual</label>";
							// echo "<input class='form-control moneda' type='text' id='idfolio' NAME='idfolio' value='".number_format($retiro_tmp['montoxy'],2)."' placeholder='Retiro anual' readonly >";
						// echo "</div>";
					// echo "</div>";
					
					$sql="select sum(monto) as ahorroanual from registro where idfolio='$id' and anio='$anio_tmp' and registro.monto>0";
					$ahorro_anual=mysqli_fetch_array(mysqli_query($link,$sql));
				
					// ///////////AHORRO TOTAL
					// echo  "<div class='col-sm-3'>";
						// echo "<div class='form-group'>";
							// echo "<label for='idfolio'>Ahorro total actual</label>";
							// echo "<input class='form-control  moneda' type='text' id='idfolio' NAME='idfolio' value='".number_format($ahorro_anual['ahorroanual'],2)."' placeholder='Ahorro Total' readonly>";
						// echo "</div>";
					// echo "</div>";
				
					$sql="select idfolio,anio,ahorrototal,saldofinal,saldo_anterior,monto,interes,montointeres,interestotal,if (retiro=1,'R',ROUND(quincena,0)) as quin_nombre,observaciones from registro where idfolio='$id' order by anio desc,quincena desc,idregistro desc";
					$saldofinal=mysqli_fetch_array(mysqli_query($link,$sql));
				
					if ($ahorronum==0){
						$val=number_format($saldofinal['saldofinal'],2);
					}
					else{
						$val=number_format($saldofinal['saldofinal']-$ahorro['interesx'],2);
					}	
					//////////////DISPONIBLE
					echo  "<div class='col-sm-3'>";
						echo "<div class='form-group'>";
							echo "<label for='idfolio'>Disponible anual</label>";
							echo "<input class='form-control  moneda' type='text' id='idfolio' NAME='idfolio' value='$ ".$val."' placeholder='Disponible anual' readonly>";
						echo "</div>";
					echo "</div>";
					
					
					////////interes
					echo  "<div class='col-sm-3'>";
						echo "<div class='form-group'>";
							echo "<label for='idfolio'>Interes anual</label>";
							echo "<input class='form-control moneda' type='text' id='idfolio' NAME='idfolio' value='$ ".number_format($ahorro['interesx'],2)."' placeholder='Interes anual' readonly>";
						echo "</div>";
					echo "</div>";
					
					// echo  "<div class='col-sm-2 col-md-offset-6'>";
						// echo "<div class='form-group'>";
							// echo "<label for='idfolio'>Hoy ya tienes</label>";
							// echo "<input class='form-control' type='text' id='idfolio' NAME='idfolio' value='".number_format($saldofinal['saldofinal'],2)."' placeholder='Hoy ya tienes' readonly dir=rtl>";
						// echo "</div>";
					// echo "</div>";
				
				echo "</div>";
			echo "</div>";
			
			echo "<div class='card-footer'>";
				echo "<div class='row'>";
					echo "<div class='col-sm-2'>";
						echo "<div class='btn-group'>";
						echo "<button class='btn btn-warning' id='imprime_A'>
							  <i class='fa fa-print'></i> Imprimir
							</button>";
						echo "</div>";
					echo "</div>";

					echo "<div class='col-sm-2'>";
					echo "<label for='idfolio'>Periodo:</label>";
					echo "</div>";
					echo "<div class='col-sm-2'>";
					echo "<select class='form-control' name='periodo' id='periodo' class='form-control'>";
					echo "<option value='' disabled selected style='color: silver;'>Seleccione un periodo</option>";
						$contar=date("Y")-1;
						while ($contar<=date("Y")){
							echo  "<option value='$contar' selected>$contar</option>";
							$contar++;
						}
					echo  "</select>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";	
		
			
		
		echo "<div class='card'>
		  <div class='card-header'>Registro</div>";
			
				echo "<table class='table table-striped table-sm'>";			
				echo "<tr>";
				echo "<th><center>Año</center></th>";
				echo "<th><center>Quincena</center></th>";
				// echo "<th>Saldo anterior</th>";
				echo "<th><center>Retiro</center></th>";
				echo "<th><center>Monto</center></th>";
				// echo "<th>Interes</th>";
				// echo "<th>Monto de interes</th>";
				// echo "<th>Interes total</th>";
				// echo "<th>Ahorro total</th>";
				// echo "<th>Saldo Final</th>";
				// echo "<th>Observaciones</th>";
				echo "</tr>";
				echo "</thead><tbody>";
				$anio=0;
				$monto=0;
				$int_ant=0;
				while($row=mysqli_fetch_array($resp)){
					if($anio!=$row['anio']){
						$anio=$row['anio'];
						$int_ant=0;
					}
					$int_ant=$int_ant+$row['montointeres'];
					$s_final=$row['saldofinal'] - $int_ant;
									
					echo "<tr>";
						echo "<td><center>";
						echo $row['anio'];
						echo "</center></td>";
						
						echo "<td><center>";
						echo $row['quin_nombre'];
						echo "</center></td>";

						if ($row['monto']>0){
							echo "<td>";
							echo "</td>";
							echo "<td style='text-align: right;'>";
							echo number_format($row['monto'],2);
							echo "</td>";
						}
						else{
							echo "<td style='text-align: right;'>";
							echo $s_final;
							echo "</td>";
						}
						
					echo "</tr>";
				}
				
				echo "</table>";
		echo "</div>";
		
?>
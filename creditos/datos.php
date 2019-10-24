<?php
	include '../conn.php';
	$clv_cred = $_REQUEST['parametros'];
	$id=$_SESSION['idfolio'];
	
	$csql="SELECT clv_cred,crx.idfolio,fecha,crx.monto,observa,crx.estado,plazo,if(crx.estado=1,'ACTIVO','INACTIVO') as cred_esta,interes,crx.total,crx.quin_ini,crx.anio_ini,crx.quin_fin,crx.anio_fin,nocheque,aportacion,(select saldo_actual from detallepago where idcredito=crx.clv_cred order by anio desc,quincena desc,iddetalle limit 1) as saldo_actual FROM creditos crx where crx.clv_cred='$clv_cred'";
		
	$dat_credito=mysqli_fetch_array(mysqli_query($link,$csql));

		/////////////////////////////////////////////////
		$txt_estado=$dat_credito['cred_esta'];
		$txt_plazo=$dat_credito['plazo'];
		$txt_cheque=$dat_credito['nocheque'];
		
		$txt_monto=$dat_credito['monto'];
		$P_MONTO=$dat_credito['monto'];
		
		$txt_interes=$dat_credito['interes'];
		$P_INTERES=$dat_credito['interes'];
		
		$txt_total=$dat_credito['total'];
		$P_TOTAL=$dat_credito['total'];
		
		$txt_qini=$dat_credito['quin_ini']."/".$dat_credito['anio_ini'];
		$txt_qfin=$dat_credito['quin_fin']."/".$dat_credito['anio_fin'];
		
		$txt_credito=$dat_credito['clv_cred'];
		$txt_observaciones=$dat_credito['observa'];
		
		$txt_aportacion=$dat_credito['aportacion'];
		
		$csql="select SUM(monto) as aporta from detallepago where idcredito='$clv_cred' order by anio,quincena,iddetalle";
		$aportax=mysqli_fetch_array(mysqli_query($link,$csql));
		$txt_abono=$aportax['aporta'];
			
		$s_saldo=$dat_credito['total']-$aportax['aporta'];
		$txt_saldo=$s_saldo;
	
				echo "<div class='row'>";
					echo  "<div class='col-sm-2'>";
						echo "<div class='form-group'>";
							echo "<label for='txt_credito'><b>Crédito</b></label>";
							echo "<input class='form-control' type='text' id='txt_credito' NAME='txt_credito' value='".$txt_credito."' placeholder='Crédito' readonly>";
						echo "</div>";
					echo "</div>";
				
					echo  "<div class='col-sm-2'>";
						echo "<div class='form-group'>";
							echo "<label for='txt_qini'>Q.Inicial</label>";
							echo "<input class='form-control' type='text' id='txt_qini' NAME='txt_qini' value='".$txt_qini."' placeholder='Q.Inicial' readonly>";
						echo "</div>";
					echo "</div>";
					
					echo  "<div class='col-sm-2'>";
						echo "<div class='form-group'>";
							echo "<label for='txt_qfin'>Q.Final</label>";
							echo "<input class='form-control' type='text' id='txt_qfin' NAME='txt_qfin' value='".$txt_qfin."' placeholder='Q.Final' readonly>";
						echo "</div>";
					echo "</div>";
					echo  "<div class='col-sm-2'>";
						echo "<div class='form-group'>";
							echo "<label for='txt_monto'>Monto Credito</label>";
							echo "<input class='form-control moneda' type='text' id='txt_monto' NAME='txt_monto' value='".number_format($txt_monto,2)."' placeholder='Monto Credito' readonly>";
						echo "</div>";
					echo "</div>";
					
					echo  "<div class='col-sm-2'>";
						echo "<div class='form-group'>";
							echo "<label for='txt_interes'>Interés</label>";
							echo "<input class='form-control moneda' type='text' id='txt_interes' NAME='txt_interes' value='".number_format($txt_interes,2)."' placeholder='Interés' readonly>";
						echo "</div>";
					echo "</div>";
					
					echo  "<div class='col-sm-2'>";
						echo "<div class='form-group'>";
							echo "<label for='txt_total'>Credito total</label>";
							echo "<input class='form-control moneda' type='text' id='txt_total' NAME='txt_total' value='".number_format($txt_total,2)."' placeholder='Credito total' readonly>";
						echo "</div>";
					echo "</div>";
					
					echo  "<div class='col-sm-2'>";
						echo "<div class='form-group'>";
							echo "<label for='txt_abono'>Abono</label>";
							echo "<input class='form-control moneda' type='text' id='txt_abono' NAME='txt_abono' value='".number_format($txt_abono,2)."' placeholder='Abono' readonly>";
						echo "</div>";
					echo "</div>";
				
					echo  "<div class='col-sm-2'>";
						echo "<div class='form-group'>";
							echo "<label for='txt_saldo'>Saldo</label>";
							echo "<input class='form-control moneda' type='text' id='txt_saldo' NAME='txt_saldo' value='".number_format($txt_saldo,2)."' placeholder='Saldo' readonly>";
						echo "</div>";
					echo "</div>";
					
					echo  "<div class='col-sm-2'>";
						echo "<div class='form-group'>";
							echo "<label for='txt_estado'>Estado</label>";
							echo "<input class='form-control' type='text' id='txt_estado' NAME='txt_estado' value='".$txt_estado."' placeholder='Estado' readonly>";
						echo "</div>";
					echo "</div>";
					
					echo  "<div class='col-sm-2'>";
						echo "<div class='form-group'>";
							echo "<label for='txt_plazo'>Plazo</label>";
							echo "<input class='form-control' type='text' id='txt_plazo' NAME='txt_plazo' value='".$txt_plazo."' placeholder='Plazo' readonly dir=rtl>";
						echo "</div>";
					echo "</div>";
					
					// echo  "<div class='col-sm-2'>";
						// echo "<div class='form-group'>";
							// echo "<label for='txt_cheque'>Cheque</label>";
							// echo "<input class='form-control' type='text' id='txt_cheque' NAME='txt_cheque' value='".$txt_cheque."' placeholder='Cheque' readonly dir=rtl>";
						// echo "</div>";
					// echo "</div>";
					
				echo "</div>";
				
		
				// echo "<div class='row'>";
					// echo  "<div class='col-sm-12'>";
						// echo "<div class='form-group'>";
							// echo "<label for='txt_observaciones'>Observaciones</label>";
							// echo "<input class='form-control' type='text' id='txt_observaciones' NAME='txt_observaciones' value='".$txt_observaciones."' placeholder='Observaciones' readonly dir=rtl>";
						// echo "</div>";
					// echo "</div>";
				// echo "</div>";
			echo "</div>";
			
			echo "<div class='panel-footer'>";
				echo "<div  class='btn-group'>";
				
				echo "<button class='btn btn-warning' id='imprime_C'>
				  <i class='fa fa-print'></i> Imprimir
				</button>";
			
				echo "</div>";	
				
			echo "</div>";
	
			$csql="select anio,if (estado=1,'A',if(estado=6,'Inicial',if(estado=7,'Reim',ROUND(quincena,0)))) as quin_nombre,saldo_anterior,monto,saldo_actual, observaciones from detallepago where idfolio='$id' and 
			idcredito='".$dat_credito['clv_cred']."' order by anio,quincena,iddetalle";
			$resp=mysqli_query($link,$csql);
			
			echo "<hr>";
		  
			echo "<table class='table table-striped table-sm'>";
			echo "<thead>";
			echo "<tr><th><center>Año</center></th><th><center>Quincena</center></th>";
			// echo "<th>Saldo anterior</th>";
			echo "<th><center>Monto</center></th><th><center>Saldo actual</center></th>";
			
			// echo "<th>Observaciones</th>";
			echo "</tr>";
			echo "</thead><tbody>";
			while($saldofinal=mysqli_fetch_array($resp)){
				echo "<tr>";
					echo "<td><center>";
					echo $saldofinal['anio'];
					echo "</td>";
					
					echo "<td><center>";
					echo $saldofinal['quin_nombre'];
					echo "</td>";
					
					// echo "<td dir='rtl'>";
					// echo moneda($saldofinal['saldo_anterior']);
					// echo "</td>";
					
					echo "<td class='moneda'>$ ";
					echo number_format($saldofinal['monto'],2);
					echo "</td>";
						
					echo "<td class='moneda'>$ ";
					echo number_format($saldofinal['saldo_actual'],2);
					echo "</td>";
					
					// echo "<td>";
					// echo $saldofinal['observaciones'];
					// echo "</td>";				
				echo "</tr>";
			}
			
			echo "</table>";
		echo "</div>";	

	
?>

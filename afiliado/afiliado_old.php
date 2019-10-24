<?php 
	include '../conn.php';
	$sql="select * from afiliados where idfolio='".$_SESSION['idfolio']."'";
	$row=mysqli_fetch_array(mysqli_query($link,$sql));
	echo "<div class='row'>";
		echo  "<div class='col-sm-12'>";
			echo "<div class='card'>
				  <div class='card-header'>Registro";
				  echo "</div>";
					echo "<div class='card-body'>";
					
						echo "<div class='row'>";
							echo  "<div class='col-xl-1 col-lg-2 col-md-2 col-sm-3'>";
								echo "<div class='form-group'>";
									echo "<label for='idfolio'>Socio</label>";
									echo "<input class='form-control' type='text' id='idfolio' NAME='idfolio' value='".$row['idfolio']."' placeholder='No. Empleado' readonly>";
								echo "</div>";
							echo "</div>";
							
							echo  "<div class='col-xl-2 col-lg-4 col-md-4 col-sm-4'>";
								echo "<div class='form-group'>";
									echo "<label for='Filiacion'>Filiación</label>";
									echo "<input class='form-control' type='text' id='Filiacion' NAME='Filiacion' value='".$row['Filiacion']."' placeholder='Filiacion' readonly>";
								echo "</div>";
							echo "</div>";
							
							echo  "<div class='col-xl-2 col-lg-6 col-md-6 col-sm-5'>";
								echo "<div class='form-group'>";
									echo "<label for='c_psp'>Clave Presupuestal</label>";
									echo "<input class='form-control' type='text' id='c_psp' NAME='c_psp' value='".$row['c_psp']."' placeholder='Clave Presupuestal' readonly>";
								echo "</div>";
							echo "</div>";

							

							echo  "<div class='col-xl-2 col-lg-4 col-md-4 col-sm-4'>";
								echo "<div class='form-group'>";
									echo "<label for='ape_pat'>A. PATERNO</label>";
									echo "<input class='form-control' type='text' id='ape_pat' NAME='ape_pat' value='".$row['ape_pat']."' placeholder='APELLIDO PATERNO' readonly>";
								echo "</div>";
							echo "</div>";
							
							echo  "<div class='col-xl-2 col-lg-4 col-md-4 col-sm-4'>";
								echo "<div class='form-group'>";
									echo "<label for='ape_mat'>A. MATERNO</label>";
									echo "<input class='form-control' type='text' id='ape_mat' NAME='ape_mat' value='".$row['ape_mat']."' placeholder='APELLIDO MATERNO' readonly>";
								echo "</div>";
							echo "</div>";
							
							echo  "<div class='col-xl-3 col-lg-4 col-md-4 col-sm-4'>";
								echo "<div class='form-group'>";
									echo "<label for='nombre'>NOMBRE (S)</label>";
									echo "<input class='form-control' type='text' id='nombre' NAME='nombre' value='".$row['nombre']."' placeholder='NOMBRE (S)' readonly>";
								echo "</div>";
							echo "</div>";
							
							echo  "<div class='col-xl-2 col-lg-3 col-md-3 col-sm-4'>";
								echo "<div class='form-group'>";
									echo "<label for='r_reg'>Región</label>";
									echo "<input class='form-control' type='text' id='r_reg' NAME='r_reg' value='".$row['r_reg']." ".$row['r_rrg']."' placeholder='Región' readonly>";
								echo "</div>";
							echo "</div>";
												
							$Fecha_Ingreso=$row['Fecha_Ingreso'];
							list($Fecha_Ingreso,$hora) = explode(" ",$Fecha_Ingreso);
							list($anio,$mes,$dia) = explode("-",$Fecha_Ingreso);
							$Fecha_Ingreso=$dia."-".$mes."-".$anio;
							echo  "<div class='col-xl-2 col-lg-3 col-md-3 col-sm-4'>";
								echo "<div class='form-group'>";
									echo "<label for='Fecha_Ingreso'>Fecha de ingreso</label>";
									echo "<input class='form-control' type='text' id='Fecha_Ingreso' NAME='Fecha_Ingreso' value='".$Fecha_Ingreso."' placeholder='Fecha de ingreso' readonly>";
								echo "</div>";
							echo "</div>";
							
							echo  "<div class='col-xl-2 col-lg-3 col-md-3 col-sm-4'>";
								echo "<div class='form-group'>";
									echo "<label for='a_qui'>Aportacion Ahorro</label>";
									echo "<input class='form-control' type='text' id='a_qui' NAME='a_qui' value='"; number_format($row['a_qui'],2); echo "' placeholder='Aportacion Ahorro' readonly>";
								echo "</div>";
							echo "</div>";
							
							echo  "<div class='col-xl-3 col-lg-3 col-md-3 col-sm-4'>";
								echo "<div class='form-group'>";
									echo "<label for='d_dom'>Correo</label>";
									echo "<input class='form-control' type='text' id='mail' NAME='mail' value='".$row['correo']."' placeholder='Correo' readonly>";
								echo "</div>";
							echo "</div>";
							
							echo  "<div class='col-xl-3 col-lg-3 col-md-4 col-sm-4'>";
								echo "<div class='form-group'>";
									echo "<label for='d_dom'>Celular</label>";
									echo "<input class='form-control' type='text' id='celular' NAME='celular' value='".$row['celular']."' placeholder='Celular' readonly>";
								echo "</div>";
							echo "</div>";
							
							echo  "<div class='col-xl-12 col-lg-8 col-md-8 col-sm-4'>";
								echo "<div class='form-group'>";
									echo "<label for='d_dom'>Dirección</label>";
									echo "<input class='form-control' type='text' id='d_dom' NAME='d_dom' value='".$row['d_dom']."' placeholder='Dirección' readonly>";
								echo "</div>";
							echo "</div>";
							
						echo "</div>";
				
						echo "<div class='row'>";
							echo "<div class='col-sm-4' >";
								echo "<div class='btn-group' role='group' aria-label='Button group with nested dropdown'>";
									echo "<a class='btn btn-warning creditos' data-target='creditos/credito.php'><i class='fas fa-money-check-alt'></i> Créditos</a>";
									echo "<a class='btn btn-warning ahorro' ><i class='fas fa-university'></i> Ahorro</a>";
									/*echo "<a class='btn btn-warning' id='imprime_F'><i class='fa fa-print'></i> Formato</a>";*/
									
								
									echo '<div class="btn-group" role="group">
										<button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fas fa-universal-access"></i>
										Cambiar
										</button>
										<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">';
																	
										echo "<a class='dropdown-item acceso' ><i class='fas fa-at'></i> Cambiar acceso</a>";
										echo "<a class='dropdown-item pass' ><i class='fas fa-key'></i> Cambiar contraseña</a>";
									
										echo "</div>";
								echo "</div>";
							echo "</div>";
								
							echo "</div>";
					echo "</div>";
				echo "</div>";	
			echo "</div>";	
		echo "</div>";	
	echo "</div>";
	echo "<hr>";
	echo "<div class='alert alert-success'>";
	echo "<strong>Nota:</strong> solo se muestra la información del ciclo anterior y actual, para mas detalles acuda a las oficinas de caja de ahorro";
	echo "</div>";
	echo "<hr>";
	
?>


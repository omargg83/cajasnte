<?php
	require_once("../control_db.php");

	setlocale(LC_ALL,"es_ES");

	$clv_cred = $_REQUEST['id'];
	$id=$_SESSION['idfolio'];

		$sql="select * from afiliados where idfolio='$id'";
		$row=$db->general($sql,0);

		$csql="SELECT clv_cred,crx.idfolio,fecha,crx.monto,observa,crx.estado,plazo,if(crx.estado=1,'ACTIVO','INACTIVO') as cred_esta,interes,crx.total,crx.quin_ini,crx.anio_ini,crx.quin_fin,crx.anio_fin,nocheque,aportacion,(select saldo_actual from detallepago where idcredito=crx.clv_cred order by anio desc,quincena desc,iddetalle limit 1) as saldo_actual FROM creditos crx where crx.clv_cred='$clv_cred'";
		$dat_credito=$db->general($csql,0);


		$csql="select SUM(monto) as aporta from detallepago where idcredito='$clv_cred' order by anio,quincena,iddetalle";
		$aportax=$db->general($csql,0);

		$txt_saldo=$dat_credito['total']-$aportax['aporta'];


		set_include_path('../librerias15/pdf2/src/'.PATH_SEPARATOR.get_include_path());
		include 'Cezpdf.php';

		$pdf = new Cezpdf('letter','portrait','color',array(255,255,255));
		$pdf->selectFont('Helvetica');

		// Set pdf Bleedbox

		//$pdf->ezSetMargins(20,20,20,20);
		// Use one of the pdf core fonts
		$mainFont = 'Times-Roman';
		// Select the font
		$pdf->selectFont($mainFont);
		// Define the font size
		$size=12;


		$pdf->openHere('Fit');
		$pdf->ezSetMargins(230,200,60,40);

		$monto=15353;


		$dias = array("DOMINGO","LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SÁBADO");
		$meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");

		$pdf->ezText('RECIBI LA CANTIDAD DE: $ _________________________________');
		$pdf->ezText("");
		$pdf->ezText("(_____________________________________________________________________________________)");
		$pdf->ezText("");
		$pdf->ezText("POR CONCEPTO DE RETIRO PARCIAL DE MI AHORRO");
		$pdf->ezText("");
		$pdf->ezText("<b>NOMBRE:</b> \t".trim($row['nombre'])." ".trim($row['ape_pat'])." ".trim($row['ape_mat']));
		$pdf->ezText("");
		$pdf->ezText("<b>FECHA: </b> \t".$dias[date('w')]." ".date('d')." DE ".$meses[date('n')-1]. " DEL ".date('Y'));
		$pdf->ezText("");

		$pdf->ezText("_____________________________",10,array('justification'=>'center'));
		$pdf->ezText("<b>FIRMA</b> ",10,array('justification'=>'center'));


		$pdf->rectangle(40,427,530,157);
		$pdf->ezStream(array('compress'=>0));


	function letranum($numero){
		$var=($numero)*100;
		$tmp=strlen($var);
		$tmp2=substr($var,$tmp-2,2);
		$entero=substr($var,0,$tmp-2);
		$letra=$num;
		$num=$entero;
		$fem = true;
		$dec = true;
		$matuni[2]  = "dos";
		$matuni[3]  = "tres";
		$matuni[4]  = "cuatro";
		$matuni[5]  = "cinco";
		$matuni[6]  = "seis";
		$matuni[7]  = "siete";
		$matuni[8]  = "ocho";
		$matuni[9]  = "nueve";
		$matuni[10] = "diez";
		$matuni[11] = "once";
		$matuni[12] = "doce";
		$matuni[13] = "trece";
		$matuni[14] = "catorce";
		$matuni[15] = "quince";
		$matuni[16] = "dieciseis";
		$matuni[17] = "diecisiete";
		$matuni[18] = "dieciocho";
		$matuni[19] = "diecinueve";
		$matuni[20] = "veinte";
		$matunisub[2] = "dos";
		$matunisub[3] = "tres";
		$matunisub[4] = "cuatro";
		$matunisub[5] = "quin";
		$matunisub[6] = "seis";
		$matunisub[7] = "sete";
		$matunisub[8] = "ocho";
		$matunisub[9] = "nove";

		$matdec[2] = "veint";
		$matdec[3] = "treinta";
		$matdec[4] = "cuarenta";
		$matdec[5] = "cincuenta";
		$matdec[6] = "sesenta";
		$matdec[7] = "setenta";
		$matdec[8] = "ochenta";
		$matdec[9] = "noventa";
		$matsub[3]  = 'mill';
		$matsub[5]  = 'bill';
		$matsub[7]  = 'mill';
		$matsub[9]  = 'trill';
		$matsub[11] = 'mill';
		$matsub[13] = 'bill';
		$matsub[15] = 'mill';
		$matmil[4]  = 'millones';
		$matmil[6]  = 'billones';
		$matmil[7]  = 'de billones';
		$matmil[8]  = 'millones de billones';
		$matmil[10] = 'trillones';
		$matmil[11] = 'de trillones';
		$matmil[12] = 'millones de trillones';
		$matmil[13] = 'de trillones';
		$matmil[14] = 'billones de trillones';
		$matmil[15] = 'de billones de trillones';
		$matmil[16] = 'millones de billones de trillones';

		$num = trim((string)@$num);
		if ($num[0] == '-') {
			$neg = 'menos ';
			$num = substr($num, 1);
		}else
			$neg = '';
		while ($num[0] == '0') $num = substr($num, 1);
		if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
		$zeros = true;
		$punt = false;
		$ent = '';
		$fra = '';
		for ($c = 0; $c < strlen($num); $c++) {
			$n = $num[$c];
			if (! (strpos(".,'''", $n) === false)) {
				if ($punt) break;
				else{
					$punt = true;
				continue;
				}
			}elseif (! (strpos('0123456789', $n) === false)) {
				if ($punt) {
					if ($n != '0') $zeros = false;
					$fra .= $n;
				}else
				$ent .= $n;
			}else
			break;
		}
		$ent = '     ' . $ent;
		if ($dec and $fra and ! $zeros) {
			$fin = ' coma';
			for ($n = 0; $n < strlen($fra); $n++) {
				if (($s = $fra[$n]) == '0')
					$fin .= ' cero';
				elseif ($s == '1')
					$fin .= $fem ? ' un' : ' un';
				else
					$fin .= ' ' . $matuni[$s];
			}
		}else
			$fin = '';
			if ((int)$ent === 0) return 'Cero ' . $fin;
			$tex = '';
			$sub = 0;
			$mils = 0;
			$neutro = false;
			while ( ($num = substr($ent, -3)) != '   ') {
				$ent = substr($ent, 0, -3);
				if (++$sub < 3 and $fem) {
					$matuni[1] = 'un';
					$subcent = 'os';
				}else{
					$matuni[1] = $neutro ? 'un' : 'uno';
					$subcent = 'os';
				}
			$t = '';
			$n2 = substr($num, 1);

			if ($n2 == '00') {
			}elseif ($n2 < 21)
				$t = ' ' . $matuni[(int)$n2];
			elseif ($n2 < 30) {
				$n3 = $num[2];
				if ($n3 != 0) $t = 'i' . $matuni[$n3];
				$n2 = $num[1];
				$t = ' ' . $matdec[$n2] . $t;
			}else{
				$n3 = $num[2];
				if ($n3 != 0) $t = ' y ' . $matuni[$n3];
				$n2 = $num[1];
				$t = ' ' . $matdec[$n2] . $t;
			}
			$n = $num[0];
			if ($n == 1) {
				$t = ' ciento' . $t;
			}elseif ($n == 5){
				$t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
			}elseif ($n != 0){
				$t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
			}
			if ($sub == 1) {
			}elseif (! isset($matsub[$sub])) {
				if ($num == 1) {
					$t = ' mil';
				}elseif ($num > 1){
					$t .= ' mil';
				}
			}elseif ($num == 1) {
				$t .= ' ' . $matsub[$sub] . '?n';
			}elseif ($num > 1){
				$t .= ' ' . $matsub[$sub] . 'ones';
			}
			if ($num == '000') $mils ++;
			elseif ($mils != 0) {
				if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
				$mils = 0;
			}
			$neutro = true;
			$tex = $t . $tex;
		}
		$tex = $neg . substr($tex, 1) . $fin;
		$letra= ucfirst($tex)." pesos ".$tmp2;
		$letra =strtoupper($letra)."".$punto."/100 M.N";
		return $letra;
	}
?>

<?php
	require_once("../control_db.php");
	setlocale(LC_ALL,"es_ES");

	/*************************

	Nota: esto antes era de creditos, por lo menos el original, cualquier cambio le corresponde a esponja

	*/

		$sql="select * from afiliados where idfolio='".$_SESSION['idfolio']."'";
		$row=$db->general($sql,0);

		set_include_path('../librerias15/pdf2/src/'.PATH_SEPARATOR.get_include_path());
		include 'Cezpdf.php';

		$pdf = new Cezpdf('letter','portrait','color',array(255,255,255));
		$pdf->selectFont('Helvetica');
		$mainFont = 'Times-Roman';
		$pdf->selectFont($mainFont);

		$size=12;
		$pdf->openHere('Fit');
		$pdf->ezSetMargins(230,200,60,40);

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


?>

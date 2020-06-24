<?php
	require_once("db_.php");
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
		$pdf->ezSetMargins(80,200,60,40);

		$dias = array("DOMINGO","LUNES","MARTES","MIERCOLES","JUEVES","VIERNES","SÁBADO");
		$meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");



		$pdf->ezText("<b>SINDICATO NACIONAL DE TRABAJADORES DE LA EDUCACION</b>",10,array('justification'=>'center'));
		$pdf->ezText("<b>FORMATO DE RETIRO CAJA DE AHORRO </b>",10,array('justification'=>'center'));
		$pdf->ezText("");
		$pdf->ezText("");
		$pdf->ezText("POR MEDIO DE LA PRESENTE EXPRESO MI VOLUNTAD DE QUE CAJA DE AHORRO Y CRÉDITO DEL");
		$pdf->ezText("");
		$pdf->ezText("SNTE SECCIÓN 15 HIDALGO, REALICE TRANSFERENCIA BANCARIA POR LA CANTIDAD DE: ");
		$pdf->ezText("");
		$pdf->ezText('$ _________________________________ CANTIDAD CON NÚMERO ');
		$pdf->ezText("");
		$pdf->ezText("(___________________________________________________________________________)CANTIDAD CON LETRA");
		$pdf->ezText("");
		$pdf->ezText("<b>A LA CUENTA:</b> \t".trim($row['num_cuenta'])." DE LA INSTITUCIÓN BANCARIA:".trim($row['banco']));
		$pdf->ezText("");
		$pdf->ezText("POR CONCEPTO DE RETIRO PARCIAL DE MI AHORRO");
		$pdf->ezText("");
		$pdf->ezText("<b>NOMBRE:</b> \t".trim($row['nombre'])." ".trim($row['ape_pat'])." ".trim($row['ape_mat']));
		$pdf->ezText("");
		$pdf->ezText("<b>FECHA DEL TRAMITE: </b> \t".$dias[date('w')]." ".date('d')." DE ".$meses[date('n')-1]. " DEL ".date('Y'));
		$pdf->ezText("");
		$pdf->ezText("");
		$pdf->ezText("");

		$pdf->ezText("_____________________________",10,array('justification'=>'center'));
		$pdf->ezText("<b>FIRMA</b> ",10,array('justification'=>'center'));

		$pdf->ezStream(array('compress'=>0));


?>

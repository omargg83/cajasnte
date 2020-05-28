<?php
	require_once("db_.php");

	$cita = $_REQUEST['id'];
	$resp=$db->cita_ver($cita);


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
		// Modified to use the local file if it can
		$pdf->openHere('Fit');
		$pdf->ezSetMargins(230,200,60,40);

		$pdf->addJpegFromFile("../img/logosnte2013.jpg",30,680,70);
		$pdf->addJpegFromFile("../img/cajax.jpg",510,690,50);

		$pdf->addText(310,760,14,"SINDICATO NACIONAL DE TRABAJADORES DE LA EDUCACION",0,'center');
		$pdf->addText(310,735,12,"REPORTE DE DESCUENTOS POR CREDITO",0,'center');
		$pdf->addText(310,720,12,"CAJA DE AHORRO Y CREDITOS",0,'center');



		$pdf->ezStream(array('compress'=>0));

?>

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
		$pdf->ezText('$ _________________________________ ');
		$pdf->ezText("          Cantidad con número ");
		$pdf->ezText("");
		$pdf->ezText("(____________________________________________________________________________________________)");
		$pdf->ezText("Cantidad con letra",10,array('justification'=>'center')               );
		$pdf->ezText("");
		$pdf->ezText("A LA CUENTA: \t"." "."<b>".trim($row['num_cuenta'])."</b>"." "." DE LA INSTITUCIÓN BANCARIA:"."<b>"." ".trim($row['banco'])."</b>");
		$pdf->ezText("");
		$pdf->ezText("POR CONCEPTO DE RETIRO PARCIAL DE MI AHORRO");
		$pdf->ezText("");
		$pdf->ezText("NOMBRE: \t"." "."<b>".trim($row['nombre'])." ".trim($row['ape_pat'])." ".trim($row['ape_mat'])."</b>");
		$pdf->ezText("");
		$pdf->ezText("FECHA DEL TRAMITE: \t"." "."<b>".$dias[date('w')]." ".date('d')." DE ".$meses[date('n')-1]. " DEL ".date('Y')."</b>");
		$pdf->ezText("");
		$pdf->ezText("");
		$pdf->ezText("");
		$pdf->ezText("");
		$pdf->ezText("_____________________________",10,array('justification'=>'center'));
		$pdf->ezText("<b>FIRMA</b> ",10,array('justification'=>'center'));
		$pdf->ezText("");
		$pdf->ezText("");
		$pdf->ezText("");
		$pdf->ezText("");
		$pdf->ezText("");
		$pdf->ezText("");
		$pdf->ezText("Ten en cuenta que este formato sera valido si antes llenaste los datos bancarios");
		$pdf->ezText("de transferencia en la plataforma, a fin de que estos se muestren en el documento.");
		$pdf->ezStream(array('compress'=>0));


?>

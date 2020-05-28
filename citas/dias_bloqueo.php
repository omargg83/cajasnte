<?php
	require_once("db_.php");
	$citas=$db->citas_bloqueo();
	$arreglo=array();

	$i=0;
	foreach($citas as $key){
		$hora=explode(" ",$key['fecha']);
		$arreglo[$i]=array(
			'dia'=>$key['fecha']
		);
		$i++;
	}
	echo json_encode($arreglo);
?>

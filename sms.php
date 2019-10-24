<?php	
	session_start();
	include 'conn.php';
	$tipo=$_GET['tipo'];
	$id=$_GET['id'];
	
	if($tipo==1){
		$sql="select * from abitacora where enviado=0 limit 1";
		$resp=mysqli_query($link,$sql);
		while($row=mysqli_fetch_array($resp)){
			$arr = array("id" => $row['id'], "numero" => $row['numero'], "texto" => $row['texto'], "server" => "CAJA");
		}
		$myJSON = json_encode($arr);
		echo $myJSON;
	}
	if($tipo==2){
		$sql="update abitacora set enviado=1 where id='$id'";
		$resp=mysqli_query($link,$sql);
	}
?>
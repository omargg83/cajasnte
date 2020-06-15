<?php
  session_start();
  date_default_timezone_set("America/Mexico_City");

  class daasldjflks{
		public function __construct(){
      try{
        date_default_timezone_set("America/Mexico_City");

        $mysqluser="sagyce18_sagyc";
        $mysqlpass="sagyc123$";
        $servidor="sagyc2.com.mx";
        $bdd="sagyce18_caja";
        $this->dbh = new PDO("mysql:host=$servidor;dbname=$bdd", $mysqluser, $mysqlpass);
        $this->dbh->query("SET NAMES 'utf8'");
			}
			catch(PDOException $e){
        die();
				return "Database access FAILED!";
			}
		}
    public function acceso(){
			try{
				$ip=self::getRealIP();
				////////////////////////////los id y name de los input de login son variantes por lo que si no existen quiere decir que el usuario intento hackear y por lo tanto se banea la IP
				$metodo=$_SERVER['REQUEST_METHOD'];
				$keys=array_keys($_REQUEST);
				$uno=$keys[0];
				$dos=$keys[1];

        $user=trim($_REQUEST[$uno]);
				$pass=trim($_REQUEST[$dos]);

        $us_fake=$_REQUEST['usuario'];
        $pa_fake=$_REQUEST['password'];

        if(strlen($uno)<8 or strlen($dos)<8 or strlen($us_fake)>0 or strlen($pa_fake)>0){
          return 0;
        }

  			$sql="select idfolio, Filiacion, password, nombre, ape_pat, ape_mat from afiliados where Filiacion=:usuario and password=:pass";
  			$sth = $this->dbh->prepare($sql);
  			$sth->bindValue(":usuario",$user);
  			$sth->bindValue(":pass",$pass);
  			$sth->execute();
  			$datos=$sth->fetch();

  			if(is_array($datos)){
  				$userBD = trim($datos['Filiacion']);
  				$passwordBD = trim($datos['password']);

  				if($userBD == $user and $passwordBD==$pass){
  					$_SESSION['autoriza']=1;
  					$_SESSION['filiacion']=$datos['Filiacion'];
  					$_SESSION['nombre']=$datos['nombre'];
  					$_SESSION['ape_pat']=$datos['ape_pat'];
  					$_SESSION['ape_mat']=$datos['ape_mat'];
  					$_SESSION['idfolio']=$datos['idfolio'];
  					$_SESSION['llave']=md5(rand(10000,99999).$passwordBD);

  					$_SESSION['administrador']=0;
  					$_SESSION['hasta']=date("Y");
  					$_SESSION['foco']=mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));

  					$arr=array();
  					$arr=array('acceso'=>1,'idpersona'=>$_SESSION['idfolio']);
  					return json_encode($arr);
  				}
  			}
  			else {
  				$sql="select * from usuarios where NOMBRE=:usuario and CLAVE_ACC=:pass";
  				$sth = $this->dbh->prepare($sql);
  				$sth->bindValue(":usuario",$user);
  				$sth->bindValue(":pass",$pass);
  				$sth->execute();
  				$datos=$sth->fetch();
  				if(is_array($datos)){
  					$userBD = trim($datos['NOMBRE']);
  					$passwordBD = trim($datos['CLAVE_ACC']);
  					if($userBD == $user and $passwordBD==$pass){
  						$_SESSION['autoriza']=1;
  						$_SESSION['filiacion']=$datos['RFC'];
  						$_SESSION['nombre']=$datos['NOMBRE'];
  						$_SESSION['idfolio']=$datos['CLV_PER'];
  						$_SESSION['ape_pat']="";
  						$_SESSION['ape_mat']="";

  						$_SESSION['administrador']=1;
  						$_SESSION['hasta']=date("Y");
  						$_SESSION['foco']=mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));

  						$arr=array();
  						$arr=array('acceso'=>1,'idpersona'=>0);
  						return json_encode($arr);
  					}
  				}
  				else{
  					$arr=array();
  					$arr=array('acceso'=>0,'idpersona'=>0);
  					return json_encode($arr);
  				}
  			}
			}catch(PDOException $e){
				return "Database access FAILED!";
			}
		}
    private function getRealIP(){
      if (isset($_SERVER["HTTP_CLIENT_IP"])){
          return $_SERVER["HTTP_CLIENT_IP"];
      }
      elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
          return $_SERVER["HTTP_X_FORWARDED_FOR"];
      }
      elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
          return $_SERVER["HTTP_X_FORWARDED"];
      }
      elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
          return $_SERVER["HTTP_FORWARDED_FOR"];
      }
      elseif (isset($_SERVER["HTTP_FORWARDED"])){
          return $_SERVER["HTTP_FORWARDED"];
      }
      else{
          return $_SERVER["REMOTE_ADDR"];
      }
    }

  }

  $db = new daasldjflks();
  echo $db->acceso();
 ?>

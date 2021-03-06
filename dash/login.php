<?php
  session_start();
  date_default_timezone_set("America/Mexico_City");

  class Login{
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
    public function genera_random($length = 24) {
      try{
        $ip=self::getRealIP();

        $_SESSION['idsess']="";
        $_SESSION['autoriza']=0;

        $random=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
        $in=md5(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 16));
        $pin=md5(substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 16));
        $encrip=password_hash($random, PASSWORD_DEFAULT);

        $date = new DateTime();
        $date->modify('+3 hours');
        $limite=$date->format('Y-m-d H:i:s');

        return array($in,$pin);
      }
      catch(PDOException $e){
        echo "Database access FAILED!";
      }
    }
    public function ip(){
      try{
        $ip=self::getRealIP();

        $date = new DateTime();
        $date->modify('-10 minutes');
        $limite=$date->format('Y-m-d H:i:s');

        $sql="delete from token_pikatic where ip=:ip and generado<:limite";
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(":ip",$ip);
        $sth->bindValue(":limite",$limite);
        $sth->execute();

        if(strlen($ip)>8){
          $sql="select count(token) as numero from token_pikatic where ip=:ip";
          $sth = $this->dbh->prepare($sql);
          $sth->bindValue(":ip",$ip);
          $sth->execute();
          $CLAVE=$sth->fetch(PDO::FETCH_OBJ);
          return $CLAVE->numero;
        }
        else{
          return 100;
        }
      }
      catch(PDOException $e){
        return "Database access FAILED!";
      }
    }
    public function baneada(){
      try{
        $ip=self::getRealIP();
        $sql="SELECT baneada FROM token_log where baneada=:baneada";
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(":baneada",$ip);
        $sth->execute();
        $contar=$sth->rowCount();
        return $contar;
      }
      catch(PDOException $e){
        return "Database access FAILED!";
      }
    }
  }
  $intentos=0;
  $db = new Login();
  $ar=$db->genera_random();
  $a=$ar[0];
  $b=$ar[1];

?>

<form id='acceso' action=''>
    <div class='container'>
        <center><img src='img/caja.png' width='150px'></center>
        <p class='input_title'>Rfc:</p>
        <div class='form-group input-group'>
          <div class='input-group-prepend'>
            <span class='input-group-text'> <i class='fas fa-user-circle'></i> </span>
          </div>
          <input class='form-control' placeholder='Introduzca Rfc' type='text'  id='<?php echo $a;?>' name='<?php echo $a;?>' required autocomplete="off">
        </div>
        <p class='input_title'>Contraseña:</p>
        <div class='form-group input-group'>
          <div class='input-group-prepend'>
            <span class='input-group-text'> <i class='fa fa-lock'></i> </span>
          </div>
          <input class='form-control' placeholder='Contraseña' type='password'  id='<?php echo $b;?>' name='<?php echo $b;?>' required autocomplete="off">
        </div>
        <button class='btn btn-warning btn-block' type='submit'><i class='fa fa-check'></i>Aceptar</button>
        <button class='btn btn-outline-info btn-block' type='button' onclick='recuperar()'><i class='fas fa-key'></i>Recuperar contraseña</button>
        <center>http://sagyc.com.mx</center>
    </div>
    <div id='registro' style='display:none'>
      <input class='form-control' type='text' id='usuario' name='usuario' value='' onchange='md5pass()' autocomplete="off">
      <input class='form-control' type='text' id='password' name='password' value='' onchange='md5pass()' autocomplete="off">
    </div>
  </form>

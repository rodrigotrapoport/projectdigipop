<label >INGRESAR NUEVO PIN:</label><br>
<form action="nuevoPin.php" method="post">
    <label for="pinNuevo">INGRESAR PIN</label><br>
    <input type="text" id="pinNuevo" name="pinNuevo" value=""><br><br>
  
    <label for="pinRepetido">REPETIR PIN</label><br>
    <input type="text" id="pinRepetido" name="pinRepetido" value=""><br><br>
    
    <input type="submit" value="Login">
</form>


<?php
ob_start();      // permite corregir error en header o salto a otra pagina
session_start(); // leer cookies

error_reporting(0);	
////// REGISTRAR NUEVO CLIENTE //////
require('log/log.php');

/// CONEXION DB ///
$dbc = mysqli_connect(DBHOST,DBUSER,DBPW);
if (!$dbc) {
    exit();
}

$dbs = mysqli_select_db($dbc, DBNAME);
if (!$dbs) {
    exit();
}
////////// ip ////

function getRealIP() {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
}

$ip = getRealIP(); //ip del cliente

////////////////////////////////////////////

if( isset($_GET['pin'])){
	
	$pin = $_GET['pin'];
	echo $pin.'<br>';
	$values = "SELECT idUsuario  FROM usuarios WHERE link='$pin' LIMIT 1"; 
    $result = $dbc->query($values)    ;
      
    // datos actividad
    while($row = $result -> fetch_assoc()){    
	    $idUsuario = $row['idUsuario'];	   
    };  
    echo 'hay conexion <br>';  	    
  
};
	
gc_collect_cycles();
mysql_free_result();
	
?>
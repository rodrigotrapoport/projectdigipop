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

$hoyA = date('Y-m-d'); //YYYY-MM-DD
$hoyB = date('Y-m-d G:i'); // YYYY-MM-DD 24:00

////////// ip ////

function getRealIP() {

        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
}

$ip = getRealIP(); //ip del cliente

//****** AES ***********	
$claveEncriptacion = 'exito seguro!';
$secret = 'texto secreto 1';
function my_simple_crypt( $string, $action = 'e', $clave, $secr ) {
    $secret_key = $clave; 
    $secret_iv  = $secr ;
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    };
    return $output;
}	
//**************************


////// NUEVO USUARIO ///////// 
/*
if( isset($_GET['link'])){
	$link = $_GET['link'];
	$values = "SELECT idUsuario, nombres, apellidos, email, link  FROM usuarios WHERE link='$link' "; 
    $result = $dbc->query($values)    ;
    $filas  = mysqli_num_rows($result);	
    if($filas == 1){
	    
	    // datos del usuario registrado
	    while($row = $result -> fetch_assoc()){ 
		    $idUsuario = $row['idUsuario'];
		    $linkDB    = $row['link'];
		    $texto = 'nombre '.$row['nombres'].' '.$row['apellidos'].' '.$row['email'];
	    };     
	    $linkTest = hash('ripemd256', $idUsuario.$ip.'registro' );   	    
    }; 
      
	if($linkDB == $linkTest){
		echo 'Logueado correctamente <br>';
		echo $texto;
		
		// consulta el tipo de preducto adquirido y el estado del pago
		$values = "SELECT tipoServ, precio, estatus FROM serContrato WHERE idUsuario='$idUsuario'"; 
	    $result = $dbc->query($values);
		$filas  = mysqli_num_rows($result);	
        if($filas == 1){
			while($row = $result -> fetch_assoc()){ 
			    $tipoServicio    = $row['tipoServ'];
			    $precioServicio  = $row['precio']; 
			    $estatusServicio = $row['estatus'];   
		    }; 
		    echo '<br>'.$tipoServicio.' '.$precioServicio.'$usd '.$estatusServicio.' '.$hoyB.'<br>';
		    echo '<h1>REALIZAR EL PAGO DEL SERVICIO CONTRATADO</h1>';
		};	
	} else {
		echo 'usuario no registrado';
		// exit(); // detiene el proceso
		// header('Location:https://www.google.com');
	};
};
*/
/////// LOGIN //////
if( isset($_GET['login']) AND isset($_GET['conect'])){
	
	$conect = $_GET['conect']; // hash  link + hashcookie
	$login  = $_GET['login'];  // hashcookie
	//echo $login.'<br>';
	
	// busca usuario por la cookie
	$values = "SELECT idUsuario  FROM actividad WHERE cookie='$login' "; 
    $result = $dbc->query($values)    ;
    $filas  = mysqli_num_rows($result);	
    if($filas == 1){   
	    // datos actividad
	    while($row = $result -> fetch_assoc()){    
		    $idUsuario = $row['idUsuario'];	   
	    };  
	    //echo 'hay conexion <br>';  	    
    };
    
    // busca link dentro de usuarios
    $values = "SELECT link  FROM usuarios WHERE idUsuario='$idUsuario' "; 
    $result = $dbc->query($values);
    $filas  = mysqli_num_rows($result);	
    if($filas == 1){ 
	    // datos usuarios
	    while($row = $result -> fetch_assoc()){    
		    $logLink = $row['link']; // LINK	    
	    };  
    };
    
    // hash link + cookie
    $hashConexion = hash('ripemd256', $logLink.$login); // experimental
    
    // compara si conect es igual a lo que esta el sistema
    // conect = hash link + cookie
    if($hashConexion == $conect){ 
	    
	    echo '<br> conexion confirmada por HASH <br>';
	    
	    
	    // consulta el tipo de preducto adquirido y el estado del pago
		$values = "SELECT tipoServ, precio, estatus FROM serContrato WHERE idUsuario='$idUsuario'"; 
	    $result = $dbc->query($values);
		$filas  = mysqli_num_rows($result);	
        if($filas == 1){
			while($row = $result -> fetch_assoc()){ 
			    $tipoServicio    = $row['tipoServ'];
			    $precioServicio  = $row['precio']; 
			    $estatusServicio = $row['estatus'];   
		    }; 
		    		    
		    // SI EL PAGO ESTA PENDIENTE EXPULSA DEL SITIO
		    if( $estatusServicio == 'pagoPendiente' ){
			    header('Location:login.php');
		    };
		    echo '<h1>PAGO CORRECTO DEL SERVICIO CONTRATADO</h1>';

		};
	     
	    $values = "SELECT idUsuario, nombres, apellidos, email  FROM usuarios WHERE idUsuario='$idUsuario' "; 
	    $result = $dbc->query($values)    ;
	    $filas  = mysqli_num_rows($result);	
	    if($filas == 1){
		    // datos del usuario registrado
		    while($row = $result -> fetch_assoc()){
			    
			    $idUsuario = $row['idUsuario'];
			    $texto = 'nombre '.$row['nombres'].' <br>email '.$row['email'];
			    
		    };
		    echo 'Logueado correctamente <br>';   
		    echo $texto; 	    
	    } else {
		    echo 'usuario no registrado';
			// exit(); // detiene el proceso
			// header('Location:https://www.google.com');
	    };
	    
	    //************ CALCULA TIEMPO TRANSCURRIDO ******** 
	    // actualiza el estado de la conexion
	    $values = "UPDATE actividad SET logueado= '$hoyB', accion='login' WHERE idUsuario='$idUsuario' AND cookie='$login'";
		$result = $dbc->query($values);
		
	    $values = "SELECT fecha  FROM actividad WHERE idUsuario='$idUsuario' AND cookie='$login'"; 
	    $result = $dbc->query($values)    ;
	    $filas  = mysqli_num_rows($result);
        if($filas == 1){
		    while($row = $result -> fetch_assoc()){   
			    $fechaA = $row['fecha'];    
		    };
		};
	    
	    $origin = new DateTime($fechaA);     // fecha inicial
		$target = new DateTime($hoyB);       // fecha final
		$interval = $origin->diff($target);  // calcula la diferencia
		$minutosDiferencia = $interval->format('%i');
	    $horasDiferencia   = $interval->format('%h');
	    $diasDiferencia    = $interval->format('%a');
	    $minTotal = ($diasDiferencia * 1440) + ($horasDiferencia * 60) + $minutosDiferencia;
	    echo '<br>diferencia real '.$minTotal.' minutos';
	    
	    if( $minTotal > 300){ /// tiempo de duracion del link del correo
		    echo '<br>El tiempo ha expirado!';
		    //header('Location:login.html'); 
	    } else {
	    $cookieAESen = my_simple_crypt( $login, 'e', $claveEncriptacion, $secret );// encripta
	    //setcookie("setCookie", $cookieAESen); // asigna hashcookie como cookie
	    $_SESSION['setCookie']  = $cookieAESen;
	    //header('Location:gestion_index.php');
	    
	    $xCookie = $_SESSION['setCookie'];
	    $cookieAESdes = my_simple_crypt( $xCookie, 'd', $claveEncriptacion, $secret );// desencripta
	    echo '<br>cookie '.$cookieAESdes;
	    };
	    
	} else {
	    echo 'ERROR AL LOGUEARTE';	
	}; // cierre if hash link + hashcookie
    
       
} else { header('Location:login.html'); };

ob_end_flush(); //
gc_collect_cycles();
?>
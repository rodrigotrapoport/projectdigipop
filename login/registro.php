<?php 
/*
<!DOCTYPE html>
<html>
<body>

<h2>REGISTRO DE PRUEBA </h2>

<form action="registro.php" method="post">
    <label for="fname">Nombres:</label><br>
    <input type="text" id="fNombres" name="fNombres" value=""><br><br>
  
    <label for="lname">Apellidos:</label><br>
    <input type="text" id="fApellidos" name="fApellidos" value=""><br><br>
    
    <label for="lname">Email:</label><br>
    <input type="email" id="fEmail" name="fEmail" value=""><br><br>
    
    <label for="lname">Usuario:</label><br>
    <input type="text" id="fUsuario" name="fUsuario" value=""><br><br>
    
    <label for="lname">Pin 4 Digitos:</label><br>
    <input type="text" id="fPin" name="fPin" value="" maxlength="4"><br><br>
    
    <label for="fTipo">SERVICIO/ECOMMERCE</label><br>
    <select name="fTipo" id="fTipo">
    	<option value="servicio" >Servicio</option>
	    <option value="ecommerce">Ecommerce</option>   
	</select>
    <br>*******<br>
    <label for="lname">Nombre Tienda:</label><br>
    <input type="text" id="fNtienda" name="fNtienda" value=""><br><br>
  
    <label for="lname">Rubro:</label><br>
    <input type="text" id="fRubro" name="fRubro" value=""><br><br>
    
    <label for="lname">Ubicación:</label><br>
    <input type="text" id="fUbicacion" name="fUbicacion" value=""><br><br>
      
    <input type="submit" value="Nuevo Usuario">
</form> 

<br>////////////////////////////////////////////////// <br><br>

<label >LOGIN CON PIN:</label><br>
<form action="registro.php" method="post">
    <label for="fUsuario">Usuario:</label><br>
    <input type="text" id="logUsuario" name="logUsuario" value=""><br><br>
  
    <label for="fPin">Pin:</label><br>
    <input type="text" id="logPin" name="logPin" value=""><br><br>
    
    <input type="submit" value="Login">
</form>

<br>///////////////////////////////////////////////// <br><br>

<label >RECUPERAR PIN:</label><br>
<form action="nuevoPin.php" method="post">
    <label for="fRecuperar">Email:</label><br>
    <input type="text" id="fRecuperar" name="fRecuperar" value=""><br><br> 
    
    <input type="submit" value="Recuperar Pin">
</form>
*/
?>
<?php
ob_start();      // permite corregir error en header o salto a otra pagina
session_start(); // leer cookies

error_reporting(0);		
	
////// REGISTRAR NUEVO CLIENTE //////
require('log/log.php');
//require 'vendor/autoload.php';
//use PHPMailer\PHPMailer\PHPMailer;

/// CONEXION DB ///
$dbc = mysqli_connect(DBHOST,DBUSER,DBPW);
if (!$dbc) {
    exit();
};

$dbs = mysqli_select_db($dbc, DBNAME);
if (!$dbs) {
    exit();
};

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

///////////// HORA ////////////

date_default_timezone_set('America/Mazatlan');//hora de mazatlan
$hoy  = date('j-n-Y G:i');//fecha de hoy  1-1-2001 23:01
$hoyA = date('Y-m-d');  // yyyy-mm-dd
$hoyB = date('Y-m-d G:i'); 

// NAVEGADOR //

function detect() {
	
	$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
	$os=array("WIN","MAC","LINUX");

	# definimos unos valores por defecto para el navegador y el sistema operativo

	$info['browser'] = "OTHER";
	$info['os'] = "OTHER";

	# buscamos el navegador con su sistema operativo

	foreach($browser as $parent){
		$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
		$f = $s + strlen($parent);
		$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
		$version = preg_replace('/[^0-9,.]/','',$version);
		if ($s){
			$info['browser'] = $parent;
			$info['version'] = $version;
		}
	}
	# obtenemos el sistema operativo
	foreach($os as $val)
	{
		if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false){
			$info['os'] = $val;
		}

	}
	# devolvemos el array de valores
	return $info;
}

$info=detect(); // navegador del cliente

$OS  = "OS:".$info["os"];
$NAV =  "Nav:".$info["browser"];
$NAVvers   = "V:".$info["version"];
$infoExtra =  $_SERVER['HTTP_USER_AGENT'];

// IP //

function getRealIP() {

    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
       
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
   
    return $_SERVER['REMOTE_ADDR'];
}
$ip = getRealIP(); //ip del cliente
	
/*
if(isset($_SERVER['HTTP_REFERER'])) {
    echo  $_SERVER['HTTP_REFERER']. ' servidor '; // desde que url llega a consulta
} else {
	echo 'pagina de consulta inexistente ';
	//exit();
};

if ( $_SERVER['SERVER_NAME'] == 'localhost' ){
	//echo ' servidor local ';
} else {
	exit();
	//echo ' no es servidor local ';
};
*/

/// VARIABLES INICIALES //
$mensajeEmail  = '';
$enviarCorreo  = false;
$datosTienda   = false; // indica si esta completo el formulario de datos de la tienda
$datosUsuarios = false;
$datosLogueo   = false;
$datosTipo     = false;
$datosInscripcion = false;
$idUsuarioLogin = '';
$idUsuarioRecuperacion = '';
$estatusPago   = 'pagoPendiente';


/// COTIZACION DEL DOLLAR EN ARG Y MEX
//****************  DOLLAR a PESO MX*********************	
///////////////////// coinbase cotizacion dollar //////

$cSession = curl_init(); 
curl_setopt($cSession,CURLOPT_URL,"https://api.coinbase.com/v2/prices/spot?currency=USD");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 
$resultUSD=curl_exec($cSession);
curl_close($cSession);
$preciosUSDArray = json_decode($resultUSD, TRUE);
$precio1BTCusd = $preciosUSDArray['data']['amount'];

$cSession = curl_init(); 
curl_setopt($cSession,CURLOPT_URL,"https://api.bitso.com/v3/trades/?book=btc_mxn&limit=30&marker");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 
$result=curl_exec($cSession);
curl_close($cSession);
$preciosArray = json_decode($result, TRUE);
$precio1BTCmxn = $preciosArray['payload'][0]['price'];
$dollarMEX = number_format(($precio1BTCmxn/ $precio1BTCusd),2,'.','');

//************ DOLLAR a PESO ARG ******************

$cSession = curl_init(); 
curl_setopt($cSession,CURLOPT_URL,"https://www.cronista.com/MercadosOnline/json/homegetPrincipal.html");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 
$resultARG=curl_exec($cSession);
curl_close($cSession);
$pesoARG = json_decode($resultARG, TRUE);
$cotOfArg = $pesoARG['monedas'][0];
$dollarARG = number_format(($cotOfArg['Venta'] * 1.3 ),2,'.','');


$dollarMx = $dollarMEX;
$dollarAr = $dollarARG;

//*******************************************
////////// PAGO INICIAL //////////////

if( 
    isset($_POST['inscNombre']) AND 
    isset($_POST['confEmail'])  AND
    isset($_POST['inscProducto'])     
){
	$nombreInscripcion   = $_POST['inscNombre'];
	$emailInscripcion    = $_POST['confEmail'] ;
	$productoInscripcion = $_POST['inscProducto'];
	
	$datosInscripcion = true;
	
	// id usuario se genera automaticamente digi mas 10 digitos
	$idUsuario = 'digi';
	for($i=0;$i<10;$i++){
		$idUsuario .= rand(0,9);
	};
	
	// referencia de pago MP
	$refPago = 'pago-'.$productoInscripcion.'-';
	for($i=0;$i<10;$i++){
		$refPago .= rand(0,9);
	};
	$refPago .= '-'.$hoyA;
	
	//// DETECTAR PAIS DE ORIGEN ///
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://get.geojs.io/v1/ip/geo.json');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$output = curl_exec($ch);
	curl_close($ch);
    $datos1 = json_decode($output,true);
    $pais = $datos1['country_code3'];
    
	
	if( $productoInscripcion == 'Servicio'){
		$costo = 90;
	} elseif ($productoInscripcion == 'Ecommerce') {
	    $costo = 150;	
	};
	
	if( $pais == 'MEX'){
		$costoLocal = $costo * $dollarMx;
	} elseif ( $pais == 'ARG' ){
		$costoLocal = $costo * $dollarAr;
	} else {  
		$costoLocal = '---';
	};
	
	//$values = "INSERT INTO inscripcion ( idUsuario ) VALUES ('$idUsuario')";
	//$result = $dbc->query($values);
		
	// carga los datos en usuarios
	$values = "INSERT INTO inscripcion ( idUsuario, nombre,  email,  fecha, producto, costo, costoLocal, pais, codigoPago ) 
	           VALUES ('$idUsuario', '$nombreInscripcion', '$emailInscripcion','$hoyA', '$productoInscripcion', '$costo', '$costoLocal', '$pais', '$refPago')";
	$result = $dbc->query($values);
	
	$hash = hash('ripemd256', $refPago.$pais ); 
	
	$refPagoAES = my_simple_crypt( $refPago, 'e', $claveEncriptacion, $secret );// encripta
	
	$encabezdo    = 'PARA CONTINUAR LA INSCRIPCION DEBES REALIZAR EL PAGO<br>';
	$mensajeEmail = $encabezdo.'<br>'.
	                $nombreInscripcion.'<br>'.
	                $pais.'<br>'.
	                '<br><a href="localhost/login/pago.php?pago='.$refPagoAES.'&sec='.$hash.'">LINK PAGO INSCRIPCION</a> '.
	                $hoyA;
    $enviarCorreo = true;
	
};

//****************************************
////////// CARGAR NUEVO CLIENTE //////////

// TIENDAS INSCRIPCION DE NUEVA TIENDA////

if( isset($_POST['ref'])      AND
    isset($_POST['fUsuario']) AND
    isset($_POST['fPin'])     AND
    isset($_POST['fNtienda']) AND 
    isset($_POST['fRubro'])   AND
    isset($_POST['fUbicacion'])        
){
	$nombreTienda    = $_POST['fNtienda'] ;
	$rubroTienda     = $_POST['fRubro']   ;
	$ubicacionTienda = $_POST['fUbicacion'];
	$idUsuario = my_simple_crypt( $_POST['ref'], 'd', $claveEncriptacion, $secret );// desencripta
	$nombres   = $_POST['fNombres']; 
	$usuario   = $_POST['fUsuario'];
	$pin       = $_POST['fPin']    ; // 4 digitos
	
	$datosTienda = true;
	
	// link NOOOOO FUNCIONA
	//$link = hash('ripemd256', $idUsuario.$ip.'registro' ); // hash usuario + ip + 'registro'
	$values = "SELECT  id  FROM serContrato WHERE idUsuario='$idUsuario' ";
	$result = $dbc->query($values);	
	$check1  = mysqli_num_rows($result);
	
	$values = "SELECT  id  FROM usuarios WHERE idUsuario='$idUsuario' OR usuario='$usuario'";
	$result = $dbc->query($values);	
	$check2  = mysqli_num_rows($result);
	
	$values = "SELECT  id  FROM tiendas WHERE idUsuario='$idUsuario' ";
	$result = $dbc->query($values);	
	$check3  = mysqli_num_rows($result);
	
    //**************************************************************************************
    $values = "SELECT  email, nombre, producto  FROM inscripcion WHERE idUsuario='$idUsuario' 
	           AND estatus='approved'
	           AND medioPago IS NOT NULL 
	           AND collection_id IS NOT NULL 
	           AND collection_status IS NOT NULL"; 
	          
	$result = $dbc->query($values);	
	$filas  = mysqli_num_rows($result);	
	if($filas == 1 AND $check1 == 0 AND $check2 == 0 AND $check3 == 0){   // solo si existe un registro para acreditar pago continua
		//echo '<br> encontro 1 resultado <br>';
		while($row = $result -> fetch_assoc()){
		    $productoUsuario = $row['producto'];
		    $emailUsuario    = $row['email'];
		    $nombreUsuario   = $row['nombre'];
		};
		// carga los datos del servicio contratado
		if($productoUsuario == 'Ecommerce'){
			$precio = 150;
		} elseif ($productoUsuario == 'Servicio'){
			$precio = 90;
		};
		// calcula vencimiento a 1 año
		$vencimiento = date("Y-m-d",strtotime($hoyA."+ 365 days"));
		// carga servicio contratado
		$values = "INSERT INTO serContrato (idUsuario, tipoServ, precio, vencimiento, estatus, fecha) 
		           VALUES ('$idUsuario','$productoUsuario', '$precio', '$vencimiento','approved','$hoyB')";
		$result = $dbc->query($values);
		
		// carga los datos en usuarios
		$values = "INSERT INTO usuarios (idUsuario, nombres, email, usuario, pin, fecha) 
		           VALUES ('$idUsuario', '$nombreUsuario', '$emailUsuario','$usuario', '$pin', '$hoyA')";
		$result = $dbc->query($values);
	
		// carga los datos en tiendas
		$values = "INSERT INTO tiendas (idUsuario, nomTienda, rubro, ubicacion, fecha) 
		           VALUES ('$idUsuario','$nombreTienda', '$rubroTienda','$ubicacionTienda','$hoyA' )";
		$result = $dbc->query($values);
		 
		$enviarCorreo = true;
		
		$mensajeEmail = 'TE HAS REGISTRADO CORRECTAMENTE<br>';
		$mensajeEmail .='PARA INGRESAR AL SISTEMA POR PRIMERA VES HAS CLICK EN EL SIGUIENTE LINK';
		$mensajeEmail .= '<br><a href="localhost/login/login.html">INGRESAR EL SISTEMA</a> ';
		
		$emailInscripcion = $emailUsuario;
		$nombreInscripcion = $nombreUsuario;
    } else { header('Location:login.html'); }; // si ya se cargo el formulario envia al login
};
//*********************************************
///////////////////// LOGIN //////////////
//$_POST['logUsuario'] = 'DiegoDiego';
//$_POST['logPin'] = '1234';
if( isset($_POST['logUsuario']) AND 
    isset($_POST['logPin'])     
){
	$logUsuario = $_POST['logUsuario'];
	$logPin     = $_POST['logPin']    ;
	
	$values = "SELECT idUsuario, nombres, email, usuario  FROM usuarios WHERE usuario='$logUsuario' AND pin='$logPin' LIMIT 1"; 
    $result = $dbc->query($values)    ;	
   
    while($row = $result -> fetch_assoc()){
	    $idUsuarioLogin = $row['idUsuario'];
	    $nombresLogin   = $row['nombres'];
	    $emailLogin     = $row['email'];
	    $usuarioLogin   = $row['usuario'];
	};
	
	$values = "SELECT estatus  FROM serContrato WHERE idUsuario='$idUsuarioLogin' LIMIT 1"; 
    $result = $dbc->query($values)    ;	
   
    // consulta el estado del pago
    while($row = $result -> fetch_assoc()){
	    $estatusPago = $row['estatus'];
	};
		
	if($idUsuarioLogin != '' AND $estatusPago == 'approved' AND $usuarioLogin == $logUsuario ){
		// link valor para confirmar registro rsa256 usuario y la ip desde donde se cargaron los datos
		$link = hash('ripemd256', $idUsuarioLogin.$ip.'login' ); // usuario + ip + 'login'
		
		// actualiza el valor de link 
		$values = "UPDATE usuarios SET link= '$link' WHERE idUsuario='$idUsuarioLogin'";
		$result = $dbc->query($values);
		
		// genera numero de 30 digitos al azar
		$cookieActividad = '';
		for($i=0;$i<30;$i++){
		    $cookieActividad .= rand(0,9);
	    };
	    $hashCookie = hash('ripemd256', $cookieActividad); 
	    
	    $hashConexion = hash('ripemd256', $link.$hashCookie); // experimental hash link+cookie
		
		// numero de logueo //
		$values = "INSERT INTO actividad (idUsuario, fecha, cookie, ip)  
	               VALUES ('$idUsuarioLogin', '$hoyB', '$hashCookie', '$ip')";
	    $result = $dbc->query($values);   
	
		//$datosLogueo = true;
		$encabezdo    = 'TE HAS CONECTADO AL SISTEMA CORRECTAMENTE <br>';
		$mensajeEmail = $encabezdo.'<br>'.
		                $nombresLogin.'<br>'.
		                '<br><a href="localhost/login/logueado.php?login='.$hashCookie.'&conect='.$hashConexion.'">Link para ingresar al Dashboard</a> '.
		                $hoyA;              
		// envia la cookie + hash(link + cookie)                
		                
		$enviarCorreo = true;
		$emailInscripcion = $emailLogin;
		echo $emailLogin.' - ';
		$nombreInscripcion  = $nombresLogin;
		echo $nombresLogin;
		
	};
	/*
	 else {    // falta el pago
		$encabezdo    = '<h1>AUN ESTA PENDIENTE EL PAGO DEL SERVICIO CONTRATADO</h1><br>
		                 <h3>falta agregar link del pago de mercado pago</h3><br>';
		$mensajeEmail = $encabezdo.'<br>'.
		                $nombresLogin.'<br>'.
		                $apellidosLogin.'<br>'.
		                $hoyA;
		//$enviarCorreo = true;	
	}; 
	*/
};

//******************************************
////// RECUPERAR PIN /////////

if(isset($_POST['fRecuperar'])){
	
	$recuperarCorreo = $_POST['fRecuperar'];
	
	$values = "SELECT idUsuario, nombres, apellidos  FROM usuarios WHERE email='$recuperarCorreo' LIMIT 1"; 
    $result = $dbc->query($values)    ;
       
    while($row = $result -> fetch_assoc()){
	    $idUsuarioRecuperacion = $row['idUsuario'];
	    $nombresRecuperacion   = $row['nombres']  ;
	    $apellidosRecuperacio  = $row['apellidos'];
	}; 
    if($idUsuarioRecuperacion != ''){
	    
	    // genera numero de 30 digitos al azar
		$cookieActividad = '';
		for($i=0;$i<30;$i++){
		    $cookieActividad .= rand(0,9);
	    };
	    
	    $hashCookie = hash('ripemd256', $cookieActividad);
	    // numero de logueo //
		$values = "INSERT INTO actividad (idUsuario, fecha, cookie, ip)  
	               VALUES ('$idUsuarioRecuperacion', '$hoyA', '$hashCookie', '$ip')";
	    $result = $dbc->query($values);
	    
	    $hashConexion = hash('ripemd256', $link.$hashCookie); // experimental hash link+cookie
	    
	    // link valor para confirmar registro rsa256 usuario y la ip desde donde se cargaron los datos
		$link = hash('ripemd256', $idUsuarioLogin.$ip.'recuperar' );
		
		// actualiza el valor de link 
		$values = "UPDATE usuarios SET link= '$link' WHERE idUsuario='$idUsuarioRecuperacion'";
		$result = $dbc->query($values);
		
		$encabezdo    = 'CREA UN NUEVO PIN <br>';
		$mensajeEmail = $encabezdo.'<br>'.
		                $nombresRecuperacion.'<br>'.
		                $apellidosRecuperacio.'<br>'.
		                '<br><a href="localhost/login/nuevoPin.php?pin='.$link.'&ref='.$hashConexion.'">LINK</a> '.
		                $hoyA;
		$enviarCorreo = true;
    };	
};


///////////////// MENSAJE DE CORREO /////////////////
// si los dos formularios estan completos y cargados envia el correo
if( $datosUsuarios AND $datosTienda){	
	
	echo 'se cargaraon los datos del nuevo usuario';
	
	$encabezdo = 'Un nuevo usuario se ha registrado al sistema <br>';
	$mensajeEmail = $encabezdo.$nombres.'<br>'.
	                $apellidos.'<br>'.
	                $email.'<br>'.
	                $nombreTienda.'<br>'.
	                $rubroTienda.'<br>'.
	                $usuario.'<br>'.
	                $ubicacionTienda.'<br><br>en correo debe ser confirmado '.
	                $hoyA;
	
	
	$mensajeEmail .= '<br><a href="localhost/login/logueado.php?link='.$link.'">LINK</a> ';

	$enviarCorreo = true;	
	    
};



//////// ENVIO DE CORREO ///

use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

if($enviarCorreo == true){
	
	$encriptarUsr = '000';
	
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 2;
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = "digipop.latan@gmail.com"; 
	$mail->Password = "sieteElementos1";
	$mail->setFrom('digipop.latan@gmail.com', 'Diego Montenegro');
	$mail->addReplyTo('licorona78@gmail.com', 'Diego 2');
	    
	    $name  = $nombreInscripcion; 
	    
	    $email = $emailInscripcion;
	    
	$mail->addAddress($email, $name);
	$mail->Subject = 'Digipop GmailTest';
	
	if($mensajeEmail == '' ){
	   $mensajeEmail =  'ES UN MENSAJE DE PRUEBA DEL SISTEMA DE DIGIPOP DESDE SU CUENTA DE GMAIL';
	};
	
	$mail->msgHTML( $mensajeEmail );
	
	if(!$mail->send()){ }; /// 	LLAMA LA FUNCION QUE ENVIA EL CORREO 
};

function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}

//////////////////////////////
ob_end_flush(); //
gc_collect_cycles();	
?>

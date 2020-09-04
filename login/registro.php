<!DOCTYPE html>
<html>
<body>

<h2>Registro</h2>

<form action="registro.php" method="post">
  <label for="fname">Nombres:</label><br>
  <input type="text" id="fNombres" name="fNombres" value=""><br><br>
  
  <label for="lname">Last name:</label><br>
  <input type="text" id="fApellidos" name="fApellidos" value=""><br><br>
  
  <label for="lname">Documento:</label><br>
  <input type="text" id="fDodumento" name="fDodumento" value=""><br><br>
  
  <label for="lname">Telefono:</label><br>
  <input type="text" id="fTelefono" name="fTelefono" value=""><br><br>
  
  <label for="lname">Email:</label><br>
  <input type="text" id="fEmail" name="fEmail" value=""><br><br>
  
  <label for="lname">Nombre Tienda:</label><br>
  <input type="text" id="fNtienda" name="fNtienda" value=""><br><br>
  
  <label for="lname">Rubro:</label><br>
  <input type="text" id="fRubro" name="fRubro" value=""><br><br>
  
  <label for="lname">Usuario:</label><br>
  <input type="text" id="fUsuario" name="fUsuario" value=""><br><br>
  
  <label for="lname">Clave:</label><br>
  <input type="text" id="fClave" name="fClave" value=""><br><br>
  
  <input type="submit" value="Submit">
</form> 

<?php
////// REGISTRAR NUEVO CLIENTE //////
require('log/log.php');
//require 'vendor/autoload.php';
//use PHPMailer\PHPMailer\PHPMailer;

/// CONEXION DB ///
$dbc = mysqli_connect(DBHOST,DBUSER,DBPW);
if (!$dbc) {
    exit();
}

$dbs = mysqli_select_db($dbc, DBNAME);
if (!$dbs) {
    exit();
}

///////////// HORA ////////////

date_default_timezone_set('America/Mazatlan');//hora de mazatlan
$hoy = date('j-n-Y G:i');//fecha de hoy  1-1-2001 23:01
$hoyA =date('j-n-Y');

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


///////// cargar datos //////////
$mensajeEmail = '';
$enviarCorreo = false;

if( isset($_POST['fNombres'])   AND
    isset($_POST['fApellidos']) AND
    isset($_POST['fDodumento']) AND
    isset($_POST['fTelefono'])  AND
    isset($_POST['fEmail'])     AND
    isset($_POST['fNtienda'])   AND
    isset($_POST['fRubro'])     AND
    isset($_POST['fUsuario'])   AND
    isset($_POST['fClave'])
){
	$nombres   = $_POST['fNombres'];
	$apellidos = $_POST['fApellidos'];
	$documento = $_POST['fDodumento'];
	$telefono  = $_POST['fTelefono'];
	$email     = $_POST['fEmail'];
	$tienda    = $_POST['fNtienda'];
	$rubro     = $_POST['fRubro'];
	$usuario   = $_POST['fUsuario'];
	$clave     = $_POST['fClave'];
	
	$cookie = 'cookie'.rand(1000,9999);
	
	$values = "INSERT INTO registro ( nombres, apellidos, documento, telefono, email, tienda, rubro, dato1, dato2, status1 ) 
	           VALUES ('$nombres', '$apellidos', '$documento', '$telefono', '$email', '$tienda', '$rubro', '$usuario', '$clave', '$cookie')";
	$result = $dbc->query($values);
	
	echo 'se cargaraon los datos del nuevo usuario';
	
	$encabezdo = 'Un nuevo usuario se ha registrado al sistema <br>';
	$mensajeEmail = $encabezdo.$nombres.'<br>'.$apellidos.'<br>'.$documento.'<br>'.$telefono.'<br>'.$email.'<br>'.$tienda.'<br>'.$rubro.'<br>'.$usuario.'<br>'.$clave.'<br><br>en correo debe ser confirmado '.$hoy;
	
	$mensajeEmail .= '<br><a href="localhost/login/logueado.php?link='.$cookie.'">LINK</a> ';

	$enviarCorreo = true;	
	    
};


$encriptarUsr = '000';
 
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

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
    $name = 'Diego Montenegro';
    $email= 'diegographics2@gmail.com';
$mail->addAddress($email, $name);
$mail->Subject = 'Digipop GmailTest';

if($mensajeEmail == '' ){
   $mensajeEmail = 'ES UN MENSAJE DE PRUEBA DEL SISTEMA DE DIGIPOP DESDE SU CUENTA DE GMAIL';
};

$mail->msgHTML( $mensajeEmail );

if($enviarCorreo == true){
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
/*
if( $_POST["name"] || $_POST["weight"] ) { 
      if (preg_match("/[^A-Za-z'-]/",$_POST['name'] )) { 
         die ("invalid name and name should be alpha"); 
      } 
      echo "Welcome ". $_POST['name']. "<br />"; 
      echo "You are ". $_POST['weight']. "kgs in weight."; 
        
      exit(); 
   } 
*/	
?>

</body>
</html>

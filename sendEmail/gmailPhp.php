<?php
/*	
DEFINE ('DBUSER', 'WEE'      ); 
DEFINE ('DBPW'  , 'marAzul'   ); 
DEFINE ('DBHOST', 'localhost' ); 
DEFINE ('DBNAME', 'WEE'       ); 

$encriptar = '';

$dbc = mysqli_connect(DBHOST,DBUSER,DBPW);
if (!$dbc) {
    echo ' error ';
}

$dbs = mysqli_select_db($dbc, DBNAME);
if (!$dbs) {
    echo ' error ';
}
	
	
if(isset($_POST['name'])){
		     	    
    $name  = $_POST['name'] ;
    $email = $_POST['email'];
    $pwd   = $_POST['pwd']  ;
    $type  = $_POST['type'] ;
    
    $encriptarUsr = $name.$email.$type;
    $encriptarUsr = hash('ripemd256', "$encriptarUsr" );
    
    $encriptarPw = $name.$email.$pwd;
    $encriptarPw = hash('ripemd256', "$encriptarPw" );
    
    $valuesX = "SELECT id FROM login WHERE nombre='$name' OR email='$email' "; // busca la unidad en bloque de 30 numeros
    $resultX = $dbc->query($valuesX)    ;
    $filasX  = mysqli_num_rows($resultX);
    
    if( $type == 'exportador' OR $type == 'importador' OR $type == 'broker'){
	    $estatus = 2;
    } elseif($type == 'crypto'){
	    $estatus = 3;
    }

    
    if( $filasX == 0 ){  // SI NO EXISTE REGISTRO LO AGREGA
	    $values="INSERT INTO login (nombre, email,clave,estatus,tipo,hash,hashPw) VALUES ('$name','$email','$pwd','$estatus','$type','$encriptarUsr','$encriptarPw')";
	    $result = $dbc->query($values);
	    
	    mkdir ('uploads/'.$encriptarUsr , 0700);
	    
	    $values1 = "INSERT INTO Documentos (nombre, email, hash) VALUES ('$name','$email','$encriptarUsr')";
	    $result1 = $dbc->query($values1);
    }
 	  
    	  
}	
*/	

$encriptarUsr = '000';

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
 
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
//$mail->Username = "wee.argentina@gmail.com";
$mail->Username = "digipop.latan@gmail.com"; 

//Password to use for SMTP authentication
//$mail->Password = "unabuenacancion";
$mail->Password = "sieteElementos1";

//Set who the message is to be sent from
//$mail->setFrom('wee.argentina@gmail.com', 'Diego Montenegro');
$mail->setFrom('digipop.latan@gmail.com', 'Diego Montenegro');


//Set an alternative reply-to address
$mail->addReplyTo('licorona78@gmail.com', 'Diego 2');

//*********************************************************


$name = 'Diego Montenegro';
$email= 'diegographics2@gmail.com';


//Set who the message is to be sent to
//$mail->addAddress('licorona78@gmail.com', 'John Doe');
$mail->addAddress($email, $name);


//*********************************************************

//Set the subject line
$mail->Subject = 'Digipop GmailTest';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('hola.html'), __DIR__);

//Replace the plain text body with one created manually  CORRECTO !!!!!
//$mail->msgHTML( 'This is a plain-text message body');

/*

if( $filasX == 0 ){
    $mensajeEmail = 'GRACIAS POR TU PREFERENCIA '.$name.'. PARA CONTINUAR CON LA INSCRIPCION DE TU EMPRESA POR FAVOR INGRESA AL SIGUIENTE LINK: <br>
http://177.226.148.80/wee/inscription.php?ref='.$encriptarUsr;
}else{ 
	$mensajeEmail = 'EL USUARIO QUE DESEA REGISTRAR YA EXISTE'; 
};

*/

$mensajeEmail = 'ES UN MENSAJE DE PRUEBA DEL SISTEMA DE DIGIPOP DESDE SU CUENTA DE GMAIL';

$mail->msgHTML( $mensajeEmail );




//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    //echo "Mailer Error: " . $mail->ErrorInfo; // 	IMPORTATE
} else {
    //echo "Message sent!";    // IMPORTANTE
    
    //Section 2: IMAP
    //Uncomment these to save your message in the 'Sent Mail' folder.
    #if (save_mail($mail)) {
    #    echo "Message saved!";
    #}
}
//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
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
?>
<?php
////// CONSULTAR ESTADO DE LOS PAGOS MEXICO //////
//[payment_id] => 29709035
//https://api.mercadopago.com/v1/payments/29709035?access_token=TEST-1288291950076869-090905-6c6673303a9bcbaa11fe516719a56778-640424739

use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';	
require('log/log.php');
$hoyA = date('Y-m-d'); //YYYY-MM-DD

/// CONEXION DB ///
$dbc = mysqli_connect(DBHOST,DBUSER,DBPW);
if (!$dbc) {
    exit();
}

$dbs = mysqli_select_db($dbc, DBNAME);
if (!$dbs) {
    exit();
}

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


$hoyA = date('Y-m-d'); //YYYY-MM-DD
$hoyB = date('Y-m-d G:i'); // YYYY-MM-DD 24:00
$hoyC = date("Y-m-d",strtotime($hoyA."- 2 days"));
echo 'Vencimiento '.$hoyC.'<br>*********************<br>';
//****************************
$contador = 0;
// CONSULTA EL ESTADO DE PAGO DE LOS PENDIENTES SIN VENCIMIENTO
$values = "SELECT collection_id, payment_type, fecha, email, nombre, idUsuario  FROM inscripcion WHERE estatus='pending' AND collection_status='pending' AND fecha > '$hoyC' "; 
$result = $dbc->query($values)    ;
$filas  = mysqli_num_rows($result);	
if($filas > 0){   
    while($row = $result -> fetch_assoc()){ 
	    
	    $contador += 1;
	       
	    $collectionId = $row['collection_id'];
	    $fecha  = $row['fecha'];
	    $emailX = $row['email'];
	    $nombreX= $row['nombre'];
	    $idUsuarioX = $row['idUsuario'];
	    
	    $tipoPago = $row['payment_type'];
	    if( $tipoPago == 'ticket' ){
		    $fpago = 'EFECTIVO';
	    } elseif ( $tipoPago == 'atm'){
		    $fpago = 'BANCO';
	    };
	    echo 'Collectio_id '.$collectionId.' '.$fecha.' '.$tipoPago.'->'.$fpago.'<br>';  
	    
	    $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://api.mercadopago.com/v1/payments/'.$collectionId.'?access_token=TEST-1288291950076869-090905-6c6673303a9bcbaa11fe516719a56778-640424739');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		$output = curl_exec($ch);
		if($output === FALSE){
			echo "cURL Error".curl_error($ch);
		};
		curl_close($ch);
		$datos1 = json_decode($output,true);
		echo $datos1['status'].' '.$datos1['status_detail'].' '.$datos1['transaction_amount'].'MXN <br>';
		echo '----------------<br>';
		
		//if( $datos1['status'] == 'approved'){
		if( $datos1['status'] == 'pending' AND $contador == 1){	// test
			// actualiza el estado del pago
			$values1 = "UPDATE inscripcion SET estatus= 'approved', collection_status='approved' WHERE collection_id='$collectionId'";
			$result1 = $dbc->query($values1);
			
			
			//////// ENVIO DE CORREO ///
					
			if($nombreX != '' AND $emailX!=''){
				
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
				    
				    $name  = $nombreX; 
				    $email = $emailX;
				    
				$mail->addAddress($email, $name);
				$mail->Subject = 'Digipop GmailTest';
				
			    $mensajeEmail =  'HEMOS REGISTRADO TU PAGO. PARA CONTINUAR INGRESA AL LINK.<br>';
			    //$mensajeEmail =  'EL PAGO SE REGISTRO CORRECTAMENTE<br>';
			    $mensajeEmail .= $nombreX.'<br>';
			    $idUsuarioAES = my_simple_crypt( $idUsuarioX, 'e', $claveEncriptacion, $secret );
			    $mensajeEmail .= '<br><a href="localhost/login/formulario.php?link='.$idUsuarioAES.'">Ingresar al formulario de registro</a> ';
							
				$mail->msgHTML( $mensajeEmail );
				
				if(!$mail->send()){ }; /// 	LLAMA LA FUNCION QUE ENVIA EL CORREO 
			};
			
			
			//////////////////////////////
			
		}; // actualizar datos y enviar correos para continuar
        
    };  	    
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
	
	
	
//************
gc_collect_cycles();
//mysql_free_result();	
?>
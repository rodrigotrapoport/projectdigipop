<?php
ob_start();      // permite corregir error en header o salto a otra pagina
session_start(); // leer cookies

//error_reporting(0);	
////// REGISTRAR NUEVO CLIENTE //////
require('log/log.php');

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
$mensaje0 = 'ERROR'; // mensaje vacio
$mensaje1 = 'ERROR'; // mensaje vacio
$enviarCorreo = false;
$pagoAplicado = false;
	
////// PAYPAL /////	
if(isset($_GET['data'])){
	$datosPaypal = $_GET['data'];
	$refAES = my_simple_crypt( $datosPaypal, 'd', $claveEncriptacion, $secret );// deencripta
	echo 'paypal '.$refAES;
	$mensaje0 = 'GRACIAS POR CONTRATAR NUESTROS SERVICIOS. TE ENVIAMOS UN CORREO PARA CONTINUAR CON LA CARGA DE DATOS DE TU NUEVO NEGOCIO!';
	$mensaje1 = 'SE ACREDITO EL PAGO CORRECTAMENTE';
	
	$values = "SELECT idUsuario, email, nombre  FROM inscripcion WHERE codigoPago='$refAES' 
	           AND estatus='approved' 
	           AND medioPago='paypal' 
	           AND collection_id IS NOT NULL 
	           AND collection_status IS NOT NULL";  // corregir si cambia metodo pago y pago  pending  o rechazado
	          
	$result = $dbc->query($values);	
	$filas  = mysqli_num_rows($result);	
	if($filas == 1){   // solo si existe un registro para acreditar pago continua
		echo '<br> encontro 1 resultado <br>';
		while($row = $result -> fetch_assoc()){
		    $idUsuario    = $row['idUsuario'];
		    $emailUsuario = $row['email'];
		    $nombreUsuario= $row['nombre'];
		};
		$enviarCorreo = true;
		$pagoAplicado = true;
		echo '<br>se envio un email Paypal';
	};	
};

///// MERCADO PAGO ///
if(isset($_POST['back_url'])){
	
	$datos = $_POST['back_url'];
	print_r($_POST);
	
	echo '<br><br><br>';
	/*
	[preference_id] => 640424739-72274df7-2ec5-4d1f-a23e-b2896dc3c111 
	[external_reference] => 
	
	[back_url] =>   http://5038b7616653ed864ec24f991112e1c7ac02e27aef1348a5664a302a679c0442-pago-Ecommerce-9142438532-2020-09-12?
					collection_id=29709035       &
					collection_status=approved   &
					external_reference=null      &
					payment_type=credit_card     &
					merchant_order_id=1771852637 &
					preference_id=640424739-72274df7-2ec5-4d1f-a23e-b2896dc3c111 &
					site_id=MLM                  &
					processing_mode=aggregator   &
					merchant_account_id=null 
					
	[payment_id] => 29709035 
	[payment_status] => approved
	[payment_status_detail] => pending_waiting_payment 
	[payment_status_detail] => accredited 
	[merchant_order_id] => 1771852637 
	[processing_mode] => aggregator 
	[merchant_account_id] => 
	
	[payment_id] => 29709035
	https://api.mercadopago.com/v1/payments/29709035?access_token=TEST-1288291950076869-090905-6c6673303a9bcbaa11fe516719a56778-640424739
	*/
	
	//$datos = 'http://pago=pago-Ecommerce-9142438532-2020-09-12?collection_id=29709035&collection_status=approved&external_reference=null&payment_type=credit_card&merchant_order_id=1771852637&preference_id=640424739-72274df7-2ec5-4d1f-a23e-b2896dc3c111&site_id=MLM&processing_mode=aggregator&merchant_account_id=null';
	
	// test_user_33697987@testuser.com
	
	$datos = str_replace('http://', '', $datos);
	$datos = str_replace('?', '&', $datos);
	
	$arrayDatos = explode('&', $datos);
	
	$arrayPago = array();
	//echo count($arrayDatos).' cantidad de datos <br>';
	
	for($i=0; $i<count($arrayDatos);$i++ ){
		
		$x1 = explode('=', $arrayDatos[$i]);
			
		$arrayPago[$x1[0]]= $x1[1];
	};
	//var_dump($arrayPago);
	
	echo $arrayPago['pago'].'<br>';
	echo $arrayPago['collection_id'].'<br>';
	echo $arrayPago['collection_status'].'<br>';
	echo $arrayPago['external_reference'].'<br>';
	echo $arrayPago['payment_type'].'<br>';  
	/// atm BANCO - credit_card - debit_card - ticket OXXO 7SEVEN - account_money Mlibre - prepaid_card Mlibre - digital_wallet Paypal
	echo $arrayPago['merchant_order_id'].'<br>';
	echo $arrayPago['preference_id'].'<br>';
	echo $arrayPago['site_id'].'<br>';
	echo $arrayPago['processing_mode'].'<br>';
	echo $arrayPago['merchant_account_id'].'<br>';
	echo $_POST['payment_status'].'<br>'; 
	echo $_POST['payment_status_detail'].'<br>';
	
	$pago = $arrayPago['pago']; // digipopID pago
	$collection_id = $arrayPago['collection_id']; // numero de rastreo de operacion en MP
	$collection_status = $arrayPago['collection_status'];
	$estatus = $_POST['payment_status']; // estado de la transaccion
	$estatusDetalle = $_POST['payment_status_detail']; // detalle del estatus
	$metodoPago = $arrayPago['payment_type']; // metodo con que se realizo el pago
	$paisTienda = $arrayPago['site_id'];  // pais donde esta la tienda
	
	if( $arrayPago['collection_status'] == 'approved' ){
	    $mensaje0 = 'GRACIAS POR CONTRATAR NUESTROS SERVICIOS. TE ENVIAMOS UN CORREO PARA CONTINUAR CON LA CARGA DE DATOS DE TU NUEVO NEGOCIO!';
	    $mensaje1 = 'SE ACREDITO EL PAGO CORRECTAMENTE';
	} elseif ($arrayPago['collection_status'] == 'pending'){
		$mensaje0 = 'EL PAGO AUN SE ENCUENTRA PENDIENTE. AL ACREDITARSE TE ENVIAREMOS UN CORREO PARA CONTINUAR CON LA CARGA DE DATOS DE TU NUEVO NEGOCIO.';
		$mensaje1 = 'SE ENCUENTRA PENDIENTE EL PAGO';	
	} else {
	    $mensaje0 = 'ERROR';
	    $mensaje1 = 'ERROR'; 	
	};
	
	/// SE REGISTRA LA OPERACION APLICADA O PENDIENTE
	
	$values = "SELECT  idUsuario, email, nombre  FROM inscripcion WHERE codigoPago='$pago' 
	           AND estatus IS NULL 
	           AND medioPago IS NULL 
	           AND collection_id IS NULL 
	           AND collection_status IS NULL";  // corregir si cambia metodo pago y pago  pending  o rechazado
	          
	$result = $dbc->query($values);	
	$filas  = mysqli_num_rows($result);	
	if($filas == 1){   // solo si existe un registro para acreditar pago continua
		//echo '<br> encontro 1 resultado <br>';
		while($row = $result -> fetch_assoc()){
		    $idUsuario       = $row['idUsuario'];
		    $emailUsuario    = $row['email'];
		    $nombreUsuario   = $row['nombre'];
		    
		};
		// ACTUALIZA EL REGISTRO
		$values = "UPDATE inscripcion SET medioPago='$metodoPago', estatus='$estatus', collection_id='$collection_id', payment_type='$metodoPago', 
		           site_id='$paisTienda', collection_status='$collection_status' WHERE idUsuario='$idUsuario' AND codigoPago='$pago'";
		$result = $dbc->query($values);	
		
		if($estatus == 'approved'){					
			$enviarCorreo = true; // el pago se aplico
			$pagoAplicado = true;
			echo '<br>se envio un email  MP';
		} elseif ($estatus == 'pending'){
			$enviarCorreo = true; // el pago esta pendiente
	        $pagoAplicado = false;
		};	
	}; 
}; // FIN IF MERCADO PAGO

///*********** ENVIAR CORREO CON LINK


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
		$name  = $nombreUsuario; 
	    $email = $emailUsuario; 
	$mail->addAddress($email, $name);
	$mail->Subject = 'Digipop GmailTest';
	
	if($pagoAplicado){
	   $mensajeEmail =  'EL PAGO SE REGISTRO CORRECTAMENTE<br>';
	   $mensajeEmail .= $nombreUsuario.'<br>';
	   $idUsuarioAES = my_simple_crypt( $idUsuario, 'e', $claveEncriptacion, $secret );
	   $mensajeEmail .= '<br><a href="localhost/login/formulario.php?link='.$idUsuarioAES.'">Ingresar al formulario de registro</a> ';
 
	} else {
	   $mensajeEmail =  'EL PAGO SE ENCUENTRA PEDIENTE AUN. FAVOR DE PAGAR O ESPERAR QUE SE ACREDITE EN EL SISTEMA.<br>';
	   $mensajeEmail .= $nombreUsuario.'<br>';
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


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digipop Tech</title>
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
	    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous">
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
	    crossorigin="anonymous">
	</script>
    <link rel="stylesheet" href="css/estilosiniciar.css">
    
    <style>
	    
		.fondo {
		  background-image: linear-gradient(#D8D8DF, #EFEFF0);
		  background-repeat: no-repeat; 
		  background-size: cover;     
		  height: 100%;  
		}
		
		img {
	        width: 250px;
	        -webkit-filter: drop-shadow(5px 5px 10px #666666);
	        filter: drop-shadow(5px 5px 5px #666666);
	    }
	    .footer {
		  position: absolute;
		  bottom: 0;
		  width: 100%;
		}
		.v-divider{
		 margin-left:5px;
		 margin-right:5px;
		 width:1px;
		 height:100%;
		 border-left:1px solid gray;
		}
		.sinFondo {
			background-color:rgba(0,0,0,0);
	    } 
    </style>
    
</head>
<body class="fondo" onload="incio()">
<br><br>
    
<section>
    <div class="container">
	    <div class="row justify-content-md-center">
	        <img src="digiPop.svg" height="70px"  class="col-md-3 col8"><br>
	    </div>
	    <br>
	    <p class="h3 text-dark text-center"><?php echo $mensaje1;?></p>
	    <hr>
	    <div class="jumbotron jumbotron sinFondo" id="jumbo" >
		    <div class="">
		        <h1 class="display-4 text-center"><?php echo $mensaje0;?></h1>
		        <p class="lead text-center">Para mas información o consultas envianos un correo a hola@digipop.tech .</p>
		    </div>
		</div>
	    
<?php

 



?>
    </div>
</section>
    
	<br><br>    
<div>
	<nav class="navbar navbar-light bg-dark text-white">
	  <a class="navbar-brand text-white" href="www.digipop.tech">
	    <img src="digiPop.svg"  height="40" class="d-inline-block align-top" alt="">www.digipop.tech
	  </a>
	  <a class="text-center">hola@digipop.tech</a>
	</nav> 
</div>   
    
    
    
</body>

</html>	  
<?php 
ob_end_flush();
gc_collect_cycles();
?>


  

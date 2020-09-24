<?php
error_reporting(0); // ocultar los errores
//require  "key.php";  // FALTA INGRESAR LOS DATOS A LA FUNCION


//require('secciones/secciones.php');
$hoy = date('j-n-Y G:i');//fecha de hoy  1-1-2001 23:01
$fp = fopen('carritoCopras.php','w');

if ( $_POST['precioB'] == ''){
	$precio = $_POST['precioA'];
} else {
	$precio = $_POST['precioB'];
}

$string  =  $_POST['titulo'].' *** '.$_POST['marca'].' *** '.$precio.' *** '.$_POST['disponible'].' *** '.$_POST['tamaño'].' *** cantidad '.$_POST['cantidad'].' *** '.$_POST['foto'].' *** '.$hoy;

$string1 =  $_POST['titulo'].$_POST['marca'].$_POST['precioA'].$_POST['precioB']; 

$hashInput = $_POST['hash']; 
// hash que se envia desde productos

$hashControl = hash('sha256', $secret.$_POST['titulo'].$_POST['marca'].$_POST['precioA'].$_POST['precioB']); 
// hash que valida el precio

if( $hashInput == $hashControl ){
	$validacion = 'ok';
}
///****************** encriptar AES ***************
/*
$contrasena = "River"; /// clave string

$iteraciones = 7;

$sal = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);

$hash = hash_pbkdf2("sha256", $contrasena, $sal, $iteraciones, 64); // clave

$hashTest = '4774416552d698a31682b684c0b7f1b78023746175faf3192b2835d8f063427c'; // un solo has para testear

$key = pack('H*', $hashTest ); // clave final de encriptacion              GUARDAR *******

$key_size =  strlen($key); // tamaño de la clave

$plaintext = $string; // texto a codificar

$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC); //    GUARDAR ******

$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

$ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $plaintext, MCRYPT_MODE_CBC, $iv);

$ciphertext = $iv . $ciphertext;

$ciphertext_base64 = base64_encode($ciphertext); // texto final codificado GUARDAR *******

//// decodificar ////

$ciphertext_dec = base64_decode($ciphertext_base64); // decodificar

$iv_dec = substr($ciphertext_dec, 0, $iv_size); // nece

$ciphertext_dec = substr($ciphertext_dec, $iv_size);

//                                                   nece    nece  
$plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec); // decodificador final
*/

function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    
    $claveEncriptacion = 'exito seguro!';
    $secret = 'texto secreto 1';

    $secret_key = $claveEncriptacion; // valores que se cargan desde key.php
    $secret_iv  = $secret;
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}

$encrypted = my_simple_crypt( $string, 'e' );   // encripta el string con todas las variables
//echo($encrypted);

$decrypted = my_simple_crypt( $encrypted, 'd' );// desencripta el string
//echo $decrypted;


//****************************************

$tx = 'hola';
$resultado = array("res" => $encrypted.'|' );
echo json_encode($resultado);


/// almacena en un php el resultado
	
fwrite($fp, $string);
fclose($fp);
//echo 'EL DOCUMENTO SE CREO EXITOSAMENTE '.$hoy;	

	
	
	
?>
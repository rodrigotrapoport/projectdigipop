<?php
	
error_reporting(0);
require  "key.php"; // FALTA INGRESAR LOS DATOS A LA FUNCION

function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $claveEncriptacion = 'exito seguro!';
    $secret = 'texto secreto 1';

    
    $secret_key = $claveEncriptacion ; // valores que se cargan desde key.php
    $secret_iv  = $secret ;
 
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

//**********************************

if( isset($_POST['nombre']) AND isset($_POST['telefono']) AND isset($_POST['email']) AND isset($_POST['ciudad']) AND isset($_POST['estado']) AND isset($_POST['cp']) ){
	
	$string = $_POST['nombre'].'|'.$_POST['telefono'].'|'.$_POST['email'].'|'.$_POST['ciudad'].'|'.$_POST['estado'].'|'.$_POST['cp'];
	
	$encrypted = my_simple_crypt( $string, 'e' ); // encripta el string con todas las variables
    //echo($encrypted);
    
    $resultado = array("res" =>$encrypted );

    echo json_encode($resultado); // envias los resultados por ajax a seccion7
}

if( isset($_POST['datosPers']) AND $_POST['datosPers'] != ''){
	
	$decrypted = my_simple_crypt( $_POST['datosPers'], 'd' );// desencripta el string
    //echo $decrypted;
    
    $texto = explode('|', $decrypted);
    
    $nombre   = $texto[0];
    $telefono = $texto[1];
    $email    = $texto[2];
    $ciudad   = $texto[3];
    $estado   = $texto[4];
    $cp       = $texto[5];
    	
    $resultado = array("resA" =>$decrypted, "nombre"=>$nombre, "telefono"=>$telefono, "email"=>$email, "ciudad"=>$ciudad, "estado"=>$estado, "cp"=>$cp );

    echo json_encode($resultado); 
}


//************************************
	

//$card = 'aguante River';
	
	
	
	
?>
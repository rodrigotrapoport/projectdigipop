<?php
	
error_reporting(0);
require  "key.php"; // FALTA INGRESAR LOS DATOS A LA FUNCION

function my_simple_crypt( $string, $action = 'e', $clave, $secr ) {
    // you may change these values to your own
    //$claveEncriptacion = 'exito seguro!';
    //$secret = 'texto secreto 1';

    
    $secret_key = $clave ; // valores que se cargan desde key.php
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
    }
 
    return $output;
}

//***********************************************************

$carrito =  $_POST['carrito'];

$carrito = str_replace('undefined', '', $carrito);

$subtotalCarrito = 0;

if( $carrito != '' ){

	$productos = explode('|', $carrito); // separa cada articulo // HACER UN FOR -1 PARA CADA PRODUCTO Y DESENCRIPTAR
	
	$hasta = count($productos)-1;
		
	for ( $i=0 ; $i < $hasta ; $i++ ){
	
		$decrypted = my_simple_crypt( $productos[$i], 'd', $claveEncriptacion, $secret );// desencripta el string
		//$decrypted = my_simple_crypt( $productos[0], 'd' );// desencripta el string 
		//echo $decrypted;
		$prodSeleccionados = explode('***', $decrypted); // aqui se separa cada valor de cada articulo
		
		$card = $card.'<div class="container">'.  // EN CADA CICLO DEL FOR AGREGAR ID NUMERADA PARA REFERENCIAR EL ARTICULO A BORRAR
			        '<div class="media border rounded " style="border-color: #585858; ">'.
				        '<img src="'.$prodSeleccionados[6].'" class="align-self-start mr-0 col-5 col-sm-6 col-md-3" alt="...">'.
				        '<div class="media-body  align-middle   col-6 col-sm-6 col-md-8 text-left" style="margin-top: .25rem !important;">'.
				        '<h5 class="mt-0 text-uppercase">'.$prodSeleccionados[0].'</h5>'.
				        '<h5 class="mt-0 text-uppercase">'.$prodSeleccionados[1].'</h5>'.
				        '<p>'.$prodSeleccionados[2].'<sup>00</sup>'.$prodSeleccionados[3].' '.$prodSeleccionados[4].''.$prodSeleccionados[5].'</p>'.
				        '</div>'.
				        '<div class="float-right align-rigth">
					        <button type="button" class="close" aria-label="Close" id="close-'. $i .'"  onclick="cerrar('.$i.')" >
						        <span aria-hidden="true">&times;</span>
						    </button>	
					    </div>'.
			        '</div>'.
		        '</div><br>';
		        
		        $cantidad = str_replace('cantidad', '', $prodSeleccionados[5]);
		        $cantidad = str_replace(' ', '', $cantidad); // prepara el valor de cantidad
		        
		        $sub = str_replace('$', '', $prodSeleccionados[2]); // elimina el signo precio
	            $sub = str_replace(' ', '', $sub);                  // elimina los espacios
	            
                $subtotalCarrito = $subtotalCarrito + ( $sub * $cantidad );  // calcula el subtotal de la compra
                
	} // cierre del for 
	
		
	$hashSbt = hash('sha256', $subtotalCarrito.$secret); // hash del valor del subtotal + secret 
	
	$card =  $card.' <p id="sbtotal" style="display: none">'.$subtotalCarrito.'|'.$hashSbt.'</p>';  // subtotal
	
	//$card =  $card.' <p id="sbtotal" >'.$subtotalCarrito.'|'.$hashSbt.'</p>';  // subtotal
	
	
} else { $card = '<div class="container"><p><h1>EL CARRITO ESTA VACIO!</h1></p></div>';}

//****************************************

//$tx = 'hola';
//$resultado = array("res" =>$decrypted.' test '. $prodSeleccionados[0] );
$resultado = array("res" =>$card );

echo json_encode($resultado);
	
	
	
	
?>
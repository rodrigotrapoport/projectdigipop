<?php 	
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
$respuesta = '';
//**********************
//$_POST['input'] = 'OWRhU2VwbFgxN1hkTVdsbDdibEVMeTk2cjJvbDUvNXU4ZE9ibnlaU1B4aTVvWlpIWVRLVmVOekwrbjZmMzVoVw==';	
if(isset($_POST['input'])){	
    $input = $_POST['input'];
    $montoAES  = my_simple_crypt( $input, 'd', $claveEncriptacion, $secret );// desencripta
    file_put_contents('paypalResponde.txt', $montoAES);
    $output = 'venta registrada';	
    
    $codReferencia = explode('&', $montoAES);
    $ref = $codReferencia[2];
    
    /// SI EL PAGO SE APROBO REGISTRAR EL PAGO Y SI ESTA PENDIENTE IDIRCARLO

	$values = "SELECT id, idUsuario  FROM inscripcion WHERE codigoPago='$ref' 
	           AND estatus IS NULL 
	           AND medioPago IS NULL 
	           AND collection_id IS NULL 
	           AND collection_status IS NULL";  // corregir si cambia metodo pago y pago  pending  o rechazado
	          
	$result = $dbc->query($values);	
	$filas  = mysqli_num_rows($result);	
	if($filas == 1){   // solo si existe un registro para acreditar pago continua
		while($row = $result -> fetch_assoc()){
		    $idUsuario = $row['idUsuario'];
		};
		// ACTUALIZA EL REGISTRO
		$values = "UPDATE inscripcion SET medioPago='paypal', estatus='approved', collection_id='no aplica', payment_type='no aplica', 
		           site_id='MEX', collection_status='no aplica' WHERE idUsuario='$idUsuario' AND codigoPago='$ref'";
		$result = $dbc->query($values);
		$respuesta = 'ok';
	};
    
    
} else {
    file_put_contents('paypalResponde.txt', 'Sin informacion de paypal');
    $output = 'error no se pudo registrar venta';	
};

$resultado = array("res" =>$respuesta);

echo json_encode($resultado);

gc_collect_cycles();	
?>
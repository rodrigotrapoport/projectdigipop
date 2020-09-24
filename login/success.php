<?php
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


if( isset($_GET['pago']) AND
	isset($_GET['producto']) AND
	isset($_GET['ref'])
){
	$estatus    = $_GET['pago'];
	$referencia = $_GET['ref'];
	$medioPago = 'mercadoPago';
	// actualiza el valor de link 
	$values = "UPDATE inscripcion SET estatus='$estatus', medioPago='$medioPago'  WHERE codigoPago='$referencia'";
	$result = $dbc->query($values);
	
	//echo 'pago exitoso';
};	
	
	
// http://localhost/login/success.php?pago=aplicado&producto=Ecommerce&ref=pago-Ecommerce-9142438532-2020-09-12	
?>
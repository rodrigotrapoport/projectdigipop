<?php
	
error_reporting(0);

$carrito =  $_POST['carrito'];

if( $carrito != ''){
	$x = explode('|', $carrito);
	$n = count($x)-1; // cantidad de articulos en el carrito 
}	
if( $n == null ){
   $n = 0;	
}

$resultado = array("cant" =>$n);

echo json_encode($resultado);

	
	
?>
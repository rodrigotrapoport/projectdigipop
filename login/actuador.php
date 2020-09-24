<?php
// CONSULTA REGULARMENTE EL ESTADO DE PAGOS PENDIENTES DE OXXO O TRANSFERENCIAS
$i = 1;
while ($i <= 10) {
     
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'localhost/login/pagosPendientes.php');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	
	$output = curl_exec($ch);
	if($output === FALSE){
		echo "cURL Error".curl_error($ch);
	};
	curl_close($ch);
	print "ok  segundos ".$i*30.' ';
	$i++;  // bloquear para bucle infinito
	sleep(30);	
	//sleep(1800); // media hora
	//$valor = readline("Ingrese su nombre: ");	
	
};	 // salida del while
	
?>
<?php

//[payment_id] => 29709035	
$paymentId = '29767039';
$accesToken = 'TEST-1288291950076869-090905-6c6673303a9bcbaa11fe516719a56778-640424739';
$url = 'https://api.mercadopago.com/v1/payments/'.$paymentId.'?access_token='.$accesToken;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
curl_setopt($ch, CURLOPT_HEADER, 0);

$output = curl_exec($ch);
if($output === FALSE){
	echo "cURL Error".curl_error($ch);
};
curl_close($ch);
$datos1 = json_decode($output,true);

var_dump($datos1);	

// transaction_amount   status    status_detail   operation_type   description
echo '<br>****************<br>';
echo $datos1['transaction_amount'].'<br>';
echo $datos1['status'].'<br>';
echo $datos1['status_detail'].'<br>';
echo $datos1['operation_type'].'<br>';
echo $datos1['description'].'<br>';
echo $datos1['date_of_expiration'].'<br>';
	
// respuestas  2000 = no se encontro el pago   2006 accestoken no encontrado
	
?>
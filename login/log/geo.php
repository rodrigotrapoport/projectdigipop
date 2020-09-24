<?php
	
// GEO IP //

//Post
// $url = direccion a donde se envia el post
//$post_data = array('query'=>'algo 1', 'method'=>'algo 2', 'ya'=>'algo 3');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://get.geojs.io/v1/ip/geo.json');
curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
curl_setopt($ch, CURLOPT_HEADER, 0);

//POST 
//curl_setopt($ch, CURLOP_POST, 1);
//curl_setopt($ch, CURLOP_POSTFIELDS, $post_data);

// GET Y POST
$output = curl_exec($ch);
if($output === FALSE){
	echo "cURL Error".curl_error($ch);
};
curl_close($ch);
$datos1 = json_decode($output,true);

echo '<br><br>'.$datos1['country_code3'].' pais de origen';

echo '<br>';
//*****************************************
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.mercadopago.com/users/test_user?access_token=TEST-6637108387969496-070722-ddc891b155423013576236a6c82eaa02-583936179');
curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$post_data = array("site_id" => "MLA" );
curl_setopt($ch, CURLOP_POST, 1);
curl_setopt($ch, CURLOP_POSTFIELDS, $post_data);
$output = curl_exec($ch);
if($output === FALSE){
	echo "cURL Error".curl_error($ch);
};
echo json_decode($output);

echo '<br><br>';
//************************************************

$curl = curl_init(); // inicia el sistema q cargara la pagina web
curl_setopt($curl, CURLOPT_URL, 'https://api.mercadopago.com/v1/payment_methods');
curl_exec($curl);


// curl -X POST -H "Content-Type: application/json" "https://api.mercadopago.com/users/test_user?access_token=TEST-6637108387969496-070722-ddc891b155423013576236a6c82eaa02-583936179" -d "{'site_id': 'MLM'}"

// {"id":640372947,"nickname":"TESTMUYDRWYN","password":"qatest128","site_status":"active","email":"test_user_32786551@testuser.com"}

// {"id":640376526,"nickname":"TETE8033723","password":"qatest7889","site_status":"active","email":"test_user_21938399@testuser.com"}

// {"id":640375598,"nickname":"TT237445","password":"qatest4170","site_status":"active","email":"test_user_19190541@testuser.com"}

?>
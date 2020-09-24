<?php
// SDK de Mercado Pago
//require __DIR__ .  '/vendor/autoload.php';
require 'vendor/autoload.php';

// TEST-6637108387969496-070722-ddc891b155423013576236a6c82eaa02-583936179 acces token prueba Lidia

// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-1288291950076869-090905-6c6673303a9bcbaa11fe516719a56778-640424739');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

$preference->back_urls = array(  
    "success" => "http://187.246.116.22/ventas/success.php",
    "failure" => "http://187.246.116.22/ventas/failure.php?error=failure",
    "pending" => "http://187.246.116.22/ventas/pending.php?error=pending"
);
$preference->auto_return = "approved";

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75.56;
$preference->items = array($item);
$preference->save();

//  CLIENTE ARG
// {"id":640372947,"nickname":"TESTMUYDRWYN","password":"qatest128","site_status":"active","email":"test_user_32786551@testuser.com"}


//  VENDEDOR ARG
// {"id":640376526,"nickname":"TETE8033723","password":"qatest7889","site_status":"active","email":"test_user_21938399@testuser.com"}

// ARG
// {"id":640375598,"nickname":"TT237445","password":"qatest4170","site_status":"active","email":"test_user_19190541@testuser.com"}

//*******************************************

// mx VENDEDOR
// {"id":640424739,"nickname":"TESTBWPMV3UI","password":"qatest288","site_status":"active","email":"test_user_52387931@testuser.com"}

// TEST-599ebd88-91c9-4304-b81a-bd27b59d0b77  // produccion cliente de prueba
// TEST-1288291950076869-090905-6c6673303a9bcbaa11fe516719a56778-640424739 // acces token prueba


// mx COMPRADOR
// {"id":640422959,"nickname":"TETE731252","password":"qatest8647","site_status":"active","email":"test_user_33697987@testuser.com"}
?>
	

<!doctype html>
<html lang="es">
	

<head>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <script src="bspop/bs4.pop.js"></script>
    
	<meta charset="utf-8">
	
	<meta http-equiv="Cache-Control" content="no-cache"/>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>digipop.pagos</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script> <!---- iconos fa-code -->
	
	<link href="css/style.php" rel="stylesheet">
	
	<link rel="stylesheet" href="bspop/bs4.pop.css">
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
</head>

<body>

<!---------------------------------->

<form action="pagos.php" method="POST">
  <script
   src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js"
   data-preference-id="<?php echo $preference->id; ?>">
  </script>
</form>

<!--------------------------------->

</body>
</html>
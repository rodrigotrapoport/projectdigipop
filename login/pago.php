<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digipop Tech</title>
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
	    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous">
    </script>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
	    crossorigin="anonymous">
	</script>
	
<?php

//***************************************
//// DETECTAR PAIS DE ORIGEN ///
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://get.geojs.io/v1/ip/geo.json');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$output = curl_exec($ch);
	curl_close($ch);
    $datos1 = json_decode($output,true);
    $pais = $datos1['country_code3'];	
	if($pais == 'MEX'){
		$currency = 'MXN';
	} elseif ($pais == 'ARG'){
		$currency = 'AR';
	} else {
		$currency = 'USD';
	};
?>
	
	<script
    src="https://www.paypal.com/sdk/js?client-id=ATwVXaggQaUJq_cQdeH-H5AJjMRnbmSgnRD09TF51_A9tXuqkh4bv7qRxUr6jLxMMtxaa2r2SpLvGnjH&currency=<?php echo $currency; ?>">
</script>
    <link rel="stylesheet" href="css/estilosiniciar.css">
    
    <style>
	    
		.fondo {
		  background-image: linear-gradient(#D8D8DF, #EFEFF0);
		  background-repeat: no-repeat; 
		  background-size: cover;     
		  height: 100%;  
		}
		
		img {
	        width: 250px;
	        -webkit-filter: drop-shadow(5px 5px 10px #666666);
	        filter: drop-shadow(5px 5px 5px #666666);
	    }
	    footer {
		  position: absolute;
		  bottom: 0;
		  width: 100%;
		}
		.sinFondo {
			background-color:rgba(0,0,0,0);
			
	    }  
    </style>
    
</head>
<body class="fondo">
	

<?php
require('log/log.php');
error_reporting(0);
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

/// CONEXION DB ///
$dbc = mysqli_connect(DBHOST,DBUSER,DBPW);
if (!$dbc) {
    exit();
}

$dbs = mysqli_select_db($dbc, DBNAME);
if (!$dbs) {
    exit();
}
	
// SDK de Mercado Pago
require '../mercadoP/vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-1288291950076869-090905-6c6673303a9bcbaa11fe516719a56778-640424739');


//  CLIENTE ARG
// {"id":640372947,"nickname":"TESTMUYDRWYN","password":"qatest128","site_status":"active","email":"test_user_32786551@testuser.com"}
//  VENDEDOR ARG
// {"id":640376526,"nickname":"TETE8033723","password":"qatest7889","site_status":"active","email":"test_user_21938399@testuser.com"}
// ARG
// {"id":640375598,"nickname":"TT237445","password":"qatest4170","site_status":"active","email":"test_user_19190541@testuser.com"}
//*******************************************
// mx VENDEDOR
// {"id":640424739,"nickname":"TESTBWPMV3UI","password":"qatest288","site_status":"active","email":"test_user_52387931@testuser.com"}

// TEST-599ebd88-91c9-4304-b81a-bd27b59d0b77  // llave publica cliente de prueba
// TEST-1288291950076869-090905-6c6673303a9bcbaa11fe516719a56778-640424739 // acces token prueba
//************
// mx COMPRADOR
// {"id":640422959,"nickname":"TETE731252","password":"qatest8647","site_status":"active","email":"test_user_33697987@testuser.com"}
	

if( isset($_GET['pago']) AND isset($_GET['sec']) ){
	
	$referenciaPago = my_simple_crypt( $_GET['pago'], 'd', $claveEncriptacion, $secret );
	$referenciaHash = $_GET['sec'] ;

	$hash = hash('ripemd256', $referenciaPago.$pais );
	if( $hash == $referenciaHash ){
		// conexion aprobada
		//echo 'estas en '.$pais.' + '.$referenciaPago.'<br>';
		$refAES = my_simple_crypt( $referenciaPago, 'e', $claveEncriptacion, $secret );// encripta
		
		$values = "SELECT  costo, costoLocal, producto FROM inscripcion WHERE codigoPago='$referenciaPago' AND estatus IS NULL LIMIT 1"; 
	    $result = $dbc->query($values);	
	    $filas  = mysqli_num_rows($result);	
        if($filas == 0){ 
	        $notificacion = '<p><h1 class="display-4 text-center text-primary text-success">ESTAMOS PROCESANDO EL PAGO EN ESTOS MOMENTOS</h1></p>';  
	    } else {
		    $notificacion = '';
		};
	        
	    // consulta datos del pago
	    while($row = $result -> fetch_assoc()){
		    $costo      = $row['costo'];
		    $costoLocal = $row['costoLocal'];
		    $producto   = $row['producto'];
		};
        
        if($pais == 'MEX'){
	        $costoReal = $costoLocal;
	        $moneda = 'MXN';
	        $monedaMP = 'MXN';
	        $iva = 1.16;
	        $mensajeAES = number_format(($costoReal*$iva),0,'.','').'&'.$moneda.'&'.$referenciaPago; // monto y referecia en la DB
	        $mensajeAES = my_simple_crypt( $mensajeAES, 'e', $claveEncriptacion, $secret );// encripta
        } elseif ($pais == 'ARG'){
	        $costoReal = $costoLocal;
	        $moneda = '$AR';
	        $monedaMP = 'ARS';
	        $iva = 1;
	        $mensajeAES = number_format(($costoReal*$iva),0,'.','').'&'.$moneda.'&'.$referenciaPago; // monto y referecia en la DB
	        $mensajeAES = my_simple_crypt( $mensajeAES, 'e', $claveEncriptacion, $secret );// encripta
        } else {
	        $costoReal = $costo;
	        $moneda = 'MXN';
	        $monedaMP = 'MXN';
	        $iva = 1;
	        $mensajeAES = number_format(($costoReal*$iva),0,'.','').'&'.$moneda.'&'.$referenciaPago; // monto y referecia en la DB
	        $mensajeAES = my_simple_crypt( $mensajeAES, 'e', $claveEncriptacion, $secret );// encripta
	    };
		
		/////// MERCADO PAGO //////
		
		$aprobado  = hash('ripemd256', $referenciaPago.'aprobado' );
		$pendiente = hash('ripemd256', $referenciaPago.'pendiente');
		$rechazado = hash('ripemd256', $referenciaPago.'rechazado');
		// Crea un objeto de preferencia
		$preference = new MercadoPago\Preference();
		
		$preference->back_urls = array(  
		    //"success" => "http://localhost/login/success.php?pago=aplicado&producto=".$producto."&ref=".$referenciaPago,
		    //"failure" => "http://localhost/login/failure.php?error=failure&ref=".$referenciaPago,
		    //"pending" => "http://localhost/login/pending.php?error=pending&ref=".$referenciaPago
		    "success" => 'pago='.$referenciaPago, 
		    "failure" => 'pago='.$referenciaPago,
		    "pending" => 'pago='.$referenciaPago
		);
		$preference->auto_return = "approved";
		
		// Crea un ítem en la preferencia
		$item = new MercadoPago\Item();
		$item->title = 'INSCRIPCION SERVICIOS';
		$item->quantity = 1;
		$item->unit_price = number_format(($costoLocal * $iva),0,'.',''); // precio de mexico
		$item->currency_id = $monedaMP;
		$preference->items = array($item);
		$preference->save();

		
	}; 
		
};	
	
	
	
?>
<br>	
<div class="container">	
	<div class="row justify-content-md-center">
        <img src="digiPop.svg" height="70px"  class="col-md-3 col8"><br>
    </div>
    <br>
    <p class="h3 text-dark text-center">PAGO DE INSCRIPCION DEL SERVICIO</p>
    <hr>
   
    <div class="jumbotron jumbotron sinFondo " id="jumbo" >
	    <div class="col justify-content-md-center">
		    <div class="row justify-content-center">
	            <p><h1 class="display-4 text-center col-md-8 text-uppercase">EL PRODUCTO QUE HAS SELECCIONADO ES <strong><?php echo $producto;?></strong></h1></p>
		    </div>
	        <p><h1 class="display-4 text-center text-primary">PRECIO <?php echo number_format(($costoReal*$iva),0,'.','') .' '.$moneda;?></h1></p>
	        <!--
	        <div class="row justify-content-center">    
	            <button type="button" class="btn btn-primary col-md-8">PAGAR</button>
	        </div>
	        -->
	        <?php echo $notificacion; ?>
	        
	        <div class="row justify-content-center">
		        <div class="col-md-2">
		        <!---------------------------------->
					<form action="thankyou.php" method="post">
					    <script
					        src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js"
					        data-preference-id="<?php echo $preference->id;?>">
					    </script>
					</form>
		        </div>
		        <div class="col-md-2">
			        <div id="paypal-button-container"></div>    
		        </div>  
		        <!---------------------------------> 
	        </div>    
	        <hr>
	        <br>
	        <p class="lead text-center">Para mas información o consultas envianos un correo a hola@digipop.tech .</p>
	    </div>
	</div>
	
</div>
	
<div>
	<nav class="navbar navbar-light bg-dark text-white">
	  <a class="navbar-brand text-white" href="www.digipop.tech">
	    <img src="digiPop.svg"  height="40" class="d-inline-block align-top" alt="">www.digipop.tech
	  </a>
	  <a class="text-center btn btn-link text-white">hola@digipop.tech</a>
	</nav> 
</div>  

<script>
paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{ amount: { value: '<?php echo number_format(($costoReal*$iva),0,'.','');?>' } }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            alert('Transaction completed by ' + details.payer.name.given_name);
            if ( details.status == 'COMPLETED' ){
	            $(document).ready(function(){  
				    $.ajax({  
				        url:"paypalConfirm.php",   
				        method:"POST", 
				        dataType: 'json', 
					    data:{input : <?php echo "'".$mensajeAES."'"; ?>   
					         },  
					         success:function(resp){
						        var datos = resp.res;
						        console.log(datos);
						        if(datos == 'ok'){
						            window.location.href = 'thankyou.php?data=<?php echo $refAES; ?>';
						        };
						    }, 
						    error:function(res){
							    alert('Error');
							}
				    });
				});
			};	
        });
    }
}).render('#paypal-button-container');
</script>

<?php 
	gc_collect_cycles();
?>
 
</body>
</html>	
	

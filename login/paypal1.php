<?php
	
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

$detalle = 'aqui va la referencia del pago';	
$monto   = '1000.00';
$montoAES =  my_simple_crypt( $monto, 'e', $claveEncriptacion, $secret );// encripta
$sandbox = 'sb-uagr52591075@business.example.com';

// cuenta de paypal prueba comprador
// correo test sb-uagr52591075@business.example.com  12345678!  ESTA SI FUNCIONA   9qI(GV){
	
//  digipop vendedor modo sandBox
//  sb-r5ugt2591350@personal.example.com  J*Haj69: 12345678! clave

//  sandbox digipop vendedor  sb-r5ugt2591350@personal.example.com  usuario

//  client ID  ATwVXaggQaUJq_cQdeH-H5AJjMRnbmSgnRD09TF51_A9tXuqkh4bv7qRxUr6jLxMMtxaa2r2SpLvGnjH

//  secret    EJhqPYwND-pJUicXHxA8j1Sh6RMhTu0-U2RZ1hGm9VcyPrSZL4_eF2dpMCFNKB-NBSe9RdJJWTBcrDGe

//  test  Card Type: Visa  Card Number: 4032034134227787  Expiration Date: 02/2024  CVV: 723
	
	
?>

<!DOCTYPE html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
</head>

<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous">
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
    crossorigin="anonymous">
</script>
	
	
<script
    src="https://www.paypal.com/sdk/js?client-id=ATwVXaggQaUJq_cQdeH-H5AJjMRnbmSgnRD09TF51_A9tXuqkh4bv7qRxUr6jLxMMtxaa2r2SpLvGnjH&currency=MXN">
</script>
  
<div id="paypal-button-container"></div>

<script>
    //paypal.Buttons().render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.
</script>
  
<script>
paypal.Buttons({
    createOrder: function(data, actions) {
        // This function sets up the details of the transaction, including the amount and line item details.
        return actions.order.create({
            purchase_units: [{ amount: { value: '<?php echo $monto ?>' } }]
        });
    },
    onApprove: function(data, actions) {
        // This function captures the funds from the transaction.
        return actions.order.capture().then(function(details) {
            // This function shows a transaction success message to your buyer.
            alert('Transaction completed by ' + details.payer.name.given_name);
            
            //*******************************
            $(document).ready(function(){  
			    //$('#enviarPin').click(function(){ 
				    
				    // ENVIA LOS DATOS PERSONALES 
				    $.ajax({  
				        url:"paypalConfirm.php",   // envia a la url DE DATOS PERSONALES
				        method:"POST", 
				        dataType: 'json', 
					    data:{input : <?php echo "'".$montoAES."'"; ?> // texto agregado    
					         },  
					         success:function(resp){
						        var datos = resp.res;
						        alert('Venta exitosa!!!');
						        			        						                     
						    }, 
						    error:function(res){
							    alert('error');
							}
				    });
				          
			    //});
			});
		                
        //*******************************
        });
    }
}).render('#paypal-button-container');
  //This function displays Smart Payment Buttons on your web page.
</script>

  
</body>
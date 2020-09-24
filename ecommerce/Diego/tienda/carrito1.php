<?php
	
$resultado = array("res" => 'nada');
//echo json_encode($resultado);


function my_simple_crypt( $string, $action = 'e' ) {
    // you may change these values to your own
    $secret_key = 'mi clave';
    $secret_iv = 'my_simple_secret_iv';
 
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
 
//echo $key.'<br>';
//echo $encrypt_method.'<br>';
//echo $iv.'<br><br>';

    return $output;
}


$encrypted = my_simple_crypt( 'cemento blanco*$250*Disponible en Bolsa*10kgr***cantidad 1*https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fs3.amazonaws.com%2Fdigitaltrends-uploads-prod%2F2013%2F09%2FiPhone-5S-hands-on-home-angle.jpg*27-6-2020 1:10', 'e' );
echo($encrypted);

echo '<br><br>';

$decrypted = my_simple_crypt( $encrypted, 'd' );
echo $decrypted;

echo '<br><br>';

?>
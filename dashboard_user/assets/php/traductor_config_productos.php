<?php	
//require ("config_products.php");
//require ("jsonProductos.php");

error_reporting(0);  	

session_start();
$hoyB = date('Y-m-d G:i'); // YYYY-MM-DD 24:00
////// REGISTRAR NUEVO CLIENTE //////
require('../../../login/log/log.php');

/// CONEXION DB ///
$dbc = mysqli_connect(DBHOST,DBUSER,DBPW);
if (!$dbc) {
    exit();
}

$dbs = mysqli_select_db($dbc, DBNAME);
if (!$dbs) {
    exit();
}

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
//*****************************************
    
    
    // decodifica y busca la cookie en la DB
    $cookie = $cookieAESdes = my_simple_crypt( $_SESSION["setCookie"], 'd', $claveEncriptacion, $secret );
    //echo '<br>'.$cookie.'<br>';
    $values = "SELECT fecha, idUsuario FROM actividad WHERE cookie='$cookie'"; 
    $result = $dbc->query($values);
    $filas  = mysqli_num_rows($result);
    if($filas == 1){
	    while($row = $result -> fetch_assoc()){   
		    $fechaA    = $row['fecha'];
		    $idUsuario = $row['idUsuario'];    
	    };
	    
	    //echo '<br>'.$idUsuario.' '.$fechaA.'<br>';
	    
		$origin = new DateTime($fechaA);     // fecha inicial
		$target = new DateTime($hoyB);       // fecha final
		$interval = $origin->diff($target);  // calcula la diferencia
		$minutosDiferencia = $interval->format('%i');
	    $horasDiferencia   = $interval->format('%h');
	    $diasDiferencia    = $interval->format('%a');
	    $minTotal = ($diasDiferencia * 1440) + ($horasDiferencia * 60) + $minutosDiferencia;
	    //echo ' '.$minTotal.'<br>';
	    
	    if($minTotal > 300){
		    //header('Location:login.html');
		    echo '';
	    } else {
		    $values = "SELECT usuario FROM usuarios WHERE idUsuario='$idUsuario'"; 
		    $result = $dbc->query($values);
		    $filas  = mysqli_num_rows($result);
		    if($filas == 1){
			    while($row = $result -> fetch_assoc()){   
				    $usuario = $row['usuario'];    
			    };
			    //echo $usuario.'<br>';
			};
	    };
    };

//******************************************    
    //$tienda = 'Rodrigo'; // direcciona a la carpeta de la tienda
    $tienda = $usuario;
    
    require ("../../../ecommerce/".$tienda."/config/assets/php/jsonProductos.php");
    require ("../../../ecommerce/".$tienda."/config/assets/php/config_products.php");
     
    $jsonProduct = json_decode($jsonProductos,true);
    
    $jsonConf    = json_decode($jsonConfigProductos,true); 
    /* $jS = json_encode ($jsonS); */

    $resultado_cadena = array("config" => $jsonConf['config'], "productos" => $jsonProduct['productos']);   

    $enviar_json = json_encode($resultado_cadena);
   
    echo  $enviar_json;
    
    gc_collect_cycles();
   
?>
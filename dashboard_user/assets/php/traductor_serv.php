<?php
    // Este parte del traductor sirve para ciertos Scripts JS que estan relacionados con la configuración FrontEnd
    //require ("jsonServicios.php");
       
    $tienda = 'Rodrigo'; // direcciona a la carpeta de la tienda 
    require ("../../../ecommerce/".$tienda."/config/assets/php/jsonServicios.php");
    require ("../../../ecommerce/".$tienda."/config/assets/php/config_serv.php");
    
     
    $jsonS = json_decode($jsonServicios,true); 
    $jsonC = json_decode($jsonConfigServicios,true); 
    
    /* $jS = json_encode ($jsonS); */

    $resultado_cadena = array("servicios" => $jsonS['servicios'], "catslides" => $jsonC['config']['catSlide']);
    

    $enviar_json = json_encode($resultado_cadena);
   
    echo  $enviar_json;
   
?>
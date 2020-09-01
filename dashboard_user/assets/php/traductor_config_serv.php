<?php
    
    //require ("config_serv.php");
    //require ("jsonServicios.php");
    
    $tienda = 'Rodrigo'; // direcciona a la carpeta de la tienda
    
    require ("../../../ecommerce/".$tienda."/config/assets/php/jsonServicios.php");
    require ("../../../ecommerce/".$tienda."/config/assets/php/config_serv.php");
    
    $jsonServ = json_decode($jsonServicios, true);
    $jsonConf = json_decode($jsonConfigServicios,true); 
    
     
    /* $jS = json_encode ($jsonS); */

    $resultado_cadena = array("config" => $jsonConf['config'], "servicios" => $jsonServ['servicios']);
    // ;
    

    $enviar_json = json_encode($resultado_cadena);
   
    echo  $enviar_json;
   
?>
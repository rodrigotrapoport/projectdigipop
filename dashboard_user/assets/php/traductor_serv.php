<?php
    
    //require ("jsonServicios.php");
       
    $tienda = 'Rodrigo'; // direcciona a la carpeta de la tienda
    
    require ("../../../ecommerce/".$tienda."/config/assets/php/jsonServicios.php");
    
    
     
    $jsonS = json_decode($jsonServicios,true); 
    /* $jS = json_encode ($jsonS); */

    $resultado_cadena = array("servicios" => $jsonS['servicios']);
    

    $enviar_json = json_encode($resultado_cadena);
   
    echo  $enviar_json;
   
?>
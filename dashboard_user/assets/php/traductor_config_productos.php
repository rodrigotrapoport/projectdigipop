<?php
    
    //require ("config_products.php");
    //require ("jsonProductos.php");
    
    $tienda = 'Rodrigo'; // direcciona a la carpeta de la tienda
    
    require ("../../../ecommerce/".$tienda."/config/assets/php/jsonServicios.php");
    require ("../../../ecommerce/".$tienda."/config/assets/php/config_serv.php");

     
    $jsonProduct = json_decode($jsonProductos,true);
    $jsonConf = json_decode($jsonConfig,true); 
    /* $jS = json_encode ($jsonS); */


    $resultado_cadena = array("config" => $jsonConf['config'], "productos" => $jsonProduct['productos']);
    // ;
    

    $enviar_json = json_encode($resultado_cadena);
   
    echo  $enviar_json;
   
?>
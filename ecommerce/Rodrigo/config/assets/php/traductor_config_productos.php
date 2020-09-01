<?php
    
    require ("config_products.php");
    require ("jsonProductos.php");

     
    $jsonProduct = json_decode($jsonProductos,true);
    $jsonConf = json_decode($jsonConfig,true); 
    /* $jS = json_encode ($jsonS); */


    $resultado_cadena = array("config" => $jsonConf['config'], "productos" => $jsonProduct['productos']);
    // ;
    

    $enviar_json = json_encode($resultado_cadena);
   
    echo  $enviar_json;
   
?>
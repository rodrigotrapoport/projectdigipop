<?php
    
    require ("config_serv.php");
    require ("jsonServicios.php");
     
    $jsonServ = json_decode($jsonServicios, true);
    $jsonConf = json_decode($jsonConfig,true); 
    /* $jS = json_encode ($jsonS); */

    $resultado_cadena = array("config" => $jsonConf['config'], "servicios" => $jsonServ['servicios']);
    // ;
    

    $enviar_json = json_encode($resultado_cadena);
   
    echo  $enviar_json;
   
?>
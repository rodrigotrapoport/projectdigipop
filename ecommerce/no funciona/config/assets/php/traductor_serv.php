<?php
    
    require ("jsonServicios.php");
     
    $jsonS = json_decode($jsonServicios,true); 
    /* $jS = json_encode ($jsonS); */

    $resultado_cadena = array("servicios" => $jsonS['servicios']);
    

    $enviar_json = json_encode($resultado_cadena);
   
    echo  $enviar_json;
   
?>
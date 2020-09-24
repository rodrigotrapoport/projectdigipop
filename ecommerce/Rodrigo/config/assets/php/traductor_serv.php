<?php
    require ("config_serv.php");
    require ("jsonServicios.php");
     
    $jsonS = json_decode($jsonServicios,true); 
    $jsonC = json_decode($jsonConfigServicios,true);
    
    $resultado_cadena = array("servicios" => $jsonS['servicios'],"catslides"=>$jsonC["config"]["catSlide"]);
    

    $enviar_json = json_encode($resultado_cadena);
   
    echo  $enviar_json;
   
    //var_dump($enviar_json);
   
?>
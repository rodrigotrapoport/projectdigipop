<?php
    // Este parte del traductor de Ecommerce sirve para ciertos Scripts JS que estan relacionados con la configuración FrontEnd
    require ("jsonProductos.php");
    require ("config_products.php");
    $jsonY = json_decode($tituloGalerias, true);        // true regresa un array
    $jsonP = json_decode($jsonProductos,true);
    $jsonC = json_decode($jsonConfigProductos,true);

    $resultado_cadena = array("galeria" =>$jsonY["galerias"], "foto"=>$jsonY["fotos"],"botones"=>$jsonY["botones"],"link"=>$jsonY["link"],"prioridades"=>$jsonY["prioridades"], "visibilidades"=>$jsonY["visibilidades"],"productos"=>$jsonP["productos"], "catslides"=>$jsonC["config"]["catSlide"]);

    $enviar_json = json_encode($resultado_cadena);
    echo  $enviar_json;
   /*  echo "<br>";
    var_dump($resultado_cadena); */
?>
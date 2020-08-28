<?php
    require ("jsonProductos.php");
    $jsonY = json_decode($tituloGalerias, true);        // true regresa un array
    $jsonP = json_decode($jsonProductos,true);

    $resultado_cadena = array("galeria" =>$jsonY["galerias"], "foto"=>$jsonY["fotos"],"botones"=>$jsonY["botones"],"link"=>$jsonY["link"],"prioridades"=>$jsonY["prioridades"],"productos"=>$jsonP["productos"]);

    $enviar_json = json_encode($resultado_cadena);
    echo  $enviar_json;
   /*  echo "<br>";
    var_dump($resultado_cadena); */
?>
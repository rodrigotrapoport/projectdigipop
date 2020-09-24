<?php
    require "jsonProductos1.php";
   /*  error_reporting(0); */
    
    $jsonGalerias  = json_decode( $tituloGalerias, true );
    /* print_r($jsonGalerias); */
    
    
    $_GET['instruccion_cat'] = 'test';
    $_GET['id_nueva_cat']    = '3';
    $_GET['slide']           = 'Papas Fritas';
    $_GET['prioridad']       = 'Alta';

    
    if( isset($_GET['id_nueva_cat']) AND isset($_GET['slide']) AND isset($_GET['prioridad']) ){
	    $instruccion = $_GET['instruccion_cat'];
        $id_nueva  =   $_GET['id_nueva_cat'];
        $slide     =   $_GET['slide'];
        $prioridad =   $_GET['prioridad'];
        
        // SI LA CLAVE EXISTE ACTUALIZA LOS VALORES
        if ( array_key_exists( 'galeria'.$id_nueva, $jsonGalerias['galerias'] ) ) {
	        //OPCION EDITAR
            if($instruccion == "editar"){
                $jsonGalerias['galerias']['galeria'.$id_nueva]      = $slide;
                $jsonGalerias['prioridades']['prioridad'.$id_nueva] = $prioridad;
            //OPCION CREAR
            } else {
                $jsonGalerias['visibilidades']['galeria'.$id_nueva] = "no";
            };
    	} else {
            //$id_nueva = "No llego nada!!!";
            $jsonGalerias['galerias']['galeria'.$id_nueva]       = $slide;
            $jsonGalerias['fotos']['foto'.$id_nueva]             = '' ;
            $jsonGalerias['botones']['boton'.$id_nueva]          = "" ;
            $jsonGalerias['links']['link'.$id_nueva]             = "#";
            $jsonGalerias['prioridades']['prioridad'.$id_nueva]  = $prioridad;
            $jsonGalerias['visibilidades']['galeria'.$id_nueva]  = "si";
        };
    };
    echo json_encode($jsonGalerias);  
    
    //// COPIA DE SEGURIDAD /////
    $date = date('d_m_y_G_i');
    $ficheroOriginal = 'jsonProductos1.php';
    $ficheroCopia = 'jsonProductos1_'.$date.'.php';
    copy($ficheroOriginal, $ficheroCopia);
    /////////////////////
    ///// GUARDAR ///////
    
    $codigoPHP = "<?php "."$"."tituloGalerias = '".json_encode($jsonGalerias)." ' ;".
                 "$"."jsonProductos = ' ".$jsonProductos." ' ; ?>";
      
    $texto = json_encode($jsonGalerias);
    $archivo = fopen("testFinal.php", "w");
    //fwrite($archivo, $texto);
    fwrite($archivo, $codigoPHP);
    fclose($archivo);
?>
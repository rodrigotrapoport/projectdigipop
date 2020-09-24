<?php
	//error_reporting(0);
    require "jsonProductos.php"   ;
    require "config_products.php";
    require "config_serv.php"     ;
    
    $jsonGalerias  = json_decode ($tituloGalerias, true);  /// PRODUCTOS
    $productos     = json_decode ($jsonProductos , true);  /// PRODUCTOS
    
    $setupProductos = json_decode($jsonConfigProductos,true); /// CONFIG_PRODUCTOS
    
    $setupServicios = json_decode($jsonConfigServicios,true); /// CONFIG_SERV
    
    
//*************** FUNCIONES CONFIG PRODUCTO *********

function gConfigSevicio( $arrConfProd){
	//echo json_encode($arrConfProd); // imprime el arry modificado
	//Crear copia de seguridad de datos anteriores
    $date = date('ymdGi');
    $ficheroOriginal = 'config_serv.php';
    $ficheroCopia = 'backups/config_serv_'.$date.'.php';
    copy($ficheroOriginal, $ficheroCopia);
    // Generar el guardado del nuevo JSON
    $codigoPHP = "<?php "."$"."jsonConfigServicios = '".json_encode($arrConfProd)."  '; ?>";
    $archivo = fopen("config_serv.php", "w");
    fwrite($archivo, $codigoPHP);
    fclose($archivo);
}

//*************************************************    
   

////////  PODUCTOS / MODIFICA LAS GALERIAS
    
if( isset($_GET['id_nueva_cat']) AND isset($_GET['slide']) AND isset($_GET['prioridad']) ){
    $instruccion = $_GET['instruccion_cat'];
    $id_temp     = $_GET['id_nueva_cat'];
    $id_nueva    = str_replace( "galeria", "", $id_temp);   
    $slide       =   $_GET['slide'];
    $prioridad   =   $_GET['prioridad'];
    // SI LA CLAVE EXISTE ACTUALIZA LOS VALORES O LOS BORRA
    if ( array_key_exists( 'galeria'.$id_nueva, $jsonGalerias['galerias'] ) ) {
        //OPCION EDITAR
        if($instruccion == "editar"){
            $jsonGalerias['galerias']['galeria'.$id_nueva]      = $slide;
            $jsonGalerias['prioridades']['prioridad'.$id_nueva] = $prioridad;    
        //OPCION Borrar
        } else {
            $jsonGalerias['visibilidades']['galeria'.$id_nueva] = "no";
        }; 
    // SI LA CLAVE NO EXISTE CREA UNA NUEVA    
	} else {
        $jsonGalerias['galerias']['galeria'.$id_nueva]       = $slide;
        $jsonGalerias['fotos']['foto'.$id_nueva]             = [];
        $jsonGalerias['botones']['boton'.$id_nueva]          = "";
        $jsonGalerias['links']['link'.$id_nueva]             = "#";
        $jsonGalerias['prioridades']['prioridad'.$id_nueva]  = $prioridad;
        $jsonGalerias['visibilidades']['galeria'.$id_nueva]  = "si";
    };
};
    
///// PRODUCTOS  /EDITA/CREA/BORRA
    
if(     isset($_GET['id_producto']) 
    AND isset($_GET['nombre_producto']) 
    AND isset($_GET['unidad_producto'])  
    AND isset($_GET['precioA'])
    AND isset($_GET['precioB']) 
    AND isset($_GET['producto_categoria'])  
    AND isset($_GET['oferta'])
    AND isset($_GET['moneda'])
    AND isset($_GET['producto_prioridad']) 
    AND isset($_GET['codigo'])  
    AND isset($_GET['calif'])
    AND isset($_GET['colores'])  
    AND isset($_GET['tamanos'])
    AND isset($_GET['descrip'])
    AND isset($_GET['condi']) 
    AND isset($_GET['foto1'])  
    AND isset($_GET['foto2'])
    AND isset($_GET['foto3'])
    AND isset($_GET['instruccion'])){
        $id_producto        = $_GET['id_producto']; //Llega el productox
        $nombre_producto    = $_GET['nombre_producto'];
        $unidad_producto    = $_GET['unidad_producto'];
        $precioA            = $_GET['precioA'];
        $precioB            = $_GET['precioB'];
        $id_nueva_cat       = $_GET['producto_categoria']; // llega la galeria
        $oferta             = $_GET['oferta'];
        $moneda             = $_GET['moneda'];
        $producto_prioridad = $_GET['producto_prioridad'];
        $codigo             = $_GET['codigo'];
        $calif              = $_GET['calif'];
        $colores            = $_GET['colores'];
        $tamanos            = $_GET['tamanos'];
        $descrip            = $_GET['descrip'];
        $condi              = $_GET['condi'];
        $foto1              = $_GET['foto1'];
        $foto2              = $_GET['foto2'];
        $foto3              = $_GET['foto3'];
        $instruccion        = $_GET['instruccion'];
        // SI LA CLAVE EXISTE ACTUALIZA LOS VALORES O LOS BORRA
        
        if ( array_key_exists( $id_nueva_cat, $productos['productos'] ) ) {
             echo "Existe la galeria";
                if (array_key_exists($id_producto, $productos['productos'][$id_nueva_cat])){
                    echo "Existe el producto y la galeria";
                    if($instruccion =="editar"){
                        //Existe la galeria y el producto - Estamos editando
                    $productos ['productos'][$id_nueva_cat][$id_producto]['nombre'] = $nombre_producto ;

                    $productos ['productos'][$id_nueva_cat][$id_producto]['unidad'] = $unidad_producto ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['precioA'] = $precioA ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['precioB'] = $precioB ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['oferta'] = $oferta ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['moneda'] = $moneda ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['prioridad'] = $producto_prioridad ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['codigo'] = $codigo ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['calif'] = $calif ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['colores'] = $colores ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['tamanos'] = $tamanos ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['descrip'] = $descrip ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['condi'] = $condi ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['foto1'] = $foto1 ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['foto2'] = $foto2 ;
                    $productos ['productos'][$id_nueva_cat][$id_producto]['foto3'] = $foto3 ;
                    //var_dump($productos);
                    } else{
                        // estamos BORRANDO PRODUCTO
                        $productos ['productos'][$id_nueva_cat][$id_producto]['visibilidades'] = "no" ;
                        var_dump($productos);
                    };
                
                }
                //No existe el producto pero si la galeria - Por ende estas creando una nueva galeria y producto
                else{
                    if($instruccion =="crear"){
                        
                        // $conteo_reves_array = krsort($productos['productos'][$id_nueva_cat]);
                        foreach ($productos['productos'][$id_nueva_cat] as $key => $val) {
                            // echo "$key = $val\n";
                            $ultimo_pro = $key;
                        };
                        
                        
                        $id_new_pro_str = str_replace( "producto", "", $ultimo_pro) +1; 
                        $new_product = 'producto'.$id_new_pro_str;
                        $productos ['productos'][$id_nueva_cat][$new_product]['galeria'] = $id_nueva_cat ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['nombre'] = $nombre_producto ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['unidad'] = $unidad_producto ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['precioA'] = $precioA ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['precioB'] = $precioB ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['oferta'] = $oferta ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['moneda'] = $moneda ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['prioridad'] = $producto_prioridad ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['codigo'] = $codigo ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['calif'] = $calif ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['colores'] = $colores ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['tamanos'] = $tamanos ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['descrip'] = $descrip ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['condi'] = $condi ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['foto1'] = $foto1 ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['foto2'] = $foto2 ;
                        $productos ['productos'][$id_nueva_cat][$new_product]['foto3'] = $foto3 ;
                        var_dump($productos);
                    };
                };
        
        // No existe la galeria ni el producto
        } else{
            echo "no existe nada";
        };
        
        ////////// GUARDAR jsonProductos.php ////////
        //No TOCAR!!!!! Guardado de archivo!!!!
	    $serv_res = "OK";
	    $resultado = array("res" => $serv_res);
	    echo json_encode($serv_res);
	    //Crear copia de seguridad de datos anteriores
	    $date = date('ymdGi');
	    $ficheroOriginal = 'jsonProductos.php';
	    $ficheroCopia = 'backups/'.$date.'.php';
	    copy($ficheroOriginal, $ficheroCopia);
	    // Generar el guardado del nuevo JSON
	    $codigoPHP = "<?php "."$"."tituloGalerias = '".json_encode($jsonGalerias)." ';".
	             "$"."jsonProductos = ' ".json_encode($productos)." '; ?>"; 
	    //$texto = json_encode($jsonGalerias);
	    $archivo = fopen("jsonProductos.php", "w");
	    fwrite($archivo, $codigoPHP);
	    fclose($archivo);
        /////////////////////////////////////////////   
}else{
        echo "esta faltando un dato";
}; ///// CIERRE DEL IF DE PRODUCTOS //////
*/

    /*
    //No TOCAR!!!!! Guardado de archivo!!!!
    $serv_res = "OK";
    $resultado = array("res" => $serv_res);
    echo json_encode($serv_res);
    //Crear copia de seguridad de datos anteriores
    $date = date('ymdGi');
    $ficheroOriginal = 'jsonProductos.php';
    $ficheroCopia = 'backups/'.$date.'.php';
    copy($ficheroOriginal, $ficheroCopia);
    // Generar el guardado del nuevo JSON
    $codigoPHP = "<?php "."$"."tituloGalerias = '".json_encode($jsonGalerias)." ';".
             "$"."jsonProductos = ' ".json_encode($productos)." '; ?>";
    
    $texto = json_encode($jsonGalerias);
    $archivo = fopen("jsonProductos.php", "w");
    fwrite($archivo, $codigoPHP);
    fclose($archivo);
    */

/////////// CONFIG PRODUCTOS ///////////

    // CALENDARIO //

	
	//$_POST['calendario_titulo']     = '1';
	//$_POST['calendarioExplicacion'] = '2';
	//$_POST['calendarioScript']      = '3';
	
	if( isset($_POST['calendarioTitulo']) AND isset($_POST['calendarioExplicacion']) AND isset($_POST['calendarioScript']) ){
		
		$calendarioTitulo      = $_POST['calendario_titulo'];
		$calendarioExplicacion = $_POST['calendarioExplicacion'];
		$calendarioScript      = $_POST['calendarioScript'];
		
		$setupServicios['config']['calendario']['titulo']      = $calendarioTitulo;
		$setupServicios['config']['calendario']['explicacion'] = $calendarioExplicacion;
		$setupServicios['config']['calendario']['script']      = $calendarioScript;
	
	    gConfigSevicio( $setupServicios );
	};

    // CONTACTOS //
    /*
    $_POST['contactoEmail']      = 'correoTest correo';
   	    $_POST['contactoFormularioNombre']   = 'si';
        //$_POST['contactoFormularioEmail']    = 'si';
        //$_POST['contactoFormularioTelefono'] = 'si';
        //$_POST['contactoFormularioMotivo']   = 'si';
    $_POST['contactoTelefono']   = '12345';
    $_POST['contactoWhatsapp']   = '67890';
    $_POST['contactolinkMessenger'] = 'lmessenger';
    $_POST['contactolinkFacebook']  = 'lfacebook';
    $_POST['contactolinkInstagram'] = 'linstagram';
    $_POST['contactolinkTwitter']   = 'ltwiter';
    $_POST['contactolinkEdin']      = 'llinkedin';
    */
    	
	if( isset($_POST['contactoEmail']) AND 
		//isset($_POST['contactoFormulario'])   AND 
		
		isset($_POST['contactoF1']) AND
		isset($_POST['contactoF2']) AND
		isset($_POST['contactoF3']) AND
		isset($_POST['contactoF4']) AND
		
	    isset($_POST['contactoTelefono']) AND
	    isset($_POST['contactoWhatsapp']) AND
	    isset($_POST['contactolinkMessenger']) AND
	    isset($_POST['contactolinkFacebook'])  AND
	    isset($_POST['contactolinkInstagram']) AND
	    isset($_POST['contactolinkTwitter'])   AND
	    isset($_POST['contactolinkEdin'])
	    ){
		
		$contactoEmail      = $_POST['contactoEmail'];
		//$contactoFormulario = $_POST['contactoFormulario'];
		$contactoF1 = $_POST['contactoF1'];
		$contactoF2 = $_POST['contactoF2'];
		$contactoF3 = $_POST['contactoF3'];
		$contactoF4 = $_POST['contactoF4'];
		
		$contactoTelefono   = $_POST['contactoTelefono']  ;
		$contactoWhatsapp   = $_POST['contactoWhatsapp']  ;
		$contactolinkMessenger = $_POST['contactolinkMessenger'];
		$contactolinkFacebook  = $_POST['contactolinkFacebook'] ;
		$contactolinkInstagram = $_POST['contactolinkInstagram'];
		$contactolinkTwitter   = $_POST['contactolinkTwitter'];
		$contactolinkEdin      = $_POST['contactolinkEdin']   ;
		
		
				
		$setupProductos['config']['contacto']['email']      = $contactoEmail;
		//$setupProductos['config']['contacto']['formulario'] = $contactoFormulario;
		
		$setupServicios['config']['contacto']['formulario']['nombre']  = $contactoF1;
		$setupServicios['config']['contacto']['formulario']['email']   = $contactoF2;
		$setupServicios['config']['contacto']['formulario']['motivo']  = $contactoF3;
		$setupServicios['config']['contacto']['formulario']['telefono']= $contactoF4;
		
		$setupServicios['config']['contacto']['telefono'] = $contactoTelefono;
		$setupServicios['config']['contacto']['whatsapp'] = $contactoWhatsapp;
		$setupServicios['config']['contacto']['linkMessenger'] = $contactolinkMessenger;
		$setupServicios['config']['contacto']['linkFacebook']  = $contactolinkFacebook;
		$setupServicios['config']['contacto']['linkInstagram'] = $contactolinkInstagram;
		$setupServicios['config']['contacto']['linkTwitter']   = $contactolinkTwitter;
		$setupServicios['config']['contacto']['linkEdin']   = $contactolinkEdin; 
	
	    gConfigSevicio( $setupProductos );
	};
	
	// CONTADOR DE EXITO //
	/*
	$_POST['id']     = '3';
	$_POST['texto']  = 'hola mundo';
	$_POST['nombre'] = 'Diego';
	$_POST['visibilidad'] = 'si';
	$_POST['icono'] = 'fab fa-sellsy';
	*/
	
	if( isset($_POST['id']) AND
	    isset($_POST['texto']) AND
	    isset($_POST['nombre']) AND
	    isset($_POST['visibilidad']) AND
	    isset($_POST['icono'])
	){
		$exitoId    = $_POST['id'];
		$exitoTexto  = $_POST['texto'];
		$exitoNombre = $_POST['nombre'];
		$exitoVisibilidad = $_POST['visibilidad'];
		$exitoIcono = $_POST['icono'];
		
		$setupServicios['config']['contadorExito']['exito'.$exitoId]['id']    = $exitoId;
		$setupServicios['config']['contadorExito']['exito'.$exitoId]['texto'] = $exitoTexto;
		$setupServicios['config']['contadorExito']['exito'.$exitoId]['nombre']= $exitoVisibilidad;
		$setupServicios['config']['contadorExito']['exito'.$exitoId]['icono'] = $exitoIcono;
		
		gConfigSevicio( $setupServicios );
	}

    // TIPOGRAFIA   1 de 42 posibles //
    /*
    $_POST['parrafo']   = '3';
	$_POST['titulo']    = '4';
	$_POST['subtitulo'] = '5';
	$_POST['link']      = '6';
	*/
	
	if( isset($_POST['fTitulo'])){
		$setupServicios['config']['tipografia']['titulo'] = $_POST['fTitulo'];
		gConfigSevicio( $setupServicios );
	}
	if( isset($_POST['fSubtitulo'])){
		$setupServicios['config']['tipografia']['subtitulo'] = $_POST['fSubtitulo'];
		gConfigSevicio( $setupServicios );
	}
	if( isset($_POST['fParrafo'])){
		$setupServicios['config']['tipografia']['parrafo'] = $_POST['fParrafo'];
		gConfigSevicio( $setupServicios );
	}
	
	
	
    /*  
    if( isset($_POST['parrafo'])   AND
	    isset($_POST['titulo'] )   AND
	    isset($_POST['subtitulo']) AND
	    isset($_POST['link']) 
	){  
        $tipografiaParrafo = $_POST['parrafo'];
        $tipografiaTitulo  = $_POST['titulo'] ;
        $tipografiaSubtitulo = $_POST['subtitulo'];
        $tipografiaLink      = $_POST['link'] ;
        
        $setupProductos['config']['tipografia']['parrafo']   = $tipografiaParrafo;
        $setupProductos['config']['tipografia']['titulo']    = $tipografiaTitulo ;
        $setupProductos['config']['tipografia']['subtitulo'] = $tipografiaSubtitulo;
        $setupProductos['config']['tipografia']['link']      = $tipografiaLink;
        
        gConfigSevicio( $setupProductos );
    }  */
    
    // LOGOS //
    
    //$_POST['logo']    = 'logo test';
	//$_POST['favicom'] = 'logo test2';

    if( isset($_POST['logo'])   AND
	    isset($_POST['favicom'] )  
	){ 
		$logoLogo    = $_POST['logo'];
		$logoFavicom = $_POST['favicom'];
		
		$setupServicios['config']['logos']['logo']    = $logoLogo;
		$setupServicios['config']['logos']['favicom'] = $logoFavicom;
		
		gConfigSevicio( $setupServicios );
		
	}
    // COLORES //
    if( isset($_POST['color_1'])   AND
        isset($_POST['color_2'])   AND
        isset($_POST['color_3'])   AND
        isset($_POST['color_4']) 
    ){
	   $setupServicios['config']['colores']['color1'] = $_POST['color_1'];
	   $setupServicios['config']['colores']['color2'] = $_POST['color_2'];
	   $setupServicios['config']['colores']['color3'] = $_POST['color_3'];
	   $setupServicios['config']['colores']['color4'] = $_POST['color_4'];
	   gConfigSevicio( $setupServicios );
    }  
    
    
    // SLIDES //
    /*
    $_POST['id']         = '1';
    $_POST['categoria']  = 'categoria1';
    $_POST['foto']       = 'fotox';
    $_POST['filtroFoto'] = 'filtro x';
    $_POST['opacidad']   = 'opacidad x';
    $_POST['titulo']     = 'titulo x';
    $_POST['subtitulo']  = 'subtitulo x';
    $_POST['texto']      = 'texto x';
    $_POST['link']       = 'link x';
    $_POST['textoBtn']   = 'texto boton';
    $_POST['colorBtn']   = 'color boton';
    $_POST['tipoBtn']    = 'tipo boton';
    $_POST['sombraBtn']  = 'si';
    $_POST['colorTxTitulo']    = 'color tx titulo';
    $_POST['colorTxSubtitulo'] = 'color tx subtitulo';
    $_POST['colorTxBtn'] = 'color tx boto';
    */
    // instruccion_slide
    // slide_form
    if( isset($_POST['id_slide'])   AND
	    isset($_POST['slide_categoria'])AND
	    isset($_POST['slide_image']) AND
	    isset($_POST['slide_filtro']) AND
	    isset($_POST['slide_opacidad'])   AND
	    isset($_POST['slide_titulo'])     AND
	    isset($_POST['slide_subtitulo'])  AND
	    isset($_POST['slide_texto']) AND
	    isset($_POST['slide_link'])  AND
	    isset($_POST['slide_textoBtn']) AND
	    isset($_POST['slide_colorBtn']) AND
	    isset($_POST['slide_tipoBtn'])  AND
	    isset($_POST['slide_sombraBtn'])AND
	    isset($_POST['slide_colorTxTitulo'])    AND
	    isset($_POST['slide_colorTxSubtitulo']) AND
	    isset($_POST['slide_colorTxBtn'])  
	){
        $slideId         = $_POST['id_slide'];
        $slideCategoria  = $_POST['slide_categoria'] ;
        $slideFoto       = $_POST['slide_image'];
        $slideFiltroFoto = $_POST['slide_filtro'];
        $slideOpacidad   = $_POST['slide_opacidad']  ;
        $slideTitulo     = $_POST['slide_titulo']    ;
        $slideSubtitulo  = $_POST['slide_subtitulo'] ;
        $slideTexto      = $_POST['slide_texto'];
        $slideLink       = $_POST['slide_link'];
        $slideTextoBtn   = $_POST['slide_textoBtn'];
        $slideColorBtn   = $_POST['slide_colorBtn'];
        $slideTipoBtn    = $_POST['slide_tipoBtn'];
        $slideSombraBtn  = $_POST['slide_sombraBtn'];
        $slideColorTxTitulo    = $_POST['slide_colorTxTitulo'];
        $slideColorTxSubtitulo = $_POST['slide_colorTxSubtitulo'];
        $slideColorTxBtn       = $_POST['slide_colorTxBtn'];
        
        
        if ( array_key_exists('slide'.$slideId,  $setupServicios['config']['slides']) ){
	        
	        $setupServicios['config']['slides']['slide'.$slideId]['foto']       = $slideFoto;
	        $setupServicios['config']['slides']['slide'.$slideId]['filtroFoto'] = $slideFiltroFoto;
	        $setupServicios['config']['slides']['slide'.$slideId]['opacidad']   = $slideOpacidad;
	        $setupServicios['config']['slides']['slide'.$slideId]['titulo']     = $slideTitulo;
	        $setupServicios['config']['slides']['slide'.$slideId]['subtitulo']  = $slideSubtitulo;
	        $setupServicios['config']['slides']['slide'.$slideId]['texto']      = $slideTexto;
	        $setupServicios['config']['slides']['slide'.$slideId]['link']       = $slideLink;
	        $setupServicios['config']['slides']['slide'.$slideId]['textoBtn']   = $slideTextoBtn;
	        $setupServicios['config']['slides']['slide'.$slideId]['colorBtn']   = $slideColorBtn;
	        $setupServicios['config']['slides']['slide'.$slideId]['tipoBtn']    = $slideTipoBtn;
	        $setupServicios['config']['slides']['slide'.$slideId]['sombreBtn']  = $slideSombraBtn;
	        $setupServicios['config']['slides']['slide'.$slideId]['colorTxTitulo']    = $slideColorTxTitulo;
	        $setupServicios['config']['slides']['slide'.$slideId]['colorTxSubtitulo'] = $slideColorTxSubtitulo;
	        $setupServicios['config']['slides']['slide'.$slideId]['colorTxBtn']       = $slideColorTxBtn;
	              
        } else {
	        
	        $setupServicios['config']['slides']['slide'.$slideId]['id'] = $slideId;
	        $setupServicios['config']['slides']['slide'.$slideId]['categoria']  = 'categoria'.$slideId;
	        $setupServicios['config']['slides']['slide'.$slideId]['foto'] = $slideFoto;
	        $setupServicios['config']['slides']['slide'.$slideId]['filtroFoto'] = $slideFiltroFoto;
	        $setupServicios['config']['slides']['slide'.$slideId]['opacidad']   = $slideOpacidad;
	        $setupServicios['config']['slides']['slide'.$slideId]['titulo']     = $slideTitulo;
	        $setupServicios['config']['slides']['slide'.$slideId]['subtitulo']  = $slideSubtitulo;
	        $setupServicios['config']['slides']['slide'.$slideId]['texto']      = $slideTexto;
	        $setupServicios['config']['slides']['slide'.$slideId]['link']       = $slideLink;
	        $setupServicios['config']['slides']['slide'.$slideId]['textoBtn']   = $slideTextoBtn;
	        $setupServicios['config']['slides']['slide'.$slideId]['colorBtn']   = $slideColorBtn;
	        $setupServicios['config']['slides']['slide'.$slideId]['tipoBtn']    = $slideTipoBtn;
	        $setupServicios['config']['slides']['slide'.$slideId]['sombreBtn']  = $slideSombraBtn;
	        $setupServicios['config']['slides']['slide'.$slideId]['colorTxTitulo']    = $slideColorTxTitulo;
	        $setupServicios['config']['slides']['slide'.$slideId]['colorTxSubtitulo'] = $slideColorTxSubtitulo;
	        $setupServicios['config']['slides']['slide'.$slideId]['colorTxBtn']       = $slideColorTxBtn;
        };
            
        gConfigSevicio( $setupServicios );
        
    };
    
    // CATSLIDE //
    
    //$_POST['id_catSlide']     = '5';
    //$_POST['titulo_catSlide'] = 'titulo cat slide 5';
    //instruccion_catSlide   
     
    if( isset($_POST['id_catSlide']) AND
        isset($_POST['titulo_catSlide']) 
    ){
	    $catSlideId     = $_POST['id_catSlide'];
	    $catSlideTitulo = $_POST['titulo_catSlide'];
	    
	    if ( array_key_exists('catSlide'.$catSlideId,  $setupProductos['config']['catSlide']) ){    
		    $setupServicios['config']['catSlide']['catSlide'.$catSlideId]['id']     = $catSlideId;
		    $setupServicios['config']['catSlide']['catSlide'.$catSlideId]['titulo'] = $catSlideTitulo;
		} else {
			$setupServicios['config']['catSlide']['catSlide'.$catSlideId]['id']     = $catSlideId;
		    $setupServicios['config']['catSlide']['catSlide'.$catSlideId]['titulo'] = $catSlideTitulo;
		}; 
		
		gConfigSevicio( $setupServicios );   
		  
    };
    
    // NOSOTROS //
    /*
    $_POST['nosotrosqOfrecemos']  = 'test q ofrecemos';
    $_POST['nosotrosDiferencial'] = 'test q nos diferencia';
    $_POST['nosotrosValores']     = 'test valores';
    $_POST['nosotrosVision']  = 'test vision';
    $_POST['nosotrosMision']  = 'test mision';
    $_POST['nosotrosFoto1']   = 'test foto1';
    $_POST['nosotrosFoto2']   = 'test foto2';
    $_POST['nosotrosFoto3']   = 'test foto3';
    $_POST['nosotrosFoto4']   = 'test foto4';
    */
        
    if( isset($_POST['nosotrosqOfrecemos'])  AND
        isset($_POST['nosotrosDiferencial']) AND
        isset($_POST['nosotrosValores']) AND
        isset($_POST['nosotrosVision']) AND
        isset($_POST['nosotrosMision'])  AND
        isset($_POST['nosotrosFoto1'])   AND
        isset($_POST['nosotrosFoto2'])   AND
        isset($_POST['nosotrosFoto3'])   AND
        isset($_POST['nosotrosFoto4']) 
    ){
        $nosotrosqOfrecemos  = $_POST['nosotrosqOfrecemos'] ;
        $nosotrosDiferencial = $_POST['nosotrosDiferencial'];
        $nosotrosValores = $_POST['nosotrosValores'];
        $nosotrosVision  = $_POST['nosotrosVision'];
        $nosotrosMision  = $_POST['nosotrosMision'] ;
        $nosotrosFoto1   = $_POST['nosotrosFoto1'];
        $nosotrosFoto2   = $_POST['nosotrosFoto2'];
        $nosotrosFoto3   = $_POST['nosotrosFoto3'];
        $nosotrosFoto4   = $_POST['nosotrosFoto4'];
        
        $setupServicios['config']['nosotros']['qOfrecemos']  = $nosotrosqOfrecemos;
        $setupServicios['config']['nosotros']['diferencial'] = $nosotrosDiferencial;
        $setupServicios['config']['nosotros']['valores'] = $nosotrosValores;
        $setupServicios['config']['nosotros']['vision']  = $nosotrosVision;
        $setupServicios['config']['nosotros']['mision']  = $nosotrosMision;
        $setupServicios['config']['nosotros']['foto1']   = $nosotrosFoto1 ;
        $setupServicios['config']['nosotros']['foto2']   = $nosotrosFoto2 ;
        $setupServicios['config']['nosotros']['foto3']   = $nosotrosFoto3 ;
        $setupServicios['config']['nosotros']['foto4']   = $nosotrosFoto4 ;
        
        gConfigSevicio( $setupServicios );
    };
    
    // EQUIPO //
    /*
    $_POST['id_miembro']     = '3';
    $_POST['foto_equipo']    = 'fotos x';
    $_POST['nombre_equipo']  = 'Nombre x ';
    $_POST['rol_equipo']     = 'Rol X';
    $_POST['texto_equipo']   = 'Texto X';
    $_POST['email_equipo']   = 'correo X';
    $_POST['linkedin_equipo']  = 'linkedin x';
    $_POST['facebook_equipo']  = 'facebook x';
    $_POST['instagram_equipo'] = 'instagram x';
    $_POST['categoria_equipo'] = ' categoria x';
    // instruccion_equipo */
    
    if( isset($_POST['id_miembro'])     AND
        isset($_POST['foto_equipo'])    AND
        isset($_POST['nombre_equipo'])  AND
        isset($_POST['rol_equipo'])     AND
        isset($_POST['texto_equipo'])   AND
        isset($_POST['email_equipo'])   AND
        isset($_POST['linkedin_equipo'])  AND
        isset($_POST['facebook_equipo'])  AND
        isset($_POST['instagram_equipo']) AND
        isset($_POST['categoria_equipo']) 
    ){ 
	    
	   $equipoId   = $_POST['id_miembro'];
	   $equipoFoto = $_POST['foto_equipo'];
	   $equipoNombre = $_POST['nombre_equipo'];
	   $equipoRol    = $_POST['rol_equipo'];
	   $equipoTexto  = $_POST['texto_equipo'];
	   $equipoEmail  = $_POST['email_equipo'];
	   $equipoLinkedin  = $_POST['linkedin_equipo'];
	   $equipoFacebook  = $_POST['facebook_equipo'];
	   $equipoInstagram = $_POST['instagram_equipo'];
	   $equipoCategoria = $_POST['categoria_equipo'];
	    
	   if ( array_key_exists('miembro'.$equipoId,  $setupServicios['config']['equipo']) ){
		   
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['id']     = $equipoId;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['foto']   = $equipoFoto;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['nombre'] = $equipoNombre;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['rol']    = $equipoRol;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['texto']  = $equipoTexto;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['email']  = $equipoEmail;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['linkedin']  = $equipoLinkedin;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['facebook']  = $equipoFacebook;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['instagram'] = $equipoInstagram;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['categoria'] = $equipoCategoria;
		   
	   } else {
		   
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['id']     = $equipoId;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['foto']   = $equipoFoto;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['nombre'] = $equipoNombre;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['rol']    = $equipoRol;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['texto']  = $equipoTexto;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['email']  = $equipoEmail;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['linkedin']  = $equipoLinkedin;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['facebook']  = $equipoFacebook;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['instagram'] = $equipoInstagram;
		   $setupServicios['config']['equipo']['miembro'.$equipoId]['categoria'] = $equipoCategoria;
	   }; 
	   gConfigSevicio( $setupServicios ); 
    };    
    
   // TESTIMONIOS //
    /*
    $_POST['testimoniosId']             = '3';
    $_POST['testimoniosNombreUsuario']  = 'nombre testimonio x';
    $_POST['testimoniosComentario']     = 'muy bonito';
    $_POST['testimoniosSocialFuente']   = 'facebook';
    $_POST['testimoniosSocialLink']     = 'link facebook';
    $_POST['testimoniosFoto']           = 'foto x';
    $_POST['testimoniosEstrellas']      = '5';
    $_POST['testimoniosNombreProducto'] = 'todos los productos';
    */
    if( isset($_POST['testimoniosId'])    AND
        isset($_POST['testimoniosNombreUsuario']) AND
        isset($_POST['testimoniosComentario'])    AND
        isset($_POST['testimoniosSocialFuente'])  AND
        isset($_POST['testimoniosSocialLink'])    AND
        isset($_POST['testimoniosFoto'])  AND
        isset($_POST['testimoniosEstrellas'])  AND
        isset($_POST['testimoniosNombreProducto']) 
    ){
	    $testimoniosId            = $_POST['testimoniosId'];
	    $testimoniosNombreUsuario = $_POST['testimoniosNombreUsuario'];
	    $testimoniosComentario    = $_POST['testimoniosComentario']   ;
	    $testimoniosSocialFuente  = $_POST['testimoniosSocialFuente'] ;
	    $testimoniosSocialLink    = $_POST['testimoniosSocialLink'];
	    $testimoniosFoto          = $_POST['testimoniosFoto'];
	    $testimoniosEstrellas      = $_POST['testimoniosEstrellas'];
	    $testimoniosNombreProducto = $_POST['testimoniosNombreProducto'];
	   
	    if ( array_key_exists('cliente'.$testimoniosId,  $setupServicios['config']['testimonios']) ){
		    
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['id']  = $testimoniosId;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['nombreUsuario'] = $testimoniosNombreUsuario;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['comentario']    = $testimoniosComentario;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['socialFuente']  = $testimoniosSocialFuente;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['socialLink'] = $testimoniosSocialLink;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['foto'] = $testimoniosFoto;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['estrellas']  = $testimoniosEstrellas;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['nombreProducto']= $testimoniosNombreProducto;
		    
		} else {
			
			$setupServicios['config']['testimonios']['cliente'.$testimoniosId]['id']  = $testimoniosId;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['nombreUsuario'] = $testimoniosNombreUsuario;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['comentario']    = $testimoniosComentario;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['socialFuente']  = $testimoniosSocialFuente;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['socialLink'] = $testimoniosSocialLink;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['foto'] = $testimoniosFoto;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['estrellas']  = $testimoniosEstrellas;
		    $setupServicios['config']['testimonios']['cliente'.$testimoniosId]['nombreProducto']= $testimoniosNombreProducto;
				
		};
	    gConfigSevicio( $setupServicios );     
    }; 
    
    // INDEX //
    
    /* $_POST['principal_slide']    = '1'; */
    /*
    $_POST['indexSlideCategoria']  = 'categoria X';
    $_POST['indexSlideFoto']       = 'foto X';
    $_POST['indexSlideFiltroFoto'] = 'filtro X';
    $_POST['indexSlideOpacidad']   = 'opacidad X';
    $_POST['indexSlideTitulo']     = 'titulo X';
    $_POST['indexSlideSubtitulo']  = 'subtitulo X';
    $_POST['indexSlideTexto']      = 'texto X';
    $_POST['indexSlideLink']       = 'link X';
    $_POST['indexSlideTextoBtn']   = 'texto btn X';
    $_POST['indexSlideColorBtn']   = 'color btn X';
    $_POST['indexSlideTipoBtn']    = 'tipo btn X';
    $_POST['indexSlideSombraBtn']         = 'sombras btn X';
    $_POST['indexSlideColorTxTitulo']     = 'color titulo X';
    $_POST['indexSlideColorTxSubtitulo']  = 'color subtitulo X';
    $_POST['indexSlideColorTxBtn']    = 'color texto btn X';
    */
    /*
    $_POST['principal_pago_t']   = 'titulo X';
    $_POST['principal_pago_s']   = 'subtitulo X';
    $_POST['principal_equipo_t'] = 'titulo X';
    $_POST['principal_equipo_s'] = 'subtitulo X';
    $_POST['principal_ce_t']     = 'titulo X';
    $_POST['principal_ce_s']     = 'subtitulo X';
    $_POST['principal_testimonio_t'] = 'titulo X';
    $_POST['principal_testimonio_s'] = 'subtitulo X';
    $_POST['principal_delivery_t']   = 'titulo X';
    $_POST['principal_delivery_s']   = 'subtitulo X';
    */

    if( isset($_POST['principal_slide'])   AND
        /*
        isset($_POST['indexSlideCategoria'])   AND
        isset($_POST['indexSlideFoto'])    AND
        isset($_POST['indexSlideFiltroFoto'])  AND
        isset($_POST['indexSlideOpacidad'])    AND
        isset($_POST['indexSlideTitulo'])  AND
        isset($_POST['indexSlideSubtitulo'])   AND
        isset($_POST['indexSlideTexto'])   AND
        isset($_POST['indexSlideLink'])    AND
        isset($_POST['indexSlideTextoBtn'])  AND
        isset($_POST['indexSlideColorBtn'])  AND
        isset($_POST['indexSlideTipoBtn'])   AND
        isset($_POST['indexSlideSombraBtn'])     AND
        isset($_POST['indexSlideColorTxTitulo']) AND
        isset($_POST['indexSlideColorTxSubtitulo']) AND
        isset($_POST['indexSlideColorTxBtn'])    AND
        */
        isset($_POST['principal_pago_t'])  AND
        isset($_POST['principal_pago_s'])   AND
        isset($_POST['principal_equipo_t']) AND
        isset($_POST['principal_equipo_s']) AND
        isset($_POST['principal_ce_t'])    AND
        isset($_POST['principal_ce_s'])    AND
        isset($_POST['principal_testimonio_t']) AND
        isset($_POST['principal_testimonio_s']) AND
        isset($_POST['principal_delivery_t'])   AND
        isset($_POST['principal_delivery_s'])
    ){
	    $setupServicios['config']['index']['slides']['id'] = $_POST['principal_slide'];
	    $setupServicios['config']['index']['medPago']['titulo']      = $_POST['principal_pago_t'];
	    $setupServicios['config']['index']['medPago']['subtitulo']   = $_POST['principal_pago_s'];
	    $setupServicios['config']['index']['equipo']['titulo']       = $_POST['principal_equipo_t'];
	    $setupServicios['config']['index']['equipo']['subtitulo']    = $_POST['principal_equipo_s'];
	    $setupServicios['config']['index']['contExito']['titulo']    = $_POST['principal_ce_t'];
	    $setupServicios['config']['index']['contExito']['subtitulo'] = $_POST['principal_ce_s'];
	    $setupServicios['config']['index']['testimonios']['titulo']  = $_POST['principal_testimonio_t'];
	    $setupServicios['config']['index']['testimonios']['subtitulo'] = $_POST['principal_testimonio_s'];
	    $setupServicios['config']['index']['delivery']['titulo']     = $_POST['principal_delivery_t'];
	    $setupServicios['config']['index']['delivery']['subtitulo']  = $_POST['principal_delivery_s'];
	    
	    gConfigSevicio( $setupServicios ); 
	     
    };
    
    // ANALISIS //
    
    /*
    $_POST['analisisGoogleAnalitics']    = 'dato x1';
    $_POST['analisisGoogleTargetHead']   = 'dato x2';
    $_POST['analisisGoogleTargetBody']   = 'dato x3';
    $_POST['analisisFacebookPixel']      = 'dato x4';
    $_POST['analisisFacebookMessenger']  = 'dato x5';
    $_POST['analisisGoogleMaps']  = 'dato x6';
    $_POST['analisisWhatsapp']    = 'dato x7';
    */
    
    // FACEBOOK MESSENGER 
    if( isset($_POST['codigo_messenger'])){
	    $setupServicios['config']['analisis']['facebookMessenger']= $_POST['codigo_messenger'];
	    gConfigSevicio( $setupProductos );
    };
    // PIXEL
    if( isset($_POST['codigo_pixel'])){
	    $setupServicios['config']['analisis']['facebookPixel']= $_POST['codigo_pixel'];
	    gConfigSevicio( $setupProductos );
    };
    // GOOGLE ANALITYCS
    if( isset($_POST['codigo_analytics'])){
	    $setupServicios['config']['analisis']['googleAnalitics']= $_POST['codigo_analytics'];
	    gConfigSevicio( $setupProductos );
    };
    // GOOGLE TAG MANAGER
    if( isset($_POST['codigo_tmh']) AND isset($_POST['codigo_tmb'])){
	    $setupServicios['config']['analisis']['googleTargetHead']= $_POST['codigo_tmh'];
	    $setupServicios['config']['analisis']['googleTargetBody']= $_POST['codigo_tmb'];
	    gConfigSevicio( $setupServicios );
    };
    
    
    // MEDIOS DE PAGO //
    /*
    $_POST['mediosPagosPaypalClienteId'] = 'paypal id';
    $_POST['mediosPagosPaypalApiKey']    = 'paypal api key';
    $_POST['mediosPagosMercadoPagoClienteId'] = 'Mp id';
    $_POST['mediosPagosMercadoPagoApiKey']    = 'Mp api key';
    $_POST['mediosPagosCriptoBitcoin']   = 'btc id';
    $_POST['mediosPagosCriptoBtcApiKey'] = 'btc api key';
    $_POST['mediosPagosCriptoEthereum']  = 'eth';
    $_POST['mediosPagosCriptoDai']    = 'dai';
    $_POST['mediosPagosCriptoUsdt']   = 'usdt';
    */
    
    if( isset($_POST['mediosPagosPaypalClienteId']) AND
        isset($_POST['mediosPagosPaypalApiKey'])    AND
        isset($_POST['mediosPagosMercadoPagoClienteId']) AND
        isset($_POST['mediosPagosMercadoPagoApiKey'])    AND
        isset($_POST['mediosPagosCriptoBitcoin'])   AND
        isset($_POST['mediosPagosCriptoBtcApiKey']) AND
        isset($_POST['mediosPagosCriptoEthereum'])  AND
        isset($_POST['mediosPagosCriptoDai'])       AND
        isset($_POST['mediosPagosCriptoUsdt'])
    ){
	    $setupServicios['config']['mediosPagos']['paypal']['clienteId'] = $_POST['mediosPagosPaypalClienteId'];
	    $setupServicios['config']['mediosPagos']['paypal']['apiKey']    = $_POST['mediosPagosPaypalApiKey'];
	    $setupServicios['config']['mediosPagos']['mercadoPago']['clienteId'] = $_POST['mediosPagosMercadoPagoClienteId'];
	    $setupServicios['config']['mediosPagos']['mercadoPago']['apiKey']    = $_POST['mediosPagosMercadoPagoApiKey'];
	    $setupServicios['config']['mediosPagos']['cripto']['bitcoin']   = $_POST['mediosPagosCriptoBitcoin'];
	    $setupServicios['config']['mediosPagos']['cripto']['btcApiKey'] = $_POST['mediosPagosCriptoBtcApiKey'];
	    $setupServicios['config']['mediosPagos']['cripto']['ethereum']  = $_POST['mediosPagosCriptoEthereum'];
	    $setupServicios['config']['mediosPagos']['cripto']['dai']  = $_POST['mediosPagosCriptoDai'];
	    $setupServicios['config']['mediosPagos']['cripto']['usdt'] = $_POST['mediosPagosCriptoUsdt'];
	    
	   gConfigSevicio( $setupServicios ); 
    };
    
    // DELIVERY //
    
    //$_POST['id_z'] = 1;
    //$_POST['barrios_z'] = 'Mazatlan';
    //$_POST['precio_z'] = '123';
    
    if( isset($_POST['id_z']) AND
        isset($_POST['barrios_z']) AND
        isset($_POST['precio_z']) 
    ){
	    $idZ = $_POST['id_z'];
	    $num = str_replace('zona', '', $_POST['id_z']);
	    if ( array_key_exists($idZ, $setupServicios['config']['delivery']['tabla'])){
	    
	        $setupServicios['config']['delivery']['tabla'][$idZ]['id']      = $num;
	        $setupServicios['config']['delivery']['tabla'][$idZ]['barrios'] = $_POST['barrios_z'];
	        $setupServicios['config']['delivery']['tabla'][$idZ]['precio']  = $_POST['precio_z'];
	    
	    } else {
		    
		    $setupServicios['config']['delivery']['tabla'][$idZ]['id']      = $num;
	        $setupServicios['config']['delivery']['tabla'][$idZ]['barrios'] = $_POST['barrios_z'];
	        $setupServicios['config']['delivery']['tabla'][$idZ]['precio']  = $_POST['precio_z'];   
	    };
	    
	    gConfigSevicio( $setupServicios );
    };
    
    // RAPY //
    $_GET['rappi_user'] = 'rappy 7';
    $_GET['rappi_psw']  = 'clave rappy';
    
    if( isset($_GET['rappi_user']) AND
        isset($_GET['rappi_psw']) 
    ){
        $setupServicios['config']['delivery']['rappy']['user']     = $_GET['rappi_user'];
        $setupServicios['config']['delivery']['rappy']['password'] = $_GET['rappi_psw'] ;
        
        gConfigSevicio( $setupServicios );
    };
    
    
?>
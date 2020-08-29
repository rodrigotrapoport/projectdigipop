<?php
	error_reporting(0);
    require "jsonProductos.php"   ;
    require "config_products.php";
    require "config_serv.php"     ;
    
    $jsonGalerias  = json_decode ($tituloGalerias, true);  /// PRODUCTOS
    $productos     = json_decode ($jsonProductos , true);  /// PRODUCTOS
    
    $setupProductos = json_decode($jsonConfigProductos,true); /// CONFIG_PRODUCTOS
    
    $setupServicios = json_decode($jsonConfigServicios,true); /// CONFIG_SERV
    
    
//*************** FUNCIONES CONFIG PRODUCTO *********

function gConfigProducto( $arrConfProd){
	//echo json_encode($arrConfProd); // imprime el arry modificado
	//Crear copia de seguridad de datos anteriores
    $date = date('ymdGi');
    $ficheroOriginal = 'config_products.php';
    $ficheroCopia = 'backups/config_products_'.$date.'.php';
    copy($ficheroOriginal, $ficheroCopia);
    // Generar el guardado del nuevo JSON
    $codigoPHP = "<?php "."$"."jsonConfigProductos = '".json_encode($arrConfProd)."  '; ?>";
    $archivo = fopen("config_products.php", "w");
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
/*
$_GET['id_producto'] = "producto11";
$_GET['nombre_producto']= "zapatilla FEAAAAA";
$_GET['unidad_producto']= "Bolsa";
$_GET['precioA'] = "299";
$_GET['precioB']= "199";
$_GET['producto_categoria'] = "galeria1";
$_GET['oferta']="si";
$_GET['moneda']="USD";
$_GET['producto_prioridad']="Alta";
$_GET['codigo']="1231";
$_GET['calif']="5";
$_GET['colores']="negro-blanco";
$_GET['tamanos']= "chico - mediano - grande";
$_GET['descrip']= "Esta es la descripción del super cemento rosado";
$_GET['condi']= "Las hermosas condiciones del producto";
$_GET['foto1']= "foto1";
$_GET['foto2']= "foto2";
$_GET['foto3']= "foto3";
$_GET['instruccion']="crear"; ///// crear editar borrar

////// productos crear / productos editar / productos borrar

*/
    
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
                    var_dump($productos);
                    } else{
                        // estamos BORRANDO PRODUCTO
                        $productos ['productos'][$id_nueva_cat][$id_producto]['visibilidades'] = "no" ;
                        var_dump($productos);
                    };
                
                }
                //No existe el producto pero si la galeria - Por ende estas creando una nueva galeria y producto
                else{
                    if($instruccion =="crear"){
                        
                        /* $conteo_reves_array = krsort($productos['productos'][$id_nueva_cat]); */
                        foreach ($productos['productos'][$id_nueva_cat] as $key => $val) {
                            /* echo "$key = $val\n" */;
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

	
	$_POST['calendario_titulo']     = '1';
	$_POST['calendarioExplicacion'] = '2';
	$_POST['calendarioScript']      = '3';
	
	if( isset($_POST['calendarioTitulo']) AND isset($_POST['calendarioExplicacion']) AND isset($_POST['calendarioScript']) ){
		
		$calendarioTitulo      = $_POST['calendarioTitulo'];
		$calendarioExplicacion = $_POST['calendarioExplicacion'];
		$calendarioScript      = $_POST['calendarioScript'];
		
		$setupProductos['config']['calendario']['titulo']      = $calendarioTitulo;
		$setupProductos['config']['calendario']['explicacion'] = $calendarioExplicacion;
		$setupProductos['config']['calendario']['script']      = $calendarioScript;
	
	    gConfigProducto( $setupProductos );
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
		isset($_POST['contactoFormulario'])   AND 
	    isset($_POST['contactoTelefono']) AND
	    isset($_POST['contactoWhatsapp']) AND
	    isset($_POST['contactolinkMessenger']) AND
	    isset($_POST['contactolinkFacebook'])  AND
	    isset($_POST['contactolinkInstagram']) AND
	    isset($_POST['contactolinkTwitter'])   AND
	    isset($_POST['contactolinkEdin'])
	    ){
		
		$contactoEmail      = $_POST['contactoEmail'];
		$contactoFormulario = $_POST['contactoFormulario'];
		$contactoTelefono   = $_POST['contactoTelefono']  ;
		$contactoWhatsapp   = $_POST['contactoWhatsapp']  ;
		$contactolinkMessenger = $_POST['contactolinkMessenger'];
		$contactolinkFacebook  = $_POST['contactolinkFacebook'] ;
		$contactolinkInstagram = $_POST['contactolinkInstagram'];
		$contactolinkTwitter   = $_POST['contactolinkTwitter'];
		$contactolinkEdin      = $_POST['contactolinkEdin']   ;
		
		
				
		$setupProductos['config']['contacto']['email']      = $contactoEmail;
		$setupProductos['config']['contacto']['formulario'] = $contactoFormulario;
		$setupProductos['config']['contacto']['telefono'] = $contactoTelefono;
		$setupProductos['config']['contacto']['whatsapp'] = $contactoWhatsapp;
		$setupProductos['config']['contacto']['linkMessenger'] = $contactolinkMessenger;
		$setupProductos['config']['contacto']['linkFacebook']  = $contactolinkFacebook;
		$setupProductos['config']['contacto']['linkInstagram'] = $contactolinkInstagram;
		$setupProductos['config']['contacto']['linkTwitter']   = $contactolinkTwitter;
		$setupProductos['config']['contacto']['linkEdin']   = $contactolinkEdin; 
	
	    gConfigProducto( $setupProductos );
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
		
		$setupProductos['config']['contadorExito']['exito'.$exitoId]['id']    = $exitoId;
		$setupProductos['config']['contadorExito']['exito'.$exitoId]['texto'] = $exitoTexto;
		$setupProductos['config']['contadorExito']['exito'.$exitoId]['nombre']= $exitoVisibilidad;
		$setupProductos['config']['contadorExito']['exito'.$exitoId]['icono'] = $exitoIcono;
		
		gConfigProducto( $setupProductos );
	}

    // TIPOGRAFIA   1 de 42 posibles //
    /*
    $_POST['parrafo']   = '3';
	$_POST['titulo']    = '4';
	$_POST['subtitulo'] = '5';
	$_POST['link']      = '6';
	*/
	
	if( isset($_POST['fTitulo'])){
		$setupProductos['config']['tipografia']['titulo'] = $_POST['fTitulo'];
		gConfigProducto( $setupProductos );
	}
	if( isset($_POST['fSubtitulo'])){
		$setupProductos['config']['tipografia']['subtitulo'] = $_POST['fSubtitulo'];
		gConfigProducto( $setupProductos );
	}
	if( isset($_POST['fParrafo'])){
		$setupProductos['config']['tipografia']['parrafo'] = $_POST['fParrafo'];
		gConfigProducto( $setupProductos );
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
        
        gConfigProducto( $setupProductos );
    }  */
    
    // LOGOS //
    
    $_POST['logo']    = 'logo test';
	$_POST['favicom'] = 'logo test2';

    if( isset($_POST['logo'])   AND
	    isset($_POST['favicom'] )  
	){ 
		$logoLogo    = $_POST['logo'];
		$logoFavicom = $_POST['favicom'];
		
		$setupProductos['config']['logos']['logo']    = $logoLogo;
		$setupProductos['config']['logos']['favicom'] = $logoFavicom;
		
		gConfigProducto( $setupProductos );
		
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
        
        
        if ( array_key_exists('slide'.$slideId,  $setupProductos['config']['slides']) ){
	        
	        $setupProductos['config']['slides']['slide'.$slideId]['foto']       = $slideFoto;
	        $setupProductos['config']['slides']['slide'.$slideId]['filtroFoto'] = $slideFiltroFoto;
	        $setupProductos['config']['slides']['slide'.$slideId]['opacidad']   = $slideOpacidad;
	        $setupProductos['config']['slides']['slide'.$slideId]['titulo']     = $slideTitulo;
	        $setupProductos['config']['slides']['slide'.$slideId]['subtitulo']  = $slideSubtitulo;
	        $setupProductos['config']['slides']['slide'.$slideId]['texto']      = $slideTexto;
	        $setupProductos['config']['slides']['slide'.$slideId]['link']       = $slideLink;
	        $setupProductos['config']['slides']['slide'.$slideId]['textoBtn']   = $slideTextoBtn;
	        $setupProductos['config']['slides']['slide'.$slideId]['colorBtn']   = $slideColorBtn;
	        $setupProductos['config']['slides']['slide'.$slideId]['tipoBtn']    = $slideTipoBtn;
	        $setupProductos['config']['slides']['slide'.$slideId]['sombreBtn']  = $slideSombraBtn;
	        $setupProductos['config']['slides']['slide'.$slideId]['colorTxTitulo']    = $slideColorTxTitulo;
	        $setupProductos['config']['slides']['slide'.$slideId]['colorTxSubtitulo'] = $slideColorTxSubtitulo;
	        $setupProductos['config']['slides']['slide'.$slideId]['colorTxBtn']       = $slideColorTxBtn;
	              
        } else {
	        
	        $setupProductos['config']['slides']['slide'.$slideId]['id'] = $slideId;
	        $setupProductos['config']['slides']['slide'.$slideId]['categoria']  = 'categoria'.$slideId;
	        $setupProductos['config']['slides']['slide'.$slideId]['foto'] = $slideFoto;
	        $setupProductos['config']['slides']['slide'.$slideId]['filtroFoto'] = $slideFiltroFoto;
	        $setupProductos['config']['slides']['slide'.$slideId]['opacidad']   = $slideOpacidad;
	        $setupProductos['config']['slides']['slide'.$slideId]['titulo']     = $slideTitulo;
	        $setupProductos['config']['slides']['slide'.$slideId]['subtitulo']  = $slideSubtitulo;
	        $setupProductos['config']['slides']['slide'.$slideId]['texto']      = $slideTexto;
	        $setupProductos['config']['slides']['slide'.$slideId]['link']       = $slideLink;
	        $setupProductos['config']['slides']['slide'.$slideId]['textoBtn']   = $slideTextoBtn;
	        $setupProductos['config']['slides']['slide'.$slideId]['colorBtn']   = $slideColorBtn;
	        $setupProductos['config']['slides']['slide'.$slideId]['tipoBtn']    = $slideTipoBtn;
	        $setupProductos['config']['slides']['slide'.$slideId]['sombreBtn']  = $slideSombraBtn;
	        $setupProductos['config']['slides']['slide'.$slideId]['colorTxTitulo']    = $slideColorTxTitulo;
	        $setupProductos['config']['slides']['slide'.$slideId]['colorTxSubtitulo'] = $slideColorTxSubtitulo;
	        $setupProductos['config']['slides']['slide'.$slideId]['colorTxBtn']       = $slideColorTxBtn;
        };
            
        gConfigProducto( $setupProductos );
        
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
		    $setupProductos['config']['catSlide']['catSlide'.$catSlideId]['id']     = $catSlideId;
		    $setupProductos['config']['catSlide']['catSlide'.$catSlideId]['titulo'] = $catSlideTitulo;
		} else {
			$setupProductos['config']['catSlide']['catSlide'.$catSlideId]['id']     = $catSlideId;
		    $setupProductos['config']['catSlide']['catSlide'.$catSlideId]['titulo'] = $catSlideTitulo;
		}; 
		
		gConfigProducto( $setupProductos );   
		  
    };
    
    // NOSOTROS //
    
    $_POST['nosotrosqOfrecemos']  = 'test q ofrecemos';
    $_POST['nosotrosDiferencial'] = 'test q nos diferencia';
    $_POST['nosotrosValores']     = 'test valores';
    $_POST['nosotrosVision']  = 'test vision';
    $_POST['nosotrosMision']  = 'test mision';
    $_POST['nosotrosFoto1']   = 'test foto1';
    $_POST['nosotrosFoto2']   = 'test foto2';
    $_POST['nosotrosFoto3']   = 'test foto3';
    $_POST['nosotrosFoto4']   = 'test foto4';
        
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
        
        $setupProductos['config']['nosotros']['qOfrecemos']  = $nosotrosqOfrecemos;
        $setupProductos['config']['nosotros']['diferencial'] = $nosotrosDiferencial;
        $setupProductos['config']['nosotros']['valores'] = $nosotrosValores;
        $setupProductos['config']['nosotros']['vision']  = $nosotrosVision;
        $setupProductos['config']['nosotros']['mision']  = $nosotrosMision;
        $setupProductos['config']['nosotros']['foto1']   = $nosotrosFoto1 ;
        $setupProductos['config']['nosotros']['foto2']   = $nosotrosFoto2 ;
        $setupProductos['config']['nosotros']['foto3']   = $nosotrosFoto3 ;
        $setupProductos['config']['nosotros']['foto4']   = $nosotrosFoto4 ;
        
        gConfigProducto( $setupProductos );
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
	    
	   if ( array_key_exists('miembro'.$equipoId,  $setupProductos['config']['equipo']) ){
		   
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['id']     = $equipoId;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['foto']   = $equipoFoto;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['nombre'] = $equipoNombre;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['rol']    = $equipoRol;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['texto']  = $equipoTexto;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['email']  = $equipoEmail;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['linkedin']  = $equipoLinkedin;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['facebook']  = $equipoFacebook;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['instagram'] = $equipoInstagram;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['categoria'] = $equipoCategoria;
		   
	   } else {
		   
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['id']     = $equipoId;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['foto']   = $equipoFoto;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['nombre'] = $equipoNombre;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['rol']    = $equipoRol;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['texto']  = $equipoTexto;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['email']  = $equipoEmail;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['linkedin']  = $equipoLinkedin;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['facebook']  = $equipoFacebook;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['instagram'] = $equipoInstagram;
		   $setupProductos['config']['equipo']['miembro'.$equipoId]['categoria'] = $equipoCategoria;
	   }; 
	   gConfigProducto( $setupProductos ); 
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
	   
	    if ( array_key_exists('cliente'.$testimoniosId,  $setupProductos['config']['testimonios']) ){
		    
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['id']  = $testimoniosId;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['nombreUsuario'] = $testimoniosNombreUsuario;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['comentario']    = $testimoniosComentario;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['socialFuente']  = $testimoniosSocialFuente;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['socialLink'] = $testimoniosSocialLink;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['foto'] = $testimoniosFoto;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['estrellas']  = $testimoniosEstrellas;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['nombreProducto']= $testimoniosNombreProducto;
		    
		} else {
			
			$setupProductos['config']['testimonios']['cliente'.$testimoniosId]['id']  = $testimoniosId;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['nombreUsuario'] = $testimoniosNombreUsuario;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['comentario']    = $testimoniosComentario;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['socialFuente']  = $testimoniosSocialFuente;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['socialLink'] = $testimoniosSocialLink;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['foto'] = $testimoniosFoto;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['estrellas']  = $testimoniosEstrellas;
		    $setupProductos['config']['testimonios']['cliente'.$testimoniosId]['nombreProducto']= $testimoniosNombreProducto;
				
		};
	    gConfigProducto( $setupProductos );     
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
	    $setupProductos['config']['index']['slides']['id'] = $_POST['principal_slide'];
	    /*
	    $setupProductos['config']['index']['slides']['categoria']  = $_POST['indexSlideCategoria'];
	    $setupProductos['config']['index']['slides']['foto'] = $_POST['indexSlideFoto'];
	    $setupProductos['config']['index']['slides']['filtroFoto'] = $_POST['indexSlideFiltroFoto'];
	    $setupProductos['config']['index']['slides']['opacidad']   = $_POST['indexSlideOpacidad'];
	    $setupProductos['config']['index']['slides']['titulo']    = $_POST['indexSlideTitulo'];
	    $setupProductos['config']['index']['slides']['subtitulo'] = $_POST['indexSlideSubtitulo'];
	    $setupProductos['config']['index']['slides']['texto']     = $_POST['indexSlideTexto'];
	    $setupProductos['config']['index']['slides']['link']      = $_POST['indexSlideLink'];
	    $setupProductos['config']['index']['slides']['textoBtn']  = $_POST['indexSlideTextoBtn'];
	    $setupProductos['config']['index']['slides']['colorBtn']  = $_POST['indexSlideColorBtn'];
	    $setupProductos['config']['index']['slides']['tipoBtn']   = $_POST['indexSlideTipoBtn'];
	    $setupProductos['config']['index']['slides']['sombraBtn'] = $_POST['indexSlideSombraBtn'];
	    $setupProductos['config']['index']['slides']['colorTxTitulo']    = $_POST['indexSlideColorTxTitulo'];
	    $setupProductos['config']['index']['slides']['colorTxSubtitulo'] = $_POST['indexSlideColorTxSubtitulo'];
	    $setupProductos['config']['index']['slides']['colorTxBtn'] = $_POST['indexSlideColorTxBtn'];
	    */
	    $setupProductos['config']['index']['medPago']['titulo']      = $_POST['principal_pago_t'];
	    $setupProductos['config']['index']['medPago']['subtitulo']   = $_POST['principal_pago_s'];
	    $setupProductos['config']['index']['equipo']['titulo']       = $_POST['principal_equipo_t'];
	    $setupProductos['config']['index']['equipo']['subtitulo']    = $_POST['principal_equipo_s'];
	    $setupProductos['config']['index']['contExito']['titulo']    = $_POST['principal_ce_t'];
	    $setupProductos['config']['index']['contExito']['subtitulo'] = $_POST['principal_ce_s'];
	    $setupProductos['config']['index']['testimonios']['titulo']  = $_POST['principal_testimonio_t'];
	    $setupProductos['config']['index']['testimonios']['subtitulo'] = $_POST['principal_testimonio_s'];
	    $setupProductos['config']['index']['delivery']['titulo']     = $_POST['principal_delivery_t'];
	    $setupProductos['config']['index']['delivery']['subtitulo']  = $_POST['principal_delivery_s'];
	    
	    gConfigProducto( $setupProductos ); 
	     
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
	    $setupProductos['config']['analisis']['facebookMessenger']= $_POST['codigo_messenger'];
	    gConfigProducto( $setupProductos );
    };
    // PIXEL
    if( isset($_POST['codigo_pixel'])){
	    $setupProductos['config']['analisis']['facebookPixel']= $_POST['codigo_pixel'];
	    gConfigProducto( $setupProductos );
    };
    // GOOGLE ANALITYCS
    if( isset($_POST['codigo_analytics'])){
	    $setupProductos['config']['analisis']['googleAnalitics']= $_POST['codigo_analytics'];
	    gConfigProducto( $setupProductos );
    };
    // GOOGLE TAG MANAGER
    if( isset($_POST['codigo_tmh']) AND isset($_POST['codigo_tmb'])){
	    $setupProductos['config']['analisis']['googleTargetHead']= $_POST['codigo_tmh'];
	    $setupProductos['config']['analisis']['googleTargetBody']= $_POST['codigo_tmb'];
	    gConfigProducto( $setupProductos );
    };
    
    
    // MEDIOS DE PAGO //
    
    $_POST['mediosPagosPaypalClienteId'] = 'paypal id';
    $_POST['mediosPagosPaypalApiKey']    = 'paypal api key';
    $_POST['mediosPagosMercadoPagoClienteId'] = 'Mp id';
    $_POST['mediosPagosMercadoPagoApiKey']    = 'Mp api key';
    $_POST['mediosPagosCriptoBitcoin']   = 'btc id';
    $_POST['mediosPagosCriptoBtcApiKey'] = 'btc api key';
    $_POST['mediosPagosCriptoEthereum']  = 'eth';
    $_POST['mediosPagosCriptoDai']    = 'dai';
    $_POST['mediosPagosCriptoUsdt']   = 'usdt';
    
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
	    $setupProductos['config']['mediosPagos']['paypal']['clienteId'] = $_POST['mediosPagosPaypalClienteId'];
	    $setupProductos['config']['mediosPagos']['paypal']['apiKey']    = $_POST['mediosPagosPaypalApiKey'];
	    $setupProductos['config']['mediosPagos']['mercadoPago']['clienteId'] = $_POST['mediosPagosMercadoPagoClienteId'];
	    $setupProductos['config']['mediosPagos']['mercadoPago']['apiKey']    = $_POST['mediosPagosMercadoPagoApiKey'];
	    $setupProductos['config']['mediosPagos']['cripto']['bitcoin']   = $_POST['mediosPagosCriptoBitcoin'];
	    $setupProductos['config']['mediosPagos']['cripto']['btcApiKey'] = $_POST['mediosPagosCriptoBtcApiKey'];
	    $setupProductos['config']['mediosPagos']['cripto']['ethereum']  = $_POST['mediosPagosCriptoEthereum'];
	    $setupProductos['config']['mediosPagos']['cripto']['dai']  = $_POST['mediosPagosCriptoDai'];
	    $setupProductos['config']['mediosPagos']['cripto']['usdt'] = $_POST['mediosPagosCriptoUsdt'];
	    
	   gConfigProducto( $setupProductos ); 
    };
    
?>
<?php

//Productos

$_GET['id_producto'] = "producto10";
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
$_GET['instruccion']="crear";

    
if( isset($_GET['id_producto']) 
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
    }else{
        echo "esta faltando un dato";
};

?>
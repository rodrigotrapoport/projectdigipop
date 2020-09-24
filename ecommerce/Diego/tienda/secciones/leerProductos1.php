<?php
	
require "jsonProductos1.php";	
$jsonP = json_decode($jsonProductos,true);//
$jsonGalerias = json_decode($tituloGalerias,true);//


/*
$resultado = array("res" =>$jsonProductos ); // envia el array completo de los productos

//echo json_encode($resultado);
	
//var_dump($jsonP);	

print_r(array_keys($jsonP));
echo '<br>';
print_r(array_keys($jsonP['productos']));
echo '<br>';
//print_r($jsonP[0][0]) ;

$clave = array_search('199', $jsonP['productos']['galeria'. 1]['producto'. 1]); // 
echo $clave.' => clave';

if( isset($_GET['valor x'])){
	
} */

/*
array_keys() - Devuelve todas las claves de un array o un subconjunto de claves de un array
array_values() - Devuelve todos los valores de un array
array_key_exists() - Verifica si el índice o clave dada existe en el array
in_array() - Comprueba si un valor existe en un array


$info = array('café', 'marrón', 'cafeína');

// Enumerar todas las variables
list($bebida, $color, $energía) = $info;
echo "El $bebida es $color y la $energía lo hace especial.\n";

// Enumerar algunas de ellas
list($bebida, , $energía) = $info;
echo "El $bebida tiene $energía.\n";

*/

/*
echo '<br>';

$pila = array("naranja", "plátano");
array_push($pila, "manzana", "arándano");
print_r($pila);

echo '<br>';

$arrX = array('primero' => 'River', 'segundo'=>'boca');
$incluir = ['tercero' =>'talleres de cordoba'];

$arrX += $incluir; // si va al mismo nivel se concatena o inserta

//array_push($arrX, $incluir); // si va a un nivel superior val array pusho

print_r($arrX);
echo '<br>'; */

//*******************************************


    //require "jsonProductos.php";
    //error_reporting(0);
    
    //$jsonGalerias  = json_decode( $tituloGalerias, true );
    /* print_r($jsonGalerias); */
    $instruccion = "";
    $borrar = "";
    $_GET['id_nueva_cat'] = '3';
    $_GET['slide']     = 'Papas Fritas';
    $_GET['prioridad'] = 'Alta';
    $c = 'nada';
    
    if( isset($_GET['id_nueva_cat']) AND isset($_GET['slide']) AND isset($_GET['prioridad']) ){
	    
        $id_nueva  = $_GET['id_nueva_cat'];
        $slide     = $_GET['slide'];
        $prioridad = $_GET['prioridad'];
        
        // SI LA CLAVE EXISTE ACTUALIZA LOS VALORES
        if ( array_key_exists( 'galeria'.$id_nueva, $jsonGalerias['galerias'] ) ) {
	        
            if($instruccion == ""){
                $jsonGalerias['galerias']['galeria'.$id_nueva]     = $slide;
                $jsonGalerias['prioridades']['prioridad'.$id_nueva]= $prioridad;
                
                $texto = $jsonGalerias['galerias']['galeria'.$id_nueva]
                         ." / "
                         .$jsonGalerias['prioridades']['prioridad'.$id_nueva]
                         ." / "
                         .$slide
                         ." / "
                         .$prioridad;
               
            }else {

            };
            //$texto = "Galeria existe!!";
            
        } else { // SI LA CLAVE NO EXISTE INSERTA UNA NUEVA GALERIA
            
            $jsonGalerias['galerias']['galeria'.$id_nueva] = $slide;
            
            
            $jsonGalerias['prioridades']['prioridad'.$id_nueva] = $prioridad;
            
            
            if (array_key_exists('galeria'.$id_nueva, $jsonGalerias['galerias'])){
                //$c= "Existe el nuevo array ".'galeria'.$id_nueva;
            }else{
                //$c= "No existe el nuevo array ".'galeria'.$id_nueva;
            };
            $texto = json_encode($jsonGalerias);
            
        };
        echo json_encode($jsonGalerias);
    	
    } else {
        $id_nueva = "No llego nada!!!";
    };

    $texto = json_encode($jsonGalerias);
    $archivo = fopen("archivoTxt.txt", "w");
    /* $texto = $id_nueva." ".$slide." ".$prioridad; */
    fwrite($archivo, $texto);
    fclose($archivo);
    
    
/*
    if( isset($_GET['id_producto']) 
    AND isset($_GET['nombre_producto ']) 
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
    AND isset($_GET['foto3'])){
    	
    };
*/    



?>
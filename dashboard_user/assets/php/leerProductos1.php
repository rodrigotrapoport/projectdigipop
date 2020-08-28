<?php
	
require "jsonProductos.php";	
$jsonP = json_decode($jsonProductos,true);//

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
echo '<br>';



?>
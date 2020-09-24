<?php

$f1 = 1;
$f2 = 2;
$f3 = 3;
	
$x = 'f'.rand(1,3);
$fuenteSeleccionada = " ${$x }";	
echo $fuenteSeleccionada;	
	
$x1 = [[1,2,3],[5,6]];
print_r($x1);
echo '<br>';
$x2 = array(4,5,6);
$x3 = array(1,2,3);
$xf = array();
array_push($xf, $x3);
array_push($xf, $x2);
print_r($xf);
echo '<br>';
$x4 = [$x3,$x2];
print_r($x4);
	
	?>
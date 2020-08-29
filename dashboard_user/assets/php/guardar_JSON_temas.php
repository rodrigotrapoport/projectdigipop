<?php
//error_reporting(0);
require('config_temas.php');
$jsonTemas = json_decode($jsonConfig,true);

///////////////// COLORES ////////////////
	
//$_POST['c1']= 'rojo';	
//$_POST['c2']= 'verde';	
//$_POST['c3']= 'azul';	
//$_POST['c4']= 'amarillo';	

if( isset($_POST['c1']) AND isset($_POST['c2']) AND isset($_POST['c3']) AND isset($_POST['c4'])){
	
	$jsonTemas['temas']['colores']['color1'] = $_POST['c1'];
	
	$jsonTemas['temas']['colores']['color2'] = $_POST['c2'];
	
	$jsonTemas['temas']['colores']['color3'] = $_POST['c3'];
	
	$jsonTemas['temas']['colores']['color4'] = $_POST['c4'];
	
}

///////////////////////// FUENTES //////////////////

//$_POST['fTitulo']    = '';	
//$_POST['fSubtitulo'] = '';	
//$_POST['fParrafo']   = '';	
//$_POST['fLink']      = '';	

if( isset($_POST['fTitulo']) AND isset($_POST['fSubtitulo']) AND isset($_POST['fParrafo']) AND isset($_POST['fLink'])){
	
	$jsonTemas['temas']['fuentes']['titulo']    = $_POST['fTitulo'];
	
	$jsonTemas['temas']['fuentes']['subtitulo'] = $_POST['fSubtitulo'];
	
	$jsonTemas['temas']['fuentes']['parrafo']   = $_POST['fParrafo'];
	
	$jsonTemas['temas']['fuentes']['link']      = $_POST['fLink'];
	
}

//echo json_encode($jsonTemas);

/////////// GUARDAR //////////
        
//Crear copia de seguridad de datos anteriores
$date = date('ymdGi');
$ficheroOriginal = 'config_temas.php';
$ficheroCopia = 'backups/temas_'.$date.'.php';
copy($ficheroOriginal, $ficheroCopia);
// Generar el guardado del nuevo JSON
$codigoPHP = "<?php $"."jsonConfig = '".json_encode($jsonTemas)." '; ?>";

$archivo = fopen("config_temas.php", "w");
fwrite($archivo, $codigoPHP);
fclose($archivo);

//$tema_res = "OK";
$resultado = array("res" => 'SE ACTUALIZO LA PALETA DE COLORES');
echo json_encode($resultado);
	
?>
<?php
ob_start();
require "config_products.php";
require "config_serv.php"    ;
$setupProductos = json_decode($jsonConfigProductos,true); /// CONFIG_PRODUCTOS
$setupServicios = json_decode($jsonConfigServicios,true); /// CONFIG_SERV
////////////////////////////////////
function gConfigProducto( $arrConfProd){
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
//////////////////////////////////
	
$fileName     = $_FILES["file"]["name"] ;    // The file name
$fileTmpLoc   = $_FILES["file"]["tmp_name"];// File in the PHP tmp folder
$fileType     = $_FILES["file"]["type"] ;    // The type of file it is
$fileSize     = $_FILES["file"]["size"] ;    // File size in bytes
$fileErrorMsg = $_FILES["file"]["error"];   // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen
    //echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
}
$extension = end(explode(".", $_FILES["file"]["name"])); // extension del archivo de fotos
if(move_uploaded_file($fileTmpLoc, "backups/logo.".$extension)){
    //echo "correcto";
    // EDITA EL GUARDAR JSON LOGOS
    $setupProductos['config']['logos']['logo'] = 'logo.'.$extension; // debe ser un unico nombre
    $setupServicios['config']['logos']['logo'] = 'logo.'.$extension;
    gConfigProducto( $setupProductos ); 
} else {
    //echo "error";
}	

header('Location:../../gestion_de_logos.html');	
ob_end_flush();	
?>
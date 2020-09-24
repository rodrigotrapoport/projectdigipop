<?php 
require('log/log.php');

/// CONEXION DB ///
$dbc = mysqli_connect(DBHOST,DBUSER,DBPW);
if (!$dbc) {
    exit();
};

$dbs = mysqli_select_db($dbc, DBNAME);
if (!$dbs) {
    exit();
};
//********************
//$_POST['nombre'] = 'DiegoDiego';
if(isset($_POST['nombre'])){
	$usuario = $_POST['nombre'];
	$values = "SELECT id FROM usuarios WHERE usuario='$usuario' "; 
	$result = $dbc->query($values)    ;
	$filas  = mysqli_num_rows($result);	
	if($filas > 0){ 
	   $resultado = array("res" =>'error');       
    } else {
	   $resultado = array("res" =>'ok');
	};
};
echo json_encode($resultado);
gc_collect_cycles();
mysql_free_result();
?>
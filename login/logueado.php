<?php
	
////// REGISTRAR NUEVO CLIENTE //////
require('log/log.php');

/// CONEXION DB ///
$dbc = mysqli_connect(DBHOST,DBUSER,DBPW);
if (!$dbc) {
    exit();
}

$dbs = mysqli_select_db($dbc, DBNAME);
if (!$dbs) {
    exit();
}

if( isset($_GET['link'])){
	$link = $_GET['link'];
	$values = "SELECT nombres, apellidos, telefono, email FROM registro WHERE status1='$link' "; 
    $result = $dbc->query($values)    ;
    $filas  = mysqli_num_rows($result);	
    if($filas == 1){
	    echo 'Logueado correctamente <br>';
	    
	    while($row = $result -> fetch_assoc()){
		    echo 'nombre '.$row['nombres'].' '.$row['apellidos'].' '.$row['email'];
	    };
	    	    
    } else {
	    echo 'no estas registrado';
    };
};


	
?>
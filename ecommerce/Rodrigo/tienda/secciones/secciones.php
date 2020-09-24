<?php

// PARTE INICIAL	
$encabezado = 
'<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>digiPop</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script> <!---- iconos fa-code -->
	<link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="bspop/bs4.pop.css">
</head>

<body>';

// BARRA DE NAVEGACION
$navegacion = 
'<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid" id="d1">
		<a class="navbar-brand" href="#">
			<img src="img/logo.png">
		</a>
		<button class="navbar-toggler"	type="button" data-toggle="collapse" data-target="#navbarResponsive">
		    <span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
				    <a class="nav-link" href="#">Inicio</a>
				</li>
				<li class="nav-item">
				    <a class="nav-link" href="#">Nosotros</a>
				</li>
				<li class="nav-item">
				    <a class="nav-link" href="#">Servicios</a>
				</li>
				<li class="nav-item">
				    <a class="nav-link" href="#">Contactenos</a>
				</li>
			</ul>
		</div>	
	</div>
</nav>';


// CIERRE
$cierre = '</body> </html>';
?>
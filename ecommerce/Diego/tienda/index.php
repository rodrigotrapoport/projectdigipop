<?php
/* faltaltes 
   logo de la empresa
   definir criterio de los slides
   delivery free

*/	
//****************************	
ob_start();// permite corregir error en header o salto a otra pagina
session_start();

//require "secciones/json.php";
//require "secciones/jsonProductos1.php";
//*******************

require('../config/assets/php/jsonServicios.php');
require('../config/assets/php/config_Serv.php'); // configuracion del sitio 

$jsonConfig   = json_decode($jsonConfigServicios, true); // array configuracion del sitio
$jsonS = json_decode($jsonServicios, true);  // servicios disponibles
//$jsonY = json_decode($jsonX, true);  // array pagina index

//////////// LOGOTIPO /////////////

$logoUrl = $jsonConfig['config']['logos']['logo'];

//////////// MEDIOS DE PAGO Y DELIVERY ///////////
$paypal   = false;
$mercadoPago = false;
$bitcoin  = false;
$ethereum = false;
$dai      = false;
$usdt     = false;
$rappy    = false; // delivery

if( isset( $jsonConfig['config']['mediosPagos']['paypal']['clienteId']) ){
    $paypal = true;	
};
if( isset( $jsonConfig['config']['mediosPagos']['mercadoPago']['clienteId']) ){
    $mercadoPago = true;	
};
if( isset( $jsonConfig['config']['mediosPagos']['cripto']['bitcoin']) ){
    $bitcoin = true;	
};
if( isset( $jsonConfig['config']['mediosPagos']['cripto']['ethereum']) ){
    $ethereum = true;	
};
if( isset( $jsonConfig['config']['mediosPagos']['cripto']['dai']) ){
    $dai = true;	
};
if( isset( $jsonConfig['config']['mediosPagos']['cripto']['dai']) ){
    $usdt = true;	
};
if( isset( $jsonConfig['config']['delivery']['rappy']) ){
    $rappy = true;	
};

////////// TESTIMONIOS //////////////////
$testimonioHTML = '';
$active = 'active';
for($i = 0; $i < count($jsonConfig['config']['testimonios']); $i++){ 
    $keyT = key($jsonConfig['config']['testimonios']);
    $nombreTestimonio = $jsonConfig['config']['testimonios'][$keyT]['nombreUsuario'];
    $comentarioTestimonio = $jsonConfig['config']['testimonios'][$keyT]['comentario'];
    $socialTestimonio = $jsonConfig['config']['testimonios'][$keyT]['socialFuente'];
    $linkTestimonio   = $jsonConfig['config']['testimonios'][$keyT]['socialLink'];
    $productoTestimonio = $jsonConfig['config']['testimonios'][$keyT]['categoria'];
    $fotoTestimonio = $jsonConfig['config']['testimonios'][$keyT]['foto'];
    //************ HTLML
    
    if( $socialTestimonio == 'facebook'){
	   $icono = '<i class="fab fa-facebook-square fa-3x"></i>'; 
    } elseif ($socialTestimonio == 'twiter'){
	   $icono = '<i class="fab fa-twitter-square fa-3x"></i>'; 
    } else {
	   $icono = '<i class="fas fa-newspaper fa-3x"></i>'; 
    };
    
    
    $testimonioHTML .= '
	    <div class="carousel-item '.$active.'">
	        <div class="row justify-content-md-center">
			    <div class="col col-md-1 text-center">
			        '. $icono .'
			    </div>
			    <div class="col-md-8">
                    <p class="fParrafo">'. $comentarioTestimonio .'</p>
                    <p class="fParrafo text-uppercase">'. $productoTestimonio .'</p> 
			    </div>
			    <div class="col col-md-3 col-6">
			        <div class="col-sm-6  offset-lg-0  offset-md-0 offset-sm-10  offset-6 "> 
					    <a href="'. $linkTestimonio .'" class="thumbnail">
					        <div class="imageA">
					            <img src="'. $fotoTestimonio .'" class="imgA imgA-responsive full-width" />
					        </div>
					        <div class="caption text-center fSubtitulo text-uppercase">
					            '. $nombreTestimonio .'
					        </div>
					    </a>
					</div>  
			    </div>
			</div>
	    </div>';
    
    $active = '';
    //*******************
    next($jsonConfig['config']['testimonios']);
};

////////////////////// SLIDES ///////////////////////////

$slides = '';
$activeSlide ='active';
for($i = 0; $i < count($jsonConfig['config']['slides']); $i++){  

	$key = key($jsonConfig['config']['slides']);

	$dato['foto'] = $jsonConfig['config']['slides'][$key]['foto'];
	$dato['filtroFoto'] = $jsonConfig['config']['slides'][$key]['filtroFoto'];
	$dato['opacidadFoto'] = $jsonConfig['config']['slides'][$key]['opacidad'];
	$dato['titulo'] = $jsonConfig['config']['slides'][$key]['titulo'];
	$dato['subtitulo'] = $jsonConfig['config']['slides'][$key]['subtitulo'];
	$dato['texto'] = $jsonConfig['config']['slides'][$key]['texto'];
	$dato['link'] = $jsonConfig['config']['slides'][$key]['link'];
	$dato['botonTexto'] = $jsonConfig['config']['slides'][$key]['textoBtn'];
	$dato['botonColor'] = $jsonConfig['config']['slides'][$key]['colorBtn'];
	$dato['botonTipo'] = $jsonConfig['config']['slides'][$key]['tipoBtn'];
	$dato['botonSombra'] = $jsonConfig['config']['slides'][$key]['sombraBtn'];
	$dato['botonForm'] = $jsonConfig['config']['slides'][$key]['form'];

	if( $dato['botonTexto'] != ''){
       $botonShow = '<button type="button" class="btn btn-primary btn-lg fSubtitulo">'.$dato['botonTexto'].'</button>';
	} else {
		$botonShow = '';
	};

	$slides .='
		<div class="carousel-item '.$activeSlide.'" 
		
		style= "background-image: url('.$dato['foto'].');
				background-size: cover;
				background-position:center;
				height: 600px;"
		>
		<!--
			<img class="d-none d-sm d-sm-block w-100" src="'.$dato['foto'].'" alt="digiPop" id="fondo1">
			<img class="d-block d-sm-none  w-100"     src="'.$dato['foto'].'"               > -->
     
            <div class="carousel-caption">
	      	    <h1 class="fSubtitulo">'.$dato['titulo'].'</h1>
				<h3 class="fSubtitulo">'.$dato['subtitulo'].'</h3>
				'.$botonShow.	    
           '</div>
        </div>';


	////////////////////////////////////////
	$activeSlide = '';
	next($jsonConfig['config']['slides']);
};

//////////// DETALLE DEL SERVICIO /////////////

$cantServ = count($jsonS['servicios']);

$sorteo = rand(1,$cantServ);

$iN = 1;
while ($iN <= 5) {  ////// busca un servisio disponible ///////
	$iN++;
	$sorteo = rand(1,$cantServ); 
	if($jsonS['servicios']['servicios'.$sorteo]['visibilidad']== 'si'){ 
		$iN = 6;
	}
}

$detalleServicio = '';

if($jsonS['servicios']['servicios'.$sorteo]['visibilidad']== 'si'){
	$nombre = $jsonS['servicios']['servicios'.$sorteo]['nombre'];
	$descripcion = $jsonS['servicios']['servicios'.$sorteo]['descripcion'];
	$condicion =  $jsonS['servicios']['servicios'.$sorteo]['condi'];
	$fotoServico = $jsonS['servicios']['servicios'.$sorteo]['foto'];

	if($jsonS['servicios']['servicios'.$sorteo]['mostrarPrecio'] != 'no'){
		if( $jsonS['servicios']['servicios'.$sorteo]['precioB']!='' ){
			$precioServicio = '<h4 class="text-secondary"><strike>'.$precioFinal = $jsonS['servicios']['servicios'.$sorteo]['precioA'].$jsonS['servicios']['servicios'.$sorteo]['moneda'].'</strike></h4>'.
					'<h1 class="card-title pricing-card-title">'.$precioFinal = $jsonS['servicios']['servicios'.$sorteo]['precioB'].$jsonS['servicios']['servicios'.$sorteo]['moneda'].'</h1>';
		} else {
			$precioServicio =  '<h4 class="text-secondary"><strike>'.$jsonS['servicios']['servicios'.$sorteo]['precioA'].$jsonS['servicios']['servicios'.$sorteo]['moneda'].'</strike></h4>';
			//$jsonS['servicios'][$key]['precioA'].$jsonS['servicios'][$key]['moneda'];
		}
		$textoBotonA = 'CONTRATAR';
		$refLink = 'seccion2.php?serviciosA='.$sorteo;
	} else {
		$precioServicio = '';
		$textoBotonA = 'CONSULTAR PRECIO';
		$refLink = 'seccion2.php?serviciosA='.$sorteo;
	}

	$detalleServicio = '
	<div class="card">
		<div class="card-header fTitulo text-capitalize">
			<h2>'.$nombre.'</h2>
		</div>
		<div class="card-body row fSubtitulo">
			<div class="col">
			<h5 class="card-title"><i class="fab fa-yelp"></i> '.$descripcion.'</h5>
			<p  class="card-title"><h5><i class="fab fa-yelp"></i> '.$condicion.'</h5></p>
			'.$precioServicio.'
			<a href="'.$refLink.'" class="btn btn-primary">'.$textoBotonA.'</a>
			</div>
			<div class="col col-12 col-xs-3 col-md-4 col-lg-4 rounded mt-2" 
			style="background-image: url('.$fotoServico.');
			background-size: cover;
			height: 200px;
			background-position:center;"
			id="ventana">
			</div>
		</div>
	</div>';	
}


?>
<!doctype html>
<html lang="es">
	
<head>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="bspop/bs4.pop.js"></script>
    
	<meta charset="utf-8">
	<meta http-equiv="Cache-Control" content="no-cache"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $jsonY['tienda']['navVar']['nTienda']; ?></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script> <!---- iconos fa-code -->
	
	<link href="./css/style.php" rel="stylesheet">
	
	<link rel="stylesheet" href="bspop/bs4.pop.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- <script src='https://kit.fontawesome.com/a076d05399.js'></script>  ---->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
<script type="text/javascript">

$(document).ready(function(){
    // cantidad de articulos en el carrito
    $.ajax({  
	    url:"contarCarrito.php",   // envia a la url del carrito la informacion
	    method:"POST", 
	    dataType: 'json', 
	    data:{ carrito   : localStorage.carritoServ  // texto agregado 
	         },  
	    success:function(resp){
		    var consultaA = resp.cant;
		    document.getElementById('cantidad').textContent = consultaA ; // reemplaza todo y elimina lo anterior
		    //alert(consultaA);               
		}, 
		error:function(res){
			//alert('ERROR!!!');
	    }
	});
});
        
</script>
	
</head>

<body class="cFondo">
	
<nav class="navbar navbar-expand-md navbar-light sticky-top cBarra">
	<div class="container-fluid fBarra" id="d1">
		<a class="navbar-brand" href="#">
			<img src="<?php echo $logoUrl;?> " width="170px" height="55px">
		</a>
		<button class="navbar-toggler"	type="button" data-toggle="collapse" data-target="#navbarResponsive">
		    <span class="navbar-toggler-icon  "></span> <!-- <i class="material-icons" style="font-size:30px">menu</i></span> -->
		</button>
		
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				
				<?php
					
					echo	
					'<li class="nav-item active">
					    <a class="nav-link" href="index.php">'
					    .'Inicio'.
					    '</a>
					</li>';
					
					
					// servicios			    
					echo	
					'<li class="nav-item dropdown">
					    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">'
					    .'Servicios'.
					    '</a>'.
					    '<div class="dropdown-menu">';      
					for ($i=1; $i <= count($jsonConfig['config']['catSlide']); $i++ ){ // imprime las galerias que son necesarias
						$keyCat = key($jsonConfig['config']['catSlide']);
						if($jsonConfig['config']['catSlide'][$keyCat]['visibilidades'] == 'si'){
							echo '<a class="dropdown-item" href="seccion2.php?serviciosA='.$i.'">'.$jsonConfig['config']['catSlide'][$keyCat]['titulo'].'</a>';
						}	
						next($jsonConfig['config']['catSlide']);
					}
					echo '</div>'.
					'</li>';

				    // equipo			
				    
					echo	
					'<li class="nav-item dropdown">
					    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="seccion3.php">'
					    .'Equipo'.
					    '</a>'.
					    '<div class="dropdown-menu">'.
					       '<a class="dropdown-item" href="seccion3.php?equipo=1" >Nosotros</a>'.
					       '<a class="nav-link"      href="seccion3.php?equipo=3" ><i class="fas fa-envelope" style="font-size:26px;margin-left: 10%"></i></a>'.
					    '</div>'.
					'</li>';
					
				?>
				
				<li class="nav-item ">
					    <a class="nav-link" href="seccion7.php"><i class="fas fa-shopping-cart" style="font-size:26px"></i><span class="badge badge-light" id="cantidad" ></span></a>
				</li>
								
			</ul>
		</div>	
	</div>
</nav> 

<!---------- IMAGENES SLIDE /// CAROUSEL -------->
<div id="carouselExampleIndicators" class="carousel slide fTitulo" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    
    <div class="carousel-inner ">
	<?php echo $slides;?>
    </div>
    <!------------------>   
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
        
        <i class="fas fa-arrow-circle-right" style="width: 68px; height: 68px;color: #808080;"></i>
        <span class="sr-only">Next</span>
    </a>
  
</div>


<!---------- MEDIOS DE PAGO ---->
<div class="jumbotron jumbotron-fluid fSubtitulo">
	    <div class="container">
		    <div class="row justify-content-md-center">
		    
		    	<div class="col-md-2 text-center">
				    <?php
						if($mercadoPago){
							echo  '<img src="img/visa.png" width="" height="60">';
						};
				   ?>
		        </div>
		        <div class="col-md-2 text-center">
				    <?php
				        if($mercadoPago){
				            echo '<img src="img/mastercard.png" height="60">';
				        };
				    ?>
		        </div>
		        <div class="col-md-2 text-center">
				    <?php
				        if($mercadoPago){
					        echo '<img src="img/oxxo.png" height="80">';
				        };
				    ?>
		        </div>
		        <div class="col-md-2 text-center">
				    <?php
				        if($mercadoPago){
					        echo '<img src="img/7eleven.jpeg" height="60">';
				        };
				    ?>
		        </div>
		        <div class="col-md-2 text-center">
					<?php
				    	if($mercadoPago){
							echo '<img src="img/paypal1.png" height="60">';
						};
					?>
		        </div>
	        
		    </div>
	    </div>
	</div>

<!------------- seccion de servicios detalle 1-------->
<div class="container fSubtitulo">
    <?php echo $detalleServicio;?>
</div>	

<!------- TESTIMONIOS -------->
<hr>
<div class="container">
	<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<?php echo $testimonioHTML; ?>
			
		</div>
	</div>
</div>

<!----------- formulario ------>

<hr>
<div class="container-fluid col">
    <div class="jumbotron row " style="background-color:rgba(0,0,0,0);">
		<div id="consulta" class="col">
			<form class="row align-items-center">
				<div class="form-group col-md-4">
					<label for="exampleInputEmail1"class="fSubtitulo" >Email</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
					<small id="emailHelp" class="form-text text-muted fParrafo">Dirección de correo.</small>
				</div>
				<div class="form-group col-md-5">
					<label for="exampleInputPassword1" class="fSubtitulo">Comentarios</label>
					<input type="text" class="form-control" id="exampleInputPassword1" placeholder="">
					<small id="emailHelp" class="form-text text-muted fParrafo" >Envianos todas tus dudas sobre el servicio.</small>
				</div>
				<div class="col-md-3 ">
					<button type="submit" id="preguntar" class="btn btn-primary w-100 fSubtitulo">ENVIAR</button>
				</div>
			</form>
		</div>
	</div>

<!---- footer ----------->
	<div class="bg-dark row fParrafo">
		<div class="row">
			<div class="col-12 col-md-6" style="padding-left: 30px">
				<img class="mb-2" src="<?php echo $logoUrl;?>" alt="" >
				<small class="d-block mb-3 text-muted">© 2020</small>
			</div>
			<div class="col-4 col-md-3">
				<h5>Nosotros</h5>
				<ul class="list-unstyled text-small">
					<li><a class="text-muted" href="#">Rodrigo</a></li>
					<li><a class="text-muted" href="#">Diego</a></li>
					<li><a class="text-muted" href="#">digiPop</a></li>
				</ul>
			</div>
			<div class="col-4 col-md-3">
				<h5>Email</h5>
				<ul class="list-unstyled text-small">
				<li><a class="text-muted" href="#">roo@hhh.com</a></li>
				<li><a class="text-muted" href="#">diego@hhh.com</a></li>
				<li><a class="text-muted" href="#">consultas@hhh.com</a></li>
				</ul>
			</div>
		</div>
	</div>	
</div>	 
  

    
    </body>
</html>
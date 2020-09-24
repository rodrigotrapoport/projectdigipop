<?php
ob_start();// permite corregir error en header o salto a otra pagina
session_start();

require "secciones/json.php";
require "secciones/jsonProductos1.php";
$jsonY = json_decode($jsonX, true); // true regresa un array
$jsonP = json_decode($jsonProductos,true);

//echo '<br>';
//print_r($jsonY);
//echo '<br>';
//echo $jsonY['tienda']['navVar']['logo'];

///////// GALERIAS Y TITULO CAROUSEL   DE PRODUCTOS /////
$jsonGalerias = json_decode( $tituloGalerias, true );
$arrayGalerias = array();
for($i = 0; $i < count($jsonGalerias['galerias']); $i++){        // for de los elementos que estan en galerias
	//echo key($jsonGalerias['galerias']).'<br>';
	
	$key = key($jsonGalerias['galerias']);  // selecciona la clave que contiene esa categoria
	$arraySet1 = $jsonGalerias['galerias'][$key];
	
	$registroArray = array($arraySet1);
	
	array_push($arrayGalerias, $registroArray); // inserta el valor de la clave seleccionada
	//echo $jsonGalerias['galerias'][$key].'<br>';
	next($jsonGalerias['galerias']); // avanza una posicion en el selecctor de key's
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
	
	<link href="css/style.php" rel="stylesheet">
	
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
	    data:{ carrito   : localStorage.carrito  // texto agregado 
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
			<img src="<?php echo $jsonY['tienda']['navVar']['logo']; ?>" width="170px" height="55px">
		</a>
		<button class="navbar-toggler"	type="button" data-toggle="collapse" data-target="#navbarResponsive">
		    <span class="navbar-toggler-icon  "></span> <!-- <i class="material-icons" style="font-size:30px">menu</i></span> -->
		</button>
		
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				
				<?php
					if($jsonY['tienda']['navVar']['inicio']!= ""){
					echo	
					'<li class="nav-item active">
					    <a class="nav-link" href="index.php">'
					    .$jsonY['tienda']['navVar']['inicio'].
					    '</a>
					</li>';
					} 
					// productos galeria de productos
					
					if($jsonY['tienda']['navVar']['seccion1']!= ""){
					echo	
					'<li class="nav-item dropdown">
					    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">'
					    .$jsonY['tienda']['navVar']['seccion1'].
					    '</a>'.
					    '<div class="dropdown-menu">'; 
					   
					/////  LISTA DE GALERIAS DISPONIBLES /////////       
					for ($i=1; $i <= count($arrayGalerias); $i++ ){ // imprime las galerias que son necesarias
						echo '<a class="dropdown-item" href="seccion1.php?galeria='.$i.'">'.$arrayGalerias[$i-1][0].'</a>';
					}
					echo '</div>'.
					'</li>';
					}
					
					// servicios			    
					if($jsonY['tienda']['navVar']['seccion2']!= ""){
					echo	
					'<li class="nav-item dropdown">
					    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="seccion2.php">'
					    .$jsonY['tienda']['navVar']['seccion2'].
					    '</a>'.
					    '<div class="dropdown-menu">'.
					       '<a class="dropdown-item" href="seccion2.php?servicioA=1" >Gratis</a>'.
					       '<a class="dropdown-item" href="seccion2.php?servicioA=2" >Basico</a>'.
					       '<a class="dropdown-item" href="seccion2.php?servicioA=3" >Pro</a>'.
					    '</div>'.
					'</li>';
					}	
				    // equipo			
				    if($jsonY['tienda']['navVar']['seccion3']!= ""){
					echo	
					'<li class="nav-item dropdown">
					    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="seccion3.php">'
					    .$jsonY['tienda']['navVar']['seccion3'].
					    '</a>'.
					    '<div class="dropdown-menu">'.
					       '<a class="dropdown-item" href="seccion3.php?equipo=1" >Nosotros</a>'.
					       '<a class="dropdown-item" href="seccion3.php?equipo=2" >Nuestros Clientes</a>'.
					       '<a class="nav-link"      href="seccion3.php?equipo=3" ><i class="fas fa-envelope" style="font-size:26px;margin-left: 10%"></i></a>'.
					    '</div>'.
					'</li>';
					}	
				    if($jsonY['tienda']['navVar']['seccion4']!= ""){
					echo	
					'<li class="nav-item ">
					    <a class="nav-link" href="seccion4.php">'
					    .$jsonY['tienda']['navVar']['seccion4'].
					    '</a>
					</li>';
					} 
				    if($jsonY['tienda']['navVar']['seccion5']!= ""){
					echo	
					'<li class="nav-item ">
					    <a class="nav-link" href="seccion5.php">'
					    .$jsonY['tienda']['navVar']['seccion5'].
					    '</a>
					</li>';
					} 
				    if($jsonY['tienda']['navVar']['seccion6']!= ""){
					echo	
					'<li class="nav-item ">
					    <a class="nav-link" href="seccion6.php">'
					    .$jsonY['tienda']['navVar']['seccion6'].
					    '</a>
					</li>';
					} 
				    if($jsonY['tienda']['navVar']['seccion7']!= ""){
					echo	
					'<li class="nav-item ">
					    <a class="nav-link" href="seccion7.php">'
					    .$jsonY['tienda']['navVar']['seccion7'].
					    '</a>
					</li>';
					} 
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
        <div class="carousel-item active">
        <img id="fondo1" src="<?php echo $jsonY['tienda']['carrousel']['fondo1']; // Fondo 1 ?>" class="d-none d-sm d-sm-block w-100" alt="...">
        <img class="d-block d-sm-none  w-100"   src="<?php echo $jsonY['tienda']['carrousel']['fondoA']; // Fondo 2 ?>">

     
           <div class="carousel-caption">
	      	   <h1 class="display-2"><?php echo $jsonY['tienda']['carrousel']['titulo']; ?></h1>
	      	   <h3><?php echo $jsonY['tienda']['carrousel']['subt']; ?></h3>
	      	   
	      	   <?php if($jsonY['tienda']['carrousel']['bot1']!= ""){  // boton 1
	      	            echo ' <button type="button" class="btn btn-secondary btn-lg">'.
	      	                   $jsonY["tienda"]["carrousel"]["bot1"].'</button>';
	      	          }
	      	         if($jsonY['tienda']['carrousel']['bot2']!= ""){  // boton 2
	      	            echo '<button type="button" class="btn btn-primary btn-lg">'.$jsonY['tienda']['carrousel']['bot2'].'</button>';
	      	         } 
	      	   ?>
	      	   
           </div>
        </div>
        <div class="carousel-item">
            <img  id="fondo2" src="<?php echo $jsonY['tienda']['carrousel']['fondo2']; // Fondo 2 ?>" class="d-none d-sm d-sm-block w-100" alt="...">
            <img class="d-block d-sm-none  w-100"   src="<?php echo $jsonY['tienda']['carrousel']['fondoB']; // Fondo 2 ?>">

        </div>
        <div class="carousel-item">
            <img id="fondo3"  src="<?php echo $jsonY['tienda']['carrousel']['fondo3']; // Fondo 3 ?>" class="d-none d-sm d-sm-block w-100" alt="...">
            <img class="d-block d-sm-none  w-100"   src="<?php echo $jsonY['tienda']['carrousel']['fondoC']; // Fondo 2 ?>">
        </div>
    </div>
    
    
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
        
        <i class="fas fa-arrow-circle-right" style="width: 68px; height: 68px;color: #808080;"></i>
        <span class="sr-only">Next</span>
    </a>
  
</div>


<!---------- BARRA DE COMENTARIOS O PROMOCIONES ////    JUMBOTRON ----->
	<div class="jumbotron jumbotron-fluid fSubtitulo">
	    <div class="container">
	        <h2 class="display-4"><?php echo $jsonY['tienda']['jumbotron']['jumboA']; ?></h2>
	        <p class="lead">      <?php echo $jsonY['tienda']['jumbotron']['jumboB']; ?></p>
	    </div>
	</div>
	
	
	
<!------- BIENVENIDA ///// ------>
	<div class="container-fluid padding ">
		<div class="row welcome text-center">
			<div class="col-12 fTitulo">
				
				<?php   if($jsonY['tienda']['presentacion']['bienvenida'] != ""){
				            echo '<h1 class="display-4">'.$jsonY['tienda']['presentacion']['bienvenida'].'</h1>';
				        }
				?>	
			</div>
			<hr>
			<div class="col-12 fSubtitulo">
				<?php   if($jsonY['tienda']['presentacion']['texto'] != ""){
				            echo '<p class="lead">'.$jsonY['tienda']['presentacion']['texto'].'</p>';
				        }    
				?>            
				
			</div>
		</div>
	</div>
	

<!------- 3 IMAGENES QUE COLAPSAN EN 1 EN PANTALLAS DE CEL ------>
	
	<div class="container-fluid padding">
		<div class="row text-center padding">
			
			<div class="col-xs-12 col-sm-6 col-md-4">
				<i class="fab fa-accusoft fa-4x" style="color: red"></i>
				<br><br>
				<h3 class="fSubtitulo">HTML5</h3>
				<p  class="fParrafo">DISEÑO RESPONSIVO</p>
			 	
			</div>
			
			<div class="col-xs-12 col-sm-6 col-md-4">
				<i class="far fa-credit-card fa-4x" style="color: purple"></i>
				<br><br>
				<h3 class="fSubtitulo">PASARELA DE PAGOS</h3>
				<p  class="fParrafo">VENTA EN LINEA</p>
			 	
			</div>
			
			<div class="col-sm-12 col-md-4">
				<i class="fas fa-mobile-alt fa-4x" style="color: green"></i>
				<br><br>
				<h3 class="fSubtitulo">APP MOVIL</h3>
				<p  class="fParrafo">TU PROPIA TIENDA</p>
			 	
			</div>
		</div>
		
	</div>
	    
<!------------->

<div class="card-deck">
	
  <div class="card">
    <img src="img/digiPopA.svg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title fSubtitulo">Card title</h5>
      <p class="card-text   fParrafo">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text   fParrafo"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img src="img/digiPopB.svg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title fSubtitulo">Card title</h5>
      <p class="card-text   fParrafo">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text   fParrafo"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img src="img/digiPopC.svg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title fSubtitulo">Card title</h5>
      <p class="card-text   fParrafo">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  
</div>






<!---- footer ------------->
  <footer class="pt-4 my-md-5 pt-md-5 border-top cPie fPie">
    <div class="row">
      <div class="col-12 col-md" style="padding-left: 30px">
        <img class="mb-2" src="img/digiPop.png" alt="" >
        <small class="d-block mb-3 text-muted">© 2020</small>
      </div>
      <div class="col-4 col-md ">
        <h5>Nosotros</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Rodrigo</a></li>
          <li><a class="text-muted" href="#">Diego</a></li>
          <li><a class="text-muted" href="#">digiPop</a></li>
          
        </ul>
      </div>
      <div class="col-4 col-md ">
        <h5>Email</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">roo@hhh.com</a></li>
          <li><a class="text-muted" href="#">diego@hhh.com</a></li>
          <li><a class="text-muted" href="#">consultas@hhh.com</a></li>
        </ul>
      </div>
    </div>
  </footer>
  

    
    </body>
</html>
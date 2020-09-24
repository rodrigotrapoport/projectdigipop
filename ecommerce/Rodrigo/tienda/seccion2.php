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

<body>

<!---------- nav var ---------->

<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid pie" id="d1">
		<a class="navbar-brand" href="#">
			<img src="<?php echo $jsonY['tienda']['navVar']['logo']; ?>" width="170px" height="55px" >
		</a>
		<button class="navbar-toggler"	type="button" data-toggle="collapse" data-target="#navbarResponsive">
		    <span class="navbar-toggler-icon  "></span> <!-- <i class="material-icons" style="font-size:30px">menu</i></span> -->
		</button>
		
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				
				<?php 
					if($jsonY['tienda']['navVar']['inicio']!= ""){
					echo	
					'<li class="nav-item ">
					    <a class="nav-link" href="index.php">'
					    .$jsonY['tienda']['navVar']['inicio'].
					    '</a>
					</li>';
					} 
					
					// productos  /////  LISTA DE GALERIAS DISPONIBLES ///////// 
					if($jsonY['tienda']['navVar']['seccion1']!= ""){
					echo	
					'<li class="nav-item dropdown ">
					    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">'
					    .$jsonY['tienda']['navVar']['seccion1'].
					    '</a>'.
					    '<div class="dropdown-menu">'; 
					         
					for ($i=1; $i <= count($arrayGalerias); $i++ ){ // imprime las galerias que son necesarias
						echo '<a class="dropdown-item" href="seccion1.php?galeria='.$i.'">'.$arrayGalerias[$i-1][0].'</a>';
					}
					             
					echo '</div>'.
					'</li>';
					} 
					
					// servicios
				    if($jsonY['tienda']['navVar']['seccion2']!= ""){
					echo	
					'<li class="nav-item dropdown active">
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

<!------ Fondo fijo con scroll ------>

	<figure class="container-fluid" style="height: 80%" >
	    <div class="fixed-wrap" style="width: 100%;"> 
		    <div class="carousel-caption"  >
	      	   <h1 class="display-2">digiPop</h1>
	      	   <h3>SERVICIOS WEB</h3>
		    </div>
		    <div id="fixed1" class="d-block d-sm-none  w-100"     style="background-image: url(img/digiPopServiciosV.svg);">			   
		    </div>
		    <div id="fixed2" class="d-none d-sm d-sm-block w-100" style="background-image: url(img/digiPopServiciosH.svg);">			   
		    </div>
	    </div>
	</figure>

<!--------------------------------->

<!---------- BARRA DE COMENTARIOS O PROMOCIONES ////    JUMBOTRON ----->
	<div class="jumbotron-fluid justify-content-center d-flex">
	    <div class="col-md-10 ">
	        <h2 class="display-4 pie">
		        <?php 
			        // echo $jsonY['tienda']['jumbotron']['jumboA']; 
			        //echo 'SERVICIO GRATUITO';
			        if(isset($_GET['servicioA']) AND $_GET['servicioA']==1) {
				        echo 'SERVICIO GRATUITO';
				    } else {
					    echo '';
					}
					if(isset($_GET['servicioA']) AND $_GET['servicioA']==2) {
				        echo 'SERVICIO BASICO';
				    } else {
					    echo '';
					}
					if(isset($_GET['servicioA']) AND $_GET['servicioA']==3) {
				        echo 'SERVICIO PRO';
				    } else {
					    echo '';
					}
			    ?>
		    </h2>
	        <p class="lead pie">      
		        <?php 
			        // echo $jsonY['tienda']['jumbotron']['jumboB']; 
			        //echo 'Disponemos este servicio para cleintes que realizan un trabajo poco intensivo.';
			        if(isset($_GET['servicioA']) AND $_GET['servicioA']==1) {
				        echo 'Disponemos este servicio para cleintes que realizan un trabajo poco intensivo';
				    } else {
					    echo '';
					}
					if(isset($_GET['servicioA']) AND $_GET['servicioA']==2) {
				        echo 'Texto correspondiente al servicio basico';
				    } else {
					    echo '';
					}
					if(isset($_GET['servicioA']) AND $_GET['servicioA']==3) {
				        echo 'Texto correspondiente al servicio Pro mas costoso y refinado';
				    } else {
					    echo '';
					}

			    ?>
		    </p>
	    </div>
	</div>
	

<!------------- seccion de servicios detalle 1-------->

<div class="container-fluid" style="background-color: #1C1C1C;">
	<br>
    <div class="row featurette   justify-content-center padding w-80" id="A">
      <div class="col-md-6 pie text-white">
        <h2 class="featurette-heading" style="vertical-align: middle;margin-top: 3rem;">
	        <span class="text-white" >
	            
	            <?php 
		            if(isset($_GET['servicioA']) AND $_GET['servicioA']==1) {
				        echo 'Servicios Gratuitos.';
				    } else {
					    echo '';
					}
					if(isset($_GET['servicioA']) AND $_GET['servicioA']==2) {
				        echo 'Servicios Basicos.';
				    } else {
					    echo '';
					}
					if(isset($_GET['servicioA']) AND $_GET['servicioA']==3) {
				        echo 'Servicios Pro.';
				    } else {
					    echo '';
					}
				?>
	        </span>
	    </h2>
        <p class="lead">
	        <?php
		        if(isset($_GET['servicioA']) AND $_GET['servicioA']==1) {
			        echo 'Servicios Gratuitos donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.';
			    } else {
				    echo '';
				}
				if(isset($_GET['servicioA']) AND $_GET['servicioA']==2) {
			        echo 'Servicios Basicos donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.';
			    } else {
				    echo '';
				}
				if(isset($_GET['servicioA']) AND $_GET['servicioA']==3) {
			        echo 'Servicios Pro donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.';
			    } else {
				    echo '';
				}  
		    ?>	        
		</p>         
            <a href="#servA" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Consultar</a>
      </div>
      <div class="col-md-4" 
	        style="background-image:url(
	        <?php 
		        if(isset($_GET['servicioA']) AND $_GET['servicioA']==1) {
			        echo 'img/team1.png';
			    } else {
				    echo '';
				}
				if(isset($_GET['servicioA']) AND $_GET['servicioA']==2) {
			        echo 'img/team2.png';
			    } else {
				    echo '';
				}
			    if(isset($_GET['servicioA']) AND $_GET['servicioA']==3) {
			        echo 'img/team3.png';
			    } else {
				    echo '';
				}
			?>);background-repeat: no-repeat;background-position: center center;background-size: cover">
				
        <svg  class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" 
        xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"  >
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#eee" style="opacity: .0;"></rect>
            <!-- <text x="50%" y="50%" fill="#aaa" dy=".3em"></text> -->
        </svg>
      </div>
    </div>
</div>

<!------------- seccion de servicios detalle 2-------->

<div class="container-fluid w-80" style="background-color: #F5ECCE;">
	<br>
    <div class="row featurette justify-content-center padding" id="B">
        <div class="col-md-6 order-md-2 pie">
	        <h2 class="featurette-heading" style="vertical-align: middle;margin-top: 3rem;">
		        <span class="text-dark">
		        <?php 
		            if(isset($_GET['servicioA']) AND $_GET['servicioA']==1) {
				        echo 'Servicios Gratuitos.';
				    } else {
					    echo '';
					}
					if(isset($_GET['servicioA']) AND $_GET['servicioA']==2) {
				        echo 'Servicios Basicos.';
				    } else {
					    echo '';
					}
					if(isset($_GET['servicioA']) AND $_GET['servicioA']==3) {
				        echo 'Servicios Pro.';
				    } else {
					    echo '';
					}
				?>
				</span>
		    </h2>
        <p class="lead">  
	        <?php
		        if(isset($_GET['servicioA']) AND $_GET['servicioA']==1) {
			        echo 'Servicios Gratuitos donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.';
			    } else {
				    echo '';
				}
				if(isset($_GET['servicioA']) AND $_GET['servicioA']==2) {
			        echo 'Servicios Basicos donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.';
			    } else {
				    echo '';
				}
				if(isset($_GET['servicioA']) AND $_GET['servicioA']==3) {
			        echo 'Servicios Pro donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.';
			    } else {
				    echo '';
				}  
		    ?>	   
        </p>
        <a href="#servB" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Consultar</a>
        </div>
        <div class="col-md-3 order-md-1"  style="background-image:url(
	     	<?php 
		        if(isset($_GET['servicioA']) AND $_GET['servicioA']==1) {
			        echo 'img/team3.png';
			    } else {
				    echo '';
				}
				if(isset($_GET['servicioA']) AND $_GET['servicioA']==2) {
			        echo 'img/team1.png';
			    } else {
				    echo '';
				}
			    if(isset($_GET['servicioA']) AND $_GET['servicioA']==3) {
			        echo 'img/team2.png';
			    } else {
				    echo '';
				}
			?>);background-repeat: no-repeat;background-position: center center;background-size: cover">
				
	        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="300px" height="300px" 
	        xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500">
		        <title>Placeholder</title>
		        <rect width="100%" height="100%" fill="#eee" style="opacity: .0;"></rect>
		        <!-- <text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text> -->
            </svg>
      </div>
    </div>
</div> 


<!------------------ fotos servicios  detalle 3 ---------->
<div class="container" style="margin-bottom: 3%;">
	<br>
	
	<div class=" row media position-relative pie">
	  <img src="	  
	  <?php 
	        if(isset($_GET['servicioA']) AND $_GET['servicioA']==1) {
		        echo 'img/digiPopA.svg';
		    } else {
			    echo '';
			}
			if(isset($_GET['servicioA']) AND $_GET['servicioA']==2) {
		        echo 'img/digiPopB.svg';
		    } else {
			    echo '';
			}
		    if(isset($_GET['servicioA']) AND $_GET['servicioA']==3) {
		        echo 'img/digiPopC.svg';
		    } else {
			    echo '';
			}
		?>" 

	  class="mr-3 col-md-4 col-12" alt="..." >
	  
	  
	  
	  <div class="media-body col-md-7 col-12">
	    <h2 class="mt-0"> 
		    <?php 
	            if(isset($_GET['servicioA']) AND $_GET['servicioA']==1) {
			        echo 'Servicios Gratuitos media with stretched link.';
			    } else {
				    echo '';
				}
				if(isset($_GET['servicioA']) AND $_GET['servicioA']==2) {
			        echo 'Servicios Basicos media with stretched link.';
			    } else {
				    echo '';
				}
				if(isset($_GET['servicioA']) AND $_GET['servicioA']==3) {
			        echo 'Servicios Pro media with stretched link.';
			    } else {
				    echo '';
				}
			?>  
	    </h2>
	    
	    <p class="lead">
		    <?php
		        if(isset($_GET['servicioA']) AND $_GET['servicioA']==1) {
			        echo 'Servicios Gratuitos donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.';
			    } else {
				    echo '';
				}
				if(isset($_GET['servicioA']) AND $_GET['servicioA']==2) {
			        echo 'Servicios Basicos donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.';
			    } else {
				    echo '';
				}
				if(isset($_GET['servicioA']) AND $_GET['servicioA']==3) {
			        echo 'Servicios Pro donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.';
			    } else {
				    echo '';
				}  
		    ?> 
	    </p>
	    <p class="lead">
		    
		    <?php
		        if(isset($_GET['servicioA']) AND $_GET['servicioA']==1) {
			        echo 'Servicios Gratuitos donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna.';
			    } else {
				    echo '';
				}
				if(isset($_GET['servicioA']) AND $_GET['servicioA']==2) {
			        echo 'Servicios Basicos donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna.';
			    } else {
				    echo '';
				}
				if(isset($_GET['servicioA']) AND $_GET['servicioA']==3) {
			        echo 'Servicios Pro donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna.';
			    } else {
				    echo '';
				}  
		    ?>
		    
	    </p>
	    <a href="#" class="stretched-link">Go somewhere</a>
	  </div>
	</div> 
	
</div>



<!---------- BARRA DE COMENTARIOS O PROMOCIONES ////    JUMBOTRON ----->
	<div class="jumbotron jumbotron-fluid">
	    <div class="container">
	        <h4 class="display-4 pie"><?php //echo $jsonY['tienda']['jumbotron']['jumboA']; ?>
	           ADQUIERE ESTE Y OTROS SERVICIOS MAS QUE ESTAN DISPONIBLES
	        </h4>
	        <p class="lead pie">      <?php //echo $jsonY['tienda']['jumbotron']['jumboB']; ?>
	           Disponemos de los mejores paquetes de soluciones para tus emprendimientos
	        </p>
	    </div>
	</div>
	

<!------------- card servicios ---------->
<div class="container-fluid padding " style="margin-top: 30px;">
  <!-- <div class="card-deck mb-3 text-center"> -->
  <div class="row text-center padding pie">
	  
    <div class="card mb-4 shadow-sm col-12 col-sm-6 col-md-4" id="servA">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Gratis</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$0 <small class="text-muted">/ mes</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>10 users included</li>
          <li>2 GB of storage</li>
          <li>Email support</li>
          <li>Help center access</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Servicio Gratuito</button>
      </div>
    </div>
    
    <div class="card mb-4 shadow-sm col-12 col-sm-6 col-md-4" id="servB">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Basico</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$15 <small class="text-muted">/ mes</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>20 users included</li>
          <li>10 GB of storage</li>
          <li>Priority email support</li>
          <li>Help center access</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-primary">Servicio Basico</button>
      </div>
    </div>
    
    <div class="card mb-4 shadow-sm  col-sm-12 col-md-4" id="servC">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Pro</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">$29 <small class="text-muted">/ mes</small></h1>
        <ul class="list-unstyled mt-3 mb-4">
          <li>30 users included</li>
          <li>15 GB of storage</li>
          <li>Phone and email support</li>
          <li>Help center access</li>
        </ul>
        <button type="button" class="btn btn-lg btn-block btn-primary">Servicio Pro</button>
      </div>
    </div>
    
  </div>
</div>

<!---- footer ------------->
  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md" style="padding-left: 30px">
        <img class="mb-2" src="img/digiPop.png" alt="" >
        <small class="d-block mb-3 text-muted">© 2020</small>
      </div>
      <div class="col-4 col-md pie">
        <h5>Nosotros</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted " href="#">Rodrigo</a></li>
          <li><a class="text-muted " href="#">Diego</a></li>
          <li><a class="text-muted " href="#">digiPop</a></li>
          
        </ul>
      </div>
      <div class="col-4 col-md pie">
        <h5>Email</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted " href="#">roo@hhh.com</a></li>
          <li><a class="text-muted " href="#">diego@hhh.com</a></li>
          <li><a class="text-muted " href="#">consultas@hhh.com</a></li>
        </ul>
      </div>
    </div>
  </footer>
  
</body>
</html>
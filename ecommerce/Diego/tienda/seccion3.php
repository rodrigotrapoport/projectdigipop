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
					'<li class="nav-item dropdown">
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
					'<li class="nav-item dropdown active">
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

	<figure class="container-fluid" style="height: 80%;" >
	    <div class="fixed-wrap" style="width: 100%;"> 
		    <div class="carousel-caption"  >
	      	   <h1 class="display-2">EQUIPO</h1>
	      	   <h3>EQUIPO DIGIPOP</h3>
		    </div>
		    <div id="fixed1" class="d-block d-sm-none  w-100" style="background-image: url(img/digiPopG.svg);">			   
		    </div>
		    <div id="fixed2" class="d-none d-sm d-sm-block w-100" style="background-image: url(img/digiPopH.svg);">			   
		    </div>
	    </div>
	</figure>

<!--------------------------------->

<!---------  emprendedores -------->
<br>
<div class="container marketing" 
   <?php if(isset($_GET['equipo']) AND $_GET['equipo']==1) {
	        echo '';
	    } else {
		  echo 'style="display:none"';
		} 
	?> 
>

    <!-- Three columns of text below the carousel -->
    <div class="row pie ">
	    
      <div class="col-lg-4 text-center">
	    <img src="img/team1.png" class="rounded-circle" alt="Cinque Terre" width="140" height="140">
        <h2>Heading</h2>
        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        <p>
	        <a class="btn btn-secondary" href="#" role="button">View details »</a>
	    </p>
      </div><!-- /.col-lg-4 -->
      
      <div class="col-lg-4 text-center">
	    <img src="img/team2.png" class="rounded-circle" alt="Cinque Terre" width="140" height="140">
        <h2>Heading</h2>
        <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
        <p>
	        <a class="btn btn-secondary" href="#" role="button">View details »</a>
	    </p>
      </div><!-- /.col-lg-4 -->
      
      <div class="col-lg-4 text-center">
	    <img src="img/team3.png" class="rounded-circle" alt="Cinque Terre" width="140" height="140">
        <h2>Heading</h2>
        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
        <p>
	        <a class="btn btn-secondary" href="#" role="button">View details »</a>
	    </p>
      </div><!-- /.col-lg-4 -->
      
    </div><!-- /.row -->
    <hr class="container w-80">

    
</div>  


<!------------- presentacion del trabajo que uno realiza -------->


<div class="container"	
<?php if(isset($_GET['equipo']) AND $_GET['equipo']==1) {
        echo '';
    } else {
	  echo 'style="display:none"';
	} 
?> 
>
    <div class="row featurette   justify-content-center padding">
      <div class="col-md-7 pie">
        <h2 class="featurette-heading" style="vertical-align: middle;margin-top: 3rem;">First featurette heading. 
	        <span class="text-muted">It’ll blow your mind.</span>
	    </h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5" style="background-image:url(img/team1.png);background-repeat: no-repeat;background-position: center center;background-size: cover">
        <svg  class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500"  >
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#eee" style="opacity: .0;"></rect>
        </svg>
      </div>
    </div>
    <hr class="container w-80">

</div>


<div class="container"
	
<?php if(isset($_GET['equipo']) AND $_GET['equipo']==1) {
        echo '';
    } else {
	  echo 'style="display:none"';
	} 
?>
	
>
    <div class="row featurette justify-content-center padding">
      <div class="col-md-7 order-md-2 pie">
        <h2 class="featurette-heading" style="vertical-align: middle;margin-top: 3rem;">Oh yeah, it’s that good. <span class="text-muted">See for yourself.</span></h2>
        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
      </div>
      <div class="col-md-5 order-md-1"  style="background-image:url(img/team2.png);background-repeat: no-repeat;background-position: center center;background-size: cover">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 500x500">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#eee" style="opacity: .0;"></rect>
        <!-- <text x="50%" y="50%" fill="#aaa" dy=".3em">500x500</text> -->
        </svg>
      </div>
    </div>
    <hr class="container w-80">
</div> 

<!-- *******************************************************************-->


<!----------- nuestros clientes ---->
<div class="container">
	<br>
<div class="card-deck" 
	
<?php if(isset($_GET['equipo']) AND $_GET['equipo']==2) {
        echo '';
    } else {
	  echo 'style="display:none"';
	} 
?>
	
	
>
	
  <div class="card">
    <img src="img/digiPopA.svg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Testimonio Uno</h5>
      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    <img src="img/digiPopB.svg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Testimonio Dos</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card" >
    <img src="img/digiPopC.svg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Testimonio Tres</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  
</div>
</div>

<!----------- testimonio ----->
<br><br>
<div class="container"
	
<?php if(isset($_GET['equipo']) AND $_GET['equipo']==2) {
        echo '';
    } else {
	  echo 'style="display:none;"';
	} 
?>
		
	
>
	<div class="row media position-relative pie">
		
	  <img src="img/digiPopA.svg" class="mr-3 col-md-3 col-12" alt="..." >
	  
	  <div class="media-body col-md-9 col-12">
	    <h5 class="mt-0">Resumen de nuestra filosofia de trabajo</h5>
	    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
	    <a href="#" class="stretched-link">Go somewhere</a>
	  </div>
	  
	</div> 
</div>



<!-- ****************  contactenos  ***************************************************-->

<div class="container"

<?php if(isset($_GET['equipo']) AND $_GET['equipo']==3) {
        echo '';
    } else {
	  echo 'style="display:none;"';
	} 
?>
		
>
	<div class="row media position-relative pie">
		
	  <img src="img/digiPopA.svg" class="mr-3 col-md-3 col-12" alt="..." >
	  
	  <div class="media-body col-md-9 col-12">
	    <h2 class="mt-0 fuenteTi ">CONTACTENOS</h2>
	    <p><h4 class=" ">Diego diegographics2@gmai.com</h4></p>
	    <p><h4>Rodrigo rodrigo@gmai.com</h4></p>
	    <p><h4>Digipop digipop.latan@gmai.com</h4></p>
	    <p><h4>Digipop hola@digipop.tech</h4></p>
	    <a href="index.php" class="stretched-link btn btn-primary">Inicio</a>
	  </div>
	  
	</div> 
</div>





<!-- *******************************************************************-->




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
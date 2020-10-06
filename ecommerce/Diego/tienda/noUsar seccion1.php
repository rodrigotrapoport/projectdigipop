<?php
ob_start();// permite corregir error en header o salto a otra pagina
session_start();

require "secciones/json.php";
require "secciones/jsonProductos1.php";
require "key.php";
//var_dump($jsonX);
$jsonY = json_decode($jsonX, true);        // true regresa un array
$jsonP = json_decode($jsonProductos,true);
//echo '<br>';
//print_r($jsonY);
//echo '<br>';
//echo $jsonY['tienda']['navVar']['logo'];

/////////// SIN SELECCION DE CATEGORIA /////
if(isset($_GET['galeria'])) { 
	$indexGaleria = $_GET['galeria'];
} else {
	$indexGaleria = 1;
}

///////// GALERIAS Y TITULO CAROUSEL /////
$jsonGalerias  = json_decode( $tituloGalerias, true );
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
/////// FOTOS CAROUSEL /////
$arrayFotos = array();
for($i = 0; $i < count($jsonGalerias['fotos']); $i++){
	$key = key($jsonGalerias['fotos']);  // selecciona la clave de las fotos del carousel
	$keyFotosX = $jsonGalerias['fotos'][$key];
    $registroArrayFotos = array($keyFotosX);
    array_push($arrayFotos, $registroArrayFotos); // registro que guarda las fotos del carousel
    //echo $jsonGalerias['fotos'][$key].'<br>';
    next($jsonGalerias['fotos']);
}

/*
for($i=0; $i < count($arrayGalerias); $i++ ){
	echo $arrayGalerias[$i].'<br>';
}
*/

/*
for($i=0; $i < count($arrayFotos); $i++ ){
	echo $arrayFotos[$i][0].'<br>';
}
*/

//var_dump($arrayFotos);
	
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

<body>

<!---------- nav var ---------->	
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid pie" id="d1">
		<a class="navbar-brand" href="#">
			<img src="<?php echo $jsonY['tienda']['navVar']['logo']; ?>" width="170px" height="55px">
		</a>
		<button class="navbar-toggler"	type="button" data-toggle="collapse" data-target="#navbarResponsive">
		    <span class="navbar-toggler-icon  "></span> <!-- <i class="material-icons" style="font-size:30px">menu</i></span> -->
		</button>
		
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				
				<?php
					// index 
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
					'<li class="nav-item dropdown active">
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
					    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">'
					    .$jsonY['tienda']['navVar']['seccion2'].
					    '</a>'.
					    '<div class="dropdown-menu">'.
					       '<a class="dropdown-item" href="seccion2.php?servicioA=1" >Gratis</a>'.
					       '<a class="dropdown-item" href="seccion2.php?servicioA=2" >Basico</a>'.
					       '<a class="dropdown-item" href="seccion2.php?servicioA=3" >Pro</a>'   .
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
					// checkout 
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
<!------------------------------------------->


<!---------- IMAGENES SLIDE /// CAROUSEL -------->
<div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel" >
    <ol class="carousel-indicators">
	    <?php
	        for($i=0; $i < count($arrayGalerias); $i++){ // botones inferiores del slide
		        echo  '<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';
	        }        
	    ?>
    </ol>
    
    
    
    
    
    <div class="carousel-inner" >
	      
	    <?php 
		    
		for ($iM=0 ; $iM < count($arrayGalerias) ; $iM++ ){   // for CON EL TOTAL DE GALERIAS DISPONIBLES
		    
		    echo '<div class="carousel-item '; // div #1
		    
		    if(  $indexGaleria == ($iM+1) ) { 
			   echo 'active ">';
			}  else {
			   echo ' ">';
			};

			//******************************

            echo '<img id="fondo1" src="'.$arrayFotos[($iM)][0][0].'" class="d-none d-sm d-sm-block w-100" alt="...">'; // PC Horizontal  $arrayFotos[$i][0]
			
			echo '<img class="d-block d-sm-none  w-100"   src="'.$arrayFotos[($iM)][0][1].'">';  // Cel Vertical
		    
		    echo '<div class="carousel-caption">'; // div #2
		    
		    echo '<h1 class="display-2">'.$arrayGalerias[$iM][0].'</h1>'; // selecciona el titulo del arrayGalerias
		    
		    echo '</div>'; // div #2 
		    
		    echo '</div>'; // div #1 
		    
		}   
		?>
		
    </div>
	
	
    
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span> -->
        
        <i class="fas fa-arrow-circle-right" style="width: 68px; height: 68px;color: #808080;"></i>
        <span class="sr-only">Next</span>
    </a>
  
</div>


<!------------ productos ----------->


<!---------- array en php -------->

<?php 
	/*
	echo count($jsonY['tienda']).' objetos del array<br>';  
	  
    $max = sizeof($jsonY['tienda']);
	
    echo '<br>*******************<br>';
    
	for($i = 0; $i < count($jsonY['tienda']); $i++){
	    $k[$i] = key($jsonY['tienda']);
	    echo($k[$i]).'<br>';
	    next($jsonY['tienda']);
	}
	*/
	/*
	echo '<br>****************  Productos ***<br>';
	
	echo count($jsonP['productos']).' objetos del array<br>';   // registros del array
	
	for($i = 0; $i < count($jsonP['productos']); $i++){ // ingresa al segundo nivel / el for es por los 3 articulos que contiene
		
	    $k = key($jsonP['productos']); // key nivel 2
	    
	    echo($k).' (segundo nivel)-> ';
	    
	    echo '<br><br>';
	    
	    for ($j = 0; $j < count($jsonP['productos'][$k]); $j++ ) { // ingresa al tercer nivel / el for es por la cantidad de subregistros que contiene el nivel anterior
	        $L = key($jsonP['productos'][$k]); // key nivel 3
	        echo $L.' (tercer nivel)-> ';
	        next($jsonP['productos'][$k]);   // pasa al siguiente registro nivel 3
	        echo '<br>';
             
             
             
            for ($jA = 0; $jA < count($jsonP['productos'][$k][$L]); $jA++ ) { // ingresa al tercer nivel / el for es por la cantidad de subregistros que contiene el nivel anterior
		        $M = key($jsonP['productos'][$k][$L]); // key nivel 3
		        echo $M.' (cuarto nivel)-> ';          // valor del cuarto nivel
		        echo $jsonP['productos'][$k][$L][$M];
		        next($jsonP['productos'][$k][$L]);     // pasa al siguiente registro nivel 3
		        echo '<br>';                
	            
		    }reset($jsonP['productos'][$k][$L]); // resetea el contador del tercer nivel
		     echo '<br>';
               
	    }reset($jsonP['productos'][$k]); // resetea contador del segundo nivel
	    
	    next($jsonP['productos']); // pasa al siguiente registro del array nivel 2
	    echo '<br>';
	}
    reset($jsonP['productos']); // resetea el numero de celda del array ya que la busqueda cambia el valor por defecto	
    
    */
    
    //echo '****************** ranking precios *************<br>';	
    
    $rankingPrecios = array();          // lista para ordenar por precios
    $rankingPreciosArticulos = array(); // lista para saber que productos son en relaciona a los precu¡ios
    
    for($i = 0; $i < count($jsonP['productos']); $i++){ // ingresa al segundo nivel / el for es por los 3 articulos que contiene
	    
	    $k = key($jsonP['productos']); // key nivel 2 que son las galerias...
	    
	    //echo($k).' (segundo nivel)-> ';
	    //echo '<br><br>';
	     
	    for ($j = 0; $j < count($jsonP['productos'][$k]); $j++ ) { // ingresa al tercer nivel / el for es por la cantidad de subregistros que contiene el nivel anterior
	        $L = key($jsonP['productos'][$k]); // key nivel 3 que es la lista de productos de cada galeria
	        //echo $L.' (tercer nivel)-> ';
	        //echo $jsonP['productos'][$k][$L];
	        next($jsonP['productos'][$k]);   // pasa al siguiente registro nivel 3
	        //echo '<br>';     
             
            /*
            for ($jA = 0; $jA < count($jsonP['productos'][$k][$L]); $jA++ ) { // ingresa al tercer nivel / el for es por la cantidad de subregistros que contiene el nivel anterior
		        $M = key($jsonP['productos'][$k][$L]); // key nivel 3
		        echo $M.' (cuarto nivel)-> ';          // valor del cuarto nivel
		        echo $jsonP['productos'][$k][$L][$M];
		        next($jsonP['productos'][$k][$L]);     // pasa al siguiente registro nivel 3
		        echo '<br>';
	                        
	            
		    }
		    reset($jsonP['productos'][$k][$L]); // resetea el contador del tercer nivel
		    */
            // precios minimos
		    $minimoA = $jsonP['productos'][$k][$L]['precioA'];      // 0
		    $minimoB = $jsonP['productos'][$k][$L]['precioB'];
		    // ruta de los articulos
		    $rutaDelArticulo = '$jsonP[productos]['.$k.']['.$L.']'; // 1
		    // otros datos
		    $galeria = $jsonP['productos'][$k][$L]['galeria'];      // 2
		    $codigo  = $jsonP['productos'][$k][$L]['codigo'] ;      // 3
		    $nombre  = $jsonP['productos'][$k][$L]['nombre'] ;      // 4
		    $descrip = $jsonP['productos'][$k][$L]['descrip'];      // 5 
		    $foto1   = $jsonP['productos'][$k][$L]['foto1']  ;      // 6 foto
		    $foto2   = $jsonP['productos'][$k][$L]['foto2']  ;      // 7 foto
		    $foto3   = $jsonP['productos'][$k][$L]['foto3']  ;      // 8 foto
		    $marca   = $jsonP['productos'][$k][$L]['marca']  ;      // 9
		    $tamanos = $jsonP['productos'][$k][$L]['tamaños'];      // 10
		    $colores = $jsonP['productos'][$k][$L]['colores'];      // 11
		    $ofertaA = $jsonP['productos'][$k][$L]['oferta'] ;      // 12
		    $calif   = $jsonP['productos'][$k][$L]['calif']  ;      // 13
		    $unidad  = $jsonP['productos'][$k][$L]['unidad'] ;      // 14
		    $galeriaIndex = key($jsonP['productos'])     ;          // 15 info de que galeria es
		    $precioA = $jsonP['productos'][$k][$L]['precioA'] ;     // 16
		    $precioB = $jsonP['productos'][$k][$L]['precioB'] ;     // 17
		    $condi   = $jsonP['productos'][$k][$L]['condi'] ;       // 18 condiciones del servicio
		    
		    if ($minimoB == ''){ // consulta si hay precio de descuento o no
			    //echo $jsonP['productos'][$k][$L]['precioA'].' precio minimo';
			    $precioMinimo = $jsonP['productos'][$k][$L]['precioA']; // guarda el precio minimo
		    } else {
			    //echo $jsonP['productos'][$k][$L]['precioB'].' precio minimo';
			    $precioMinimo = $jsonP['productos'][$k][$L]['precioB']; // guarda el precio minimo
		    }
		    $registro = array($precioMinimo , $rutaDelArticulo , $galeria , $codigo , $nombre , $descrip , $foto1 , $foto2 , $foto3 , $marca , $tamanos ,
		    $colores , $ofertaA , $calif , $unidad , $galeriaIndex , $precioA , $precioB, $condi );
		    array_push($rankingPrecios, $registro);       // carga el precio minimo en el arrary de precios
		    //array_push($rankingPreciosArticulos, $rutaDelArticulo); // ruta del articulo
		    
		    //echo '<br>';
                  
	    }
	    reset($jsonP['productos'][$k]); // resetea contador del segundo nivel
	       
	    next($jsonP['productos']); // pasa al siguiente registro del array nivel 2
	    //echo '<br>';
	}
    reset($jsonP['productos']); // resetea el numero de celda del array ya que la busqueda cambia el valor por defecto	

    //print_r($rankingPrecios);
    //echo '<br>';
    //print_r($rankingPreciosArticulos);
    //echo '<br>*****************<br><br>';
    sort($rankingPrecios);
    //print_r($rankingPrecios);
    //echo '<br> xxxxxxxxx <br>';
    
    /// ******* control del registro *******
    /*
    for ($i=0; $i < count($rankingPrecios); $i++){
	    if($rankingPrecios[$i][15] == 'galeria'.$indexGaleria){
	        echo $rankingPrecios[$i][0].' -- '.$rankingPrecios[$i][4].' -- '.$rankingPrecios[$i][2].' -- '.$rankingPrecios[$i][13].'<br>';
	    }
    }
    */   	
?>

<div class="row">
	<div class="col-12"><!---- titulo ------>
	
	    <!-- Heading -->
	    
	    	<h2 class="mb-10 text-center"> 
		    	<?php
			    	/* 
			        if(isset($_GET['galeria']) AND $_GET['galeria']==1) { 
				        $categoria = $_GET['galeria'] ;
				    } else {
					    $categoria = '1';
					}
					if(isset($_GET['galeria']) AND $_GET['galeria']==2) { 
				        $categoria = $_GET['galeria'] ;
				    } else {
					    $categoria = '1';
					}
					if(isset($_GET['galeria']) AND $_GET['galeria']==2) { 
				        $categoria = $_GET['galeria'] ;
				    } else {
					    $categoria = '1';
					}
					if(isset($_GET['galeria']) AND $_GET['galeria']==2) { 
				        $categoria = $_GET['galeria'] ;
				    } else {
					    $categoria = '1';
					}
					if(isset($_GET['galeria']) AND $_GET['galeria']==2) { 
				        $categoria = $_GET['galeria'] ;
				    } else {
					    $categoria = '1';
					}
					*/	
					
					switch ($indexGaleria) {  
					    case 1:
					        $categoria = $indexGaleria ; /// CATEGOTIA SELECCIONA LA GALERIA A MOSTRAR
					        break;
					    case 2:
					        $categoria = $indexGaleria ;
					        break;
					    case 3:
					        $categoria = $indexGaleria ;
					        break;
					    case 4:
					        $categoria = $indexGaleria ;
					        break;
                        case 5:
					        $categoria = $indexGaleria ;
					        break;
                        case 6:
					        $categoria = $indexGaleria ;
					        break;
                        case 7:
					        $categoria = $indexGaleria ;
					        break;
					    case 8:
					        $categoria = $indexGaleria ;
					        break;
					    case 9:
					        $categoria = $indexGaleria ;
					        break;
                        case 10:
					        $categoria = $indexGaleria ;
					        break;
                        case 11:
					        $categoria = $indexGaleria ;
					        break;
                        case 12:
					        $categoria = $indexGaleria ;
					        break;
					    case 13:
					        $categoria = $indexGaleria ;
					        break;
					    case 14:
					        $categoria = $indexGaleria ;
					        break;
                        case 15:
					        $categoria = $indexGaleria ;
					        break;
                        case 16:
					        $categoria = $indexGaleria ;
					        break;
					}
					
					
		    	    echo ' '.$jsonP['productos']['galeria'.$categoria]['producto1']['galeria'];   // TITULO DE LA CATEGORIA
		    	?>
		    	
		    </h2>
	
	</div>
</div>

	        
<div class="row justify-content-center padding "> <!--- marco de todos los productos --->
	
    <?php 
	 
	// echo count($jsonP['productos']['galeria'.$categoria]); // cantidad de productos registrados en dicha categoria
	/*   
	for($i = 0; $i < count($jsonP['productos']['galeria'.$categoria]); $i++){ ////  FOR DE LA CANTIDAD DE ELEMENTOS DE LA GALERIA SELECCIONADA
		
		$k = key($jsonP['productos']['galeria'.$categoria]); // key nivel 3
	    
	    // echo($k).' (segundo nivel)-> '; // categorias por productos
	
	    // Oferta
	    $dato1 = $jsonP['productos']['galeria'.$categoria][$k]['oferta']; // seleccion correcta de los datos de cada articulo
	
	    //echo $dato1.' oferta ';
		
		if ($dato1 == 'si') {
			$oferta =   '<div class="badge badge-dark card-badge card-badge-left text-uppercase">OFERTA</div>';
		} else { 
			$oferta = '';	
		}  
	*/
	
	for ($i=0; $i < count($rankingPrecios); $i++){ // la cantidad de objetos es la de cada categoria y de productos
		
	    if($rankingPrecios[$i][15] == 'galeria'.$indexGaleria ){ // compara el numero que llega por get con la galeria correspondiente
	        
	        // IF DE OFERTA	
	        if( $rankingPrecios[$i][12] == 'si' ){ // consulta si hay oferta y agrega el comentario
		       $oferta =   '<div class="badge badge-dark card-badge card-badge-left text-uppercase">OFERTA</div>'; 
	        } else {
		        $oferta = '';
	        }
	        
	        // IF DE PRECIOS 
	        if( $rankingPrecios[$i][17] != ''){
		        // precio con descuento
		        $preA = '<span class="font-size-xs text-gray-350 text-decoration-line-through"><p class="text-secondary"><s>
				            '.$rankingPrecios[$i][16].'
				        </s></p></span>
	                    <p>
	                        <h2><span class="text-primary">'.$rankingPrecios[$i][17].'</span></h2>
	                    </p>';  
	            
	            
	            /// fuentes para modal        
	            $h1A = '<h5><s>';  // con descuento el primer precio se ve pequeño
	            $h1B = '</s></h5>'; 
	            
	            $h2A = '<h1>';  // el segundo precio se ve grande
	            $h2B = '</h1>';		
	            
	            $colorA = '#566573'; // gris oscuro
	            $colorB = '#1E61F6'; // azul      
	        } else {
		        // precio sin descuento
		        $preA = '<h2><span class="font-size-xs text-primary text-decoration-line-through">
				            '.$rankingPrecios[$i][16].'
				        </span></h2>';
				
				// fuentes para modal        
				$h1A = '<h1>';  // sin descuento el primer precio se ve grande
	            $h1B = '</h1>';
	            
	            $h2A = '<h6>';  // el segundo no se ve
	            $h2B = '</h6>';	
	            
	            $colorA = '#1E61F6'; // azul
	            $colorB = '#FFFFFF'; // blanco
	        }
	        
	        
	        // FOR CLASIFICACION
	        
	        $califMas = '';
	        for ($iN=0; $iN < $rankingPrecios[$i][13];$iN++ ){
		        $califMas = $califMas.'<div class="rating-item"><i class="material-icons" style="color: #373737">star</i></div>'; // con estrella
	        }
	        
	        for ($iN=0; $iN < (5-$rankingPrecios[$i][13]);$iN++ ){
		        $califMas = $califMas.'<div class="rating-item"><i class="material-icons" style="color: #373737">star_border</i></div>'; // sin estrella
	        }
	        
	        // FOR DE LAS DIFERENTES TALLAS DE CADA PRODUCTO SELECCIONADO ////////
	        $difTallas  = explode('-', $rankingPrecios[$i][10]); // parte la lista de tamaños en un array
	        $tallaArray = '';
	        
	        for ($iP=0; $iP < count($difTallas); $iP++ ){
		        $tallaArray = $tallaArray.'<option value="'.$difTallas[$iP].'">'.$difTallas[$iP].'</option>';
	        }
	        
	        //echo 'diferentes tallas '.$rankingPrecios[$i][10];
	        
	        //print_r($difTallas);
	        //echo $tallaArray;
	        
	        
	    
		    /////////////////////////////////////////////////////////////
		    
		    // hash de validacion
		    $hash = hash('sha256', $secret.$rankingPrecios[$i][4].$rankingPrecios[$i][9].$rankingPrecios[$i][16].$rankingPrecios[$i][17]);
		                                     // titulo               marca                  precioA                precioB

		    		    
		    
			echo '
			<div class="col-6 col-md-3 col-lg-2"> <!----- producto x---->
			
			            <!-- Card -->
			        <div class="card mb-7" data-toggle="card-collapse">
			              
			              <!-- Badge -->
			              
			                '.$oferta.'
			                                      
			              <!-- Image -->
			            <a href="#" data-toggle="modal" data-target="#Producto" id="prod'.$i.'">
			                <img src="'.$rankingPrecios[$i][6].'" class="card-img-top">
			            </a>
			
			              <!-- Collapse -->
			            <div class="card-collapse-parent">
			
			                <!-- Body -->
			                <div class="card-body px-0 bg-white text-center">
			
			                  <!-- Heading -->
			                    <div class="mb-1 font-weight-bold">
			                        <p><a class="text-primary text-uppercase"  href="#">'.$rankingPrecios[$i][4].'</a></p>
			                        
			                        <p><a class="text-primary text-uppercase"  href="#">'.$rankingPrecios[$i][9].'</a></p>
			                        
			                        <p><a class="text-dark    text-uppercase"  href="#">'.$rankingPrecios[$i][5].'</a></p>
			                    </div>
			
			                  <!-- Price -->
			                    
			                    '.$preA.'

			                  <!-- Rating -->
				                <div class="row  rating font-size-xxs text-dark justify-content-center" data-value="3">
				                
				                    '.$califMas.'
				                    				                    
				                </div>
				        
				                
				                <div class="row justify-content-center">
					                <i class="fa fa-credit-card" style="color: #373737"></i>
					                  &nbsp;&nbsp;&nbsp;
					                <i class="fas fa-share-alt" style="color: #373737"></i>
					                  &nbsp;&nbsp;&nbsp;
				                    <i class="fas fa-shipping-fast" style="color: #373737"></i>
				                      &nbsp;&nbsp;&nbsp;
				                    <i class="fas fa-cart-plus" style="color: #373737"></i>
				                </div>
				                				                
			                </div> 
			            </div>
			
			        </div>
			
			</div>
			<!---------- fin ----> '; 
	
	
	   //next($jsonP['productos']['galeria'.$categoria]);
	   
	   
	   
        echo '	 
        <script> 
		    $(document).ready(function(){   // AAA  
		    	 
			    $("#prod'.$i.'").click(function(){    // busca el distribuidor
				        				
				    document.getElementById("modal-4").innerHTML = "'.$rankingPrecios[$i][4].'";
				    
					document.getElementById("modal-5").innerHTML = "'.$rankingPrecios[$i][5].'";
					
					document.getElementById("modal-6").innerHTML = "'.$h1A.$rankingPrecios[$i][16].$h1B.'";
					
					document.getElementById("modal-6").style.color = "'.$colorA.'";
					
					document.getElementById("modal-7").innerHTML = "'.$h2A.$rankingPrecios[$i][17].$h2B.'";
					
					document.getElementById("modal-7").style.color = "'.$colorB.'";
					
					$("#modal-7A option").remove();	
					
					$("#modal-7A").append('."'".$tallaArray."'".');
					
					document.getElementById("modal-7B").innerHTML = "Disponible en '.$rankingPrecios[$i][14].'";
					
					document.getElementById("modal-1").src="'.$rankingPrecios[$i][6].'";
					
					document.getElementById("modal-2").src="'.$rankingPrecios[$i][7].'";
					
					document.getElementById("modal-3").src="'.$rankingPrecios[$i][8].'";
					
					document.getElementById("modal-8").innerHTML = "'.$rankingPrecios[$i][18].'";
					
					document.getElementById("modal-hash").innerHTML = "'.$hash.'";
					
					document.getElementById("modal-marca").innerHTML = "'.$rankingPrecios[$i][9].'";
					
					
			    });			
		    });	// AAA
		    
		    
		</script> ';
	   
	   } // cierre del if que selecciona la galeria
	   
	} // cierre del for i
	?> 
	

          	                  
 </div>


<!--------------------------------->
<br>
<!---------------->

<!------ modal productos ---->

<div class="modal fade" id="Producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true"  data-backdrop="static" data-keyboard="true"  >
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <img src="img/digiPop.svg" style="width: 60%;">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        
        
        <!---------- card ---------->
	    <div class="container-fluid ">
		    <div class="row justify-content-center padding">
				<div class="card  col-xs-12 col-sm-12 col-md-12" >
					
				    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
					    <div class="carousel-inner">
						    <div class="carousel-item active">
						        <img src="" class="d-block w-100" alt="digiPop" id="modal-1" >
						    </div>
						    <div class="carousel-item">
						        <img src="" class="d-block w-100" alt="digiPop" id="modal-2" >
						    </div>
						    <div class="carousel-item">
						        <img src="" class="d-block w-100" alt="digiPop" id="modal-3" >
						    </div>
					    </div>
					  
					    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
					        <i class="fas fa-angle-right" style="width: 50px; height: 50px;color: #808080;"></i>
					        <span class="sr-only">Next</span>
					    </a>
					</div>
				  
				  
				  
				  <div class="card-body">
				    <h5 class="card-title w-100 text-uppercase" id="modal-4" >Titulo del Producto</h5>
				    
				    <p id="modal-marca" class="text-uppercase">Marca</p>
				    
				    <p class="card-text" id="modal-5" >Descripción del articulo publocado mas extendida.</p>
				    <!-- Price -->
	                  <div class="mb-1 font-weight-bold text-muted">
		                  
	                    <p id="modal-6" >0</p>
	                    
	                    <p id="modal-7" >0</p>
	                    
	                    <h6 class="text-primary">IVA INCLUIDO</h6>

	                    
	                    <h4 id="modal-7B"></h4>
	                    <p>
	                    <select name="cars" id="modal-7A">
						    <option value="1">160p</option>
						    <option value="2">80p</option>
						    <option value="3">40p</option>
						</select>
	                    </p>
	                    <p class="text-primary"><h5>CANTIDAD</h5></p>
						<p>
						<select name="cars" id="modal-7C">
						    <option value="1" selected >1</option>
						    <option value="2">2</option>
						    <option value="3">3</option>
						    <option value="4">4</option>
						    <option value="5">5</option>
						    <option value="6">6</option>
						    <option value="7">7</option>
						    <option value="8">8</option>
						    <option value="9">9</option>
						    <option value="10">10</option>
						</select>
						</p>
	                    
	                  </div>
	                  
	                  <p class="card-text" id="modal-8" >Garantia de 15 dias</p>
	                  <p id="modal-hash" >hash</p>
				    
				  </div>
				</div>
		    </div>	
	    </div>
        <!------------->
    
      </div>
      <div class="modal-footer">
        
        <i class="fa fa-credit-card" style="color: #373737;font-size: 30px"></i>
		&nbsp;&nbsp;&nbsp;
        <i class="fas fa-share-alt x4" style="color: #373737; font-size: 30px"></i>
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    
        
        
        <button type="button" class="btn btn-primary" id="agregar"   data-dismiss="modal">Agregar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	
$(document).ready(function(){  
    $('#agregar').click(function(){ 
	    
	    // ENVIA LOS DATOS DEL PEDIDO AL PROCESADOR DEL CARRITO DE COMPRAS  
	    $.ajax({  
	        url:"carrito.php",   // envia a la url del carrito la informacion
	        method:"POST", 
	        dataType: 'json', 
	        data:{titulo     : $("#modal-4").text(),  // texto agregado
		          precioA    : $("#modal-6").text(),
		          precioB    : $("#modal-7").text(),
		          disponible : $("#modal-7B").text(),
		          tamaño     : $("#modal-7A").val(),     // valores almacenados
		          cantidad   : $("#modal-7C").val(),
		          foto       : $("#modal-1").attr("src"), // link de la foto
		          marca      : $("#modal-marca").text(),    // hash de validacion  
		          hash       : $("#modal-hash").text()
		         },  
		         success:function(resp){
			        var consulta = resp.res;
			        carrito = localStorage.carrito;
			        
			        localStorage.carrito = carrito + consulta; // almacena en el navegador web el pedido encriptado
			        //alert(consulta + ' // respuesta ');
			        //localStorage.removeItem("carrito"); // borra localstorage
			        //alert( ' alacenado ' + localStorage.carrito);
			        
			        
			        //***************** cantidad *****
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
			        //*************** 
						                     
			     }, 
			     error:function(res){
				     alert('ERROR!!!');
				 }
	    });
	    
	    // dentro del click  ALMACENA DATOS EN LOCAL STORE
	    
	    var precio = 0;
	    if( $("#modal-7").text() == '' ){  // almacena el precio con o sin descuento
		    precio = $("#modal-6").text();
	    } else {
		    precio = $("#modal-7").text();
	    }
	      
        $('#Producto').modal('hide');
              
    });
          
}); 
	
</script>

<!-------------- cierre de modal -->




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
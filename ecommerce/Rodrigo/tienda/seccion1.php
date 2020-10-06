<?php
ob_start();// permite corregir error en header o salto a otra pagina
session_start();

//require "secciones/json.php";
require('../config/assets/php/jsonProductos.php');
require('../config/assets/php/config_Products.php'); // configuracion del sitio
require "key.php";

$jsonP = json_decode($jsonProductos,true);
$jsonConfig   = json_decode($jsonConfigProductos, true); // array configuracion del sitio

//////////// LOGOTIPO /////////////

$logoUrl = $jsonConfig['config']['logos']['logo'];

/////////// SIN SELECCION DE CATEGORIA /////
if(isset($_GET['galeria'])) { 
	$indexGaleria = $_GET['galeria'];
} else {
	$indexGaleria = 1;
}

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

////////// TESTIMONIOS //////////////////
$testimonioHTML = '';
$active = 'active';
for($i = 0; $i < count($jsonConfig['config']['testimonios']); $i++){ 
    $keyT = key($jsonConfig['config']['testimonios']);
    $nombreTestimonio = $jsonConfig['config']['testimonios'][$keyT]['nombreUsuario'];
    $comentarioTestimonio = $jsonConfig['config']['testimonios'][$keyT]['comentario'];
    $socialTestimonio = $jsonConfig['config']['testimonios'][$keyT]['socialFuente'];
    $linkTestimonio   = $jsonConfig['config']['testimonios'][$keyT]['socialLink'];
    $productoTestimonio = $jsonConfig['config']['testimonios'][$keyT]['nombreProducto'];
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

<!---------- nav var ---------->	
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
	<div class="container-fluid fBarra fParrafo" id="d1">
		<a class="navbar-brand" href="#">
			<img src="<?php echo $logoUrl; ?>" width="170px" height="55px">
		</a>
		<button class="navbar-toggler"	type="button" data-toggle="collapse" data-target="#navbarResponsive">
		    <span class="navbar-toggler-icon  "></span> <!-- <i class="material-icons" style="font-size:30px">menu</i></span> -->
		</button>
		
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				
				<?php
					// index 
					echo	
					'<li class="nav-item active">
					    <a class="nav-link" href="index.php">'
					    .'Inicio'.
					    '</a>
					</li>'; 
					
					// productos  /////  LISTA DE GALERIAS DISPONIBLES ///////// 
					echo	
					'<li class="nav-item dropdown">
					    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">'
					    .'Productos'.
					    '</a>'.
					    '<div class="dropdown-menu">';      
					for ($i=1; $i <= count($jsonConfig['config']['catSlide']); $i++ ){ // imprime las galerias que son necesarias
						$keyCat = key($jsonConfig['config']['catSlide']);
						if($jsonConfig['config']['catSlide'][$keyCat]['visibilidades'] == 'si'){
							echo '<a class="dropdown-item" href="seccion1.php?galeria='.$i.'">'.$jsonConfig['config']['catSlide'][$keyCat]['titulo'].'</a>';
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
<!------------------------------------------->


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

<!------------ productos ----------->

<?php 
    
    //****************** ranking precios *************	
    
    $rankingPrecios = array();          // lista para ordenar por precios
    $rankingPreciosArticulos = array(); // lista para saber que productos son en relaciona a los precios
	
	/////// cantidad de galerias /////
    for($i = 0; $i < count($jsonP['productos']); $i++){ // ingresa al segundo nivel / el for es por los 3 articulos que contiene
		
		///////// clave de cada galeria /////
	    $k = key($jsonP['productos']); // key nivel 2 que son las galerias...
		 
		//////////// recorre dentro de cada galeria /////
	    for ($j = 0; $j < count($jsonP['productos'][$k]); $j++ ) { // ingresa al tercer nivel / el for es por la cantidad de subregistros que contiene el nivel anterior
			/////// selecciona los datos finales //////
			$L = key($jsonP['productos'][$k]); // key nivel 3 que es la lista de productos de cada galeria
	        //echo $L.' (tercer nivel)-> ';
	        //echo $jsonP['productos'][$k][$L];
	        next($jsonP['productos'][$k]);   // pasa al siguiente registro nivel 3
	         
            // precios sin descuento
			$minimoA = $jsonP['productos'][$k][$L]['precioA'];      // 0
			// precios con descuento
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

    sort($rankingPrecios);
    	
?>

<div class="row ">
	<div class="col-12"><!---- titulo ------>
	
	    <!-- Heading -->
	    
	    	<h2 class="mb-10 text-center text-uppercase fSubtitulo"> 
		    	<?php
					
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
					
					echo $jsonConfig['config']['catSlide']['catSlide'.$categoria]['titulo'];
					
                    if (array_key_exists('galeria'.$categoria, $jsonP['productos'])) {
						//echo " existe";
						//echo ' '.$jsonP['productos']['galeria'.$categoria]['producto1']['galeria'];   // TITULO DE LA CATEGORIA
					} else {
						echo '<p class="fSubtitulo">LA GALERIA NO CONTIENE ARTICULOS</p>';
					}

		    	?>
		    	
		    </h2>
	
	</div>
</div>
<div class="container-fluid">        
<div class="row justify-content-center padding"> <!--- marco de todos los productos --->
	
    <?php 
	 
	for ($i=0; $i < count($rankingPrecios); $i++){ // la cantidad de objetos es la de cada categoria y de productos
		
	    if($rankingPrecios[$i][15] == 'galeria'.$indexGaleria ){ // compara el numero que llega por get con la galeria correspondiente
	        
	        // IF DE OFERTA	
	        if( $rankingPrecios[$i][12] == 'si' ){ // consulta si hay oferta y agrega el comentario
		       $oferta =   '<div class="badge badge-dark card-badge card-badge-left text-uppercase">OFERTA</div>'; 
	        } else {
		        $oferta = '<hr>';
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
	        
		    /////////////////////////////////////////////////////////////
		    
		    // hash de validacion
		    $hash = hash('sha256', $secret.$rankingPrecios[$i][4].$rankingPrecios[$i][9].$rankingPrecios[$i][16].$rankingPrecios[$i][17]);
		                                     // titulo               marca                  precioA                precioB		    
			echo '
			<div class="col-6 col-md-3 col-lg-2"> <!----- producto x---->
			
			        <!-- Card -->
					<div class="card mb-7 sombras" data-toggle="card-collapse">
					<a href="#" data-toggle="modal" data-target="#Producto" id="prod'.$i.'"> 
					<div 
					    style="background-image: url('.$rankingPrecios[$i][6].');
					    background-size: cover;
					    height: 250px;
				 	    background-position:center;"
					></div>
			        </a>      
			              <!-- Badge -->
			              
			                '.$oferta.'
			                                      
			              <!-- Image -->
			            <!-- <a href="#" data-toggle="modal" data-target="#Producto" id="prod'.$i.'">
			                <img src="'.'" class="card-img-top">
			            </a> -->
			


			              <!-- Collapse -->
			            <div class="card-collapse-parent">
			
			                <!-- Body -->
			                <div class="card-body px-0 bg-white pl-lg-2 pr-lg-2 pl-md-2 pr-md-2 pl-xs-2 pr-xs-2 pl-2 pr-2">
			
			                  <!-- Heading -->
			                    <div class="mb-1 font-weight-bold">
			                        <p><a class="text-primary text-uppercase fParrafo"  href="#" data-toggle="modal" data-target="#Producto" id="prod'.$i.'">'.$rankingPrecios[$i][4].'</a></p>
			                        
			                        <p><a class="text-primary text-uppercase fParrafo"  href="#">'.$rankingPrecios[$i][9].'</a></p>
			                        
			                        <p><a class="text-dark    text-uppercase fParrafo"  href="#">'.$rankingPrecios[$i][5].'</a></p>
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

<!----------- slide testimonios --------------->
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
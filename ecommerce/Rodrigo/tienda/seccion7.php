<?php
ob_start();// permite corregir error en header o salto a otra pagina
session_start();

//require "secciones/json.php";
require('../config/assets/php/jsonProductos.php');
require('../config/assets/php/config_Products.php'); // configuracion del sitio
//require "key.php";

$jsonP = json_decode($jsonProductos,true);
$jsonConfig   = json_decode($jsonConfigProductos, true); // array configuracion del sitio

//////////// LOGOTIPO /////////////

$logoUrl = $jsonConfig['config']['logos']['logo'];


	

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
    
    <script async src="https://get.geojs.io/v1/ip/geo.js"></script>
    
    <script
        src="https://www.paypal.com/sdk/js?client-id=ATwVXaggQaUJq_cQdeH-H5AJjMRnbmSgnRD09TF51_A9tXuqkh4bv7qRxUr6jLxMMtxaa2r2SpLvGnjH&currency=MXN">
    </script>




<script type="text/javascript">

$(document).ready(function(){
	
	// SE EJECUTA AL CARGAR LA PAGINA
	//alert(localStorage.carrito); // muestra el contenido del local storage
	        
	$.ajax({  
	    url:"carritoA.php",   // envia a la url del carrito la informacion
	    method:"POST", 
	    dataType: 'json', 
	    data:{ carrito   : localStorage.carrito  // texto agregado 
	         },  
	    success:function(resp){
		    var consulta = resp.res;
		  //carrito = localStorage.carrito;
		        
		    //$("#carroText").text(resp.res); // inserta en text respuesta desde el servidor
		    document.getElementById('carroPhp').innerHTML = consulta ; // reemplaza todo y elimina lo anterior
		               
		}, 
		error:function(res){
			alert('ERROR!!!');
	    }
	});

    //***********************
    
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
	
	//************************
	
		  
	    // ENVIA LOS DATOS ALMACENADOS
	    $.ajax({ 
		  	//alert('datos almacenados '+ localStorage.datosPersonales);
	        url:"carritoB.php",   // envia a la url DE DATOS PERSONALES
	        method:"POST", 
	        dataType: 'json', 
	        data:{ datosPers   : localStorage.datosPersonales  // texto agregado
		         },  
		         success:function(resp){
			        var datos = resp.resA;
			        $("#validationServer01").val(resp.nombre) ,
			        document.getElementById("validationServer01").className = "form-control is-valid";
			        $("#validationServer02").val(resp.telefono),
			        document.getElementById("validationServer02").className = "form-control is-valid";
			        $("#validationServer03").val(resp.email),
			        document.getElementById("validationServer03").className = "form-control is-valid";
			        $("#validationServer04").val(resp.ciudad),
			        document.getElementById("validationServer04").className = "form-control is-valid";
			        $("#validationServer05").val(resp.estado),
			        document.getElementById("validationServer05").className = "form-control is-valid";
			        $("#validationServer06").val(resp.cp)
			        document.getElementById("validationServer06").className = "form-control is-valid"; 
			        
			        document.getElementById("invalidCheck3").checked = true;
			        document.getElementById("invalidCheck3").className = "form-control is-valid";
			        //localStorage.removeItem("datosPersonales"); // borra localstorage
			        //alert( ' datos ' + datos);
			        						                     
			    }, 
			    error:function(resA){
				    //alert('ERROR!!!');
				}
	    });
	    
	          
	//*********************
	var myVar = setInterval(myTimer, 3000);
    function myTimer() {
	    var d = new Date();
	    clearInterval(myVar);
	    var subTotal = document.getElementById("sbtotal").textContent; // valor subtotal
	   	var totalSplit = subTotal.split("|");  // lo parte en un array
	   	var rappi = document.getElementById("rappi").textContent;
	   	document.getElementById("subtotal").textContent = 'SUBTOTAL '+ totalSplit[0]+'MXN'; 
	   	document.getElementById("flete").textContent = 'SIN COSTO 0MXN';
	}
	
	

});
        
</script>
    
</head>

<body onload="carritoCliente();" class="cFondo">
	
	
	
<!---------- nav var ---------->	
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top" >
	<div class="container-fluid pie" id="d1">
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
					'<li class="nav-item ">
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
					    <a class="nav-link active" href="seccion7.php"><i class="fas fa-shopping-cart" style="font-size:26px"></i><span class="badge badge-light" id="cantidad"></span></a>
				</li>
							
			</ul>
		</div>	
	</div>
</nav> 	
<!------------------------------------------->

<!---------- BARRA DE COMENTARIOS O PROMOCIONES ////    JUMBOTRON ----->
	<div class="jumbotron jumbotron-fluid">
	    <div class="container">
	        <h2 class="display-4 fuenteTi " >CHECKOUT</h2>
	        <p  class="lead      fuenteTx1" >AGRADECEMOS TU PREFERENCIA</p>
	    </div>
	</div>
	
<!------ botones ----->
<div class="container">
	<div class="btn-group" role="group" aria-label="Basic example">
	  <button type="button" class="btn btn-primary align-text-top">PAGAR <i class='far fa-credit-card fa-2x align-bottom'></i></button>
	  <button type="button" class="btn btn-secondary " id="borrar" >VACIAR</button>
	</div>
</div>
<br>

<script type="text/javascript">
	
$(document).ready(function(){

    $("#borrar").click(function(){
	   
	    localStorage.removeItem("carrito");
	    alert('SE HA BORRADO EL CARRITO!');
	    window.location.reload(); // recarga la pagina
	    
	});
});	

function cerrar(dato){
	
	var x = localStorage.carrito;     // busca lo guardado en el navegador
	var carritoSplit = x.split("|");  // lo parte en un array
	
	carritoSplit.splice(dato, 1); // borra un registro seleccionado
	
	//localStorage.removeItem("carrito");  // borrar el carrito
		
	var n = carritoSplit.length; // longitud del array
	
	var carrito = '';
	for( i=0; i<(n-1); i++){  // el for se encarga de volver a juntar los datos del carrito y los almacena nuevamente en el navegador
		//alert(i + ' -> ' + carritoSplit[i]);
		carrito = carrito + carritoSplit[i] + '|';	
	}
	
	localStorage.carrito = carrito; // sobre escribe el carrito
	
	//alert(dato);
	
	window.location.reload(); // recarga la pagina
}

</script>


<!------- lista del pedido --------->


<div id="carroPhp"><!--- aqui se carga el carrito desde el servidor -->

    <p id="carroText"></p>
	
</div>	


<!-----	
<div class="container">
	
	<div class="media border rounded " style="border-color: #585858; ">
	    <img src="https://yevgenysim.github.io/shopper/assets/img/products/product-6.jpg" class="align-self-start mr-0 col-5 col-sm-6 col-md-3" alt="...">
	    <div class="media-body  align-middle   col-6 col-sm-6 col-md-8 text-left" style="margin-top: .25rem !important;">
	        <h5 class="mt-0">VESTIDO BONITO</h5>
	        <p>350.<sup>00</sup>$ TALLA S COLOR ROJO/BLANCO.</p>
	    </div>
	    
	    <div class="float-right align-rigth">
	        <button type="button" class="close" aria-label="Close">
		        <span aria-hidden="true">&times;</span>
		    </button>	
		</div>
	    
	</div>
	<br>	
</div>
--->
<!-------- DATOS PERSONALES ------------->

<div class="container">
	<form>
	  <div class="form-row">
		  
	    <div class="col-md-4 mb-3">
	      <label for="validationServer01">Nombre Completo</label>
	      <input type="text" class="form-control is-invalid" id="validationServer01" value="" required oninput="nombre()">
	      
	    </div>
	    
	    <div class="col-md-4 mb-3">
	      <label for="validationServer02">Telefono</label>
	      <input type="number" class="form-control is-invalid" id="validationServer02" value="" required oninput="telefono()">
	      
	    </div>
	    
	    <div class="col-md-4 mb-3">
	      <label for="validationServer03">Email</label>
	      <input type="text" class="form-control is-invalid" id="validationServer03" value="" required oninput="email()">
	      
	    </div>
	    
	  </div>
	  
	  <div class="form-row">
		  
	    <div class="col-md-6 mb-3">
	      <label for="validationServer03">Ciudad</label>
	      <input type="text" class="form-control is-invalid" id="validationServer04" required oninput="ciudad()" >
	      
	    </div>
	    
	    <div class="col-md-3 mb-3">
	      <label for="validationServer04">Provincia</label>
	      <select class="custom-select is-invalid" id="validationServer05" required onchange="estado()" >
	        <option selected disabled value="">Seleccione...</option>
	        <option value="1">Buenos Aires</option>
			<option value="2">Jujuy</option>
	        <option value="3">Salta</option>
	      </select>
	      
	    </div>
	    
	    <div class="col-md-3 mb-3">
	      <label for="validationServer05">Codigo Postal</label>
	      <input type="text" class="form-control is-invalid" id="validationServer06" required oninput="cp()" >
	      
	    </div>
	  </div>
	  
	  <div class="form-group">
	    <div class="form-check">
	      <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" required onchange="terminos()" >
	      <label class="form-check-label" for="invalidCheck3">
	        Acepto los terminos y condiciones del servicio diespuesto por la empresa.
	      </label>
	      <div class="invalid-feedback" id="dato-7">
	        Debe aceptar los terminos y condiciones del servicio para continuar.
	      </div>
	    </div>
	  </div>
	  
	  <!---- <button class="btn btn-primary" type="submit">Submit form</button> --->
	</form>
</div>

<script type="text/javascript">
	
function nombre() {
    var n = document.getElementById("validationServer01").value;
    if( n.length > 20 ){
	    document.getElementById("validationServer01").className = "form-control is-valid";
    } else{
	    document.getElementById("validationServer01").className = "form-control is-invalid";
    }
}

function telefono() {
    var n = document.getElementById("validationServer02").value;
    if( n.length > 9 ){
	    document.getElementById("validationServer02").className = "form-control is-valid";
    } else{
	    document.getElementById("validationServer02").className = "form-control is-invalid";

    }
}

function email() {
    
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var test = document.getElementById("validationServer03").value;
    var validacion = re.test(test); 
    
    if(validacion == true ){
	    document.getElementById("validationServer03").className = "form-control is-valid";
    } else {
	    document.getElementById("validationServer03").className = "form-control is-invalid";
    }
 	
}

function ciudad() {
    var n = document.getElementById("validationServer04").value;
    if( n.length > 4 ){
	    document.getElementById("validationServer04").className = "form-control is-valid";
    } else{
	    document.getElementById("validationServer04").className = "form-control is-invalid";
    }
}

function estado() {
    var n = document.getElementById("validationServer05").value;
    if( n != 'Seleccione...' ){
	    document.getElementById("validationServer05").className = "form-control is-valid";
    } else{
	    document.getElementById("validationServer05").className = "form-control is-invalid";
    }
}




function cp() {
    var n = document.getElementById("validationServer06").value;
    if( n.length > 3 ){
	    document.getElementById("validationServer06").className = "form-control is-valid";
    } else{
	    document.getElementById("validationServer06").className = "form-control is-invalid";
    }
}

function terminos () {
    var n = document.getElementById("invalidCheck3").checked;
    if( n == true ){
	    document.getElementById("invalidCheck3").className = "form-control is-valid";
    } else{
	    document.getElementById("invalidCheck3").className = "form-control is-invalid";
    }
}


$(document).ready(function(){
    
    $("#invalidCheck3").click(function(){
	    
	    var A = document.getElementById("validationServer01").className;
	    var B = document.getElementById("validationServer02").className;
	    var C = document.getElementById("validationServer03").className;
	    var D = document.getElementById("validationServer04").className;
	    var E = document.getElementById("validationServer05").className;
	    var F = document.getElementById("validationServer06").className;
	     
	    if( A == 'form-control is-valid' && B == 'form-control is-valid' && C == 'form-control is-valid' && 
	        D == 'form-control is-valid' && E == 'form-control is-valid' && F == 'form-control is-valid' ){
	            //localStorage.removeItem("carrito");
	            alert('INFORACION COMPLETA!');
	    }   else {
		    document.getElementById("invalidCheck3").checked = false;
		    alert('FALTA INFORMACION POR COMPLETAR!');
		}
	    
	});
});	


	
</script>


<script type="text/javascript">
	
$(document).ready(function(){  
    $('#invalidCheck3').click(function(){ 
	    
	    // ENVIA LOS DATOS PERSONALES 
	    $.ajax({  
	        url:"carritoB.php",   // envia a la url DE DATOS PERSONALES
	        method:"POST", 
	        dataType: 'json', 
	        data:{nombre   : $("#validationServer01").val(),  // texto agregado
		          telefono : $("#validationServer02").val(),
		          email    : $("#validationServer03").val(),
		          ciudad   : $("#validationServer04").val(),
		          estado   : $("#validationServer05").val(),     // valores almacenados
		          cp       : $("#validationServer06").val()
		         },  
		         success:function(resp){
			        var datos = resp.res;
			        if( document.getElementById("invalidCheck3").checked == true ){
				        localStorage.datosPersonales = datos; 
				        // si el formulario esta completo lo actializa cuando se hace click en cheked
			        }
			        //localStorage.removeItem("datosPersonales"); // borra localstorage
			        //alert( ' alacenado ' + localStorage.datosPersonales);
			        						                     
			    }, 
			    error:function(res){
				    alert('ERROR!!!');
				}
	    });
	          
    });
          
}); 
	
</script>





<br>
<br>


<!---------- logistica ------------>

<script type="text/javascript">
	
function rappiS(){
	
	document.getElementById("flete").textContent = '';
	document.getElementById("flete").textContent = 'VALOR ESTIMADO DE ENVIO ' + document.getElementById("rappi").textContent + 'MXN'; // le agrego el valor de rappi	
	//alert(textSubT);
}	
	
function uberS(){

    document.getElementById("flete").textContent = '';
	document.getElementById("flete").textContent = 'VALOR ESTIMADO DE ENVIO ' + document.getElementById("uber").textContent + 'MXN'; // le agrego el valor de rappi	
	
}

function free(){

    document.getElementById("flete").textContent = '';
	document.getElementById("flete").textContent = 'ENVIO SIN COSTO 0MXN'; // le agrego el valor de rappi	
	
}

function tienda(){

    document.getElementById("flete").textContent = '';
	document.getElementById("flete").textContent = 'SIN COSTO 0MXN'; // le agrego el valor de rappi	
	
}

	
</script>



<div class="container">
	
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" onclick="tienda()">TIENDA</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" onclick="free()">FREE</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false" onclick="rappiS()">RAPPI</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="cont-tab"   data-toggle="tab" href="#cont" role="tab" aria-controls="cont" aria-selected="false" onclick="uberS()">UBER</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
	
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
	    
	    <div class="media tab-pane fade show active" id="x1" role="tabpanel" aria-labelledby="contact-tab">
			<div class="row row-cols-2 ">
                
                <div class="col">
                    <img src="img/retirar.svg" class="mr-3 col-12 col-sm-12 col-md-8" alt="...">
                </div>    
                <div class="media-body col  align-self-center">
                    <h5 class="mt-0">NUESTRA DIRECCIÓN</h5>
                    <p class="pie  "> CALLE 1 BARRIO X NUMERO 123 - BUENOS AIRES - CP 12345</p>
                </div>
			</div>
        </div>
	
	</div>
    
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
	    
	    <div class="media tab-pane fade show active " id="x2" role="tabpanel" aria-labelledby="contact-tab">
			<div class="row row-cols-2 ">
                
                <div class="col">
                    <img src="img/envioGratis2.svg" class="mr-3 col-12 col-sm-12 col-md-8" alt="...">
                </div>    
                <div class="media-body col  align-self-center">
                    <h5 class="mt-0">ENVIO</h5>
                    <p class="pie  "><h3>ENVIO SIN COSTO</h3></p>
                </div>
			</div>
        </div>
	    
	</div>
    
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
	    
	    <div class="media tab-pane fade show active" id="x3" role="tabpanel" aria-labelledby="home-tab">
			<div class="row row-cols-2 ">
                
                <div class="col">
                    <img src="img/rappi.png" class="mr-3 col-10 col-sm-8 col-md-5" alt="...">
                </div>    
                <div class="media-body col  align-self-center">
                    <h5 class="mt-0">ENVIO</h5>
                    <h3><p>VALOR ESTIMADO DEL SERVICIO <span id="rappi">50</span>MXN</p></h3>
                    <p class="pie  "> Datos del servicio de RAPPI.</p>
                </div>
			</div>
        </div>
	    
	</div>
    
    <div class="tab-pane fade" id="cont" role="tabpanel" aria-labelledby="cont-tab">
	    
	    <div class="media tab-pane fade  show active" id="x4" role="tabpanel" aria-labelledby="cont-tab">
			<div class="row row-cols-2 ">
                
                <div class="col">
                    <img src="img/uber.png" class="mr-3 col-10 col-sm-8 col-md-5" alt="...">
                </div>    
                <div class="media-body col  align-self-center">
                    <h5 class="mt-0">ENVIO</h5>
                    <h3><p>VALOR ESTIMADO DEL SERVICIO <span id="uber">70</span>MXN</p></h3>
                    <p class="pie  ">EL SERVICIO DE ENVIO POSEE COSTO</p>
                </div>
			</div>
        </div>

	    
	</div>
</div>
	
</div>



<!----------    JUMBOTRON  TOTAL ----->
	<div class="jumbotron jumbotron-fluid">
	    <div class="container">
	        <h3 class="display-4" id="subtotal"><h4 id="flete"></h4></h3>
	        <p class="lead pie">AGRADECEMOS TU PREFERENCIA</p>
	    </div>
	</div>
	

<!----------------- OPCIONES DE PAGO ----->



<div class="container">
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		
	  <li class="nav-item">
	    <a class="nav-link active" id="efectivo-tab" data-toggle="tab" href="#efectivo" role="tab" aria-controls="efectivo" aria-selected="true">
	        <img src="img/efectivo.svg" width="50">
	    </a>
	  </li>
	  
	  <li class="nav-item">
	    <a class="nav-link "       id="paypal-tab"   data-toggle="tab" href="#paypal"   role="tab" aria-controls="paypal"   aria-selected="false">
		    <!-- <i class="fab fa-paypal fa-2x"></i> -->
		    <img src="img/paypal1.svg" width="120">
	    </a>
	  </li>
	  
	  <li class="nav-item">
	    <a class="nav-link"        id="tarjetas-tab" data-toggle="tab" href="#tarjetas" role="tab" aria-controls="tarjetas" aria-selected="false">
		    <br>
		    <img src="img/version-horizontal-color/version-horizontal-small.png">
		    <!--  <i class="fab fa-cc-visa fa-2x"></i>
		    <i class="fab fa-cc-mastercard fa-2x"></i> -->
	    </a>
	  </li>
	  
	  <li class="nav-item">
	    <a class="nav-link"        id="cripto-tab" data-toggle="tab" href="#cripto" role="tab" aria-controls="tarjetas" aria-selected="false">
		    
		    <img src="img/bitcoin3.svg" height="50px">
		    <img src="img/dash.svg" height="50px">
		    <!--  <i class="fab fa-cc-visa fa-2x"></i>
		    <i class="fab fa-cc-mastercard fa-2x"></i> -->
	    </a>
	  </li>
	  
	</ul>
	
	<div class="tab-content" id="myTabContent">
		<!---- efectivo --->
	    <div class="tab-pane fade show active" id="efectivo"  role="tabpanel" aria-labelledby="efectivo-tab">
		    
		    
		    <form>
			  <div class="form-group">
				<br>
			    <label for="exampleInputEmail1">PAGO EN EFECTIVO</label>
			    <input type="email" class="form-control col-12 col-md-6" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="NECESITO CAMBIO DE...">
			    <small id="emailHelp" class="form-text text-muted"  ></small>
			  </div>
			  			  
			  <button type="submit" class="btn btn-primary"><h4>ENVIAR PEDIDO!&nbsp; <i class="fab fa-whatsapp"></i></h4></button>
			</form>    
		    
		</div>
	    
	    <!---- paypal ---->
	    <div class="tab-pane fade"             id="paypal"    role="tabpanel" aria-labelledby="paypal-tab"  >
		    <div class="media tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		 		<div class="row ">
	                
	                <div class="col-12 col-md-8">
	                    <br>
	                    <!----- PAYPAL ----------->
                        <div id="paypal-button-container" onclick="pagopaypal()"></div>
	                </div>  
	                  
	                <div class="media-body align-self-center col-12 col-md-4">
		                <br>
	                    <h5 class="mt-0">PAGO EN LINEA</h5>
	                    
	                </div>
				</div>
							
            </div>
            
            
            
            
	    </div>
	    
	    <!--- tarjeta ----->
	    <div class="tab-pane fade"  id="tarjetas"  role="tabpanel" aria-labelledby="tarjetas-tab">TARJETAS</div>


        <!--- criptos -------->
        <div class="tab-pane fade"  id="cripto"  role="tabpanel" aria-labelledby="cripto-tab">CRIPTO MONEDAS
	    
	    <a href="bitcoin:1Tm5EXcx6zmFcDebSz894KMX8LpK67z9i?message=jjhjhj&amount=0.01795670" >bitcoin:1Tm5EXcx6zmFcDebSz894KMX8LpK67z9i?message=jjhjhj&amount=0.01795670</a>
	    
	    </div>
	    
	    
	</div>
	
</div>	

<script>////////////////// PAYPAL ////////////////////
	paypal.Buttons({
	    createOrder: function(data, actions) {
	        // This function sets up the details of the transaction, including the amount and line item details.
	        return actions.order.create({
	            purchase_units: [{ amount: { value: '1000' } }]
	        });
	    },
	    onApprove: function(data, actions) {
	        // This function captures the funds from the transaction.
	        return actions.order.capture().then(function(details) {
	            // This function shows a transaction success message to your buyer.
	            alert('Transaction completed by ' + details.payer.name.given_name);
	        });
	    },
	    //alert('se esta pagando con paypal'); /// me notifica del pago
	    
	}).render('#paypal-button-container');
	  //This function displays Smart Payment Buttons on your web page.
	  
	////// click pago /////
	function pagopaypal() {
		alert('se esta pagando con paypal'); // no funciona!!!
		
	}
	
	$(document).ready(function(){  
       $('#paypal-button-container').click(function(){ 
	       alert(' pago pendiente con paypal ');
	   
	   });
	});  
	
	
</script>

<br>
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
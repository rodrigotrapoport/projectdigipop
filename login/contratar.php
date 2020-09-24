<?php
/// COTIZACION DEL DOLLAR EN ARG Y MEX

//****************  DOLLAR a PESO MX*********************	
///////////////////// coinbase cotizacion dollar //////

$cSession = curl_init(); 
curl_setopt($cSession,CURLOPT_URL,"https://api.coinbase.com/v2/prices/spot?currency=USD");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 
$resultUSD=curl_exec($cSession);
curl_close($cSession);
$preciosUSDArray = json_decode($resultUSD, TRUE);
$precio1BTCusd = $preciosUSDArray['data']['amount'];

$cSession = curl_init(); 
curl_setopt($cSession,CURLOPT_URL,"https://api.bitso.com/v3/trades/?book=btc_mxn&limit=30&marker");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 
$result=curl_exec($cSession);
curl_close($cSession);
$preciosArray = json_decode($result, TRUE);
$precio1BTCmxn = $preciosArray['payload'][0]['price'];
$dollarMEX = number_format(($precio1BTCmxn/ $precio1BTCusd),2,'.','');

//************ DOLLAR a PESO ARG ******************

$cSession = curl_init(); 
curl_setopt($cSession,CURLOPT_URL,"https://www.cronista.com/MercadosOnline/json/homegetPrincipal.html");
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 
$resultARG=curl_exec($cSession);
curl_close($cSession);
$pesoARG = json_decode($resultARG, TRUE);
$cotOfArg = $pesoARG['monedas'][0];
$dollarARG = number_format(($cotOfArg['Venta'] * 1.3 ),2,'.','');

//***********************

//// DETECTAR PAIS DE ORIGEN ///
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://get.geojs.io/v1/ip/geo.json');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$output = curl_exec($ch);
	curl_close($ch);
    $datos1 = json_decode($output,true);
    $pais = $datos1['country_code3'];
    
   //$pais = 'ARG';

//************************



    if( $pais == 'MEX'){
		$costoLocalA = number_format((90 * $dollarMEX*1.16),0,'.','');
		$costoLocalB = number_format((150 * $dollarMEX*1.16),0,'.','');
		$moneda = 'MXN';
		$iva = 'LOS PRECIOS INCLUYEN IVA';
		$mensaje1 = 'EL PAGO CORRESPONDE A LA LICENCIA DE USO POR UN AÑO DE LA PLATAFORMA. LA RENOVACIÓN ANUAL 30U$D + IVA.';
		$mensaje2 = 'INCLUYE HOSTING, DOMINIO Y LICENCIA.';
	} elseif ( $pais == 'ARG' ){
		$costoLocalA = number_format((90 * $dollarARG),0,'.','');
		$costoLocalB = number_format((150 * $dollarARG),0,'.','');
		$moneda = '$AR';
		$iva = 'PRECIO FINAL';
		$mensaje1 = 'EL PAGO CORRESPONDE A LA LICENCIA DE USO POR UN AÑO DE LA PLATAFORMA. LA RENOVACIÓN ANUAL 30U$D + IVA.';
		$mensaje2 = 'INCLUYE HOSTING, DOMINIO Y LICENCIA.';
	} else {  
		$costoLocalA = number_format((90 * $dollarMEX),0,'.','');
		$costoLocalB = number_format((150 * $dollarMEX),0,'.','');
		$moneda = 'MXN';
		$iva = 'PRECIOS SIN IVA';
		$mensaje1 = 'EL PAGO CORRESPONDE A LA LICENCIA DE USO POR UN AÑO DE LA PLATAFORMA. LA RENOVACIÓN ANUAL 30U$D + IVA.';
		$mensaje2 = 'INCLUYE HOSTING, DOMINIO Y LICENCIA.';
	};

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digipop Tech</title>
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
     
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
	    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous">
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
	    crossorigin="anonymous">
	</script>
    <link rel="stylesheet" href="css/estilosiniciar.css">
    
    <style>
	    
		.fondo {
		  background-image: linear-gradient(#D8D8DF, #EFEFF0);
		  background-repeat: no-repeat; 
		  background-size: cover;     
		  height: 100%;  
		}
		
		img {
	        width: 250px;
	        -webkit-filter: drop-shadow(5px 5px 10px #666666);
	        filter: drop-shadow(5px 5px 5px #666666);
	    }
	    .footer {
		  position: absolute;
		  bottom: 0;
		  width: 100%;
		}
		.v-divider{
		 margin-left:5px;
		 margin-right:5px;
		 width:1px;
		 height:100%;
		 border-left:1px solid gray;
		}
		.sinFondo {
			background-color:rgba(0,0,0,0);
			display: none;
	    } 
    </style>
    
</head>
<body class="fondo" onload="incio()">
	<!--
    <div class="wrapper fadeInDown">
        <div id="formContent">
                       <div class="fadeIn first">
                <br>
                <i class="fas fa-user"></i> Iniciar Sesión<br><br>
            </div>
    
           
            <div class="container row col-md-5">
	            <form method="post" action="registro.php">
	                <input type="text" id="logUsuario"    class="fadeIn second form-control is-invalid " 
	                name="logUsuario" placeholder="USUARIO" oninput="usuarioP()">
	                <br>
	                <input type="password" id="logPin" class="fadeIn third  form-control is-invalid " 
	                name="logPin" placeholder="PIN 4 DIGITOS" oninput="pinP()">
	                <br>
	                <input type="button" class="fadeIn fourth" value="Iniciar sesión" id="botonLogIn">
	            </form>
            </div>
            
            <div id="formFooter">
                <a class="underlineHover" href="#">Olvidaste tu PIN?</a> / <a class="underlineHover" href="registro.html">Quiero
                    Registrarme</a>
            </div>
    
        </div>
    </div>
    -->
    <br><br>
    
<section>
    <div class="container">
	    <div class="row justify-content-md-center">
	        <img src="digiPop.svg" height="70px"  class="col-md-3 col8"><br>
	    </div>
	    <br>
	    <p class="h3 text-dark text-center">CONTRATAR SERVICIO</p>
	    <hr>
	    
	    <form class="col ">
		    <div class="row">
			    <div class="col-md-3"></div>
				<div class="form-group col-md-6">
				    <label for="formGroupExampleInput">Ingresar Nombre Completo</label>
				    <input type="text" class="form-control is-invalid" id="inscripcionNombre" placeholder="Jesus Angel Perez Perez" oninput="nombreP()">
			    </div>
			    <div class="col-md-3"></div>
		    </div>
			
			<div class="row">
				<div class="col-md-3"></div>  
	   	        <div class="form-group col-md-6">
				    <label for="formGroupExampleInput2">Ingresar Email</label>
				    <input type="text" class="form-control is-invalid" id="inscripcionEmail" placeholder="jesus@xmail.com" oninput="emailP()">
				</div>
				<div class="col-md-3"></div>
			</div>
			
			<div class="row">
				<div class="col-md-3"></div>  
	   	        <div class="form-group col-md-6">
				    <label for="formGroupExampleInput2">Confirmar Email</label>
				    <input type="text" class="form-control is-invalid" id="confEmail" placeholder="jesus@xmail.com" oninput="c_emailP()">
				</div>
				<div class="col-md-3"></div>
			</div>	
			
			
			
			
		</form>	
		
		<div class="row justify-content-md-center text-dark" id="botones" >
	        <div class="col-6 col-md-3 text-center">
		        <p class="font-weight-bold h2">SERVICIOS</p>
				<p class="font-weight-light">Para que tus servicios profesionales lleguen a mas clientes es este tu plan.</p>  
		        <button type="button" class="btn btn-primary btn-lg font-weight-bold" id="servicio"><?php echo $costoLocalA.$moneda?></button>
	        </div>
	    
	        
	       
	        <div class="col-6 col-md-3 text-center">
		        <p class="font-weight-bold h2">ECOMMERCE</p>
				<p class="font-weight-light">Este es el mejor plan para montar tu comercio en linea.</p><br>
				<button type="button" class="btn btn-secondary btn-lg font-weight-bold" id="ecommerce"><?php echo $costoLocalB.$moneda?></button>   
	        </div>
		</div>
		<br>
		<P class="text-center h3"><?php echo $iva; ?></P>
		<p class="h7 font-weight-light text-justify"><?php echo $mensaje1;?></p>
		<p class="h7 font-weight-light text-justify"><?php echo $mensaje2;?></p>   
		<hr>
		<div class="row justify-content-md-center">
		    <button type="button" class="btn btn-link">VER CONDICIONES DEL SERVICO</button>
		    <a class="btn btn-link" href="mailto:hola@digipop.tech" role="button">hola@digipop.tech</a>
        </div>
    
    
        <div class="jumbotron jumbotron sinFondo" id="jumbo" >
		    <div class="">
		        <h1 class="display-4 text-center">TE ENVIAMOS UN CORREO CON LOS PASOS A SEGUIR</h1>
		        <p class="lead text-center">Para mas información o consultas envianos un correo a hola@digipop.tech .</p>
		    </div>
		</div>
		
		
	</div>
	
	
	
</section>  		
	
	<br><br>    
<div>
	<nav class="navbar navbar-light bg-dark text-white">
	  <a class="navbar-brand text-white" href="www.digipop.tech">
	    <img src="digiPop.svg"  height="40" class="d-inline-block align-top" alt="">www.digipop.tech
	  </a>
	  <a class="text-center">hola@digipop.tech</a>
	</nav> 
</div>   
    
    
    
</body>

<script type="text/javascript">
	
	function inicio(){
		//$('#jumbo').hide();
		document.getElementById("jumbo").display = none;
	}
	
	function nombreP() {
	    var n = document.getElementById("inscripcionNombre").value;
	    if( n.length > 8 ){
		    document.getElementById("inscripcionNombre").className = "form-control is-valid";
	    } else{
		    document.getElementById("inscripcionNombre").className = "form-control is-invalid";
        };
    }
    function emailP() {
	    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    var test = document.getElementById("inscripcionEmail").value;
	    var validacion = re.test(test); 
	    
	    if(validacion == true ){
		    document.getElementById("inscripcionEmail").className = "form-control is-valid";
	    } else {
		    document.getElementById("inscripcionEmail").className = "form-control is-invalid";
	    };
	    botonP();
    }
    function c_emailP() {
	    var n = document.getElementById("confEmail").value;
	    if( n ==   document.getElementById("inscripcionEmail").value ){
		    document.getElementById("confEmail").className = "form-control is-valid";
	    } else{
		    document.getElementById("confEmail").className = "form-control is-invalid";
        };
        botonP();
    }

    
    
$(document).ready(function(){  
    $('#servicio').click(function(){ 
	    if(
	        document.getElementById("inscripcionNombre").className == "form-control is-valid"  &&
	        document.getElementById("confEmail").className == "form-control is-valid"
	    ){
 
	    // ENVIA LOS DATOS PERSONALES 
	    $.ajax({  
	        url:"registro.php",   // envia a la url DE DATOS PERSONALES
	        method:"POST", 
	        dataType: 'json', 
	        data:{ inscNombre : $("#inscripcionNombre").val(),  // texto agregado
		           confEmail  : $("#confEmail").val(),
		           inscProducto : 'Servicio'
		         },  
		         success:function(resp){
			        var datos = resp.res;			        			        						                     
			    }, 
			    error:function(res){
				    //alert('SOLICITUD ENVIADA');
				}
	    });
	    console.log($("#inscripcionNombre").val());
	    console.log($("#confEmail").val());
	    $("#botones").hide(); 
	    $("#jumbo").show();
	    } else { alert('FAVOR DE INGRESAR TODOS LOS DATOS'); }; // cierre if      
    });
    $('#ecommerce').click(function(){ 
	    
	    if(
	        document.getElementById("inscripcionNombre").className == "form-control is-valid"  &&
	        document.getElementById("confEmail").className == "form-control is-valid"
	    ){
	    // ENVIA LOS DATOS PERSONALES 
	    $.ajax({  
	        url:"registro.php",   // envia a la url DE DATOS PERSONALES
	        method:"POST", 
	        dataType: 'json', 
	        data:{ inscNombre : $("#inscripcionNombre").val(),  // texto agregado
		           confEmail  : $("#confEmail").val(),
		           inscProducto : 'Ecommerce'		          
		         },  
		         success:function(resp){
			        var datos = resp.res;			        			        						                     
			    }, 
			    error:function(res){
				    //alert('SOLICITUD ENVIADA');
				}
	    }); // cierre ajax
	    console.log($("#inscripcionNombre").val());
	    console.log($("#confEmail").val());
	    $("#botones").hide();
	    $("#jumbo").show(); 
	    } else { alert('FAVOR DE INGRESAR TODOS LOS DATOS'); }; // cierre if	          
    });
              
}); 
</script>
<?php 
    gc_collect_cycles(); 
?>
</html>


